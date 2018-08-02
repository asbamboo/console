<?php
namespace asbamboo\console;

use asbamboo\console\command\CommandInterface;

/**
 * 一个命令程序
 *
 * @author 李春寅 <licy2013@aliyun.com>
 * @since 2018年7月31日
 */
interface CommandCollectionInterface extends \IteratorAggregate
{
    /**
     * 将一个命令回调方法添加到集合
     *
     * @param string $name　命令行程序名称
     * @param CommandInterface|string　命令行程序的回调方法如果传入的参数，不是实现CommandInterface的对象的话，应该传入字符串"实现CommandInterface的类的类名"
     * @return CommandCollectionInterface
     */
    public function add(string $name, /*CommandInterface|string*/ $Command) : CommandCollectionInterface;

    /**
     * 通过名称，获取一个命令行回调程序
     *
     * @param string $name
     * @return CommandInterface
     */
    public function get(string $name) : CommandInterface;

    /**
     * 判断一个命令行回调程序是否存在
     *
     * @param string $name
     * @return bool
     */
    public function has(string $name) : bool;
}