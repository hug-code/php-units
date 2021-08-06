<?php
/**
 * @name: 单例
 * @Created by PhpStorm
 * @file: InstanceTool.php
 */

namespace HugCode\PhpUnits;

trait InstanceTool
{

    public $params;

    /**
     * Instances of the derived classes.
     * @var array
     */
    protected static $instances = array();

    /**
     * Get instance of the derived class.
     * @param array $params
     * @return static
     */
    public static function instance($params = [])
    {
        $className = get_called_class();
        if (!isset(self::$instances[$className])) {
            self::$instances[$className] = new $className;
        }
        self::$instances[$className]->params = $params;
        return self::$instances[$className];
    }

}
