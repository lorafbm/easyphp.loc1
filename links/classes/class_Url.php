<?php

class Url
{

    public $url;
    public $short_url;
    private $key;

    public function __construct($url, $short_url)
    {
        $this->url = $url;
        $this->short_url = $short_url;
    }

    /**
     * creates uniq key for the short url
     * @return mixed
     */
    protected function createKey(){

        $url = 'http://links/-';
        $key = substr(time(), -3) . substr(md5($url), 0, 5);
        $this->key = $key;

        return $key;
    }

    /**
     * @param $url string
     * @param bool $short_url_exists if true - do like in form, if false - create short url
     * @return $short_url string
     */
    public function makeShortUrl()
    {
        $url = 'http://links/-';
        $this->short_url = trim($this->short_url);

        if (!$this->short_url) {
            $short_url = $url . self::createKey();

        } else {
            $short_url = $url . $this->short_url;
        }
        $this->short_url = $short_url;

        return $short_url;
    }

    /** get url from DB
     * @return bool|mixed|mysqli_result
     */
    public function showUrl($url)
    {
        $show_url = q("SELECT *
                       FROM `urls`
                       WHERE `url` = '".trim($url)."'
                      ");

        return $show_url;
    }

}