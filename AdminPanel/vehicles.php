<?php
session_start();
ob_start();

if (!isset($_SESSION['logged'])) {
    header('Location: index.php');
}

$staffPerms = $_SESSION['perms'];
$user = $_SESSION['user'];

include 'verifyPanel.php';
masterconnect();

$resultQ = 'SELECT id FROM vehicles';
$result = mysqli_query($dbcon, $resultQ) or die('Connection could not be established');

$page1 = $_GET['page'];

if ($page1 == '' || $page1 == '1') {
    $page = 0;
} else {
    $page = ($page1 * 100) - 100;
}

$count = mysqli_num_rows($result);
$amount = $count / 100;
$amount = ceil($amount) + 1;

$currentpage = $page1;

$minusPage = $currentpage - 1;

if ($minusPage < 1) {
    $minusPage = 1;
}

$addPage = $currentpage + 1;

if ($addPage > $amount) {
    $addPage = $amount;
}

if (isset($_POST['addVehicle'])) {
    $sqldata = mysqli_query($dbcon, "INSERT INTO vehicles (side, classname, type, pid, alive, active, inventory, color, plate, gear, damage) VALUES ('civ', '', 'Car', '00000', '1','0','\"[[],0]\"', '0', '".round(rand(0,1000000))."','\"[]\"','\"[]\"')");
}

if (isset($_POST['search'])) {
    $valuetosearch = $_POST['SearchValue'];
    $sqlget = "SELECT * FROM vehicles WHERE CONCAT (`pid`) LIKE '%".$valuetosearch."%'";
    $sqldata = filterTable($dbcon, $sqlget);
} else {
    $sqlget = 'SELECT * FROM vehicles ORDER BY id DESC limit '.$page.',100';
    $sqldata = filterTable($dbcon, $sqlget);
}

include 'header/header.php';
?>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 style = "margin-top: 70px">Fahrzeug Men&uuml;</h1>
		  <p class="page-header">Fahrzeug-Menü des Bedienfelds, hier können Sie Fahrzeugdatenbank-Werte ändern.</p><br>
          <div id="alert-area"></div>
            
          <form action = "vehicles.php" method="post">
          		  <div class ="searchBar">
          			<div class="row">
          			  <div class="col-lg-6">
          				<div class="input-group">
          				  <input type="text" class="form-control" style = "width: 300px; margin-top: 20px;" name="SearchValue" placeholder="UID...">
          				  <span class="input-group-btn">
          					<input class="btn btn-default" style = "margin-top: 20px;" name="search" type="submit" value="Suchen">
          				  </span>
          				</div><!-- /input-group -->
          			  </div><!-- /.col-lg-6 -->
          			</div><!-- /.row -->
          		  </div>
                            <input class="btn btn-default" style = "margin-top: 20px;" name="addVehicle" type="submit" value="Fahrzeug Hinzufügen">
          </form><br>

          <div class="table-responsive">
            <table class="table table-striped" style = "margin-top: -10px">
              <thead>
                <tr>
					<th>ID</th>
					<th>Seite</th>
					<th>Klassen Name</th>
					<th>UID</th>
					<th>Typ</th>
					<th>Lebt</th>
					<th>Aktiv</th>
					<th>Farbe</th>
                </tr>
              </thead>
              <tbody>
<?php
                  
$jsonfile = file_get_contents('./vehicles.json');
$jsonarray = json_decode($jsonfile, true);
                  
while ($row = mysqli_fetch_array($sqldata, MYSQLI_ASSOC)) {
    //echo '<form action=vehicles.php method=post>';
    echo '<tr>';
    echo '<td>'.$row['id'].'</td>';
    echo '<td>'.$row['side'].' </td>';

    echo '<td>' ?>
        <select class="form-control" onChange="dbSave(this.value, '<?php echo $row['id']; ?>', 'classname', '<?php echo $row['classname']; ?>')" type=text>   
        <?php 
    foreach ($jsonarray[$row['side']][$row['type']] as $key=>$value){
        
        if ($row['classname'] == $value) {
            echo "<option title='$value' selected = 'selected' value='$value'>$key</option>";
        } else {
            echo "<option title='$value' value='$value'>$key</option>";
        }
        }
    ?>
                  </select>
    <?php

    ?>
                </td>
              <td>
    <select class="form-control" onChange="dbSave(this.value, '<?php echo $row['id']; ?>', 'pid', '<?php echo $row['pid']; ?>')" type=text>   
        <?php 
    $srgsgrsg = false;
    $playerData = mysqli_query($dbcon, "SELECT * FROM players");
    while ($i = mysqli_fetch_array($playerData, MYSQLI_ASSOC)) {
        if ($row['pid'] == $i) {
            echo "<option title='".utf8_encode($i['pid'])."' selected = 'selected' value='".$i['pid']."'>".utf8_encode($i['name'])."</option>";
        } elseif ($row['pid'] == "00000" && $srgsgrsg == false) {
            echo "<option title='LEER' selected = 'selected'>Keine ID eingetragen!</option>";
            echo "<option title='".utf8_encode($i['pid'])."' value='".$i['pid']."'>".utf8_encode($i['name'])."</option>";
            $srgsgrsg = true;
        } else {
            echo "<option title='".utf8_encode($i['pid'])."' value='".$i['pid']."'>".utf8_encode($i['name'])."</option>";
        }
        }
    ?>
                  </select>
              </td>
    <?php
    echo '<td>'?>
        <select class="form-control" onChange="dbSave(this.value, '<?php echo $row['id']; ?>', 'type', '<?php echo $row['type']; ?>')" type=text>   
        <?php 
    foreach ($jsonarray[$row['side']] as $key=>$value){        
        if ($row['type'] == $key) {
            echo "<option title='$key' selected = 'selected' value='$key'>$key</option>";
        } else {
            echo "<option title='$key' value='$key'>$key</option>";
        }
        }
    ?>
                  </select>
    <?php
    echo '</td>';

    echo '<td>' ?>
    <select class="form-control" onChange="dbSave(this.value, '<?php echo $row['id']; ?>', 'alive', '<?php echo $row['alive']; ?>')" type=text>
        <?php if ($row['alive'] == "1") { ?>
        <option selected value="1">Ja</option>
        <option value="0">Nein</option>
        <?php } else { ?>
        <option value="1">Ja</option>
        <option selected value="0">Nein</option>
        <?php } ?>
    </select>
    <?php

    echo '<td>' ?>
        <select class="form-control" onChange="dbSave(this.value, '<?php echo $row['id']; ?>', 'active', '<?php echo $row['active']; ?>')" type=text>
        <?php if ($row['active'] == "1") { ?>
        <option selected value="1">Ja</option>
        <option value="0">Nein</option>
        <?php } else { ?>
        <option value="1">Ja</option>
        <option selected value="0">Nein</option>
        <?php } ?>
    </select>
    <?php

    echo '<td>' ?>
    <input class="form-control" onBlur="dbSave(this.value, '<?php echo $row['id']; ?>', 'color', '<?php echo $row['color']; ?>')"; type=text value= "<?php echo $row['color']; ?>" >
    <?php
    echo '</tr>';
}

echo '</table></div>';
?>


<nav>
<ul class="pagination">
<?php if ($currentpage != 1) {
    ?>
<li>
  <a href="vehicles.php?page=<?php echo $minusPage; ?>" aria-label="Previous">
	<span aria-hidden="true">&laquo;</span>
  </a>
</li>
<?php

} else {
    ?>

<li class = "disabled">
  <a href="vehicles.php?page=<?php echo $minusPage; ?>" aria-label="Previous">
	<span aria-hidden="true">&laquo;</span>
  </a>
</li>

<?php

}
$amountPage = $currentpage + 2;
$pageBefore = $currentpage - 2;

if ($pageBefore == 0) {
    $pageBefore = 1;
    $amountPage = $amountPage + 1;
}

if ($pageBefore < 1) {
    $pageBefore = 1;
    $amountPage = $amountPage + 2;
}
for ($b = $pageBefore; $b <= $amountPage; ++$b) {
    if ($b >= $amount) {
        ?><li class = "disabled"><a href = "vehicles.php?page=<?php echo $b; ?>" style = "text-decoration:none"><?php  echo $b.' '; ?></a><li><?php

    } else {
        if ($b == $currentpage) {
            ?><li class = "active"><a href = "vehicles.php?page=<?php echo $b; ?>" style = "text-decoration:none"><?php  echo $b.' '; ?></a><li><?php

        } else {
            ?><li><a href = "vehicles.php?page=<?php echo $b; ?>" style = "text-decoration:none"><?php  echo $b.' '; ?></a><li><?php

        }
    }
}

if ($currentpage != $amount) {
    ?>
<li>
  <a href="vehicles.php?page=<?php echo $addPage; ?>" aria-label="Next">
	<span aria-hidden="true">&raquo;</span>
  </a>
</li>
<?php

} else {
    ?>

<li class = "disabled">
  <a href="vehicles.php?page=<?php echo $minusPage; ?>" aria-label="Next">
	<span aria-hidden="true">&raquo;</span>
  </a>
</li>

<?php

}
?>
</ul>
</nav>

<script>
function newAlert (type, message) {
    $("#alert-area").append($("<div class='alert " + type + " fade in' data-alert><p> " + message + " </p></div>"));
    $(".alert").delay(2000).fadeOut("slow", function () { $(this).remove(); });
}


function dbSave(value, uid, column, original){

        if (value != original) {

            newAlert('alert-success', 'Value Updated!');

            $.post('Backend/updateVehicles.php',{column:column, editval:value, id:uid},
            function(){
                //alert("Sent values.");
            });
        };

}
</script>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="dist/js/bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="../../assets/js/vendor/holder.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
