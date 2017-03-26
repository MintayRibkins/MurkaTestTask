<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="competition")
 */
class Match
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue()
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $startTime;

    /**
     * @ORM\Column(type="datetime")
     */
    private $finishTime;

    /**
     * @ORM\OneToMany(targetEntity="MatchPlayer", mappedBy="match")
     * @var MatchPlayer[]
     */
    private $matchPlayers;

    /**
     * @ORM\ManyToOne(targetEntity="Player")
     * @ORM\JoinColumn(onDelete="CASCADE")
     * @var Player
     */
    private $winner;

    /**
     * @ORM\Column(type="text")
     */
    private $matchLog;

    public function __construct()
    {
        $this->matchPalyers = new ArrayCollection();
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
    public function getStartTime()
    {
        return $this->startTime;
    }

    /**
     * @param mixed $startTime
     */
    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;
    }

    /**
     * @return mixed
     */
    public function getFinishTime()
    {
        return $this->finishTime;
    }

    /**
     * @param mixed $finishTime
     */
    public function setFinishTime($finishTime)
    {
        $this->finishTime = $finishTime;
    }

    /**
     * @return MatchPlayer[]
     */
    public function getMatchPlayers()
    {
        return $this->matchPlayers;
    }

    /**
     * @param MatchPlayer[] $matchPlayers
     */
    public function setMatchPlayers($matchPlayers)
    {
        $this->matchPlayers = $matchPlayers;
    }


    /**
     * @return Player
     */
    public function getWinner()
    {
        return $this->winner;
    }

    /**
     * @param Player $winner
     */
    public function setWinner($winner)
    {
        $this->winner = $winner;
    }

    /**
     * @return mixed
     */
    public function getMatchLog()
    {
        return $this->matchLog;
    }

    /**
     * @param mixed $matchLog
     */
    public function setMatchLog($matchLog)
    {
        $this->matchLog = $matchLog;
    }
}