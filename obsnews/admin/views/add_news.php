<?php getHeader_a(); ?>
<main>
    <div class="wrap">
       <div class="wrapper_addnews">
            <p>Новая новость:</p>
            <!--<img src="/photo/<?php if (isset($_POST['add_news'])){echo $data['img'];} ?>">-->
            <form action="" method="post" role="form" enctype="multipart/form-data">
                <div class="form-group">
                Категория новости:<select name="category">
                        <?php   foreach ($data['category_info'] as $key) {
                            echo  '<option  value="'.$key['category_id'].'">'.$key['category_name'].'</option>';
                        } ?>
                    </select>
                </div>
                <div class="form-group">
                    <input type="file" name="file">
                    <p class="info"><?php if (isset($data['errors']['file'])) {
                            echo $data['errors']['file'];
                        } ?></p>
                </div>
                <div class="form-group">
                        <textarea name="add_news_name" class="form-control"
                                  placeholder="Введите заголовок новости"
                                  ><?php if (isset($_POST['add_news_name'])) {
                                echo htmlspecialchars($_POST['add_news_name']);
                            } ?></textarea>
                    <p class="info"><?php if (isset($data['errors']['add_news_name'])) {
                        echo $data['errors']['add_news_name'];
                        } ?></p>
                </div>
                <div class="form-group">
                        <textarea name="add_short_description" class="form-control"
                                  placeholder="Введите краткое описание новости"
                                  ><?php if (isset($_POST['add_short_description'])) {
                                echo htmlspecialchars($_POST['add_short_description']);
                            } ?></textarea>
                    <p class="info"><?php if (isset($data['errors']['add_short_description'])) {
                        echo $data['errors']['add_short_description'];
                    } ?></p>
                </div>
                <div class="form-group">
                        <textarea name="add_description" class="form-control"
                                  placeholder="Введите полный текст новости"
                                  ><?php if (isset($_POST['add_description'])) {
                                echo htmlspecialchars($_POST['add_description']);
                            } ?></textarea>
                    <p class="info"><?php if (isset($data['errors']['add_description'])) {
                        echo $data['errors']['add_description'];
                        } ?></p>
                </div>
                <div class="form-group">
                    <input type="text" name="add_author" class="form-control"
                           placeholder="Введите автора новости"
                           value="<?php if (isset($_POST['add_author'])) {
                               echo htmlspecialchars($_POST['add_author']);
                           } ?>">
                    <p class="info"><?php if (isset($data['errors']['add_author'])) {
                        echo $data['errors']['add_author'];
                        } ?></p>
                </div>
                <div class="form-group">
                    <button type="submit" name="add_news" class="btn btn-primary">Добавить новость</button>
                </div>
            </form>
        </div>
    </div>
</main>
<?php getFooter_a(); ?>

