<?php declare(strict_types=1);

/**
 * Part of jakubenglicky/sms-manager
 * @author Jakub Englický
 */

namespace SmsManager\Message;

use SmsManager\Exceptions\TextException;
use SmsManager\Exceptions\UndefinedNumberException;
use SmsManager\Exceptions\WrongDataFormatException;
use SmartEmailing\Types\InvalidTypeException;
use SmartEmailing\Types\PhoneNumber;

final class Message
{
    /**
     * @var array|null
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
     * Set array of numbers
     * @param array $numbers
     * @throws UndefinedNumberException
     * @throws WrongDataFormatException
     */
    public function setTo(array $numbers):void
    {
        if (empty($numbers)) {
            throw new UndefinedNumberException('Define at least one number!', 201);
        }

        $recipients = null;

        foreach ($numbers as $number) {
            try {
                $recipients[] = Phonenumber::from($number);
            } catch (InvalidTypeException $invalidTypeException) {
                throw new WrongDataFormatException($invalidTypeException->getMessage());
            }
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
     * Get array of PhoneNumber objects
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
     * Return numbers in comma separate string
     * @return string
     * @throws UndefinedNumberException
     */
    public function getCommaSeparateNumbers():string
    {
        return str_replace('+', '', implode(',', $this->getRecipients()));
    }

    /**
     * Get string of message type
     * @return string
     */
    public function getMessageType():string
    {
        return $this->messageType;
    }

    /**
     * @deprecated
     * @throws UndefinedNumberException
     */
    public function getRecepitiens()
    {
        return $this->getRecipients();
    }
}
