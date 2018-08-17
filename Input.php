<?php
namespace asbamboo\console;

/**
 *
 * @author 李春寅 <licy2013@aliyun.com>
 * @since 2018年8月2日
 */
class Input implements InputInterface
{
    /**
     * 所有从控制台获取的参数
     */
    private $server_args;
  
    /**
     * 需要执行的命令名称
     *
     * @var string
     */
    private $command_name;

    /**
     * 选项信息
     *
     * @var array
     */
    private $options;

    /**
     * 简短选项信息
     *
     * @var array
     */
    private $short_options;
    
    /**
     * 参数信息
     *
     * @var array
     */
    private $arguments;

    /**
     * 解析控制台传入的参数信息
     */
    public function __construct(?array $server_args = null)
    {
        if(is_null($server_args)){
            $this->server_args  = $_SERVER['argv'];
        }
        $this->server_args  = $this->server_args?:$server_args;
        $this->parseArgv();
    }

    /**
     *
     * {@inheritDoc}
     * @see \asbamboo\console\InputInterface::prompt()
     */
    public function prompt(string $title) : string
    {
        if(function_exists('readline')){
            $value  = readline($title);
            return $value;
        }
        $fp = fopen("php://stdin","rb");
        $fp2 = fopen("php://stdout","wb");
        fwrite($fp2, $title);
        $value = fread($fp, 8192);
        fclose($fp2);
        fclose($fp);
        $value  = trim($value);
        return $value;
    }

    /**
     *
     * {@inheritDoc}
     * @see \asbamboo\console\InputInterface::commandName()
     */
    public function commandName() : string
    {
        return $this->command_name ?? Constant::ASBAMBOO_CONSOLE_LISTS;
    }

    /**
     *
     * {@inheritDoc}
     * @see \asbamboo\console\InputInterface::arguments()
     */
    public function arguments() : ?array
    {
        return $this->arguments;
    }

    /**
     *
     * {@inheritDoc}
     * @see \asbamboo\console\InputInterface::options()
     */
    public function options() : ?array
    {
        return $this->options;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \asbamboo\console\InputInterface::shortOptions()
     */
    public function shortOptions() : ?array
    {
        return $this->short_options;
    }

    /**
     * 解析控制台传入的参数信息
     */
    private function parseArgv() : void
    {
        if(is_null($this->server_args)){
            return;
        }
        foreach( $this->server_args AS $index => $arg ){
            if($index == 0){
                continue;
            }
            if(strncmp('--', $arg, 2) === 0){
                $options                = explode('=', $arg, 2);
                $name                   = ltrim($options[0], '-');
                $value                  = $options[1] ?? true;
                $this->options[$name]   = $value;
                if(in_array($name, ['help','h'])){
                    if(!empty($this->command_name)){
                        array_unshift($this->arguments, $this->command_name);
                    }
                    $this->command_name = Constant::ASBAMBOO_CONSOLE_HELP;
                }
            }else if(strncmp('-', $arg, 1) === 0){
                $options                = explode('=', $arg, 2);
                $name                   = ltrim($options[0], '-');
                $value                  = $options[1] ?? true;
                $this->short_options[$name]   = $value;
                if(in_array($name, ['help','h'])){
                    if(!empty($this->command_name)){
                        array_unshift($this->arguments, $this->command_name);
                    }
                    $this->command_name = Constant::ASBAMBOO_CONSOLE_HELP;
                }
            }else if(empty( $this->command_name )){
                $this->command_name     = $arg;
            }else{
                $this->arguments[]    = $arg;
            }
        }        
    }
}
