<?php
namespace asbamboo\console\command;

/**
 * 一个命令行程序的选项信息
 *
 * @author 李春寅 <licy2013@aliyun.com>
 * @since 2018年8月1日
 */
interface CommandOptionInterface
{
    /**
     * 获取选项名称
     *
     * @return string
     */
    public function getName() : string;

    /**
     * 获取选项的默认值
     *
     * @return mixed
     */
    public function getDefaultValue();

    /**
     * 获取选项的简要描述信息
     *
     * @return string
     */
    public function getDesc() : string;

    /**
     * 获取选项的简称
     *
     * @return string|NULL
     */
    public function getShortName() : ?string;
}
