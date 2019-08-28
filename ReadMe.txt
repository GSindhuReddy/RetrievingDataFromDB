Used PHP Programming language to retrieve the data from database and perform the necessary queries and write result back to the database as collection.

OutputFiles folder contains the result data files in json format.

Navigate to the drive where the PHP is installed and unzip the folder in the same location.(Ex:C:\projects\php\mongodb>php -d memory_limit=-1 TeamScores.php(Here MongoDB is my folder))

Then navigae to the TeamScores.php and execute the command 

php -d memory_limit=-1 TeamScores.php

This would create a collection named TEAM_SCORES.

Executing the command "php -d memory_limit=-1 TeamScores.php" creates a collection named PLAYER_DATA in the database.

TeamScores.php generates Team Scores Data and saves the result as TEAM_SCORES  collection.

players.php generates player data and saves the result as PLAYER_DATA collection.