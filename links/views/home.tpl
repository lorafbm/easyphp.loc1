<div class="container">
    <p><?php echo !empty($info) ? $info : ''; ?></p>
    <h1>Make short URL</h1>
    <fieldset>
        <form action="" method="post" role="form">
            <div class="form-group center">
                <input type="text" name="url" class="form-control"
                       placeholder="enter your long URL"
                       value="<?php echo !empty($_SESSION['url']) ? htmlspecialchars($_SESSION['url']) : ''; ?>">
                <?php if (!empty($_SESSION['error_url'])) {
                    echo '<span style="color: red;">' . $_SESSION['error_url'] . '</span>';
                } ?>
            </div>
            <div class="form-group center">
                <label for="short_url">https://yoursite.com/short/</label><input type="text" name="short_url"
                                                                                 id="short_url" class="form-control"
                                                                                 placeholder=" enter your style of short URL: letters, numbers, dashes*"
                                                                                 value="">
                <?php if (!empty($_SESSION['error_short_url'])) {
                    echo '<span style="color: red;">' . $_SESSION['error_short_url'] . '</span>';
                } ?>
            </div>
            <p>*if empty we'll genarate it automatically</p>
            <div class="form-group center">
                <input type="submit" name="submit" id="make_short_url" value="Submit" class="btn btn-info">
            </div>
        </form>
    </fieldset>
    <?php if (!empty($show_url)) {
        if ($row = mysqli_fetch_assoc($show_url)) { ?>
            <p>URL: <?php echo $row['url']; ?></p>
            <p >Short URL: <a class="white" href="<?php echo $row['short_url'] ?>"><?php echo $row['short_url']; ?></p>
        <?php }} ?>
</div>