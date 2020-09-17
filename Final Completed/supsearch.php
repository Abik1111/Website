<!DOCTYPE html>
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
        <!--   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">-->
        <link rel="stylesheet" href="css/styles.css" />
        <script src="https://kit.fontawesome.com/a076d05399.js"></script>

    </head>

    <body>
        <header>
            <nav id="header-nav" class="navbar navbar-default">
                <div class="container">
                    <div class="navbar-header">
                        <a href="index.html" class="pull-left">
                            <div id="logo-photo"></div>
                        </a>
                        <div class="navbar-brand">
                            <a href="index.html">
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
                                >
                                    <div class="form-group">
                                        <input
                                            id="search-input"
                                            type="text"
                                            class="form-control"
                                            placeholder="Search"
                                        />
                                        <div class="dropdown">
                                            <button
                                                id="dropdown-btn"
                                                type="button"
                                                class="dropbtn"
                                            >
                                                All
                                                <span class="caret"></span>
                                            </button>
                                            <div
                                                id="dropdown-options"
                                                class="dropdown-content"
                                            >
                                                <a
                                                    onclick="$myNameSpc.changeDropdown('All')"
                                                    >All</a
                                                >
                                                <a
                                                    onclick="$myNameSpc.changeDropdown('Land')"
                                                    >Land</a
                                                >
                                                <a
                                                    onclick="$myNameSpc.changeDropdown('House')"
                                                    >House</a
                                                >
                                            </div>
                                        </div>
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
                            <li>
                                <a href="#"
                                    ><span
                                        class="glyphicon glyphicon-home"
                                    ></span>
                                    Home</a
                                >
                            </li>
                            <li>
                                <a href="calc.html"
                                    ><span class="fas fa-calculator"></span>
                                    Calculator</a
                                >
                            </li>
                            <li>
                                <a href="#"
                                    ><span
                                        class="glyphicon glyphicon-user"
                                    ></span>
                                    Login</a
                                >
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <div id="main-content" class="container">   
         
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
    </body>
</html>
