

<?php require_once("../../connect.php");


      if(isset($_GET['id'])) {


          $query = query("DELETE FROM products WHERE product_id = " . escape_string($_GET['id']) . " ");
          confirm($query);


          set_message("Produkt bol odstránený");
          redirect("../admin.php?link=product.php");


      } else {

          redirect("../admin.php?link=product.php");


      }
