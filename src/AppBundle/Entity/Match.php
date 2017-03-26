<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Collection;

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
     * @ORM\OneToMany(targetEntity="MatchPlayer", mappedBy="match", cascade={"persist"})
     * @var MatchPlayer[]|ArrayCollection
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
        $this->matchPlayers = new ArrayCollection();
        $this->matchLog = '';
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

    public function addMatchPlayer(MatchPlayer $matchPlayer)
    {
        $matchPlayer->setMatch($this);
        $this->matchPlayers->add($matchPlayer);

    }

    public function removeMatchPlayer(MatchPlayer $matchPlayer)
    {
        $this->matchPlayers->removeElement($matchPlayer);
    }

    /**
     * @return Player[]
     */
    public function getPlayers()
    {
        $players = array();
        foreach ($this->matchPlayers as $matchPlayer) {
            $players[] = $matchPlayer->getPlayer();
        }

        return $players;
    }

    public function addPlayer(Player $player)
    {
        $matchPlayer = new MatchPlayer();
        $matchPlayer->setPlayer($player);
        $this->addMatchPlayer($matchPlayer);
    }

    public function removePlayer(Player $player)
    {
        //TODO: implement
    }

    public function setRandomWinner($key)
    {
        $players = $this->getPlayers();
        $this->setWinner($players[$key]);
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