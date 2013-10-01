<?php
namespace Framework;

class Model {

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
     * The ORM loader instance, as passed by the module loader.
     * @var OrmLoader
     */
    private static $orm_loader;

    /**
     * The database instance, as passed by the module loader.
     * @var \PDO
     */
    private static $pdo;

    /**
     * Sets the module loader instance. Should not be called by the user, but
     * has to be public because of the ridiculous architecture.
     * @param ModuleLoader $module_loader
     */
    public static function setModuleLoader(ModuleLoader $module_loader) {
        self::$module_loader = $module_loader;
    }
    /**
     * Sets the model loader instance. Should not be called by the user, but has
     * to be public because of the ridiculous architecture.
     * @param ModelLoader $module_loader
     */
    public static function setModelLoader(ModelLoader $model_loader) {
        self::$model_loader = $model_loader;
    }
    /**
     * Sets the ORM loader instance. Should not be called by the user, but has
     * to be public because of the ridiculous architecture.
     * @param OrmLoader $module_loader
     */
    public static function setOrmLoader(OrmLoader $orm_loader) {
        self::$orm_loader = $orm_loader;
    }

    /**
     * Sets the PDO instance. Should not be called by the user, but has to be
     * public because of the ridiculous architecture.
     * @param \PDO $pdo [description]
     */
    public static function setDatabase(\PDO $pdo) {
        self::$pdo = $pdo;
    }

    /**
     * Loads a module.
     * @param  string $module_slug
     * @return mixed The loaded module.
     */
    public static function loadModule($module_slug) {
        return self::$module_loader->load($module_slug);
    }

    /**
     * Loads a model.
     * @param  string $model_slug
     */
    public static function loadModel($model_slug) {
        self::$model_loader->load($model_slug);
    }

    /**
     * Loads an ORM.
     * @param  string $orm_slug
     */
    public static function loadOrm($orm_slug) {
        self::$orm_loader->load($orm_slug);
    }

    /**
     * Loads the database instance.
     * @return \PDO
     */
    public static function loadDatabase() {
        return self::$pdo;
    }
}
