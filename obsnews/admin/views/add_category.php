<?php getHeader_a(); ?>
<main>
    <div class="wrap">
        <?php if (isset($_SESSION['info_cat'])) { ?>
        <h3><?php echo $_SESSION['info_cat'];
            } ?></h3>
        <div class="wrapper_add">
            <fieldset>
                <p>Ввести категорию:</p>
                <form action="" method="post" role="form">
                    <div class="form-group">
                        <input type="text" name="add_name" class="form-control"
                               placeholder="Введите название категории"
                               value="">
                    </div>
                    <div class="form-group">
                        <input type="text" name="add_catdesc" class="form-control"
                               placeholder="Введите описание категории"
                               value="">
                    </div>
                    <div class="form-group">
                        <input type="text" name="add_title" class="form-control"
                               placeholder="Если необходимо -  введите title"
                               value="">
                    </div>
                    <div class="form-group">
                        <button type="submit" name="submit" class="btn btn-primary">Добавить категорию</button>
                    </div>
                </form>
            </fieldset>
        </div>
    </div>
</main>
<?php getFooter_a(); ?>

