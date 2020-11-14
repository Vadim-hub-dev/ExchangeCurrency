<!DOCTYPE html>
<html lang="ru">
<head>
	<title>Форма добавления сотрудника</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<meta content="text/html; charset=utf-8">
	
<style>
.form-list div 
{
	position: relative;
}
.form-control_error 
{
	border-color: IndianRed;
}
.error 
{
	display: none;
	font-size: 12px;
	color: white;
	position: absolute;
	left: 250px;
	top: calc(100% + 8px);
	z-index: 100;
	padding: 6px 10px 7px;
	border-radius: 6px;
	background: IndianRed;
}
.error:before 
{
	width: 0;
	height: 0;
	content: '';
	position: absolute;
	left: 15px;
	top: -7px;
	border-right: 8px solid;
	border-left: 8px solid;
	border-bottom: 8px solid IndianRed;
}
</style>
</head>
<body>
<?php 
require_once "../db.php"; // подключаем файл для соединения с БД
session_start();
if(isset($_SESSION['auth']))
{
$data = $_POST;

if(isset($data['newSotrud_name']))
{
        // Создаем массив для сбора ошибок
	$errors = array();

    // проверка на правильность написания Email
    if (!preg_match('/^[a-zA-Zа-яёА-ЯЁ\s]+$/iu', $data["newSotrud_name"]))
	{

	    $errors[] = 'Неверно введены имя и фамилия сотрудника';
    
    }
	
	if (!preg_match('/^[a-zA-Zа-яёА-ЯЁ\s]+$/iu', $data["newSotrud_dolzh"]))
	{

	    $errors[] = 'Неверно введена должность сотрудника';
    
    }
	
	if (!preg_match('/^[a-zA-Zа-яёА-ЯЁ\s]+$/iu', $data["newSotrud_otdel"]))
	{

	    $errors[] = 'Неверно введен отдел сотрудника';
    
    }
	
	if ($data["newSotrud_name"]) == "")
	{

	    $errors[] = 'Имя и фамилия сотрудника не введены!';
    
    }
	
	if ($data["newSotrud_dolzh"]) == "")
	{

	    $errors[] = 'Должность сотрудника не введена!';
    
    }
	
	if ($data["newSotrud_otdel"]) == "")
	{

	    $errors[] = 'Отдел сотрудника не введен!';
    
    }
	
	if ($data["newSotrud_birthdate"]) == null)
	{

	    $errors[] = 'Дата рождения сотрудника не введена!';
    
    }
	
	if ($data["newSotrud_rabdate"]) == null)
	{

	    $errors[] = 'Дата начала работы сотрудника не введена!';
    
    }


	if(empty($errors)) 
	{
        // добавляем в таблицу записи
		mysqli_query($link, "INSERT INTO `sotrudniki` (`name`, `birhDate`, `rabDate`, `dolzh`, `otdel`) VALUES ('{$data["newSotrud_name"]}', '{$data["newSotrud_birthdate"]}', '{$data["newSotrud_rabdate"]}', '{$data["newSotrud_dolzh"]}', '{$data["newSotrud_otdel"]}')");
        echo '<div style="color: green; ">Сотрудник успешно добавлен! Можно вернуться на <a href="../www/intro.php">главную</a>.</div><hr>';

	} else 
	{
                // array_shift() извлекает первое значение массива array и возвращает его, сокращая размер array на один элемент. 
		echo '<div style="color: red; ">' . array_shift($errors). '</div><hr>';
	}
}
}else{echo '<h1 style="color:red">Эта функция доступна только для зарегестрированных пользователей!</h1>';}
?>

<div class="container mt-5">
<h2>Форма внесения нового сотрудника</h2><br>
	<form id="newSotrudWithVal" method="post">
		<div class="form-list">
			<div>
				<input class="form-control" type="text" id="newSotrud_name" name="newSotrud_name" maxlength="50" value="" placeholder="Введите имя и фамилию сотрудника">
				<span class="error"></span>
			</div>
			<div class="mt-3">
				<input class="form-control" type="text" id="newSotrud_dolzh" name="newSotrud_dolzh" maxlength="50" value="" placeholder="Введите должность сотрудника">
				<span class="error"></span>
			</div>
			<div class="mt-3">
				<input class="form-control" type="text" id="newSotrud_otdel" name="newSotrud_otdel" maxlength="50" value="" placeholder="Введите отдел сотрудника">
				<span class="error"></span>
			</div>
			<div class="mt-3">
				<label>Дата начала работы сотрудника в компании:</label>
				<input class="form-control" type="date" id="newSotrud_birthdate" name="newSotrud_birthdate">
				<span class="error"></span>
			</div>
			<div class="mt-3">
				<label>Дата рождения сотрудника:</label>
				<input class="form-control" type="date" id="newSotrud_rabdate" name="newSotrud_rabdate">
				<span class="error"></span>
			</div>
			<div class="mt-3">
				<button id="do_incert" name="do_incert" class="btn btn-success" type="submit">Добавить сотрудника</button>
			</div>
		</div>
	</form>
	<br>
	<p>Вернуться в раздел <a href="../www/otdel.php">отделения</a>.</p>
</div>
<script src='../jsscripts/valid_newSotrud.js?".time()."'></script>
</body>
</html>