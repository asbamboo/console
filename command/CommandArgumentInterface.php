<?php
namespace asbamboo\console\command;

/**
 * 一个命令行程序的参数信息
 *
 * @author 李春寅 <licy2013@aliyun.com>
 * @since 2018年8月1日
 */
interface CommandArgumentInterface
{
    /**
     * 获取参数名称
     *
     * @return string
     */
    public function getName() : string;

    /**
     * 获取参数的默认值
     *
     * @return string
     */
    public function getDefaultValue() : string;
    
    /**
     * 是否必须
     * 
     * @return bool
     */
    public function isRequired() : bool;
    
    /**
     * 获取参数的位置
     *  - 一个命令行程序可能包含多个参数。表示本参数应该是所有参数中的哪个下标。
     * 
     * @return int
     */
    public function getPosition() : int;
    
    /**
     * 获取参数的简要描述信息
     * 
     * @return string
     */
    public function getDesc() : string;
}
