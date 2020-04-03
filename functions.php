<?php

$upload_directory = "upload/";

function redirect($location){
    return header("Location: $location ");
}


function set_message($msg){

    if(!empty($msg)) {

        $_SESSION['message'] = $msg;

    } else {
        $msg = "";
    }
}


function display_message() {
    if(isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }
}




function query($sql) {
    global $connection;
    return mysqli_query($connection, $sql);

}

function confirm($result){
    global $connection;
    if(!$result) {
        die("QUERY FAILED " . mysqli_error($connection));
	}
}


function escape_string($string){
    global $connection;
    return mysqli_real_escape_string($connection, $string);
}



function fetch_array($result){
    return mysqli_fetch_array($result);
}


function display_image($picture) {
    global $upload_directory;
    return $upload_directory . $picture;
}

function get_products_in_admin(){
    $query = query(" SELECT * FROM products");
    confirm($query);

    while($row = fetch_array($query)) {

       // $category = show_product_category_title($row['product_category_id']);

        $product_image = display_image($row['product_image']);

        $product = <<<DELIMETER
        <tr>
            <td>{$row['product_id']}</td>
            <td>
             <a href="admin.php?link=edit_product.php&id={$row['product_id']}"><p>{$row['product_title']}</p></a>
            <div>
            <img width='100' src="../../$product_image" alt="">
            </div>
            </td>
            <td>{$row['short_desc']}</td>
            <td>{$row['product_price']}</td>
            <td>{$row['product_quantity']}</td>
             <td><a class="btn btn-danger" href="pages/delete_product.php?id={$row['product_id']}"><span class="glyphicon glyphicon-remove">Vymazať</span></a></td>
        </tr>
DELIMETER;

        echo $product;
    }
}




function update_product() {
    if(isset($_POST['update'])) {

        $product_title          = escape_string($_POST['product_title']);
        $product_category_id    = escape_string($_POST['product_category_id']);
        $product_price          = escape_string($_POST['product_price']);
        $product_description    = escape_string($_POST['product_description']);
        $short_desc             = escape_string($_POST['short_desc']);
        $product_quantity       = escape_string($_POST['product_quantity']);
        $product_image          = escape_string($_FILES['file']['name']);
        $image_temp_location    = escape_string($_FILES['file']['tmp_name']);

        if(empty($product_image)) {

            $get_pic = query("SELECT product_image FROM products WHERE product_id =" .escape_string($_GET['id']). " ");
            confirm($get_pic);

            while($pic = fetch_array($get_pic)) {

                $product_image = $pic['product_image'];
            }
        }

        move_uploaded_file($image_temp_location  , UPLOAD_DIRECTORY . $product_image);

        $query = "UPDATE products SET ";
        $query .= "product_title            = '{$product_title}'        , ";
        $query .= "product_category_id      = '{$product_category_id}'  , ";
        $query .= "product_price            = '{$product_price}'        , ";
        $query .= "product_description      = '{$product_description}'  , ";
        $query .= "short_desc               = '{$short_desc}'           , ";
        $query .= "product_quantity         = '{$product_quantity}'     , ";
        $query .= "product_image            = '{$product_image}'          ";
        $query .= "WHERE product_id=" . escape_string($_GET['id']);

        $send_update_query = query($query);
        confirm($send_update_query);
        set_message("Produkt bol aktualizovaný");
        redirect("admin.php?link=product.php");
    }
}




function add_product() {
    if(isset($_POST['publish'])) {

        $product_title          = escape_string($_POST['product_title']);
        $product_category_id    = escape_string($_POST['product_category_id']);
        $product_price          = escape_string($_POST['product_price']);
        $product_description    = escape_string($_POST['product_description']);
        $short_desc             = escape_string($_POST['short_desc']);
        $product_quantity       = escape_string($_POST['product_quantity']);
        $product_image          = escape_string($_FILES['file']['name']);
        $image_temp_location    = escape_string($_FILES['file']['tmp_name']);

        copy($image_temp_location  , UPLOAD_DIRECTORY . DS . $product_image);

        $query = query("INSERT INTO products(product_title, product_category_id, product_price, product_description, short_desc, product_quantity, product_image) VALUES('{$product_title}', '{$product_category_id}', '{$product_price}', '{$product_description}', '{$short_desc}', '{$product_quantity}', '{$product_image}')");
        $last_id = last_id();
        confirm($query);
        set_message("Nový produkt s id {$last_id} bol pridaný");
        redirect("admin.php?link=product.php");
    }

}


function display_orders(){
    $query = query("SELECT * FROM orders");
    confirm($query);

    while($row = fetch_array($query)) {
        $orders = <<<DELIMETER
<tr>
    <td>{$row['order_id']}</td>
    <td>{$row['Name']}</td>
    <td>{$row['Surname']}</td>
    <td>{$row['Company']}</td>
    <td>{$row['Street']}</td>
    <td>{$row['Zip_code']}</td>
    <td>{$row['City']}</td>
    <td>{$row['Phone']}</td>
    <td>{$row['Email']}</td>
    <td><a class="btn btn-danger" href="pages/delete_order.php?id={$row['order_id']}"><span class="glyphicon glyphicon-remove">Vymazať</span></a></td>
</tr>
DELIMETER;

        echo $orders;
    }
}



function get_reports(){
    $query = query(" SELECT * FROM reports");
    confirm($query);

    while($row = fetch_array($query)) {
        $report = <<<DELIMETER
        <tr>
             <td>{$row['report_id']}</td>
            <td>{$row['product_id']}</td>
            <td>{$row['order_id']}</td>
            <td>{$row['product_price']}</td>
            <td>{$row['product_title']}
            <td>{$row['product_quantity']}</td>
            <td><a class="btn btn-danger" href="pages/delete_report.php?id={$row['report_id']}"><span class="glyphicon glyphicon-remove">Vymazať</span></a></td>
        </tr>
DELIMETER;

        echo $report;
    }
}

