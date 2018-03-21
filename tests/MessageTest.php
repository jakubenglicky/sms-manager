<?php

namespace jakubenglicky\SmsManager\Tests;

use jakubenglicky\SmsManager\Message\Message;
use Tester\Assert;
use Tester\TestCase;

require_once __DIR__ ."/bootstrap.php";

 /**
 * @testCase
 */
class MessageTest extends TestCase
{
    /**
     * @var Message
     */
    private $message;

    public function __construct()
    {
        $this->message = new Message();
    }

    public function testInstance()
    {
        Assert::true($this->message instanceof Message);
    }
}

(new MessageTest())->run();
