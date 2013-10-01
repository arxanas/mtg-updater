<?php
namespace Framework;

class ControllerLoaderException extends \Exception {}

class ControllerNotFoundException extends ControllerLoaderException {}

class ControllerLoader {
    /**
     * The name of the magic start method in a controller.
     */
    const MAGIC_METHOD_START = '__start';

    /**
     * The name of the magic end method in a controller.
     */
    const MAGIC_METHOD_END     = '__end';

    private $module_loader, $model_loader, $view_loader;

    /**
     * Hold the necessary controller dependencies.
     * @param ModuleLoader $module_loader The module loader, for use by the
     * controller.
     * @param ViewLoader $view_loader The view loader, for use by the
     * controller.
     */
    public function __construct(
        ModuleLoader $module_loader,
        ModelLoader    $model_loader,
        ViewLoader     $view_loader,
        OrmLoader    $orm_loader
    ) {
        $this->module_loader = $module_loader;
        $this->model_loader    = $model_loader;
        $this->view_loader     = $view_loader;
        $this->orm_loader    = $orm_loader;
        
        require_once(SYS_PATH . '/include/controller.php');
        Controller::setModuleLoader($module_loader);
        Controller::setModelLoader($model_loader);
        Controller::setViewLoader($view_loader);
        Controller::setOrmLoader($orm_loader);
    }

    /**
     * Loads a controller.
     * @param string $controller_slug The controller slug, as in the URL.
     * @param string $method_slug     The method slug, as in the URL.
     * @param array  $params          Further parameters, as in the URL.
     */
    public function load($controller_slug, $method_slug, $params) {
        // Set up the controller
        $controller_path = sprintf(
            '%s/controllers/%s-controller.php',
            APP_PATH,
            $controller_slug
        );
        if (!file_exists($controller_path)) {
            throw new ControllerNotFoundException(
                'Controller not found: ' . $controller_slug
            );
        }
        require_once($controller_path);

        $this->view_loader->setControllerSlug($controller_slug);
        $this->view_loader->setMethodSlug($method_slug);

        $controller_name   = Slug::slugToName($controller_slug) . 'Controller';
        $method_name       = str_replace('-', '_', $method_slug);
        $controller_method = array(
            $controller_name,
            $method_name,
        );

        // Call the start magic method:
        $start_method = array(
            $controller_name,
            self::MAGIC_METHOD_START,
        );
        if (is_callable($start_method)) {
            call_user_func_array($start_method, array());
        }

        // Call the main method:
        if (is_callable($controller_method)) {
            call_user_func_array($controller_method, $params);
        } else {
            throw new ControllerNotFoundException(
                'Controller not found:' . $controller_name
            );
        }

        // Call the end magic method:
        $end_method = array(
            $controller_name,
            self::MAGIC_METHOD_END,
        );
        if (is_callable($end_method)) {
            call_user_func_array($end_method, $params);
        }
    }
}
