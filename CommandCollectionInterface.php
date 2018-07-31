<?php
namespace asbamboo\console;

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
     * @param string $name
     * @param callable $callable
     */
    public function add(string $name, callable $callable) : CommandCollectionInterface;

    /**
     * 获取一个命令行回调程序
     *
     * @param string $name
     * @return callable
     */
    public function get(string $name) : callable;

    /**
     * 判断一个命令行回调程序是否存在
     *
     * @param string $name
     * @return bool
     */
    public function has(string $name) : bool;
}