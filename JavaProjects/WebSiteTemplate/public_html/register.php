<?php
include 'core/init.php';
logged_in_redirect();
include 'includes/overall/header.php';

if(empty($_POST) === false)
{
    $required_fields = array('username', 'password', 'password_again', 'first_name', 'last_name', 'address', 'city', 'state', 'zip', 'email');
    $contents = array("!", "@", "#", "%", "^", "&", "*", "?");
    $contents2 = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0", 1, 2, 3, 4, 5, 6, 7, 8, 9, 0);
    foreach ( $_POST as $key=>$value )
    {
        if(empty($value) && in_array($key, $required_fields) === true)
        {
            $errors[] = 'Fields marked with an asterisk are required!';
            break 1;
        }

        if(empty($errors) === true)
        {
            if(user_exists ( $_POST['username']) === true)
            {
                $errors[] = 'Sorry, the username \'' . $_POST['username'] . '\' is already taken!';
            }
            if(  preg_match ("/\\s/", $_POST['username'] ) == true)
            {
                $errors[] = 'Sorry, the username must not contain any spaces!';
            }
            if(  preg_match ("/\\s/", $_POST['password'] ) == true)
            {
                $errors[] = 'Sorry, the password must not contain any spaces!';
            }
            if(strlen ($_POST['password']) < 8 && strlen ($_POST['password']) >= 32)
            {
                $errors[] = 'Your password must be at least 8 characters long, but not longer than 32 characters!';
            }
            if($_POST['password'] !== $_POST['password_again'])
            {
                $errors[] = 'Your passwords do not match!';
            }
            if(in_array($_POST['password'], $contents) !== TRUE && in_array($_POST['password'], $contents2) !== TRUE)
            {
                $errors[] = "Your password must contain at least one of these characters: !, @, #, %, ^, &, *, ? and one number!";
            }
            if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false)
            {
                $errors[] = 'A valid email address is required!';
            }
            if(email_exists($_POST['email']) === true)
            {
                $errors[] = 'Sorry, the email address \'' . $_POST['email'] . '\' is already in use!';
            }
        }
    }
}
?>
<h1>Registration Form</h1>
<?php
if(isset($_GET['success']))
{
    echo 'You\'ve been registered successfully! Please check your email to activate your account!';
}
else
{
    if(empty($_POST) === false && empty($errors) === true)
    {
        //unset($_POST['password_again']);
        //$register_data = $_POST;
        //unset($register_data['password_again']);
        //$register_data['email_code'] = md5 ($_POST['username'] + microtime ());

        $register_data = array(
            'username' => $_POST['username'],
            'password' => md5($_POST['password']),
            'first_name' => $_POST['first_name'],
            'last_name' => $_POST['last_name'],
            'address' => $_POST['address'],
            'address2' => $_POST['address2'],
            'city' => $_POST['city'],
            'state' => $_POST['state'],
            'zip' => $_POST['zip'],
            'home_phone' => $_POST['home_phone'],
            'cell_phone' => $_POST['cell_phone'],
            'email' => $_POST['email'],
            'email_code' => md5($_POST['username'] + microtime())
            );

        register_user($register_data);
        header('Location: register.php?success');
        exit;
    }
    elseif(empty($errors) === false)
    {
        echo output_errors($errors);
    }
    ?>
    <form action="" method="post">
        <ul>
            <li>
                User Name*:<br />
                <input type="text" name="username" maxlength="32">
            </li>
            <li>
                Password*:<br />
                <input type ="password" name="password" maxlength="32">
            </li>
            <li>
                Password Again*:<br />
                <input type ="password" name="password_again" maxlength="32">
            </li>
            <li>
                First Name*:<br />
                <input type="text" name="first_name" maxlength="32">
            </li>
            <li>
                Last Name*:<br />
                <input type="text" name="last_name" maxlength="32">
            </li>
            <li>
                Address*:<br />
                <input type="text" name="address" maxlength="32">
            </li>
            <li>
                Address2:<br />
                <input type="text" name="address2" maxlength="32">
            </li>
            <li>
                City*:<br />
                <input type="text" name="city" maxlength="32">
            </li>
            <li>
                State*:
                <select name="state">
                    <option value="">Select State</option>
                    <option value="AL">AL</option>
                    <option value="AK">AK</option>
                    <option value="AZ">AZ</option>
                    <option value="AR">AR</option>
                    <option value="CA">CA</option>
                    <option value="CO">CO</option>
                    <option value="CT">CT</option>
                    <option value="DE">DE</option>
                    <option value="FL">FL</option>
                    <option value="GA">GA</option>
                    <option value="HI">HI</option>
                    <option value="ID">ID</option>
                    <option value="IL">IL</option>
                    <option value="IN">IN</option>
                    <option value="IA">IA</option>
                    <option value="KS">KS</option>
                    <option value="KY">KY</option>
                    <option value="LA">LA</option>
                    <option value="ME">ME</option>
                    <option value="MD">MD</option>
                    <option value="MA">MA</option>
                    <option value="MI">MI</option>
                    <option value="MN">MN</option>
                    <option value="MS">MS</option>
                    <option value="MO">MO</option>
                    <option value="MT">MT</option>
                    <option value="NE">NE</option>
                    <option value="NV">NV</option>
                    <option value="NH">NH</option>
                    <option value="NJ">NJ</option>
                    <option value="NM">NM</option>
                    <option value="NY">NY</option>
                    <option value="NC">NC</option>
                    <option value="ND">ND</option>
                    <option value="OH">OH</option>
                    <option value="OK">OK</option>
                    <option value="OR">OR</option>
                    <option value="PA">PA</option>
                    <option value="RI">RI</option>
                    <option value="SC">SC</option>
                    <option value="SD">SD</option>
                    <option value="TN">TN</option>
                    <option value="TX">TX</option>
                    <option value="UT">UT</option>
                    <option value="VT">VT</option>
                    <option value="VA">VA</option>
                    <option value="WA">WA</option>
                    <option value="WV">WV</option>
                    <option value="WI">WI</option>
                    <option value="WY">WY</option>
                    <option value="AS">AS</option>
                    <option value="DC">DC</option>
                    <option value="GU">GU</option>
                    <option value="PR">PR</option>
                </select>
            </li>
            <li>
                Zip Code*:<br />
                <input type="text" name="zip" maxlength="10">
            </li>
            <li>
                Home Phone:<br />
                <input type="text" name="home_phone" maxlength="13" value="(xxx)xxx-xxxx">
            </li>
            <li>
                Cell Phone:<br />
                <input type="text" name="cell_phone" maxlength="13" value="(xxx)xxx-xxxx">
            <li>
                Email*:<br />
                <input type="email" name="email" maxlength="32">
            </li>
            <li>
                <input type="submit" value="Register">
            </li>
        </ul>

    </form>
    <?php
}
include 'includes/overall/footer.php';
?>