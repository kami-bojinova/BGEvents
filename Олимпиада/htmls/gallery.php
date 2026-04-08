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
                    <a href="/SPGI/BGEvents/Олимпиада/htmls/gallery.php"><li id="active"><i class="fa-solid fa-image"></i> Галерия</li></a>
                    <?php if ($current_role == 3): ?>
                        <a href="dash_users.php"><li><i class="fa-solid fa-users"></i> Потребители</li></a>
                    <?php endif; ?>
                    <a href="/SPGI/BGEvents/Олимпиада/htmls/home.php"><li><i class="fa-solid fa-right-from-bracket"></i> Изход</li></a>
                </ul>
            </div>
        </div>

        <div class="dashboard-gallery">
            <h1>Галерия</h1>
            <br>
         <table class="gallery-table">
                <tr>
                  <th>Име на събитие</th>
                  <th>Снимка</th>
                  <th>Описание на снимката</th>
                  <th>Действия</th>
                </tr>
                
   <?php
    include('db.php');
    
    $user_id = $_SESSION['user_id'];
    $current_role = $_SESSION['role_id'];

   
    if ($current_role == 3) {
       $sql = "
            SELECT i.images_id, i.image, i.description, e.title  
            FROM images i
            LEFT JOIN events e ON e.event_id = i.event_id
        ";
        
    } else {
        $sql = "SELECT i.images_id, i.image, i.description, e.title  
            FROM images i
            LEFT JOIN events e ON e.event_id = i.event_id
            WHERE e.user_id = '$user_id'";
            
    }

    $result = $connection->query($sql);

    if (!$result) {
        echo 'Грешка: ' . $connection->error;
        return; 
    }
    
    // if ($result->num_rows > 0) {
    //     while ($row = $result->fetch_assoc()) { 
    //         // $img_path = !empty($row['image']) ? "img/" . $row['image'] : "img/default.jpg"; 
    //         $img_path = !empty($row['image'])
    // ? "/SPGI/BGEvents/Олимпиада/img/" . rawurlencode($row['image'])
    // : "/SPGI/BGEvents/Олимпиада/img/default.jpg";
    //         echo "
    //             <tr>
    //                 <td>" . htmlspecialchars($row['title'] ?? 'Няма заглавие') . "</td>
    //                 <td><img src='" . htmlspecialchars($img_path) . "' alt='снимка' style='max-width: 200px; height: auto;'></td>
    //                 <td>" . htmlspecialchars($row['description'] ?? '') . "</td>
    //                 <td>
    //                     <a href='/SPGI/BGEvents/Олимпиада/htmls/delete_gallery.php?image_id={$row['images_id']}'
    //                         onclick=\"return confirm('Сигурни ли сте, че искате да изтриете тази снимка?');\">
    //                         <button class='btn-red'>Изтрий</button>
    //                     </a>
    //                 </td>
    //             </tr>
    //         ";
    //     }
    if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

        $img_path = !empty($row['image'])
            ? "/SPGI/BGEvents/Олимпиада/htmls/img/" . rawurlencode($row['image'])
            : "/SPGI/BGEvents/Олимпиада/htmls/img/default.jpg";
//echo $img_path;
        echo "
            <tr>
                <td>" . htmlspecialchars($row['title'] ?? 'Няма заглавие') . "</td>
                <td><img src='" . htmlspecialchars($img_path) . "' alt='снимка' style='max-width:200px;height:auto;'></td>
                <td>" . htmlspecialchars($row['description'] ?? '') . "</td>
                <td>
                    <a href='/SPGI/BGEvents/Олимпиада/htmls/delete_gallery.php?images_id=" . (int)$row['images_id'] . "'
                       onclick=\"return confirm('Сигурни ли сте, че искате да изтриете тази снимка?');\">
                        <button class='btn-red'>Изтрий</button>
                    </a>
                </td>
            </tr>
        ";
    }

    
    } else {
        echo "<tr><td colspan='4' style='text-align:center;'>Все още нямате качени снимки към вашите събития.</td></tr>";
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