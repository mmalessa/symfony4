<?php
namespace App\Application\Command;
trait PayloadTrait
{
    protected $payload;

    public function __construct(array $payload)
    {
        //$this->init();
        $this->setPayload($payload);
    }

    public function payload()
    {
        return $this->payload;
    }

    protected function setPayload(array $payload)
    {
        $this->payload = $payload;
    }
}