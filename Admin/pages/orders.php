 <div class="col-md-12">
<div class="row">
<h1 class="page-header">
   Všetky objednávky

</h1>

<h4 class= "bg-success"><?php display_message(); ?></h4>
</div>

<div class="row">
<table class="table table-hover">
    <thead>

      <tr>
           <th>id</th>
           <th>Meno</th>
           <th>Priezvisko</th>
           <th>Spoločnosť</th>
           <th>Ulica</th>
            <th>PSČ</th>
           <th>Mesto</th>
           <th>Mobil</th>
           <th>Email</th>           
   
      </tr>
    </thead>
    <tbody>
        <?php display_orders(); ?>

    </tbody>
</table>
</div>
</div>