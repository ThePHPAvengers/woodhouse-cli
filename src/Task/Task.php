<?php
namespace Woodhouse\Task;

use Pimple\Container;
use Woodhouse\Service\ServiceWorker;

/**
 * Class Task
 *
 * @package Woodhouse\Task
 * @author  Raphaël Lefebvre <raphael@raphaellefebvre.be>
 */
abstract class Task implements ITask
{
    use ServiceWorker;

    /**
     * @param Container $services
     */
    public function __construct(Container $services)
    {
        $this->setServices($services);
    }
}
