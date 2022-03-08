<?php
namespace App\Entity\Traits;

use App\Entity\User;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

trait BlameableTrait
{
    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="lieux")
     * @Gedmo\Blameable(on="create")
    */
    private $createdBy;

    /**
     * @Gedmo\Blameable(on="update")
     * @ORM\ManyToOne(targetEntity=User::class)
    */
    private $updatedBy;

    /**
     * @return User
     */
    public function getCreatedBy(): User
    {
        return $this->createdBy;
    }

    /**
     * @param mixed $createdBy
     * @return self
     */
    public function setCreatedBy($createdBy): self
    {
        $this->createdBy = $createdBy;
        return $this;
    }

    /**
     * @return User
     */
    public function getUpdatedBy(): User
    {
        return $this->updatedBy;
    }

    /**
     * @param mixed $updatedBy
     * @return self
     */
    public function setUpdatedBy($updatedBy): self
    {
        $this->updatedBy = $updatedBy;
        return $this;
    }

}