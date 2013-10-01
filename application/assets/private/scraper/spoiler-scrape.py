#!/usr/bin/env python2
from bs4 import BeautifulSoup as bs
import urllib2
import argparse
import sys
from xml.dom.minidom import Document


def parse_args():
    """
    usage: spoiler-scrape.py [-h] [-o {cockatrice,mws}] [-v] -e EXPANSION
                         [-g GALLERY] [-b INCLUDE_BASIC_LANDS]
                         url

    Downloads and parses a web page into an online Magic client-readable format.

    positional arguments:
      url                   The URL of the MTGS spoiler page containing the
                            spoilers. Should be a printable spoiler page.

    optional arguments:
      -h, --help            show this help message and exit
      -o {cockatrice,mws}, --output-format {cockatrice,mws}
                            What Magic client format to output
      -v, --verbose
      -e EXPANSION, --expansion EXPANSION
                            Expansion of the set, like "M10"
      -g GALLERY, --gallery GALLERY
                            The WotC card image gallery URL
      -b INCLUDE_BASIC_LANDS, --include-basic-lands INCLUDE_BASIC_LANDS
                            Whether or not to include basic lands
    """
    parser = argparse.ArgumentParser(
        description="Downloads and parses a web page into an online Magic client-readable format."
    )
    parser.add_argument("url",
        help="The URL of the MTGS spoiler page containing the spoilers. Should be a printable spoiler page.",
    )
    parser.add_argument("-o", "--output-format",
        help="What Magic client format to output",
        type=str,
        default="cockatrice",
        choices=["cockatrice", "mws"]
    )
    parser.add_argument("-v", "--verbose",
        action="store_true"
    )
    parser.add_argument("-e", "--expansion",
        help="Expansion of the set, like \"M10\"",
        type=str,
        required=True
    )
    parser.add_argument("-g", "--gallery",
        help="The WotC card image gallery URL",
        type=str,
    )
    parser.add_argument("-b", "--include-basic-lands",
        help="Whether or not to include basic lands",
        type=bool,
        default=False
    )

    return parser.parse_args()


def download_file(url):
    # Note: this changes between Python 2.x and 3.x.
    return urllib2.urlopen(url).read()


def parse_page(page, expansion, include_basic_lands=False):
    soup = bs(page)
    cards = []
    card = {}
    field_type_replacements = {
        ":": "",
        ".": "",
    }
    types = []
    for row in soup("tr"):
        is_br = len(row("td")[0]("br"))
        if is_br:
            cards.append(card)
            if args.verbose:
                sys.stderr.write("Card `{}` finished.\n".format(card["name"]))
            card = {}
        else:
            field_type = row("td")[0].get_text().strip().lower()
            field_value = row("td")[1].get_text().strip()
            for i in field_type_replacements:
                field_type = field_type.replace(i, field_type_replacements[i])

            types.append(field_type)
            if field_type == "name":
                card["name"] = field_value
            elif field_type == "type":
                card["typeline"] = field_value
                if "-" in field_value:
                    field_value = field_value.split("-")
                    card["type"] = field_value[0].strip()
                    card["subtype"] = field_value[1].strip()
            elif field_type == "rarity":
                card["rarity"] = field_value.lower()
            elif field_type == "rules text":
                card["text"] = field_value
            elif field_type == "flavor text":
                card["flavor_text"] = field_value
            elif field_type == "cost":
                field_value = field_value.replace("{", "").replace("}", "").upper()
                colors = [i for i in {"W", "U", "B", "R", "G"} & set(field_value)]
                card["color"] = "".join(colors)
            elif field_type == "pow/tgh":
                card["pt"] = field_value
                if "/" in field_value:
                    field_value = field_value.split("/")
                    card["power"] = field_value[0]
                    card["toughness"] = field_value[1]
            elif field_type == "illus":
                card["illus"] = field_value
            elif field_type == "set number":
                card["number"] = field_value.replace("#", "")
            else:
                if args.verbose:
                    sys.stderr.write("Unknown card field: `{}`.\n".format(field_type))

    for card in cards:
        card["expansion"] = expansion

    if args.verbose:
        sys.stderr.write("{} cards scraped.\n".format(len(cards)))

    if not args.include_basic_lands:
        cards = filter(lambda card: card["rarity"] != "basic land", cards)

    if args.verbose:
        sys.stderr.write("{} cards kept.\n".format(len(cards)))

    return cards


def parse_image_page(cards, page, verbose=False):
    soup = bs(page)
    images = [i for i in soup("img")]
    images = filter(lambda image: image.get("class") and "article-image" in image.get("class"), images)
    images = filter(lambda image: image.get("alt"), images)
    for i in images:
        for j in cards:
            if i["alt"].lower() == j["name"].lower():
                if verbose:
                    sys.stderr.write("Image for {}: {}\n".format(j["name"], i["src"]))
                j["image"] = i["src"]

    return cards


def output_cockatrice(cards):
    # Normalize data
    tablerows = {
        "land": 0,
        "artifact": 1,
        "enchantment": 1,
        "planeswalker": 1,
        "creature": 2,
        "instant": 3,
        "sorcery": 3
    }
    field_map = {
        "name": "name",
        "expansion": "set",
        "color": "color",
        "cost": "manacost",
        "typeline": "type",
        "pt": "pt",
        "text": "text",
        "image": "image"
    }
    new_cards = []
    for card in cards:
        new_card = {}
        for i in field_map:
            if i in card:
                new_card[field_map[i]] = card[i]

        if "type" in card:
            for i in card["type"].lower().split(" "):
                if i in tablerows:
                    new_card["tablerow"] = str(tablerows[i])

        new_cards.append(new_card)

    cards = new_cards

    # Make XML
    doc = Document()
    root = doc.createElement("cards")
    doc.appendChild(root)
    for card in cards:
        card_element = doc.createElement("card")
        root.appendChild(card_element)
        for field in card:
            if field != "image":
                field_element = doc.createElement(field)
                card_element.appendChild(field_element)
                value_element = doc.createTextNode(card[field])
                field_element.appendChild(value_element)
                if field == "set" and "image" in card:
                    field_element.setAttribute("picURL", card["image"])

    return root.toprettyxml(indent=" " * 4).replace("<cards>\n", "").replace("\n</cards>", "")

if __name__ == "__main__":
    args = parse_args()
    cards = parse_page(download_file(args.url), args.expansion, include_basic_lands=args.include_basic_lands)
    if args.gallery is not None:
        cards = parse_image_page(cards, download_file(args.gallery), verbose=args.verbose)

    if args.output_format == "cockatrice":
        output = output_cockatrice(cards)
    else:
        raise NotImplementedError("Sorry, MWS isn't actually implemented yet -- but you could do it, if you wanted.")
    sys.stdout.write(output)
