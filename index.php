							<!-- Форма авторизации -->

<?php
	session_start();
	echo "
		<!DOCTYPE html>
			<html lang='en'>
				<head>
					<meta charset='UTF-8'>
					<meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
					<title>Форма входа на PHP</title>
					<link rel='stylesheet' href='https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css'>
					<link rel='stylesheet' href='css/bootstrap.min.css'>
					<link rel='stylesheet' href='css/styles.css'>
				</head>
				<body>"?>
<?php
	if(isset($_SESSION['login'])){
		$login='Здравствуйте, '.$_SESSION['login'].'!';
	}
// Проверяем, пусты ли переменные логина и id пользователя
	if (empty($_SESSION['login']) or empty($_SESSION['id'])){
 // Если пусты, то
		echo "<div class='alert alert-primary center' role='alert'>Вы вошли на сайт, как гость</div><br>
			<div class='container'>
				<div class='row'>
					<div class='col-lg'></div>
					<div class='col-lg'>
						<form action='script1.php' method='post'>
							<div class='form-group'>
								<label for='exampleInputEmail1'>Логин</label>
								<input type='text' name='login' class='form-control' id='exampleInputLogin1' aria-describedby='loginHelp' placeholder='Введите логин'>
								<small id='loginHelp' class='form-text text-muted'>Мы никогда не передадим вашу электронную почту кому-либо еще.</small>
							</div>
							<div class='form-group'>
								<label for='exampleInputPassword1'>Пароль</label>
								<input type='password' name='password' class='form-control' id='exampleInputPassword1' placeholder='Введите пароль'>
							</div>
							<div class='form-check'>
								<input type='checkbox' class='form-check-input' id='exampleCheck1'>
								<label class='form-check-label' for='exampleCheck1'>Запомнить выбор</label>
							</div>
							<button type='submit' class='btn btn-primary'>Отправить</button>
						</form>
					</div>
					<div class='col-lg'></div>
				</div>
				<div class='row'>
					<div class='col-lg'></div>
					<div class='col-lg'><a href='#'>Регистрация</a></div>
					<div class='col-lg'></div>
				</div>
			</div>";
	}
	else {
 // Если не пусты, то 
		echo "<br /><br />Вы вошли на сайт, как ".$_SESSION['login']."<br /><br />";
		echo "<form action='close.php' method='POST'>
					<button type='submit' class='btn btn-primary'>Отправить</button>
				</form>";
	}
	echo'
				<script src="https://unpkg.com/popper.js/dist/umd/popper.min.js"></script>
				<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
				<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
				<script src="js/bootstrap.min.js"></script>
				<script src="js/main.js"></script>
			</body>
		</html>'; 
?>
