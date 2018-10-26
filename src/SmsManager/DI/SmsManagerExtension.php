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
    public function loadConfiguration(): void
    {
        if (!isset($this->config['apiKey'])) {
            return;
        }

        $builder = $this->getContainerBuilder();

        $builder->addDefinition('smsmanager')
            ->setFactory(Client::class, [$this->config['apiKey']]);
    }
}
