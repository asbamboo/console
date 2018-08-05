<?php
namespace asbamboo\framework\console\_test\command;

use PHPUnit\Framework\TestCase;
use asbamboo\console\command\CommandArgumentCollection;
use asbamboo\console\command\CommandArgument;
use asbamboo\console\command\CommandArgumentInterface;
use asbamboo\console\command\CommandArgumentCollectionInterface;

/**
 * 
 * @author 李春寅 <licy2013@aliyun.com>
 * @since 2018年8月3日
 */
class CommandArgumentCollectionTest extends TestCase
{
    
    /**
     *
     */
    public function testAppend()
    {
        $CommandArgumentCollection  = new CommandArgumentCollection();
        $CommandArgument            = new CommandArgument('test1');
        $CommandArgumentCollection  = $CommandArgumentCollection->append($CommandArgument);
        $CommandArgument            = new CommandArgument('test2');
        $CommandArgumentCollection  = $CommandArgumentCollection->append($CommandArgument);
        $this->assertInstanceOf(CommandArgumentCollection::class, $CommandArgumentCollection);
        
        return $CommandArgumentCollection;
    }
    
    /**
     * @depends testAppend
     */
    public function testGet(CommandArgumentCollectionInterface $CommandArgumentCollection)
    {
        $this->assertInstanceOf(CommandArgumentInterface::class, $CommandArgumentCollection->get('test1'));
    }
    
    /**
     * @depends testAppend
     */
    public function testMain(CommandArgumentCollectionInterface $CommandArgumentCollection)
    {
        $this->assertEquals(count($CommandArgumentCollection), count($CommandArgumentCollection->getIterator()));
        foreach($CommandArgumentCollection AS $CommandArgument){
            $this->assertInstanceOf(CommandArgumentInterface::class, $CommandArgument);
        }
    }
}