<?php
require "db.php";

$data = $_POST;
if(isset($data['add'])){
    //регистрация происходит здесь
    $errors = array();
    //проверка


    if(trim($data['name']) == ''){
        $errors[] = 'Название предмета не введено';
    }
    if(trim($data['date']) == '') {
        $errors[] = 'Дата не введена';
    }
    if(trim($data['mark']) == 'Выбор оценки') {
        $errors[] = 'оценка не введена';
    }

    if(empty($errors)){

        $stud = R::dispense('student');
        $stud->id =  $data['idStud'];
        $subj = R::dispense('subject');
        $subj->name = $data['name'];
        $subj->date = $data['date'];
        $subj->mark = $data['mark'];
        $stud->ownSubjList[] = $subj;

        R::store($stud);
        echo '<div style="color:green;">Регистрация прошла успешно<br>
                    Можете добавить еще предмет или прейти на <a href="/"> главную страницу </a> </div>';
    }else{
        echo '<div style = "color: #ff0000;"> ' .array_shift($errors).'</div>';
    }


}
?>
<!-- Кнопки и текстбоксы -->
<form action="addSubj.php" method="POST">

    <script type="text/javascript" src="codebase/calendar.js?v=6.5.1"></script>
    <link rel="stylesheet" href="codebase/calendar.css?v=6.5.1">

    <p>
        <input type = "text" list="subj" name = "name" placeholder="Название " value="<?php echo @$data['name'];?>">
        <datalist type = "text" id = "subj">
            <option value="Математика">
            <option value="Русский">
            <option value="История">
            <option value="Базы Данных">
            <option value="Иностранный язык">
            <option value="Социология">
            <option value="Политология">
            <option value="Экономика">
            <option value="Теория устойчивости">
        </datalist>
    </p>
    <p>         <inp
    <p>
        <section class="dhx_sample-container">
            <div class="dhx_sample-form-group dhx_form-group">
                <label for="date-input" class="dhx_sample-label">

                    <input type="text" name = "date" id="date-input" placeholder="Дата проведения" class="dhx_input dhx_sample-input" style="width: 180px;" readonly data-widget-control value="<?php echo @$data['date'];?>">
                </label>
            </div>
        </section>

        <script>
            // init calendar without container, use null instead of container
            var calendar = new dhx.Calendar(null, {dateFormat: "20%y-%m-%d"});
            // init popup and attach calendar
            var popup = new dhx.Popup();
            popup.attach(calendar);
            // when calendar value changed, it trigger update input value and hide popup
            calendar.events.on("change", function() {
                dateInput.value = calendar.getValue();
                popup.hide();
            });
            var dateInput = document.getElementById("date-input");
            // on input click we show popup
            dateInput.addEventListener("click", function() {
                popup.show(dateInput);
            });
        </script>
    </p>

    <p>

        <select name = "mark"  value="<?php echo @$data['mark'];?>">
            <option>Выбор оценки</option>
            <option>5</option>
            <option>4</option>
            <option>3</option>
            <option>2</option>
        </select>
    </p>
    <p>
        <input type = "text" name = "idStud" placeholder="ID студента " value="<?php echo @$data['idStud'];?>">
    </p>
    <p>
        <button type = "submit" name = "add">Добавить</button>
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



