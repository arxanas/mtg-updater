<?php
namespace Framework;

require_once('slug.php');

/**
 * Generic module loader exception.
 */
class ModuleLoaderException extends \Exception {}

/**
 * Thrown when the requested module cannot be found.
 */
class ModuleNotFoundException extends ModuleLoaderException {};

/**
 * Thrown when a module definition is unreadable. The module loader is designed
 * to cope with cases where only some properties (or none at all) are set, so
 * this will probably refer to an error in json_decode.
 */
class ModuleDefinitionException extends ModuleLoaderException {};

/**
 * Loads modules.
 */
class ModuleLoader {
    /**
     * Required to prevent circular references. Also useful to prevent loading
     * the same module more than once, though `require_once` should already be
     * doing that.
     * @var array
     */
    private $loaded_modules = array();

    /**
     * Loads a module by its slug.
     * @param  string  $module_slug The module slug.
     * @return mixed   If $use_factory was true, return the factory-generated
     * instance of the module.
     */
    public function load($module_slug) {
        if (sprintf('%s\\%s', __NAMESPACE__, Slug::slugToName($module_slug))
            === get_class($this)
        ) {
            // Allow a class to load the module loader, by returning $this.
            return $this;
        } else if (in_array($module_slug, array_keys($this->loaded_modules))) {
            // Retrun an already-loaded module.
            return $this->loaded_modules[$module_slug];
        }
        
        // Paths to search for a given module, in order.
        $module_paths = array(
            sprintf('%s/modules/%s/', SYS_PATH, $module_slug),
            sprintf('%s/modules/%s/', APP_PATH, $module_slug),
        );
        foreach ($module_paths as $module_path) {
            if (!is_readable($module_path)) {
                continue;
            }
            
            // Load the definition file, if it exists.
            $definition = $this->loadDefinition(
                $module_path . 'definition.json',
                $module_slug
            );

            // Add this module to the list of 'loaded' modules to prevent a
            // circular reference. This doesn't prevent multiple instantiation,
            // though.
            $this->loaded_modules[$module_slug] = 'Not yet loaded.';

            $dependencies = $this->loadDependencies(
                $definition['dependencies']
            );
            
            $factory_path = $module_path . $definition['factory-file'];

            // Make the new instance:
            if (strlen($definition['factory-file'])
                && is_readable($factory_path)) {

                // Loading should be done in a new scope, so we create a
                // closure.
                $load = function($factory_path, $dependencies) {
                    $ret = @include($factory_path);
                    if ($ret === false) {
                        throw new ModuleNotFoundException(
                            'Factory file not found: ' . $factory_path
                        );
                    }
                    return $ret;
                };
                $ret = $load($factory_path, $dependencies);
            } else {
                $class_path = $module_path . $definition['class-file'];
                if ((include_once($class_path)) === false) {
                    throw new ModuleNotFoundException(
                        'Class file not found: ' . $class_path
                    );
                }

                // To inject depencies, we have to use reflection, because
                // you can't `call_user_func_array` a constructor.
                // http://stackoverflow.com/questions/8734522/dynamically-call-class-with-variable-number-of-parameters-in-the-constructor
                $reflection = new \ReflectionClass($definition['class-name']);
                $ret = $reflection->newInstanceArgs($dependencies);
            }
            $this->loaded_modules[$module_slug] = $ret;
            return $ret;
        }

        throw new ModuleNotFoundException(
            'Could not find module ' . $module_slug
        );
    }

    /**
     * Loads a definition file for a module into an array. Sets any defaults.
     * @param  string $definition_path Absolute path to the definition file.
     * @param  string $module_slug
     * @return array
     */
    private function loadDefinition($definition_path, $module_slug) {
        $definition = array(
            'class-file'   => $module_slug . '.php',
            'class-name'   => Slug::slugToName($module_slug),
            'factory-file' => $module_slug . '-factory.php',
            'dependencies' => array(),
        );
        if (is_readable($definition_path)) {
            $json = json_decode(
                file_get_contents($definition_path),
                true
            );
            if ($json === false) {
                throw new ModuleDefinitionException(
                    'Could not parse ' . $definition_path
                );
            }
            $definition = array_merge(
                $definition,
                $json
            );
        }
        return $definition;
    }

    /**
     * Loads dependencies for a given module.
     * @param  array $dependencies An array of dependency module slugs.
     * @return array
     */
    private function loadDependencies(array $dependencies) {
        // Load dependencies (recursively). We need to inject depencies, so
        // we store them as they're loaded.
        $loaded_dependencies = array();
        foreach ($dependencies as $dependency) {
            if (in_array($dependency, array_keys($this->loaded_modules))) {
                $loaded_dependencies[$dependency] 
                    = $this->loaded_modules[$dependency];
            } else {
                $loaded_dependencies[$dependency] = $this->load($dependency);
            }
        }
        return $loaded_dependencies;
    }
}
