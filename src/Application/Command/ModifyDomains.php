<?php
namespace App\Application\Command;

class ModifyDomains
{
    private $ids;
    private $groupId;

    public function __construct(Array $ids, $groupId)
    {
        $this->ids = $ids;
        $this->groupId = $groupId;
    }

    public function getIds()
    {
        return $this->ids;
    }

    public function getGroupId()
    {
        return $this->groupId;
    }
}