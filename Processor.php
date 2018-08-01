<?php
namespace asbamboo\console;

use asbamboo\console\command\Lists;

/**
 * 控制台处理程序
 *
 * @author 李春寅 <licy2013@aliyun.com>
 * @since 2018年7月31日
 */
class Processor implements ProcessorInterface
{
    /**
     *
     * @var FinderInterface
     */
    private $Finder;

    /**
     *
     * @param FinderInterface $finder
     */
    public function __construct(FinderInterface $finder = null)
    {
        if(is_null($finder)){
            $finder = new Finder();
        }
        $this->Finder   = $finder;
    }

    /**
     *
     * {@inheritDoc}
     * @see \asbamboo\console\ProcessorInterface::exec()
     */
    public function exec()
    {
        $command    = $this->findCommand();
        if(is_array($command) && $command[0] instanceof Lists && $command[1] == 'exec'){
            $args       = [$this->Finder->getCommandCollection()];
        }else{
            $args       = array_slice($_SERVER['argv'], 2);
        }
        return call_user_func_array($command, $args);
    }

    /**
     *
     * @return callable
     */
    private function findCommand() : callable
    {
        $name   = $_SERVER['argv'][1] ?? Constant::ASBAMBOO_CONSOLE_LISTS;
        return $this->Finder->find($name);
    }
}