<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Главная страница</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Мой сайт</h1>
            <div class="nav">
                <a href="index.php">Главная</a>
                <?php if (isset($_SESSION['user'])): ?>
                    <a href="profile.php">Профиль</a>
                    <?php if ($_SESSION['role'] == 'admin'): ?>
                        <a href="admin.php">Админ панель</a>
                    <?php endif; ?>
                    <a href="logout.php">Выйти</a>
                <?php else: ?>
                    <a href="login.php">Войти</a>
                <?php endif; ?>
            </div>
        </div>
        
        <div class="content">
            <h2>Добро пожаловать на сайт!</h2>
            
            <?php if (isset($_SESSION['user'])): ?>
                <div class="success">
                    <p>Вы авторизованы как: <strong><?php echo $_SESSION['user']; ?></strong></p>
                    <p>Ваша роль: <span class="<?php echo $_SESSION['role'] == 'admin' ? 'admin-badge' : 'user-badge'; ?>">
                        <?php echo $_SESSION['role']; ?>
                    </span></p>
                </div>
                
                <div class="card">
                    <h3>Общая страница</h3>
                    <p>Эта страница доступна всем авторизованным пользователям.</p>
                    <p>Вы можете перейти в свой профиль или на другие доступные страницы.</p>
                </div>
            <?php else: ?>
                <div class="info">
                    <p>Вы не авторизованы на сайте.</p>
                    <p>Пожалуйста, <a href="login.php">войдите</a> чтобы получить доступ к контенту.</p>
                </div>
            <?php endif; ?>
            
            <div class="card">
                <h3>Информация о сайте</h3>
                <p>Это тестовый сайт для демонстрации авторизации и аутентификации.</p>
                <p>Доступны следующие роли:</p>
                <ul>
                    <li><span class="admin-badge">admin</span> - полный доступ ко всем страницам</li>
                    <li><span class="user-badge">user</span> - доступ к общей странице и профилю</li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>