<?php
function make_date($str, array &$errors){
	$number = explode('.', $str);
	if ((iconv_strlen ($number[0]) > 2) or ($number[0] > 31) or (iconv_strlen ($number[1]) > 2) or (iconv_strlen ($number[2]) != 4) or ($number[1] > 12) or (strtotime($str) === false)){
		array_push($errors, 'Неверный формат даты, введите дату в формате d.m.yyyy');
	}
	else{
		return date('Y-m-d', strtotime($str));
	}
}
?>