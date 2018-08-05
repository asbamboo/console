<?php
namespace asbamboo\console\command;

/**
 * 
 * @author 李春寅 <licy2013@aliyun.com>
 * @since 2018年8月3日
 */
class CommandArgument implements CommandArgumentInterface
{
    /**
     * 
     * @var string
     */
    private $name;
    
    /**
     * 
     * @var int
     */
    private $position;
    
    /**
     * 
     * @var string
     */
    private $default_value;
    
    /**
     * 
     * @var bool
     */
    private $is_require;

    /**
     * 
     * @var string
     */
    private $desc;
    
    /**
     * 
     * @param string $name
     * @param string $default_value
     * @param int $position
     */
    public function __construct(string $name, string $desc = '', string $default_value = '', int $position = 0, bool $is_require = false)
    {
        $this->name             = $name;
        $this->default_value    = $default_value;
        $this->position         = $position;
        $this->is_require       = $is_require;
        $this->desc             = $desc;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \asbamboo\console\command\CommandArgumentInterface::getName()
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * 
     * {@inheritDoc}
     * @see \asbamboo\console\command\CommandArgumentInterface::getPosition()
     */
    public function getPosition(): int
    {
        return $this->position;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \asbamboo\console\command\CommandArgumentInterface::isRequired()
     */
    public function isRequired() : bool
    {
        return $this->is_require;
    }

    /**
     * 
     * {@inheritDoc}
     * @see \asbamboo\console\command\CommandArgumentInterface::getDesc()
     */
    public function getDesc() : string
    {
        return $this->desc;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \asbamboo\console\command\CommandArgumentInterface::getDefaultValue()
     */
    public function getDefaultValue() : string
    {
        return $this->default_value;
    }
}