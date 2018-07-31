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
class Lists
{
    /**
     *
     * @param CommandCollectionInterface $CommandCollection
     */
    public function exec(CommandCollectionInterface $CommandCollection = null)
    {
        if(is_null($CommandCollection)){
            $CommandCollection  = new CommandCollection();
        }

        $commands   = $CommandCollection->getIterator();

        foreach($commands AS $name => $command){
            echo $name, "　", $CommandCollection->helper($name), "\r\n";
        }
    }
}