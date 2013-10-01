<?php
class BuildModel extends Framework\Model {
    const REBUILD_REQUESTS_REQUIRED = 2;

    public static function getRebuildPercent() {
        $requests = RebuildRequest::get();
        $ret = sizeof($requests) / self::REBUILD_REQUESTS_REQUIRED;
        $ret = $ret > 1 ? 1 : $ret;
        return $ret;
    }

    public static function requestRebuild($ip) {
        $ip = $_SERVER['REMOTE_ADDR'];
        $requests = RebuildRequest::get(array(
            'ip' => $ip,
        ));
        $recent_builds = Build::get(array(
            'time >' => time() - 60,
        ));
        if (empty($requests) && empty($recent_builds)) {
            RebuildRequest::create(array(
                'ip'   => $ip,
                'time' => time(),
            ));
            if (sizeof(RebuildRequest::get()) >= self::REBUILD_REQUESTS_REQUIRED) {
                self::rebuild();
                RebuildRequest::delete();
            }
            return true;
        } else {
            return false;
        }
    }

    public static function rebuild() {
        $path        = APP_PATH . '/assets/private/scraper/spoiler-scrape.py';
        $outfile     = APP_PATH . '/assets/private/builds/' . date('m.d.y-H.i') . '.xml';

        $gallery_url = 'http://www.wizards.com/magic/tcg/article.aspx?x=mtg/tcg/gatecrash/cig';
        $spoiler_url = 'http://mtgsalvation.com/printable-gatecrash-spoiler.html';
        $expansion   = 'GTC';

        $cmd = sprintf(
            'python2 %s -g "%s" -e "%s" %s --include-basic-lands 1',
            $path,
            $gallery_url,
            $expansion,
            $spoiler_url
        );

        $db = self::loadDatabase();
        $query = $db->prepare(sprintf("
            DELETE FROM %s
            WHERE 1
        ;", RebuildRequest::TABLE));
        $query->execute();

        exec($cmd, $xml);
        $xml = implode(PHP_EOL, $xml);

        $xml = preg_replace("/>\s+/i", '>', $xml);
        $xml = preg_replace("/\s+</i", '<', $xml);

        $num_cards = sizeof(explode('<card>', $xml)) - 1;
        file_put_contents($outfile, $xml);

        Build::create(array(
            'name' => date('m/d/y H:i'),
            'path' => $outfile,
            'num'  => $num_cards,
            'time' => time(),
        ));
    }

    public static function getBuilds() {
        $db = self::loadDatabase();
        $query = $db->prepare(sprintf("
            SELECT *
            FROM `%s`
            ORDER BY `time` DESC
            LIMIT 10
        ;", Build::TABLE));
        $query->execute();
        $ret = array();
        foreach ($query->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $ret[] = new Build($row);
        }
        return $ret;
    }
}
