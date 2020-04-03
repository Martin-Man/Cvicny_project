
<h1 class="page-header">
    Všetky produkty

</h1>

<h3 class="bg-success">
    <?php display_message(); ?>
</h3>
<table class="table table-hover">

    <thead>

        <tr>
            <th>Id</th>
            <th>Číslo produktu</th>
            <th>Číslo objednávky</th>
            <th>Cena</th>
            <th>Názov produktu</th>
            <th>Množstvo produktu</th>
        </tr>
    </thead>
    <tbody>

        <?php get_reports(); ?>

    </tbody>
</table>