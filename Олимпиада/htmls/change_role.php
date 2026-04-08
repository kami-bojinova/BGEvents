<?php
    session_start();
    include ('db.php');

    // Проверка за админ достъп
    if (!isset($_SESSION['role_id']) || $_SESSION['role_id'] != 3) {
        header("Location: home.php");
        exit;
    }

    $user_id = "";
    $new_role_id = "";
    $errormessage = "";
    $successmessage = "";

    // 1. Вземаме ID на потребителя от ГЕТ заявката
    if (isset($_GET['user_id'])) {
        $user_id = $_GET['user_id'];
        
        // Вземаме текущите данни за потребителя, за да знаем кого редактираме
        $sql = "SELECT username, role_id FROM users WHERE user_id = $user_id";
        $result = $connection->query($sql);
        $user_to_edit = $result->fetch_assoc();
        
        if (!$user_to_edit) {
            header("Location: dash_users.php");
            exit;
        }
    }

    // 2. Обработка на формата при POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $user_id = $_POST['user_id'];
        $new_role_id = $_POST['role_id'];

        do {
            if (empty($new_role_id)) {
                $errormessage = "Моля, изберете роля!";
                break;
            }

            $sql = "UPDATE users SET role_id = '$new_role_id' WHERE user_id = $user_id";
            $result = $connection->query($sql);

            if (!$result) {
                $errormessage = "Грешка в заявката: " . $connection->error;
                break;
            }

            $successmessage = "Ролята е обновена успешно!";
            header("Location: dash_users.php"); // Върни се към списъка с потребители
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" />
    <title>Промяна на роля - Dashboard</title>
</head>
<body>
    <div class="dashboard">
        <div class="dashboard-left">
            <div class="user-img">
                <img src="../Imiges/<?php echo $_SESSION['img_user'] ?? 'user_img.png'; ?>">
            </div>
            <h2>Добре дошъл, <span><?php echo $_SESSION['firstname']; ?></span>!</h2>
            <div class="dashboard-items">
                <ul>
                    <a href="index.php"><li><i class="fa-solid fa-calendar-check"></i> Събития</li></a>
                    <a href="categories.php"><li><i class="fa-solid fa-list"></i> Категории</li></a>
                    <a href="gallery.php"><li><i class="fa-solid fa-image"></i> Галерия</li></a>
                    <a href="dash_users.php"><li id="active"><i class="fa-solid fa-users"></i> Потребители</li></a>
                    <a href="home.php"><li><i class="fa-solid fa-right-from-bracket"></i> Изход</li></a>
                </ul>
            </div>
        </div>

        <div class="dashboard-categories">
            <div class="create_category">
                <div class="create_category_header">
                    <h1>Промяна роля на: <?php echo htmlspecialchars($user_to_edit['username']); ?></h1>
                </div>
                
                <form method="post">
                    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">

                    <label for="role_id"><h4>Избери нова роля:</h4></label>
                    <select name="role_id" style="width: 70%; padding: 10px; margin: 20px auto; border-radius: 5px; border: 1px solid #ccc;">
                        <?php
                        // Вземаме всички роли от базата
                        $roles_sql = "SELECT * FROM roles";
                        $roles_result = $connection->query($roles_sql);
                        
                        while($role = $roles_result->fetch_assoc()) {
                            // Проверяваме коя е текущата роля, за да я маркираме като избрана (selected)
                            $selected = ($role['role_id'] == $user_to_edit['role_id']) ? "selected" : "";
                            echo "<option value='{$role['role_id']}' $selected>{$role['label']} (ID: {$role['role_id']})</option>";
                        }
                        ?>
                    </select>

                    <div class="form-btns">
                        <a href="dash_users.php" class="back-btn">Назад</a>
                        <button type="submit">Обнови ролята</button>
                    </div>
                </form>

                <?php
                    if(!empty($errormessage)) {
                        echo "<h4 style='color: red; margin-top: 10px;'>$errormessage</h4>";
                    }
                ?>
            </div>
        </div>
    </div>

    <a href="#">
        <div class="go-up">
            <i class='fa-solid fa-arrow-up'></i>
        </div>
    </a>
</body>
</html>