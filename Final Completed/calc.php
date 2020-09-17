<?php

    session_start();
    $search_key = $_SESSION['search_key'];
    $property_type = $_SESSION['type'];

?><!DOCTYPE html>
<html lang="">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>THE PROPERTY SITE</title>
        <link rel="stylesheet" href="css/bootstrap.min.css" />
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
        />
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
                        <button
                            type="button"
                            class="navbar-toggle collapsed"
                            data-toggle="collapse"
                            data-target="#collapsed-navbar"
                            aria-expanded="false"
                        >
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
                                <form class="navbar-form navbar-left" role="search" action="search-index.php" method="GET">
                                <div class="form-group">
                                    <input id="search-input" type="text" class="form-control" placeholder="Search" value="<?php echo $search_key;?>" />
                                    <select class="Dropdown_select">
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
                                <a href="index.php?type=all"
                                    ><span
                                        class="glyphicon glyphicon-home"
                                    ></span>
                                    Home</a
                                >
                            </li>
                            <li class="active">
                                <a href="calc.php"
                                    ><span class="fas fa-calculator"></span>
                                    Calculator<span class="sr-only"
                                    >(current)</span
                                ></a
                                >
                            </li>
                            <li>
                                <a href="client.php"
                                    ><span
                                        class="glyphicon glyphicon-chevron-up"
                                    ></span>
                                    Request Sell</a
                                >
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <div id="main-content-calc" class="container">
            <div class="col-lg-4"></div>
            <div id="page-calc" class="col-lg-4">
                <div id="area-converter" class="row">
                    <span>From:</span><br />
                    <select id="Selectbox1" class="selectz">
                        <option value="Ana"><span>Ana</span></option>
                        <option value="Square Foot">Square Foot</option>
                        <option value="Square Meter">Square Meter</option>
                        <option value="Ropani">Ropani</option>
                        <option value="Katha">Katha</option>
                        <option value="Dhur">Dhur</option>
                        <option value="Dam">Dam</option>
                        <option value="Paisa">Paisa</option>
                    </select>
                    <input id="inputLength" placeholder="Enter Value"/>
                    <br />
                    <span>To:</span><br />
                    <select id="Selectbox2" class="selectz">
                        <option value="Ana">Ana</option>
                        <option value="Square Foot">Square Foot</option>
                        <option value="Square Meter">Square Meter</option>
                        <option value="Ropani">Ropani</option>
                        <option value="Katha">Katha</option>
                        <option value="Dhur">Dhur</option>
                        <option value="Dam">Dam</option>
                        <option value="Paisa">Paisa</option>
                    </select>

                    <div id="outputMeters">Output Area</div>
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
        <!-- <script src="practice.js"></script>
        <script src="js/ajaxUtils.js"></script>
        <script src="js/script.js"></script> -->
        <script src="js/calc.js"></script>

    </body>
</html>
