<?php

namespace App\Entity;

use App\Repository\EtapeCircuitRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EtapeCircuitRepository::class)
 */
class EtapeCircuit
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $duree_etape;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $ordre_etape;

    /**
     * @ORM\ManyToOne(targetEntity=Ville::class, inversedBy="code_ville_etape")
     * @ORM\JoinColumn(nullable=false)
     */
    private $code_ville;

    /**
     * @ORM\ManyToOne(targetEntity=Circuit::class, inversedBy="etapeCircuits")
     * @ORM\JoinColumn(nullable=false)
     */
    private $code_circuit;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDureeEtape(): ?int
    {
        return $this->duree_etape;
    }

    public function setDureeEtape(?int $duree_etape): self
    {
        $this->duree_etape = $duree_etape;

        return $this;
    }

    public function getOrdreEtape(): ?int
    {
        return $this->ordre_etape;
    }

    public function setOrdreEtape(?int $ordre_etape): self
    {
        $this->ordre_etape = $ordre_etape;

        return $this;
    }

    public function getCodeVille(): ?ville
    {
        return $this->code_ville;
    }

    public function setCodeVille(?ville $code_ville): self
    {
        $this->code_ville = $code_ville;

        return $this;
    }

    public function getCodeCircuit(): ?circuit
    {
        return $this->code_circuit;
    }

    public function setCodeCircuit(?circuit $code_circuit): self
    {
        $this->code_circuit = $code_circuit;

        return $this;
    }
}
