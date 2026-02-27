<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['role'] != 'admin') {
    header('Location: index.php');
    exit;
}

$conn = new mysqli('localhost', 'root', '', 'test_auth');
$users = $conn->query("SELECT * FROM users");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Админ панель</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Админ панель</h1>
            <div class="nav">
                <a href="index.php">Главная</a>
                <a href="profile.php">Профиль</a>
                <a href="logout.php">Выйти</a>
            </div>
        </div>
        
        <div class="content">
            <h2>Управление пользователями</h2>
            
            <div class="admin-badge" style="display: inline-block; margin-bottom: 20px;">
                Доступ только для администраторов
            </div>
            
            <div class="card">
                <h3>Список пользователей</h3>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Имя пользователя</th>
                        <th>Роль</th>
                    </tr>
                    <?php while ($row = $users->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['username']; ?></td>
                        <td>
                            <span class="<?php echo $row['role'] == 'admin' ? 'admin-badge' : 'user-badge'; ?>">
                                <?php echo $row['role']; ?>
                            </span>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </table>
            </div>
            
            <div class="card">
                <h3>Статистика</h3>
                <p>Всего пользователей: <?php echo $users->num_rows; ?></p>
                <p>Администраторов: <?php 
                    $admins = $conn->query("SELECT COUNT(*) as all FROM users WHERE role='admin'")->fetch_assoc();
                    echo $admins['all'];
                ?></p>
                <p>Обычных пользователей: <?php 
                    $users_count = $conn->query("SELECT COUNT(*) as all FROM users WHERE role='user'")->fetch_assoc();
                    echo $users_count['all'];
                ?></p>
            </div>
        </div>
    </div>
</body>
</html>