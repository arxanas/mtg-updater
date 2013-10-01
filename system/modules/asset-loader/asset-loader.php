<?php
namespace Framework;

class AssetLoader {
    /**
     * AssetLoader has no dependencies.
     */
    public function __construct() {}

    /**
     * Loads a public asset with the specified name.
     * @param  string $requested_page The page, as requested by the end-user.
     * @return boolean|int Returns false on failure, or the number of bytes
     * written on success.
     */
    public function loadPublic($requested_page) {
        $asset_path = APP_PATH . '/assets/public/' . $requested_page;
        $asset_realpath = realpath($asset_path);
        if ($this->isPublic($requested_page)) {
            // Set an expire date, so that the browser caches the asset.
            if (!defined('CACHE_TIME')) {
                define('CACHE_TIME', 60 * 60);
            }
            header('Expires: '.date('r', time() + CACHE_TIME));

            // Find the content type, so that the browser renders its type
            // correctly.
            $mimes = array (
                'js'    => 'application/javacript',
                'jsonp' => 'application/javacript',
                'json'  => 'application/json',
                'css'   => 'text/css',
                'rss'   => 'application/xml',
                'atom'  => 'application/xml',
                'xml'   => 'application/xml',
                'rdf'   => 'application/xml',
            );
            $extension = strtolower(pathinfo(
                $asset_realpath,
                PATHINFO_EXTENSION
            ));
            if (array_key_exists($extension, $mimes)) {
                header('Content-Type: ' . $mimes[$extension]);
            } else {
                $finfo = new \finfo(FILEINFO_MIME);
                header('Content-Type: '.$finfo->file($asset_realpath));
            }

            return readfile($asset_realpath);
        } else {
            return false;
        }
    }

    /**
     * Loads a protected asset with the specified name.
     * @param  string $requested_page The path with
     * /application/assets/protected/ as its base to load.
     * @return boolean|int Returns false on failure, or the number of bytes
     * written on success.
     */
    public function loadProtected($requested_page) {
        $asset_path = APP_PATH . '/assets/protected/' . $requested_page;
        $asset_realpath = realpath($asset_path);
        if ($this->isProtected($requested_page)) {
            // Set an expire date, so that the browser caches the asset.
            if (!defined('CACHE_TIME')) {
                define('CACHE_TIME', 60 * 60);
            }
            header('Expires: '.date('r', time() + CACHE_TIME));

            // Find the content type, so that the browser renders its type
            // correctly.
            $finfo = new \finfo(FILEINFO_MIME);
            header('Content-Type: '.$finfo->file($asset_realpath));

            return readfile($asset_realpath);
        } else {
            return false;
        }
    }

    /**
     * Checks to see if the requested page is a public asset.
     * @param  string  $requested_page The page, as requested by the end-user.
     * @return boolean
     */
    public function isPublic($requested_page) {
        $asset_path = APP_PATH . '/assets/public/' . $requested_page;
        $asset_realpath = realpath($asset_path);
        return $asset_realpath
            && substr($asset_realpath, 0, strlen($asset_path)) === $asset_path;
    }

    /**
     * Checks to see if the path is a protected asset.
     * @param  string $requested_page The path with
     * /application/assets/protected/ as its base.
     * @return boolean
     */
    public function isProtected($requested_page) {
        $asset_path = APP_PATH . '/assets/protected/' . $requested_page;
        $asset_realpath = realpath($asset_path);
        return $asset_realpath
            && substr($asset_realpath, 0, strlen($asset_path)) === $asset_path;
    }
}
