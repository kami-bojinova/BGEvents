<?php
session_start();
include 'db.php';
?>
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
        <link rel="shortcut icon" href="../Imiges/logo.png" type="image/x-icon">
    <title>Събития</title>
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
                    <li><a href="../htmls/subitiq.php" id="active">Събития</a></li>
                    <li><a href="../htmls/Contacts.php">Контакти</a></li>
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

    <div class="containar_offer">
        <?php
        include "db.php";
        if (isset($_GET["event_id"])) {
            $event_id = $_GET["event_id"];
            // $sql = "SELECT * FROM events WHERE event_id='$event_id' ";
            $sql = "
                    SELECT e.*, c.label AS category_name, t.quantity, t.status, i.image
                    FROM events e 
                    LEFT JOIN categories c ON e.category_id = c.category_id
                    LEFT JOIN tickets t ON e.event_id = t.event_id
                    LEFT JOIN images i ON e.event_id = i.event_id
                    WHERE e.event_id = '$event_id'
                ";
            $result = $connection->query($sql);
            if (!$result) {
                echo "greshka: " . $connection->error;
            }
            $row = $result->fetch_assoc();
            $start_date = date("d.m.Y", strtotime($row["start_date"]));
            $end_date = date("d.m.Y", strtotime($row["end_date"]));
            $start_time = $row["start_time"];
            $end_time = $row["end_time"];
            $quantity = $row["quantity"] ?? 0;
            $status = $row["status"] ?? "free";
            $time_display = !empty($start_time)
                ? (!empty($end_time)
                    ? "$start_time - $end_time"
                    : "$start_time")
                : "";
            $date_display = !empty($start_date)
                ? (!empty($end_date)
                    ? "$start_date - $end_date"
                    : "$start_date")
                : "";
            $vhod_display =
                $status == "paid" ? $row["price"] . " лв." : "Безплатно";
            $sql_images = "SELECT image FROM images WHERE event_id = $event_id ORDER BY image";
            $images_result = $connection->query($sql_images);
            $images = [];
            if ($images_result->num_rows > 0) {
                while ($image = $images_result->fetch_assoc()) {
                    $images[] = $image["image"]; // Добавяме пътя на всяко изображение в масив
                }
            }

            echo "
                <h1>$row[title]</h1>
                <div class='hero_offers'>
                    <div class='small-img-offers'>
            ";
            foreach ($images as $image) {
                echo "    
                    <img src='img/$image' onclick='myFunction(this)' alt='snimka'>
                ";
            }
            echo "
                </div>
                <div class='big-img-offers'>
                    <img src='img/$images[0]' id='big-img' alt='snimka'>
                </div>
                    <ul class='offer_ul'>
                        <li class='speacial_offer'><i class='fa-solid fa-icons'></i> Категория: $row[category_name]</li>
                        <li><i class='fa-solid fa-calendar'></i> Дата: $date_display</li>
                        <li><i class='fa-solid fa-hourglass-end'></i> Час: $time_display</li>
                        <li><i class='fa-solid fa-arrow-right-to-bracket'></i> Вход: $vhod_display</li>
                        <li><i class='fa-solid fa-envelope'></i>  Билети: $quantity бр.</li>
                        <li><i class='fa-solid fa-building'></i> Град: $row[city]</li>
                        <li class='speacial_offer'><i class='fa-solid fa-location-dot'></i> Място: $row[location]</li>
                        <button>Купи Билет/Място</button>
                    </ul>
                </div>
                <p>Опиасние: $row[description]</p>
            ";
        }
        ?>
        <!-- <h1>Име на събитие</h1>-->
        <!--<div class="hero_offers">-->
        <!--    <div class="small-img-offers">-->
        <!--        <img src="../Imiges/img-1-home.jpg" onclick="myFunction(this)">-->
        <!--        <img src="../Imiges/img-2-home.jpg" onclick="myFunction(this)">-->
        <!--        <img src="../Imiges/img-3-home.jpg" onclick="myFunction(this)">-->
        <!--    </div>-->
        <!--    <div class="big-img-offers">-->
        <!--        <img src="../Imiges/img-1-home.jpg" id="big-img">     -->
        <!--    </div>-->
        <!--    <ul class="offer_ul">-->
        <!--        <li><i class="fa-solid fa-chart-line"></i> Статус: Активен/Неактивен</li>-->
        <!--        <li class="speacial_offer"><i class="fa-solid fa-icons"></i> Категория: Lorem, ipsum.</li>-->
        <!--        <li><i class="fa-solid fa-hourglass-end"></i> Час: Lorem ipsum dolor sit.</li>-->
        <!--        <li class="speacial_offer"><i class="fa-solid fa-hourglass-end"></i> Край: Lorem ipsum dolor sit amet.</li>-->
        <!--        <li><i class="fa-solid fa-arrow-right-to-bracket"></i> Вход: платен/безплатен</li>-->
        <!--        <li><i class="fa-solid fa-envelope"></i>  Билет: Няма/цена</li>-->
        <!--        <li><i class="fa-solid fa-building"></i> Град: Lorem, ipsum dolor.</li>-->
        <!--        <li class="speacial_offer"><i class="fa-solid fa-location-dot"></i> Място: Lorem ipsum dolor sit.</li>-->
        <!--        <button>Купи Билет/Място</button>-->
        <!--    </ul>-->
        <!--</div>-->
        <!--<p>Опиасние: Lorem ipsum dolor sit amet consectetur adipisicing elit. Dicta sapiente accusantium ducimus nesciunt. Ab, sunt dolorem blanditiis, dolore incidunt quam qui deleniti doloribus, odio perspiciatis a unde debitis quas placeat.-->
        <!--</p> -->

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
                    <li>Пловдив</a></li>
                    <li>Шумен</li>
                    <li>Стара Загора</li>
                </ul>
            </div>

            <div class="footer-card">
                <h2>Топ категории</h2>
                <ul class="list-footer">
                    <li><a href="subitiq.php">Култура</a></li>
                    <li><a href="subitiq.php">Фестивали</a></li>
                    <li><a href="subitiq.php">Музикални</a></li>
                    <li><a href="subitiq.php">Шоу и комедия</a></li>
                    <li><a href="subitiq.php">За деца</a></li>
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
    <script src="../script/script.js" defer></script>
</body>

</html>