<?php
namespace asbamboo\console;

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
     *
     * {@inheritDoc}
     * @see \asbamboo\console\CommandCollectionInterface::add()
     */
    public function add(string $name, callable $callable) : CommandCollectionInterface
    {
        $this->commands[$name]  = $callable;

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
            return $this->commands[$name];
        }
        //@TODO exception;
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