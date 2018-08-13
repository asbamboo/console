<?php
namespace asbamboo\framework\console\_test\command;

use PHPUnit\Framework\TestCase;
use asbamboo\console\command\CommandOption;

/**
 *
 * @author 李春寅 <licy2013@aliyun.com>
 * @since 2018年8月2日
 */
class CommandOptionTest extends TestCase
{
    /**
     *
     * @var CommandOption
     */
    static $CommandOption;

    /**
     *
     * {@inheritDoc}
     * @see \PHPUnit\Framework\TestCase::setUp()
     */
    public function setUp()
    {
        static::$CommandOption  = new CommandOption('test_name', 'test_defalut_value', 'test_desc', 'test_short_name');
    }

    /**
     *
     */
    public function testGetName()
    {
        $this->assertEquals(static::$CommandOption->getName(), 'test_name');
    }

    /**
     *
     */
    public function testGetDefaultValue()
    {
        $this->assertEquals(static::$CommandOption->getDefaultValue(), 'test_defalut_value');
    }

    /**
     *
     */
    public function testGetDesc()
    {
        $this->assertEquals(static::$CommandOption->getDesc(), 'test_desc');
    }

    /**
     *
     */
    public function testGetShortName()
    {
        $this->assertEquals(static::$CommandOption->getShortName(), 'test_short_name');
    }
}