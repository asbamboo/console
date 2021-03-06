<?php
namespace asbamboo\console;

/**
 * 控制台处理程序
 *
 * @author 李春寅 <licy2013@aliyun.com>
 * @since 2018年7月31日
 */
interface ProcessorInterface
{
    /**
     * 执行控制台程序
     */
    public function exec();

    /**
     * 获取命令行程序集合
     */
    public function commandCollection() : CommandCollectionInterface;

    /**
     * 获取输入控制器
     *
     * @return InputInterface
     */
    public function input() : InputInterface;

    /**
     * 获取输出控制器
     *
     * @return OutputInterface
     */
    public function output() : OutputInterface;
}