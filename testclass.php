<?php
Class A{

    public $adult_amount=1;
    public $child_amount=2;
    public $child_ages=array(1,5);
    public $parse_result=array(0=>array('econom_r'=> array('val'=>1), 'econom_l'=> array('val'=>1)),1=>array('econom_r'=> array('val'=>1), 'econom_l'=> array('val'=>1)));

    /**
     * check_seats_to_accomodation - отсеиваем туры у которых  мест < размещения
     */
    public function check_seats_to_accomodation(){

        if(!empty($this->parse_result)) {
            if($this->child_amount > 0) {
                $i=0;
                foreach($this->child_ages as $age) {
                    // если возраст ребенка >= 2лет то нужен отдельный билет
                    if ($age >= 2) {
                        $i += 1;
                    }
                }
                $q=$i+ $this->adult_amount;
            }


            foreach($this->parse_result as $key => $value) {
                if(is_numeric($value['econom_r']['val'])) {
                    if($value['econom_r']['val'] <  $q) {
                         $this->parse_result[$key]['econom_r']['val'] = 'N';
                    }
                }

                if(is_numeric($value['econom_l']['val'])) {
                    if($value['econom_l']['val'] <  $q) {
                        $this->parse_result[$key]['econom_l']['val'] = 'N';
                    }
                }
            }
        }
        return;
    }
}
function wtf($array, $stop = false)
{ // вывод массива
    echo '<pre>' . print_r($array, 1) . '</pre>';
    if (!$stop) {
        exit();
    }
}
$a=new a;
//wtf($a->parse_result);
echo $a->check_seats_to_accomodation();
//wtf($a->parse_result);