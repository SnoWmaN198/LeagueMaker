<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 *
 */
class Role
{
    
    /**
     *
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="guid")
     */
    private $id;
    
    /**
     *
     * @ORM\Column(type="string", length=255)
     */
    private $label;
    
    /**
     *
     * @return mixed
     */
    public function getId(): ?string
    {
        return $this->id;
    }
    
    /**
     *
     * @return mixed
     */
    public function getLabel()
    {
        return $this->label;
    }
    
    /**
     *
     * @param mixed $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }
}

