<?php declare(strict_types=1);

use jakubenglicky\SmsManager\Http\Response\Sent;
use PHPUnit\Framework\TestCase;
use jakubenglicky\SmsManager\Message\Message;
use jakubenglicky\SmsManager\Tests\MockClient;

final class ClientTestUnit extends TestCase
{
    public function testSmsSend(): void
    {
        $msg = new Message();
        $msg->setTo(['+420777111222']);
        $msg->setBody('Test message');

        $client = new MockClient();

        $sent = $client->send($msg);

        $this->assertTrue($sent instanceof Sent);
        $this->assertTrue($sent instanceof Sent);
        $this->assertTrue($sent->wasSent());
        $this->assertTrue(is_integer($sent->getRequestId()));
        $this->assertTrue(is_string($sent->getBody()));
        $this->assertSame(count(explode('|', $sent->getBody())), 3);
        $this->assertTrue($sent->getMessage() instanceof Message);
        $this->assertSame($sent->getMessage()->getBody(), 'Test message');
    }

}

