<?php
namespace asbamboo\console\command;

use asbamboo\console\Exception\ConsoleNotFoundCommandArgumentException;

/**
 * 
 * @author 李春寅 <licy2013@aliyun.com>
 * @since 2018年8月3日
 */
class CommandArgumentCollection implements CommandArgumentCollectionInterface
{
    /**
     * 
     * @var array
     */
    private $CommandArguments = [];
 
    /**
     * 参数索引
     * CommandArgumentInterface::name作为key，本集合中$CommandArguments的key作为值
     * 
     * @var array
     */
    private $index  = [];
    
    /**
     * 
     * {@inheritDoc}
     * @see \asbamboo\console\command\CommandArgumentCollectionInterface::append()
     */
    public function append(CommandArgumentInterface $CommandArgument): CommandArgumentCollectionInterface
    {
        $this->CommandArguments[$CommandArgument->getPosition()]    = $CommandArgument;
        $this->index[$CommandArgument->getName()]                   = $CommandArgument->getPosition();
        return $this;
    }
    
    /**
     *
     * {@inheritDoc}
     * @see \asbamboo\console\command\CommandOptionCollectionInterface::get()
     */
    public function get(string $name) : CommandArgumentInterface
    {
        if(isset($this->index[$name])){
            $key        = $this->index[$name];
            return $this->CommandArguments[$key];
        }
        throw new ConsoleNotFoundCommandArgumentException(sprintf('找不到属性:%s', $name));
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \IteratorAggregate::getIterator()
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->CommandArguments);
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Countable::count()
     */
    public function count()
    {
        return count($this->CommandArguments);
    }

}