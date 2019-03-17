<?php
namespace asbamboo\console;

/**
 *
 * @author 李春寅 <licy2013@aliyun.com>
 * @since 2018年8月3日
 */
class Output implements OutputInterface
{
    /**
     *
     * @var string
     */
    private $enable = true;

    /**
     *
     * {@inheritDoc}
     * @see \asbamboo\console\OutputInterface::enable()
     */
    public function enable() : OutputInterface
    {
        $this->enable = true;
        return $this;
    }

    /**
     *
     * {@inheritDoc}
     * @see \asbamboo\console\OutputInterface::disable()
     */
    public function disable() : OutputInterface
    {
        $this->enable   = false;
        return $this;
    }

    /**
     *
     * {@inheritDoc}
     * @see \asbamboo\console\OutputInterface::isEnable()
     */
    public function isEnable() : bool
    {
        return $this->enable;
    }

    /**
     *
     * {@inheritDoc}
     * @see \asbamboo\console\OutputInterface::print()
     */
    public function print(string ...$args) : void
    {
        if($this->isEnable()){
            foreach($args AS $arg){
                print $arg;
            }
        }
    }

    /**
     *
     * {@inheritDoc}
     * @see \asbamboo\console\OutputInterface::println()
     */
    public function println(string ...$args) : void
    {
        if($this->isEnable()){
            foreach($args AS $arg){
                print $arg;
                print "\r\n";
            }
        }
    }
}