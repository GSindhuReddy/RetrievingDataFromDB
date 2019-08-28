<?php
//ini_get('memory_limit', '1024MB');
include_once "Player.php";
include_once "DataHelper.php";

try {
    $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017", array("connect" => TRUE));
    $db = $manager->SoccerWorldCup;
//    echo "Connection to database successfully\n";
    $filter = [];
    $options = [];
    $query = new MongoDB\Driver\Query($filter, $options);
    $cursor = $manager->executeQuery('SoccerWorldCup.TEAMS', $query);
    $teams = $cursor->toArray();
    $cursor = $manager->executeQuery('SoccerWorldCup.ROSTERS', $query);
    $rosters = $cursor->toArray();
    $cursor = $manager->executeQuery('SoccerWorldCup.SCHEDULE_RESULTS', $query);
    $scheduleResults = $cursor->toArray();
    $cursor = $manager->executeQuery('SoccerWorldCup.STADIUMS', $query);
    $stadiums = $cursor->toArray();
    $cursor = $manager->executeQuery('SoccerWorldCup.GOALS', $query);
    $goals = $cursor->toArray();
//    print_r($scheduleResults);
    $data = [
        'teams' => $teams,
        'rosters' => $rosters,
        'scheduleResults' => $scheduleResults,
        'stadiums' => $stadiums,
        'goals' => $goals
    ];
    foreach ($rosters as $player) {
        $player = new Player($player);
        $player->init($data);
        $finalRecords[] = $player;
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
//$result = $manager->executeBulkWrite('SoccerWorldCup.PLAYER_DATA', $bulk, $writeConcern);
//printf("Inserted %d document(s)\n", $result->getInsertedCount());






