<?php
namespace Woodhouse\Project\Task\Factory;

use Pimple\Container;
use Woodhouse\Project\Task\ComposerConfigSetting;
use Woodhouse\Project\Task\FilesCleaning;
use Woodhouse\Project\Task\BootstrapImportation;
use Woodhouse\Project\Task\ModulesRunning;
use Woodhouse\Task\ITask;
use Woodhouse\Task\Planner;

/**
 * Class ProjectCreation
 *
 * @package Woodhouse\Project\Task\Factory
 * @author  Raphaël Lefebvre <raphael@raphaellefebvre.be>
 */
class BootstrapImportationTaskFactory
{
    /**
     * @param Container $services
     * @return ITask
     */
    public function create(Container $services)
    {
        return new Planner(
            [
            ProjectInitializationTaskFactory::create($services),
            new BootstrapImportation($services),
            new ComposerConfigSetting($services),
            new ModulesRunning($services),
            ]
        );
    }
}
