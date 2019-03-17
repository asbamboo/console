<?php
namespace asbamboo\framework\console\_test;

use PHPUnit\Framework\TestCase;
use asbamboo\console\Output;

/**
 *
 * @author 李春寅 <licy2013@aliyun.com>
 * @since 2018年8月3日
 */
class OutputTest extends TestCase
{
    /**
     *
     */
    public function testIsEnable()
    {
        $Output = new Output();
        $this->assertEquals($Output->isEnable(), true);
        $Output->disable();
        $this->assertEquals($Output->isEnable(), false);
        $Output->enable();
        $this->assertEquals($Output->isEnable(), true);
    }



    public function testPrint()
    {
        $Output = new Output();
        ob_start();
        $Output->print('a', 'b', 'c');
        $Output->disable();
        $Output->print('a', 'b', 'c');
        $p  = ob_get_contents();
        ob_end_clean();
        $this->assertEquals('abc', $p);
    }

    public function testPrintln()
    {
        $Output = new Output();
        ob_start();
        $Output->println('a', 'b', 'c');
        $Output->disable();
        $Output->print('a', 'b', 'c');
        $p  = ob_get_contents();
        ob_end_clean();
        $this->assertEquals("a\r\nb\r\nc\r\n", $p);
    }
}