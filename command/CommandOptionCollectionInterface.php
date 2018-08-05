<?php
namespace asbamboo\console\command;

/**
 * 一个命令行程序的选项集合
 *
 * @author 李春寅 <licy2013@aliyun.com>
 * @since 2018年8月2日
 */
interface CommandOptionCollectionInterface extends \IteratorAggregate, \Countable
{
    /**
     * 将一个CommandOptionInterface的实例添加到集合
     *
     * @param CommandOptionInterface $CommandOption
     * @return CommandOptionCollectionInterface
     */
    public function append(CommandOptionInterface $CommandOption) : CommandOptionCollectionInterface;
    
    /**
     * 通过 $name 从集合中获取一个选项
     * 
     * @param string $name
     * @return CommandOptionInterface
     */
    public function get(string $name) : CommandOptionInterface;
}
