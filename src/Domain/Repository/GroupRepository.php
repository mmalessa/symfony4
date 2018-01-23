<?php
namespace App\Domain\Repository;

interface GroupRepository
{
    public function get($id);
    public function add($id, $name);
    public function delete($id);
    public function getRandom();
}