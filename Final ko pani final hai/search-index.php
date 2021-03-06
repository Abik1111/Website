<?php
    include 'Jagga.php';
    define('DATA_NUM_IN_PAGE', 16);
    $selector = new JaggaSelect('localhost', 'client', 'password');
    $current_page = 1;
    $total_pages_no = 1;
    $search_result_no = 1;
    $property_type = 'all';

    session_start();
    //In case of search pressed session value changes
    if(isset($_GET['search_key'])){
        $_SESSION['type'] = $_GET['type'];

        if($_GET['search_key']==''){
            if($_SESSION['type'] == 'all'){
                header('location:index.php?type=all');    
            }
            else if($_SESSION['type'] == 'land'){
                header('location:index.php?type=land');    
            }
            else{
                header('location:index.php?type=house');    
            }
        }
        $_SESSION['search_key']  = $_GET['search_key'];
    }
    //In case of change in page number uses same keyword
    if(isset($_GET['page_number'])){
        $current_page = $_GET['page_number'];
    }

    $keyword = $_SESSION['search_key'];
    $property_type = $_SESSION['type'];
    $data = $selector->getSearchedJagga($keyword,DATA_NUM_IN_PAGE, $current_page, $property_type);
    $total_pages_no = $selector->getSearchPagesNo($keyword,DATA_NUM_IN_PAGE, $property_type);
    $search_result_no = $selector->getResultsNo($keyword, $property_type);
    JaggaSelect::deleteJson('data/tab3.json');
    JaggaSelect::parseToJson($data, 'data/tab3.json', 'desired_properties', $total_pages_no, $current_page);
?>

<!DOCTYPE html>
<html lang="en">
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
                                <form
                                    class="navbar-form navbar-left"
                                    role="search"
                                    action = "search-index.php"
                                    method = "GET"
                                >
                                    <div class="form-group">
                                        <input
                                            id="search-input"
                                            type="text"
                                            class="form-control"
                                            placeholder="Search"
                                            name = "search_key"
                                            value = "<?php echo $keyword;?>"
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
                                        <button
                                            id="search-button"
                                            type="submit"
                                            class="btn btn-default"
                                        >
                                            <span
                                                class="glyphicon glyphicon-search"
                                            ></span>
                                        </button>
                                    </div>
                                </form>
                            </li>
                            <li >
                                <a href="index.php?type=all"
                                    ><span
                                        class="glyphicon glyphicon-home"
                                    ></span>
                                    Home</a>
                            </li>
                            <li>
                                <a href="calc.php"
                                    ><span class="fas fa-calculator"></span>
                                    Calculator</a
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

        <div id="main-content" class="container">
            <div class="search-results">
                <span class="glyphicon glyphicon-search"></span>
                <span> Search for <?php echo '"'.$keyword.'" - '.$search_result_no.' results found';?></span> 
            </div>
            <div>
                <h4 id="heading-4">Property type: <?php echo $property_type.' | ';?>Page number: <?php echo $current_page;?></h4>
            </div>

            <div id="index-page">
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
    </body>
</html>
