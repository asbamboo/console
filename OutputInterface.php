<?php
namespace asbamboo\console;

/**
 * 输出控制器
 *
 * @author 李春寅 <licy2013@aliyun.com>
 * @since 2018年7月31日
 */
interface OutputInterface
{
    /**
     * 输出是否启用
     *  - 如果返回 true， 那么打印类方法如 print， 应该会把传入的字符串参数打印出来。
     *  - 如果返回 false，那么将屏蔽打印类方法（如 print）的功能
     *
     * @return bool
     */
    public function isEnable() : bool;

    /**
     * 禁用输出
     *  - 调用本方法后self::isEnable方法，应该返回false。
     */
    public function disable() : OutputInterface;

    /**
     * 启用输出
     * - 调用本方法后self::isEnable方法，应该返回true。
     */
    public function enable() : OutputInterface;

    /**
     * 打印一系列字符串到控制台
     */
    public function print(string ...$args) : void;

    /**
     * 打印一系列字符串到控制台每个参数一行
     */
    public function println(string ...$args) : void;
}