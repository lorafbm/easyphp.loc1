<?php getHeader(); ?>
    <div class="container">
        <?php if (isset($_SESSION['user'])) {
            echo '<h6>' . ((isset($_SESSION['info_zakaz'])) ? $_SESSION['info_zakaz'] : '') . '</h6>';
            if (!empty($data)) {
                ($data['zakaz'][0]['cnt'] == 1) ? $zakaz = 'заказ:' : '';
                ($data['zakaz'][0]['cnt'] > 1 && $data['zakaz'][0]['cnt'] <= 4) ? $zakaz = 'заказа:' : '';
                ($data['zakaz'][0]['cnt'] > 4) ? $zakaz = 'заказов:' : ''; ?>
                <h4>У вас <?php echo $data['zakaz'][0]['cnt'] . ' ' . $zakaz; ?> </h4>
                <div class="zakaz">
                    <?php foreach ($data['zakaz'] as $k => $v) { ?>
                        <p class="text-left"><?php echo '<span>Дата заказа:</span> ' . $data1->printData1($v['data_zakaz']); ?></p>
                        <p class="text-left"><?php echo '<span>Событие: </span><b>' . $v['name'] . '</b>'; ?></p>
                        <p class="text-left"><?php echo '<span>Дата: </span><b>' . $data1->printData($v['date_start']) . '</b>'; ?></p>
                        <p class="text-left"><?php echo '<span>Ряд: </span> ' . $v['row']; ?></p>
                        <p class="text-left"><?php echo '<span>Место:</span> ' . $v['place']; ?></p>
                        <p class="text-left"><?php echo '<span>Категория места:</span> ' . $v['category_name']; ?></p>
                        <p class="text-left"><?php echo '<span>Цена билета:</span> <b>' . $v['price'] . 'грн.</b>'; ?></p>
                        <a href="/index.php?route=zakaz&action=delete&id=<?php echo $v['zakaz_id']; ?>"
                           class="text-danger">Удалить заказ</a>
                        <hr>
                    <?php } ?>
                </div>
                <p class="text-left"><?php echo 'Итого на сумму: <b>' . array_sum($data['cost']) . ' грн.</b>'; ?></p>
            <?php } else {
                ?>
                <h3>У вас пока нет заказов!</h3>
            <?php }
        } else { ?>
            <p>Авторизуйтесь для просмотра заказов!</p> <?php } ?>
    </div>
    </main>
<?php
//wtf($data1,1);
getFooter(); ?>