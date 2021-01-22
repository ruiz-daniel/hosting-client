<?php

namespace App\Entity;

use App\Repository\ContractRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ContractRepository::class)
 */
class Contract
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $contract_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $extra_disk_space;

    /**
     * @ORM\Column(type="integer")
     */
    private $extra_db_space;

    /**
     * @ORM\ManyToOne(targetEntity=client::class, inversedBy="contracts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $client;

    /**
     * @ORM\Column(type="integer")
     */
    private $packet_id;

    public function __construct($extra_disk_space, $extra_db_space, $packet_id)
    {
        $this->extra_disk_space = $extra_disk_space;
        $this->extra_db_space = $extra_db_space;
        $this->packet_id = $packet_id;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContractId(): ?int
    {
        return $this->contract_id;
    }

    public function setContractId(int $contract_id): self
    {
        $this->contract_id = $contract_id;

        return $this;
    }

    public function getExtraDiskSpace(): ?int
    {
        return $this->extra_disk_space;
    }

    public function setExtraDiskSpace(int $extra_disk_space): self
    {
        $this->extra_disk_space = $extra_disk_space;

        return $this;
    }

    public function getExtraDbSpace(): ?int
    {
        return $this->extra_db_space;
    }

    public function setExtraDbSpace(int $extra_db_space): self
    {
        $this->extra_db_space = $extra_db_space;

        return $this;
    }

    public function getClient(): ?client
    {
        return $this->client;
    }

    public function setClient(?client $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getPacketId(): ?int
    {
        return $this->packet_id;
    }

    public function setPacketId(int $packet): self
    {
        $this->packet_id = $packet;

        return $this;
    }
}
