<?php

namespace App\Entity;


use App\Repository\BitcoinRepository;
use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;
use ApiPlatform\Core\Annotation\ApiResource;



/**
 * @ORM\Entity(repositoryClass=BitcoinRepository::class)
 * @ApiResource(formats= {"json"})
 */
class Bitcoin implements JsonSerializable
{
 

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $USD;

    /**
     * @ORM\Column(type="float")
     */
    private $GBP;

    /**
     * @ORM\Column(type="float")
     */
    private $EUR;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $created_at;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUSD(): ?float
    {
        return $this->USD;
    }

    public function setUSD(float $USD): self
    {
        $this->USD = $USD;

        return $this;
    }

    public function getGBP(): ?float
    {
        return $this->GBP;
    }

    public function setGBP(float $GBP): self
    {
        $this->GBP = $GBP;

        return $this;
    }

    public function getEUR(): ?float
    {
        return $this->EUR;
    }

    public function setEUR(float $EUR): self
    {
        $this->EUR = $EUR;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'USD' => $this->getUSD(),
            'GBP' => $this->getGBP(),
            'EUR' => $this->getEUR(),
            'created_at' => $this->getCreatedAt()->format('Y-m-d H:i:s'), 
        ];
    }
}
