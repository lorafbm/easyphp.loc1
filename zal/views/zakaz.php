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
                           class="text-danger"><b>Удалить заказ</b></a>
                        <hr>
                    <?php } ?>
                </div>
                <p class="text-left"><?php echo 'Итого на сумму: <b>' . array_sum($data['cost']) . ' грн.</b>'; ?></p>
            <?php } else {
                ?>
                <h3>У вас пока нет заказов!</h3>
            <?php } ?>
            <hr style="border-top: 1px solid #ffffff;">
            <h4>Ваши данные:</h4>
                <p class="text-left"><?php echo '<span>Ваш ID:</span><b> ' . $_SESSION['user']['user_id']; ?></b></p>
                <p class="text-left"><?php echo '<span>Ваш login: </span><b>' . $_SESSION['user']['user_name'] . '</b>'; ?></p>
                <p class="text-left"><?php  if (!empty ($_SESSION['user']['email'])) { echo '<span>Email: </span><b>' . $_SESSION['user']['email'] . '</b>';} else { echo '<span>Email: </span>'; } ?></p>
                <p class="text-left">
                    <a href="#" id="del_f" style="display:<?php echo (!empty($_SESSION['flag_f'])) ? 'block':'none' ?>;" onclick="delAdd('del_f',<?php echo $_SESSION['user']['id']; ?>);return false;"><b>Отвязать facebook</b></a>
                    <a href="#" id="add_f" style="display:<?php echo (!empty($_SESSION['flag_f'])) ? 'none':'block' ?>;" onclick="delAdd('add_f',<?php echo $_SESSION['user']['id']; ?>);return false;"><b>Привязать facebook</b></a></p>
       <?php } else { ?>
            <p>Авторизуйтесь для просмотра заказов!</p> <?php } ?>
    </div>
    </main>
<?php
//wtf($data,1);
//wtf($_SESSION['user'],1);
//wtf($_SESSION['flag_f'],1);
getFooter(); ?>