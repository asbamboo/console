<?php
namespace asbamboo\console\command;

use asbamboo\console\ProcessorInterface;
use asbamboo\console\Constant;
use phpDocumentor\Reflection\DocBlock\Description;

/**
 * 通过命令行程序名称，获取命令行程序的帮助信息
 *
 * @author 李春寅 <licy2013@aliyun.com>
 * @since 2018年7月31日
 */
class HelpCommand extends CommandAbstract
{
    /**
     * 
     */
    public function __construct()
    {
        parent::__construct();
        $this->addArgument('command_name', '命令名称', Constant::ASBAMBOO_CONSOLE_LISTS);
    }
    
    /**
     *
     * {@inheritDoc}
     * @see \asbamboo\console\command\CommandInterface::exec()
     */
    public function exec(ProcessorInterface $Processor)
    {
        $command_name       = $this->getArgumentValueByProcessor('command_name', $Processor);
        $Command            = $Processor->commandCollection()->get($command_name);
        $options_has_str    = count($Command->options()) == 0 ? '' : '[选项]';
        $arguments_has_str  = count($Command->arguments()) == 0 ? '' : '[参数]';
        $options_desc_str   = $this->makeOptionsDesc($Command->options());
        $arguments_desc_str = $this->makeArgumentsDesc($Command->arguments());
        
        
        $help           = <<<HELP
说明:
    {$Command->desc()}

使用方法:
        {$command_name} {$options_has_str} {$arguments_has_str}
{$options_desc_str}{$arguments_desc_str}
HELP;
        if($Command->help()){
            $help       .= <<<HELP

帮助:
{$Command->help()}

HELP;
        }
        
        $Processor->output()->print($help);
    }
    
    /**
     * 生成选项相关的帮助信息
     * 
     * @param CommandOptionCollectionInterface $CommandOptionCollection
     * @return string
     */
    private function makeOptionsDesc(CommandOptionCollectionInterface $CommandOptionCollection) : string
    {
        if(count($CommandOptionCollection) == 0 ){
            return '';
        }
        
        $result             = <<<RESULT
    选项:

RESULT;
        
        /**
         * @var CommandOptionInterface $CommandOption
         * @var array $raw_strs
         */
        $raw_strs           = [];
        $max_name_strlen    = 0;
        foreach($CommandOptionCollection AS $CommandOption){
            $name_str   = '--' . $CommandOption->getName();
            $desc_str   = $CommandOption->getDesc();
            
            if($short_name  = $CommandOption->getShortName()){
                $name_str   = '-' . $short_name . ', ' . $name_str;
            }else{
                $name_str   = '    ' . $name_str;
            }
            
            if(($default_value = $CommandOption->getDefaultValue()) !== null){
                $desc_str   = $desc_str . ' 默认值[' . $default_value . ']';
            }
            
            if($max_name_strlen < strlen($name_str)){
                $max_name_strlen    = strlen($name_str);
            }
            
            $raw_strs[] = [
                'name'  => $name_str,
                'desc'  => $desc_str,
            ];
        }
        
        foreach($raw_strs AS $raw_str){
            $name   = $raw_str['name'];
            $name   = str_pad($name, $max_name_strlen + 1, ' ', STR_PAD_RIGHT);
            $desc   = $raw_str['desc'];
            
            $options_desc_raw   = <<<RAW
        {$name} {$desc}

RAW;
            $result = $result . $options_desc_raw;
        }        
        
        return $result;
    }
    
    /**
     * 生成参数相关的帮助信息
     * 
     * @param CommandArgumentCollectionInterface $CommandArgumentCollection
     * @return string
     */
    private function makeArgumentsDesc(CommandArgumentCollectionInterface $CommandArgumentCollection) : string
    {
        if(count($CommandArgumentCollection) == 0){
            return '';
        }
        
        $result             = <<<RESULT
    参数(按照下列参数顺序依次通过命令行传入):

RESULT;
        
        /**
         * @var CommandArgumentInterface $CommandArgument
         * @var array $raw_strs
         */
        $raw_strs           = [];
        $max_name_strlen    = 0;
        foreach($CommandArgumentCollection AS $CommandArgument){
            $name_str           = $CommandArgument->getName();
            $required_str       = $CommandArgument->isRequired() ? '[必填]' : '[选填]';
            $desc_str           = $CommandArgument->getDesc();
            $default_value_str  = '';
            if(($default_value = $CommandArgument->getDefaultValue()) !== ''){
                $default_value_str  = "默认值[{$default_value}]";
            }
            
            if($max_name_strlen < strlen($name_str)){
                $max_name_strlen    = strlen($name_str);
            }
            
            $raw_strs[]             = [
                'name'              => $name_str,
                'required'          => $required_str,
                'desc'              => $desc_str,
                'default_value'     => $default_value_str,
            ];
        }
        
        foreach($raw_strs AS $raw_str){
            $name   = $raw_str['name'];
            $name   = str_pad($name, $max_name_strlen + 1, ' ', STR_PAD_RIGHT);
            $desc   = implode(' ', [$raw_str['required'], $raw_str['desc'], $raw_str['default_value']]);
            
            $arguments_desc_raw   = <<<RAW
        {$name} {$desc}

RAW;
        $result = $result . $arguments_desc_raw;
        }
        
        return $result;
    }

    /**
     *
     * {@inheritDoc}
     * @see \asbamboo\console\command\CommandInterface::desc()
     */
    public function desc() : string
    {
        return '获取帮助信息';
    }

    /**
     *
     * {@inheritDoc}
     * @see \asbamboo\console\command\CommandInterface::help()
     */
    public function help() : string
    {
        $console    = $_SERVER['SCRIPT_FILENAME'];
        $help       = Constant::ASBAMBOO_CONSOLE_HELP;
        $list       = Constant::ASBAMBOO_CONSOLE_LISTS;
        
        return <<<HELP
    例如：查看{$list}命令的帮助信息
        php {$console} {$help} {$list}
    可以省略command_name参数
        php {$console} {$help}

HELP;
    }
}