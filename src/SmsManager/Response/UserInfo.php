<?php declare(strict_types = 1);

/**
 * Part of jakubenglicky/sms-manager
 *
 * @author Jakub Englický
 */

namespace SmsManager\Response;

final class UserInfo
{

    /**
     * @var float $credit
     */
    private $credit;

    /** @var string $sender */
    private $sender;

    /**
     * @var string $messageType
     */
    private $messageType;


    public function __construct(
    	float $credit,
		string $sender,
		string $messageType
    )
    {
	    $this->credit = $credit;
	    $this->sender = $sender;
	    $this->messageType = $messageType;
    }


    public function getCredit(): float
    {
        return (float) $this->credit;
    }


    public function getSender(): string
    {
        return $this->sender;
    }


    public function getMessageType(): string
    {
        return $this->messageType;
    }

}
