<?php

namespace App\Entity;

use App\Repository\VilleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VilleRepository::class)
 */
class Ville
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $code_ville;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    private $des_ville;

    /**
     * @ORM\ManyToOne(targetEntity=Destination::class, inversedBy="villes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $code_des;

    /**
     * @ORM\OneToMany(targetEntity=EtapeCircuit::class, mappedBy="code_ville", orphanRemoval=true)
     */
    private $code_ville_etape;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    public function __construct()
    {
        $this->code_ville_etape = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeVille(): ?int
    {
        return $this->code_ville;
    }

    public function setCodeVille(int $code_ville): self
    {
        $this->code_ville = $code_ville;

        return $this;
    }

    public function getDesVille(): ?string
    {
        return $this->des_ville;
    }

    public function setDesVille(?string $des_ville): self
    {
        $this->des_ville = $des_ville;

        return $this;
    }

    public function getCodeDes(): ?destination
    {
        return $this->code_des;
    }

    public function setCodeDes(?destination $code_des): self
    {
        $this->code_des = $code_des;

        return $this;
    }

    /**
     * @return Collection|EtapeCircuit[]
     */
    public function getCodeVilleEtape(): Collection
    {
        return $this->code_ville_etape;
    }

    public function addCodeVilleEtape(EtapeCircuit $codeVilleEtape): self
    {
        if (!$this->code_ville_etape->contains($codeVilleEtape)) {
            $this->code_ville_etape[] = $codeVilleEtape;
            $codeVilleEtape->setCodeVille($this);
        }

        return $this;
    }

    public function removeCodeVilleEtape(EtapeCircuit $codeVilleEtape): self
    {
        if ($this->code_ville_etape->contains($codeVilleEtape)) {
            $this->code_ville_etape->removeElement($codeVilleEtape);
            // set the owning side to null (unless already changed)
            if ($codeVilleEtape->getCodeVille() === $this) {
                $codeVilleEtape->setCodeVille(null);
            }
        }

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }
}
