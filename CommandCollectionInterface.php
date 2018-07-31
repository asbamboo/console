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
     * @param string $name　命令行程序名称
     * @param callable $callable　命令行程序的回调方法
     * @param string $helper　命令行程序的帮助信息
     * @return CommandCollectionInterface
     */
    public function add(string $name, callable $callable, string $helper = null) : CommandCollectionInterface;

    /**
     * 通过名称，获取一个命令行回调程序
     *
     * @param string $name
     * @return callable
     */
    public function get(string $name) : callable;
    
    /**
     * 通过名称，一个命令行程序的帮助信息。
     * 
     * @param string $name
     * @return string
     */
    public function helper(string $name) : string;

    /**
     * 判断一个命令行回调程序是否存在
     *
     * @param string $name
     * @return bool
     */
    public function has(string $name) : bool;
}