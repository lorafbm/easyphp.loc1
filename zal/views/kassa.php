<?php getHeader(); ?>
<div class="container">
    <?php
    echo '<h5 class="text-danger">' . ((isset($data['error'])) ? $data['error'] : '') . '</h5>';
    echo '<p>' . ((isset($data['info_kassa'])) ? $data['info_kassa'] : '') . '</p>';
    echo '<h6>' . ((isset($_SESSION['info_kassa'])) ? $_SESSION['info_kassa'] : '') . '</h6>';
    if (!empty($_GET['event_id'])) {
    if (isset($_SESSION['user'])){?>
    <h4>Выберите билеты:</h4>
    <div class="row justify-content-center">
        <form class="col-6" action="" method="post">
            <?php foreach ($data['tickets'] as $cats) { ?>
                <div>
                    <?php foreach ($cats as $row) {
                        foreach ($row as $key => $seats) { ?>
                            <div class="row align-items-center justify-content-center">
                                <?php echo '<span style="margin-right: 5px; font-size: 12px;">ряд ' . $key . '</span>';
                                foreach ($seats as $seat) { ?>
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label custom-checkbox">
                                            <input type="checkbox" name="ticket[]"
                                                   value="<?php echo $seat['ticket_id']; ?>" <?php if ($seat['ticket_status'] == 1) {
                                                    echo 'disabled';
                                                } ?> class="form-check-input custom-control-input"">
                                            <span class="custom-control-indicator text-center"
                                                  style="color: #ffffff;"><?php echo $seat['place']; ?></span>
                                            <span class="custom-control-description">&nbsp;</span>
                                        </label>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php }
                        echo '<h6 class="text-left">' . $seat['category_name'] . '</h6>';
                        echo '<p style="font-size: 12px; margin-bottom: 0;">Лимит заказа для одного пользователя - ' . $seat['limit_ticket'] . ' билета</p>';
                        echo '<p style="font-size: 12px;">Стоимость билета: - ' . $seat['price'] . ' грн.</p>';
                    } ?>
                    <hr>
                </div>
            <?php } ?>
            <button type="submit" name="submit" class="btn btn-outline-light btn-block" style="margin-bottom: 10px;">
                Заказать
            </button>
        </form>
        <?php  }
        } else {
            ?>
            <h4>В нашем театре доступны для заказа следующие категории билетов:</h4>
            <?php foreach ($data['tickets_category'] as $key => $v) {
                echo '<h6>' . $v['category_name'] . ':</h6>' . '<p>Цена: ' . $v['price'] . 'грн.<br>' . 'лимит при заказе- ' . $v['limit_ticket'] . ' билета</p>';

            }
            if (isset($_SESSION['user'])) {
                echo '<h4>Чтобы сделать заказ пройдите на главную и выберите спектакль!</h4>';
            } }?>

    </div>
</div>
</main>
<?php // wtf($data,1);
// wtf($data['limits'], 1);
// wtf($data['ids'],1);
// wtf($_POST,1);
getFooter(); ?>

