<?php
$mysql = new mysqli("MySQL-8.0", "root", "", "dbkin");
$mysql->query("SET NAMES 'utf8'");

session_start();
if(isset($_SESSION["email"])) {
    $email = $_SESSION["email"];
}
$isLoggedIn = isset($_SESSION['email']) && !empty($_SESSION['email']);
$i = 0;
$places = [];
$cinema = $mysql->query("SELECT * from film");
while ($row = mysqli_fetch_assoc($cinema)){
    $places[] = array(
        'id'=> $row['id'],
        'email'=> $row['email'],
    );
}
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
    <title>Зал</title>
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
        <div class="screen">
            <div class="screen-line"></div>
            <div class="screen-glow"></div>
        </div>
        <div class="cinema">
            
            <?php foreach($places as $key): ?>
                    <?php
                    if (!empty($key['email'])) {
                        if ($i == 0) {
                            $i += 1;
                            echo '<div class="six"><div class="busy-place cinema-item"></div>';
                        } elseif ($i != 5) {
                            $i += 1;
                            echo '<div class="busy-place cinema-item"></div>';
                        } else {
                            $i = 0;
                            echo '<div class="busy-place cinema-item"></div></div>';
                        }

                    } else {
                        if ($i == 0) {
                            $i += 1;
                            echo '<div class="six"><div class="free-place cinema-item" data-id="'. $key['id'].'"></div>';
                        } elseif ($i != 5) {
                            $i += 1;
                            echo '<div class="free-place cinema-item" data-id="'. $key['id'].'"></div>';
                        } else {
                            $i = 0;
                            echo '<div class="free-place cinema-item" data-id="'. $key['id'].'"></div></div>';
                        }
                    }
                    ?>
            <?php endforeach; ?>
        </div>
        <?php if (isset($_SESSION['email'])): ?>
            <div class="btn-send-id"><button class="send-id">Забронировать</button></div>
        <?php else: ?>
            <div class="btn-send-id">
                <button class="send-id">Забронировать</button>
                <p class='please-log'>Для бронирования, пожалуйста, войдите</a>.</p>
            </div>
        <?php endif; ?>
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
</body>
</html>
<script src="script.js"></script>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>