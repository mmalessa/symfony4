<?php
namespace App\Application\Command;

class ModifyDomains
{
    private $ids;

    public function __construct(Array $ids)
    {
        $this->ids = $ids;
    }

    public function getIds()
    {
        return $this->ids;
    }
}