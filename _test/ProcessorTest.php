<?php
namespace asbamboo\framework\_test\console;

use PHPUnit\Framework\TestCase;
use asbamboo\console\Processor;

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
        $Processor->exec();
    }
}