<?php

    /**
     * @var array $userBooksIds contains books ids which has user
     * @var int $booksCount count of books user
     */

    $userBooksIds = getBooksByUser($loggedInUserEmail);
    $booksCount = count($userBooksIds);
?>

<!-- HEADER -->
<header class="header">
            <div class="menu-container">
                <!-- NAV -->
                <nav class="navbar">
                    <!-- LOGO -->
                    <div class="navbar-img-logo-reference">
                        <img class="logo" src="images/freeLogo.jpeg" alt="Big Library"> 
                    </div>
                    <!-- MENU -->
                    <ul class="menu">

                        <!-- Home -->
                        <li>
                            <a href="index.php">
                                Home
                            </a>
                        </li>
                        <!-- End Home -->

                        <!-- Find -->
                        <li>
                            <a href="find.php">
                                Find a book
                            </a>
                        </li>
                        <!-- End Find -->

                        <!--Guest Book -->
                        <li>
                            <a href="guest_book.php">
                                Guest book
                            </a>
                        </li>
                        <!-- End Guest Book -->
                        
                        <!--My Books -->
                        <li>
                            <?php if ($isLoggedIn) { ?>
                                <a href="my_books.php">
                                    My Books (<span id="myBooksCount"><?php echo $booksCount; ?></span>)
                                </a>
                            <?php 
                                } 
                            ?>
                        </li>
                        <!-- End My Books -->
                        
                    </ul>
                </nav>
                <!-- End Navbar1 -->

                <!-- Navbar2 Register Login -->
                <nav id="login-bttn" class="navbar2">
                    <?php if (!$isLoggedIn) { ?>
                        <a class="register" href="register.php" title="Register">Sign up</a>
                        <a class="login" href="login.php" title="Login">Sign in</a>                    
                    <?php 
                        } else { ?>
                        Hello, <?php echo $loggedInUserName; ?>!
                        <a class="logout" href="logout.php" title="Logout">Sign out</a> 
                    <?php 
                        }
                    ?>
                </nav>
                <!-- END Navbar2 Register Login -->
            </div>
        </header>
        <!-- END HEADER -->