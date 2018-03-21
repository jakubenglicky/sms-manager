<?php

/**
 * Part of jakubenglicky/sms-manager
 * @author Jakub Englický
 */

namespace jakubenglicky\SmsManager\Message;

use jakubenglicky\SmsManager\Exceptions\TextException;
use jakubenglicky\SmsManager\Exceptions\UndefinedNumberException;

class Message
{
    /**
     * @var array of phone numbers
     */
    private $numbers;

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
     * Set array of recepitiens
     * @param array $numbers
     * @throws UndefinedNumberException
     */
    public function setTo(array $numbers):void
    {
        if (count($numbers) < 1) {
            throw new UndefinedNumberException('Define at least one number!', 201);
        }

        $this->numbers = $numbers;
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
     * @return string
     */
    public function getBody():string
    {
        return $this->text;
    }

    /**
     * Get numbers in string for API
     * @return array
     */
    public function getNumbers():array
    {
        return $this->numbers;
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
