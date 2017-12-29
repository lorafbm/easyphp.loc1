<?php

class Geo
{
    /**
     * @var GOOGLE API KEY
     */
    public $user_api_key;

    function __construct($user_api_key)
    {
        $this->user_api_key = $user_api_key;
    }

    /**
     * @param $city - адрес в формате пр победы 12 харьков
     * @return array 1-широта 2- долгота 3- формат адрес
     */

   public function geocode($city)
    {
        $cityclean = str_replace(" ", "+", $city);
        $details_url = "https://maps.googleapis.com/maps/api/geocode/json?language=ru&address=" . $cityclean . "&sensor=false&key=" . $this->user_api_key;
        //echo $details_url;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $details_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER,false);
        curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST,false);
        $geoloc = json_decode(curl_exec($ch));

        $res = array();
        $res['lat_coord'] = $geoloc->results[0]->geometry->location->lat;
        $res['lng_coord'] = $geoloc->results[0]->geometry->location->lng;
        $res['loc'] = $geoloc->results[0]->formatted_address;

        return $res;
    }
// Перекодировка в UTF-8
  public  function cp1251_to_utf8_recursive(/*mixed*/ $map)
    {
        if (is_array($map))
        {
            $d = array();
            foreach ($d as $k => &$v)
            {
                $d[cp1251_to_utf8_recursive($k)] = cp1251_to_utf8_recursive($v);
            }
            return $d;
        }
        if (is_string($map)) return iconv('cp1251', 'utf-8//IGNORE//TRANSLIT', $map);
        if (is_scalar($map) or is_null($map)) return $map;
        #throw warning, if the $map is resource or object:
        trigger_error('An array, scalar or null type expected, ' . gettype($map) . ' given!', E_USER_WARNING);
        return $map;
    }


}

