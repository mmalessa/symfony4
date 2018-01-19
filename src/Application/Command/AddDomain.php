<?php
namespace App\Application\Command;

class AddDomain
{
    private $name, $groupId;

    public function __construct($name, $groupId)
    {
        $this->name = $name;
        $this->groupId = $groupId;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getGroupId()
    {
        return $this->groupId;
    }
}