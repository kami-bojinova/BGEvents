<?php
include "db.php";

$errormessage = "";
$successmessage = "";

$event_id = "";
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

// Ако идва с GET – зареждаме данните на събитието
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (!isset($_GET["event_id"]) || empty($_GET["event_id"])) {
        // Няма подадено ID – връщаме към списъка
        header("location: /SPGI/BGEvents/Олимпиада/htmls/index.php");
        exit();
    }

    $event_id = (int) $_GET["event_id"];

    $sql = "SELECT * FROM events WHERE event_id = $event_id";
    $result = $connection->query($sql);

    if (!$result || $result->num_rows == 0) {
        $errormessage = "Събитието не е намерено.";
    } else {
        $row = $result->fetch_assoc();

        $event_title = $row["title"];
        $event_description = $row["description"];
        $event_category = $row["category_id"];
        $event_location = $row["location"];
        $event_city = $row["city"];
        $event_start_date = $row["start_date"];
        $event_end_date = $row["end_date"];
        $event_start_time = $row["start_time"];
        $event_end_time = $row["end_time"];
        $event_price = $row["price"];
    }

    // Ако идва с POST – записваме промените (UPDATE)
} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    $event_id = (int) $_POST["event_id"];
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

    do {
        if (
            empty($event_title) ||
            empty($event_category) ||
            empty($event_city)
        ) {
            $errormessage = "Попълни задължителните полета!";
            break;
        }

        $sql = "UPDATE events SET 
                                        title = '$event_title',
                                        description = '$event_description',
                                        category_id = '$event_category',
                                        location = '$event_location',
                                        city = '$event_city',
                                        start_date = '$event_start_date',
                                        end_date = '$event_end_date',
                                        start_time = '$event_start_time',
                                        end_time = '$event_end_time',
                                        price = '$event_price'
                                    WHERE event_id = $event_id";

        $result = $connection->query($sql);

        if (!$result) {
            $errormessage = "Грешка при редакция: " . $connection->error;
            break;
        }

        $successmessage = "Събитието е обновено успешно!";
        header("location: /SPGI/BGEvents/Олимпиада/htmls/index.php");
        exit();
    } while (false);
}
?>

<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style_dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Bulgaria Events Dashboard - Редакция на събитие</title>
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

        <div class="dashboard-events">
            <div class="create_event">
                <div class="create_event_header">
                    <h1>Редактиране на събитие</h1>
                    <!-- <a href="/SPGI/BGEvents/Олимпиада/htmls/index.php"><button>Назад</button></a> -->
                </div>

                <form method="post">
                    <!-- Скрито поле за ID на събитието -->
                    <input type="hidden" name="event_id" value="<?php echo htmlspecialchars(
                        $event_id
                    ); ?>">

                    <input 
                        type="text" 
                        name="event_title" 
                        placeholder="Заглавие"
                        value="<?php echo htmlspecialchars($event_title); ?>"
                    >

                    <textarea 
                        name="event_description" 
                        id="event_description" 
                        placeholder="Описание на събитието"
                    ><?php echo htmlspecialchars(
                        $event_description
                    ); ?></textarea>
                    
                    <label for="event_category"><h4>Категория</h4></label>
                    <select name="event_category" id="event_category">
                        <?php
                        $sql_cat =
                            "SELECT category_id, label FROM categories ORDER BY category_id ASC";
                        $result_cat = $connection->query($sql_cat);

                        if ($result_cat->num_rows > 0) {
                            while ($row_cat = $result_cat->fetch_assoc()) {
                                $selected =
                                    $row_cat["category_id"] == $event_category
                                        ? "selected"
                                        : "";
                                echo '<option value="' .
                                    $row_cat["category_id"] .
                                    '" ' .
                                    $selected .
                                    ">" .
                                    $row_cat["label"] .
                                    "</option>";
                            }
                        } else {
                            echo '<option value="">Няма налични категории</option>';
                        }
                        ?>
                    </select>

                    <input 
                        type="text" 
                        name="event_location" 
                        placeholder="Адрес"
                        value="<?php echo htmlspecialchars($event_location); ?>"
                    >

                    <input 
                        type="text" 
                        name="event_city" 
                        placeholder="Град"
                        value="<?php echo htmlspecialchars($event_city); ?>"
                    >
                    <label for="event_start_date"><h4>Начална дата:</h4></label>
                    <input 
                        type="date" 
                        name="event_start_date" 
                        placeholder="Начална дата"
                        onclick="this.showPicker()"
                        value="<?php echo htmlspecialchars(
                            $event_start_date
                        ); ?>"
                    >
                    <label for="event_end_date"><h4>Крайна дата:</h4></label>
                    <input 
                        type="date" 
                        name="event_end_date" 
                        placeholder="Крайна дата"
                        onclick="this.showPicker()"
                        value="<?php echo htmlspecialchars($event_end_date); ?>"
                    >
                    <label for="event_start_time"><h4>Начален час:</h4></label>
                    <input 
                        type="time" 
                        name="event_start_time" 
                        placeholder="Начален час"
                        onclick="this.showPicker()"
                        value="<?php echo htmlspecialchars(
                            $event_start_time
                        ); ?>"
                    >
                    <label for="event_end_time"><h4>Краен час:</h4></label>
                    <input 
                        type="time" 
                        name="event_end_time" 
                        placeholder="Краен час"
                        onclick="this.showPicker()"
                        value="<?php echo htmlspecialchars($event_end_time); ?>"
                    >
                    <label for="status"><h4>Вход</h4></label>
                    <div class="checkbox">
                        <input type="radio" name="status" id="paid" value="paid">
                        <label for="paid">Платен</label>
                        <input type="radio" name="status" id="free" value="free">
                        <label for="free">Безплатно</label>
                    </div>
                    <input type="text" name="event_ticket_quantity" placeholder="Количество билети">
                    <input 
                        type="text" 
                        name="event_price" 
                        placeholder="Цена на билет"
                        value="<?php echo htmlspecialchars($event_price); ?>"
                    >
                    <div class="form-btns">
                        <a href="/SPGI/BGEvents/Олимпиада/htmls/index.php" class="back-btn">Назад</a>
                        <button type="submit">Запази промените</button>
                    </div>
                </form>

                <?php
                if (!empty($errormessage)) {
                    echo "<h4 style='color:red;'>$errormessage</h4>";
                }

                if (!empty($successmessage)) {
                    echo "<h4 style='color:green;'>$successmessage</h4>";
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
