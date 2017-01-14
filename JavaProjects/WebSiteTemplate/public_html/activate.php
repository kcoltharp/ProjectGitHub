<?php
include 'core/init.php';
logged_in_redirect();
include 'includes/overall/header.php';

if(isset($_GET['success'])=== true)
{
    echo "<h2>Thanks, we\'ve activated your account!</h2>";
    echo "<p>You are now able to log into your account!!</p>";
}
else if(isset($_GET['email'], $_GET['email_code']) === true)
{
    $email = trim($_GET['email']);
    $email_code = trim($_GET['email_code']);

    if(email_exists ( $email ) === false)
    {
        $errors[] = 'Ooops something went wrong, we couldn\'t find that email address!';
    }
    elseif (activate($email, $email_code) === false)
    {
        $errors[] = 'We had problems activating your account!';
    }
}
else
{
    header('Location: index.php');
    exit();
}




include 'includes/overall/footer.php';
?>