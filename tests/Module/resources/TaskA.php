<?php
namespace Woodhouse\Module\resources;

use Woodhouse\Task\ITask;
use Woodhouse\Task\Task;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class TaskA
 * @package Woodhouse\Module\Planner\resources
 * @author Raphaël Lefebvre <raphael@raphaellefebvre.be>
 */
class TaskA extends Task
{

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $output->write('A');
        return ITask::NO_ERROR_CODE;
    }
}
