<?php

namespace jakubenglicky\SmsManager;

class Message
{
    /**
     * @var array of phone numbers
     */
    public $numbers;

    /**
     * @var string
     */
    public $messageType;

    /**
     * @var string
     */
    public $text;

    const MessageTypeEconomy = 'economy';

    public function __construct()
    {
        $this->setMessageType();
    }

    /**
     * @param array $numbers
     */
    public function setTo(array $numbers)
    {
        $this->numbers = $numbers;
    }

    /**
     * @param $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * @param $type
     */
    public function setMessageType($type = self::MessageTypeEconomy)
    {
        $this->messageType = $type;
    }


}
