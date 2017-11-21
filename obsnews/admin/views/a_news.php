<main>
    <div class="wrap">
        <?php if (isset($_SESSION['info_news'])) { ?>
        <h3><?php echo $_SESSION['info_news'];
            } ?></h3>
        <a href="/index.php?route=admin&page=add_news" class="btn btn-primary"><span class="glyphicon glyphicon-plus-sign
" aria-hidden="true"></span>&nbsp;&nbsp;Добавить новость</a>
        <?php echo paginator((int)$_GET['key'], $data['count_pages'], $data['url'], $data['url_page']); ?>
        <form action="" method="post">
            <div class="input-group " style="width: 50%; margin-bottom: 20px;">
                <input type="text" name="name" class="form-control"
                       placeholder="Поиск по заголовку новости"
                       value="<?php if (isset($_POST['name'])) {
                           echo $_POST['name'];
                       } ?>">
                <span class="input-group-btn">
                        <input type="submit" name="search" class="btn btn-default" value="Искать!">
                    </span>
            </div><!-- /input-group -->
            <?php if (!empty($data['news'])) {
                foreach ($data['news'] as $news) { ?>
                    <div class="col-xs-12 clearfix">
                        <img src="<?php echo $news['news_img']; ?>" width="200px" alt="pic1">
                        <div class="right">
                            <h3>
                                <?php echo htmlspecialchars($news['news_name']); ?>
                            </h3>
                            <p class="short"><?php echo htmlspecialchars($news['short_description']); ?></p>
                            <p class="cont short"><?php echo htmlspecialchars($news['description']); ?></p>
                            <?php foreach ($data['category_info'] as $key1) {
                            if ($news['category_id'] == $key1['category_id']) { ?>
                            <p class="cat"><?php echo htmlspecialchars($key1['category_name']);
                                }
                                } ?></p>
                            <div class="news_info">
                                <?php echo $news['date']; ?> | Автор:
                                <?php echo htmlspecialchars($news['author']); ?> |
                                <img src="/image/view.svg" width="20px" ; height="12px;"
                                     style="float: none; margin-right: 0;"/> <?php if (!empty($news['q_view'])) {
                                    echo (int)$news['q_view'];
                                } ?>
                            </div>
                        </div>
                        <input type="checkbox" name="ids[]"
                               value="<?php echo (int)$news['news_id']; ?>">
                        <a href="/index.php?route=admin&page=edit_news&id=<?php echo (int)$news['news_id']; ?>"
                           class="glyphicon glyphicon-pencil"></a>
                        <a href="/index.php?route=admin&page=a_news&action=delete&news_id=<?php echo (int)$news['news_id']; ?>"
                           onclick="return del();"
                           class="glyphicon glyphicon-remove"></a>
                        <hr>
                    </div>
                <?php }
            } else { ?>
                <p>Ничего не найдено!</p>
            <?php } ?>
            <input type="submit" name="delete" value="Удалить выбранное"
                   onclick="return del();"
                   class="btn btn-danger">
        </form>
    </div>
</main>
