<?php


namespace User\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * This class represents a registered user.
 * @ORM\Entity(repositoryClass="\User\Repository\userRoleRepository")
 * @ORM\Table(name="user_role")
 */


class userRole
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id")
     * @ORM\GeneratedValue
     */
    protected $id;
    /**
     * @ORM\Column(name="user_id")
     */
    protected $user_id;
    /**
     * @ORM\Column(name="role_id")
     */
    protected $role_id;

    /**
     * Returns user ID.
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets user ID.
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return integer
     */
    public function getUserId()
    {
        return $this->id;
    }

    /**
     * @param int $user_id
     */
    public function setUserid($user_id)
    {
        $this->user_id = $user_id;
    }

    /**
     * @return integer
     */
    public function getRoleId()
    {
        return $this->role_id;
    }

    /**
     * @param int $role_id
     */
    public function setRoleid($role_id)
    {
        $this->role_id = $role_id;
    }
}
