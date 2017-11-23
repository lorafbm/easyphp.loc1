<?php
echo 'занятие 18. Основы ООП.<br>';

class CarAuto
{
    public $color = '';
    const QWERTY = 45;

    public function ololo($name = 'DEF')
    {
        return 'hello' . $name . 'Color' . $this->color;

    }

    public function www()
    {
        return $this->ololo() . 'function www';
    }

    public function qqq(){
        return 'Const ='.self::QWERTY;
        //return 'Const ='.CarAuto::QWERTY;
    }
}

$auto = new CarAuto;

echo $auto->color . '<br>';
$auto->color = 'black';
echo $auto->color . '<br>';

$auto2 = new CarAuto;
echo $auto2->color . '<br>';
echo $auto2->ololo($auto2->color) . '<br>';
echo $auto->www() . '<br>';
echo CarAuto::QWERTY;
echo $auto->qqq();










