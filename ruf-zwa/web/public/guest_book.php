<?php
    include('utils/db.php');
    include('utils/auth.php');
    include('utils/validation.php');

    $errorComment = false;

    $inputComment = false;

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && $isLoggedIn) {
        if (!isset($_POST['comment']) || !isNotEmpty($_POST['comment'])) {
            $errorComment= 'Comment can not be empty';
        } else {
            $inputComment = htmlspecialchars($_POST['comment'], ENT_QUOTES, 'UTF-8');
        }

        if (
            !$errorComment
        ) {      
            addComment($loggedInUserName, $inputComment);
            header('Location: guest_book.php');
        }
    }

    $comments = array_slice($GLOBALS['comments'], -10, 10, true);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>BL | Book Library | Sign Up </title>
        <!-- <base href="http://www.bl.com"> -->
        <link  rel="stylesheet" type="text/css" href=" css/form.css">
        <link  rel="stylesheet" type="text/css" href=" css/styles.css">
        <link  rel="stylesheet" type="text/css" href=" css/header.css">
        <link  rel="stylesheet" type="text/css" href=" css/footer.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <script src="https://kit.fontawesome.com/a076d05399.js"></script>
        <script src ="js/jquery-3.4.1.min.js"></script>
        <script src=" js/scripts.js" defer></script>
    </head>
    <body>
        <!-- HEADER -->
        <?php include('blocks/header.php') ?>
        <!-- END HEADER -->

        <!-- MAIN -->
        <main>
            <h1 class="reviews"> Last 10 reviews </h1>
            <?php foreach($comments as $comment) { ?>
            <div class="comment">
                <div class="comment-title">
                    <h4 class="comment-user"><?php echo $comment['name'] ?></h4>
                    <p><?php echo $comment['text'] ?></p>
                </div>
            </div>
            <?php } ?>
            <div class ="comment-block">
                <?php if ($isLoggedIn) { ?>
                    <form id = "form" class = "form" method="post">
                        <div class="form-control  <?php if ($errorComment) { echo "error"; } ?>">
                            <label for="comment">Please write something in guest book.</label>
                            <br>
                            <textarea rows="1" placeholder="Enter review" maxlength = "250" name="comment" id = "comment" required  pattern="[A-Za-z]{1,250}"  value="<?php if ($inputComment) { echo $inputComment; } ?>"></textarea>
                            <i class="fas fa-check-circle"></i>
                            <i class="fas fa-exclamation-circle"></i>
                            <small><?php if ($errorComment) { echo $errorComment; } ?></small>
                        </div>
                        <button type="submit" value="Post!">Send!</button>
                        <button type="reset" value="Reset!">Reset!</button>
                    </form>
                <?php } else { ?>
                    
                    Please <a class="guest-login" href="login.php"> LOG IN</a> to leave a comment.

                <?php } ?>
            </div>
            
        </main>
        <!-- END MAIN -->

        <!-- FOOTER -->
        <?php include('blocks/footer.php') ?>
        <!-- END FOOTER -->

    </body>
</html>