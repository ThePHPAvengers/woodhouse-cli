<?php
namespace Woodhouse\Project;

/**
 * Class Authors
 *
 * @package Woodhouse\Project
 * @author  Raphaël Lefebvre <raphael@raphaellefebvre.be>
 */
class Authors extends \ArrayObject
{
    /**
     * @return array
     */
    public function toArray()
    {
        $result = [];
        foreach($this as $author){
            $result[] = $author->toArray();
        }
        return $result;
    }
}
