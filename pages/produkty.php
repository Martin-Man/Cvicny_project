<?php

 $sql = "SELECT * FROM products";
//$sql = "SELECT * FROM knihy WHERE autor LIKE 'Ján PILLÁR 1'";	//ORDER BY xxxx LIMIT 9
$result = $conn->query($sql);






?>



<h3>Produkty</h3>
<br />
<?php
if ($result->num_rows > 0) {
?>   
<div class="card-columns">
    <?php
    while($row = $result->fetch_assoc()) {
    ?>

    <div class="card" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title">
                <?=$row["product_title"]?>
            </h5>
            <h6 class="card-subtitle mb-2 text-muted">
                <?=$row["product_id"]?>
            </h6>
            <p class="card-text">
                <?=$row["short_desc"]?>
            </p>
            <h5 class="card-title">
                <?=$row["product_price"]?>&euro;
            </h5>
        </div>
    </div>
    <?php
    }
    ?>
</div>
<?php
    } else {
    echo "0 results";
    }
    $conn->close();
?>
