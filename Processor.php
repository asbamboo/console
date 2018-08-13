<?php
namespace asbamboo\console;

use asbamboo\console\command\CommandInterface;
use asbamboo\event\EventScheduler;

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
     * @var InputInterface
     */
    private $Input;

    /**
     * 
     * @var OutputInterface
     */
    private $Output;

    /**
     *
     * @param FinderInterface $Finder
     */
    public function __construct(FinderInterface $Finder = null, InputInterface $Input = null, OutputInterface $Output = null)
    {
        if(is_null($Finder)){
            $Finder = new Finder();
        }
        $this->Finder   = $Finder;

        if(is_null($Input)){
            $Input      = new Input();
        }
        $this->Input    = $Input;

        if(is_null($Output)){
            $Output     = new Output(); 
        }
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
        
        EventScheduler::instance()->on(Event::ASBAMBOO_CONSOLE_PRE_EXEC, $this);
        
        return call_user_func_array([$Command, 'exec'], [$this]);
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
        $name   = $this->input()->commandName();
        return $this->Finder->find($name);
    }
}