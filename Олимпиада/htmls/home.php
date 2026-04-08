<?php
session_start(); // Това трябва да е на първия ред, преди всякакъв HTML
include "db.php";
$userData = ["first_name" => "", "email" => "", "phone_number" => "", ];

if (isset($_SESSION["user_id"]))
{
    $u_id = $_SESSION["user_id"];
    $fetchSql = "SELECT firstname, lastname, email, phone_number FROM users WHERE user_id = '$u_id'";
    $fetchResult = $connection->query($fetchSql);
    if ($fetchResult && $fetchResult->num_rows > 0)
    {
        $userData = $fetchResult->fetch_assoc();
    }
}
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
    <title>Начало</title>
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
                    <li><a href="../htmls/home.php" id="active">Начало</a></li>
                    <!-- <li><a href="for_us.php">За нас</a></li> -->
                    <li><a href="../htmls/subitiq.php">Събития</a></li>
                    <li><a href="../htmls/Contacts.php">Контакти</a></li>
               
                    <li><a href="../htmls/comunitie.php">Общност</a></li>
                    <!-- <li><a href="../htmls/client.php">Профил</a></li> -->
                    <?php if (isset($_SESSION["role_id"])): ?>
                        <?php if ($_SESSION["role_id"] == 2 || $_SESSION["role_id"] == 3): ?>
                            <li><a href="index.php">Създай събитие</a></li>
                        <?php
    endif; ?>
                    <?php
endif; ?>
                </ul>
            </div>

            <div class="left">
    <?php if (isset($_SESSION["user_id"])): ?>
        <div id="user-info-btn">
            <img src="../Imiges/user-1.png" alt="User Avatar" class="user-avatar-menu">
            <span><?php echo htmlspecialchars($_SESSION["username"]); ?></span>
        </div>
        <div class="logout">
            <a href="logout.php" style="color: white; text-decoration: none;">
                <i class="fas fa-sign-out" title="Изход от профила"></i>
            </a>
        </div>
    <?php
else: ?>
        <div id="log-in-btn" class="fas fa-user" title="Вход"></div>
    <?php
endif; ?>
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
            <input type="submit" value="Направи акаунт">
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
            <input type="text" name="first_name" value="<?php echo htmlspecialchars($userData["firstname"]); ?>">

            <label for="lastname">Фамилия</label>
            <input type="text" name="last_name" value="<?php echo htmlspecialchars($userData["lastname"]); ?>">
            
            <label for="email">Имейл</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($userData["email"]); ?>">
            
            <label for="phone">Телефонен номер</label>
            <input type="text" name="phone_number" value="<?php echo htmlspecialchars($userData["phone_number"]); ?>">
            
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

    <div class="home-conteiner">

        <h1>Изживей незабравимо приключение с нас!</h1>
        <p class="home-1-p">Актуални предложения</p>

        <a href="../htmls/subitiq.php"><button class="btn-home">Избери</button></a>

        <!-- Поле с филтри -->

        <div id="filtersPanel" aria-hidden="true">

            <div class="panel-arrow left-panel-arrow"><i class="fa-solid fa-chevron-right"></i></div>
            <h3>Филтри</h3>

            <form action="subitiq.php" method="GET">
                <br><br>
                <select name="city" style="width:100%;padding:10px;border-radius:6px;">
                    <option value="">Изберете град...</option>
                    <?php
                        include_once "db.php";
                        $sql_cities = "SELECT DISTINCT city FROM events WHERE city IS NOT NULL AND city != '' ORDER BY city ASC";
                        $result_cities = $connection->query($sql_cities);

                        if ($result_cities && $result_cities->num_rows > 0) {
                            while ($row_city = $result_cities->fetch_assoc()) {
                                $city_name = $row_city['city'];
                                $selected = (isset($_GET["city"]) && $_GET["city"] == $city_name) ? "selected" : "";
                                echo '<option value="' . htmlspecialchars($city_name) . '" ' . $selected . ">" . htmlspecialchars($city_name) . "</option>";
                            }
                        }
                    ?>
                </select>
                <br><br>
                <select name="cat" style="width:100%;padding:10px;border-radius:6px;">
                    <option value="">Категория...</option>
                    <?php
                        include_once "db.php";
                        $sql_categories = "SELECT category_id, label FROM categories ORDER BY category_id ASC";
                        $result_categories = $connection->query($sql_categories);
                        if ($result_categories->num_rows > 0)
                        {
                            while ($row = $result_categories->fetch_assoc())
                            {
                                $selected = isset($_GET["cat"]) && $_GET["cat"] == $row["category_id"] ? "selected" : "";
                                echo '<option value="' . $row["category_id"] . '" ' . $selected . ">" . htmlspecialchars($row["label"]) . "</option>";
                            }
                        }
                    ?>
                </select>
                <input type="date" name="date"><br>
                <br>
                <div class="status-radio">
                    <input type="radio" id="free" name="status" value="free">
                    <label for="free">Безплатен</label><br>
                    <input type="radio" id="paid" name="status" value="paid">
                    <label for="paid">Платен</label><br>
                </div>
                
                <input type="submit" value="Търси">
            </form>

        </div>

        <!-- Поле за календара -->

        <div class="calendar-container" id="calendarPanel" aria-hidden="true">
            <input type="hidden" name="date" id="calendarSelectedDate">
            <div class="panel-arrow right-panel-arrow"><i class="fa-solid fa-chevron-left"></i></div>
            <h3>Календар</h3>
            <div class="calendar">
                <div class="head-cal">
                    <button id="prevBtn">
                        <i class="fa-solid fa-chevron-left"></i>
                    </button>
                    <div class="monthYear" id="monthYear"></div>
                    <button id="nextBtn">
                        <i class="fa-solid fa-chevron-right"></i>
                    </button>
                </div>
                <div class="days">
                    <div class="day">П</div>
                    <div class="day">В</div>
                    <div class="day">С</div>
                    <div class="day">Ч</div>
                    <div class="day">П</div>
                    <div class="day">С</div>
                    <div class="day">Н</div>
                </div>
                <div class="dates" id="dates"></div>
            </div>
            <button type="submit" class="btn_cal">Търси</button>
        </div>

        <!-- Слайдър -->

        <div class="slider-wrapper" id="sliderWrapper">
            <div class="slider-container-home">
                <div class="slides-home">
                    <img src="../Imiges/slide-1.jpg" class="active" alt="slide1">
                    <img src="../Imiges/slide-2.jpg" alt="slide2">
                    <img src="../Imiges/slide-3.jpg" alt="slide3">
                    <img src="../Imiges/slide-4.jpg" alt="slide4">
                    <img src="../Imiges/slide-5.jpg" alt="slide5">
                </div>
            </div>
        </div>

         <div class="home-bottom">
            <div class="title">
                <h2>Скорошни събития</h2>
            </div>

        <div class="hero-home-bottom">
                <?php
                    $sql_recent = "SELECT e.*, t.quantity, t.status, i.image 
                                       FROM events e 
                                       LEFT JOIN tickets t ON e.event_id = t.event_id 
                                       LEFT JOIN images i ON e.event_id = i.event_id 
                                          GROUP BY e.event_id 
                                       ORDER BY e.event_id DESC 
                                       LIMIT 3";

                    $result_recent = $connection->query($sql_recent);

                    if ($result_recent && $result_recent->num_rows > 0)
                    {
                        while ($row = $result_recent->fetch_assoc())
                        {
                            $title = $row['title'];
                    $city_res = $row['city'];
                    $location = $row['location'];
                    $event_id = $row['event_id'];
                    $start_date = date("d.m.Y", strtotime($row['start_date']));
                    $end_date = date("d.m.Y", strtotime($row['end_date']));
                    $start_time = substr($row['start_time'], 0, 5);
                    $end_time = substr($row['end_time'], 0, 5);
                    $quantity = $row['quantity'] ?? 0;
                    $status = $row['status'] ?? 'free';
                    $price_info = ($status === "paid") ? $row['price'] . " лв." : "Безплатно";
                    $img_path = !empty($row['image']) ? "img/" . $row['image'] : "img/default.jpg";
                    $place = $city_res . (!empty($location) ? ", " . $location : "");

                            // echo '
                            //     <div class="card-home-bottom">
                            //         <div class="img-card">
                            //             <img src="' . $imagePath . '">
                            //         </div>
                            //         <h3>' . htmlspecialchars($row["title"]) . '</h3>
                            //         <div class="text-home-card">
                            //             <p><strong><i class="fa-solid fa-location-dot"></i>Къде:</strong>гр. ' . htmlspecialchars($row["city"]) . '</p>
                            //             <p><strong><i class="fa-solid fa-envelope"></i> Билети:</strong> {$quantity}</p>
                            //             <p><strong><i class="fa-solid fa-calendar"></i>Дата:</strong> ' . $start . '</p>
                            //             <p><strong><i class="fa-solid fa-clock"></i> Час:</strong> {$start_time} – {$end_time}</p>
                            //             <p><strong><i class="fas fa-sign-out"></i> Вход:</strong> {$price_info}</p>
                            //         </div>
                            //         <div class="btn-card">
                            //             <a href="offers.php?event_id=' . $row["event_id"] . '">
                            //                 <button class="card-button-home">Виж събитието</button>
                            //             </a>
                            //         </div>
                            //     </div>';

                            echo "
                                <div class='card-home-bottom'>
                                    <div class='img-card'>
                                         <img src='{$img_path}' alt='Събитие'>
                                    </div>
                                    <h3>{$title}</h3>
                                    <div class='text-home-card'>
                                         <p class='where'><strong><i class='fa-solid fa-location-dot'></i> Къде:</strong> {$place}</p>
                                        <p><strong><i class='fa-solid fa-envelope'></i> Билети:</strong> {$quantity}</p>
                                        <p><strong><i class='fa-solid fa-calendar'></i>Дата:</strong> {$start_date} – {$end_date}</p>
                                        <p><strong><i class='fa-solid fa-clock'></i> Час:</strong> {$start_time} – {$end_time}</p>
                                        <p><strong><i class='fas fa-sign-out'></i> Вход:</strong> {$price_info}</p>
                                    </div>
                                    <div class='btn-card'>
                                        <a href='offers.php?event_id={$event_id}'>
                                            <button class='card-button-home'>Виж събитието</button>
                                        </a>
                                    </div>
                                </div>";
                        }
                    }
                    else
                    {
                        echo "<p>Няма намерени скорошни събития.</p>";
                    }
            ?>
        </div>

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
                <h2>Седмичен бюлетин</h2>

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
        const hamburger = document.getElementById("hamburger");
        const navLinks = document.getElementById("nav-links");

        hamburger.addEventListener("click", () => {
            hamburger.classList.toggle("active");
            navLinks.classList.toggle("active");
        });
    </script>

</body>

</html>
