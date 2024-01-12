<?php include('top.html')?>
<?php
$hostname = 'localhost';
$username = 'root';
$password = 'admajoremDeigloriam!';
$database = 'intl_chess_db';
$pdo = new PDO("mysql:dbname=$database;host=localhost", $username, $password);
$player = null;
?>
<div id='forms-main'>
  <div id='create-entries-main'>
    <div class = 'create-form-div'>
      <!--create a form for creating new players  -->
      <div id="update-header">
        <h1 class="formHeader">Update Players</h1>
        <form action="update-page.php" method=post>
          <select name="player" id="player-dropbox">
            <option value="">choose player</option>

            <?php 
            $players = $pdo->query("SELECT * FROM Players ORDER BY last_name ASC;");
            foreach($players as $player){
              $playerId = $player['player_ID'];
              $firstname = $player['first_name'];
              $lastname = $player['last_name'];
            ?>
            <option value="<?php echo $playerId ?>"><?php echo $lastname.", ".$firstname?></option>
            <?php
            }
            ?>         
          </select>
          <input type="submit" name="" value="edit" class="update-button">
          
        </form>
      </div>

      <form action="update-page.php" method="post" id="create-form">
        <div id="create-form-content">
          <?php $playerId = !empty($_POST['player']) ? $_POST['player'] : null; ?>
          <?php
            $UPfirstname = null;
            $UPlastname = null;
            $UPbirthDate = null;
            $UPnationality = null; 
            $UPfide_rating = null; 
            $UPemail = null; 
          if($playerId != null){
            $updatePlayer = $pdo->query("SELECT p.player_ID as player_ID, p.first_name as first_name, p.last_name as last_name, p.date_of_birth as date_of_birth, pd.fide_rating as fide_rating, pd.nationality as nationality, p.email as email FROM Players p JOIN Player_details as pd ON p.player_ID = pd.player_ID WHERE p.player_ID = '$playerId';");
            foreach($updatePlayer as $player){
              $playerId = $player['player_ID'];
              $UPfirstname = $player['first_name'];
              $UPlastname = $player['last_name'];
              $UPbirthDate = !empty($player['date_of_birth']) ? $player['date_of_birth'] : null;
              $UPnationality = $player['nationality'];
              $UPfide_rating = $player['fide_rating'];
              $UPemail = $player['email'];
            }
          }
          ?>         

          <div>
            <label for="firstname">First Name*</label><br>
            <label for="lastname">Last Name*</label><br>
            <label for="birthdate" id="">Date of Birth</label><br>
            <label for="email">Email</label><br>
            <label for="nationality">Nationality</label><br>
            <label for="fideRating">FIDE Rating</label><br>
          </div>
          <div>
            <input type="text" name="firstname" id="" value ="<?php echo $UPfirstname ?>" required><br>
            <input type="text" name="lastname" value="<?php echo $UPlastname ?>"id="" required><br>
            <input type="date" name="birthdate" value="<?php echo $UPbirthDate ?>"><br>
            <input type="text" name="email" value="<?php echo $UPemail ?>"><br>
            <input type="text" name="nationality" value="<?php echo $UPnationality ?>"><br>
            <input type="number" name="fideRating" min="0" value = "<?php echo $UPfide_rating ?>">
          </div>
        </div>
        <div class="button-div">
          <input type="hidden" name="action" value="update-players">
          <input type="hidden" name="getUpdatePlayerId" value="<?php echo $playerId ?>">
          <input type="submit" value="Update" name="" class="update-button">
        </div>
      </form>
    </div>
    <div class='create-form-div'>
      <div id="update-header">
        <h1 class="formHeader">Update Chess Openings</h1>
        <form action="update-page.php" method="post">
          <select name="update-openingId" id="">
            <option value="">choose opening</option>
            <?php 
            $openings = $pdo->query("SELECT * FROM Chess_openings ORDER BY opening_name ASC;");
            foreach($openings as $opening){
              $openingId = $opening['opening_ID'];
              $openingName = $opening['opening_name'];
              $openingPgn = $player['opening_PGN'];
            ?>
            <option value="<?php echo $openingId ?>"><?php echo $openingName ?></option>
            <?php
            }
            ?>         
          </select>
          <input type="submit" name="" value="edit" class="update-button">
        </form>

      </div>

      <form action="update-page.php" method="post" id="create-form">
        <div id="create-form-content">
          <!-- get the chess opening id -->
          <?php $openingId = !empty($_POST['update-openingId']) ? $_POST['update-openingId'] : null; ?>
          <?php 
            $UopeningName = null;
            $UopeningPgn = null;
            if($openingId != null){
              $updateOpening = $pdo->query("SELECT opening_name, opening_pgn FROM Chess_openings WHERE opening_ID = '$openingId';");
              foreach($updateOpening as $opening){
                $UopeningName = $opening['opening_name'];
                $UopeningPgn = $opening['opening_pgn'];
              }
            }
          ?>
          <div>
            <!-- labels -->
            <label for="opening-name">Chess opening name*</label><br><br>
            <label for="opening-pgn">Opening Moves (PGN)*</label><br>
          </div>
          <div>
            <!-- inputs -->
            <input type="text" name="opening-name" id="" value="<?php echo $UopeningName ?>" required><br>
            <textarea name="opening-pgn" id="" cols="30" rows="10" required><?php echo $UopeningPgn ?></textarea><br>
          </div>
        </div>
        <div class="button-div">
          <input type="hidden" name="action" value="update-openings">
          <input type="hidden" name="getUpdateOpeningId" value="<?php $openingId ?>"id="">
          <input type="submit" value="Update" name="" class="create-button">
        </div>

      </form>
    </div>
    <div class='create-form-div'>
      <h1 class="formHeader">Add Time Controls</h1>
      <form action="create-page.php" method="post" id="create-form">
        <div id="create-form-content">
          <div>
            <!-- div for the labels -->
            <label for="name">Time Control name*</label><br>
            <label for="controlDescription">Description</label><br>
            <label for="initial-time">Initial Time</label><br>
            <label for="increment">Time Increment</label><br>
            <label for="unit">Time Unit</label><br>
            <label for="maxtime">Maximum Time</label><br>
          </div>
          <div>
            <!-- div for the input fields -->
            <input type="text" name="name" id=""><br>
            <input type="text" name="controlDescription" id=""><br>
            <input type="text" name="initial-time" id=""><br>
            <input type="text" name="increment" id=""><br>
            <input type="text" name="unit" id=""><br>
            <input type="text" name="maxtime" id=""><br>
          </div>
        </div>
        <div class="button-div">
          <input type="hidden" name="action" value="insert-timecontrols">
          <input type="submit" value="Add" name="" class="create-button">
        </div>
      </form>
    </div>
  </div>
  <div id="create-entries-main">
    <div>
      <?php include('admin-search-div.html') ?>
    </div>
    <div class='create-form-div'>
      <h1 class="formHeader">Add Games</h1>
      <form action="create-page.php" method="post" id="create-form">
        <div id="create-form-content">
          <div>
            <!-- div for the labels -->
            <label for="match-name">Name of the Match</label><br>
            <label for="match-date">Date of Match</label><br>
            <label for="result">Result</label><br>
            <label for="location">Location</label><br>
            <label for="game-opening">Chess Opening</label><br>
            <label for="game-time-control">Time Control</label><br>
            <label for="white-player">White Player</label><br>
            <label for="black-player">Black Player</label><br>
            <label for="game-pgn">Portable Game Notation</label>
          </div>
          <div>
            <!-- div for the input fields -->
            <input type="text" name="match-name" id=""><br>
            <input type="date" name="match-date" id=""><br>
            <select name="result" id="">
              <option value="1-0">1-0</option>
              <option value="0-1">0-1</option>
              <option value="1/2-1/2">1/2-1/2</option>
            </select><br>
            <input type="text" name="location" id=""><br>
            <select name="game-opening" id="">

              <!-- insert code that retrieves the openings present (their names) -->
              <?php
              $openingRows = $pdo->query("SELECT opening_ID, opening_name FROM Chess_openings ORDER BY opening_name ASC;");
              foreach($openingRows as $opening){
                // idk why it's an array, so weird
                $opening_name = $opening['opening_name'];
                $opening_ID = $opening['opening_ID'];
                ?>
                <option value="<?php echo $opening_ID ?>"><?php echo $opening_name ?></option> 
                <?php
              }
              ?>


            </select><br>
            <select name="game-time-control" id="">
              <!-- insert a code that retrieves the names of the time controls present in the database -->
              <?php
              $controlRows = $pdo->query("SELECT control_ID, control_name FROM time_controls ORDER BY control_name ASC;");
              foreach($controlRows as $control){
                $control_ID = $control['control_ID'];
                $control_name = $control['control_name'];
                
                ?>
                <option value="<?php echo $control_ID ?>"><?php echo $control_name ?></option>
                <?php
              }
              ?>
            </select><br>
            <select name="white-player" id="">
              <!-- query all existing players and create option -->
              <?php 
              $players = $pdo->query("SELECT player_ID, first_name, last_name FROM Players ORDER BY last_name ASC;");
              foreach($players as $player){
                $whitePlayer = $player['player_ID'];
                $firstname = $player['first_name'];
                $lastname = $player['last_name'];
                ?>
                <option value="<?php echo $whitePlayer ?>"><?php echo $lastname.", ".$firstname?></option>
                <?php
              }
              ?>
            </select><br>
            <select name="black-player" id="">
              <!-- query all existing players and create option -->
              <?php 
              $players = $pdo->query("SELECT player_ID, first_name, last_name FROM Players ORDER BY last_name ASC;");
              foreach($players as $player){
                $blackPlayer = $player[0];
                $firstname = $player[1];
                $lastname = $player[2];
                ?>
                <option value="<?php echo $blackPlayer ?>"><?php echo $lastname.", ".$firstname?></option>
                <?php
              }
              ?>
            </select><br>
            <textarea name="game-pgn" id="" cols="30" rows="10" placeholder="input here the opening moves (PGN)"required></textarea><br>
          </div>
        </div>
        <div class="button-div">
          <input type="hidden" name="action" value="insert-games">
          <input type="submit" value="Add" name="" class="create-button">
        </div>
      </form>
    </div>

  </div>
  <div id='display-div'>
    <?php include('table-display.php') ?>
    <?php include('update-queries.php') ?>
  </div>
</div>

<?php include('bottom.html')?>