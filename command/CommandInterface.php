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
    public function exec() : void;

    /**
     * 获取简要描述信息
     *
     * @return string
     */
    public function desc() : string;

    /**
     * 命令行选项
     *
     * @return CommandOptionCollectionInterface
     */
    public function options() : CommandOptionCollectionInterface;


    /**
     * 获取帮助信息
     *
     * @return string
     */
    public function help() : string;
}
