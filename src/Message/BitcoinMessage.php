<?php

namespace App\Message;

class BitcoinMessage 
{
    private string $data;

    public function __construct(string $data)
    {
        $this->data = $data;
    }

    public function getData(): self
    {
        return $this;
    }

    public function __toString()
    {
        return $this->data;
    }
}