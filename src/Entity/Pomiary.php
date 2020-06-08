<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PomiaryRepository")
 */
class Pomiary
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="pomiary")
     */
    private $user;

    /**
     * @ORM\Column(type="datetime")
     */
    private $DataWykonania;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Tektura", inversedBy="pomiary")
     */
    private $tektura;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $NumerZlecenia;

    /**
     * @ORM\Column(type="integer")
     */
    private $pomiar1;

    /**
     * @ORM\Column(type="integer")
     */
    private $pomiar2;

    /**
     * @ORM\Column(type="integer")
     */
    private $pomiar3;

    /**
     * @ORM\Column(type="integer")
     */
    private $pomiar4;

    /**
     * @ORM\Column(type="integer")
     */
    private $pomiar5;

    /**
     * @ORM\Column(type="float")
     */
    private $ect_max;

    /**
     * @ORM\Column(type="float")
     */
    private $ect_min;

    /**
     * @ORM\Column(type="float")
     */
    private $ect_avg;

    /**
     * @ORM\Column(type="float")
     */
    private $standard_deviation;

    /**
     * @ORM\Column(type="float")
     */
    private $waga;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Papier", inversedBy="pokrycie1")
     */
    private $pokrycie1;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Papier", inversedBy="fala1")
     */
    private $fala1;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Papier", inversedBy="pokrycie2")
     */
    private $pokrycie2;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Papier", inversedBy="fala2")
     */
    private $fala2;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Papier", inversedBy="pokrycie3")
     */
    private $pokrycie3;

    /**
     * @ORM\Column(type="float")
     */
    private $wilgotnosc_ect;

    /**
     * @ORM\Column(type="float")
     */
    private $temperatura_ect;

    /**
     * @ORM\Column(type="float")
     */
    private $wilgotnosc_mierzona;

    /**
     * @ORM\Column(type="float")
     */
    private $grubosc_tektury;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Numer_programu;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getDataWykonania(): ?\DateTimeInterface
    {
        return $this->DataWykonania;
    }

    public function setDataWykonania(\DateTimeInterface $DataWykonania): self
    {
        $this->DataWykonania = $DataWykonania;

        return $this;
    }

    public function getTektura(): ?Tektura
    {
        return $this->tektura;
    }

    public function setTektura(?Tektura $tektura): self
    {
        $this->tektura = $tektura;

        return $this;
    }

    public function getNumerZlecenia(): ?string
    {
        return $this->NumerZlecenia;
    }

    public function setNumerZlecenia(?string $NumerZlecenia): self
    {
        $this->NumerZlecenia = $NumerZlecenia;

        return $this;
    }

    public function getPomiar1(): ?int
    {
        return $this->pomiar1;
    }

    public function setPomiar1(int $pomiar1): self
    {
        $this->pomiar1 = $pomiar1;

        return $this;
    }

    public function getPomiar2(): ?int
    {
        return $this->pomiar2;
    }

    public function setPomiar2(int $pomiar2): self
    {
        $this->pomiar2 = $pomiar2;

        return $this;
    }

    public function getPomiar3(): ?int
    {
        return $this->pomiar3;
    }

    public function setPomiar3(int $pomiar3): self
    {
        $this->pomiar3 = $pomiar3;

        return $this;
    }

    public function getPomiar4(): ?int
    {
        return $this->pomiar4;
    }

    public function setPomiar4(int $pomiar4): self
    {
        $this->pomiar4 = $pomiar4;

        return $this;
    }

    public function getPomiar5(): ?int
    {
        return $this->pomiar5;
    }

    public function setPomiar5(int $pomiar5): self
    {
        $this->pomiar5 = $pomiar5;

        return $this;
    }

    public function getEctMax(): ?float
    {
        return $this->ect_max;
    }

    public function setEctMax(float $ect_max): self
    {
        $this->ect_max = $ect_max;

        return $this;
    }

    public function getEctMin(): ?float
    {
        return $this->ect_min;
    }

    public function setEctMin(float $ect_min): self
    {
        $this->ect_min = $ect_min;

        return $this;
    }

    public function getEctAvg(): ?float
    {
        return $this->ect_avg;
    }

    public function setEctAvg(float $ect_avg): self
    {
        $this->ect_avg = $ect_avg;

        return $this;
    }

    public function getStandardDeviation(): ?float
    {
        return $this->standard_deviation;
    }

    public function setStandardDeviation(float $standard_deviation): self
    {
        $this->standard_deviation = $standard_deviation;

        return $this;
    }

    public function getWaga(): ?float
    {
        return $this->waga;
    }

    public function setWaga(float $waga): self
    {
        $this->waga = $waga;

        return $this;
    }

    public function getPokrycie1(): ?Papier
    {
        return $this->pokrycie1;
    }

    public function setPokrycie1(?Papier $pokrycie1): self
    {
        $this->pokrycie1 = $pokrycie1;

        return $this;
    }

    public function getFala1(): ?Papier
    {
        return $this->fala1;
    }

    public function setFala1(?Papier $fala1): self
    {
        $this->fala1 = $fala1;

        return $this;
    }

    public function getPokrycie2(): ?Papier
    {
        return $this->pokrycie2;
    }

    public function setPokrycie2(?Papier $pokrycie2): self
    {
        $this->pokrycie2 = $pokrycie2;

        return $this;
    }

    public function getFala2(): ?Papier
    {
        return $this->fala2;
    }

    public function setFala2(?Papier $fala2): self
    {
        $this->fala2 = $fala2;

        return $this;
    }

    public function getPokrycie3(): ?Papier
    {
        return $this->pokrycie3;
    }

    public function setPokrycie3(?Papier $pokrycie3): self
    {
        $this->pokrycie3 = $pokrycie3;

        return $this;
    }

    public function getWilgotnoscEct(): ?float
    {
        return $this->wilgotnosc_ect;
    }

    public function setWilgotnoscEct(float $wilgotnosc_ect): self
    {
        $this->wilgotnosc_ect = $wilgotnosc_ect;

        return $this;
    }

    public function getTemperaturaEct(): ?float
    {
        return $this->temperatura_ect;
    }

    public function setTemperaturaEct(float $temperatura_ect): self
    {
        $this->temperatura_ect = $temperatura_ect;

        return $this;
    }

    public function getWilgotnoscMierzona(): ?float
    {
        return $this->wilgotnosc_mierzona;
    }

    public function setWilgotnoscMierzona(float $wilgotnosc_mierzona): self
    {
        $this->wilgotnosc_mierzona = $wilgotnosc_mierzona;

        return $this;
    }

    public function getGruboscTektury(): ?float
    {
        return $this->grubosc_tektury;
    }

    public function setGruboscTektury(float $grubosc_tektury): self
    {
        $this->grubosc_tektury = $grubosc_tektury;

        return $this;
    }

    public function getNumerProgramu(): ?string
    {
        return $this->Numer_programu;
    }

    public function setNumerProgramu(string $Numer_programu): self
    {
        $this->Numer_programu = $Numer_programu;

        return $this;
    }
}
