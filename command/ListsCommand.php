<?php
namespace asbamboo\console\command;

use asbamboo\console\CommandCollectionInterface;
use asbamboo\console\CommandCollection;

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
     * @param CommandCollectionInterface $CommandCollection
     */
    public function exec(CommandCollectionInterface $CommandCollection = null) : void
    {
        if(is_null($CommandCollection)){
            $CommandCollection  = new CommandCollection();
        }
        $Commands           = $CommandCollection->getIterator();
        $name_max_length    = 0;
        foreach($Commands AS $name => $Command){
            $name_length    = strlen($name);
            if($name_length > $name_max_length){
                $name_max_length    = $name_length;
            }
        }
        foreach($Commands AS $name => $Command){
            echo str_pad($name, $name_max_length + 1, ' ', STR_PAD_RIGHT), $Command->desc(), "\r\n";
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
        return '';
    }
}