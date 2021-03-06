<?php

require_once  realpath('../functions/db.php');
require_once  realpath('../functions/function.php');


$user = R::dispense('student');
$user->name = 'CRON' . ' ' . randStr(5) . ' ' . randStr(5) . ' ' . randStr(5);
$user->tel = '+79' . rand(100000000, 999999999);
$user->num_zach = microtime();
$user->kurs = rand(1,6);
R::store($user);




$subj = R::dispense('subject');
$subj->name = 'CRON' . ' ' . randStr();
$subj->date = rand(1,31) . '.' . rand(1, 12) . '.' . rand(1990, 2020);
$subj->mid_num = rand(2, 5);
R::store($subj);
