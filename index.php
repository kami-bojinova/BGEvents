<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>BGEvents</title>
   <!-- swiper css link  -->
   <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
   <!-- custom css file link  -->
   <link rel="stylesheet" href="style.css">
   <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>
<!-- header section starts  -->
<section class="header">
   
   <h1>BG<span>Events</span> </h1>
   <h2>Hello world</h2>
</div>

<!-- footer section starts  -->
  
<!-- footer section ends -->
<!-- swiper js link  -->
<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
<!-- custom js file link  -->


<script src="js/script.js"></script>
<script>
    // Показване на бутона при скролиране
window.onscroll = function() {
    let scrollButton = document.querySelector('.scroll-top');
    // Когато се скролира надолу повече от 300 пиксела, бутонът ще се появи
    if (document.body.scrollTop > 300 || document.documentElement.scrollTop > 300) {
        scrollButton.style.display = "block"; // Показваме бутона
    } else {
        scrollButton.style.display = "none"; // Скриваме бутона, ако не е скролирано надолу
    }
};

// Скролиране нагоре при натискане на бутона
document.querySelector('.scroll-top').addEventListener('click', function() {
    window.scrollTo({ top: 0, behavior: 'smooth' }); // Плавно скролиране до началото на страницата
});
</script>


</body>
</html>