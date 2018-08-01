<?php
namespace asbamboo\console\command;

use asbamboo\console\Exception\ConsoleExceptionInterface;

/**
 * 命令行程序接口
 * 
 * @author 李春寅 <licy2013@aliyun.com>
 * @since 2018年8月1日
 */
interface CommandInterface
{
    /**
     * 命令行程序呢执行入口
     * 
     * @throws ConsoleExceptionInterface
     */
    public function exec(...$args) : void;
    
    /**
     * 获取简要描述信息
     * 
     * @return string
     */
    public function desc() : string;
    
    /**
     * 命令行选项
     * 
     * @return array
     */
    public function options() : array;

    
    /**
     * 获取帮助信息
     * 
     * @param string $help
     */
    public function help(string $help = null) : string;
    
    /**
     * 
     * @param string $name
     * @param string $default_value
     * @param string $desc
     * @param string $short_name
     */
    public function addOption(string $name, string $default_value = null, string $desc, string $short_name = null) : void;
}
