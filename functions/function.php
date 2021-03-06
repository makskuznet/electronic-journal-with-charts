<?php
// дата rand(1,31) . '.' . rand(1, 12) . '.' . rand(1990, 2020)
function debug($bug){
    echo "<pre>" . print_r($bug, 1) . "</pre>";
}
function findName($table, $num, $whatFind = 'name'){
    $name = R::findOne($table , "id = $num");
    echo $name[$whatFind];
}

function randStr($length = 10) {

    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function randStud(){
         $user = R::dispense('student');
         $user->name = randStr(5) . ' ' . randStr(5) . ' ' . randStr(5);
         $user->tel = '+79' . rand(100000000, 999999999);
         $user->num_zach = microtime();
         $user->kurs = rand(1,6);
         R::store($user);
}
function randSubj(){
    $subj = R::dispense('subject');
    $subj->name = randStr();
    $subj->date = rand(1,31) . '.' . rand(1, 12) . '.' . rand(1990, 2020);
    $subj->mid_num = rand(2, 5);
    R::store($subj);
}
