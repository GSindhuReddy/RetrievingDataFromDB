<?php
class DataHelper
{
    /**
     * @param $stadiums
     * @param $sid
     * @return stdClass
     */
    public static function getStadium($stadiums, $sid)
    {
        foreach ($stadiums as $stadium) {
            if ($stadium->SID == $sid) {
                return $stadium;
            }
        }
        return new stdClass();
    }

    /**
     * @param $scheduleResults
     * @param $teamID
     * @return stdClass[]
     */
    public static function getSchedulesForTeam($scheduleResults, $teamID)
    {
        $schedules = [];
        foreach ($scheduleResults as $result) {
            if (
                $result->TeamID1 == $teamID ||
                $result->TeamID2 == $teamID
            ) {
                $schedules[] = $result;
            }
        }
        return $schedules;
    }

    /**
     * @param $teams
     * @param $teamId
     * @return string
     */
    public static function getTeamName($teams, $teamId)
    {
        foreach ($teams as $team) {
            if ($team->TeamID == $teamId) {
                return $team->Team;
            }
        }
        return '';
    }

    /**
     * @param $scheduleResults
     * @param $GameID
     * @return stdClass
     */
    public static function getScheduleForGame($scheduleResults, $GameID)
    {
        foreach ($scheduleResults as $scheduleResult) {
            if ($scheduleResult->GameID == $GameID) {
                return $scheduleResult;
            }
        }
        return new stdClass();
    }


}