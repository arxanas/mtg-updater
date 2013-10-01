<?php
class MessageController extends Framework\Controller {
    public static function __index() {
        $message = POST('message', Framework\Type\String);
        if (strlen($message)) {
            Message::create(array(
                'ip'      => $_SERVER['REMOTE_ADDR'],
                'time'    => $_SERVER['REQUEST_TIME'],
                'content' => $message,
            ));
        }
        self::redirect(APP_URL . '?sent=1');
    }
}
