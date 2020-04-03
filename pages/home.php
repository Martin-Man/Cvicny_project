<?php
// Set session variables

$conn->query("SET CHARACTER SET utf8");
//alebo v xampp/mysql/bin/my.ini   doplnit:
//[mysqld]
//character-set-server=utf8
//collation-server=utf8_slovak_ci

//if($_GET["hladaj"]) $sql = "SELECT * FROM knihy WHERE nazov='".$_GET["hladaj"]."'";		//ak je presná zhoda
if(isset($_GET["hladaj"])) $sql = "SELECT * FROM products WHERE product_id LIKE '%".$_GET["hladaj"]."%' OR product_title LIKE '%".$_GET["hladaj"]."%'";	//ak obsahuje hľadaný reťazec

else $sql = "SELECT * FROM products";
//$sql = "SELECT * FROM knihy WHERE autor LIKE 'Ján PILLÁR 1'";	//ORDER BY xxxx LIMIT 9
$result = $conn->query($sql);






?>




	
		<div class="col-md-12 text-center">
			<br />
			<img src="../images/slider.jpg" />
		</div>
	

	<div class="row mt-5">
		<p ><strong>PREDAJŇA OD 30.3.2020 OTVORENÁ</strong><br />
 
		Vstup na predajňu možný iba s ochranným rúškom a rukavicami.<br />

		Na predajni je povolený maximálny počet 3 zákazníkov.<br />
		</p>
		<p><img src="../images/KORONA vstup_small.jpg" /></p>
		
		
		
	</div>

<!--<div class="row">
		<div class="col-md-12">
			<?php //phpinfo(); ?>
    	</div>
	</div>
-->


</div>