<?php

include_once "DataHelper.php";
include_once "Goal.php";
include_once "Match.php";
class Player
{
    public $Team;
    public $TeamID;
    public $PlayerID;
    public $Position;
    public $FIFA_Popular_Name;
    public $Birth_Date;
    public $Shirt_Name;
    public $Club;
    public $Height;
    public $Weight;

    /** @var Match */
    public $games = [];
    /** @var Goal */
    public $goals = [];
    public function __construct($player)
    {
        $player = (array)$player;
        $this->Team = $player['Team'];
        $this->TeamID = $player['TeamID'];
        $this->PlayerID = $player['PlayerID'];
        $this->Position = $player['Position'];
        $this->FIFA_Popular_Name = $player['FIFA Popular Name'];
        $this->Birth_Date = $player['Birth Date'];
        $this->Shirt_Name = $player['Shirt Name'];
        $this->Club = $player['Club'];
        $this->Height = $player['Height'];
        $this->Weight = $player['Weight'];
    }

    /**
     * @param mixed $data
     * @return Player
     */
    public function init($data)
    {
        $this->setGoals($data['goals']);
        $this->setGames($data['scheduleResults']);
        $this->initGoals($data);
        $this->initGames($data);
        return $this;
    }

    public function initGoals($data)
    {
        /** @var Goal $goal */
        foreach ($this->goals as $goal) {
            $scheduleResult = DataHelper::getScheduleForGame($data['scheduleResults'], $goal->GameID);
            $stadium = DataHelper::getStadium($data['stadiums'], $scheduleResult->SID);
            $teamName = DataHelper::getTeamName($data['teams'], $goal->TeamID);
            $goal->opposingTeamName = $teamName;
            $goal->StadiumName = $stadium->SName;
            $goal->City = $stadium->SCity;
            $goal->MatchDate = $scheduleResult->MatchDate;
            $goal->PlayerID = $this->PlayerID;
        }
    }
    public function initGames($data)
    {
        /** @var Match $game */
        foreach ($this->games as &$game) {
            $stadium = DataHelper::getStadium($data['stadiums'], $game->stadiumId);
            $game->City = $stadium->SCity;
            $game->StadiumName = $stadium->SName;
            $teamName = DataHelper::getTeamName($data['teams'], $game->oppTeamId);
            $game->oppTeamName = $teamName;
        }
    }

    public function setGames($scheduleResults)
    {
        foreach ($scheduleResults as $scheduleResult) {
            $scheduleResult = (array)$scheduleResult;
            /** @var Goal $goal */
            if (
                $this->TeamID == $scheduleResult['TeamID1'] ||
                $this->TeamID == $scheduleResult['TeamID2']
            ) {
                $match = new Match();
                $match->GameID = $scheduleResult['GameID'];
                $match->MatchDate = $scheduleResult['MatchDate'];
                $match->stadiumId = $scheduleResult['SID'];
                if ($this->TeamID == $scheduleResult['TeamID1']) {
                    $match->oppTeamId = $scheduleResult['TeamID2'];
                }else{
                    $match->oppTeamId = $scheduleResult['TeamID1'];
                }
                $this->games[] = $match;
            }
        }
    }

    public function setGoals($goals)
    {
        foreach ($goals as $goal) {
            $goal = (array)$goal;
            if ($goal['PlayerID'] == $this->PlayerID) {
                $goalObj = new Goal();
                $goalObj->TeamID = $goal['TeamID'];
                $goalObj->GameID = $goal['GameID'];
                $this->goals[] = $goalObj;
            }

        }
    }

    /**
     * @return Match
     */
    public function getGames()
    {
        return $this->games;
    }

    /**
     * @return Goal
     */
    public function getGoals()
    {
        return $this->goals;
    }


}