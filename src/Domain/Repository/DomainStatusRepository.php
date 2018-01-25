<?php

namespace App\Domain\Repository;

interface DomainStatusRepository
{
    public function get($id);
    public function getAll();
    public function getImportantOnly();
}