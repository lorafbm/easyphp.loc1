<?php

Class SaveUrl extends Url
{
    /**
     * determines where short link will be saved  (DB or file)
     * @param bool $file
     * @return mixed|void
     */
    public function save($file = false)
    {
        if (empty ($file)) {
            $saveUrlDB = new SaveUrlDB($this->url, $this->short_url);
            $saveUrlDB->saveDB();
        } else {
           // @TODO save in file
        }
    }
}