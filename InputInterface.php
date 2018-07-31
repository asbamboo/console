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
}