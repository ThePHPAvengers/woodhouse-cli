<?php
namespace Woodhouse\Project;

/**
 * Class Packages
 *
 * @package Woodhouse\Project
 * @author  Raphaël Lefebvre <raphael@raphaellefebvre.be>
 */
class Packages extends \ArrayObject
{
    /**
     * @return array
     */
    public function toArray()
    {
        $result = [];
        foreach($this as $package){
            $result[$package->getPsr()][$package->getNamespace()] = $package->getPathList();
        }
        return $result;
    }
}
