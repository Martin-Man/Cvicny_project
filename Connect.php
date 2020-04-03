<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

// Connect to AZURE MySQL in App database
foreach ($_SERVER as $key => $value) {
    if (strpos($key, "MYSQLCONNSTR_localdb") !== 0) {
        continue;
    }

    $servername = preg_replace("/^.*Data Source=(.+?);.*$/", "\\1", $value);
    $dbname = preg_replace("/^.*Database=(.+?);.*$/", "\\1", $value);
    $username = preg_replace("/^.*User Id=(.+?);.*$/", "\\1", $value);
    $password = preg_replace("/^.*Password=(.+?)$/", "\\1", $value);
}

// Create connection
$conn = $connection = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Error No.".$conn->connect_errno." - Unable to connect to MySQL: ".$conn->connect_error);
}
//echo "Connected successfully<br>";

//$conn->close();
function last_id(){

    global $connection;

    return mysqli_insert_id($connection);
}






function get_products() {

    $query = query(" SELECT * FROM products");
    confirm($query);

    $rows = mysqli_num_rows($query); // Get total of mumber of rows from the database

    if(isset($_GET['page'])){ //get page from URL if its there
        $page = preg_replace('#[^0-9]#', '', $_GET['page']);//filter everything but numbers

    } else{// If the page url variable is not present force it to be number 1
        $page = 1;
    }


    $perPage = 6; // Items per page here

    $lastPage = ceil($rows / $perPage); // Get the value of the last page


    // Be sure URL variable $page(page number) is no lower than page 1 and no higher than $lastpage

    if($page < 1){ // If it is less than 1

        $page = 1; // force if to be 1

    }elseif($page > $lastPage){ // if it is greater than $lastpage

        $page = $lastPage; // force it to be $lastpage's value
    }



    $middleNumbers = ''; // Initialize this variable

    // This creates the numbers to click in between the next and back buttons


    $sub1 = $page - 1;
    $sub2 = $page - 2;
    $add1 = $page + 1;
    $add2 = $page + 2;



    if($page == 1){
        $middleNumbers .= '<li class="page-item active"><a>' .$page. '</a></li>';

        $middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$add1.'">' .$add1. '</a></li>';

    } elseif ($page == $lastPage) {
        $middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$sub1.'">' .$sub1. '</a></li>';
        $middleNumbers .= '<li class="page-item active"><a>' .$page. '</a></li>';

    }elseif ($page > 2 && $page < ($lastPage -1)) {
        $middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$sub2.'">' .$sub2. '</a></li>';

        $middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$sub1.'">' .$sub1. '</a></li>';

        $middleNumbers .= '<li class="page-item active"><a>' .$page. '</a></li>';

        $middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$add1.'">' .$add1. '</a></li>';

        $middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$add2.'">' .$add2. '</a></li>';

    } elseif($page > 1 && $page < $lastPage){
        $middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page= '.$sub1.'">' .$sub1. '</a></li>';

        $middleNumbers .= '<li class="page-item active"><a>' .$page. '</a></li>';

        $middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$add1.'">' .$add1. '</a></li>';
    }


    // This line sets the "LIMIT" range... the 2 values we place to choose a range of rows from database in our query


    $limit = 'LIMIT ' . ($page-1) * $perPage . ',' . $perPage;

    // $query2 is what we will use to to display products with out $limit variable

    $query2 = query(" SELECT * FROM products $limit");
    confirm($query2);

    $outputPagination = ""; // Initialize the pagination output variable

    if($page != 1){

        $prev  = $page - 1;

        $outputPagination .='<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$prev.'">Back</a></li>';
    }

    // Lets append all our links to this variable that we can use this output pagination

    $outputPagination .= $middleNumbers;


    // If we are not on the very last page we the place the next link

    if($page != $lastPage){
        $next = $page + 1;

        $outputPagination .='<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$next.'">Next</a></li>';
    }

    while($row = fetch_array($query2)) {
        $product_image = display_image($row['product_image']);

        $product = <<<DELIMETER
<div class="col-sm-4 col-lg-4 col-md-4">
    <div class="thumbnail">
        <a href="item.php?id={$row['product_id']}"><img style="height:90px" src="../resources/{$product_image}" alt=""></a>
        <div class="caption">
            <h4 class="pull-right">&#36;{$row['product_price']}</h4>
            <h4><a href="item.php?id={$row['product_id']}">{$row['product_title']}</a>
            </h4>
            <p>{$row['short_desc']}</p>
             <a class="btn btn-primary" target="_blank" href="../resources/cart.php?add={$row['product_id']}">K˙più !</a>
        </div>
    </div>
</div>
DELIMETER;

        echo $product;
    }
    echo "<div style='clear:both' class='text-center'><ul class='pagination'>{$outputPagination}</ul></div>";
}

require_once("functions.php");

?>