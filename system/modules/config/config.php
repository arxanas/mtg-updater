<?php
namespace Framework;

/**
 * Generic configuration exception.
 */
class ConfigException extends \Exception {}

/**
 * Thrown when a config file is requested that can't be loaded.
 */
class ConfigLoadException extends ConfigException {}

/**
 * Loads configuration files from the application config directory.
 */
class Config {
    /**
     * The configuration defaults.
     * @var array
     */
    private $defaults = array(
        'environment' => array(
            'development' => false,
            'autoload'    => true,
            'data_prefix' => '',
        ),
        'database' => array(
            'username'  => 'root',
            'password'  => '',
            'dsn'       => null,
        ),
    );

    /**
     * The set of configuration options.
     * @var array
     */
    private $configs = array();

    public function __construct() {}

    public function __get($name) {
        if (!array_key_exists($name, $this->configs)) {
            $this->loadConfigFile($name);
        }

        // Convert it from a multi-dimensional array to a multi-dimensional
        // object.
        return json_decode(json_encode($this->configs[$name], true));
    }

    /**
     * Loads a configuration file and adds it to the internal config registry.
     * @param string $config_name The name of the file, without extension.
     */
    private function loadConfigFile($config_name) {
        $config_file_name = sprintf(
            '%s/config/%s.php',
            APP_PATH,
            $config_name
        );

        if (!is_readable($config_file_name)) {
            throw new ConfigLoadException(sprintf(
                'Could not read the %s configuration file',
                $config_name
            ));
        }

        if (!isset($this->configs[$config_name])) {
            if (isset($this->defaults[$config_name])) {
                $this->configs[$config_name] = $this->defaults[$config_name];
            } else {
                $this->configs[$config_name] = array();
            }
        }

        $this->configs[$config_name] = array_merge(
            $this->configs[$config_name],
            include($config_file_name)
        );
    }
}
