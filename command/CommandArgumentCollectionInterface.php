<?php
namespace asbamboo\console\command;

/**
 * 命令行程序的参数集合
 * 
 * @author 李春寅 <licy2013@aliyun.com>
 * @since 2018年8月3日
 */
interface CommandArgumentCollectionInterface extends \IteratorAggregate, \Countable
{    
    /**
     * 将一个CommandArgumentInterface的实例添加到集合
     * 
     * @param CommandArgumentInterface $CommandArgument
     * @return CommandArgumentCollectionInterface
     */
    public function append(CommandArgumentInterface $CommandArgument) : CommandArgumentCollectionInterface;
    
        /**
     * 通过 $name 从集合中获取一个参数
     * 
     * @param string $name
     * @return CommandArgumentInterface
     */
    public function get(string $name) : CommandArgumentInterface;
}