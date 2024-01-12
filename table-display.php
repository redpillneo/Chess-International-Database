  <!-- CODE FOR DISPLAYING THE MATCHES -->
  <?php 
  $hostname = 'localhost';
  $username = 'root';
  $password = 'admajoremDeigloriam!';
  $database = 'intl_chess_db';
  $pdo = new PDO("mysql:dbname=$database;host=localhost", $username, $password);

  if(isset($_GET["p1-firstname"])){
    $p1_firstname = $_GET["p1-firstname"];
  }
  if(isset($_GET["p1-lastname"])){
    $p1_lastname = $_GET["p1-lastname"];
  }
  if(isset($_GET["p2-firstname"])){
    $p2_firstname = $_GET["p2-firstname"];
  }
  if(isset($_GET["p2-lastname"])){
    $p2_lastname = $_GET["p2-lastname"];
  }
  if(isset($_GET["opening"])){
    $opening = $_GET["opening"];
  }
  if(isset($_GET["date"])){
    $date = $_GET["date"];
  }
  

  // check boolean variable to know whether the inputs are exactly what we want them to be
  $check = FALSE;

  // CASE
  // if p1names not empty and p2names empty do the query
  // if p1names not empty and p2names not empty do the query
  // else prompt to check the fields

  if(!empty($_GET['opening'])){
    $newOpening = addslashes($opening);
    // where there is opening
    if((!empty($_GET["p1-firstname"]) AND !empty($_GET["p1-lastname"])) AND (empty($_GET["p2-firstname"]) AND empty($_GET["p2-lastname"]))){
      if(!empty($_GET["date"])){
        // this row shows the table where there is date, only one player entry, and there is opening
        $rows = $pdo->query("SELECT 
          match_name 'name', games.date_of_match 'date', game_results.result 'result' from matches
          JOIN games
          USING(match_ID)
          JOIN player_games
          using(game_ID)
          JOIN players
          USING(player_ID)
          JOIN game_results
          USING(game_ID)
          JOIN chess_openings
          USING(opening_ID)
          WHERE ((players.first_name LIKE '%$p1_firstname%') AND (players.last_name LIKE '%$p1_lastname%') 
          AND YEAR(games.date_of_match) = '$date'
          AND (chess_openings.opening_name LIKE '%$newOpening%'));
        ");
        $check = TRUE;
        ?>
        <h1 id='table-header'>
          Chess Match for <?php echo $p1_firstname .' '. $p1_lastname ?> played with <?php echo $opening ?> on <?php echo $date ?>
        </h1>
        <?php
      } else{
        // w opening, one player, no date
        $rows = $pdo->query("SELECT 
          match_name 'name', games.date_of_match 'date', game_results.result 'result' from matches
          JOIN games
          USING(match_ID)
          JOIN player_games
          using(game_ID)
          JOIN players
          USING(player_ID)
          JOIN game_results
          USING(game_ID)
          JOIN chess_openings
          USING(opening_ID)
          WHERE ((players.first_name LIKE '%$p1_firstname%') AND (players.last_name LIKE '%$p1_lastname%')
          AND (chess_openings.opening_name LIKE '%$newOpening%'));
        "); 
        $check = TRUE;
        ?>
        <h1 id='table-header'>
          Chess Match/es for <?php echo $p1_firstname .' '. $p1_lastname ?> played with <?php echo $opening ?> 
        </h1>
        <?php

      }
    } elseif((!empty($_GET["p1-firstname"]) AND !empty($_GET["p1-lastname"])) AND (!empty($_GET["p2-firstname"]) AND !empty($_GET["p2-lastname"]))) {
      if(!empty($_GET["date"])){
        // w opening, two players, date
        $rows = $pdo->query("SELECT match_name 'name', games.date_of_match 'date', game_results.result 'result' from matches
          JOIN games
          USING(match_ID)
          JOIN player_games
          using(game_ID)
          JOIN players
          USING(player_ID)
          JOIN game_results
          USING(game_ID)
          JOIN chess_openings
          USING(opening_ID)
          WHERE (((players.first_name LIKE '%$p1_firstname%') AND (players.last_name LIKE '%$p1_lastname%')) OR
          ((players.first_name LIKE '%$p2_firstname%') AND (players.last_name LIKE '%$p2_lastname%')) AND YEAR(games.date_of_match) LIKE '$date'
          AND (chess_openings.opening_name LIKE '%$newOpening%'))
          GROUP BY game_ID
          HAVING COUNT(DISTINCT player_ID) = 2;
        "); 
        $check = TRUE;
        ?>
        <h1 id='table-header'>
          Chess Match/es for <?php echo $p1_firstname .' '. $p1_lastname .' and '. $p2_firstname .' '. $p2_lastname ?> played with <?php echo $opening ?> on <?php echo $date ?> 
        </h1>
        <?php       

      } else {
        $rows = $pdo->query("SELECT match_name 'name', games.date_of_match 'date', game_results.result 'result' from matches
          JOIN games
          USING(match_ID)
          JOIN player_games
          using(game_ID)
          JOIN players
          USING(player_ID)
          JOIN game_results
          USING(game_ID)
          JOIN chess_openings
          USING(opening_ID)
          WHERE (((players.first_name LIKE '%$p1_firstname%') AND (players.last_name LIKE '%$p1_lastname%')) OR
          ((players.first_name LIKE '%$p2_firstname%') AND (players.last_name LIKE '%$p2_lastname%'))
          AND (chess_openings.opening_name LIKE '%$newOpening%'))
          GROUP BY game_ID
          HAVING COUNT(DISTINCT player_ID) = 2;
        "); 
        $check = TRUE;

        ?>
          <h1 id = 'table-header'>
            Chess Match/es for <?php echo $p1_firstname .' '. $p1_lastname .' and '. $p2_firstname .' '. $p2_lastname ?> played with <?php echo $opening ?> 
          </h1>
        <?php

      }
    } elseif((empty($_GET["p1-firstname"]) AND empty($_GET["p1-lastname"])) AND (empty($_GET["p2-firstname"]) AND empty($_GET["p2-lastname"]))) {
      if(!empty($_GET['date'])){
       $rows = $pdo -> query("SELECT match_name 'name', games.date_of_match 'date', game_results.result 'result' from matches
        JOIN games
        USING(match_ID)
        JOIN game_results
        USING(game_ID)
        JOIN chess_openings
        USING(opening_ID)
        WHERE(chess_openings.opening_name LIKE '%$newOpening%') AND (YEAR(games.date_of_match) LIKE '$date')");
        $check = TRUE;
        ?>
          <h1 id = 'table-header'>
            Chess Match/es  played with <?php echo $opening ?> on <?php echo $date ?>
          </h1>
        <?php

      } else {
       $rows = $pdo -> query("SELECT match_name 'name', games.date_of_match 'date', game_results.result 'result' from matches
        JOIN games
        USING(match_ID)
        JOIN game_results
        USING(game_ID)
        JOIN chess_openings
        USING(opening_ID)
        WHERE(chess_openings.opening_name LIKE '%$newOpening%')");
        $check = TRUE;
        ?>
          <h1 id = 'table-header'>
            Chess Match/es  played with <?php echo $opening ?> 
          </h1>
        <?php

      }
    }
  } else {
    // WHERE THERE IS NO OPENING ENTRY 
    if((!empty($_GET["p1-firstname"]) AND !empty($_GET["p1-lastname"])) AND (empty($_GET["p2-firstname"]) AND empty($_GET["p2-lastname"]))){
      if(!empty($_GET["date"])){
        // no opening, one player, and date
        $rows = $pdo->query("SELECT 
          match_name 'name', games.date_of_match 'date', game_results.result 'result' from matches
          JOIN games
          USING(match_ID)
          JOIN player_games
          using(game_ID)
          JOIN players
          USING(player_ID)
          JOIN game_results
          USING(game_ID)
          WHERE ((players.first_name LIKE '%$p1_firstname%') AND (players.last_name LIKE '%$p1_lastname%') AND YEAR(games.date_of_match) LIKE '$date');
        "); 
        $check = TRUE;
        ?>
          <h1 id='table-header'>
            Chess Match/es for <?php echo $p1_firstname .' '. $p1_lastname ?> on <?php echo $date ?>

          </h1>
        <?php
       
      } else{
        // no opening, one player, no date
        $rows = $pdo->query("SELECT 
          match_name 'name', games.date_of_match 'date', game_results.result 'result' from matches
          JOIN games
          USING(match_ID)
          JOIN player_games
          using(game_ID)
          JOIN players
          USING(player_ID)
          JOIN game_results
          USING(game_ID)
          WHERE ((players.first_name LIKE '%$p1_firstname%') AND (players.last_name LIKE '%$p1_lastname%'));
        "); 
        $check = TRUE;
        ?>
          <h1 id='table-header'>
            Chess Match/es for <?php echo $p1_firstname .' '. $p1_lastname ?> 
          </h1>
        <?php
      }
    } elseif((!empty($_GET["p1-firstname"]) AND !empty($_GET["p1-lastname"])) AND (!empty($_GET["p2-firstname"]) AND !empty($_GET["p2-lastname"]))) {
      if(!empty($_GET["date"])){
        // two players, no opening, w date
        $rows = $pdo->query("SELECT match_name 'name', games.date_of_match 'date', game_results.result 'result' from matches
          JOIN games
          USING(match_ID)
          JOIN player_games
          using(game_ID)
          JOIN players
          USING(player_ID)
          JOIN game_results
          USING(game_ID)
          WHERE (((players.first_name LIKE '%$p1_firstname%') AND (players.last_name LIKE '%$p1_lastname%')) OR
          ((players.first_name LIKE '%$p2_firstname%') AND (players.last_name LIKE '%$p2_lastname%')) AND YEAR(games.date_of_match) LIKE '$date')
          GROUP BY game_ID
          HAVING COUNT(DISTINCT player_ID) = 2;
        "); 
        $check = TRUE;
        ?>
          <h1 id='table-header'>
            Chess Match/es for <?php echo $p1_firstname .' '. $p1_lastname ?> and <?php echo $p2_firstname .' '. $p2_lastname ?> on <?php echo $date ?>
          </h1>
        <?php

      } else {
        // two players, no opening, no date
        $rows = $pdo->query("SELECT match_name 'name', games.date_of_match 'date', game_results.result 'result' from matches
          JOIN games
          USING(match_ID)
          JOIN player_games
          using(game_ID)
          JOIN players
          USING(player_ID)
          JOIN game_results
          USING(game_ID)
          WHERE (((players.first_name LIKE '%$p1_firstname%') AND (players.last_name LIKE '%$p1_lastname%')) OR
          ((players.first_name LIKE '%$p2_firstname%') AND (players.last_name LIKE '%$p2_lastname%')))
          GROUP BY game_ID
          HAVING COUNT(DISTINCT player_ID) = 2;
        "); 
        $check = TRUE;
        ?>
          <h1 id='table-header'>
            Chess Match/es for <?php echo $p1_firstname .' '. $p1_lastname ?> and <?php echo $p2_firstname .' '. $p2_lastname ?> 
          </h1>
        <?php
      }
    } elseif(!empty($_GET['date'])) {
      // will determine the $rows variable when the input is only date
      if(empty($_GET['p1-firstname']) AND empty($_GET['p1-lastname'])){
        // code for returning the queried matches
        $rows = $pdo->query("SELECT match_name 'name', games.date_of_match 'date', game_results.result 'result' from matches
          JOIN games
          USING(match_ID)
          join game_results
          USING(game_ID)
          WHERE(YEAR(games.date_of_match) LIKE '%$date')");
      ?>
        <h1 id='table-header'>
          Chess Match/es on <?php echo $date?>
        </h1>
      <?php
      $check = TRUE;
      }

    } elseif(!empty($_GET['p1-firstname'] AND empty($_GET['p1-lastname'])) AND empty($_GET['p2-firstname']) AND empty($_GET['p2-lastname'])){
      $rows = $pdo->query("SELECT match_name 'name', games.date_of_match 'date', game_results.result 'result' from matches
        JOIN games
        USING(match_ID)
        JOIN player_games
        USING(game_ID)
        JOIN players
        USING(player_ID)
        JOIN game_results
        USING(game_ID)
        WHERE players.first_name = '$p1_firstname';
      ");
      ?>
        <h1 id='table-header'>
          Chess Match/es where <?php echo $p1_firstname ?> played
        </h1>
      <?php
      $check = TRUE;
      
    }else{
      $rows = NULL;
    }
  }

  if($rows == NULL){
    ?>
      <h2 id='table-header'>
        Check Input
      </h1>
    <?php
      
  }elseif (($rows -> rowCount() == 0) AND ($check)){
    ?>
    <!-- this code here will show if there are no result table for the query -->
      <div id = 'display_table'>
        No chess games match the specifications
      </div>
    <?php
  } elseif(($rows -> rowCount() != 0) AND ($check)) {
    ?>
    <!-- this code will show if there is a table result for the query -->
      <div id = 'display_table'>
        <table>
          <tr id = 'heading'>
            <th>#</th>
            <th>match name</th>
            <th>date</th>
            <th>result</th>
          </tr>
          <?php
            $counter = 1;
              foreach($rows as $row){
                $date= $row['date'];
                $match_name= $row['name'];
                $result = $row['result'];
          ?>
          <tr>
            <th><?php echo $counter++ ?></th>
            <th> <?php echo $match_name ?> </th>
            <th> <?php echo $date ?> </th>
            <th> <?php echo $result ?> </th>
          </tr>
          <?php } ?> 
        </table>
      </div>
    <?php
  }
  error_reporting(0);
  end_search:
  ?>