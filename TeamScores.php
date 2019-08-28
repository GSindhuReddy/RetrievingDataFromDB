<?php

include_once "MatchScore.php";
include_once "DataHelper.php";

function getMatchScores($data, $team)
{
    $scheduleResults = $teams = $stadiums = $matchScores =  [];
    extract($data);
    $schedules = DataHelper::getSchedulesForTeam($scheduleResults, $team->TeamID);
    foreach ($schedules as $schedule) {
        $matchScore = new MatchScore($schedule, $team->TeamID);
        $teamName = DataHelper::getTeamName($teams, $matchScore->getTeamId());
        $oppTeamName = DataHelper::getTeamName($teams, $matchScore->getOppTeamId());
        $stadium = DataHelper::getStadium($stadiums, $matchScore->getStadiumId());
        $matchScore->setTeamName($teamName);
        $matchScore->setOppTeamName($oppTeamName);
        $matchScore->setStadiumName($stadium->SName);
        $matchScore->setCityName($stadium->SCity);
        $matchScores[] = $matchScore;
    }
    return $matchScores;
}

try {
    $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017", array("connect" => TRUE));
    $db = $manager->SoccerWorldCup;
//    echo "Connection to database successfully\n";
    $filter = [];
    $options = [];
    $query = new MongoDB\Driver\Query($filter, $options);
    $cursor = $manager->executeQuery('SoccerWorldCup.TEAMS', $query);
    $teams = $cursor->toArray();
    $cursor = $manager->executeQuery('SoccerWorldCup.SCHEDULE_RESULTS', $query);
    $scheduleResults = $cursor->toArray();
    $cursor = $manager->executeQuery('SoccerWorldCup.STADIUMS', $query);
    $stadiums = $cursor->toArray();
//    print_r($scheduleResults);
    $data = [
        'teams' => $teams,
        'scheduleResults' => $scheduleResults,
        'stadiums' => $stadiums,
    ];
    foreach ($teams as $team) {
        $finalRecord['TeamName'] = $team->Team;
        $finalRecord['matchScores'] = getMatchScores($data, $team);
        $finalRecords[] = $finalRecord;
    }

} catch (MongoConnectionException $e) {
    echo "Failed Connecting to DB: ";
    echo $e->getMessage();
}
ob_clean();
//Uncomment this line to print the records
//print_r(json_encode($finalRecords, JSON_PRETTY_PRINT));

$bulk = new MongoDB\Driver\BulkWrite();
foreach ($finalRecords as $finalRecord) {
    $bulk->insert(array_merge(['_id' => bin2hex(random_bytes(20))] , (array)$finalRecord));
}
$writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 100);
//Uncomment below 2 lines to insert into mongodb collection
//$result = $manager->executeBulkWrite('SoccerWorldCup.TEAM_SCORES', $bulk, $writeConcern);
//printf("Inserted %d document(s)\n", $result->getInsertedCount());




