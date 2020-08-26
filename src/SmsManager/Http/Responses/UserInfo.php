<?php declare(strict_types = 1);

/**
 * Part of jakubenglicky/sms-manager
 *
 * @author Jakub Englický
 */

namespace SmsManager\Http\Response;

use Psr\Http\Message\ResponseInterface;

final class UserInfo
{
    /**
     * @var string $body
     */
    private $body;

    /*
     * @var float $credit
     */
    private $credit;

    /** @var string $sender */
    private $sender;

    /**
     * @var string $messageType
     */
    private $messageType;

    /**
     * UserInfo constructor.
     *
     * @param \Psr\Http\Message\ResponseInterface $response
     */
    public function __construct(ResponseInterface $response)
    {
        $this->body = trim((string)$response->getBody());

        $items = explode('|', $this->body);

        [$this->credit, $this->sender, $this->messageType] = $items;
    }

    /**
     * Get full response message
     *
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * Get credit info
     *
     * @return float
     */
    public function getCreditInfo(): float
    {
        return (float) $this->credit;
    }

    /**
     * Get sender
     *
     * @return string
     */
    public function getSender(): string
    {
        return $this->sender;
    }

    /**
     * Get default message type
     *
     * @return string
     */
    public function getDefaultMessageType(): string
    {
        return $this->messageType;
    }
}
