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
     * 帮助信息 key 和 $commands保持一致
     * 
     * @var array
     */
    private $helpers    = [];

    /**
     *
     * {@inheritDoc}
     * @see \asbamboo\console\CommandCollectionInterface::add()
     */
    public function add(string $name, callable $callable, string $helper = null) : CommandCollectionInterface
    {
        $this->commands[$name]  = $callable;
        
        $this->helpers[$name]   = $helper;

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
    
    public function helper(string $name): ?string
    {
        if($this->has($name)){
            return $this->helpers[$name];
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