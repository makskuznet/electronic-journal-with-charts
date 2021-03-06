<?php
$db = new mysqli('localhost', 'root', "", 'kurswork');	//здесь надо поставить свои данные

session_start();
$data_min = $_SESSION['data_min'];
$data_max = $_SESSION['data_max'];

$date_mark = [];
$subjects_data = [];

$get_name = $db->query("SELECT DISTINCT name FROM `subject` WHERE date BETWEEN '$data_min' AND '$data_max'");
while($uniq_subject = $get_name->fetch_array(MYSQLI_BOTH)){
	$get_date = $db->query("SELECT DISTINCT date FROM `subject` WHERE name='$uniq_subject[0]' AND date BETWEEN '$data_min' AND '$data_max' ORDER BY date ASC");
	while($uniq_date = $get_date -> fetch_array(MYSQLI_BOTH)){
		// echo $uniq_date[0];
		$get_mark_count = $db->query("SELECT mark FROM `subject` WHERE name='$uniq_subject[0]' AND date='$uniq_date[0]'");
		$mark_count = $get_mark_count -> num_rows;
		$get_mark = $db->query("SELECT SUM(mark) FROM `subject` WHERE name='$uniq_subject[0]' AND date='$uniq_date[0]'");
		$mark_sum = $get_mark->fetch_array(MYSQLI_BOTH);
		// echo "</br>","ср. оц = ", $mark_sum[0]/$mark_count,'(',$uniq_subject[0],')', "</br>";
		$date_mark[] = [$uniq_date[0], $mark_sum[0]/$mark_count];
	}
	$subjects_data[] = [$uniq_subject[0], $date_mark];
	unset($date_mark);
}
// echo "</br>",var_dump($subjects_data), "</br>";
echo json_encode($subjects_data);
$get_date->free();
$db->close();
?>