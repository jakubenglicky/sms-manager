<?php

namespace jakubenglicky\SmsManager;

use jakubenglicky\SmsManager\Exceptions\TextException;
use jakubenglicky\SmsManager\Exceptions\UndefinedNumberException;

class Message
{
    /**
     * @var array of phone numbers
     */
    private $numbers;

    /**
     * @var string
     */
    private $messageType;

    /**
     * @var string
     */
    private $text;

    /**
     * Types of message type (gateway)
     */
    const MessageTypeEconomy = 'economy';
    const MessageTypeHigh = 'high';
    const MessageTypeLowCost = 'lowcost';

    public function __construct()
    {
        $this->setMessageType();
    }

    /**
     * Set array of recepitiens
     * @param array $numbers
     */
    public function setTo(array $numbers)
    {
        if (count($numbers) < 1) {
            throw new UndefinedNumberException('Define at least one number!', 201);
        }

        $this->numbers = $numbers;
    }

    /**
     * Set body of SMS
     * @param $text
     */
    public function setBody($text)
    {
        if (empty($text)) {
            throw new TextException('Text of SMS does not exist or is too long!', 202);
        }

        $this->text = $text;
    }

    /**
     * Set message (gateway) type
     * @param $type
     */
    public function setMessageType($type = self::MessageTypeEconomy)
    {
        $this->messageType = $type;
    }

    /**
     * Get text
     * @return string
     */
    public function getBody()
    {
        return $this->text;
    }

    /**
     * Get numbers in string for API
     * @return array
     */
    public function getNumbers()
    {
        return implode(',',$this->numbers);
    }

    /**
     * Get string of message type
     * @return string
     */
    public function getMessageType()
    {
        return $this->messageType;
    }


}
