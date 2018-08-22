<?php

class Validation
{
    /**
     * validate form field for emptiness add/or length
     * @param $name string
     * @param bool $length
     * @param bool $url
     * @return string
     */

    public function val_Field($name, $url = false, $l = false, $empty=false)
    {
        $name = trim($name);

        if($empty == 1){
            if (empty($name)) {

                return 'The field is empty!';
            }
        }
        if ($l ==1) {

            $length = mb_strlen($name);

            if ($length < 10) {

                return 'Less than 10 symbols Too short!';
            } elseif ($length > 500) {

                return 'More than 500 symbols Too long!';
            }
        }
        if ($url) {
            if (!filter_var($name, FILTER_VALIDATE_URL, FILTER_FLAG_HOST_REQUIRED)) {

                return 'Enter url correct!';
            }
        }
    }

    /**
     * check shorturl if contains only letters, numbers, dashes
     * @param $shortUrl
     * @return string
     */

    public function valShortUrl($shortUrl){
        $shortUrl = trim($shortUrl);

        if(preg_match('#[^(\w)|(\x7F-\xFF)]#',$shortUrl)){

            return ' Only letters, numbers, dashes';
        }
    }

    /**
     * check if url exists in DB yet
     * @param $url
     * @return bool
     */
    public function url_exists_DB($url)
    {
        $url = trim($url);
        $res = q("SELECT `id`
                  FROM `urls`
                    WHERE `url` = '" . $url . "'
                    LIMIT 1
                  ");
        if (mysqli_num_rows($res)) {

            return true;
        }
    }

}
