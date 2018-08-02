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
     *
     */
    private $server_args;

    /**
     *
     * @var string
     */
    private $command_name;

    /**
     *
     * @var array
     */
    private $options;

    /**
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
        $this->server_args  = $server_args?:[];
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
        return $this->command_name;
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
     * 解析控制台传入的参数信息
     */
    private function parseArgv() : void
    {
        foreach( $this->server_args AS $arg ){
            if(strncmp('-', $arg, 1) === 0){
                $this->options[]        = $arg;
            }else if(empty( $this->command_name )){
                $this->command_name     = $arg;
            }else{
                $this->arguments[]    = $arg;
            }
        }
    }
}
