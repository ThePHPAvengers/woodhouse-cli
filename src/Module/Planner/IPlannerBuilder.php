<?php
namespace Woodhouse\Module\Planner;

use Woodhouse\Task\Planner;

/**
 * Interface IPlannerBuilder
 *
 * @package Woodhouse\Module\Planner
 * @author  Raphaël Lefebvre <raphael@raphaellefebvre.be>
 */
interface IPlannerBuilder
{
    /**
     * @return Planner
     */
    public function create();

    /**
     * @return string
     */
    public function getName();

    /**
     * @return int
     */
    public function count();
}
