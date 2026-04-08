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
        <img src="user_img.png" alt="User">
      </div>

      <h2>Добре дошъл, <br>
        <span><?php echo htmlspecialchars($firstname . " " . $lastname); ?></span>!
      </h2>

      <button class="dash-toggle" aria-controls="dashMenu" aria-expanded="false">
        ☰ Меню
      </button>

      <div class="dashboard-items" id="dashMenu">
        <ul>
          <li id="active">
            <a href="/SPGI/BGEvents/Олимпиада/htmls/index.php">
              <i class="fa-solid fa-calendar-check"></i> Събития
            </a>
          </li>

          <li>
            <a href="/SPGI/BGEvents/Олимпиада/htmls/categories.php">
              <i class="fa-solid fa-list"></i> Категории
            </a>
          </li>

          <li>
            <a href="/SPGI/BGEvents/Олимпиада/htmls/gallery.php">
              <i class="fa-solid fa-image"></i> Галерия
            </a>
          </li>

          <?php if ($current_role == 3): ?>
            <li>
              <a href="dash_users.php">
                <i class="fa-solid fa-users"></i> Потребители
              </a>
            </li>
          <?php endif; ?>

          <li>
            <a href="/SPGI/BGEvents/Олимпиада/htmls/home.php">
              <i class="fa-solid fa-right-from-bracket"></i> Изход
            </a>
          </li>
        </ul>
      </div>
    </div>

    <div class="dashboard-events">
      <h1>Списък със събития</h1>
      <a href="/SPGI/BGEvents/Олимпиада/htmls/create_event.php"><button>Създай ново събитие</button></a>

      <br><br>

      <!-- ✅ WRAPPER ЗА СКРОЛ -->
      <div class="table-wrap">
        <table>
          <tr>
            <th>ID на събитие</th>
            <th>ID на създател</th>
            <th>Заглавие</th>
            <th>Описание</th>
            <th>Категория</th>
            <th>Адрес</th>
            <th>Град</th>
            <th>Дата</th>
            <th>Начален час</th>
            <th>Краен час</th>
            <th>Цена на билет (Ако има)</th>
            <th>Действия</th>
          </tr>

          <?php
          if ($current_role == 3) {
              $sql = "SELECT e.*, c.label AS category_name FROM events e LEFT JOIN categories c ON e.category_id = c.category_id";
          } else {
              $user_id = $_SESSION['user_id'];
              $sql = "SELECT e.*, c.label AS category_name FROM events e LEFT JOIN categories c ON e.category_id = c.category_id WHERE e.user_id = '$user_id'";
          }
          $result = $connection->query($sql);

          while ($row = $result->fetch_assoc()) {
              if (!empty($row["end_date"]) && $row["end_date"] != $row["start_date"]) {
                  $date_display = date("d.m.Y", strtotime($row["start_date"])) . " - " . date("d.m.Y", strtotime($row["end_date"]));
              } else {
                  $date_display = date("d.m.Y", strtotime($row["start_date"]));
              }

              echo "
                <tr class='event-row' data-event-id='{$row['event_id']}'>
  <td class='event-id'>{$row['event_id']}</td>
  <td>{$row['user_id']}</td>
  <td>{$row['title']}</td>
  <td>{$row['description']}</td>
  <td>{$row['category_name']}</td>
  <td>{$row['location']}</td>
  <td>{$row['city']}</td>
  <td>{$date_display}</td>
  <td>{$row['start_time']}</td>
  <td>{$row['end_time']}</td>
  <td>{$row['price']}</td>
  <td>
    <div class='buttons'>
      <a href='/SPGI/BGEvents/Олимпиада/htmls/create_gallery.php?event_id={$row['event_id']}'><button class='btn-green'>Снимки</button></a>
      <a href='/SPGI/BGEvents/Олимпиада/htmls/edit_event.php?event_id={$row['event_id']}'><button>Редактирай</button></a>
";

if ($current_role == 3) {
  echo "
      <a href='delete_event.php?event_id={$row['event_id']}' onclick=\"return confirm('Сигурни ли сте?');\">
        <button class='btn-red'>Изтрий</button>
      </a>
  ";
}

echo "
    </div>
  </td>
</tr>

<!-- ✅ Детайлен ред (за телефон) -->
<tr class='event-details'>
  <td colspan='12'>
    <div class='details-box'>
      <div class='details-line'><span>ID на създател:</span> {$row['user_id']}</div>
      <div class='details-line'><span>Заглавие:</span> {$row['title']}</div>
      <div class='details-line'><span>Описание:</span> {$row['description']}</div>
      <div class='details-line'><span>Категория:</span> {$row['category_name']}</div>
      <div class='details-line'><span>Адрес:</span> {$row['location']}</div>
      <div class='details-line'><span>Град:</span> {$row['city']}</div>
      <div class='details-line'><span>Дата:</span> {$date_display}</div>
      <div class='details-line'><span>Начален час:</span> {$row['start_time']}</div>
      <div class='details-line'><span>Краен час:</span> {$row['end_time']}</div>
      <div class='details-line'><span>Цена:</span> {$row['price']}</div>

      <div class='details-actions'>
        <a href='/SPGI/BGEvents/Олимпиада/htmls/create_gallery.php?event_id={$row['event_id']}'><button class='btn-green'>Снимки</button></a>
        <a href='/SPGI/BGEvents/Олимпиада/htmls/edit_event.php?event_id={$row['event_id']}'><button>Редактирай</button></a>
";

if ($current_role == 3) {
  echo "
        <a href='delete_event.php?event_id={$row['event_id']}' onclick=\"return confirm('Сигурни ли сте?');\">
          <button class='btn-red'>Изтрий</button>
        </a>
  ";
}

echo "
                    </div>
                  </td>
                </tr>
              ";
          }
          ?>
        </table>
      </div>
    </div>

    <!-- go-up -->
    <a href="#">
      <div class="go-up">
        <i class="fa-solid fa-arrow-up"></i>
      </div>
    </a>

  </div>

  <script src="../script/script.js"></script>



</body>
