<?php
namespace asbamboo\console;

use asbamboo\helper\traits\SingletonClassTrait;

/**
 *
 * @author 李春寅 <licy2013@aliyun.com>
 * @since 2018年8月1日
 */
class CommandBuilder implements CommandBuilderInterface
{
    use SingletonClassTrait;

    /**
     *
     * @return CommandBuilderInterface
     */
    public static function instance() : CommandBuilderInterface
    {
        if(! static::$instance){
            static::$instance    = new static();
        }
        return static::$instance;
    }

    /**
     *
     * {@inheritDoc}
     * @see \asbamboo\console\CommandBuilderInterface::build()
     */
    public function build(/*string|callable*/ $command) : callable
    {
        if(is_callable($command)){
            return $command;
        }

        @list($class, $method) = explode(':', $command);
        if(class_exists($class)){
            $object = new $class;
            if(method_exists($object, $method)){
                return [new $class, $method];
            }
        }
        //@TODO exception
    }
}