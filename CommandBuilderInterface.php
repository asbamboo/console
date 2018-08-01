<?php
namespace asbamboo\console;

/**
 * 创建可以被call_user_func调用的回调方法
 *  - 在调用CommandCollection::get方法的时候用到实现本接口的实例的build方法， build方法返回一个callable
 *
 * @author 李春寅 <licy2013@aliyun.com>
 * @since 2018年8月1日
 */
interface CommandBuilderInterface
{
    /**
     * 返回实现本接口的实例
     *
     * @return CommandBuilderInterface
     */
    public static function instance() : CommandBuilderInterface;

    /**
     *
     * @param string|callable $command 本身就是一个回调方法或者 "class:method" 格式的字符串
     * @return callable
     */
    public function build(/*string|callable*/ $command) : callable;
}