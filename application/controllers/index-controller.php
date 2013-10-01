<?php
class IndexController extends Framework\Controller {
    public static function __index() {
        $request_percent = BuildModel::getRebuildPercent();

        $builds = BuildModel::getBuilds();

        self::render('index', array(
            'builds'          => $builds,
            'request_percent' => max($request_percent, 0.05),
            'sent'            => GET('sent', Framework\Type\Boolean),
        ));
    }
}
