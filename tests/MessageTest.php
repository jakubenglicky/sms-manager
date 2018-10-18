<?php

namespace jakubenglicky\SmsManager\Tests;

use jakubenglicky\SmsManager\Message\Message;
use jakubenglicky\SmsManager\Message\MessageType;
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

        $this->message->setBody('Test message');
        $this->message->setMessageType(MessageType::ECONOMY);
    }

    public function testInstance()
    {
        Assert::true($this->message instanceof Message);
    }

    public function testSetTo()
    {
        $this->message->setTo([420722111333]);

        Assert::true(is_array($this->message->getRecipients()));
        Assert::same(420722111333, $this->message->getRecipients()[0]);

        $this->message->setTo([420722111333,733456879]);

        Assert::true(is_array($this->message->getRecipients()));
        Assert::same(733456879, $this->message->getRecipients()[1]);
    }

    public function testSetBody()
    {
        $this->message->setBody('Test message');
        Assert::same('Test message', $this->message->getBody());
    }

    public function testMessageType()
    {
        $this->message->setMessageType(MessageType::ECONOMY);
        Assert::same('economy', $this->message->getMessageType());

        $this->message->setMessageType(MessageType::HIGH);
        Assert::same('high', $this->message->getMessageType());

        $this->message->setMessageType(MessageType::LOWCOST);
        Assert::same('lowcost', $this->message->getMessageType());
    }
}

(new MessageTest())->run();
