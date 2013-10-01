<?php
namespace Framework;

class UrlRouter {
    const DEFAULT_CONTROLLER = 'index';
    const DEFAULT_METHOD     = '__index';

    public $controller_slug = self::DEFAULT_CONTROLLER,
           $method_slug     = self::DEFAULT_METHOD,
           $params          = array();

    private $asset_loader,
            $controller_loader;

    public function __construct(
        $asset_loader,
        $controller_loader,
        $view_loader
    ) {
        $this->asset_loader      = $asset_loader;
        $this->controller_loader = $controller_loader;
        $this->view_loader       = $view_loader;
    }

    /**
     * Parses a URL and returns the 
     * @param  [type] $url [description]
     * @return [type]      [description]
     */
    public function route($url) {
        $url = trim($url, '/');
        
        if ($this->asset_loader->isPublic($url)) {
            return $this->asset_loader->loadPublic($url);
        }

        $url_segments = strlen($url) ? explode('/', $url) : array();
        
        switch (sizeof($url_segments)) {
            default:
                $this->params          = array_splice($url_segments, 2);
            case 2:
                $this->method_slug     = array_pop($url_segments);
            case 1:
                $this->controller_slug = array_pop($url_segments);
            case 0:
                break;
        }
        
        try {
            $this->controller_loader->load(
                $this->controller_slug,
                $this->method_slug,
                $this->params
            );
        } catch (ControllerNotFoundException $e) {
            $this->view_loader->loadErrorPage(404);
        }
    }
}
