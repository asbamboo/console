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
        $args       = array_slice($_SERVER['argv'], 2);
        return call_user_func_array($command, $args);
    }

    /**
     *
     * @return callable
     */
    private function findCommand() : callable
    {
        if(isset( $_SERVER['argv'][1] )){
            $name   = $_SERVER['argv'][1];
            return $this->Finder->find($name);
        }

        return [new Lists(), 'exec'];
    }
}