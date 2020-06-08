<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface, \Serializable
{
    /**
     * @var string
     */
    private $plainPassword="";
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
//
//    /**
//     * @ORM\OneToMany(targetEntity="App\Entity\Tektura",mappedBy="user
//     * ")
//     */
//    private $tektury;
//
//    /**
//     * @return ArrayCollection
//     */
//    public function getTektury()
//    {
//        return $this->tektury;
//    }
    /**
     * @ORM\Column(type="string", length=50, unique=true)
     * @Assert\NotBlank()
     */
    private $username;

    /**
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=254, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $fullName;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Pomiary", mappedBy="user")
     */
    private $pomiary;

    public function __construct()
    {
        $this->tektury=new ArrayCollection();
        $this->pomiary = new ArrayCollection();
    }

    /**
     * @var array
     * @ORM\Column(type="simple_array")
     */
    private $roles;

    CONST ROLE_ADMIN='ROLE_ADMIN';
    CONST ROLE_MODERATOR='ROLE_MODERATOR';
    CONST ROLE_ONLYSHOW='ROLE_ONLYSHOW';


    /**
     * @param array $roles
     */
    public function setRoles(array $roles): void
    {
        $this->roles = $roles;
    }

    public function getRoles()
    {
        return $this->roles;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getSalt()
    {
        return null;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function eraseCredentials()
    {

    }

    /**
     * @param mixed $username
     */
    public function setUsername($username): void
    {
        $this->username = $username;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @param mixed $fullName
     */
    public function setFullName($fullName): void
    {
        $this->fullName = $fullName;
    }

    public function serialize()
    {
        return serialize([
            $this->id,
            $this->username,
            $this->password
        ]);
    }

    /**
     * @return mixed
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    public function unserialize($serialized)
    {
        list($this->id,
            $this->username,
            $this->password) = unserialize($serialized);
    }

    /**
     * @return string
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * @var string
     * @param string $plainPassword
     */
    public function setPlainPassword($plainPassword): ?string
    {
        $this->plainPassword = $plainPassword;
        return "";
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
            $pomiary->setUser($this);
        }

        return $this;
    }

    public function removePomiary(Pomiary $pomiary): self
    {
        if ($this->pomiary->contains($pomiary)) {
            $this->pomiary->removeElement($pomiary);
            // set the owning side to null (unless already changed)
            if ($pomiary->getUser() === $this) {
                $pomiary->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }
}
