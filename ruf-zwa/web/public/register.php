<?php
    include('utils/db.php');
    include('utils/auth.php');
    include('utils/validation.php');

    if($isLoggedIn) {
        header('Location: index.php');
    }
    $errorName = false;
    $errorGenre = false;
    $errorEmail = false;
    $errorPassword = false;
    $errorPasswordConfirmation = false;

    $inputName = false;
    $inputGenre = false;
    $inputEmail = false;

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (!isset($_POST['name']) || !isNotEmpty($_POST['name'])) {
            $errorName = 'Name is required';
        } else {
            $inputName = $_POST['name'];
            if (!isLettersAndSpaced($inputName)) {
                $errorName = "Only letters and white space allowed";
            }
        }

        if (!isset($_POST['genre']) || !isNotEmpty($_POST['genre'])) {
            $errorGenre = 'Genre is required';
        } else {
            $inputGenre = $_POST['genre'];
        }

        if (!isset($_POST['email']) || !isNotEmpty($_POST['email'])) {
            $errorEmail = 'Email is required';
        } else {
            $inputEmail = $_POST['email'];
            if (checkDublicateEmail($inputEmail)){
                $errorEmail = "Email is already exist";
            }
            if (!isEmail($inputEmail)) {
                $errorEmail = "Invalid email format";
            }
        }

        if (!isset($_POST['password']) || !isNotEmpty($_POST['password'])) {
            $errorPassword = 'Password is required';
        }

        if (!isset($_POST['passwordConfirmation']) || !isNotEmpty($_POST['passwordConfirmation'])) {
            $errorPasswordConfirmation = 'Password Confirmation is required';
        } else if ($_POST['password'] != $_POST['passwordConfirmation']) {
            $errorPassword = 'Password and Password Confirmation not match';
            $errorPasswordConfirmation = 'Password and Password Confirmation not match';
        }

        if (
            !$errorName && 
            !$errorGenre && 
            !$errorEmail && 
            !$errorPassword &&
            !$errorPasswordConfirmation
        ) {      
            insertUser(array(
                'name' => $_POST['name'],
                'genre' => $_POST['genre'],
                'email' => $_POST['email'],
                'password' => hashPassword($_POST['password'])
            ));
            header('Location: login.php');
        }
    }
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
            <div class="block-form">
                <div class = "container signup">
                    <h2 class ="block_headers">Sign Up!</h2>
                    <p class="title1">Please fill in this form to create an account.</p>
                    <hr>
                    <form id = "form" class = "form" method="post">
                        <div class="form-control <?php if ($errorName) { echo "error"; } ?>">
                            <label for="name">Name *</label>
                            <input type="text" placeholder="Enter name" name="name" id ="name" required pattern="[A-Za-z]{1,32}" value="<?php if ($inputName) { echo $inputName; } ?>">
                            <i class="fas fa-check-circle"></i>
                            <i class="fas fa-exclamation-circle"></i>
                            <small><?php if ($errorName) { echo $errorName; } ?></small>
                        </div>
                        <div class="form-control <?php if ($errorGenre) { echo "error"; } ?>">
                            <label for="genre">Genre *</label>
                            <input type="text" placeholder="Select your favorite genre" name="genre" id = "genre" required list="genre_list" value="<?php if ($inputGenre) { echo $inputGenre; } ?>">
                            <datalist id="genre_list">
                                <option label="Action and Adventure" value="Action and Adventure">
                                <option label="Business" value="Business">
                                <option label="Classics" value="Classics">
                                <option label="Detective" value="Detective">
                                <option label="Fantasy" value="Fantasy">
                                <option label="Horror" value="Horror">
                                <option label="Romance" value="Romance">
                                <option label="Short Stories" value="Short Stories">
                            </datalist>
                            <i class="fas fa-check-circle"></i>
                            <i class="fas fa-exclamation-circle"></i>
                            <small><?php if ($errorGenre) { echo $errorGenre; } ?></small>
                        </div>
                        <div class="form-control <?php if ($errorEmail) { echo "error"; } ?>">
                            <label for="email">Email *</label>
                            <input type="text" placeholder="Enter Email" name="email" id = "email" required  pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"  value="<?php if ($inputEmail) { echo $inputEmail; } ?>">
                            <i class="fas fa-check-circle"></i>
                            <i class="fas fa-exclamation-circle"></i>
                            <small><?php if ($errorEmail) { echo $errorEmail; } ?></small>
                        </div>
                        <div class="form-control <?php if ($errorPassword) { echo "error"; } ?>">
                            <label for="password">Password *</label>
                            <input type="password" placeholder="Enter Password" name="password" id = "password" required pattern=".{1,}">
                            <i class="fas fa-check-circle"></i>
                            <i class="fas fa-exclamation-circle"></i>
                            <small><?php if ($errorPassword) { echo $errorPassword; } ?></small>
                        </div>
                        <div class="form-control <?php if ($errorPasswordConfirmation) { echo "error"; } ?>">
                            <label for="passwordConfirmation">Repeat Password *</label>
                            <input type="password" placeholder="Repeat Password" name="passwordConfirmation" id = "passwordConfirmation" required pattern=".{1,}">
                            <i class="fas fa-check-circle"></i>
                            <i class="fas fa-exclamation-circle"></i>
                            <small><?php if ($errorPasswordConfirmation) { echo $errorPasswordConfirmation; } ?></small>
                        </div>
                        <p> * - required field.</p>
                        <br>
                        <button class="bttn-sign-up"  type="submit" value="SIGN UP!">SIGN UP!</button>
                        <button class="bttn-sign-up"  type="reset" value="Reset!">Reset!</button>
                    </form>
                </div>
                <div class="container signin">
                    <p>Already have an account? <a href="login.php "><b>Sign in</b></a>.</p>
                </div>
            </div>

        </main>
        <!-- END MAIN -->

        <!-- FOOTER -->
        <?php include('blocks/footer.php') ?>
        <!-- END FOOTER -->

    </body>
</html>