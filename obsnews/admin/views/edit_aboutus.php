<main>
    <div class="wrap aboutus">
        <p class="title">Немного о нас:</p>
        <form action="" method="post" role="form" enctype="multipart/form-data">
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
                    } ?></p>
                <div class="form-group">
                    <textarea name="text" class="form-control"
                              style="height: 250px;"><?php echo !empty($data['info']['text']) ? htmlspecialchars($data['info']['text']) : ''; ?></textarea>
                    <p class="info"><?php if (isset($data['errors']['text'])) {
                            echo $data['errors']['text'];
                        } ?></p>
                </div>
                <p class="title" style="width: 50%;">Свяжитесь с нами:</p>
                <div class="form-group">
                    <input type="text" name="address" class="form-control"
                           value="<?php echo !empty($data['info']['address']) ? htmlspecialchars($data['info']['address']) : ''; ?>">
                    <p class="info"><?php if (isset($data['errors']['address'])) {
                            echo $data['errors']['address'];
                        } ?></p>
                </div>
                <div class="form-group">
                    <input type="text" name="phone" class="form-control"
                           value="<?php echo !empty($data['info']['phone']) ? htmlspecialchars($data['info']['phone']) : ''; ?>">
                    <p class="info"><?php if (isset($data['errors']['phone'])) {
                            echo $data['errors']['phone'];
                        } ?></p>
                </div>
                <div class="form-group">
                    <input type="text" name="email" class="form-control"
                           value="<?php echo !empty($data['info']['email']) ? htmlspecialchars($data['info']['email']) : ''; ?>">
                    <p class="info"><?php if (isset($data['errors']['email'])) {
                            echo $data['errors']['email'];
                        } ?></p>
                </div>
                <div class="form-group">
                    <button type="submit" name="edit_aboutus" class="btn btn-primary">Редактировать страницу</button>
                </div>
        </form>
    </div>
</main>