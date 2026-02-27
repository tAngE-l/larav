<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'test_auth');

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $result = $conn->query("SELECT * FROM users WHERE username='$username' AND password='$password'");
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['user'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        header('Location: index.php');
    } else {
        $error = "Неверный логин или пароль";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Вход на сайт</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Вход на сайт</h1>
            <div class="nav">
                <a href="index.php">Главная</a>
            </div>
        </div>
        
        <div class="content" style="max-width: 400px; margin: 0 auto;">
            <h2>Авторизация</h2>
            
            <?php if (isset($error)): ?>
                <div class="error"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <form method="POST">
                <div class="form-group">
                    <label>Имя пользователя:</label>
                    <input type="text" name="username" required>
                </div>
                
                <div class="form-group">
                    <label>Пароль:</label>
                    <input type="password" name="password" required>
                </div>
                
                <button type="submit" name="login" class="btn">Войти</button>
            </form>
            
            <div class="card" style="margin-top: 20px;">
                <h3>Тестовые данные:</h3>
                <p><strong>Администратор:</strong> admin / admin123</p>
                <p><strong>Пользователь:</strong> user / user123</p>
            </div>
        </div>
    </div>
</body>
</html>