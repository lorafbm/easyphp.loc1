<?php getHeader(); ?>
    <main>
        <div class="wrap">
            <p class="title">Популярное:</p>
            <div class="container">
                <div class="row">
                    <?php foreach ($data['news'] as $news) { ?>
                        <div class="col-md-4">
                            <a href="/index.php?route=news&news_id=<?php echo $news['news_id'] ?>">
                                <img src="<?php echo $news['news_img']; ?>" width="200px" alt="pic1">
                                <h3><?php echo $news['news_name'] ?></h3>
                                <p><?php echo $news['short_description'] ?></p>
                                <?php foreach ($data['category_info'] as $key1) {
                                if ($news['category_id'] == $key1['category_id']) { ?>
                                <p><span><?php echo htmlspecialchars($key1['category_name']);
                                        }
                                        } ?></span></p>
                                <div class="news_info ">
                                    <?php echo $news['date']; ?> | Автор:
                                    <?php echo $news['author']; ?>
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