<?php
$arr = array(
    array('name'=>'tuan' , 'age'=>21 , 'gender'=>'male' ),
    array('name'=>'tai' , 'age'=>21 , 'gender'=>'male' ),
    array('name'=>'huy' , 'age'=>20 , 'gender'=>'famale' ),
    array('name'=>'thien' , 'age'=>19 , 'gender'=>'famale' )
);

echo "<pre>";
print_r(array_rand($arr,2));
echo "</pre>";
