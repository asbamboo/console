<?php
namespace asbamboo\framework\console\_test\command;

use PHPUnit\Framework\TestCase;
use asbamboo\console\command\CommandArgument;

/**
 * 
 * @author 李春寅 <licy2013@aliyun.com>
 * @since 2018年8月3日
 */
class CommandArgumentTest extends TestCase
{    
    /**
     * 
     */
    public function testGetName()
    {
        $CommandArgument    = new CommandArgument('name', 'desc', 'value', 1);
        $this->assertEquals('name', $CommandArgument->getName());
    }
    
    /**
     * 
     */
    public function testGetPosition()
    {
        $CommandArgument    = new CommandArgument('name', 'desc', 'value', 1);
        $this->assertEquals(1, $CommandArgument->getPosition());
    }
    
    /**
     * 
     */
    public function testIsRequired()
    {
        $CommandArgument    = new CommandArgument('name', 'desc', 'value', 1, true);
        $this->assertEquals(true, $CommandArgument->isRequired());
    }
    
    /**
     * 
     */
    public function testGetDesc()
    {
        
        $CommandArgument    = new CommandArgument('name', 'desc', 'value', 1, true);
        $this->assertEquals('desc', $CommandArgument->getDesc());
    }
    
    /**
     * 
     */
    public function testGetDefaultValue()
    {
        $CommandArgument    = new CommandArgument('name', 'desc', 'value', 1);
        $this->assertEquals('value', $CommandArgument->getDefaultValue());
    }
}