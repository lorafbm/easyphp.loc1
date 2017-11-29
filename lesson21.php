<?php
session_start();

Class Form
{

    public function make_text($name, $place)
    {
        $field = '<input type="text" name=' . $name . ' placeholder = ' . $place . '>';
        return $field;
    }

    public function make_email($name, $place) // генерирую текст чтобпроверитьвалидацию а то браузер не дает
    {
        $field = '<input type="text" name=' . $name . ' placeholder = ' . $place . '>';
        return $field;
    }

    public function make_textarea($name, $place)
    {
        $field = '<textarea name=' . $name . ' placeholder = ' . $place . '></textarea>';
        return $field;
    }


    public function make_select($select_name, $q_option, $option_name = [])
    {
        $field = '<select name =' . $select_name . '>';

        for ($i = 0; $i < $q_option; $i++) {

            $field .= '<option value="' . $i . '">';

            $field .= $option_name[$i];

            $field .= '</option>';
        }
        $field .= '</select>';
        return $field;
    }

    public function inputRadio($radio_name, $radio_value, $radio_text)
    {
        $field_2 = '<label><input type="radio" name=' . $radio_name . ' value=' . $radio_value . '>' . $radio_text . '</label>';
        return $field_2;
    }


}


Class Valid
{

    public $error;

    public function val_Field($name, $dlinna = false, $email = false)
    {
        if ($dlinna == 1) {// на длинну
            if (empty($name)) {
                return $this->error = 'Поле не может быть пустым!';
            } else {
                $length = mb_strlen($name);
                if ($email) {
                    if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                        return true;
                    } else {
                        return $this->error = 'Введите правильно email!';
                    }
                } else {
                    if ($length < 2) {
                        return $this->error = ' Введите не менее 2-х символов!';

                    } elseif ($length > 16) {
                        return $this->error = 'Не более 16 символов!';

                    } else {
                        return true;
                    }
                }
            }

        } else {//только на пустоту
            if (isset($name)) {// для радио т к она вообще не приходит если пустая или чекбокс
                if (empty($name)) {

                    return $this->error = 'Поле не может быть пустым!';
                }
            } else {
                return $this->error = 'Сделайте все выборки!';
            }
        }

    }

}


$a = new Form;
$v = new Valid;
if (isset ($_POST['submit'])) {
    if (isset($_POST['text'])) {

        echo $v->val_Field($_POST['text'], 1);
    }
    if (isset($_POST['email'])) {
        echo $v->val_Field($_POST['email'], 1,1);

    }

    echo $v->val_Field($_POST['radio'], 0);
    echo $v->val_Field($_POST['color'], 0);


}


?>
<form action="" method="post">
    <?php echo $a->make_text('text', 'имя'); ?>
    <?php echo $a->make_email('email', 'email'); ?>
    <?php echo $a->make_select('color', 3, ['red', 'green', 'blue']); ?>
    <?php echo $a->inputRadio('radio', '1', 'мужчина'); ?>
    <?php echo $a->inputRadio('radio', '2', 'женщина'); ?>
    <input type=submit name="submit" value="Отправить">
</form>











