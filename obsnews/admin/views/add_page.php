<?php getHeader_a(); ?>
<main>
    <div class="wrap aboutus">
        <form action="" method="post" role="form" enctype="multipart/form-data">
            <div class="form-group">
                <input type="text" name="name" class="form-control"
                       placeholder="Введите название страницы"
                       value="<?php echo !empty($data['info']['name']) ? htmlspecialchars($data['info']['name']) : ''; ?>">
                <p class="info"><?php if (isset($data['errors']['name'])) {
                        echo $data['errors']['name'];
                    } ?></p>
            </div>
            <a class="fancybox" rel="gallery1" href="<?php echo $data['info']['img1']; ?>"
               title="Крутая фотка1">
                <img src="<?php echo $data['info']['img1']; ?>" alt="pic1"></a>
            <div class="form-group">
                <input type="file" name="file1"
                       value="<?php echo !empty($data['info']['img1']) ? htmlspecialchars($data['info']['img1']) : ''; ?>">
                <p class="info"><?php if (isset($data['errors']['file1'])) {
                        echo $data['errors']['file1'];
                    } ?></p>
            </div>
            <a class="fancybox" rel="gallery1" href="<?php echo $data['info']['img2']; ?>"
               title="Крутая фотка2">
                <img src="<?php echo $data['info']['img2']; ?>" alt="pic2"></a>
            <div class="form-group">
                <input type="file" name="file2"
                       value="<?php echo !empty($data['info']['img2']) ? htmlspecialchars($data['info']['img2']) : ''; ?>">
                <p class="info"><?php if (isset($data['errors']['file2'])) {
                        echo $data['errors']['file2'];
                    } ?></p>
            </div>
            <a class="fancybox" rel="gallery1" href="<?php echo $data['info']['img3']; ?>"
               title="Крутая фотка1">
                <img src="<?php echo $data['info']['img3']; ?>" alt="pic3"></a>
            <div class="form-group">
                <input type="file" name="file3"
                       value="<?php echo !empty($data['info']['img3']) ? htmlspecialchars($data['info']['img3']) : ''; ?>">
                <p class="info"><?php if (isset($data['errors']['file3'])) {
                        echo $data['errors']['file3'];
                    } ?></p>
            </div>
            <div class="form-group">
                <input type="text" name="title" class="form-control"
                       placeholder="Введите заголовок"
                       value="<?php echo !empty($data['info']['title']) ? htmlspecialchars($data['info']['title']) : ''; ?>">
                <p class="info"><?php if (isset($data['errors']['title'])) {
                        echo $data['errors']['title'];
                    } ?></p></div>
            <div class="form-group">
                    <textarea name="text" class="form-control" placeholder="Введите текст"
                              style="height: 250px;"><?php echo !empty($data['info']['text']) ? htmlspecialchars($data['info']['text']) : ''; ?></textarea>
                <p class="info"><?php if (isset($data['errors']['text'])) {
                        echo $data['errors']['text'];
                    } ?></p>
            </div>
            <div class="form-group">
                <button type="submit" name="add_page" class="btn btn-primary">Добавить страницу</button>
            </div>
        </form>
    </div>
</main>
<?php getFooter_a(); ?>