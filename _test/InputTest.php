<?php
namespace asbamboo\framework\console\_test;

use PHPUnit\Framework\TestCase;
use asbamboo\console\Input;

/**
 *
 * @author 李春寅 <licy2013@aliyun.com>
 * @since 2018年8月2日
 */
class InputTest extends TestCase
{
    public function testPrompt()
    {
        $input  = new input(['console', 'command_name', '--test', 'arg']);
        $a      = $input->prompt('测试一下输入：');
        $this->assertTrue(is_string($a));
    }

    public function testCommandName()
    {
        $input  = new input(['console', 'command_name', '--test', 'arg']);
        $this->assertEquals('command_name', $input->commandName());
    }

    public function testArguments()
    {
        $input  = new input(['console', 'command_name', '--test', 'arg']);
        $this->assertEquals(['arg'], $input->arguments());
    }

    public function testOptions()
    {
        $input  = new input(['console', 'command_name', '--test', 'arg']);
        $this->assertEquals(['test'=>true], $input->options());
    }
}