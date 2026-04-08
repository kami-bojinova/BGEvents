<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <title>Sign-In-Начало</title>
</head>

<body>
    <div class="hero-sign-in">
        <div class="container-sign-in">
            <h2>Направете си акаунт</h2>
            <form action="create_user.php" method="post">
                <input type="text" placeholder="Име" name="firstname" required title="Въведете име" pattern="[a-zA-Zа-яА-Я]{2,15}">
                <input type="text" placeholder="Фамилия" name="lastname" required title="Въведете име" pattern="[a-zA-Zа-яА-Я]{2,15}">
                <input type="text" placeholder="Потребителско име" name="username" required title="Въведете потребителско име" pattern="[a-zA-Zа-яА-Я] {5-30}">
                <input type="email" placeholder="Имейл" name="email" required title="Въведете валиден имейл с валиден домейн" pattern="[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,5}$">
                <input type="text" placeholder="Телефонен номер" name="phone_number" required title="Въведете валиден телефонен номер" pattern=".{10-13}">
                <input type="password" placeholder="Парола" name="password" required title="Въведете парола от 8-12 символа">
                <input type="password" placeholder="Потвърди паролата" required name="password-confirm" title="Въведете парола от 8-12 символа">
                <input type="submit" value="Направи акаунт">
            </form>
            <div class="links-sign-in">
                <a href="../htmls/home.php">Обратно към начало</a>
                <a href="../htmls/log in.php">Влез в акаунта си</a>
            </div>
        </div>
    </div>
    
</body>
</html>