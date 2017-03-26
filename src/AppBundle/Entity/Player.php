<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table()
 */
class Player
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue()
     */
    private $id;

    /**
     * @ORM\Column()
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $ratingElo;

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
    public function getRatingElo()
    {
        return $this->ratingElo;
    }

    /**
     * @param mixed $ratingElo
     */
    public function setRatingElo($ratingElo)
    {
        $this->ratingElo = $ratingElo;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }



}