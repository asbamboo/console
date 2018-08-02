<?php
namespace asbamboo\console;

use asbamboo\console\Exception\ConsoleNotFoundCommandException;
use asbamboo\console\command\CommandInterface;
use asbamboo\console\command\ListsCommand;
use asbamboo\console\command\HelpCommand;

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
     */
    public function __construct()
    {
        /*
         * 默认的内置命令行程序
         */
        $this->add(Constant::ASBAMBOO_CONSOLE_LISTS, ListsCommand::class);
        $this->add(Constant::ASBAMBOO_CONSOLE_HELP, HelpCommand::class);
    }

    /**
     *
     * {@inheritDoc}
     * @see \asbamboo\console\CommandCollectionInterface::add()
     */
    public function add(string $name, /*CommandInterface|string*/ $Command) : CommandCollectionInterface
    {
        $this->commands[$name]      = $Command;

        return $this;
    }

    /**
     *
     * {@inheritDoc}
     * @see \asbamboo\console\CommandCollectionInterface::get()
     */
    public function get(string $name) : CommandInterface
    {
        if($this->has($name)){
            $Command    = $this->commands[$name];
            if(is_string( $Command ) && class_exists($Command)){
                $Command    = new $Command;
            }
            return $Command;
        }
        throw new ConsoleNotFoundCommandException(sprintf('命令行程序没有找到：%s', $name));
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
        foreach($this->commands AS $name => $Command)
        {
            if(is_string($Command)){
                $this->commands[$name]  = $this->get($name);
            }
        }
        return new \ArrayIterator($this->commands);
    }
}