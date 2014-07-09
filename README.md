About
-----

`mtg-updater` is two things: a web scraper for MTGSalvation's spoiler page,
which produces a `cards.xml` file for use with [Cockatrice][cockatrice], and a
website to generate and offer downloads for that `cards.xml` file.

  [cockatrice]: http://github.com/Daenyth/Cockatrice

You can ignore most of the framework stuff, as it is a framework which I built
but is irrelevant. Poke around `application/controllers` and
`application/models` for the web application logic, and look at
`application/assets/private/scraper` for the web scraper.

Installation
------------

Drop the project into an Apache-visible directory. Then make the
`application/assets/private/builds` directory, and ensure that it is readable
and writable by the Apache service (i.e. `chown apache
application/assets/private/builds`). 

License
-------

The MIT License (MIT)

Permission is hereby granted, free of charge, to any person obtaining a copy of
this software and associated documentation files (the "Software"), to deal in
the Software without restriction, including without limitation the rights to
use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies
of the Software, and to permit persons to whom the Software is furnished to do
so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.

