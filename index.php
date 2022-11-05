<?php
require "vendor/autoload.php";

use GuzzleHttp\Client;

function getHome() {
    $token = '1cc6aed82f07f1d2828ce0c433fa66c46a5c460913c218decc8cf28a3bd5a850eb1a7ee6ab2d5acde12ae201db52fe731d7b181bd3154ba4da848bc41139f1fbf864ffa12963de1de8eb3490c6414d6eed593e953f1acea6cfe4d317c35b1d523603d378e7b8461cb4283f47bfca469b4cd3c48bad6209d528c2201b72fca685';

    
        $client = new Client([
            'base_uri' => 'http://localhost:1337/api/'
        ]);
    
        $headers = [
          'Authorization' => 'Bearer ' . $token,        
          'Accept'        => 'application/json',
      ];
  
      $response = $client->request('GET', 'home', [
          'headers' => $headers
      ]);
    
        $body = $response->getBody();
        $decoded_response = json_decode($body);
        return $decoded_response;

}

$homes = getHome();


$headerLogo = $homes->data->attributes->headerLogo;
$hs_title = $homes->data->attributes->heroSection->title;
$hs_descrip= $homes->data->attributes->heroSection->description;
$hs_btn= $homes->data->attributes->heroSection->buttonText;
$footerLogo= $homes->data->attributes->footerLogo;
$footerSlogan =$homes->data->attributes->footerSlogan;
$featuredProducts =$homes->data->attributes->featuredProducts;
// $featuredImg = $homes->data->attributes->featuredProducts->image;
// $featuredName = $homes->data->attributes->featuredProducts->name;
// $featuredPrice= $homes->data->attributes->featuredProducts->price;
$latestProducts = $homes->data->attributes->latestProducts;
$testimonials = $homes->data->attributes->testimonials;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RedStore | Ecommerce Website Design</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    
    <div class="header">
        <div class="container">
            <div class="navbar">
                <div class="logo">
                    <a href="index.html"><img src="<?php echo $headerLogo?>" alt="logo" width="125px"></a>
                </div>
                <nav>
                    <ul id="MenuItems">
                        <li><a href="index.html">Home</a></li>
                        <li><a href="products.html">Products</a></li>
                        <li><a href="">About</a></li>
                        <li><a href="">Contact</a></li>
                        <li><a href="account.html">Account</a></li>
                    </ul>
                </nav>
                <a href="cart.html"><img src="images/cart.png" width="30px" height="30px"></a>
                <img src="images/menu.png" class="menu-icon" onclick="menutoggle()">
            </div>
            <div class="row">
                <div class="col-2">
                    <h1><?= $hs_title ?></h1>
                    <p><?= $hs_descrip ?></p>
                    <a href="" class="btn">Explore Now &#8594;</a>
                </div>
                <div class="col-2">
                    <img src="images/image1.png">
                </div>
            </div>
        </div>
    </div>

    <!-- Feadtued Categories -->

    <div class="categories">
        <div class="small-container">
            <div class="row">
                <div class="col-3">
                    <img src="images/category-1.jpg">
                </div>
                <div class="col-3">
                    <img src="images/category-2.jpg">
                </div>
                <div class="col-3">
                    <img src="images/category-3.jpg">
                </div>
            </div>
        </div>
    </div>

    <!-- Featured Products -->

    <div class="small-container">
        <h2 class="title">Featured Products</h2>
        <div class="row">
            <?php foreach($featuredProducts as $featuredProduct):?>
            <div class="col-4">
                <a href="product_details.html"><img src="<?= $featuredProduct->image ?>"></a>
                <h4><?= $featuredProduct->name?></h4>
                <div class="rating">
                    <?php
                        for ($x = 0; $x <$featuredProduct->stars; $x++) {
                        ?>
                        <i class="fa fa-star"></i>
                        <?php } ?>
                    <?php 
                        for ($x = 0; $x <5 - $featuredProduct->stars; $x++) {
                            ?>
                            <i class="fa fa-star-o"></i>
                            <?php } ?>
                </div>
                <p><?= $featuredProduct->price?></p>
            </div>
            <?php endforeach;?>
        </div>
        <h2 class="title">Latest Products</h2>
        <div class="row">
            <?php foreach($latestProducts as $latestProduct):?>
            <div class="col-4">
                <img src=<?= $latestProduct->image?>>
                <h4><?= $latestProduct->name?></h4>
                <div class="rating">
                <?php
                        for ($x = 0; $x <$latestProduct->stars; $x++) {
                        ?>
                        <i class="fa fa-star"></i>
                        <?php } ?>
                    <?php 
                        for ($x = 0; $x <5 - $latestProduct->stars; $x++) {
                            ?>
                            <i class="fa fa-star-o"></i>
                            <?php } ?>
                </div>
                <p><?= $latestProduct->price?></p>
            </div>
            <?php endforeach;?>
            </div>
    </div>

    <!-- Offer -->
    <div class="offer">
        <div class="small-container">
            <div class="row">
                <div class="col-2">
                    <img src="images/exclusive.png" class="offer-img">
                </div>
                <div class="col-2">
                    <p>Exclusively Available on RedStore</p>
                    <h1>Smart Band 4</h1>
                    <small>The Mi Smart Band 4 fearures a 39.9%larger (than Mi Band 3) AMOLED color full-touch display
                        with adjustable brightness, so everything is clear as can be.<br></small>
                    <a href="products.html" class="btn">Buy Now &#8594;</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Testimonial -->
    <div class="testimonial">
        <div class="small-container">
            <div class="row">
            <?php foreach($testimonials as $testimonial):?>
                <div class="col-3">
                    <i class="fa fa-quote-left"></i>
                    <p><?= $testimonial->testimonial?></p>
                    <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </div>
                    <img src=<?= $testimonial->picture?>>
                    <h3><?= $testimonial->name?></h3>   
                </div>
            <?php endforeach;?>
            </div>
        </div>
    </div>

    <!-- Brands -->

    <div class="brands">
        <div class="small-container">
            <div class="row">
                <div class="col-5">
                    <img src="images/logo-godrej.png">
                </div>
                <div class="col-5">
                    <img src="images/logo-oppo.png">
                </div>
                <div class="col-5">
                    <img src="images/logo-coca-cola.png">
                </div>
                <div class="col-5">
                    <img src="images/logo-paypal.png">
                </div>
                <div class="col-5">
                    <img src="images/logo-philips.png">
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="footer-col-1">
                    <h3>Download Our App</h3>
                    <p>Download App for Android and ios mobile phone.</p>
                    <div class="app-logo">
                        <img src="images/play-store.png">
                        <img src="images/app-store.png">
                    </div>
                </div>
                <div class="footer-col-2">
                    <img src=<?= $footerLogo?>>
                    <p><?= $footerSlogan?>
                    </p>
                </div>
                <div class="footer-col-3">
                    <h3>Useful Links</h3>
                    <ul>
                        <li>Coupons</li>
                        <li>Blog Post</li>
                        <li>Return Policy</li>
                        <li>Join Affiliate</li>
                    </ul>
                </div>
                <div class="footer-col-4">
                    <h3>Follow Us</h3>
                    <ul>
                        <li>Facebook</li>
                        <li>Twitter</li>
                        <li>Instagram</li>
                        <li>Youtube</li>
                    </ul>
                </div>
            </div>
            <hr>
            <p class="copyright">Copyright 2020 - Samwit Adhikary</p>
        </div>
    </div>

    <!-- javascript -->

    <script>
        var MenuItems = document.getElementById("MenuItems");
        MenuItems.style.maxHeight = "0px";
        function menutoggle() {
            if (MenuItems.style.maxHeight == "0px") {
                MenuItems.style.maxHeight = "200px"
            }
            else {
                MenuItems.style.maxHeight = "0px"
            }
        }
    </script>

</body>

</html>