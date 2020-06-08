<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PapierRepository")
 */
class Papier
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nazwa;

    /**
     * @ORM\Column(type="integer")
     */
    private $gramatura;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $producent;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Pomiary", mappedBy="pokrycie1")
     */
    private $pokrycie1;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Pomiary", mappedBy="fala1")
     */
    private $fala1;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Pomiary", mappedBy="pokrycie2")
     */
    private $pokrycie2;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Pomiary", mappedBy="fala2")
     */
    private $fala2;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Pomiary", mappedBy="pokrycie3")
     */
    private $pokrycie3;

    public function __construct()
    {
        $this->pokrycie1 = new ArrayCollection();
        $this->fala1 = new ArrayCollection();
        $this->pokrycie2 = new ArrayCollection();
        $this->fala2 = new ArrayCollection();
        $this->pokrycie3 = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNazwa(): ?string
    {
        return $this->nazwa;
    }

    public function setNazwa(string $nazwa): self
    {
        $this->nazwa = $nazwa;

        return $this;
    }

    public function getGramatura(): ?int
    {
        return $this->gramatura;
    }

    public function setGramatura(int $gramatura): self
    {
        $this->gramatura = $gramatura;

        return $this;
    }

    public function getProducent(): ?string
    {
        return $this->producent;
    }

    public function setProducent(string $producent): self
    {
        $this->producent = $producent;

        return $this;
    }

    /**
     * @return Collection|Pomiary[]
     */
    public function getPokrycie1(): Collection
    {
        return $this->pokrycie1;
    }

    public function addPokrycie1(Pomiary $pokrycie1): self
    {
        if (!$this->pokrycie1->contains($pokrycie1)) {
            $this->pokrycie1[] = $pokrycie1;
            $pokrycie1->setPokrycie1($this);
        }

        return $this;
    }

    public function removePokrycie1(Pomiary $pokrycie1): self
    {
        if ($this->pokrycie1->contains($pokrycie1)) {
            $this->pokrycie1->removeElement($pokrycie1);
            // set the owning side to null (unless already changed)
            if ($pokrycie1->getPokrycie1() === $this) {
                $pokrycie1->setPokrycie1(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Pomiary[]
     */
    public function getFala1(): Collection
    {
        return $this->fala1;
    }

    public function addFala1(Pomiary $fala1): self
    {
        if (!$this->fala1->contains($fala1)) {
            $this->fala1[] = $fala1;
            $fala1->setFala1($this);
        }

        return $this;
    }

    public function removeFala1(Pomiary $fala1): self
    {
        if ($this->fala1->contains($fala1)) {
            $this->fala1->removeElement($fala1);
            // set the owning side to null (unless already changed)
            if ($fala1->getFala1() === $this) {
                $fala1->setFala1(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Pomiary[]
     */
    public function getPokrycie2(): Collection
    {
        return $this->pokrycie2;
    }

    public function addPokrycie2(Pomiary $pokrycie2): self
    {
        if (!$this->pokrycie2->contains($pokrycie2)) {
            $this->pokrycie2[] = $pokrycie2;
            $pokrycie2->setPokrycie2($this);
        }

        return $this;
    }

    public function removePokrycie2(Pomiary $pokrycie2): self
    {
        if ($this->pokrycie2->contains($pokrycie2)) {
            $this->pokrycie2->removeElement($pokrycie2);
            // set the owning side to null (unless already changed)
            if ($pokrycie2->getPokrycie2() === $this) {
                $pokrycie2->setPokrycie2(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Pomiary[]
     */
    public function getFala2(): Collection
    {
        return $this->fala2;
    }

    public function addFala2(Pomiary $fala2): self
    {
        if (!$this->fala2->contains($fala2)) {
            $this->fala2[] = $fala2;
            $fala2->setFala2($this);
        }

        return $this;
    }

    public function removeFala2(Pomiary $fala2): self
    {
        if ($this->fala2->contains($fala2)) {
            $this->fala2->removeElement($fala2);
            // set the owning side to null (unless already changed)
            if ($fala2->getFala2() === $this) {
                $fala2->setFala2(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Pomiary[]
     */
    public function getPokrycie3(): Collection
    {
        return $this->pokrycie3;
    }

    public function addPokrycie3(Pomiary $pokrycie3): self
    {
        if (!$this->pokrycie3->contains($pokrycie3)) {
            $this->pokrycie3[] = $pokrycie3;
            $pokrycie3->setPokrycie3($this);
        }

        return $this;
    }

    public function removePokrycie3(Pomiary $pokrycie3): self
    {
        if ($this->pokrycie3->contains($pokrycie3)) {
            $this->pokrycie3->removeElement($pokrycie3);
            // set the owning side to null (unless already changed)
            if ($pokrycie3->getPokrycie3() === $this) {
                $pokrycie3->setPokrycie3(null);
            }
        }

        return $this;
    }
}
