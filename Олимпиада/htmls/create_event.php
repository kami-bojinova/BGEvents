<?php
session_start(); 
include ('db.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Ако не е логнат, го пращаме към вход
    exit();
}

$errormessage = "";
$successmessage = "";

$event_title = "";
$event_description = "";
$event_category = "";
$event_location = "";
$event_city = "";
$event_start_date = "";
$event_end_date = "";
$event_start_time = "";
$event_end_time = "";
$event_price = "";
$event_ticket_quantity = "";
$status = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $event_title = $_POST["event_title"];
    $event_description = $_POST["event_description"];
    $event_category = $_POST["event_category"];
    $event_location = $_POST["event_location"];
    $event_city = $_POST["event_city"];
    $event_start_date = $_POST["event_start_date"];
    $event_end_date = $_POST["event_end_date"];
    $event_start_time = $_POST["event_start_time"];
    $event_end_time = $_POST["event_end_time"];
    $event_price = $_POST["event_price"];
    $event_ticket_quantity = $_POST['event_ticket_quantity'];
    
    $status = isset($_POST['status']) ? $_POST['status'] : "";

    if (empty($event_end_date)) {
        $event_end_date = $event_start_date;
    }

    do {
        if (empty($event_title) || empty($event_category) || empty($event_city) || empty($status)) {
            $errormessage = "Моля, попълнете всички задължителни полета и изберете вход (платен/безплатен)!";
            break;
        }

        $sql_event = "INSERT INTO events (title, description, category_id, location, city, start_date, end_date, start_time, end_time, price, user_id) 
              VALUES ('$event_title', '$event_description', '$event_category', '$event_location', '$event_city', '$event_start_date', '$event_end_date', '$event_start_time', '$event_end_time', '$event_price', '$user_id')";
        
        $result_event = $connection->query($sql_event);

        if (!$result_event) {
            $errormessage = "Грешка при запис на събитието: " . $connection->error;
            break;
        }

        $event_id = $connection->insert_id;

        $sql_ticket = "INSERT INTO tickets (event_id, quantity, status) VALUES ('$event_id', '$event_ticket_quantity', '$status')";
        $result_ticket = $connection->query($sql_ticket);

        if (!$result_ticket) {
            $errormessage = "Грешка при запис на билетите: " . $connection->error;
            break;
        }

        $successmessage = "Събитието е добавено успешно!";
        header("location: /SPGI/BGEvents/Олимпиада/htmls/home.php");
        exit();

    } while (false);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style_dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="shortcut icon" href="../Imiges/logo.png" type="image/x-icon">
    <title>Bulgaria Events Dashboard</title>
</head>
<body>
    <div class="dashboard">
        <div class="dashboard-left">
            <div class="user-img">
                <img src="../Imiges/user_img.png">
            </div>
            <h2>Добре дошъл, <span><?php echo htmlspecialchars($_SESSION['firstname'] . " " . $_SESSION['lastname']); ?></span>!</h2>
            <div class="dashboard-items">
                <ul>
                    <a href="/SPGI/BGEvents/Олимпиада/htmls/index.php"><li id="active"><i class="fa-solid fa-calendar-check"></i> Събития</li></a>
                    <a href="/SPGI/BGEvents/Олимпиада/htmls/categories.php"><li><i class="fa-solid fa-list"></i> Категории</li></a>
                    <a href="/SPGI/BGEvents/Олимпиада/htmls/gallery.php"><li><i class="fa-solid fa-image"></i> Галерия</li></a>
                    <?php if (isset($_SESSION['role_id']) && $_SESSION['role_id'] == 3): ?>
                         <a href="/SPGI/BGEvents/Олимпиада/htmls/dash_users.php"><li><i class="fa-solid fa-users"></i> Потребители</li></a>
                    <?php endif; ?>
                    <a href="/SPGI/BGEvents/Олимпиада/htmls/home.php"><li><i class="fa-solid fa-right-from-bracket"></i> Изход</li></a>
                </ul>
            </div>
        </div>

        <div class="dashboard-events">
            <div class="create_event">
                <div class="create_event_header">
                    <h1>Създай ново събитие</h1>
                    <!-- <a href="/SPGI/BGEvents/Олимпиада/htmls/index.php"><button>Назад</button></a> -->
                </div>
                <form method="post">

                    <input type="text" name="event_title" placeholder="Заглавие">
                    <textarea name="event_description" id="event_description" placeholder="Описание на събитието"></textarea>
                    
                    <label for="event_categories"><h4>Категория:</h4></label>
                    <select name="event_category" id="event_category">
                        <?php
                        $sql =
                            "SELECT category_id, label FROM categories ORDER BY category_id ASC";
                        $result = $connection->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<option value="' .
                                    $row["category_id"] .
                                    '">' .
                                    $row["label"] .
                                    "</option>";
                            }
                        } else {
                            echo '<option value="">Няма налични категории</option>';
                        }
                        ?>
                    </select>

                    <input type="text" name="event_location" placeholder="Адрес">
                    <input type="text" name="event_city" placeholder="Град">
                    <label for="event_start_date"><h4>Начална дата:</h4></label>
                    <input type="date" name="event_start_date" onclick="this.showPicker()">
                    <label for="event_end_date"><h4>Крайна дата:</h4></label>
                    <input type="date" name="event_end_date" onclick="this.showPicker()">
                    <label for="event_start_time"><h4>Начален час:</h4></label>
                    <input type="time" name="event_start_time" onclick="this.showPicker()">          
                    <label for="event_end_time"><h4>Краен час:</h4></label>
                    <input type="time" name="event_end_time" onclick="this.showPicker()">
                    <label for="status"><h4>Вход</h4></label>
                    <div class="checkbox">
                        <input type="radio" name="status" id="paid" value="paid">
                        <label for="paid">Платен</label>
                        <input type="radio" name="status" id="free" value="free">
                        <label for="free">Безплатно</label>
                    </div>
                    <input type="text" name="event_ticket_quantity" placeholder="Количество билети">
                    <input type="text" name="event_price" placeholder="Цена на билет">
                    <div class="form-btns">
                        <a href="/SPGI/BGEvents/Олимпиада/htmls/index.php" class="back-btn">Назад</a>
                        <button type="submit">Създай събитие</button>
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