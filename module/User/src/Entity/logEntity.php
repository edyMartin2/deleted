<?php


namespace User\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * This class represents a registered log.
 * @ORM\Entity(repositoryClass="\User\Repository\logRepository")
 * @ORM\Table(name="reclog")
 */

class logEntity
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @ORM\Column(name="user")
     */
    private $user;
    /**
     * @ORM\Column(name="message")
     */
    private $message;
    /**
     * @ORM\Column(name="time")
     */
    private $time;

    /**
     * Returns id.
     * @return integer
     */
    public function getid(){ return $this->id;}

    /**
     * Returns id.
     * @return string
     */
    public function getuser(){ return $this->user;}

    /**
     * Returns message.
     * @return string
     */
    public function getmessage(){ return $this->message;}

    /**
     * Returns time.
     * @return string
     */
    public function gettime(){ return $this->time;}


    /**
     * Sets id
     * @param integer $id
     */
    public function setid($id){ $this->id = $id; }

    /**
     * Sets user
     * @param string $user
     */

    public function setuser($user){ $this->user = $user; }

    /**
     * Sets message
     * @param string $message
     */

    public function setmessage($message){ $this->message = $message; }

    /**
     * Sets time
     * @param string $time
     */
    public function settime($time){ $this->time = $time; }
}