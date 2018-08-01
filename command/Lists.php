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
    private $options;

    /**
     *
     * @param CommandCollectionInterface $CommandCollection
     */
    public function exec(CommandCollectionInterface $CommandCollection = null)
    {
        if(is_null($CommandCollection)){
            $CommandCollection  = new CommandCollection();
        }
        $commands           = $CommandCollection->getIterator();
        $name_max_length    = 0;
        foreach($commands AS $name => $command){
            $name_length    = strlen($name);
            if($name_length > $name_max_length){
                $name_max_length    = $name_length;
            }
        }
        foreach($commands AS $name => $command){
            echo str_pad($name, $name_max_length + 1, ' ', STR_PAD_RIGHT), $CommandCollection->description($name), "\r\n";
        }
    }

    public function option($name, $default, $n, $desc)
    {

    }

    public function help()
    {

    }
}