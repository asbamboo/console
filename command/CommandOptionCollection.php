<?php
namespace asbamboo\console\command;

use asbamboo\console\Exception\ConsoleNotFoundCommandOptionException;

/**
 *
 * @author 李春寅 <licy2013@aliyun.com>
 * @since 2018年8月2日
 */
class CommandOptionCollection implements CommandOptionCollectionInterface
{
    /**
     *
     * @var array
     */
    private $CommandOptions = [];
    
    /**
     * 选项索引
     * CommandOptionInterface::name作为key，本集合中$CommandOptions的key作为值
     * 
     * @var array
     */
    private $index  = [];

    /**
     *
     * {@inheritDoc}
     * @see \asbamboo\console\command\CommandOptionCollectionInterface::append()
     */
    public function append(CommandOptionInterface $CommandOption) : CommandOptionCollectionInterface
    {
        $this->CommandOptions[]                 = $CommandOption;
        $this->index[$CommandOption->getName()] = count($this->CommandOptions) - 1;
        return $this;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \asbamboo\console\command\CommandOptionCollectionInterface::get()
     */
    public function get(string $name) : CommandOptionInterface
    {
        if(isset($this->index[$name])){
            $key        = $this->index[$name];
            return $this->CommandOptions[$key];
        }
        throw new ConsoleNotFoundCommandOptionException(sprintf('找不到选项:%s', $name));
    }

    /**
     *
     * {@inheritDoc}
     * @see \IteratorAggregate::getIterator()
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->CommandOptions);
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Countable::count()
     */
    public function count()
    {
        return count($this->CommandOptions);
    }

}