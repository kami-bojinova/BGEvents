<?php
session_start(); // Задължително стартираме сесията
include "db.php"; 

// Проверка за сигурност: Ако не е логнат или не е поне организатор/админ, връщаме към началото
if (!isset($_SESSION['role_id']) || ($_SESSION['role_id'] != 2 && $_SESSION['role_id'] != 3)) {
    header("Location: home.php");
    exit();
}

// Извличаме пълните данни за потребителя от сесията или базата
$firstname = isset($_SESSION['firstname']) ? $_SESSION['firstname'] : "Потребител";
$lastname = isset($_SESSION['lastname']) ? $_SESSION['lastname'] : "";
$current_role = $_SESSION['role_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style_dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Bulgaria Events Dashboard</title>
</head>
<body>
    <div class="dashboard">
        <div class="dashboard-left">
            <div class="user-img">
                <img src="user_img.png">
            </div>
            <h2>Добре дошъл, <br><span><?php echo htmlspecialchars($firstname . " " . $lastname); ?></span>!</h2>
           <button class="dash-toggle" aria-controls="dashMenu" aria-expanded="false">
            ☰ Меню
            </button>
            <div class="dashboard-items" id="dashMenu">
                <ul>
                    <a href="/SPGI/BGEvents/Олимпиада/htmls/index.php"><li><i class="fa-solid fa-calendar-check"></i> Събития</li></a>
                    <a href="/SPGI/BGEvents/Олимпиада/htmls/categories.php"><li><i class="fa-solid fa-list"></i> Категории</li></a>
                    <a href="/SPGI/BGEvents/Олимпиада/htmls/gallery.php"><li><i class="fa-solid fa-image"></i> Галерия</li></a>
                    <?php if ($current_role == 3): ?>
                        <a href="dash_users.php"><li id="active"><i class="fa-solid fa-users"></i> Потребители</li></a>
                    <?php endif; ?>
                    <a href="/SPGI/BGEvents/Олимпиада/htmls/home.php"><li><i class="fa-solid fa-right-from-bracket"></i> Изход</li></a>
                </ul>
            </div>
        </div>

        <div class="dashboard-users">
            <h1>Потребители</h1>
            <br>
          <table class="users-table">
                <tr>
                  <th>User ID</th>
                  <th>Име</th>
                  <th>Фамилия</th>
                  <th>Username</th>
                  <th>Email</th>
                  <th>Password</th>
                  <th>Тел. номер</th>
                  <th>Role ID</th>
                  <th>Действия</th>
                </tr>
                
   <?php
    include('db.php');
    
    // Заявка за извличане на всички потребители
    $sql = "SELECT * FROM users"; 

    $result = $connection->query($sql);

    if (!$result) {
        echo 'Грешка при извличане на потребители: ' . $connection->error;
        return; 
    }
    
    // Начало на цикъла за извеждане на данните
    while ($row = $result->fetch_assoc()) { 
     
        
        echo "
            <tr>
                <td>{$row['user_id']}</td>
                <td>{$row['firstname']}</td>
                <td>{$row['lastname']}</td>
                <td>{$row['username']}</td>
                <td>{$row['email']}</td>
                <td>{$row['password']}</td>
                <td>{$row['phone_number']}</td>
                <td>{$row['role_id']}</td>
                <td class='action'>
                    <a href='change_role.php?user_id={$row['user_id']}'
                        \">
                        <button class='btn-green'>Смени роля</button>
                    </a>
                    <a href='delete_user.php?user_id={$row['user_id']}'
                        onclick=\"return confirm('Сигурни ли сте, че искате да изтриете този потребител?');\">
                        <button class='btn-red'>Изтрий</button>
                    </a>
                </td>
            </tr>
        ";
    }
?>
            </table>
        </div>
    </div>

    <!-- бутон за отиване най-горе -->
    <a href="#">
        <div class="go-up">
            <i class='fa-solid fa-arrow-up'></i>
        </div>
    </a>
    <script src="../script/script.js"></script>
</body>
</html>