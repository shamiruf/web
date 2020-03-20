<?php
    include("utils/db.php");
    include('utils/auth.php');
    
    include('blocks/book.php');


    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        if (!isset($_GET['id'])) {
            echo "No id was provided";
            exit(0);
        }

        $book = getBookById($_GET['id']);
    }

    $addedBooksIds = getUserBooksIds($loggedInUserEmail);
?>

<!DOCTYPE  php>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>BL | Book Library | New </title>
        <!-- <base href="http://www.bl.com"> -->
        <link  rel="stylesheet" type="text/css" href="css/styles.css">
        <link  rel="stylesheet" type="text/css" href="css/header.css">
        <link  rel="stylesheet" type="text/css" href="css/footer.css">
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
            <div class="column"> 
                <?php printBook($book, $addedBooksIds, true); ?>
                
            </div>
            
        </main>
        <!-- END MAIN -->
            
        <!-- FOOTER -->
        <?php include('blocks/footer.php') ?>
        <!-- END FOOTER -->
    </body>
</html>