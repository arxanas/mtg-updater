<?php
namespace Framework;

class Application {
    /**
     * The UrlRouter instance.
     * @var UrlRouter
     */
    private $url_router;

    /**
     * The page requested by the client.
     * @var string
     */
    private $requested_page;

    /**
     * Loads the URL Router and tells it to route the URL.
     * @param UrlRouter $url_router
     */
    public function __construct(
        UrlRouter $url_router,
        Autoloader $autoloader,
        ErrorHandler $error_handler
    ) {
        $this->url_router = $url_router;
        $this->url_router->route($_SERVER['PATH_INFO']);
    }
}
