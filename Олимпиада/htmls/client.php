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
    <title>Профил</title>
</head>

<body>
    <!-- nav start -->

    <nav>
        <div class="header">
            <div class="right">
                <div class="logo">
                    <!--<img src="../Imiges/logo.png">-->
                </div>
                <h4>Bul<span class="logo-span-1">gar</span><span class="logo-span-3">ia</span> <span class="logo-span-2">Events</span></h4>
            </div>

            <div class="center">
                <ul class="links">
                    <li><a href="../htmls/home.php">Начало</a></li>
                    <!-- <li><a href="for_us.php">За нас</a></li> -->
                    <li><a href="../htmls/subitiq.php">Събития</a></li>
                    <li><a href="../htmls/Contacts.php">Контакти</a></li>
                    <li><a href="../htmls/comunitie.php">Общност</a></li>
                    <!-- <li><a href="../htmls/client.php" id="active">Профил</a></li> -->
                    <li><a href="create_event.php">Създай събитие</a></li>
                </ul>
            </div>

            <div class="left">
                <div id="log-in-btn" class="fas fa-user"></div>

                <div id="user-info-btn">
                    <img src="../Imiges/user-1.png" alt="User Avatar" class="user-avatar-menu">
                    <span>Име на потребителя</span>
                </div>
            </div>
        </div>
    </nav>
    <!-- nav end -->

    <!-- main start-->


    <!-- log in старт -->

    <div class="container-log-in">
        <div class="close-btn fa-solid fa-xmark"></div>
        <h1>Влезте в акунта си</h1>
        <form>
            <input type="text" placeholder="Потребителско име" required name="username" pattern="[a-zA-Zа-яА-Я] {5-30}">
            <input type="password" placeholder="Парола" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,12}">
            <input type="submit" value="Вход">
        </form>
        <span id="register-btn">Нямам акаунт</span>
        <!-- <a href="../htmls/home.php" class="log-in"><i class="fa-solid fa-arrow-left"></i>Обратно към начало</a> -->
    </div>

    <!-- log in край -->

    <!-- sing in старт -->

    <div class="container-sign-in">
        <div class="close-btn fa-solid fa-xmark"></div>
        <h2>Направете си акаунт</h2>
        <form action="create_user.php" method="post">
            <input type="text" placeholder="Име" name="firstname" required title="Въведете име" pattern="[a-zA-Zа-яА-Я]{2,15}">
            <input type="text" placeholder="Фамилия" name="lastname" required title="Въведете име" pattern="[a-zA-Zа-яА-Я]{2,15}">
            <input type="text" placeholder="Потребителско име" name="username" required title="Въведете потребителско име" pattern="[a-zA-Zа-яА-Я] {5-30}">
            <input type="email" placeholder="Имейл" name="email" required title="Въведете валиден имейл с валиден домейн" pattern="[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,5}$">
            <input type="text" placeholder="Телефонен номер" name="phone_number" required title="Въведете валиден телефонен номер" pattern=".{10-13}">
            <input type="password" placeholder="Парола" name="password" required title="Въведете парола от 8-12 символа">
            <input type="password" placeholder="Потвърди паролата" required name="password-confirm" title="Въведете парола от 8-12 символа">
            <input type="submit" value="изпрати">
        </form>
    </div>

    <!-- sign in край -->

    <!-- user info start -->

    <div class="container-user-info">
        <div class="close-btn fa-solid fa-xmark"></div>
        <h2>Профил на потребителя</h2>
        <div class="profile-details">
            <img src="../Imiges/user-1.png">
            <form>
                <label for="name">Име</label>
                <input type="text" name="first_name">
                <label for="email">Имейл</label>
                <input type="email" name="email">
                <label for="phone">Телефонен номер</label>
                <input type="text" name="tel">
                <label for="old_password">Стара Парола</label>
                <input type="password" name="old_password">
                <label for="new_password">Нова парола</label>
                <input type="password" name="new_password">
                <input type="submit" value="Изход">
            </form>
        </div>
    </div>

    <!-- user info end -->
     
    <!-- main end -->


    <!-- footer strat -->

    <footer>
        <div class="footer-hero">
            <div class="footer-card">
                <h2>Топ градове</h2>
                <ul class="list-footer">
                    <li><a href="/">София</a></li>
                    <li><a href="/">Варна</a></li>
                    <li><a href="/">Пловдив</a></li>
                    <li><a href="/">Шумен</a></li>
                    <li><a href="/">Стара Загора</a></li>
                </ul>
            </div>

            <div class="footer-card">
                <h2>Топ категории</h2>
                <ul class="list-footer">
                    <li><a href="/">Култура</a></li>
                    <li><a href="/">Фестивали</a></li>
                    <li><a href="/">Музикални</a></li>
                    <li><a href="/">Шоу и комедия</a></li>
                    <li><a href="/">За деца</a></li>
                </ul>
            </div>

            <div class="footer-card">
                <h2>Социални мрежи</h2>
                <ul class="list-footer links">
                    <li><a href="https://www.facebook.com/?locale=bg_BG" class="Face-footer"><i class="fa-brands fa-facebook"></i>Facebook</a></li>
                    <li><a href="https://www.youtube.com" class="tube-footer"><i class="fa-brands fa-youtube"></i>YouTube</a></li>
                    <li><a href="http://localhost/олимпиада/htmls/home.php" class="Google-footer"><i class="fa-brands fa-google"></i>Google</a></li>
                </ul>
            </div>

            <div class="footer-card">
                <h1>Седмичен бюлетин</h1>

                <div class="mail-footer">

                    <input type="email" placeholder="Въведете вашият имейл..." require pattern="[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,5}$">
                    <input type="submit" value="Запиши">

                </div>

                <div class="check-footer">

                    <div class="box">
                        <input type="checkbox">
                        <label for="checkbox">Last minute оферти</label>
                    </div>

                    <div class="box">
                        <input type="checkbox">
                        <label for="checkbox">Промо оферти</label>
                    </div>

                </div>

            </div>
        </div>

        <div class="footer-mid">

            <div class="banner-footer">

                <div class="box-footer">

                    <div class="image-footer"><img src="../Imiges/logo_1.png"></div>
                    <div class="image-footer"><img src="../Imiges/logo_2.png"></div>
                    <div class="image-footer"><img src="../Imiges/logo_3.png"></div>
                    <div class="image-footer"><img src="../Imiges/logo_4.png"></div>
                    <div class="image-footer"><img src="../Imiges/logo_5.png"></div>
                    <div class="image-footer"><img src="../Imiges/logo_6.png"></div>
                    <div class="image-footer"><img src="../Imiges/logo_7.png"></div>
                    <div class="image-footer"><img src="../Imiges/logo_8.png"></div>
                    <div class="image-footer"><img src="../Imiges/logo_9.png"></div>
                    <div class="image-footer"><img src="../Imiges/logo_1.png"></div>
                    <div class="image-footer"><img src="../Imiges/logo_2.png"></div>
                    <div class="image-footer"><img src="../Imiges/logo_3.png"></div>
                    <div class="image-footer"><img src="../Imiges/logo_4.png"></div>
                    <div class="image-footer"><img src="../Imiges/logo_5.png"></div>
                    <div class="image-footer"><img src="../Imiges/logo_6.png"></div>
                    <div class="image-footer"><img src="../Imiges/logo_7.png"></div>
                    <div class="image-footer"><img src="../Imiges/logo_8.png"></div>
                    <div class="image-footer"><img src="../Imiges/logo_9.png"></div>

                </div>

            </div>

        </div>

    </footer>
    <a href="#" class="up-arrow"><img src="../Imiges/up-arrow.png" width="45px"></a>

    <!-- footer end -->
    <script src="../script/script.js"></script>
</body>

</html>