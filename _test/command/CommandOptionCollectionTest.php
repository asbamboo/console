<?php
namespace asbamboo\framework\console\_test\command;

use PHPUnit\Framework\TestCase;
use asbamboo\console\command\CommandOptionCollection;
use asbamboo\console\command\CommandOption;
use asbamboo\console\command\CommandOptionInterface;

/**
 *
 * @author 李春寅 <licy2013@aliyun.com>
 * @since 2018年8月2日
 */
class CommandOptionCollectionTest extends TestCase
{

    /**
     *
     */
    public function testAppend()
    {
        $CommandOptionCollection    = new CommandOptionCollection();
        $CommandOption              = new CommandOption('test1');
        $CommandOptionCollection    = $CommandOptionCollection->append($CommandOption);
        $CommandOption              = new CommandOption('test2');
        $CommandOptionCollection    = $CommandOptionCollection->append($CommandOption);
        $this->assertInstanceOf(CommandOptionCollection::class, $CommandOptionCollection);
        return $CommandOptionCollection;
    }

    /**
     * @depends testAppend
     */
    public function testMain($CommandOptionCollection)
    {
        foreach($CommandOptionCollection AS $CommandOption){
            $this->assertInstanceOf(CommandOptionInterface::class, $CommandOption);
        }
    }
}