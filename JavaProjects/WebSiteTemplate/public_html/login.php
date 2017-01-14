<?php
include 'core/init.php';
logged_in_redirect();

if(empty($_POST) === false)
{
    $username = sanitize($_POST['username']);
    $password = sanitize($_POST['password']);
    if((empty($username) === true)|| (empty($password) === true))
    {
        $errors[] = 'You need to enter a username and password';
    }
    elseif (user_exists($username) === false)
    {
        $errors[] = 'We can\'t find that username. Have you registered?';
    }
    elseif (user_active($username) === false)
    {
        $errors[] = 'You haven\'t activated your account!';
    }
    else
    {
        if (strlen ( $password ) < 8 || strlen ( $password ) > 32)
        {
            $errors[] = 'Your password should be between 8 and 32 characters long!';
        }

        $login = login($username, $password);
        if($login === false)
        {
            $errors[] = 'That username and password combination is incorrect.';
        }
        else
        {
            $_SESSION['user_id'] = $login;
            header('Location: index.php');
            exit;
        }
    }
}
else
{
    $errors[] = 'No data recieved';
}
include 'includes/overall/header.php';

if(empty($errors) === false)
{
    ?>
    <h2>We tried to log you in, but...</h2>
    <?php
    echo output_errors($errors);
}

include 'includes/overall/footer.php';
?>

?>