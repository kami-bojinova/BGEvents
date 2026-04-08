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
                    <a href="/SPGI/BGEvents/Олимпиада/htmls/categories.php"><li id="active"><i class="fa-solid fa-list"></i> Категории</li></a>
                    <a href="/SPGI/BGEvents/Олимпиада/htmls/gallery.php"><li><i class="fa-solid fa-image"></i> Галерия</li></a>
                    <?php if ($current_role == 3): ?>
                        <a href="dash_users.php"><li><i class="fa-solid fa-users"></i> Потребители</li></a>
                    <?php endif; ?>
                    <a href="/SPGI/BGEvents/Олимпиада/htmls/home.php"><li><i class="fa-solid fa-right-from-bracket"></i> Изход</li></a>
                </ul>
            </div>
        </div>

        <div class="dashboard-categories">
            <h1>Списък с категории</h1>
            <?php if ($current_role == 3): ?>
                <a href="/SPGI/BGEvents/Олимпиада/htmls/create_category.php"><button>Създай категория</button></a>
            <?php endif; ?>
            <br>
            <br>
            <table>
                <tr>
                  <th>ID на категория</th>
                  <th>Име на категория</th>
                  <?php if ($current_role == 3): ?>
                    <th>Действия</th>
                <?php endif; ?>
                </tr>
                
                <?php
                $sql = "SELECT * FROM categories";
                $result = $connection->query($sql);

                while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['category_id'] . "</td>";
                        echo "<td>" . $row['label'] . "</td>";
                        if ($current_role == 3) {
                            echo "<td>
                                    <div class='buttons'>
                                        <a href='/SPGI/BGEvents/Олимпиада/htmls/edit_category.php?category_id=$row[category_id]'><button>Редактирай</button></a>
                                        <a href='/SPGI/BGEvents/Олимпиада/htmls/delete_category.php?category_id=$row[category_id]'
                                           onclick=\"return confirm('Сигурни ли сте че искате да изтриете тази категория?');\">
                                            <button class='btn-red'>Изтрий</button>
                                        </a>
                                    </div>
                                </td>";
                        }
                        echo "</tr>";
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