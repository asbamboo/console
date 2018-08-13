<?php
namespace asbamboo\console\command;

/**
 * 命令行程序的一个选项信息
 *
 * @author 李春寅 <licy2013@aliyun.com>
 * @since 2018年8月2日
 */
class CommandOption implements CommandOptionInterface
{
    /**
     * 选项名称
     *
     * @var string
     */
    private $name;

    /**
     * 默认值
     *
     * @var mixed
     */
    private $default_value;

    /**
     * 简要描述
     *
     * @var string
     */
    private $desc;

    /**
     * 选项简称
     *
     * @var string
     */
    private $short_name;

    /**
     *
     * @param string $name
     * @param mixed $default_value
     * @param string $desc
     * @param string $short_name
     */
    public function __construct(string $name, /*mixed*/ $default_value = null, string $desc = '', string $short_name = null)
    {
        $this->name             = $name;
        $this->default_value    = $default_value;
        $this->desc             = $desc;
        $this->short_name       = $short_name;
    }

    /**
     * 获取选项名称
     *
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * 获取选项的默认值
     *
     * @return mixed
     */
    public function getDefaultValue()
    {
        return $this->default_value;
    }

    /**
     * 获取选项的简要描述信息
     *
     * @return string
     */
    public function getDesc() : string
    {
        return $this->desc;
    }

    /**
     * 获取选项的简称
     *
     * @return string|NULL
     */
    public function getShortName() : ?string
    {
        return $this->short_name;
    }
}