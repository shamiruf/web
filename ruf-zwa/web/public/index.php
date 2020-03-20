<?php
    include("utils/db.php");
    include('utils/auth.php');

    include('blocks/book.php');

    $addedBooksIds = getUserBooksIds($loggedInUserEmail);

    $newBooks = getBooksByCategory("new");

    $popularBooks = getBooksByCategory("popular");

    $businessBooks = getBooksByCategory("business");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>BL | Book Library | Interesting books for interesting you</title>
        <!-- <base href="http://www.bl.com"> -->
        <link  rel="stylesheet"  media="screen" type="text/css" href="css/styles.css">
        <link  rel="stylesheet"  media="screen" type="text/css" href="css/header.css">
        <link  rel="stylesheet"  media="screen" type="text/css" href="css/footer.css">
        <link rel="stylesheet" type="text/css" media="print" href="css/print.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <script src="https://kit.fontawesome.com/a076d05399.js"></script>
        <script src ="js/jquery-3.4.1.min.js"></script>
        <script src="js/scripts.js" defer></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/egg.js/1.0/egg.min.js"></script>
        <script>
            const egg = new Egg()
            egg
                .addCode("up,up,down,down", function() {
                    console.log('Easter egg is triggered, burning your computer in 3, 2, 1...')
                    jQuery('#egg').css('display', 'flex')
                    window.setTimeout(function() { jQuery('#egg').hide() }, 3000)
                })
                .listen()
        </script>
    </head>
    <body>
        <?php include('blocks/header.php') ?>
        

        <!--==== PAGE LAYOUT =====-->
        <!-- Home Page -->
        <main>
            <div class="bg-color">
                <div class="home-container">
                    <!-- TOP BLOCK -->
                    <div class="top-block-header no-print">
                        <div class="top-block-title-block">
                            <div class="top-block-picture">
                                <img class="book_top_block" src="images/books_top_block.png" alt="Books">
                            </div>
                            <div class="top-block-title">
                                <h1 class="slogan">Book Library - for people
                                    <br> who can read </h1>
                            </div>
                            <br>
                            <br>
                            <br>
                            <br>
                            <ul class="top-block-feature-list"> 
                                <li class="top-block-feture-item">
                                    <i class="fas fa-book"></i>
                                    <br>
                                    <span class="top-block-feature-text">
                                        <b>240 000</b>
                                        <br>
                                        books
                                    </span>
                                </li>
                                <li class="top-block-feture-item">
                                    <i class="fas fa-star"></i>
                                    <br>
                                    <span class="top-block-feature-text">
                                        <b>+500</b> new books
                                        <br>
                                        every month
                                    </span>
                                </li>
                                <li class="top-block-feture-item">
                                    <i class="fas fa-home"></i>
                                    <br>
                                    <span class="top-block-feature-text">
                                        <b>Personal</b>
                                        <br>
                                        account
                                    </span>
                                </li>
                            </ul>
                            <br>
                        </div>
                    </div>
                    <!-- END TOP BLOCK-->

                    <!-- MIDLE BLOCK -->
                    <div class="middle-block">
                        <!-- NEW BOOKS -->
                        <div class="section-books"> 
                            <div class="section-books-title">
                                <h2 class="block_headers">New books</h2>
                                <hr>
                            </div>
                            <div class="slider">
                                <div class="slider-content">
                                    <?php foreach ($newBooks as $book) { printBook($book, $addedBooksIds); } ?>
                                </div>
                            </div>
                        </div>
                        <!-- END NEW BOOKS-->

                        <!-- POPULAR BOOKS-->
                        <div class="section-books popular">
                            <div class="section-books-title">
                                <h2 class="block_headers">Popular books</h2>
                                <hr>
                            </div>
                            <div class="popular-books-content"> 
                                <?php foreach ($popularBooks as $book) { printBook($book, $addedBooksIds); } ?>
                            </div>
                        </div>
                        <!-- END POPULAR BOOKS -->
                        
                        <!-- Business books -->
                        <div class="section-books"> 
                            <div class="section-books-title">
                                <h2 class="block_headers">Business and self-development</h2>
                                <hr>
                            </div>
                            <div class="slider">
                                <div class="slider-content">
                                    <?php foreach ($businessBooks as $book) { printBook($book, $addedBooksIds); } ?>
                                </div>
                        </div>
                        <!-- End Business Books-->
                    </div>
                    <!-- END MIDLE BLOCK -->
                    
                    <!-- BOTTOM BLOCK -->

                    <?php if (!$isLoggedIn) { ?>
                        <div class="bottom-block">
                            <div class="bottom-block-title">
                                <h2 class="block_headers">Do you like it? Sign up!</h2>
                                <p class="bottom-block title1">And you will plunge into the world of books</p>
                            </div>
                            <div class="bottom-block-bttn">
                                <a class="bttn-sign-up" href="register.php"> Sign  up! </a>
                            </div>
                        </div>
                    <?php 
                        }
                    ?>
                    <!-- END BOTTOM BLOCK -->
                </div>
            </div>
        </main>
        
        <!-- FOOTER -->
        <?php include('blocks/footer.php') ?>
        <!-- END FOOTER -->
        <div id="egg">
            Zajimave?
        </div>
    </body>
</html>