<?php
namespace asbamboo\console\command;

use asbamboo\console\Exception\ConsoleExceptionInterface;
use asbamboo\console\ProcessorInterface;

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
     * @param ProcessorInterface $Processor
     * @throws ConsoleExceptionInterface
     */
    public function exec(ProcessorInterface $Processor) ;

    /**
     * 获取简要描述信息
     *
     * @return string
     */
    public function desc() : string;

    /**
     * 命令行程序从控制台获取的选项
     *
     * @return CommandOptionCollectionInterface
     */
    public function options() : CommandOptionCollectionInterface;
    
    /**
     * 命令行程序从控制台获取的参数
     * 
     * @return CommandArgumentInterface
     */
    public function arguments() : CommandArgumentCollectionInterface;

    /**
     * 获取帮助信息
     *
     * @return string
     */
    public function help() : string;
}
