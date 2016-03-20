<?php
namespace Woodhouse\Command;

use Pimple\Container;
use Woodhouse\Service\ServiceWorker;
use Symfony\Component\Console\Command\Command as SymfonyCommand;

/**
 * Class Command
 *
 * @package Woodhouse
 * @author  Raphaël Lefebvre <raphael@raphaellefebvre.be>
 */
class Command extends SymfonyCommand
{
    use ServiceWorker;

    /**
     * @param Container $services
     */
    public function __construct(Container $services)
    {
        $this->setServices($services);
        parent::__construct();
    }
}
