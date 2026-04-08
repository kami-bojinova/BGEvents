<?php
session_start();
include "db.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$userId = (int)$_SESSION["user_id"];

if (isset($_POST["update_profile"])) {

    // 1) Обновяване на текстовите полета
    $first = trim($_POST["first_name"] ?? "");
    $last  = trim($_POST["last_name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $phone = trim($_POST["phone_number"] ?? "");

    $stmt = $connection->prepare("UPDATE users SET firstname=?, lastname=?, email=?, phone_number=? WHERE user_id=?");
    $stmt->bind_param("ssssi", $first, $last, $email, $phone, $userId);
    $stmt->execute();
    $stmt->close();

    // 2) Ако има качена снимка
    if (isset($_FILES["profile_image"]) && $_FILES["profile_image"]["error"] !== UPLOAD_ERR_NO_FILE) {

        if ($_FILES["profile_image"]["error"] !== UPLOAD_ERR_OK) {
            die("Грешка при качване на файла.");
        }

        // лимит 2MB
        if ($_FILES["profile_image"]["size"] > 2 * 1024 * 1024) {
            die("Файлът е твърде голям. Макс 2MB.");
        }

        $tmpPath = $_FILES["profile_image"]["tmp_name"];

        // позволени формати
        $allowed = ["jpg","jpeg","png","webp"];
        $ext = strtolower(pathinfo($_FILES["profile_image"]["name"], PATHINFO_EXTENSION));

        if (!in_array($ext, $allowed)) {
            die("Неподдържан формат. Позволени: jpg, jpeg, png, webp.");
        }

        // папка за запис (спрямо update_profile.php)
        $uploadDir = __DIR__ . "/uploads/avatars/";
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $fileName = "u{$userId}_" . time() . "." . $ext;
        $targetFs = $uploadDir . $fileName;

if (!is_writable($uploadDir)) {
    die("Нямам права за запис в: " . $uploadDir);
}
echo "<pre>";
var_dump([
  "tmp" => $_FILES["profile_image"]["tmp_name"],
  "exists_tmp" => file_exists($_FILES["profile_image"]["tmp_name"]),
  "uploadDir" => __DIR__ . "/uploads/avatars/",
  "is_dir" => is_dir(__DIR__ . "/uploads/avatars/"),
  "is_writable" => is_writable(__DIR__ . "/uploads/avatars/"),
]);
echo "</pre>";
        if (!move_uploaded_file($tmpPath, $targetFs)) {
            die("Неуспешно записване на файла.");
        }

        // път за базата (относителен)
        // $dbPath = "uploads/avatars/" . $fileName;
$dbPath = "/SPGI/BGEvents/Олимпиада/htmls/uploads/avatars/" . $fileName;
        // запис в DB
        $stmt = $connection->prepare("UPDATE users SET profile_image=? WHERE user_id=?");
        $stmt->bind_param("si", $dbPath, $userId);
        $stmt->execute();
        $stmt->close();
    }

    header("Location: profile.php?updated=1");
    exit;
}
?>