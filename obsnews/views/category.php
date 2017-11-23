<main>
    <div class="wrap">
        <?php if ($data['num'] != 0) { ?>
            <p class="title">У нас <?php echo $data['num']; ?> новостей в
                категории <?php echo htmlspecialchars($data['category']); ?></p>
        <?php } else { ?>
            <p class="title">У нас нет новостей в
                категории <?php echo htmlspecialchars($data['category']); ?></p>
        <?php } ?>
        <form action="" method="post">
            <div class="input-group " style="width: 50%; margin-bottom: 20px;">
                <input type="text" name="name" class="form-control"
                       placeholder="Поиск по заголовку новости"
                       value="<?php if (isset($_POST['name'])) {
                           echo $_POST['name'];
                       } ?>">
                <span class="input-group-btn">
                        <input type="submit" name="search" class="btn btn-default" value="Поиск">
                    </span>
            </div><!-- /input-group -->
        </form>
        <?php echo paginator((int)$_GET['key'], $data['count_pages'], $data['url'], $data['url_page']); ?>
        <div class="container">
            <div class="row">
                <?php if ($data['num'] != 0) {
                    if (!empty($data['news'])) {
                        foreach ($data['news'] as $news) { ?>
                            <div class="col-md-4">
                                <a href="/index.php?route=news&&news_id=<?php echo $news['news_id'] ?>">
                                    <img src="<?php echo $news['news_img']; ?>" width="200px" alt="pic1">
                                    <h3><?php echo htmlspecialchars($news['news_name']); ?></h3>
                                    <p><?php echo htmlspecialchars($news['short_description']); ?></p>
                                    <p><span><?php echo htmlspecialchars($data['category']); ?></span></p>
                                    <div class="news_info">
                                        <?php echo htmlspecialchars($news['date']); ?> | Автор:
                                        <?php echo htmlspecialchars($news['author']); ?> |
                                        <img src="/image/view.svg" width="20px" ;
                                             height="12px;"/><?php if (!empty($news['q_view'])) {
                                            echo (int)$news['q_view'];
                                        } ?>
                                    </div>
                                </a>
                                <hr>
                            </div>
                        <?php }
                    } else {
                        echo 'Ничего не найдено!';
                    }
                }
                ?>
            </div>
        </div>
    </div>
</main>


