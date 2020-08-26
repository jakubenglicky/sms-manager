<?php declare(strict_types = 1);

namespace SmsManager\Exceptions;

final class Processor
{

	public static function process(\Exception $exception)
	{
		$response = \explode('response:', $exception->getMessage());

		if (\count($response) > 1) {
			$response = \trim($response[1]);
			$items = \explode('|', $response);

			$code = (int) $items[1];

			if ($exception->getCode() === 400 && $code === 102) {
				throw new \SmsManager\Exceptions\WrongDataFormatException('Sent data is in wrong format!', $code);
			}

			if ($exception->getCode() === 401 && $code === 103) {
				throw new \SmsManager\Exceptions\InvalidCredentialsException('Check your SMS Manager credentials!', $code);
			}

			if ($exception->getCode() === 400 && $code === 104) {
				throw new \SmsManager\Exceptions\UnknownMessageTypeException('Unknown type of message!', $code);
			}

			if ($exception->getCode() === 402 && $code === 105) {
				throw new \SmsManager\Exceptions\CreditException('Your credit is too low for sending SMS!', $code);
			}

			if ($exception->getCode() === 400 && $code === 109) {
				throw new \SmsManager\Exceptions\ContentException('Your request does not contain all compulsory items!', $code);
			}

			if ($exception->getCode() === 400 && $code === 201) {
				throw new \SmsManager\Exceptions\UndefinedNumberException('Define at least one number!', $code);
			}

			if ($exception->getCode() === 400 && $code === 202) {
				throw new \SmsManager\Exceptions\TextException('Text of SMS does not exist or is too long!', $code);
			}

			if ($exception->getCode() === 400 && $code === 203) {
				throw new \SmsManager\Exceptions\SenderException('Invalid parameter. You must defined sender in your SMS Manager account!', $code);
			}

			if ($exception->getCode() === 500 || $exception->getCode() === 503) {
				throw new \SmsManager\Exceptions\ApiException('Unspecified problem on the SMS Manager side. You can contact support@smsmanager.cz', $exception->getCode());
			}
		} else {
			throw new \Exception($exception->getMessage(), $exception->getCode());
		}
	}

}
