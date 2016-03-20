<?php
namespace Woodhouse\Project\Task\Factory;

use Pimple\Container;
use Woodhouse\Project\Question\AuthorQuestion;
use Woodhouse\Project\Question\BootstrapQuestion;
use Woodhouse\Project\Question\DescriptionQuestion;
use Woodhouse\Project\Question\DirectoryPathQuestion;
use Woodhouse\Project\Question\HomepageQuestion;
use Woodhouse\Project\Question\KeywordsQuestion;
use Woodhouse\Project\Question\NameQuestion;
use Woodhouse\Project\Question\PackageQuestion;
use Woodhouse\Task\ITask;
use Woodhouse\Task\Planner;

/**
 * Class ProjectInitialization
 *
 * @package Woodhouse\Project\Task\Factory
 * @author  Raphaël Lefebvre <raphael@raphaellefebvre.be>
 */
class ProjectInitializationTaskFactory
{
    /**
     * @param Container $services
     * @return ITask
     */
    public static function create(Container $services)
    {
        return new Planner(
            [
            new BootstrapQuestion($services),
            new NameQuestion($services),
            new DirectoryPathQuestion($services),
            new DescriptionQuestion($services),
            new HomepageQuestion($services),
            new KeywordsQuestion($services),
            new AuthorQuestion($services),
            new PackageQuestion($services),
            ]
        );
    }
}
