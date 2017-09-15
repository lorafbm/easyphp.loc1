<?php
$mass = array();

for ($i = 1; $i < 10; $i++) {
    for ($j = 1; $j <= 9; $j++) {
        $mass[$i][$j] = $i * $j;
    }
}

echo '<p style="text-align: center; color: #265a88;">Домашнее задание к уроку №3. Таблица умножения.</p>';
echo '<table border="2" bgcolor="#add8e6"  cellpadding="5px" align="center" style="border-collapse: collapse; border-color: #2b669a;">';
foreach ($mass as $key1 => $value1) {
    echo '<tr>';
    foreach ($value1 as $key2 => $value2) {
        echo '<td>' . $key2 . ' * ' . $key1 . ' = ' . $value2 . '</td>';
    }
    echo '</tr>';
}

