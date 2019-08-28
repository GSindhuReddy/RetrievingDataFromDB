<?php

class MatchScore
{

    public $matchDate;
    public $stadiumName;
    public $cityName;
    private $teamId;
    public $teamName;
    public $teamScore;
    private $oppTeamId;
    public $oppTeamName;
    public $oppTeamScore;
    private $stadiumId;


    public function __construct(\stdClass $schedule, $teamId)
    {
        $this->matchDate = $schedule->MatchDate;
        $this->stadiumId = $schedule->SID;
        if ($teamId == $schedule->TeamID1) {
            $this->teamId = $schedule->TeamID1;
            $this->teamScore = $schedule->Team1_Score;
            $this->oppTeamId = $schedule->TeamID2;
            $this->oppTeamScore = $schedule->Team2_Score;
        }else{
            $this->teamId = $schedule->TeamID2;
            $this->teamScore = $schedule->Team2_Score;
            $this->oppTeamId = $schedule->TeamID1;
            $this->oppTeamScore = $schedule->Team1_Score;
        }
    }

    /**
     * @return mixed
     */
    public function getMatchDate()
    {
        return $this->matchDate;
    }

    /**
     * @param mixed $matchDate
     * @return MatchScore
     */
    public function setMatchDate($matchDate)
    {
        $this->matchDate = $matchDate;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStadiumName()
    {
        return $this->stadiumName;
    }

    /**
     * @param mixed $stadiumName
     * @return MatchScore
     */
    public function setStadiumName($stadiumName)
    {
        $this->stadiumName = $stadiumName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCityName()
    {
        return $this->cityName;
    }

    /**
     * @param mixed $cityName
     * @return MatchScore
     */
    public function setCityName($cityName)
    {
        $this->cityName = $cityName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTeamId()
    {
        return $this->teamId;
    }

    /**
     * @param mixed $teamId
     * @return MatchScore
     */
    public function setTeamId($teamId)
    {
        $this->teamId = $teamId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTeamName()
    {
        return $this->teamName;
    }

    /**
     * @param mixed $teamName
     * @return MatchScore
     */
    public function setTeamName($teamName)
    {
        $this->teamName = $teamName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTeamScore()
    {
        return $this->teamScore;
    }

    /**
     * @param mixed $teamScore
     * @return MatchScore
     */
    public function setTeamScore($teamScore)
    {
        $this->teamScore = $teamScore;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOppTeamId()
    {
        return $this->oppTeamId;
    }

    /**
     * @param mixed $oppTeamId
     * @return MatchScore
     */
    public function setOppTeamId($oppTeamId)
    {
        $this->oppTeamId = $oppTeamId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOppTeamName()
    {
        return $this->oppTeamName;
    }

    /**
     * @param mixed $oppTeamName
     * @return MatchScore
     */
    public function setOppTeamName($oppTeamName)
    {
        $this->oppTeamName = $oppTeamName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOppTeamScore()
    {
        return $this->oppTeamScore;
    }

    /**
     * @param mixed $oppTeamScore
     * @return MatchScore
     */
    public function setOppTeamScore($oppTeamScore)
    {
        $this->oppTeamScore = $oppTeamScore;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStadiumId()
    {
        return $this->stadiumId;
    }

    /**
     * @param mixed $stadiumId
     * @return MatchScore
     */
    public function setStadiumId($stadiumId)
    {
        $this->stadiumId = $stadiumId;
        return $this;
    }


}