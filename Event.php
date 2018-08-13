<?php
namespace asbamboo\console;

/**
 * 本模块内部事件列表
 * 
 * @author 李春寅 <licy2013@aliyun.com>
 * @since 2018年8月4日
 */
final class Event
{
    /**
     * 在一个控制台脚本程序被调用之前触发这个事件
     * 也就是说在执行asbamboo\console\command\CommandInterface::exec之前触发这个事件
     * 
     * @var string
     */
    const ASBAMBOO_CONSOLE_PRE_EXEC = 'asbamboo.console.command.pre.exec';
}