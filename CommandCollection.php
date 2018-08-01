<?php
namespace asbamboo\console;

use asbamboo\console\command\Lists;

/**
 *
 * @author 李春寅 <licy2013@aliyun.com>
 * @since 2018年7月31日
 */
class CommandCollection implements CommandCollectionInterface
{
    /**
     *
     * @var array
     */
    private $commands   = [];

    /**
     * 简要描述  key 和 $commands保持一致
     *
     * @var array
     */
    private $descriptions   = [];

    /**
     *
     */
    public function __construct()
    {
        /*
         * 默认的内置命令行程序
         */
        $this->add(Constant::ASBAMBOO_CONSOLE_LISTS, Lists::class.':exec', '列出所有命令行');
    }

    /**
     *
     * {@inheritDoc}
     * @see \asbamboo\console\CommandCollectionInterface::add()
     */
    public function add(string $name, /*callable|class:method*/ $callable, string $descriptions = null) : CommandCollectionInterface
    {
        $this->commands[$name]      = $callable;
        $this->descriptions[$name]  = $descriptions;

        return $this;
    }

    /**
     *
     * {@inheritDoc}
     * @see \asbamboo\console\CommandCollectionInterface::get()
     */
    public function get(string $name) : callable
    {
        if($this->has($name)){
            $command    = $this->commands[$name];
            return CommandBuilder::instance()->build($command);
        }
        //@TODO exception;
    }

    /**
     *
     * {@inheritDoc}
     * @see \asbamboo\console\CommandCollectionInterface::description()
     */
    public function description($name) : ?string
    {
        if($this->has($name)){
            return $this->descriptions[$name];
        }
        return null;
    }

    /**
     *
     * {@inheritDoc}
     * @see \asbamboo\console\CommandCollectionInterface::has()
     */
    public function has(string $name) : bool
    {
        return isset($this->commands[$name]);
    }

    /**
     *
     * {@inheritDoc}
     * @see \IteratorAggregate::getIterator()
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->commands);
    }
}