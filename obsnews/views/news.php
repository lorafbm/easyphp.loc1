<?php getHeader(); ?>
<main>
    <div class="wrap">
        <?php
        foreach ($data['news'] as $news) { ?>
            <div class="col-xs-12">
                <img src="<?php echo $news['news_img']; ?>" width="200px" alt="pic1">
                    <h3><?php echo htmlspecialchars($news['news_name']); ?></h3>
                    <p class="bold"><?php echo htmlspecialchars($news['short_description']); ?></p>
                    <p class="cont"><?php echo htmlspecialchars($news['description']); ?></p>
                    <div class="news_info">
                        <?php echo htmlspecialchars($news['date']); ?> | Автор:
                        <?php echo htmlspecialchars($news['author']); ?> | Количество просмотров: <?php if(!empty($news['q_view'])){ echo (int)$news['q_view']; } ?>
                    </div>
                            </div>
            <?php } ?>
    </div>
</main>
<?php getFooter(); ?>