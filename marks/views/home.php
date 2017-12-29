<?php getHeader(); ?>
<div class="container" >
    <?php echo (isset ($_SESSION['info_a'])) ? '<p>' . $_SESSION['info_a'] . '</p>' : ''; ?>






    <div id="map" style="width: 800px; height: 600px" ></div>
</div>
</main>
<?php getFooter(); ?>
