<?php
require "db.php";
require_once 'function.php';
$data = $_POST;
if(isset($data['add'])) {
    $stud = R::dispense('student');
    $stud->id =  $data['idStud'];
    $subj = R::dispense('subject');
    $subj->id =  $data['idSub'];

    $mark = R::dispense('mark');

    $mark->mark = $data['mark'];




    $stud->ownMarkList[] = $mark;
    $subj->ownMarkList[] = $mark;
    R::store($stud);
    R::store($subj);

    echo '<div style="color:green;">Добавление оценки<br> 
Можете добавить еще оценку или прейти на <a href="/"> главную страницу </a> </div>';
}
?>
<!-- Кнопки и текстбоксы -->
<form action="addMark.php" method="POST">

    <p>
        <input type = "text" name = "idStud" placeholder="ID студента " value="<?php echo @$data['idStud'];?>">
    </p>

    <p>
        <input type = "text" name = "idSub" placeholder="ID предмета" value="<?php echo @$data['idSub'];?>">
    </p>

    <p>
        <input type = "text" name = "mark" placeholder="Оценка" value="<?php echo @$data['mark'];?>">
    </p>
    <p>
        <button type = "submit" name = "add">Добавить</button>
    </p>
</form>

<?php

$query = R::findAll( 'mark' );

?>
<table border="1" align="center">
    <center><h1>таблица оценок</h1></center>
    <tr>
        <td> ID </td>
        <td> student_id </td>
        <td>student_name</td>
        <td> subject_id </td>
        <td> subject_name </td>
        <td> mark </td>

    </tr>

    <?php foreach($query as $item): ?>

        <tr>
            <td><?=$item['id']?></td>
            <td><?=$studentID = $item['student_id']?></td>
            <td><?=findName('student', $studentID);?></td>
            <td><?=$subjectID = $item['subject_id']?></td>
            <td><?=findName('subject', $subjectID);?></td>
            <td><?=$item['mark']?></td>

        </tr>
    <?php endforeach;?>

    </body>
    </html>
</table>

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


    <?php

    $subject = R::findAll( 'subject' );

    ?>
    <table border="1" align="center">
        <center><h1>таблица предметов</h1></center>
        <tr>
            <td> ID </td>
            <td> name </td>
            <td> date</td>
            <td> mid_num </td>

        </tr>
        <?php foreach($subject as $subj):?>
            <tr>
                <td><?=$subj['id']?></td>
                <td><?=$subj['name']?></td>
                <td><?=$subj['date']?></td>
                <td><?=$subj['mid_num']?></td>

            </tr>
        <?php endforeach;
        ?>
        </body>
        </html>
    </table>






