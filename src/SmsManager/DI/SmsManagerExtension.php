<?php declare(strict_types = 1);

/**
 * Part of jakubenglicky/sms-manager
 *
 * @author Jakub Englický
 */

namespace jakubenglicky\SmsManager\DI;

use jakubenglicky\SmsManager\Http\Client;
use Nette\DI\CompilerExtension;

class SmsManagerExtension extends CompilerExtension
{
	protected $defaults = [
		'apiKey' => null,
	];

    public function loadConfiguration(): void
    {
	    $config = $this->validateConfig($this->defaults);

        $builder = $this->getContainerBuilder();

        $builder->addDefinition('smsmanager')
            ->setFactory(Client::class, [$config['apiKey']]);
    }
}
