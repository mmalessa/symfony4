<?php
namespace App\Application\Command;

class AddDomain
{
    private $id, $name, $groupId;

    public function __construct($id, $name, $groupId)
    {
        $this->id = $id;
        $this->name = $name;
        $this->groupId = $groupId;
    }

    public function getId()
    {
        return $this->id;
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