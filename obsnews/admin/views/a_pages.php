<?php getHeader_a(); ?>
    <main>
        <div class="row">
            <div class="container">
                <?php if (isset($_SESSION['info_page'])) { ?>
                <h3><?php echo $_SESSION['info_page'];
                    } ?></h3>
                <?php if (isset($error)){ ?>
                <h3><?php echo $error;
                    } ?></h3>
                <div class="col-md-10 col-sm-10">
                    <a href="/index.php?route=admin&page=add_page" class="btn btn-primary"><span class="glyphicon glyphicon-plus-sign
" aria-hidden="true"></span>&nbsp;&nbsp;Добавить страницу</a>
                    <form action="" method="post">
                        <table class="table table-striped">
                            <tr class="bg-info">
                                <th></th>
                                <th>ID</th>
                                <th>Название страницы</th>
                                <th>Редактировать</th>
                                <th>Удалить</th>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <?php if (!empty($data['page_info'])) {
                                foreach ($data['page_info'] as $key) { ?>
                                    <tr>
                                        <td><input type="checkbox" name="ids[]"
                                                   value="<?php echo (int)$key['id']; ?>"></td>
                                        <td><?php echo (int)$key['id']; ?></td>
                                        <td><?php echo htmlspecialchars($key['name']); ?></td>
                                        <td>
                                            <a href="/index.php?route=admin&page=edit_page&id=<?php echo (int)$key['id']; ?>"
                                               class="glyphicon glyphicon-pencil"></a></td>
                                        <td>
                                            <a href="/index.php?route=admin&page=a_pages&action=delete&id=<?php echo (int)$key['id']; ?>"
                                               onclick="return del();"
                                               class="glyphicon glyphicon-remove"></a>
                                        </td>
                                    </tr>
                                <?php }
                            } else { ?>
                                <p>Ничего не найдено!</p>
                            <?php } ?>
                        </table>
                        <input type="submit" name="delete" value="Удалить выбранное"
                               onclick="return del();"
                               class="btn btn-danger">
                    </form>
                </div>
            </div>
        </div>
    </main>
<?php getFooter_a(); ?>