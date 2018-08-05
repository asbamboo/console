<?php
namespace asbamboo\console;

/**
 * 输入控制器
 *
 * @author 李春寅 <licy2013@aliyun.com>
 * @since 2018年7月31日
 */
interface InputInterface
{
    /**
     * 提示用户输入交互信息
     *
     * @param string $title 提示给用户的输入标题名称
     * @return string 返回用户输入的字符串
     */
    public function prompt(string $title) : string;

    /**
     * 获取命令行程序的名称
     * - $_server[argv] 里面 以“--和-”开头的参数以外, 最前面的第一个参数。
     * - 如果没有任何参数，默认是系统内列出所有命令：asbamboo:console:lists
     *
     * @return string
     */
    public function commandName() : string;

    /**
     * 获取命令行程序的参数
     *  - $_server[argv] 里面 以“--和-”开头的参数以外。最前面的第一个参数表示调用哪一个命令，其他的按顺序作为这个命令的参数。
     *  - 允许没有任何参数的命令行程序
     *
     * @return array|NULL
     */
    public function arguments() : ?array;

    /**
     * 获取命令行程序的选项信息
     * - $_server[argv] 里面 以“--“开头为选项全称， 以"-"开头的为选项简称
     * - 允许没有任何选项的命令行程序，将采用默认值执行。具体默认值由不同的命令行程序设置。
     * - 选项的设置如
     *      ”--env=dev“ env是选项名称， dev是选项env的值
     *      ”--help|-h“ 这个是特殊的选项。等同于执行系统自带的help命令程序
     *      ”--test“ 如果选项没有符号”=“, 那么等同于--test=true
     *
     * @return array|NULL
     */
    public function options() : ?array;
    
    /**
     * 获取命令行程序的简称选项信息
     *  - 简称 如 self::shortOptions()的h 是 self::options()的help的简称
     *  - 执行命令的时候带上--help 或者 -h都可以。 
     * 
     * @return array|NULL
     */
    public function shortOptions() : ?array;
}