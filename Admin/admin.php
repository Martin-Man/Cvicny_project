
<?php

include 'pages/header.php';							//vloží hlavièku stránky
include '../connect.php';								//vloží súbor na spojenie s databázou

if (isset($_GET['link'])) include 'pages/'.$_GET["link"];	//vloží obsah požadovanej stránky (premennú "link" vkladáme v adresnom riadku)
else include 'pages/orders.php';						//alebo vloží defaultnú domácu stránku

$conn->close();
include '../pages/footer.php';							//vloží pätièku stránky

?>