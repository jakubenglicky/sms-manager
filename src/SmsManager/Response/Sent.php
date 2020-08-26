<?php declare(strict_types = 1);

/**
 * Part of jakubenglicky/sms-manager
 *
 * @author Jakub Englický
 */

namespace SmsManager\Response;

final class Sent
{

    /**
     * @var string $body
     */
    private $body;

    /**
     * @var bool $sent
     */
    private $sent;

    /**
     * @var int $code
     */
    private $code;

    /**
     * @var int $requestId
     */
    private $requestId;

    /**
     * @var \SmsManager\Message\Message
     */
    private $message;


    public function __construct(bool $sent, string $body, int $responseCode, int $requestId, \SmsManager\Message\Message $message)
    {
    	$this->sent = $sent;
    	$this->body = $body;
        $this->code = $responseCode;
        $this->requestId = $requestId;
        $this->message = $message;
    }


    public function wasSent(): bool
    {
        return $this->sent;
    }


    public function getCode(): int
    {
        return $this->code;
    }


    public function getBody(): string
    {
        return $this->body;
    }


    public function getRequestId(): int
    {
        return $this->requestId;
    }


    public function getMessage(): \SmsManager\Message\Message
    {
        return $this->message;
    }
}
