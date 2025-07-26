 <!DOCTYPE html>
<html lang="en">
  <!--Created by Tivotal-->
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Event Organisers | Tivotal</title>

    <!--swiper css-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"
    />

    <!--font awesome-->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
    />

    <!--css file-->
    <link rel="stylesheet" href="styles.css" />
  </head>
  <body>
    <!-- header section starts  -->
    <header class="header">
      <a href="#" class="logo"><span>A</span>NS</a>

      <nav class="navbar">
        <a href="#home">home</a>
        <a href="#service">service</a>
        <a href="#about">about</a>
        <a href="#gallery">gallery</a>
        <a href="#price">price</a>
        <a href="login.php">Register</a>
        <a href="history.php">Event History</a>
        <a href="fed.php">Feedback</a>
        <a href="feedbacks.php">Feedback History</a>
      </nav>

      <div id="menu-bars" class="fas fa-bars"></div>
 <!-- Search bar -->
      <div class="search-container">
        <input type="text" placeholder="Search...">
        <button type="submit">Search</button>
      </div>
    </header>

    <!-- home section starts  -->
    <section class="home" id="home">
      <div class="content">
        <h3>
          where your ideas take off
          <span> ANS events </span>
        </h3>
        <a href="#" class="btn">get quote</a>
      </div>

      <div class="swiper-container home-slider">
        <div class="swiper-wrapper">
          <?php 
          $images = ["home1.jpg", "home2.jpg", "sam.jpg", "home10.jpg", "home6.jpg", "home3.jpg", "coor.jpg", "home9.jpg", "homeShower.jpg"];
          foreach ($images as $image) {
            echo "<div class='swiper-slide'><img src='$image' alt='Image'></div>";
          }
          ?>
        </div>
      </div>
    </section>

    <!-- service section starts  -->
    <section class="service" id="service">
      <h1 class="heading">our <span>services</span></h1>

      <div class="box-container">
        <?php 
        $services = [
          ["icon" => "fas fa-envelope", "title" => "invitation card design"],
          ["icon" => "fas fa-photo-video", "title" => "photos and videos"],
          ["icon" => "fas fa-music", "title" => "entertainment"],
          ["icon" => "fas fa-car", "title" => "event vehicles"],
          ["icon" => "fas fa-map-marker-alt", "title" => "venue selection"],
          ["icon" => "fas fa-birthday-cake", "title" => "food catering"]
        ];

        foreach ($services as $service) {
          echo "<div class='box'>
                  <i class='{$service['icon']}'></i>
                  <h3>{$service['title']}</h3>
                  <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro, suscipit.</p>
                </div>";
        }
        ?>
      </div>
    </section>

    <!-- about section starts -->
    <section class="about" id="about">
      <h1 class="heading"><span>about</span> us</h1>
      <div class="row">
        <div class="image">
          <img src="about.jpg" alt="About Us">
        </div>
        <div class="content">
          <h3>your occasion deserves our careful planning</h3>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam labore fugiat ut esse perferendis perspiciatis provident dolores fuga in facilis culpa possimus, quia praesentium itaque, sapiente quasi harum rem asperiores.</p>
          <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Fugiat vero expedita incidunt provident quibusdam aut odit, numquam nesciunt similique nisi.</p>
          <a href="#" class="btn">reach us</a>
        </div>
      </div>
    </section>

    <!-- gallery section starts -->
    <section class="gallery" id="gallery">
      <h1 class="heading">our <span>gallery</span></h1>
      <div class="box-container">
        <?php 
        $gallery = [
          ["image" => "shower.jpg", "title" => "Baby Shower", "link" => "baby.html"],
          ["image" => "Gallarywed.jpg", "title" => "Weddings", "link" => "wedLink.html"],
          ["image" => "gallery3.jpg", "title" => "Birthday Parties", "link" => "birthday.html"],
          ["image" => "gallery4.jpg", "title" => "Catering", "link" => "c1.html"],
          ["image" => "gallery5.jpg", "title" => "Cruise Parties", "link" => "cruise.html"],
          ["image" => "GallaryAni.jpg", "title" => "Anniversaries", "link" => "anniversary.html"],
          ["image" => "template.jpg", "title" => "Invitation Templates", "link" => "invitation_templates.html"],
          ["image" => "gallery8.jpg", "title" => "Corporate Events", "link" => "corporate_events.html"],
          ["image" => "gallery9.jpg", "title" => "Concerts", "link" => "concert.html"]
        ];

        foreach ($gallery as $item) {
          echo "<div class='box'>
                  <a href='{$item['link']}' target='_blank'>
                    <img src='{$item['image']}' alt='{$item['title']}'>
                  </a>
                  <h3 class='title'>{$item['title']}</h3>
                </div>";
        }
        ?>
      </div>
    </section>

    <!-- price section starts -->
    <section class="price" id="price">
      <h1 class="heading">our <span>pricing</span></h1>
      <div class="box-container">
        <?php 
        $plans = [
          ["title" => "basic", "price" => "2379.00"],
          ["title" => "prime", "price" => "5789.00"],
          ["title" => "luxury", "price" => "9799.00"],
          ["title" => "ultra", "price" => "1029.00"]
        ];

        foreach ($plans as $plan) {
          echo "<div class='box'>
                  <h3 class='title'>{$plan['title']}</h3>
                  <h3 class='amount'>&#8377 {$plan['price']}</h3>
                  <ul>
                    <li><i class='fas fa-check'></i>full services</li>
                    <li><i class='fas fa-check'></i> decorations</li>
                    <li><i class='fas fa-check'></i> music and photos</li>
                    <li><i class='fas fa-check'></i> food and drinks</li>
                    <li><i class='fas fa-check'></i> invitation card</li>
                  </ul>
                  <a href='#' class='btn'>check out</a>
                </div>";
        }
        ?>
      </div>
    </section>

  
   

    <!-- Footer section starts -->
    <section class="footer">
      <div class="box-container">
        <div class="box">
          <h3>branches</h3>
          <a href="#"> <i class="fas fa-map-marker-alt"></i> Bangalore </a>
          <a href="#"> <i class="fas fa-map-marker-alt"></i> Hyderabad </a>
          <a href="#"> <i class="fas fa-map-marker-alt"></i> Delhi </a>
          <a href="#"> <i class="fas fa-map-marker-alt"></i> Kolkata </a>
          <a href="#"> <i class="fas fa-map-marker-alt"></i> Chennai </a>
        </div>

        <div class="box">
          <h3>quick links</h3>
          <a href="#"> <i class="fas fa-arrow-right"></i> Home </a>
          <a href="#"> <i class="fas fa-arrow-right"></i> Service </a>
          <a href="#"> <i class="fas fa-arrow-right"></i> About </a>
          <a href="#"> <i class="fas fa-arrow-right"></i> Gallery </a>
          <a href="#"> <i class="fas fa-arrow-right"></i> Price </a>
          <a href="#"> <i class="fas fa-arrow-right"></i> Review </a>
          <a href="#"> <i class="fas fa-arrow-right"></i> Contact </a>
        </div>

        <div class="box">
          <h3>contact info</h3>
          <a href="#"> <i class="fas fa-phone"></i> +123-456-7890 </a>
          <a href="#"> <i class="fas fa-phone"></i> +123-456-7890 </a>
          <a href="#"> <i class="fas fa-envelope"></i> ANS@gmail.com </a>
          <a href="#"> <i class="fas fa-envelope"></i> ANSind@gmail.com </a>
          <a href="#"> <i class="fas fa-map-marker-alt"></i> Hyderabad, India - 560054 </a>
        </div>

        <div class="box">
          <h3>follow us</h3>
          <a href="#"> <i class="fab fa-facebook-f"></i> Facebook </a>
          <a href="#"> <i class="fab fa-twitter"></i> Twitter </a>
          <a href="#"> <i class="fab fa-instagram"></i> Instagram </a>
          <a href="#"> <i class="fab fa-linkedin-in"></i> LinkedIn </a>
        </div>
      </div>

      <div class="credit">
        created by <span>Tivotal</span> | all rights reserved
      </div>
    </section>
    <!-- Footer section ends -->

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

    <!-- JS file -->
    <script src="app.js"></script>
  </body>
</html>   
