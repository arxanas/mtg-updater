<?php
class BuildsController extends Framework\Controller {
    public static function request() {
        BuildModel::requestRebuild($_SERVER['REMOTE_ADDR']);
        self::redirect(APP_URL);
    }

    public static function download($id) {
        $build = new Build(intval($id));
        if ($build === null || !is_readable($filename = $build->path)) {
            self::redirect(APP_URL);
        } else {
            header('Cache-Control: public');
            header('Content-Description: File Transfer');
            header('Content-Disposition: attachment; filename=' . basename($filename));
            header('Content-Type: application/xml');
            readfile($filename);
        }
    }

    public static function supersecretforcebuild() {
        BuildModel::rebuild();
        self::redirect(APP_URL);
    }
}
