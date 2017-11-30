<?php getHeader(); ?>
<main>
    <div class="wrap">
        <p class="title">Последние новости:</p>
        <p class="text-danger"><?php echo((!empty($_SESSION['info'])) ? $_SESSION['info'] : ''); ?></p>
        <div class="container">
            <div class="row">
                <?php foreach ($data['news'] as $news) { ?>
                    <div class="col-md-4">
                        <a href="/index.php?route=news&news_id=<?php echo (int)$news['news_id'] ?>">
                            <img src="<?php echo htmlspecialchars($news['news_img']); ?>" width="200px" alt="pic1">
                            <h3><?php echo htmlspecialchars($news['news_name']); ?></h3>
                            <p><?php echo htmlspecialchars($news['short_description']); ?></p>
                            <?php foreach ($data['cat_info'] as $key) {
                            if ($news['category_id'] == $key['category_id']) { ?>
                            <p><span><?php echo htmlspecialchars($key['category_name']);
                                    }
                                    } ?></span></p>
                            <div class="news_info ">
                                <?php echo htmlspecialchars($news['date']); ?> | Автор:
                                <?php echo htmlspecialchars($news['author']); ?>
                                <img src="/image/view.svg" width="20px" ;
                                     height="12px;"/><?php if (!empty($news['q_view'])) {
                                    echo $news['q_view'];
                                } ?>
                            </div>
                        </a>
                        <hr>
                    </div>
                    <?php
                } ?>
            </div>
        </div>
</main>
<?php getFooter(); ?>
