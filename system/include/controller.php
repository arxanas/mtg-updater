<?php
namespace Framework;

require_once(SYS_PATH . '/core/input.php');

abstract class Controller {
    /**
     * The module loader instance, as passed by the module loader.
     * @var ModuleLoader
     */
    private static $module_loader;

    /**
     * The model loader instance, as passed by the module loader.
     * @var ModelLoader
     */
    private static $model_loader;

    /**
     * The view loader instance, as passed by the module loader.
     * @var ViewLoader
     */
    private static $view_loader;

    /**
     * The ORM loader instance, as passed by the module loader.
     * @var OrmLoader
     */
    private static $orm_loader;

    /**
     * Sets the module loader instance. Should not be called by the user, but it
     * has to be public because of the ridiculous architecture.
     * @param ModuleLoader $module_loader
     */
    public static function setModuleLoader(ModuleLoader $module_loader) {
        self::$module_loader = $module_loader;
    }

    /**
     * Sets the model loader instance. Should not be called by the user, but it
     * has to be public because of the ridiculous architecture.
     * @param ModelLoader $model_loader
     */
    public static function setModelLoader(ModelLoader $model_loader) {
        self::$model_loader = $model_loader;
    }

    /**
     * Sets the view loader instance. Should not be called by the user, but it
     * has to be public because of the ridiculous architecture.
     * @param ViewLoadel $view_loader
     */
    public static function setViewLoader(ViewLoader $view_loader) {
        self::$view_loader = $view_loader;
    }

    /**
     * Sets the ORM loader instance. Should not be called by the user, but it
     * has to be public because of the ridiculous architecture.
     * @param OrmLoader $orm_loader
     */
    public static function setOrmLoader(OrmLoader $orm_loader) {
        self::$orm_loader = $orm_loader;
    }


    /**
     * Loads a module.
     * @param string $module_slug The module slug.
     * @return mixed The loaded module.
     */
    public static function loadModule($module_slug) {
        return self::$module_loader->load($module_slug);
    }

    /**
     * Loads a model.
     * @param string $model_slug The name of the model: for example,
     * 'index' or 'index-model'.
     */
    public static function loadModel($model_slug) {
        self::$model_loader->load($model_slug);
    }

    /**
     * Loads an ORM.
     * @param string $orm_slug The name of the ORM: for example,
     * `comments-orm`.
     */
    public static function loadORM($orm_slug) {
        self::$orm_loader->load($orm_slug);
    }

    /**
     * Loads and displays a view.
     * @param string  $view_name The name of the view to load.
     * @param array   $vars Variables to pass to the view.
     * @param boolean $return Whether or not to return the generated view's
     * HTML. Defaults to false.
     * @return null|string
     */
    public static function render(
        $view_name,
        $vars = array(),
        $return = false
    ) {
        return self::$view_loader->load($view_name, $vars, $return);
    }

    public static function redirect($url) {
        header('Location: ' . $url);
        exit();
    }
}
