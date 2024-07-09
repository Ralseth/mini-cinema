<?php
$mysql = new mysqli("MySQL-8.0", "root", "", "dbkin");
$mysql->query("SET NAMES 'utf8'");

session_start();
if(isset($_SESSION["email"])) {
    $email = $_SESSION["email"];
}
$isLoggedIn = isset($_SESSION['email']) && !empty($_SESSION['email']);
?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const isLoggedIn = <?php echo isset($_SESSION['email'])? 'true' : 'false';?>;
    
    const loginButton = document.querySelector('.btnLogin-popup');
    loginButton.textContent = isLoggedIn? 'Выйти' : 'Войти';

    loginButton.addEventListener('click', function() {
        if (!isLoggedIn) {
            authForm.classList.add('active-popup');
        } else {
            fetch('auth.php?action=logout')
               .then(response => response.text())
               .then(data => {
                    if (data === 'success') {
                        location.reload();
                    }
                });
        }
    });
});
</script>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/icon.png">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/login.css">
    <title>Главная</title>
</head>
<body>
<div class="wrapper">
    <header class="header">
        <h1 class="logo">World of Lonely Elves</h1>
        <nav class="navigation">
            <a href="index.php">Расписание сеансов</a>
            <a href="movies.php">Кинотеатр онлайн</a>
            <button class="btnLogin-popup"></button>
        </nav>
    </header>
    <main class="main">
        <div class="cinema">
            <table>
                <tr>
                    <th>Сегодня</th>
                    <th>Название</th>
                    <th>Время и цена</th>
                </tr>
                <tr>
                    <td class="image-cinema" style='background-image: url(&quot;https://s1ru1.kinoplan24.ru/1164/040606050649306fc05c24c6/21388.jpg?mode=fit&width=512&height=512&quot;);'></td>
                    <td><a href="cinema-hall.php">Фильм 1</a></td>
                    <td class="buy-ticket"><a href="cinema-hall.php">10:00 2D 200₽</a></td>
                </tr>
                <tr>
                    <td class="image-cinema" style='background-image: url(&quot;https://s2ru1.kinoplan24.ru/789/04060605065b4ef657519378/10042588.jpg?mode=fit&width=512&height=512&quot;);'></td>
                    <td><a href="cinema-hall.php">Фильм 2</a></td>
                    <td class="buy-ticket"><a href="cinema-hall.php">10:00 2D 200₽</a></td>
                </tr>
                <tr>
                    <td class="image-cinema" style='background-image: url(&quot;https://s2ru1.kinoplan24.ru/1159/0406060506481787c6f19b8c/20923.jpg?mode=fit&width=512&height=512&quot;);'></td>
                    <td><a href="cinema-hall.php">Фильм 3</a></td>
                    <td class="buy-ticket"><a href="cinema-hall.php">10:00 2D 200₽</a></td>
                </tr>
                <tr>
                    <td class="image-cinema" style='background-image: url(&quot;https://s2ru1.kinoplan24.ru/1179/04060605065c11badefaed12/21542.jpg?mode=fit&width=512&height=512&quot;);'></td>
                    <td><a href="cinema-hall.php">Фильм 4</a></td>
                    <td class="buy-ticket"><a href="cinema-hall.php">10:00 2D 200₽</a></td>
                </tr>
            </table>

            <table>
                <tr>
                    <th>Завтра</th>
                    <th>Название</th>
                    <th>Время и цена</th>
                </tr>
                <tr>
                    <td class="image-cinema" style='background-image: url(&quot;https://s2ru1.kinoplan24.ru/177/040606050658e419c130717d/10042194.jpg?mode=fit&width=512&height=512&quot;);'></td>
                    <td><a href="cinema-hall.php">Фильм 5</a></td>
                    <td class="buy-ticket"><a href="cinema-hall.php">10:00 2D 200₽</a></td>
                </tr>
                <tr>
                    <td class="image-cinema" style='background-image: url(&quot;https://s2ru1.kinoplan24.ru/1115/04060605065751be827c0a16/10042008.jpg?mode=fit&width=512&height=512&quot;);'></td>
                    <td><a href="cinema-hall.php">Фильм 6</a></td>
                    <td class="buy-ticket"><a href="cinema-hall.php">10:00 2D 200₽</a></td>
                </tr>
                <tr>
                    <td class="image-cinema" style='background-image: url(&quot;https://s1ru1.kinoplan24.ru/1164/040606050649306fc05c24c6/21388.jpg?mode=fit&width=512&height=512&quot;);'></td>
                    <td><a href="cinema-hall.php">Фильм 7</a></td>
                    <td class="buy-ticket"><a href="cinema-hall.php">10:00 2D 200₽</a></td>
                </tr>
                <tr>
                    <td class="image-cinema" style='background-image: url(&quot;https://s2ru1.kinoplan24.ru/789/04060605065b4ef657519378/10042588.jpg?mode=fit&width=512&height=512&quot;);'></td>
                    <td><a href="cinema-hall.php">Фильм 8</a></td>
                    <td class="buy-ticket"><a href="cinema-hall.php">10:00 2D 200₽</a></td>
                </tr>
            </table>
        </div>
        <div class="auth-form">
            <span class="icon-close">
                <ion-icon name="close"></ion-icon>
            </span>
            <div class="form-box login">
                <h2>Вход</h2>
                <form method="post" action="auth.php">
                    <div class="input-box">
                        <span class="icon"><ion-icon name="mail"></ion-icon></span>
                        <input type="email" name="email" required>
                        <label>Email</label>
                    </div>
                    <div class="input-box">
                        <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                        <input type="password" name="pass" required>
                        <label>Пароль</label>
                    </div>
                    <input type="submit" name="login" class="btn-log" value="Войти">
                    <div class="login-register">
                        <p>Нет аккаунта? <a href="#" class="register-link">Зарегистрироваться</a></p>
                    </div>
                </form>
            </div>
            
            <div class="form-box register">
                <h2>Регистрация</h2>
                <form method="post" action="auth.php">
                    <div class="input-box">
                        <span class="icon"><ion-icon name="person"></ion-icon></span>
                        <input type="text" name="name" required>
                        <label>Имя</label>
                    </div>
                    <div class="input-box">
                        <span class="icon"><ion-icon name="mail"></ion-icon></span>
                        <input type="text" name="email" required>
                        <label>Email</label>
                    </div>
                    <div class="input-box">
                        <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                        <input type="password" name="pass" required>
                        <label>Пароль</label>
                    </div>
                    <input type="submit" name="register" class="btn-log" value="Зарегистрироваться">
                    <div class="login-register">
                        <p>Уже есть аккаунт? <a href="#" class="login-link">Войдите</a></p>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <footer class="footer">
        <div class="support-tel">Служба тех поддержки: 8 888 888-88-88</div>
        <div class="rights">© World of Lonely Elves</div>
        <div class="socials">
            <ion-icon name="logo-instagram"></ion-icon>
            <ion-icon name="logo-twitter"></ion-icon>
            <ion-icon name="logo-facebook"></ion-icon>
            <ion-icon name="logo-vk"></ion-icon>
        </div>
    </footer>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php if (isset($_SESSION["AUTH_ERR"])): ?>
<script>
Swal.fire({
    icon: 'error',
    title: 'Ошибка',
    text: '<?php
    switch($_SESSION["AUTH_ERR"]) {
    case 1:
        echo "Такой пользователь уже есть";
        unset($_SESSION["AUTH_ERR"]);
        break;
    case 2:
        echo "Такого пользователя не существует"; 
        unset($_SESSION["AUTH_ERR"]);
        break;
    case 3:
        echo "Пароль введен неправильно"; 
        unset($_SESSION["AUTH_ERR"]);
        break;
    }
    ?>',
    confirmButtonText: 'OK'
})
</script>
<?php endif; ?>
</body>
</html>
<script src="script.js"></script>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>