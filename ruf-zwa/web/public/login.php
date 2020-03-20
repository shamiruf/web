<?php
    include('utils/db.php');
    include('utils/auth.php');
    include('utils/validation.php');

    if($isLoggedIn) {
        header('Location: index.php');
    }

    $errorEmail = false;
    $errorPassword = false;

    $isLoginAttempted = false;

    $inputEmail = false;

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (!isset($_POST['email']) || strlen($_POST['email']) == 0) {
            $errorEmail = 'Email is required';
        } else {
            $inputEmail = $_POST['email'];
            if (!isEmail($inputEmail)) {
                $errorEmail = "Invalid email format";
            }
        }

        if (!isset($_POST['password']) || strlen($_POST['password']) == 0) {
            $errorPassword = 'Password is required';
        }

        if (!$errorEmail && !$errorPassword) {
            $isLoginAttempted = true;
            foreach ($GLOBALS['users'] as $user) {
                if (
                    $user['email'] == $_POST['email'] &&
                    $user['password'] == hashPassword($_POST['password'])
                ) {
                    logInUser($user['email'], $user['name']);
                }
            }
            header('Location: index.php');
            
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>BL | Book Library | Sign Up </title>
        <!-- <base href="http://www.bl.com"> -->
        <link  rel="stylesheet" type="text/css" href="css/form.css">
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
            <div class="block-form">
                <div class = "container signup">
                    <h2 class ="block_headers">Sign In!</h2>
                    <p class="title1">Please fill in this form to sign in to your account.</p>
                    <hr>
                    <form id="form-login" class="form" method="post">
                        <div class="form-control <?php if ($errorEmail || $isLoginAttempted) { echo "error"; } ?>">
                            <label for="email">Email</label>
                            <input type="text" placeholder="Enter Email" name="email" id = "email" required  pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2, 4}$" value="<?php if ($inputEmail) { echo $inputEmail; } ?>">
                            <i class="fas fa-check-circle"></i>
                            <i class="fas fa-exclamation-circle"></i>
                            <small><?php if ($errorEmail) { echo $errorEmail; } ?></small>
                            <small><?php if ($isLoginAttempted) { echo 'User was not found'; } ?></small>
                        </div>
                        <div class="form-control <?php if ($errorPassword) { echo "error"; } ?>">
                            <label for="password">Password</label>
                            <input type="password" placeholder="Enter Password" name="password" id = "password" required pattern=".{1,}">
                            <i class="fas fa-check-circle"></i>
                            <i class="fas fa-exclamation-circle"></i>
                            <small><?php if ($errorPassword) { echo $errorPassword; } ?></small>
                        </div>

                        <button class="bttn-sign-up"  type="submit" value="SIGN UP!">SIGN IN!</button>
                        <button class="bttn-sign-up"  type="reset" value="Reset!">Reset!</button>
                    </form>
                </div>
                <div class="container signin">
                    <p>I don't have an account. <a href="register.php"><b>Sign up</b></a>.</p>
                </div>
            </div>

        </main>
        <!-- END MAIN -->

        <!-- FOOTER -->
        <?php include('blocks/footer.php') ?>
        <!-- END FOOTER -->
    </body>
</html>