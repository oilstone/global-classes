<?php

namespace Oilstone\GlobalClasses;

use Illuminate\Support\Str;

/**
 * Class MakeGlobal
 * @package App\Services\GlobalClasses
 */
abstract class MakeGlobal
{
    /**
     * @var self
     */
    protected static $instance;

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public static function __callStatic($name, $arguments)
    {
        if (static::instance()) {
            $name = Str::after(Str::snake($name), 'is_');

            return static::instance()->{$name}(...$arguments);
        }

        return null;
    }

    /**
     * @return self
     */
    abstract public static function instance();

    /**
     * Make the current object a global instance
     */
    public function setAsGlobal()
    {
        static::$instance = $this;
    }
}