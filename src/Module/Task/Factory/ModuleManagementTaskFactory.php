<?php
namespace Woodhouse\Module\Task\Factory;

use Pimple\Container;
use Woodhouse\Module\ModuleCommand;
use Woodhouse\Module\Task\Enabling;
use Woodhouse\Module\Task\Installing;
use Woodhouse\Module\Task\Listing;
use Woodhouse\Module\Task\Removing;
use Woodhouse\Module\Task\Running;
use Woodhouse\Module\Task\Saving;
use Woodhouse\Module\Task\Updating;
use Woodhouse\Task\ITask;
use SimilarText\Finder;
use Symfony\Component\Console\Input\InputInterface;

/**
 * Class TaskFactory
 *
 * @package Woodhouse\Alias\Task\Factory
 * @author  Raphaël Lefebvre <raphael@raphaellefebvre.be>
 */
class ModuleManagementTaskFactory
{
    /**
     * @param InputInterface $input
     * @param Container      $services
     * @return ITask
     */
    public static function create(InputInterface $input, Container $services)
    {

        if(!$input->getArgument('action')) {
            throw new \InvalidArgumentException(sprintf('An action param is required: %s', json_encode(ModuleCommand::$actions)));
        }

        if($input->getArgument('action') === 'list') {
            return new Listing($services);
        }
        if($input->getArgument('action') === 'install') {
            return new Installing($services);
        }
        if($input->getArgument('action') === 'update') {
            return new Updating($services);
        }
        if($input->getArgument('action') === 'rm' || $input->getArgument('action') === 'remove') {
            if(!$input->getArgument('name')) {
                throw new \InvalidArgumentException('name param is mandatory for this action');
            }
            return new Removing($services);
        }
        if($input->getArgument('action') === 'enable') {
            if(!$input->getArgument('name')) {
                throw new \InvalidArgumentException('name param is mandatory for this action');
            }
            return new Enabling($services);
        }
        if($input->getArgument('action') === 'disable') {
            if(!$input->getArgument('name')) {
                throw new \InvalidArgumentException('name param is mandatory for this action');
            }
            return new Enabling($services);
        }
        if($input->getArgument('action') === 'run') {
            return new Running($services);
        }

        $textFinder = new Finder($input->getArgument('action'), ModuleCommand::$actions);
        throw new \InvalidArgumentException(
            sprintf(
                'Action "%s" not supported. Did you mean "%s"?',
                $input->getArgument('action'),
                $textFinder->first()
            )
        );
    }
}
