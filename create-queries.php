<?php
// what should I do here? I should get the posts from the field
$hostname = 'localhost';
$username = 'root';
$password = 'admajoremDeigloriam!';
$database = 'intl_chess_db';
$pdo = new PDO("mysql:dbname=$database;host=localhost", $username, $password);

if($_POST['action'] === 'insert-players'){
  $firstname = $_POST['firstname']; 
  $lastname = $_POST['lastname'];
  $rows = $pdo->query("SELECT first_name, last_name from Players 
  WHERE(first_name = '$firstname' AND last_name = '$lastname')
  LIMIT 1;
  ");
  // if there is a match, then show that there
  if($rows -> rowCount() == 0){
    $birthdate = !empty($_POST['birthdate']) ? $_POST['birthdate'] : null;
    $email = !empty($_POST['email']) ? $_POST['email'] : null;
    $nationality = !empty($_POST['nationality']) ? $_POST['nationality'] : null;
    $fideRating = !empty($_POST['fideRating']) ? $_POST['fideRating'] : null;

    $data = [
      'firstname' => $firstname,
      'lastname' => $lastname,
      'birthdate' => $birthdate,
      'email' => $email,
    ];

    $sql = "
    INSERT INTO Players(first_name, last_name, date_of_birth, email)
    VALUES(:firstname, :lastname, :birthdate, :email);
    ";
    $stmt = $pdo->prepare($sql);
    // bind paremeters
    if($birthdate === null){
      $stmt->bindParam(':birthdate', $birthdate, PDO::PARAM_NULL);
    } else {
      $stmt->bindParam(':birthdate', $birthdate, PDO::PARAM_STR);
    }
    if($email === null){
      $stmt->bindParam(':email', $email, PDO::PARAM_NULL);
    } else {
      $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    }
    if($nationality === null){
      $stmt->bindParam(':nationality', $nationality, PDO::PARAM_NULL);
    } else {
      $stmt->bindParam(':nationality', $nationality, PDO::PARAM_STR);
    }
    if($fideRating === null){
      $stmt->bindParam(':fideRating', $fideRating, PDO::PARAM_NULL);
    } else {
      $stmt->bindParam(':nationality', $nationality, PDO::PARAM_INT);
    }

    $stmt-> execute($data);
    // fetch the id of the player inserted
    $player_ID = $pdo->query("SELECT player_ID from Players WHERE(first_name = '$firstname' AND last_name = '$lastname') LIMIT 1;");
    foreach($player_ID as $playerId){
      $inserted_player_id = $playerId['player_ID'];
    }
    // I need to find the player_ID of this
    $data2 = [
      'player_ID' => $inserted_player_id,
      'nationality' => $nationality,
      'fideRating' => $fideRating,
    ];
    $sql2 = "INSERT INTO Player_details(player_ID, nationality, FIDE_rating)
    VALUES(:player_ID, :nationality, :fideRating);
    ";

    $stmt2 = $pdo->prepare($sql2);
    $stmt2->execute($data2);
    ?>
    <h1 id="table-header">
      <?php
        echo 'Player '.$firstname .' '. $lastname.' added to database';
      ?>
    </h1>
    <?php
  } else {
    ?>
    <h1 id="table-header">
    <?php
      foreach($rows as $row){
        echo 'Player '. $row['first_name'] .' '. $row['last_name'] .' already exists in the database';
      }
    ?>
    <?php
  }

} elseif($_POST['action'] === 'insert-openings'){

  $oldOpeningName = !empty($_POST['opening-name'])? $_POST['opening-name'] : null;
  $openingName = addslashes($oldOpeningName);
  $openingPgn = !empty($_POST['opening-pgn'])? $_POST['opening-pgn'] : null;
  // query to search for the opening of the same $opeingName
  $rows = $pdo->query("SELECT opening_name from Chess_openings WHERE(opening_name = '$openingName') LIMIT 1;");

  // if($rows -> rowCount() == 0){
  $sql = "
  INSERT INTO Chess_openings(opening_name, opening_PGN)
  VALUES(:openingName, :openingPgn);
  ";

  if($rows -> rowCount() != 0){
    ?>
    <h1 id="table-header">
      <?php echo 'Chess opening '.$oldOpeningName. ' already exists in the database'  ?>
    </h1>
    <?php
  } else {
    $openingStmt= $pdo->prepare($sql);
    if($openingName == null){
      $openingStmt->bindParam(':openingName', $oldOpenigName, PDO::PARAM_NULL);
    }else{
      $openingStmt->bindParam(':openingName', $oldOpeningName, PDO::PARAM_STR);
    }
    if($openingPgn == null){
      $openingStmt->bindParam(':openingPgn', $openingPgn, PDO::PARAM_NULL);
    }else{
      $openingStmt->bindParam(':openingPgn', $openingPgn, PDO::PARAM_STR);
    }

    $data = [
      'openingName' => $oldOpeningName,
      'openingPgn' => $openingPgn,
    ];

    $openingStmt = $pdo->prepare($sql);
    $openingStmt->execute($data);
    ?>
    <h1 id="table-header">
      <?php
        echo 'Chess opening '.$oldOpeningName.' added to database';
      ?>
    </h1>
    <?php
   
  }
  
}
 elseif($_POST['action'] === 'insert-timecontrols'){
  ?>
  <?php
  $controlName = !empty($_POST['name']) ? $_POST['name'] : null;
  $controlDescription = !empty($_POST['controlDescription']) ? $_POST['controlDescription'] : null;
  $initialTime = !empty($_POST['initial-time']) ? $_POST['initial-time'] : null;
  $increment = !empty($_POST['increment']) ? $_POST['increment'] : null;
  $unit = !empty($_POST['unit']) ? $_POST['unit'] : null;
  $maxtime = !empty($_POST['maxtime']) ? $_POST['maxtime'] : null;
  $rows = $pdo->query("SELECT control_name FROM time_controls WHERE control_name = '$controlName';");
  $sql = "INSERT INTO time_controls(control_name, control_description, initial_time, increment, time_unit, max_time)
  VALUES(:controlName, :controlDescription, :initialTime, :increment, :unit, :maxtime);
  ";
  ?>
  <?php
  if($rows -> rowCount() != 0){
    ?>
    <h1 id="table-header">
      <?php echo 'Time control '.$controlName. ' already exists in the database'  ?>
    </h1>
    <?php
  } else {
    $controlStmt = $pdo->prepare($sql);
    if($controlName == null){
      $controlStmt->bindParam(':controlName', $controlName, PDO::PARAM_NULL);
    } else {
      $controlStmt->bindParam(':controlName', $controlName, PDO::PARAM_STR);
    }
    if($controlDescription == null){
      $controlStmt->bindParam(':controlDescription', $controlDescription, PDO::PARAM_NULL);
    } else {
      $controlStmt->bindParam(':controlDescription', $controlDescription, PDO::PARAM_STR);
    }
    if($initialTime == null){
      $controlStmt->bindParam(':initialTime', $initialTime, PDO::PARAM_NULL);
    } else{
      $controlStmt->bindParam(':initialTime', $initialTime, PDO::PARAM_STR);
    }
    if($increment == null){
      $controlStmt->bindParam(':increment', $increment, PDO::PARAM_NULL);
    } else{
      $controlStmt->bindParam(':increment', $increment, PDO::PARAM_STR);
    }
    if($unit == null){
      $controlStmt->bindParam(':unit', $unit, PDO::PARAM_NULL);
    } else{
      $controlStmt->bindParam(':unit', $unit, PDO::PARAM_STR);
    }
    if($maxtime == null){
      $controlStmt->bindParam(':maxtime', $maxtime, PDO::PARAM_NULL);
    } else{
      $controlStmt->bindParam(':maxtime', $maxtime, PDO::PARAM_STR);
    }

    $data = [
      'controlName' => $controlName,
      'controlDescription' => $controlDescription,
      'initialTime' => $initialTime,
      'increment' => $increment,
      'unit' => $unit,
      'maxtime' => $maxtime,
    ];

    $controlStmt = $pdo->prepare($sql);
    $controlStmt->execute($data);
    ?>
      <h1 id="table-header">
        <?php
          echo 'Time Control '.$controlName.' added to database';
        ?>
      </h1>
    <?php

  }
} elseif($_POST['action'] === 'insert-games'){
  // create variables
  $matchName = !empty($_POST['match-name']) ? $_POST['match-name'] : null;
  $matchDate = !empty($_POST['match-date']) ? $_POST['match-date'] : null;
  $result = !empty($_POST['result']) ? $_POST['result'] : null;
  $location = !empty($_POST['location']) ? $_POST['location'] : null;
  $gameOpening = !empty($_POST['game-opening']) ? $_POST['game-opening'] : null;
  $gameControl = !empty($_POST['game-time-control']) ? $_POST['game-time-control'] : null;
  $whitePlayer = !empty($_POST['white-player']) ? $_POST['white-player'] : null;
  $blackPlayer = !empty($_POST['black-player']) ? $_POST['black-player'] : null;
  $gamePgn = !empty($_POST['game-pgn']) ? $_POST['game-pgn'] : null;


  $rows = $pdo->query("SELECT match_ID FROM Matches WHERE match_name = '$matchName';");  
  if($rows -> rowCount() == 0){
    // create sql statement
    $sql_1 = "INSERT INTO matches(location, match_name)
    VALUES(:location, :matchName);";
    
    // bind variables (names of match, date, location)
    $matchStmt = $pdo->prepare($sql_1);
    if($matchName == null){
      $matchStmt->bindParam(':matchName', $matchName, PDO::PARAM_NULL);
    } else{
      $matchStmt->bindParam(':matchName', $matchName, PDO::PARAM_STR);
    }

    if($location == null){
      $matchStmt->bindParam(':location', $location, PDO::PARAM_NULL);
    } else{
      $matchStmt->bindParam(':location', $location, PDO::PARAM_STR);
    }
    $matchStmt->bindParam(':whitePlayer', $whitePlayer, PDO::PARAM_INT);
    $matchStmt->bindParam(':blackPlayer', $blackPlayer, PDO::PARAM_INT);
    $matchStmt->bindParam(':gamePgn', $gamePgn, PDO::PARAM_STR);

    $data_1 = [
      'location' => $location,
      'matchName' => $matchName,
    ];
    $matchStmt->execute($data_1);

    // insert into games
    $rowLastId = $pdo->query("SELECT match_ID FROM Matches ORDER BY match_ID DESC LIMIT 1;");
    $lastId = null;

    foreach($rowLastId as $row){
      $lastId = $row['match_ID'];
    }
    $sql_2 = "INSERT INTO Games(match_ID, date_of_match, time_control, opening_ID)
      VALUES(:matchId, :matchDate, :gameControl, :gameOpening);";


    $matchStmt_2 = $pdo->prepare($sql_2);
    if($matchDate == null){
      $matchStmt_2->bindParam(':matchDate', $matchDate, PDO::PARAM_NULL);
    } else {
      $matchStmt_2->bindParam(':matchDate', $matchDate, PDO::PARAM_STR);
    }
    if($gameOpening == null){
      $matchStmt_2->bindParam(':gameOpening', $gameOpening, PDO::PARAM_NULL);
    } else {
      $matchStmt_2->bindParam(':gameOpening', $gameOpening, PDO::PARAM_INT);
    }
    if($gameControl == null){
      $matchStmt_2->bindParam(':gameControl', $gameControl, PDO::PARAM_NULL);
    } else {
      $matchStmt_2->bindParam(':gameControl', $gameControl, PDO::PARAM_INT);
    }
    $matchStmt_2->bindParam(':matchId', $lastId, PDO::PARAM_INT);

    $data_2 = [
      'matchId' => $lastId, 
      'matchDate' => $matchDate,
      'gameControl' => $gameControl,
      'gameOpening' => $gameOpening,
    ];

    $matchStmt_2->execute($data_2);
    // inserting to game_results

    $lastGameRow = $pdo->query("SELECT game_ID FROM Games ORDER BY game_ID DESC LIMIT 1;");
    $gameId = null;
    foreach($lastGameRow as $game_ID){
      $gameId = $game_ID['game_ID'];
    }
    // insert game results
    $sql_3 = "INSERT INTO game_results(game_ID, result) VALUES(:gameId, :result);";

    $matchStmt_3 = $pdo->prepare($sql_3);
    $matchStmt_3->bindParam(':result', $result, PDO::PARAM_STR);
    $matchStmt_3->bindParam(':gameId', $gameId, PDO::PARAM_INT);

    $data_3 = [
      'gameId' => $gameId,
      'result' => $result,
    ];

    $matchStmt_3->execute($data_3);

    // insert game_pgns
    $sql_4 = "INSERT INTO game_pgns(game_ID, game_pgn) VALUES(:gameId, :gamePgn);";

    $matchStmt_4 = $pdo->prepare($sql_4);
    $matchStmt_4->bindParam(':gamePgn', $result, PDO::PARAM_STR);
    $matchStmt_4->bindParam(':gameId', $gamePgn, PDO::PARAM_INT);

    $data_4 = [
      'gameId' => $gameId,
      'gamePgn' => $gamePgn,
    ];

    $matchStmt_4->execute($data_4);

    // insert player games;
    // white
    $sql_5 = "INSERT INTO Player_games(game_ID, player_ID, player_color)
    VALUES(:gameId, :whitePlayer, :playerColor);";

    // bind parameters
    $matchStmt_5 = $pdo->prepare($sql_5);
    $matchStmt_5->bindParam(":gameId", $gameId, PDO::PARAM_INT);
    $matchStmt_5->bindParam(":whitePlayer", $whitePlayer, PDO::PARAM_INT);

    $data_5 = [
      'gameId' => $gameId, 
      'whitePlayer' => $whitePlayer,
      'playerColor' => 'white',
    ];
    print('wow');
    $matchStmt_5->execute($data_5);

    // black 
    $sql_6 = "INSERT INTO Player_games(game_ID, player_ID, player_color)
    VALUES(:gameId, :blackPlayer, :playerColor);";

    // bind parameters
    $matchStmt_6 = $pdo->prepare($sql_6);
    $matchStmt_6->bindParam(":gameId", $gameId, PDO::PARAM_INT);
    $matchStmt_6->bindParam(":blackPlayer", $blackPlayer, PDO::PARAM_INT);

    $data_6 = [
      'gameId' => $gameId, 
      'blackPlayer' => $blackPlayer,
      'playerColor' => 'black',
    ];
    $matchStmt_6->execute($data_6);


    // insert game_pgn


    ?>
    <h1 id="table-header">
      <?php
        echo 'Match '.$matchName.' added to database';
      ?>
    </h1>
    <?php
  } else {
    ?>
      <h1 id="table-header">
        <?php
          echo 'Match '.$matchName.' already exists in the database';
        ?>
      </h1>
    <?php
  }

}

?>