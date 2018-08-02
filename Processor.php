<?php
namespace asbamboo\console;

use asbamboo\console\command\ListsCommand;
use asbamboo\console\command\CommandInterface;
use Symfony\Component\Console\Output\OutputInterface;

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

    private $Input;

    private $Output;

    /**
     *
     * @param FinderInterface $finder
     */
    public function __construct(FinderInterface $finder = null, InputInterface $Input = null, OutputInterface $Output = null)
    {
        if(is_null($finder)){
            $finder = new Finder();
        }
        $this->Finder   = $finder;

        if(is_null($Input)){
            $Input      = new Input();
        }
        $this->Input    = $Input;

        $this->Output   = $Output;
    }

    /**
     *
     * {@inheritDoc}
     * @see \asbamboo\console\ProcessorInterface::exec()
     */
    public function exec()
    {
        $Command    = $this->findCommand();
        if($Command instanceof ListsCommand){
            $args       = [$this->Finder->getCommandCollection()];
        }else{
            $args       = array_slice($_SERVER['argv'], 2);
        }
        return call_user_func_array([$Command, 'exec'], $args);
    }

    /**
     *
     * {@inheritDoc}
     * @see \asbamboo\console\ProcessorInterface::commandCollection()
     */
    public function commandCollection() : CommandCollectionInterface
    {
        return $this->Finder->getCommandCollection();
    }

    /**
     *
     * {@inheritDoc}
     * @see \asbamboo\console\ProcessorInterface::input()
     */
    public function input() : InputInterface
    {
        return $this->Input;
    }

    /**
     *
     * {@inheritDoc}
     * @see \asbamboo\console\ProcessorInterface::output()
     */
    public function output() : OutputInterface
    {
        return $this->Output;
    }

    /**
     *
     * @return callable
     */
    private function findCommand() : CommandInterface
    {
        $name   = $_SERVER['argv'][1] ?? Constant::ASBAMBOO_CONSOLE_LISTS;
        return $this->Finder->find($name);
    }
}