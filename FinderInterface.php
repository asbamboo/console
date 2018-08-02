<?php
namespace asbamboo\console;

use asbamboo\console\command\CommandInterface;

/**
 * 通过本接口实现的实例查找控制台命令对应的命令行回调程序
 *
 * @author 李春寅 <licy2013@aliyun.com>
 * @since 2018年7月31日
 */
interface FinderInterface
{
    /**
     * 查找控制台命令对应的命令行回调程序
     *
     * @param string $name
     * @return CommandInterface
     */
    public function find(string $name) : CommandInterface;

    /**
     * 获取命令集合
     *
     * @return CommandCollectionInterface
     */
    public function getCommandCollection() : CommandCollectionInterface;
}