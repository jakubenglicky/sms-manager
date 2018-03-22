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
    private $recepitiens;

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
     * @param array $recepitiens
     * @throws UndefinedNumberException
     */
    public function setTo(array $recepitiens)
    {
        if (count($recepitiens) < 1) {
            throw new UndefinedNumberException('Define at least one number!', 201);
        }

        $this->recepitiens = $recepitiens;
    }

    /**
     * Set body of SMS
     * @param string $text
     * @throws TextException
     */
    public function setBody(string $text)
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
    public function setMessageType(string $type)
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
    public function getRecepitiens():array
    {
        return $this->recepitiens;
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
