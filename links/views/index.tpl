<!DOCTYPE HTML>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Создание коротких ссылок</title>
    <meta name="description" content="Поможем Вам создатькороткие ссылки. Заходите!">
    <meta name="keywords" content="Кроткие ссылки, создание коротких ссылок">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css"
          integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link href="views/css/styles.css" rel="stylesheet" type="text/css">
</head>
<body>
    <header>
        <nav>
            <a href="/index.php?route=home">Home</a>/
            <a href="/index.php?route=testLink">TestLink</a>
        </nav>
    </header>
    <div class="include">
        <?php  echo $content; ?>
    </div>
    <footer>
        <span> © 2018 | </span><a href="#">&nbsp;Privacy Policy</a>
    </footer>
</body>
</html>
