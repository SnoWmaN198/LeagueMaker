<?php
namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 *
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="guid")
     */
    private $id;
    
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;
    
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $salt;
    
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;
    
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;
    
    /**
     * @ORM\ManyToMany(targetEntity="Role")
     * $ORM\JoinTable(name="users_roles",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")}
     *      inverseJoinColumns={@ORM\JoinColumn(name="role_id", referencedColumnName="id")}
     * )
     */
    private $roles;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Competition", mappedBy="users")
     */
    private $competitions;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Competitor", mappedBy="user_id")
     */
    private $competitors;
    
    public function __construct()
    {
        $this->roles = new ArrayCollection();
        $this->competitions = new ArrayCollection();
        $this->competitors = new ArrayCollection();
    }
    
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return mixed
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     *
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }
    
    /**
     *
     * @param mixed $salt
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;
    }
    
    /**
     *
     * @param mixed $name
     */
    
    public function setName($name)
    {
        $this->name = $name;
    }
    
    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $roles
     */
    public function setRoles($roles)
    {
        foreach ($roles as $role) {
            $this->addRole($role);
        }
        return $this;
    }
    
    public function addRole(Role $role)
    {
        if (! $this->roles->contains($role)) {
            $this->roles->add($role);
        }
        
        return $this;
    }
    
    public function removeRole(Role $role)
    {
        if ($this->role->contains($role)) {
            $this->roles->removeElement($role);
        }
        
        return $this;
    }

    /**
     * @return Collection|Competition[]
     */
    public function getCompetitions(): Collection
    {
        return $this->competitions;
    }

    public function addCompetition(Competition $competition): self
    {
        if (!$this->competitions->contains($competition)) {
            $this->competitions[] = $competition;
            $competition->addUser($this);
        }

        return $this;
    }

    public function removeCompetition(Competition $competition): self
    {
        if ($this->competitions->contains($competition)) {
            $this->competitions->removeElement($competition);
            $competition->removeUser($this);
        }

        return $this;
    }

    /**
     * @return Collection|Competitor[]
     */
    public function getCompetitors(): Collection
    {
        return $this->competitors;
    }

    public function addCompetitor(Competitor $competitor): self
    {
        if (!$this->competitors->contains($competitor)) {
            $this->competitors[] = $competitor;
            $competitor->setUserId($this);
        }

        return $this;
    }

    public function removeCompetitor(Competitor $competitor): self
    {
        if ($this->competitors->contains($competitor)) {
            $this->competitors->removeElement($competitor);
            // set the owning side to null (unless already changed)
            if ($competitor->getUserId() === $this) {
                $competitor->setUserId(null);
            }
        }

        return $this;
    }

}

