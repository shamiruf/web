<?php
    include('utils/db.php');
    include('utils/auth.php');

    include('blocks/book.php');
    
    $addedBooksIds = getUserBooksIds($loggedInUserEmail);
    if(!$isLoggedIn) {
        header('Location: login.php');
    }

    $books = getBooksByUser($loggedInUserEmail);

    define('PAGE_SIZE', 5);

    if (isset($_GET['category']) && $_GET['category'] == 'all') {
        $category = 'all';
        $books = $GLOBALS['books'];
    } 


    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 1;
    }

    $pages = ceil(count($books) / PAGE_SIZE);

    $books = array_slice($books, ($page-1)*PAGE_SIZE, PAGE_SIZE);

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>BL | Book Library | My books </title>
        <!-- <base href="http://www.bl.com"> -->
        <link  rel="stylesheet" type="text/css" href=" css/styles.css">
        <link  rel="stylesheet" type="text/css" href=" css/header.css">
        <link  rel="stylesheet" type="text/css" href=" css/footer.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <script src="https://kit.fontawesome.com/a076d05399.js"></script>
        <script src ="js/jquery-3.4.1.min.js"></script>
        <script src="js/scripts.js" defer></script>
    </head>
    <body>
        <!-- HEADER -->
        <?php include('blocks/header.php') ?>
        <!-- END HEADER -->

        <!-- MAIN -->
        <main>
        <?php if (empty($books)) : ?>
            <h1 class= no_books>You have no books.</h1>
        <?php endif; ?>
            <div class="column">
            <?php foreach ($books as $book) { printBook($book, $addedBooksIds, true ,true); } ?>
            </div>
            <div class="pages"> 
            <?php if(count($books) !== 0) : ?>

                Pages: 
                <?php
                    // Show links for pages
                    for ($i = 1; $i <= $pages; $i++) { ?>
                        <a href="?category=<?php echo $category; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
                <?php } ?>
            <?php endif; ?>
            </div>
        </main>
        <!-- END MAIN -->

        <!-- FOOTER -->
        <?php include('blocks/footer.php') ?>
        <!-- END FOOTER -->
        
    </body>
</html>