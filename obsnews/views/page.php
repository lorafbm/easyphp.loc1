<?php getHeader(); ?>
    <main>
        <div class="wrap aboutus">
            <p class="title"><?php echo htmlspecialchars($data['info']['name']); ?></p>
            <?php if (!empty($data['info']['img1'])) { ?>
                <a class="fancybox" rel="gallery1" href="<?php echo $data['info']['img1']; ?>"
                   title="Наша команда">
                    <img src="<?php echo $data['info']['img1']; ?>" alt="pic1"></a>
            <?php } ?>
            <?php if (!empty($data['info']['img2'])) { ?>
                <a class="fancybox" rel="gallery1" href="<?php echo $data['info']['img2']; ?>"
                   title="Наша команда">
                    <img src="<?php echo $data['info']['img2']; ?>" alt="pic2"></a>
            <?php } ?>
            <?php if (!empty($data['info']['img3'])) { ?>
                <a class="fancybox" rel="gallery1" href="<?php echo $data['info']['img3']; ?>"
                   title="Наша команда">
                    <img src="<?php echo $data['info']['img3']; ?>" alt="pic3"></a>
            <?php } ?>
            <h3><?php echo htmlspecialchars($data['info']['title']); ?></h3>
            <p class="column"><?php echo htmlspecialchars($data['info']['text']); ?></p>
        </div>
    </main>
<?php getFooter(); ?>