<?php
namespace Framework;

class Autoloader {
    private $model_loader,
              $orm_loader;

    public function __construct(
        ModelLoader $model_loader,
        OrmLoader $orm_loader
    ) {
        $this->model_loader = $model_loader;
        $this->orm_loader = $orm_loader;


        spl_autoload_register(array(
            $this,
            'loadOrm'
        ));

        spl_autoload_register(array(
            $this,
            'loadModel'
        ));
    }

    public function loadModel($model_name) {
        try {
            $this->model_loader->load(Slug::nameToSlug($model_name));
        } catch (ModelNotFoundException $e) {}
    }

    public function loadOrm($orm_name) {
        try {
            $this->orm_loader->load(Slug::nameToSlug($orm_name));
        } catch (OrmNotFoundException $e) {}
    }
}
