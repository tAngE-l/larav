<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Профиль пользователя</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Профиль пользователя</h1>
            <div class="nav">
                <a href="index.php">Главная</a>
                <?php if ($_SESSION['role'] == 'admin'): ?>
                    <a href="admin.php">Админ панель</a>
                <?php endif; ?>
                <a href="logout.php">Выйти</a>
            </div>
        </div>
        
        <div class="content">
            <h2>Личный кабинет</h2>
            
            <div class="success">
                <p><strong>Имя пользователя:</strong> <?php echo $_SESSION['user']; ?></p>
                <p><strong>Роль:</strong> <span class="<?php echo $_SESSION['role'] == 'admin' ? 'admin-badge' : 'user-badge'; ?>">
                    <?php echo $_SESSION['role']; ?>
                </span></p>
            </div>
            
            <div class="card">
                <h3>Доступ к страницам</h3>
                <?php if ($_SESSION['role'] == 'admin'): ?>
                    <p>✓ У вас есть доступ к <a href="admin.php">админ панели</a></p>
                <?php else: ?>
                    <p>✓ У вас есть доступ только к общей странице и профилю</p>
                    <p>✗ Доступ к админ панели закрыт</p>
                <?php endif; ?>
            </div>
            
            <div class="card">
                <h3>Информация о профиле</h3>
                <p>Это страница профиля, доступная всем авторизованным пользователям.</p>
                <p>Здесь может находиться личная информация пользователя.</p>
            </div>
        </div>
    </div>
</body>
</html>