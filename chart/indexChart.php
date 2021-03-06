<?php
require(__DIR__ . '/functions/functions.php');

session_start();

$db = new mysqli('localhost', 'root', "", 'kurswork');	//здесь надо поставить свои данные
$get_dates = $db->query("SELECT MIN(date), MAX(date) FROM `subject`");
$maxmin_dates = $get_dates->fetch_array(MYSQLI_BOTH);
$data = $_POST;
if(isset($data['create'])){
	$errors = array();
	if(trim($data['date1']) == ''){
		$errors[] = 'Дата начала интервала не введена';
  	}
  if(trim($data['date2']) == ''){
		$errors[] = 'Дата конца интервала не введена';
	}
  $data_min = make_date(trim($data['date1']), $errors);
  $data_max = make_date(trim($data['date2']), $errors);
  if ($data_max < $data_min){
	  $errors[] = 'Даты должны быть по возрастанию';
  }
if(empty($errors)){


		 $_SESSION['data_min'] = $data_min;
		 $_SESSION['data_max'] = $data_max;

		 header("Location: chart_draw/chart.html");
}else{
	echo '<div style = "color: #ff0000;"> ' .array_shift($errors).'</div>';
}
}
?>
<!DOCTYPE html>
<html>
 <head>
  <meta charset="utf-8">
  <title>Выбор временного интервала</title>
 </head>
 <body>
  <form method="post" action="">
  Выберите крайние даты, по которым будет строиться график:
   <p><input name="date1" type="text" value=<?php echo date('d.m.Y', strtotime($maxmin_dates[0]))?>> - 
	<input name="date2" type="text" value=<?php echo date('d.m.Y', strtotime($maxmin_dates[1]))?>>
	<p><button type = "submit" name = "create">Построить график
        </button>
  </form>
  </body>
</html>