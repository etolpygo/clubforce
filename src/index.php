<?php
echo "Welcome to PHP" . PHP_EOL;
echo "--- " .PHP_VERSION . PHP_EOL;
echo "--------------" . PHP_EOL;


require('vendor/autoload.php');
use PHPUnit\Framework\TestCase;
class UserTest extends TestCase {
    public function testExample() {
        $expected = 'hoge';
        $this->assertEquals($expected, 'hoge');
    }
}