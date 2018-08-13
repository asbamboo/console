<?php
namespace asbamboo\console\command;

use asbamboo\console\ProcessorInterface;
use asbamboo\event\EventScheduler;
use asbamboo\console\Event;

/**
 *
 * @author 李春寅 <licy2013@aliyun.com>
 * @since 2018年8月2日
 */
abstract class CommandAbstract implements CommandInterface
{
    /**
     * 
     * @var CommandOptionCollectionInterface
     */
    protected $CommandOptionCollection;
    
    /**
     * 
     * @var CommandArgumentCollectionInterface
     */
    protected $CommandArgumentCollection;

    /**
     * 
     */
    public function __construct()
    {
        $this->CommandOptionCollection      = new CommandOptionCollection();
        $this->CommandArgumentCollection    = new CommandArgumentCollection();
        $this->AddOption('help', null, '获取使用帮助信息', 'h');
        $this->AddOption('quiet', null, '程序执行时不显示任何信息', 'q');
        
        EventScheduler::instance()->on(Event::ASBAMBOO_CONSOLE_PRE_EXEC, [$this, 'preExec']); 
    }
    
    /**
     * 如果命令行程序集成本抽象类得话，在执行exec方法之前会先执行本方法
     *  - 通过 asbamboo\event\EventScheduler\EventScheduler调度
     * 
     * @param ProcessorInterface $Processor
     */
    public function preExec(ProcessorInterface $Processor)
    {
        if($this->getOptionValueByProcessor('quiet', $Processor)){
            $Processor->output()->disable();
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
        $CommandOption  = new CommandOption($name, $default_value, $desc, $short_name);
        $this->options()->append($CommandOption);
    }
    
    /**
     * 
     * @param string $option_name
     * @param ProcessorInterface $Processor
     * @return mixed
     */
    protected function getOptionValueByProcessor(string $option_name, ProcessorInterface $Processor)
    {
        $CommandOption      = $this->options()->get($option_name);
        $name               = $CommandOption->getName();
        $short_name         = $CommandOption->getShortName();
        $value              = $CommandOption->getDefaultValue();
        $input_options      = $Processor->input()->options();
        $short_options      = $Processor->input()->shortOptions();
        
        $value              = $short_options[$short_name] ?? $value;
        $value              = $input_options[$name] ?? $value;
        
        return $value;
    }
    
    /**
     * 命令行程序添加一个参数
     * 
     * @param string $name
     * @param string $default_value
     * @param int $position
     * @param bool $is_require
     */
    protected function addArgument(string $name, string $desc, string $default_value = '', int $position = null, bool $is_require = false) : void
    {
        if($position === null){
            $position   = count($this->arguments());
        }
        $CommandArgument    = new CommandArgument($name, $desc, $default_value, $position, $is_require);
        $this->arguments()->append($CommandArgument);
    }
    
    /**
     * 
     * @param string $argument_name
     * @param ProcessorInterface $Processor
     * @return mixed|string
     */
    protected function getArgumentValueByProcessor(string $argument_name, ProcessorInterface $Processor)
    {
        $CommandArgument    = $this->arguments()->get($argument_name);
        $position           = $CommandArgument->getPosition();
        $value              = $CommandArgument->getDefaultValue();
        $input_arguments    = $Processor->input()->arguments();
        $value              = $input_arguments[$position] ?? $value;
        return $value;
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
    
    /**
     * 
     * {@inheritDoc}
     * @see \asbamboo\console\command\CommandInterface::arguments()
     */
    public function arguments() : CommandArgumentCollectionInterface
    {
        return $this->CommandArgumentCollection;
    }
}
