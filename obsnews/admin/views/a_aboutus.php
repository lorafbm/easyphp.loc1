<main>
    <div class="wrap aboutus">
        <?php if (isset($_SESSION['info_a_aboutus'])) { ?>
        <h3><?php echo $_SESSION['info_a_aboutus'];
            } ?></h3>
        <a href="/index.php?route=admin&page=edit_aboutus"
           class="glyphicon glyphicon-pencil" style="margin-bottom: 20px;"> Редактировать страницу</a>
        <p class="title">Немного о нас:</p>
        <a class="fancybox" rel="gallery1" href="<?php echo $data['info']['img1']; ?>"
           title="Крутая фотка">
            <img src="<?php echo $data['info']['img1']; ?>"  alt="pic1"></a>
        <a class="fancybox" rel="gallery1" href="<?php echo $data['info']['img2']; ?>"
           title="Крутая фотка">
        <img src="<?php echo $data['info']['img2']; ?>" alt="pic2"></a>
        <a class="fancybox" rel="gallery1" href="<?php echo $data['info']['img3']; ?>"
           title="Крутая фотка">
            <img src="<?php echo $data['info']['img3']; ?>" alt="pic3"></a>
        <h3><?php echo htmlspecialchars($data['info']['title']); ?></h3>
        <p class="cont column"><?php echo htmlspecialchars($data['info']['text']); ?></p>
        <p class="title" style="width: 50%;">Свяжитесь с нами:</p>
        <p><?php echo htmlspecialchars($data['info']['address']); ?></p>
        <p><?php echo htmlspecialchars($data['info']['phone']); ?></p>
        <p><?php echo htmlspecialchars($data['info']['email']); ?></p>
    </div>
</main>