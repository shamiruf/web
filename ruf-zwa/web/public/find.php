<?php
    include("utils/db.php");
    include('utils/auth.php');

    include('blocks/book.php');

    $addedBooksIds = getUserBooksIds($loggedInUserEmail);

    define('PAGE_SIZE', 5);

    if (isset($_GET['category']) && $_GET['category'] !== 'all') {
        $category = $_GET['category'];
        $books = getBooksByCategory($category);
    } else {
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
    // Get current page and slice $books from ($page-1)*PAGE_ZISE to $page*PAGE_SIZE
?>

<!DOCTYPE  html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>BL | Book Library | Find a book </title>
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
                <!-- PAGINATION -->
                <div class="pages">
                    Pages: 
                    <?php
                        // Show links for pages
                        for ($i = 1; $i <= $pages; $i++) { ?>
                            <a href="?category=<?php echo $category; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
                    <?php } ?>
                </div>
                <!-- END PAGINATION -->
                <div class="category">
                    <label for="categorySelector">Category:</label>
                    <select name="category" id="categorySelector">
                        <option value="all">All</option>
                        <option value="new">New</option>
                        <option value="popular">Popular</option>
                        <option value="business">Business</option>
                    </select>
                </div>
                <?php foreach ($books as $book) { printBook($book, $addedBooksIds, true); } ?>
                <!-- PAGINATION -->
                <div class="pages">
                    Pages: 
                    <?php
                        // Show links for pages
                        for ($i = 1; $i <= $pages; $i++) { ?>
                            <a href="?category=<?php echo $category; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
                    <?php } ?>
                </div>
            </div>
        </main>
        <!-- END MAIN -->
            
        <!-- FOOTER -->
        <?php include('blocks/footer.php') ?>
        <!-- END FOOTER -->
    </body>
</html>