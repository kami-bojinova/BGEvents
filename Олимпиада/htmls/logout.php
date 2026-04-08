<?php
session_start();
session_unset(); // Изтрива всички променливи в сесията
session_destroy(); // Унищожава самата сесия
header("Location: home.php"); // Връща те в началото
exit();