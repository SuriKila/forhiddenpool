<?php 
$title="Форма регистрации"; 
require __DIR__ . '/header.php'; 
require "db.php"; 
?>
<?php

$data = $_POST;

if(isset($data['do_signup'])) {

	$errors = array();

	if(trim($data['login']) == '') {

		$errors[] = "Введите логин!";
	}

	if($data['password'] == '') {

		$errors[] = "Введите пароль";
	}

	if($data['password_2'] != $data['password']) {

		$errors[] = "Повторный пароль введен не верно!";
	}
       
	if(mb_strlen($data['login']) < 3 || mb_strlen($data['login']) > 90) {

	    $errors[] = "Недопустимая длина логина";

    }

    if (mb_strlen($data['password']) < 2 || mb_strlen($data['password']) > 8){
	
	    $errors[] = "Недопустимая длина пароля (от 2 до 8 символов)";

    }

	if(R::count('users', "login = ?", array($data['login'])) > 0) {

		$errors[] = "Пользователь с таким логином существует!";
	}

	if(empty($errors)) {


		$user = R::dispense('users');


		$user->login = $data['login'];

		
		$user->password = password_hash($data['password'], PASSWORD_DEFAULT);


		R::store($user);
        echo '<div style="color: green; ">Вы успешно зарегистрированы! Можно <a href="login.php">авторизоваться</a>.</div><hr>';

	} else {
 
		echo '<div style="color: red; ">' . array_shift($errors). '</div><hr>';
	}
}
?>
<div class="container mt-4">
		<div class="row">
			<div class="col">
		<h2>Форма регистрации</h2>
		<form action="signup.php" method="post">
			<input type="text" class="form-control" name="login" id="login" placeholder="Введите логин"><br>
			<input type="password" class="form-control" name="password" id="password" placeholder="Введите пароль"><br>
			<input type="password" class="form-control" name="password_2" id="password_2" placeholder="Повторите пароль"><br>
			<button class="btn btn-success" name="do_signup" type="submit">Зарегистрировать</button>
		</form>
		<br>
		<p>Если вы зарегистрированы, тогда нажмите <a href="login.php">здесь</a>.</p>
		<p>Вернуться на <a href="index.php">главную</a>.</p>
			</div>
		</div>
	</div>
<?php require __DIR__ . '/footer.php'; ?>