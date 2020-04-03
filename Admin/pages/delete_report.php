<?php require_once("../../connect.php");


      if(isset($_GET['id'])) {


          $query = query("DELETE FROM reports WHERE report_id = " . escape_string($_GET['id']) . " ");
          confirm($query);


          set_message("Preh¾ad bol odstránený");
          redirect("../admin.php?link=reports.php");


      } else {

          redirect("../admin.php?link=reports.php");


      }






?>