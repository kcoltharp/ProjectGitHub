<?php include 'core/init.php';
 protect_page();

if(empty($_POST) === false)
{
    sanitize($_POST['current_password']);
    sanitize($_POST['password']);
    sanitize($_POST['password_again']);
    $required_fields = array('current_password', 'password', 'password_again');
//    $contents = '!@#%^&*?';
//    $contents2 = '1234567890';
    foreach ($_POST as $key=>$value )
    {
        if(empty($value) && in_array ($key, $required_fields) === true)
        {
            $errors[] = 'Fields marked with an asterisk are required!';
            break 1;
        }

        if(empty($errors) === true)
        {
            if(md5($_POST['current_password']) !== $user_data['password'] )
            {
                $errors[] = 'Your current password is incorrect!';
            }
            else
            {
                if(  preg_match ("/\\s/", $_POST['password'] ) == true)
                {
                    $errors[] = 'Sorry, the password must not contain any spaces!';
                }
                if(strlen ($_POST['password']) < 8 && strlen ($_POST['password']) < 33)
                {
                    $errors[] = 'Your password length must be between 8 and 32 characters long!';
                }
                if($_POST['password'] !== $_POST['password_again'])
                {
                    $errors[] = 'Your passwords do not match!';
                }
            }
            //if(stripos($contents, $_POST['password']) === false || stripos($contents2, $_POST['password']) === false)
            //{
              //  $errors[] = "Your password must contain at least one of these characters: !, @, #, %, ^, &, *, ? and one number!";
            //}
        }
    }
}
include 'includes/overall/header.php';
?>
<h1>Change Password</h1>
<?php
if(isset($_GET['success']))
{
    echo 'You have changed your password successfully!';
}
else
{
    if(empty($_POST) === false && empty($errors) === true)
    {
        change_password($_SESSION['user_id'], $_POST['password']);
        header('Location: changepassword.php?success');
        exit();
    }
    elseif (empty($errors) === false)
    {
        echo output_errors($errors);
    }
         ?>

    <form action="" method="post">
        <ul>
            <li>
                Current Password*:<br />
                <input type="password" name="current_password">
            </li>
            <li>
                New Password*:<br />
                <input type="password" name="password">
            </li>
            <li>
                New Password Again*:<br />
                <input type="password" name="password_again">
            </li>
            <li>
                <input type="submit" value="Change Password">
            </li>
        </ul>
    </form>
<?php
}
 include 'includes/overall/footer.php';
 ?>