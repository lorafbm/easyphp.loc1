<?php getHeader_a($data); ?>
<main>
    <div class="wrap">
        <p>Редактировать новость:</p>
        <div class="wrapper_addnews">
            <form action="" method="post" role="form" enctype="multipart/form-data">
                <?php foreach ($data['news'] as $key) { ?>
                    <img src="<?php echo $key['news_img']; ?>" alt="img">
                    <div class="form-group">
                        <input type="file" name="file"
                               value="<?php echo !empty($key['news_img']) ? htmlspecialchars($key['news_img']) : ''; ?>">
                        <p class="info"><?php if (isset($data['errors']['file'])) {
                                echo $data['errors']['file'];
                            } ?></p>
                    </div>
                    <div class="form-group">
                        Категория новости:<select name="category">
                            <?php foreach ($data['category_info'] as $key1) { ?>
                                <option value=" <?php echo (int)$key1['category_id']; ?>"
                                    <?php if ($key['category_id'] == $key1['category_id']) { ?> selected <?php } ?>>
                                    <?php echo htmlspecialchars($key1['category_name']); ?></option>;
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <textarea name="edit_news_name" class="form-control"
                                  placeholder="Введите заголовок новости"
                        ><?php echo !empty($key['news_name']) ? htmlspecialchars($key['news_name']) : ''; ?></textarea>
                        <p class="info"><?php if (isset($data['errors']['edit_news_name'])) {
                                echo $data['errors']['edit_news_name'];
                            } ?></p>
                    </div>
                    <div class="form-group">
                        <textarea name="edit_short_description" class="form-control short"
                                  placeholder="Введите краткое описание новости"
                        ><?php echo !empty($key['short_description']) ? htmlspecialchars($key['short_description']) : ''; ?></textarea>
                        <p class="info"><?php if (isset($data['errors']['edit_short_description'])) {
                                echo $data['errors']['edit_short_description'];
                            } ?></p>
                    </div>
                    <div class="form-group">
                        <textarea name="edit_description" class="form-control full"
                                  placeholder="Введите полный текст новости"
                        ><?php echo !empty($key['description']) ? htmlspecialchars($key['description']) : ''; ?></textarea>
                        <p class="info"><?php if (isset($data['errors']['edit_description'])) {
                                echo $data['errors']['edit_description'];
                            } ?></p>
                    </div>
                    <div class="form-group">
                        <input type="text" name="edit_author" class="form-control"
                               placeholder="Введите автора новости"
                               value="<?php echo !empty($key['author']) ? htmlspecialchars($key['author']) : ''; ?>">
                        <p class="info"><?php if (isset($data['errors']['edit_author'])) {
                                echo $data['errors']['edit_author'];
                            } ?></p>
                    </div>
                <?php } ?>
                <div class="form-group">
                    <button type="submit" name="edit_news" class="btn btn-primary">Редактировать новость</button>
                </div>
            </form>
        </div>
    </div>
</main>
<?php getFooter_a(); ?>

