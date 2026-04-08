<?php
session_start(); // Това трябва да е на първия ред, преди всякакъв HTML
include 'db.php';
$userData = [
    'first_name' => '',
    'email' => '',
    'phone_number' => ''
];

if (isset($_SESSION['user_id'])) {
    $u_id = $_SESSION['user_id'];
    $fetchSql = "SELECT firstname, lastname, email, phone_number FROM users WHERE user_id = '$u_id'";
    $fetchResult = $connection->query($fetchSql);
    if ($fetchResult && $fetchResult->num_rows > 0) {
        $userData = $fetchResult->fetch_assoc();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
        <link rel="shortcut icon" href="../Imiges/logo.png" type="image/x-icon">
    <title>Контакти</title>
</head>

<body>
    <!-- nav start -->

    <nav>
        <div class="header">
            <span class="fa-solid fa-bars" id="menu-btn"></span>
            <div class="right">
                <div class="logo">
                    <img src="img/logo.png">
                </div>
                <!--<h4>Bul<span class="logo-span-1">gar</span><span class="logo-span-3">ia</span> <span class="logo-span-2">Events</span></h4>-->
                <h4>Всички събития на едно място</h4>

            </div>

            <div class="center">
                <ul class="links">
                    <li><a href="../htmls/home.php">Начало</a></li>
                    <!-- <li><a href="for_us.php">За нас</a></li> -->
                    <li><a href="../htmls/subitiq.php">Събития</a></li>
                    <li><a href="../htmls/Contacts.php" id="active">Контакти</a></li>
                    <li><a href="../htmls/comunitie.php">Общност</a></li>
                    <!-- <li><a href="../htmls/client.php">Профил</a></li> -->
                   <?php if (isset($_SESSION['role_id'])): ?>
                        <?php if ($_SESSION['role_id'] == 2 || $_SESSION['role_id'] == 3): ?>
                            <li><a href="create_event.php">Създай събитие</a></li>
                        <?php endif; ?>
                    <?php endif; ?>
                </ul>
            </div>

            <div class="left">
    <?php if (isset($_SESSION['user_id'])): ?>
        <div id="user-info-btn">
            <img src="../Imiges/user-1.png" alt="User Avatar" class="user-avatar-menu">
            <span><?php echo htmlspecialchars($_SESSION['username']); ?></span>
        </div>
        <div class="logout">
            <a href="logout.php" style="color: white; text-decoration: none;">
                <i class="fas fa-sign-out" title="Изход от профила"></i>
            </a>
        </div>
    <?php else: ?>
        <div id="log-in-btn" class="fas fa-user" title="Вход"></div>
    <?php endif; ?>
</div>
        </div>
    </nav>
    <!-- nav end -->

    <!-- main start -->


    <!-- log in старт -->

    <div class="container-log-in">
        <div class="close-btn fa-solid fa-xmark"></div>
        <h1>Влезте в акунта си</h1>
         <form action="login_user.php" method="post">
            <input type="text" placeholder="Потребителско име" required name="username" pattern="[a-zA-Zа-яА-Я] {5-30}">
            <input type="password" placeholder="Парола" name="password">
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
        <form action="update_profile.php" method="POST">
            <label for="firstname">Име</label>
            <input type="text" name="first_name" value="<?php echo htmlspecialchars($userData['firstname']); ?>">

            <label for="lastname">Фамилия</label>
            <input type="text" name="last_name" value="<?php echo htmlspecialchars($userData['lastname']); ?>">
            
            <label for="email">Имейл</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($userData['email']); ?>">
            
            <label for="phone">Телефонен номер</label>
            <input type="text" name="phone_number" value="<?php echo htmlspecialchars($userData['phone_number']); ?>">
            
            <hr style="margin: 20px 0; border: 0; border-top: 1px solid #ccc;">
            <p style="font-size: 0.8rem; color: gray;">Ако искате да смените паролата си:</p>

            <label for="old_password">Стара Парола</label>
            <input type="password" name="old_password">
            
            <label for="new_password">Нова парола</label>
            <input type="password" name="new_password">
            
            <input type="submit" name="update_profile" value="Запази промените">
        </form>
    </div>
</div>

    <!-- user info end -->
 <!--<div class="team">-->

 <!--       <div class="team_box">-->
 <!--           <div class="profile">-->
 <!--               <img src="../Imiges/contact-3.jpg">-->

 <!--               <div class="info">-->
 <!--                   <h2 class="name">Мартин Иванов</h2>-->
 <!--                   <p class="bio">-->
 <!--                   <ul class="list">-->
 <!--                   <li>СПГИ "Д-р Петър Аладжов"</li>-->
 <!--                   <li>гр. Велико Търново</li>-->
 <!--                   <li>"Икономическа информатика" 12 кл.</li>-->
 <!--                    <li>martin1306i@gmail.com</li>-->
 <!--               </ul>-->
 <!--               </p>-->

 <!--                   <div class="team_icon">-->
 <!--                       <i class="fa-brands fa-facebook-f"></i>-->
 <!--                       <i class="fa-brands fa-twitter"></i>-->
 <!--                       <i class="fa-brands fa-instagram"></i>-->
 <!--                   </div>-->

 <!--               </div>-->

 <!--           </div>-->

 <!--           <div class="profile">-->
 <!--               <img src="../Imiges/contact-2.jpg">-->

 <!--               <div class="info">-->
 <!--                   <h2 class="name">Ивайло Иванов</h2>-->
 <!--                   <p class="bio"> -->
 <!--                   <ul class="list">-->
 <!--                   <li>СПГИ "Д-р Петър Аладжов"</li>-->
 <!--                   <li>гр. Велико Търново</li>-->
 <!--                   <li>"Икономическа информатика" 12 кл.</li>-->
 <!--                    <li>ivvoo.2007@gmail.com</li>-->
 <!--               </ul>-->
 <!--               </p>-->

 <!--                   <div class="team_icon">-->
 <!--                       <i class="fa-brands fa-facebook-f"></i>-->
 <!--                       <i class="fa-brands fa-twitter"></i>-->
 <!--                       <i class="fa-brands fa-instagram"></i>-->
 <!--                   </div>-->

 <!--               </div>-->

 <!--           </div>-->

 <!--           <div class="profile">-->
 <!--               <img src="../Imiges/contact-1.jpg">-->

 <!--               <div class="info">-->
 <!--                   <h2 class="name">Камелия Божинова</h2>-->
 <!--                   <p class="bio">-->
 <!--                   <ul class="list">-->
 <!--                   <li>СПГИ "Д-р Петър Аладжов"</li>-->
 <!--                   <li>старши учител</li>-->
 <!--                   <li>гр. Велико Търново</li>-->
 <!--                   <li>kameliqbojinova@abv.bg</li>-->
 <!--                   </p>-->

 <!--                   <div class="team_icon">-->
 <!--                       <i class="fa-brands fa-facebook-f"></i>-->
 <!--                       <i class="fa-brands fa-twitter"></i>-->
 <!--                       <i class="fa-brands fa-instagram"></i>-->
 <!--                   </div>-->

 <!--               </div>-->

 <!--           </div>-->


 <!--           </div>-->

 <!--       </div>-->

 <!--   </div>-->
 
  <div class="team">

        <div class="team_box">
            <div class="profile">
                <img src="../Imiges/contact-3.jpg">

                <div class="info">
                    <h2 class="name">Мартин Иванов</h2>
                    <p class="bio">
                    <ul class="list">
                    <li>СПГИ "Д-р Петър Аладжов"</li>
                    <li>гр. Велико Търново</li>
                    <li>"Икономическа информатика" 12 кл.</li>
                     <li>martin1306i@gmail.com</li>
                </ul>
                </p>

                    <div class="team_icon">
                        <i class="fa-brands fa-facebook-f"></i>
                        <i class="fa-brands fa-twitter"></i>
                        <i class="fa-brands fa-instagram"></i>
                    </div>

                </div>

            </div>

            <div class="profile">
                <img src="../Imiges/contact-2.jpg">

                <div class="info">
                    <h2 class="name">Ивайло Иванов</h2>
                    <p class="bio"> 
                    <ul class="list">
                    <li>СПГИ "Д-р Петър Аладжов"</li>
                    <li>гр. Велико Търново</li>
                    <li>"Икономическа информатика" 12 кл.</li>
                     <li>ivvoo.2007@gmail.com</li>
                </ul>
                </p>

                    <div class="team_icon">
                        <i class="fa-brands fa-facebook-f"></i>
                        <i class="fa-brands fa-twitter"></i>
                        <i class="fa-brands fa-instagram"></i>
                    </div>

                </div>

            </div>

            <div class="profile">
                <img src="../Imiges/contact-1.jpg">

                <div class="info">
                    <h2 class="name">Камелия Божинова</h2>
                    <p class="bio">
                    <ul class="list">
                    <li>СПГИ "Д-р Петър Аладжов"</li>
                    <li>старши учител</li>
                    <li>гр. Велико Търново</li>
                    <li>kameliqbojinova@abv.bg</li>
                    </p>

                    <div class="team_icon">
                        <i class="fa-brands fa-facebook-f"></i>
                        <i class="fa-brands fa-twitter"></i>
                        <i class="fa-brands fa-instagram"></i>
                    </div>

                </div>

            </div>


            </div>

        </div>

    </div>
    <div class="container-contact">
        <h1>За контакт с нас</h1>
        <div class="second-part-contact">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2914.0805306704633!2d25.63875577618157!3d43.08180227113495!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40a92618de06b9c3%3A0xd5f26980c1f4105f!2z0KHRgtCw0YDQvtC_0YDQtdGB0YLQvtC70L3QsCDQv9GA0L7RhNC10YHQuNC-0L3QsNC70L3QsCDQs9C40LzQvdCw0LfQuNGPINC_0L4g0LjQutC-0L3QvtC80LjQutCwICLQlC3RgCDQn9C10YLRitGAINCQ0LvQsNC00LbQvtCyIg!5e0!3m2!1sbg!2sbg!4v1764600052084!5m2!1sbg!2sbg" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            <div class="form-contact">
                <form action="#">
                    <h2>Запитвания</h2>
                    <input type="text" placeholder="Потребителско име" name="first_name" required
                        title="Въведете валидно потребителско име (5-30 букви)" pattern="[a-zA-Zа-яА-Я\s]{5,30}">
                    <input type="text" placeholder="Телефон" required name="tel"
                        title="Въведете валиден телефонен номер (10-13 цифри)" pattern="[0-9+]{10,13}">
                    <input type="email" placeholder="Имейл" required name="email"
                        title="Въведете валиден имейл с валиден домейн"
                        pattern="[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,5}$">
                    <textarea placeholder="Напиши съобщение..."></textarea>
                    <input type="submit" value="Изпрати">
                </form>
            </div>
        </div>
        
       
    </div
    </div>
    <!-- main end -->

    <!-- footer strat -->


    <footer>
        <div class="footer-hero">
            <div class="footer-card">
                <h2>Топ градове</h2>
                <ul class="list-footer">
                    <li>София</li>
                    <li>Варна</li>
                    <li>Пловдив</li>
                    <li>Шумен</li>
                    <li>Стара Загора</li>
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
    <script>


    </script>
</body>

</html>