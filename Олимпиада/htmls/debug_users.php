<?php
include('db.php');

// 1. Логика за смяна на ролята
if (isset($_GET['set_role']) && isset($_GET['user_id'])) {
    $new_role = intval($_GET['set_role']);
    $u_id = intval($_GET['user_id']);
    
    $update_sql = "UPDATE users SET role_id = $new_role WHERE user_id = $u_id";
    $connection->query($update_sql);
    header("Location: debug_users.php");
    exit();
}

// 2. Взимаме всички потребители
$sql = "SELECT u.user_id, u.username, u.role_id, r.name as role_name 
        FROM users u 
        LEFT JOIN roles r ON u.role_id = r.role_id";
$result = $connection->query($sql);
?>

<!DOCTYPE html>
<html>
<head><title>User Role Debugger</title></head>
<body>
    <h1>Управление на потребителски роли</h1>
    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Потребител</th>
            <th>Текуща Роля</th>
            <th>Смени на:</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['user_id']; ?></td>
            <td><?php echo $row['username']; ?></td>
            <td><?php echo $row['role_name'] . " (ID: " . $row['role_id'] . ")"; ?></td>
            <td>
                <a href="debug_users.php?user_id=<?php echo $row['user_id']; ?>&set_role=1">Клиент (1)</a> | 
                <a href="debug_users.php?user_id=<?php echo $row['user_id']; ?>&set_role=2">Организатор (2)</a> | 
                <a href="debug_users.php?user_id=<?php echo $row['user_id']; ?>&set_role=3">Админ (3)</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
    <br>
    <a href="home.php">Към началната страница</a>
</body>
</html>