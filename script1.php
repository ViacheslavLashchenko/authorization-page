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
    
$login = stripslashes($login);//удаляет экранирование символов, произведенное функцией addslashes()
    
$login = htmlspecialchars($login);//преобразует специальные символы в HTML-сущности (обрабатываем их, чтобы теги и скрипты не работали на случай от действий умников-спамеров)

$password = stripslashes($password); //удаляет экранирование символов, произведенное функцией addslashes()
    
$password = htmlspecialchars($password);

$login = trim($login);//удаляет пробелы (или другие символы) из начала и конца строки
$password = trim($password);