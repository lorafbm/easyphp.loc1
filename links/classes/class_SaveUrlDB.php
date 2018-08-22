<?php
class SaveUrlDB extends SaveUrl
{
    public function saveDB()
    {
        if (!is_array($this->url) && !is_array($this->short_url)) {
            $this->url = trim($this->url);
            $this->short_url = trim($this->short_url);
            q("INSERT INTO `urls` SET
              `url`              = '" . res($this->url) . "',
              `short_url`        = '" . res($this->short_url) . "',
              `kee`              = '"  .res($this->createKey())."',
              `date`             = NOW()
              ");
        }
    }
}