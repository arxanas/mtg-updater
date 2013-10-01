<?php
namespace Framework;

class ModelLoaderException extends \Exception {}

class ModelNotFoundException extends ModelLoaderException {}

class ModelNotLoadableException extends ModelLoaderException {}

class ModelLoader {
    const MODEL_SUFFIX = '-model';

    private $module_loader,
               $orm_loader,
                      $pdo;
    
    public function __construct(
        ModuleLoader $module_loader,
        OrmLoader $orm_loader,
        \PDO $pdo
    ) {
        $this->module_loader = $module_loader;
        $this->orm_loader    = $orm_loader;
        $this->pdo           = $pdo;

        require_once(SYS_PATH . '/include/model.php');
    }

    public function load($model_slug) {
        if (substr($model_slug, -strlen(self::MODEL_SUFFIX))
            === self::MODEL_SUFFIX) {
            $model_slug = substr(
                $model_slug,
                0,
                strlen($model_slug) - strlen(self::MODEL_SUFFIX)
            );
        }
        $model_path = sprintf(
            '%s/models/%s-model.php',
            APP_PATH,
            $model_slug
        );
        if (!file_exists($model_path)) {
            throw new ModelNotFoundException(
                'Model not found: ' . $model_path
            );
        } else {
            if ((@include_once($model_path)) === false) {
                throw new ModelNotLoadableException(
                    'Model not loadable: ' . $model_path
                );
            } else {
                $model_name = Slug::slugToName($model_slug) . 'Model';

                $model_name::setModuleLoader($this->module_loader);
                $model_name::setModelLoader($this);
                $model_name::setOrmLoader($this->orm_loader);
                $model_name::setDatabase($this->pdo);
            }
        }
    }
}
