<?php
namespace asbamboo\console\command;

use asbamboo\console\ProcessorInterface;
use asbamboo\console\Constant;

/**
 * 列出所有命令行程序
 *
 * @author 李春寅 <licy2013@aliyun.com>
 * @since 2018年7月31日
 */
class ListsCommand extends CommandAbstract
{
    /**
     * 
     * {@inheritDoc}
     * @see \asbamboo\console\command\CommandInterface::exec()
     */
    public function exec(ProcessorInterface $Processor)
    {
        /**
         * 
         * @var \asbamboo\console\CommandCollectionInterface $Commands
         * @var \asbamboo\console\OutputInterface $Output
         */
        $Commands           = $Processor->commandCollection();
        $Output             = $Processor->output();
        
        $name_max_length    = 0;
        foreach($Commands AS $name => $Command){
            $name_length    = strlen($name);
            if($name_length > $name_max_length){
                $name_max_length    = $name_length;
            }
        }
        foreach($Commands AS $name => $Command){
            $Output->print(str_pad($name, $name_max_length + 1, ' ', STR_PAD_RIGHT), $Command->desc(), "\r\n");
        }
    }

    /**
     *
     * {@inheritDoc}
     * @see \asbamboo\console\command\CommandInterface::desc()
     */
    public function desc() : string
    {
        return '列出所有命令';
    }

    /**
     *
     * {@inheritDoc}
     * @see \asbamboo\console\command\CommandInterface::help()
     */
    public function help() : string
    {        
        $console    = $_SERVER['SCRIPT_FILENAME'];
        $list       = Constant::ASBAMBOO_CONSOLE_LISTS;
    
        return <<<HELP
    例: php {$console} {$list}

HELP;
    }
}