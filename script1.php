<?php
	session_start();
	header('Refresh: 5; index.php'); //redirect с задержкой 
	echo 'Вы будете перенаправлены на главную страницу через 5 секунд.'; //вывод сообщения

	if (isset($_POST['login'])) { $login = $_POST['login']; if ($login == '') { unset($login);} } //заносим введенный пользователем логин в переменную $login, если он пустой, то уничтожаем переменную

	if (isset($_POST['password'])) { $password=$_POST['password']; if ($password =='') { unset($password);} }//заносим введенный пользователем пароль в переменную $password, если он пустой, то уничтожаем переменную

	if (empty($login) or empty($password)) //если пользователь не ввел логин или пароль, то выдаём ошибку и останавливаем выполнение скрипта
	{
		exit ("Вы ввели не всю информацию, вернитесь назад и заполните все поля!");
	}

// $login = stripslashes($login);//удаляет экранирование символов, произведенное функцией addslashes()

// $login = htmlspecialchars($login);//преобразует специальные символы в HTML-сущности (обрабатываем их, чтобы теги и скрипты не работали на случай от действий умников-спамеров)

// $password = stripslashes($password); //удаляет экранирование символов, произведенное функцией addslashes()

// $password = htmlspecialchars($password);
	
	$patternlog = '/^[a-z][-a-z_]*$/i';
	$patternpass = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]$/';

	if (!preg_match($patternlog, $login)/* || !preg_match($patternpass, $password)*/) {
		exit ("<br>Вы ввели некорректный логин или пароль");
	}

	$login = trim($login);//удаляет пробелы (или другие символы) из начала и конца строки
	$password = trim($password);
// Задаём переменные для подключения к БД
	$db_host = 'localhost';
	$db_user = 'root';
	$db_password = '';
	$database = 'local_test_sql';
// Подключаемся к БД 
	$link = mysqli_connect($db_host, $db_user, $db_password, $database);
//извлекаем из базы из таблицы зарегистрированных пользователей все данные о пользователе с введенным логином
	$result = mysqli_query($link, "SELECT * FROM users WHERE login ='$login'");
	$myrow = mysqli_fetch_array($result);

//если пользователя с введенным логином не существует
	if (empty($myrow['login']))
	{
		exit ("<br /><br />Извините, введённый вами логин или пароль неверный!");
	}

	else {
	//если существует, то сверяем пароли
		if (md5($myrow['password']) == md5($password)){
    //если пароли совпадают, то запускаем данному пользователю сессию
			$_SESSION['login']=$myrow['login']; 
    //Выводим информацию, что пользователь авторизован и снизу ссылку для перехода на главную страницу (можно на любую поставить ссылку)
			echo "<br /><br />Поздравляем! Вы успешно вошли на сайт! <br /><a href='index.php'>Главная страница</a><br /><a href='reg.php'>Регистрация</a>";
		}

		else {
    	//если пароли не совпали, выводим на экран информацию об этом и пользователя не авторизовываем
			exit ("<br /><br />Извините, введённый вами login или пароль неверный!");
	}
}
?>