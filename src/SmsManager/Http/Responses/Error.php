<?php

/**
 * Part of jakubenglicky/sms-manager
 * @author Jakub Englický
 */

namespace SmsManager\Http\Response;

use SmsManager\Exceptions\ApiException;
use SmsManager\Exceptions\ContentException;
use SmsManager\Exceptions\CreditException;
use SmsManager\Exceptions\InvalidCredentialsException;
use SmsManager\Exceptions\SenderException;
use SmsManager\Exceptions\TextException;
use SmsManager\Exceptions\UndefinedNumberException;
use SmsManager\Exceptions\UnknownMessageTypeException;
use SmsManager\Exceptions\WrongDataFormatException;

final class Error
{
    /**
     * ErrorResponse constructor.
     * @param \Exception $exception
     * @throws ApiException
     * @throws ContentException
     * @throws CreditException
     * @throws InvalidCredentialsException
     * @throws SenderException
     * @throws TextException
     * @throws UndefinedNumberException
     * @throws UnknownMessageTypeException
     * @throws WrongDataFormatException
     * @throws \Exception
     */
    public function __construct(\Exception $exception)
    {
        $response = explode('response:', $exception->getMessage());

        if (count($response) > 1) {
            $response = trim($response[1]);
            $items = explode('|', $response);

            $code = (int)$items[1];

            if ($exception->getCode() === 400 && $code === 102) {
                throw new WrongDataFormatException('Sent data is in wrong format!', $code);
            }

            if ($exception->getCode() === 401 && $code === 103) {
                throw new InvalidCredentialsException('Check your SMS Manager credentials!', $code);
            }

            if ($exception->getCode() === 400 && $code === 104) {
                throw new UnknownMessageTypeException('Unknown type of message!', $code);
            }

            if ($exception->getCode() === 402 && $code === 105) {
                throw new CreditException('Your credit is too low for sending SMS!', $code);
            }

            if ($exception->getCode() === 400 && $code === 109) {
                throw new ContentException('Your request does not contain all compulsory items!', $code);
            }

            if ($exception->getCode() === 400 && $code === 201) {
                throw new UndefinedNumberException('Define at least one number!', $code);
            }

            if ($exception->getCode() === 400 && $code === 202) {
                throw new TextException('Text of SMS does not exist or is too long!', $code);
            }

            if ($exception->getCode() === 400 && $code === 203) {
                throw new SenderException('Invalid parameter. You must defined sender in your SMS Manager account!', $code);
            }

            if ($exception->getCode() === 500 || $exception->getCode() === 503) {
                throw new ApiException('Unspecified problem on the SMS Manager side. You can contact support@smsmanager.cz', $exception->getCode());
            }
        } else {
            throw new \Exception($exception->getMessage(), $exception->getCode());
        }
    }
}
