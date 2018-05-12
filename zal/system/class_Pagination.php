<?php

/*private $host;
private $user;
private $password;
private $db;


function __construct($host, $user, $password, $db)
{
    $this->host = $host;
    $this->user = $user;
    $this->password = $password;
    $this->db = $db;
}

private function myconnect()
{
    return mysqli_connect($this->host, $this->user, $this->password, $this->db);
}

public function myquery($sql)
{
    return mysqli_query($this->myconnect(), $sql);
}



// запрос в БД
public function q($query, $key = 0)
{
    $connect = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
    $res = mysqli_query($connect, $query);

    if ($res === false) {
        $info = debug_backtrace();
        $error = "QUERY: " . $query . "<br>\n" .
            "error: " . mysqli_error($connect) . "<br>\n" .
            "the error in file:" . $info[0]['file'] . "<br>\n" .
            "on the line: " . $info[0]['line'] . "<br>\n" .
            "date: " . date("Y-m-d H-i-s") . "<br>\n" .
            "=======================================================";

        echo $error;
        exit();
    } else {
        return $res;
    }
}*/


class Pagination
{

    public $count_show_pages; // сколько блоков выводить на странице
    public $page; //на какой мы странице находимся
    public $num; // сколько у нас всего блоков в бд
    public $page_name;////на какой мы странице выводим пагинатор


    function __construct($count_show_pages, $page, $num, $page_name)
    {
        $this->count_show_pages = (int)$count_show_pages;
        $this->page = (int)($page);
        $this->num = (int)$num;
        $this->page_name = htmlspecialchars($page_name);
    }

    public function count_limit($page_num)// с какой записи выводить
    {
        if ((int)$page_num && $page_num > 0) {
            $limit = (int)$page_num * $this->count_show_pages - $this->count_show_pages;
        } else {

            $limit = 0;
        }
        return $limit;
    }


    function paginator()
    {
        $url = '/index.php?route=' . $this->page_name;
        $url_page = '/index.php?route=' . $this->page_name . '&key=';
        $page = $this->page;
        $count_pages = ($this->num - 1) / ($this->count_show_pages + 1);

        if ($page != 1) {
            $p1 = '<a class="pag" href = "' . htmlspecialchars($url) . '" title = "Первая страница" >&lt;&lt;&lt;</a>';

            if ($page == 2) {
                $p2 = '<a class="pag" href = "' . htmlspecialchars($url) . '"title = "Предыдущая страница" >&lt;</a>';
            } else {
                $p2 = '<a class="pag" href = "' . htmlspecialchars($url_page) . (int)($page - 1) . '"title = "Предыдущая страница">&lt;</a>';
            }

        } else {
            $p1 = "";
            $p2 = "";
        }

        if ($page - 2 > 0) {
            $page2left = ' <a class ="pag" href=' . htmlspecialchars($url_page) . (int)($page - 2) . '>' . ($page - 2) . '</a>  ';

        } else {
            $page2left = "";
        }
        if ($page - 1 > 0) {
            $page1left = '<a class="pag" href=' . htmlspecialchars($url_page) . (int)($page - 1) . '>' . ($page - 1) . '</a> ';

        } else {
            $page1left = "";
        }
        if ($page + 2 <= $count_pages) {
            $page2right = '  <a class="pag" href=' . htmlspecialchars($url_page) . (int)($page + 2) . '>' . ($page + 2) . '</a>';
        } else {
            $page2right = "";
        }
        if ($page + 1 <= $count_pages) {
            $page1right = '  <a class="pag" href=' . htmlspecialchars($url_page) . (int)($page + 1) . '>' . ($page + 1) . '</a>';
        } else {
            $page1right = "";
        }
        if ($page != $count_pages) {
            $p3 = '<a class="pag" href="' . htmlspecialchars($url_page) . (int)($page + 1) . '" title="Следующая страница">&gt;</a>
                    <a class="pag" href="' . htmlspecialchars($url_page) . (int)$count_pages . '" title="Последняя страница">&gt;&gt;&gt;</a>';
        } else {
            $p3 = "";
        }

        $paginator = '<div class="paginator">' . $p1 . $p2 . $page2left . $page1left . '<a class="pagact" href=' . $url_page . $page . '>' . $page . '</a>' . $page1right . $page2right . $p3 . '</div><div class="clear"></div>';

        return $paginator;
    }

}