<?php declare(strict_types=1);

/**
 * Part of jakubenglicky/sms-manager
 * @author Jakub Englický
 */

namespace jakubenglicky\SmsManager\Message;

use jakubenglicky\SmsManager\Exceptions\TextException;
use jakubenglicky\SmsManager\Exceptions\UndefinedNumberException;

final class Message
{
    /**
     * @var array of recipients
     */
    private $recipients;

    /**
     * @var string $messageType
     */
    private $messageType;

    /**
     * @var string $text
     */
    private $text;


    public function __construct()
    {
        $this->setMessageType(MessageType::ECONOMY);
    }

    /**
     * Set array of recipients
     * @param array $recipients
     * @throws UndefinedNumberException
     */
    public function setTo(array $recipients):void
    {
        if (empty($recipients)) {
            throw new UndefinedNumberException('Define at least one number!', 201);
        }

        $this->recipients = $recipients;
    }

    /**
     * Set body of SMS
     * @param string $text
     * @throws TextException
     */
    public function setBody(string $text):void
    {
        if (empty($text)) {
            throw new TextException('Text of SMS does not exist or is too long!', 202);
        }

        $this->text = $text;
    }

    /**
     * Set message (gateway) type
     * @param string $type
     */
    public function setMessageType(string $type):void
    {
        $this->messageType = $type;
    }

    /**
     * Get text
     * @throws TextException
     * @return string
     */
    public function getBody():string
    {
        if (empty($this->text)) {
            throw new TextException('Text of SMS does not exist or is too long!', 202);
        }
        return $this->text;
    }

    /**
     * Get numbers in string for API
     * @throws UndefinedNumberException
     * @return array
     */
    public function getRecipients():array
    {
        if (empty($this->recipients)) {
            throw new UndefinedNumberException('Define at least one number!', 201);
        }
        return $this->recipients;
    }

    /**
     * Get string of message type
     * @return string
     */
    public function getMessageType():string
    {
        return $this->messageType;
    }
}
