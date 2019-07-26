<?php
declare(strict_types=1);

namespace Tests\RabinKarp;

use PHPUnit\Framework\TestCase;
use RabinKarp\RabinKarp;

class RabinKarpTest extends TestCase
{
    public function testItFoundInArray(): void
    {
        $rabinKarp = new RabinKarp('this is my message');
        $pattern = ['this', 'our', 'new', 'message'];
        $expectedArray = [true, false, false, true];
        $actualArray = $rabinKarp->findInArray($pattern);

        $this->assertEquals($expectedArray, $actualArray);
    }

    public function testItFoundInString(): void
    {
        $rabinKarp = new RabinKarp('this is my message');
        $pattern = 'message';
        $expectedResult = true;
        $actualResult = $rabinKarp->findInString($pattern);

        $this->assertEquals($expectedResult, $actualResult);
    }
}
