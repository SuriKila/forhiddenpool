<?php 
$title="Форма авторизации"; 
require __DIR__ . '/header.php'; 
require "db.php"; 
?>
<?php

$link = array_key_exists("url", $_GET) ? $_GET['url'] : "https://control.platform500.com/backend/customer/api/v1/auth/login";
$data = $_POST;


if(isset($data['do_login'])) { 


 $errors = array();

 
 $user = R::findOne('users', 'login = ?', array($data['login']));

 if($user) {

 	
 	if(password_verify($data['password'], $user->password)) {

 		
 		$_SESSION['logged_user'] = $user;
 		
 		
                header('Location: index.php');

 	}

 } else {
 	
	header("Location: {$link}");
 }

if(!empty($errors)) {

		echo '<div style="color: red; ">' . array_shift($errors). '</div><hr>';

	}
}
?>

<div class="container mt-4">
		<div class="row">
			<div class="col">
		
		<h2>Форма авторизации</h2>
		<form action="login.php" method="post">
			<input type="text" class="form-control" name="login" id="login" placeholder="Введите логин" required><br>
			<input type="password" class="form-control" name="password" id="pass" placeholder="Введите пароль" required><br>
			<button class="btn btn-success" name="do_login" type="submit">Авторизоваться</button>
		</form>
		<br>
		<p>Если вы еще не зарегистрированы, тогда нажмите <a href="signup.php">здесь</a>.</p>
		<p>Вернуться на <a href="index.php">главную</a>.</p>
			</div>
		</div>
	</div>

<?php require __DIR__ . '/footer.php'; ?>