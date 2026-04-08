<?php
    include ('db.php');
    $label = "";
    $errormessage = "";
    $successmessage = "";

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $label = $_POST['label'];

        do {
            if (empty($label)) {
                $errormessage = "Попълни полето!";
                break;
            }
            $sql = "INSERT INTO categories (label)"."VALUES ('$label')";
            $result = $connection->query($sql);

            if (!$result) {
                $errormessage = "Invalid query: ".$connection->error;
                break;
            }

            $label = "";
            $successmessage = "Категорията е добавена!";
            header("Location: /SPGI/BGEvents/Олимпиада/htmls/categories.php");
            exit;
        } while(false);
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
                    <h1>Създай категория</h1>
                    <!-- <a href="/SPGI/BGEvents/Олимпиада/htmls/categories.php"><button>Назад</button></a> -->
                </div>
                
                
                <form method="post">
                    <input type="text" name="label" placeholder="Име на категорията">
                    <div class="form-btns">
                        <a href="/SPGI/BGEvents/Олимпиада/htmls/categories.php" class="back-btn">Назад</a>
                        <button type="submit">Създай</button>
                    </div>
                </form>

                <?php
                    if(!empty($errormessage)) {
                        echo "
                        <h4>$errormessage</h4>
                        ";
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
</body>
</html>