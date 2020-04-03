<?php
	// Set session variables

	$conn->query("SET CHARACTER SET utf8");
	//alebo v xampp/mysql/bin/my.ini   doplnit:
	//[mysqld]
	//character-set-server=utf8
	//collation-server=utf8_slovak_ci

	//if($_GET["hladaj"]) $sql = "SELECT * FROM knihy WHERE nazov='".$_GET["hladaj"]."'";		//ak je presná zhoda
	if(isset($_GET["hladaj"])) $sql = "SELECT * FROM knihy WHERE rok LIKE '%".$_GET["hladaj"]."%' OR nazov LIKE '%".$_GET["hladaj"]."%'";	//ak obsahuje h¾adaný reazec

	else $sql = "SELECT * FROM knihy";
	//$sql = "SELECT * FROM knihy WHERE autor LIKE 'Ján PILLÁR 1'";	//ORDER BY xxxx LIMIT 9
	$result = $conn->query($sql);

	//echo $result->num_rows;	//poèet vrátených riadkov

	//echo $_GET["hladaj"];
	//echo $_POST["hladaj"];
?>




<h3>O nás</h3>

	<div class="row mt-5">
		Naša spoločnosť sa zaoberá predajom veľkoplošného materiálu a jeho následným spracovaním na CNC strojoch, porezom drevotriesky (DTD laminovaná drevotrieska), výrobou nábytkových dielcov (drevotrieska v rôznych farbách a dekoroch) a olepovaním ABS hrán.
		<br /><br />
Ponúkame taktiež široký sortiment nábytkových, kuchynských kovaní, kuchynských dvierok, podláh, interierových dverí a elektro náradia.
		
		
	</div>

<!--<div class="row">
		<div class="col-md-12">
			<?php //phpinfo(); ?>
    	</div>
	</div>
-->


</div>