<?php
    include 'Jagga.php';
    define ('NULL_IMAGE', 'Images/jumbotron.jpg');
    $jagga = new JaggaRetrieve('localhost', 'client', 'password');
    
    $id = 0;
    session_start();
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }
    $jagga->loadFromDatabase($id);

    $search_key = $_SESSION['search_key'];
    $property_type = $_SESSION['type'];
?>

<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>THE PROPERTY SITE</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="css/styles.css" />
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

</head>

<body>
    <header>
        <nav id="header-nav" class="navbar navbar-default">
            <div class="container">
                <div class="navbar-header">
                    <a href="index.php?type=all" class="pull-left">
                        <div id="logo-photo"></div>
                    </a>
                    <div class="navbar-brand">
                        <a href="index.php?type=all">
                            <h1>Ghar Jagga</h1>
                        </a>
                        <p>Real real-estates</p>
                    </div>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapsed-navbar" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
            </div>
        </nav>
        <nav>
            <div class="collapse navbar-collapse" id="collapsed-navbar">
                <div class="container">
                    <ul id="nav-listed" class="nav navbar-nav navbar-left">
                        <li>
                            <form class="navbar-form navbar-left" role="search"
                                    action="search-index.php"
                                    method="GET">
                                <div class="form-group">
                                        <input
                                            id="search-input"
                                            type="text"
                                            class="form-control"
                                            placeholder="Search"
                                            name = "search_key"
                                            value = "<?php echo $search_key;?>"
                                        />
                                    <select class="Dropdown_select" name="type">
                                            <?php if($property_type=='all'):?>
                                               <option value="all">All</option> 
                                               <option value="land">Land</option> 
                                               <option value="house">House</option>
                                            <?php elseif($property_type=='land'):?>
                                               <option value="land">Land</option> 
                                               <option value="house">House</option>
                                               <option value="all">All</option> 
                                            <?php else:?>
                                               <option value="house">House</option> 
                                               <option value="land">Land</option>   
                                               <option value="all">All</option> 
                                            <?php endif;?>
                                        </select>
                                    </select>
                                    
                                    <button id="search-button" type="submit" class="btn btn-default">
                                        <span class="glyphicon glyphicon-search"></span>
                                    </button>
                                </div>
                            </form>
                        </li>
                        <li>
                            <a href="index.php?type=all"><span class="glyphicon glyphicon-home"></span>
                                Home</a>
                        </li>
                        <li>
                            <a href="calc.php"><span class="fas fa-calculator"></span>
                                Calculator</a>
                        </li>
                        <li>
                            <a href="#"><span class="glyphicon glyphicon-chevron-up"></span>
                                Request Sell</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <div id="main-content" class="container">
        <div id="back-button">
            <a href="<?php echo $_SERVER['HTTP_REFERER']?>"><span class="glyphicon glyphicon-chevron-left"></span>
            <span>Back</span></a>
        </div>
        <div id="details-body" class="row">
            <div class="col-md-6">
                <div class="slideshow-container">

                <?php if($jagga->getNumberOfImages() <=0):?>
                    <div class="mySlides">
                        <div class="numbertext"><?php echo '0/'.$jagga->getNumberOfImages();?></div>
                        <img src="<?php echo NULL_IMAGE;?>" style="width:100%; max-height: 400px; border: 1px solid #88E2F2 !important; object-fit: cover; border-radius: 15px;">
                        <div class="text"></div>
                    </div>
                <?php endif?>

                <?php for($i=0; $i<$jagga->getNumberOfImages(); $i++):?>
                    <div class="mySlides">
                        <div class="numbertext"><?php echo ($i+1).'/'.$jagga->getNumberOfImages();?></div>
                        <img src="<?php echo $jagga->echoImageSrc($i);?>" style="width:100%; max-height: 400px; border: 1px solid #88E2F2 !important; object-fit: cover; border-radius: 15px;">
                        <div class="text"></div>
                    </div>
                <?php endfor;?>
    
                    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                    <a class="next" onclick="plusSlides(1)">&#10095;</a>
    
    
                </div>
    
                <!--To do-->
                <div style="text-align:center">
                <?php for($i=0; $i<$jagga->getNumberOfImages(); $i++):?>
                    <span class="dot" onclick="currentSlide(<?php echo ($i+1);?>)"></span>
                <?php endfor;?>
                </div>
            </div>
            <script>
                var slideIndex = 1;
                showSlides(slideIndex);
    
                function plusSlides(n) {
                    showSlides(slideIndex += n);
                }
    
                function currentSlide(n) {
                    showSlides(slideIndex = n);
                }
    
                function showSlides(n) {
                    var i;
                    var slides = document.getElementsByClassName("mySlides");
                    var dots = document.getElementsByClassName("dot");
                    if (n > slides.length) {
                        slideIndex = 1
                    }
                    if (n < 1) {
                        slideIndex = slides.length
                    }
                    for (i = 0; i < slides.length; i++) {
                        slides[i].style.display = "none";
                    }
                    for (i = 0; i < dots.length; i++) {
                        dots[i].className = dots[i].className.replace(" active", "");
                    }
                    slides[slideIndex - 1].style.display = "block";
                    dots[slideIndex - 1].className += " active";
                }
            </script>
            <div class="col-md-6">
                    <div class="Description1">
                    <table style="width:80%; font-size: 16px;">
                        <tr>
                            <td><b style="color:rgb(69, 69, 71)">Location </b></td>
                            <td> : <?php $jagga->echoLocation();?></td>
    
                        </tr>
                        <tr>
                            <td><b style="color:rgb(69, 69, 71)"> Price </b></td>
                            <td> : Rs.<?php JaggaBlock::echoMoneyFormat($jagga->getPrice());?>/-</td>
    
                        </tr>
                        <tr>
                            <td><b style="color:rgb(69, 69, 71)"> Area </b></td>
                            <td> : <?php $jagga->echoArea();?></td>
    
                        </tr>
                        <tr>
                            <td><b style="color:rgb(69, 69, 71)"> Property Type </b></td>
                            <td> : <?php $jagga->echoType();?></td>
    
                        </tr>
                        <tr>
                            <td><b style="color:rgb(69, 69, 71)"> Posted On </b></td>
                            <td> : <?php $jagga->echoPostedTime();?></td>
                        </tr>
    
                    </table>
    
    
    
                    <!--  <h1 style="text-align: center"> <b style="color: skyblue">Description</b></h1><br>
                                <h4> <b style="color: darkorange">Location</b> : Nayabazar<br>
                                   <b style="color: darkorange"> Price</b> : 2 crore<br>
                                    <b style="color: darkorange"> Size</b> : 5 Aana<br>
                                    <b style="color: darkorange">Talla </b>: $ talla<br>
                                    <b style="color: darkorange"> Built in</b> : 2016<br><br>
                    -->
                    <h3 style="color:rgb(69, 69, 71)"><b>Description</b></h3>
                    <h5 style="color: rgb(128, 128, 128); line-height: 120%; height: 86px; overflow-y: scroll; margin-bottom: 10px; padding: 10px; border-top: 1px solid gray !important; text-align:justify ">
                    <?php $jagga->echoHTMLDescription();?></h5>
                    </h4>
                    <div class="col-md-12">
                    <h5 class="Description2">
                        <b>Contact Details</b><br>
                        9863636363, 983636363, 01325455<br>
                        fortune_teller2000@gmail.com
        
                    </h5>
                    </div>
                </div>
            
        </div>
    </div>
            </div>
        <footer class="panel-footer">
            <div class="container">
                <div class="row">
                    <section id="contact">
                        <span>Contact us:</span><br />
                        <a href="tel:+977015543338"
                            ><span class="glyphicon glyphicon-phone-alt"></span>
                            9860560086&nbsp;&nbsp;</a
                        >
                        <a href="tel:+977015543338"
                            ><span class="glyphicon glyphicon-phone"></span>
                            9860560086</a
                        ><br />
                        <a class="social" href="https://www.facebook.com"
                            ><span class="fab fa-facebook-square"></span
                            >&nbsp;&nbsp;</a
                        >
                        <a class="social" href="https://www.instagram.com"
                            ><span class="fab fa-instagram"></span
                        ></a>
                        <br />
                        <a href="mailto: gharjagga@gmail.com"
                            ><span class="glyphicon glyphicon-envelope"></span>
                            gharjagga@gmail.com</a
                        >
                    </section>
                    <hr />
                    <div class="text-center">&copy; Copyright 2020.</div>
                    <div id="author">Created by VECTORR</div>
                </div>
            </div>
        </footer>

        
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/ajaxUtils.js"></script>
    <script src="js/script.js"></script>

    <!--
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha3849/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
-->
</body></html>
