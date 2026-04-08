<?php
include('db.php');

// 1. Обработка на ДОБАВЯНЕ на роля
if (isset($_POST['add_role'])) {
    $role_name = $connection->real_escape_string($_POST['role_name']);
    $role_label = $connection->real_escape_string($_POST['role_label']);
    
    if (!empty($role_name)) {
        $sql = "INSERT INTO roles (name, label) VALUES ('$role_name', '$role_label')";
        $connection->query($sql);
        header("Location: debug_roles.php"); // Презареждаме, за да изчистим POST
        exit();
    }
}

// 2. Обработка на ИЗТРИВАНЕ на роля
if (isset($_GET['delete_id'])) {
    $id = intval($_GET['delete_id']);
    $sql = "DELETE FROM roles WHERE role_id = $id";
    $connection->query($sql);
    header("Location: debug_roles.php");
    exit();
}

// 3. Извличане на всички роли
$result = $connection->query("SELECT * FROM roles");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Debug Roles</title>
</head>
<body>

    <h2>Добавяне на нова роля</h2>
    <form method="POST" action="debug_roles.php">
        <input type="text" name="role_name" placeholder="Име (напр. admin)" required>
        <input type="text" name="role_label" placeholder="Етикет (напр. Администратор)">
        <button type="submit" name="add_role">Добави</button>
    </form>

    <hr>

    <h2>Списък с роли в базата</h2>
    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name (System)</th>
                <th>Label (Display)</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['role_id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['label']; ?></td>
                        <td>
                            <a href="debug_roles.php?delete_id=<?php echo $row['role_id']; ?>" 
                               onclick="return confirm('Сигурни ли сте?')">Изтрий</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="4">Няма намерени роли.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

    <p><a href="home.php">Назад към Начало</a></p>

</body>
</html>