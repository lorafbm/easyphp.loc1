<?php getHeader(); ?>
<div class="container">
    <?php echo (isset ($_SESSION['info_a'])) ? '<p>' . $_SESSION['info_a'] . '</p>' : '';
    echo $data->paginator(); ?>
    <h4>У нас <?php echo !empty ($data1['num']) ? $data1['num'] . ' спектаклей!' : ' пока нет событий!'; ?></h4>
    <div class="container">
        <div class="row">
          <?php if(!empty( $data1['events'])){?>
            <?php foreach ($data1['events'] as $key => $value) { ?>
                <div class="col-md-4">
                    <?php echo '<img src="' . htmlspecialchars($value['img']) . '" alt="image" class="imgbb" width=300px; height=300px;>';
                    echo '<h3><a href="/index.php?route=kassa&event_id=' . $value['id'] . '">' . htmlspecialchars($value['name']) . '</a></h3>';
                    echo '<p>Начало: ' . htmlspecialchars($data2->printData2($value['date_start'])) . '</p>';
                    echo '<p>до : ' . htmlspecialchars($data2->printData1($value['date_end'])) . '</p>';
                    echo '<p>Автор: ' . htmlspecialchars($value['auth']) . '</p>';
                    echo '<p>Режиссер: ' . htmlspecialchars($value['reg']) . '</p>';
                    echo '<p>Художник-постановщик: ' . htmlspecialchars($value['hud']) . '</p>';
                    echo '<p class="justify">Актеры: ' . htmlspecialchars($value['act']) . '</p>'; ?>
                </div>
            <?php }} ?>
        </div>
    </div>
</div>
</main>
<?php getFooter(); ?>
