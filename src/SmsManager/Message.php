<?php

namespace jakubenglicky\SmsManager;

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
        $this->numbers = $numbers;
    }

    /**
     * Set body of SMS
     * @param $text
     */
    public function setBody($text)
    {
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
    public function getText()
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
