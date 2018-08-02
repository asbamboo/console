<?php
namespace asbamboo\framework\console\_test;

use PHPUnit\Framework\TestCase;
use asbamboo\console\Processor;
use asbamboo\console\Constant;

/**
 *
 * @author 李春寅 <licy2013@aliyun.com>
 * @since 2018年7月31日
 */
class ProcessorTest extends TestCase
{
    /**
     *
     */
    public function testExec()
    {
        $Processor  = new Processor();
        ob_start();
        $Processor->exec();
        $content    = ob_get_contents();
        ob_end_clean();

        $this->assertContains(Constant::ASBAMBOO_CONSOLE_LISTS, $content);
    }
}