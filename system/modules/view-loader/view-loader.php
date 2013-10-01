<?php
namespace Framework;

class ViewException extends \Exception {}

class ViewNotFoundException extends ViewException {}

class ViewLoader {
    const ERROR_DIRECTORY = '__errors/';

    private $smarty, $config;
    private $controller_slug,
                $method_slug;

    /**
     * Prepares the view loader.
     * @param \Smarty $smarty
     */
    public function __construct(\Smarty $smarty, $config) {
        $this->smarty = $smarty;
        $this->config = $config;
    }

    /**
     * Sets the controller slug. Must be called before a call to load.
     * @param string $controller_slug The controller slug, as in the URL.
     */
    public function setControllerSlug($controller_slug) {
        $this->controller_slug = $controller_slug;
    }

    /**
     * Sets the method slug. Must be called before a call to load.
     * @param string $method_slug The method slug, as in the URL.
     */
    public function setMethodSlug($method_slug) {
        $this->method_slug = $method_slug;
    }

    /**
     * Loads and renders a view with Smarty.
     * @param  string $view_slug The name of the view to load.
     * @param  array  $vars      Variables to be passed to the view.
     */
    public function load($view_slug, $vars = array(), $return = false) {
        foreach($vars as $name => $value) {
            $this->smarty->assign($name, $value);
        }

        // Find possible view paths:
        $view_paths = array(
            sprintf("%s/views/%s.tpl", APP_PATH, $view_slug),
        );
        if (strlen($this->controller_slug)) {
            array_unshift(
                $view_paths,
                sprintf(
                    "%s/views/%s/%s.tpl",
                    APP_PATH,
                    $this->controller_slug,
                    $view_slug
                )
            );
        }

        foreach ($view_paths as $view_path) {
            if (is_readable($view_path)) {
                ob_start();
                $this->smarty->display($view_path);
                if ($return) {
                    $ret = ob_get_contents();
                    ob_end_clean();
                    return $ret;
                } else {
                    ob_end_flush();
                    return;
                }
            }
        }
        throw new ViewNotFoundException('Could not find view ' . $view_slug);
    }

    public function loadErrorPage($code, $message = null) {
        switch ($code) {
            case 404:
                $view = self::ERROR_DIRECTORY . '404';
                break;
            case 500:
            default:
                $view = self::ERROR_DIRECTORY . '500';
        }
        if (!$this->config->environment->development) {
            $message = null;
        }
        return $this->load($view, array(
            'message' => $message,
        ));
    }
}
