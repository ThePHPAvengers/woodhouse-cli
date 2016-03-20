<?php
namespace Woodhouse\Project\Question;

use Woodhouse\Project\Project;

/**
 * Class Question
 *
 * @package Woodhouse\Project\Question
 * @author  Raphaël Lefebvre <raphael@raphaellefebvre.be>
 */
abstract class Question extends \Woodhouse\Task\Question
{

    /**
     * Getter of $project
     *
     * @return Project
     */
    protected function getProject()
    {
        return $this->getService('project');
    }
}
