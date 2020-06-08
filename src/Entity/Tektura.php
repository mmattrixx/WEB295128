<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TekturaRepository")
 */
class Tektura
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
     * @ORM\OneToMany(targetEntity="App\Entity\Pomiary", mappedBy="tektura")
     */
    private $pomiary;

    public function __construct()
    {
        $this->pomiary = new ArrayCollection();
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

    /**
     * @return Collection|Pomiary[]
     */
    public function getPomiary(): Collection
    {
        return $this->pomiary;
    }

    public function addPomiary(Pomiary $pomiary): self
    {
        if (!$this->pomiary->contains($pomiary)) {
            $this->pomiary[] = $pomiary;
            $pomiary->setTektura($this);
        }

        return $this;
    }

    public function removePomiary(Pomiary $pomiary): self
    {
        if ($this->pomiary->contains($pomiary)) {
            $this->pomiary->removeElement($pomiary);
            // set the owning side to null (unless already changed)
            if ($pomiary->getTektura() === $this) {
                $pomiary->setTektura(null);
            }
        }

        return $this;
    }

//    /**
//     * @ORM\ManyToOne(targetEntity="App\Entity\User",inversedBy="tektury")
//     * @ORM\JoinColumn()
//     */
//    private $user;
//
//    /**
//     * @return mixed
//     */
//    public function getUser()
//    {
//        return $this->user;
//    }
//
//    /**
//     * @param mixed $user
//     */
//    public function setUser($user): void
//    {
//        $this->user = $user;
//    }
}
