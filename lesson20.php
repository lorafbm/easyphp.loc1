<?php
//echo 'занятие 20. Наследование. Инкапсуляция, Конструктор. Деструктор<br>';

/*class Transport{
    public $korpus;
    public $rul;
    public $kolesa;
    public $speed=5;

    public function qq(){
        return 'Hello transport';
    }
    public function ww($a){
        return$a/$this->speed;
    }
    public function easytime($distance){
        $time = $distance / $this->speed;
        return $time;
    }

}

class Auto extends Transport{
 public function qq(){
     return 'Hello auto';
 }
 public function newqq(){
     return parent::qq();
 }
}



class Velo extends Transport{
    public $speed = 20;
   /* public function easytime($distance){
       $time = parent::easytime($distance)*1.3;
       return $time;
    }*/
/*}*/

/*$auto=new Auto;
echo $auto->speed;
echo $auto->qq();
echo $auto->ww(100);
echo $auto->easytime(1000);
echo '<br>';
$velo=new Velo;
echo $velo->easytime(1000); // всеравно 50 т к $this берет из объекта*/


/*class B extends Velo{
    public  function qq(){
        return'Hello B';
    }
    public  function newqq(){
        return parent::qq();
    }
}

$b=new B;
echo $b->newqq();*/


//Class A{
//    function __construct()
//    {
//        echo 'This class '.__CLASS__.'<br>';
//    }
//}
//$a=new A; // это класс а
//
//class B extends A{
//    function __construct()
//    {
//        echo 'This class '.__CLASS__.'<br>';
//    }
//}
//
//$b=new B;


/*class A{
    public function a(){
        echo 'Hello';
    }
}
$a = new A;// если имя совп с классом то 4 php отр как констр-р*/

/*запрос в БД*/

class A
{
    private $host;
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
}


$a = new A('localhost', 'root', '', 'easyphp');
$q = $a->myquery("SELECT * FROM users");
while ($res[] = mysqli_fetch_array($q)) {
    $users = $res;
}
var_dump($res);


/*class Incap{
    public $a='public';
    protected $b = 'protected';
    private $c = 'private';

}



$incap=new Incap;
echo $incap->a.'<br>';*/

/*пример из книги по конструктору*/
/*class ShopProduct
{
    public $title = 'Стандартный товар';
    public $producerMainName = 'Фамилия автора';
    public $producerFirstName = 'Имя автора';
    public $price = 0;


    function _construct($title, $firstName, $mainName, $price)
    {
        $this->title = $title;
        $this->producerFirstName = $firstName;
        $this->producerMainName = $mainName;
        $this->price = $price;
    }

    function getProducer()
    {
        return $this->producerFirstName . $this->producerMainName;
    }
}

$Shop = new ShopProduct();
echo $Shop->getProducer();*/