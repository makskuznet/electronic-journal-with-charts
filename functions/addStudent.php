<?php
require __DIR__ . "/db.php";

$data = $_POST;
if(isset($data['do_signup'])){
    //регистрация происходит здесь
    $errors = array();
    //проверка

    if(trim($data['userName']) == ''){
        $errors[] = 'Имя не введено';
    }
    if(trim($data['tel']) == ''){
        $errors[] = 'Номер телефона не введен';
    }
    if($data['numZach'] == ''){
        $errors[] = 'Номер зачетки не введен';
    }
    if($data['kurs'] == 'Выбор курса'){
        $errors[] = 'Курс не введен';
    }

//проверка на существование одинакового логина
    if ( R::count('student', "num_zach = ?", array($data['numZach'])) > 0)
    {
        $errors[] = 'Студент с таким номером зачетки уже сущесвует';
    }

    if ( R::count('student', "tel = ?", array($data['tel'])) > 0)
    {
        $errors[] = 'Студент с таким номером телефона уже сущесвует';
    }


    if(empty($errors)){
        //занесение юзеров в бд
        $user = R::dispense('student');
        $user->name = $data['userName']; 
        $user->tel = $data['tel'];
        $user->num_zach = $data['numZach'];
        $user->kurs = $data['kurs'];
        R::store($user);
        echo '<div style="color:green;">Регистрация прошла успешно<br> 
            Можете добавить еще студента или прейти на <a href="/"> главную страницу </a> </div>';
    }else{
        echo '<div style = "color: #ff0000;"> ' .array_shift($errors).'</div>';
    }
}
?>
 <!-- Кнопки и текстбоксы -->
<form action="addStudent.php" method="POST">

    <p>
        <input type = "text" name = "userName" placeholder="Имя" value="<?php echo @$data['userName'];?>">
    </p>

    <p>
        <input type = "tel" name = "tel" placeholder="Номер телефона" value="<?php echo @$data['tel'];?>">
    </p>
    <p>
        <input type = "text" name = "numZach" placeholder="Номер зачетной книжки" value="<?php echo @$data['numZach'];?>">
    </p>
    <p>

        <select name = "kurs"  value="<?php echo @$data['kurs'];?>">
            <option>Выбор курса</option>
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
        </select>
    </p>
    <p>
        <button type = "submit" name = "do_signup">Зарегистрироваться
        </button>
    </p>
</form>





<?php

$student = R::findAll( 'student' );

?>
<table border="1" align="center">
    <center><h1>таблица студентов</h1></center>
    <tr>
        <td> ID </td>
        <td> name </td>
        <td> tel </td>
        <td> num_zach </td>
        <td> kurs </td>
    </tr>
    <?php foreach($student as $stud): ?>
        <tr>
            <td><?=$stud['id']?></td>
            <td><?=$stud['name']?></td>
            <td><?=$stud['tel']?></td>
            <td><?=$stud['num_zach']?></td>
            <td><?=$stud['kurs']?></td>
        </tr>
    <?php
    endforeach;
    ?>
