<?php
namespace asbamboo\console\command;

/**
 *
 * @author 李春寅 <licy2013@aliyun.com>
 * @since 2018年8月2日
 */
abstract class CommandAbstract implements CommandInterface
{
    protected $CommandOptionCollection;

    /**
     *
     * @param CommandOptionCollectionInterface $CommandOptionCollection
     */
    public function __construct(CommandOptionCollectionInterface $CommandOptionCollection = null)
    {
        if(is_null($CommandOptionCollection)){
            $this->CommandOptionCollection  = new CommandOptionCollection();
        }
    }

    /**
     * 命令行程序添加一个选项
     *
     * @param string $name
     * @param string $default_value
     * @param string $desc
     * @param string $short_name
     */
    protected function AddOption(string $name, string $default_value = null, string $desc = '', string $short_name = null) : void
    {
        $CommandOption                  = new CommandOption($name, $default_value, $desc, $short_name);
        $this->CommandOptionCollection->append($CommandOption);
    }

    /**
     *
     * {@inheritDoc}
     * @see \asbamboo\console\command\CommandInterface::options()
     */
    public function options() : CommandOptionCollectionInterface
    {
        return $this->CommandOptionCollection;
    }
}
