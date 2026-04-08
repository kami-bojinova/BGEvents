<?php
include "db.php";
$category_id = "";
$label = "";
$errormessage = "";
$successmessage = "";

// Вземаме ID от URL
if (isset($_GET["category_id"])) {
    $category_id = $_GET["category_id"];

    // Зареждаме текущите данни на категорията
    $sql = "SELECT * FROM categories WHERE category_id='$category_id'";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $label = $row["label"];
    } else {
        $errormessage = "Категорията не е намерена.";
    }
}

// Ако формата е изпратена
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_label = trim($_POST["label"]);

    if (empty($new_label)) {
        $errormessage = "Моля, въведете име на категорията.";
    } else {
        // Ъпдейтваме записа
        $sql = "UPDATE categories SET label='$new_label' WHERE category_id='$category_id'";
        if ($connection->query($sql) === true) {
            header("location: /SPGI/BGEvents/Олимпиада/htmls/categories.php");
            exit();
        } else {
            $errormessage = "Грешка при обновяване: " . $connection->error;
        }
    }
}
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
            <h2>Добре дошъл, <span>Име</span>!</h2>
            <div class="dashboard-items">
                <ul>
                    <a href="/SPGI/BGEvents/Олимпиада/htmls/index.php"><li id="active"><i class="fa-solid fa-calendar-check"></i> Събития</li></a>
                    <a href="/SPGI/BGEvents/Олимпиада/htmls/categories.php"><li><i class="fa-solid fa-list"></i> Категории</li></a>
                    <a href="/SPGI/BGEvents/Олимпиада/htmls/gallery.php"><li><i class="fa-solid fa-image"></i> Галерия</li></a>
                    <a href="#"><li><i class="fa-solid fa-users"></i> Потребители</li></a>
                    <a href="/SPGI/BGEvents/Олимпиада/htmls/home.php"><li><i class="fa-solid fa-right-from-bracket"></i> Изход</li></a>
                </ul>
            </div>
        </div>

        <div class="dashboard-categories">
            <div class="create_category">
                <div class="create_category_header">
                    <h1>Редактирай категория</h1>
                    <!-- <a href="/SPGI/BGEvents/Олимпиада/htmls/categories.php"><button>Назад</button></a> -->
                </div>
                
                <form method="post">
                    <input type="text" name="label" value="<?php echo htmlspecialchars($label); ?>" placeholder="Име на категорията">
                    <div class="form-btns">
                        <a href="/SPGI/BGEvents/Олимпиада/htmls/categories.php" class="back-btn">Назад</a>
                        <button type="submit">Създай</button>
                    </div>
                </form>

                <?php if (!empty($errormessage)) {
                    echo "
                        <h4>$errormessage</h4>
                        ";
                } ?>
            </div>
        </div>
    </div>

    <!-- бутон за отиване най-горе -->
    <a href="#">
        <div class="go-up">
            <i class='fa-solid fa-arrow-up'></i>
        </div>
    </a>
</body>
</html>