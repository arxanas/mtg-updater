<?php
namespace Framework;

class ErrorHandler {
    private $view_loader;

    public function __construct(
        ViewLoader $view_loader,
        $smarty
    ) {
        $this->view_loader = $view_loader;

        $error_handler = array(
            $this,
            'handleError',
        );

        $exception_handler = array(
            $this,
            'handleException',
        );

        set_error_handler($error_handler, E_ALL);
        $smarty->muteExpectedErrors();
        set_exception_handler($exception_handler);
    }

    public function handleError(
        $errno,
        $errstr,
        $errfile = null,
        $errline = null,
        $errcontext = array()
    ) {
        $message = sprintf(
            'Error %s: %s in %s on %s',
            $errno,
            $errstr,
            $errfile,
            $errline
        );
        try {
            $this->view_loader->loadErrorPage(500, $message);
        } catch (\Exception $e) {
            die('Fatal error: ' . $message);
        }
        die();
    }

    public function handleException(\Exception $e) {
        $message = get_class($e) . ': ' . $e->getMessage();
        try {
            $this->view_loader->loadErrorPage(500, $message);
        } catch (\Exception $e) {
            die('Fatal error: ' . $message);
        }
        die();
    }
}
