<?php
include 'core/init.php';
protect_page();
include 'includes/overall/header.php';

if(empty($_POST) === false)
{
    $required_fields = array('first_name', 'last_name', 'address', 'city', 'state', 'zip', 'home_phone', 'email');

    foreach ($_POST as $key=>$value)
    {
        if(empty($value) && in_array($key, $required_fields) === true)
        {
            $errors[] = 'Fields marked with an asterisk are required!';
            break 1;
        }
        else
        {
            sanitize($value);
        }
    }

    if(empty($errors) === true)
    {
        if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false)
        {
            $errors[] = 'A valid email address is required!';
        }
        else if(email_exists($_POST['email']) === true && $user_data['email'] !== $_POST['email'])
        {
            $errors[] = 'Sorry, the email address \'' . $_POST['email'] . '\' is already in use!';
        }

    }
}

?>
<h1>Update Settings</h1>

<?php
if(isset($_GET['success']))
{
    echo 'Your profile has been successfully updated!';
}
else
{
    if(empty($_POST) === false && empty($errors) === true)
    {
        $updated_data = array(
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
            );
        update_user($updated_data);
        header('Location: settings.php?success');
        exit();
    }
    else if(empty ($errors) === false)
    {
        output_errors($errors);
    }

        ?>

<font size="3">
    <form action="" method="post">
        <font size="2"><h4>The&nbsp;<b><font size="5" color="#ff0000">*</font></b>&nbsp;indicates a required field!</h4></font>
        <ul>
            <li>
                <b>First Name&nbsp;<font size="5" color="#ff0000">*</font>&nbsp;:</b>
                <input type="text" name="first_name" maxlength="32" value="<?php echo $user_data[ 'first_name' ]; ?>">
            </li>
            <li>
                <b>Last Name&nbsp;<font size="5" color="#ff0000">*</font>&nbsp;:</b>
                <input type="text" name="last_name" maxlength="32" value="<?php echo $user_data[ 'last_name' ]; ?>">
            </li>
            <li>
                <b>Address&nbsp;<font size="5" color="#ff0000">*</font>&nbsp;:</b>
                <input type="text" name="address" maxlength="32" value="<?php echo $user_data[ 'address' ]; ?>">
            </li>
            <li>
                <b>Address2:</b>
                <input type="text" name="address2" maxlength="32" value="<?php echo $user_data[ 'address2' ]; ?>">
            </li>
            <li>
                <b>City&nbsp;<font size="5" color="#ff0000">*</font>&nbsp;:</b>
                <input type="text" name="city" maxlength="32" value="<?php echo $user_data[ 'city' ]; ?>">
            </li>
            <li>
                <b>State&nbsp;<font size="5" color="#ff0000">*</font>&nbsp;:</b>
                <select name="state">
                    <option selected="selected" value="<?php echo $user_data[ 'state' ]; ?>"><?php echo $user_data[ 'state' ]; ?></option>
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
                <b>Zip Code&nbsp;<font size="5" color="#ff0000">*</font>&nbsp;:</b>
                <input type="text" name="zip" maxlength="10" value="<?php echo $user_data[ 'zip' ]; ?>">
            </li>
            <li>
                <b>Home Phone&nbsp;<font size="5" color="#ff0000">*</font>&nbsp;:</b>
                <input type="text" name="home_phone" maxlength="13" value="<?php echo $user_data[ 'home_phone' ]; ?>">
            </li>
            <li>
                <b>Cell Phone:</b>
                <input type="text" name="cell_phone" maxlength="13" value="<?php echo $user_data[ 'cell_phone' ]; ?>">
            </li>
            <li>
                <b>Email&nbsp;<font size="5" color="#ff0000">*</font>&nbsp;:</b>
                <input type="email" name="email" maxlength="32" value="<?php echo $user_data[ 'email' ]; ?>">
            </li>
            <li>
                <input type="submit" value="Update">
            </li>
        </ul>
    </form>
</font>


    <?php
}
include 'includes/overall/footer.php';
?>