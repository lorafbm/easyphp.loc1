<?php getHeader_a(); ?>
    <main>
        <div class="row">
            <div class="container">
                <?php if (isset($_SESSION['info_cat'])) { ?>
                <h3><?php echo $_SESSION['info_cat'];
                    } ?></h3>
                <?php if (isset($error)){ ?>
                <h3><?php echo $error;
                    } ?></h3>
                <div class="col-md-10 col-sm-10">
                    <a href="/index.php?route=admin&page=add_category" class="btn btn-primary"><span class="glyphicon glyphicon-plus-sign
" aria-hidden="true"></span>&nbsp;&nbsp;Добавить категорию</a>
                    <form action="" method="post">
                        <table class="table table-striped">
                            <tr class="bg-info">
                                <th></th>
                                <th>ID</th>
                                <th>Название категории</th>
                                <th>Описание</th>
                                <th>Title категории</th>
                                <th></th>
                                <th></th>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <div class="input-group">
                                        <input type="text" name="name" class="form-control"
                                               placeholder="Поиск по категории"
                                               value="<?php if (isset($_POST['name'])) {
                                                   echo $_POST['name'];
                                               } ?>">
                                        <span class="input-group-btn">
                        <input type="submit" name="search" class="btn btn-default" value="Искать!">
                    </span>
                                    </div><!-- /input-group -->
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <?php if (!empty($data['category_info'])) {
                                foreach ($data['category_info'] as $key) { ?>
                                    <tr>
                                        <td><input type="checkbox" name="ids[]"
                                                   value="<?php echo (int)$key['category_id']; ?>"></td>
                                        <td><?php echo (int)$key['category_id']; ?></td>
                                        <td><?php echo htmlspecialchars($key['category_name']); ?></td>
                                        <td><?php echo htmlspecialchars($key['category_description']); ?></td>
                                        <td><?php echo !empty($key['title']) ? htmlspecialchars($key['title']) : ''; ?></td>
                                        <td>
                                            <a href="/index.php?route=admin&page=edit_category&id=<?php echo (int)$key['category_id']; ?>"
                                               class="glyphicon glyphicon-pencil"></a></td>
                                        <td>
                                            <a href="/index.php?route=admin&page=a_categories&action=delete&category_id=<?php echo (int)$key['category_id']; ?>"
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