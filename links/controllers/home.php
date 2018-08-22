<?php
$_SESSION['error_url'] = '';
$_SESSION['error_short_url'] = '';
$_SESSION['url'] = '';
$_SESSION['short_url'] = '';


$validation = new Validation();

if (isset($_POST['submit'])) {
    // form validation
    $_SESSION['error_url'] = $validation->val_Field($_POST['url'], 1, 1, 1);
    $_SESSION['url'] = $_POST['url'];
    if (!$validation->val_Field($_POST['url'], 1, 1, 1)) {
        $flag_url = 1;
    }
    if (!empty($_POST['short_url'])) {
        $_SESSION['short_url'] = $_POST['short_url'];
        $_SESSION['error_short_url'] = $validation->valShortUrl($_POST['short_url']);
        if (!$validation->valShortUrl($_POST['short_url'])) {
            $flag_short_url = 1;
        }
    } else {
        $flag_short_url = 1;
    }
    // if no errors in the form
    if (!empty($flag_url) && !empty($flag_short_url)) {
        $url = new Url($_POST['url'], $_POST['short_url']);
        //check DB if exists
        if (!$validation->url_exists_DB($_POST['url'])) {
            //generate short link
            $short_url = $url->makeShortUrl();
            //save short link
            $saveUrl = new SaveUrl($_POST['url'], $short_url);
            $saveUrl->save();
            $show_url = $url->showUrl($url->url);
            $info = 'Your link has successfully created!';

        } else {
            $show_url = $url->showUrl($_POST['url']);
            $info = 'Your link\'s already exists!';
        }
    }

}
