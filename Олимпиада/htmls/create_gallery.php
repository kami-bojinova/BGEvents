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
$event_id = $_GET['event_id'] ?? 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style_dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <title>Bulgaria Events Dashboard</title>
</head>
<body>



    <div class="dashboard">
        <div class="dashboard-left">
            <div class="user-img">
                <img src="../Imiges/user_img.png">
            </div>
            <!--<h2>Добре дошъл, <span>Име</span>!</h2>-->
            
            <h2>Добре дошъл, <span><?php echo htmlspecialchars($_SESSION['firstname'] . " " . $_SESSION['lastname']); ?></span>!</h2>
            <button class="dash-toggle" aria-controls="dashMenu" aria-expanded="false">
            ☰ Меню
            </button>
            <div class="dashboard-items" id="dashMenu">
                <ul>
                    <a href="/SPGI/BGEvents/Олимпиада/htmls/index.php"><li id="active"><i class="fa-solid fa-calendar-check"></i> Събития</li></a>
                    <a href="/SPGI/BGEvents/Олимпиада/htmls/categories.php"><li><i class="fa-solid fa-list"></i> Категории</li></a>
                    <a href="/SPGI/BGEvents/Олимпиада/htmls/gallery.php"><li ><i class="fa-solid fa-image"></i> Галерия</li></a>
                    <?php if ($current_role == 3): ?>
                        <a href="dash_users.php"><li><i class="fa-solid fa-users"></i> Потребители</li></a>
                    <?php endif; ?>
                    <a href="/SPGI/BGEvents/Олимпиада/htmls/home.php"><li><i class="fa-solid fa-right-from-bracket"></i> Изход</li></a>
                </ul>
            </div>
        </div>
        
            <!--<div class="dashboard-items">-->
            <!--    <ul>-->
            <!--        <a href="/SPGI/BGEvents/Олимпиада/htmls/index.php"><li id="active"><i class="fa-solid fa-calendar-check"></i> Събития</li></a>-->
            <!--        <a href="/SPGI/BGEvents/Олимпиада/htmls/categories.php"><li><i class="fa-solid fa-list"></i> Категории</li></a>-->
            <!--        <a href="/SPGI/BGEvents/Олимпиада/htmls/gallery.php"><li><i class="fa-solid fa-image"></i> Галерия</li></a>-->
            <!--        <a href="#"><li><i class="fa-solid fa-users"></i> Потребители</li></a>-->
            <!--        <a href="/SPGI/BGEvents/Олимпиада/htmls/home.php"><li><i class="fa-solid fa-right-from-bracket"></i> Изход</li></a>-->
            <!--    </ul>-->
            <!--</div>-->
       

        <div class="dashboard-events">
            <div class="upload_image">
                
                <h1>Качи снимка</h1>

                <!-- !!! важно !!! enctype за upload -->
                <form action="create_gallery.php?event_id=<?php echo $event_id; ?>" 
                      method="post" enctype="multipart/form-data">

                    <label for="image"><h4>Изберете снимка:</h4></label> 
                    <input type="file" id="image" name="image" required>

                    <label for="description"><h4>Описание на снимката</h4></label>
                    <textarea id="description" name="description" rows="3" required></textarea>

                    <div class="form-btns">
                        <a href="/SPGI/BGEvents/Олимпиада/htmls/index.php" class="back-btn">Назад</a>
                        <button type="submit">Качване</button>
                    </div>
                </form>

<?php
// Логика за качване на изображението
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image'])) {

    $image = $_FILES['image'];
    $description = $connection->real_escape_string($_POST['description']);

    $upload_dir = 'img/';
    $image_name = basename($image['name']);
    $upload_file = $upload_dir . $image_name;

    // Проверка дали папката съществува
    if (!is_dir($upload_dir)) {
        echo "<div class='alert alert-danger'>Папката img/ не съществува!</div>";
        exit;
    }

    // Проверка за грешки при качване
    if ($image['error'] !== UPLOAD_ERR_OK) {
        echo "<div class='alert alert-danger'>Грешка при качване: " . $image['error'] . "</div>";
        exit;
    }

    // Преместване на файла
    if (move_uploaded_file($image['tmp_name'], $upload_file)) {

        $sql = "INSERT INTO images (image, description, event_id)
                VALUES ('$image_name', '$description', $event_id)";

        if ($connection->query($sql) === TRUE) {
            echo "<div class='alert alert-success'>Снимката е успешно качена!</div>";

            // Пренасочване
            echo '<script>setTimeout(() => { window.location.href="/SPGI/BGEvents/Олимпиада/htmls/index.php"; }, 1500);</script>';

        } else {
            echo "<div class='alert alert-danger'>Грешка при записване: " . $connection->error . "</div>";
        }

    } else {
        echo "<div class='alert alert-danger'>Грешка при преместване на файла!</div>";
    }
}
?>

            </div>
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
