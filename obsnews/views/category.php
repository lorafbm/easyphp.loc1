<main>
    <div class="wrap">
        <?php
        if (!empty($data['news'])) { ?>
        <p class="title">У нас <?php echo $data['num']; ?> новостей в категории <?php echo htmlspecialchars($data['category']); ?></p>
        <?php echo paginator((int)$_GET['key'], $data['count_pages'], $data['url'], $data['url_page']); ?>
        <div class="container">
            <div class="row">
                       <?php foreach ($data['news'] as $news) { ?>
                        <div class="col-md-4">
                            <a href="/index.php?route=news&&news_id=<?php echo $news['news_id'] ?>">
                                <img src="<?php echo $news['news_img']; ?>" width="200px" alt="pic1">
                                <h3><?php echo htmlspecialchars($news['news_name']); ?></h3>
                                <p><?php echo htmlspecialchars($news['short_description']); ?></p>
                                <p><span><?php echo htmlspecialchars($data['category']); ?></span></p>
                                <div class="news_info">
                                    <?php echo htmlspecialchars($news['date']); ?> | Автор:
                                    <?php echo htmlspecialchars($news['author']); ?> |
                                    <img src="/image/view.svg" width="20px"; height="12px;"/><?php if(!empty($news['q_view'])){ echo (int)$news['q_view']; } ?>
                                </div>
                            </a>
                            <hr>
                        </div>
                    <?php }
                } else{
                echo 'Пока нет новостей в этой категории!';
                }  ?>
            </div>
        </div>
    </div>
</main>


