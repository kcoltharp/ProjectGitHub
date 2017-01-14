<?php
function __autoload($class_name) {
	require $class_name . '.php';
}
$dbhost = 'localhost';
$dbname = 'agenda';
$dbuser = 'kenny';
$dbpass = 'kc226975';
$dbprefix = 'myagenda_';

// FIXME, kick out constants and replace login-system.
define("DB_SERVER", $dbhost);
define("DB_USER", $dbuser);
define("DB_PASS", $dbpass);
define("DB_NAME", $dbname);
define("TBL_USERS", "" . $dbprefix . "users");
define("TBL_ACTIVE_USERS", "" . $dbprefix . "active_users");
define("TBL_ACTIVE_GUESTS", "" . $dbprefix . "active_guests");
define("TBL_BANNED_USERS", "" . $dbprefix . "banned_users");
define("ADMIN_NAME", "admin");
define("GUEST_NAME", "Guest");
define("ADMIN_LEVEL", 9);
define("USER_LEVEL", 1);
define("GUEST_LEVEL", 0);
define("TRACK_VISITORS", true);
define("USER_TIMEOUT", 10);
define("GUEST_TIMEOUT", 5);
define("COOKIE_EXPIRE", 60 * 60 * 24 * 100);
define("COOKIE_PATH", "/");
define("EMAIL_FROM_NAME", "John Doe");
define("EMAIL_FROM_ADDR", "john.doe@mail.com");
define("ALL_LOWERCASE", true);

/* ====================================================
 *            Agenda configuration options
 * ====================================================
 */
/**
 * Number of tasks in each box
 */
$numberOfTODO=20;
 
/**
 * Controls whether guests (non logged in users) can view your agenda. 
 * Guest can only view the agenda, they cannot edit or add events.
 */
$allowGuestAccess = false;
/**
 * Controls whether all users work on a single agenda.
 */
$singleAgenda = true;
/**
 * Controls whether reminders are enabled. 
 * When setting this to true, you should also add the engine/sendreminders.php and 
 * engine/senddailyreminders.php to you're cron tab. This is detailed in the install.txt.
 */
$enableReminders = false;

/**
 * Controls whether people can sign up to your agenda. If this is set to false, 
 * you can still register new users in the admin center.
 */
$allowSignUp = false;

/**
 * Controls whether you can specify a target for an event. This is useful in a shared agenda environment.
 */
$enableEventTargetting = true;

/**
 * Allows you to categorize tasks in projects. Projects keep track of how many tasks are assigned to them and how many are completed.
 * Projects for a hiearchy, so that any project may have as any number of subprojects.
 */
$enableProjectTracking = true;
/*
 * =====================================
 * NO NEED TO CHANGE ANYTHING BELOW HERE 
 * =====================================
 */

/*
 * Some shortcut function declarations
 */
function h($str) {
	return html_entity_decode($str, ENT_COMPAT, "UTF-8");
}
/* 
 * Checks whether a string could be an URL
 */
function isURL($url) {
	return preg_match('/^(http|https|ftp):\/\/[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,6}((:[0-9]{1,5})?\/.*)?$/i', $url);
}
?>