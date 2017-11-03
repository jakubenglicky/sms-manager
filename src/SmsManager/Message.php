<?php

namespace jakubenglicky\SmsManager;

class Message
{
    public $numbers;
    public $messageType;
    public $text;

    const MessageTypeEconomy = 'economy';

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

    }

    /**
     * @param $type
     */
    public function setMessageType($type)
    {

    }


}
