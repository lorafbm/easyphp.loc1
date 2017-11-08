<main>
    <div class="wrap">
        <?php if (isset($_SESSION['info_cat'])) { ?>
        <h3><?php echo $_SESSION['info_cat'];
            } ?></h3>
        <div class="wrapper_add">
            <fieldset>
                <p>Редактировать категорию:</p>
                <?php foreach ($data['category_info'] as $key) { ?>
                    <form action="" method="post" role="form">
                        <div class="form-group">
                            <input type="text" name="edit_name" class="form-control"
                                   placeholder="Введите название категории"
                                   value="<?php echo htmlspecialchars($key['category_name']); ?>">
                        </div>
                        <div class="form-group">
                            <input type="text" name="edit_catdesc" class="form-control"
                                   placeholder="Введите описание категории"
                                   value="<?php echo htmlspecialchars($key['category_description']); ?>">
                        </div>
                        <div class="form-group">
                            <input type="text" name="edit_title" class="form-control"
                                   placeholder="Если необходимо -  введите title"
                                   value="<?php echo !empty($key['title']) ? htmlspecialchars($key['title']) : ''; ?>">
                        </div>
                        <div class="form-group">
                            <button type="submit" name="edit" class="btn btn-primary">Редактировать категорию</button>
                        </div>
                    </form>
                <?php } ?>
            </fieldset>
        </div>
    </div>
</main>


