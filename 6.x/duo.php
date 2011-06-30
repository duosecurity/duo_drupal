<?php

/**
 *
 *  @file
 *    Helper functions for the Duo module.  Includes the Duo API
 *    to reduce the number of files.
 */

  require_once('duo_web.php');

/**
 *  Helper function to check if somebody is logged in already
 *
 *  Checks to see if a user is logged in, if they are, it'll redirect them and set an error message
 *
 *  @return void
 */
  function _check_login() {
    if (user_is_logged_in()) {
      drupal_set_message( t('You are already logged in.'), 'error');
      drupal_goto();
    }
  }

/**
 *  Generates a random alpha numeric string.
 */
  function generate_random_string() {
    return bin2hex(generate_random_bytes(20));    
  }
  
/**
 *  Tries to read from /dev/urandom to create a random number of bytes.  Falls back on hashing microtime.
 */
  function generate_random_bytes($count) {
    $output = '';
    if (is_readable('/dev/urandom') && ($fh = @fopen('/dev/urandom', 'rb'))) {
      $output = fread($fh, $count);
      fclose($fh);
    }

    $random_state = microtime();

    if (strlen($output) < $count) {
      $output = '';
      for ($i = 0; $i < $count; $i += 16) {
        $random_state = md5(microtime() . $random_state);
        $output .= pack('H*', md5($random_state));
      }
      $output = substr($output, 0, $count);
    } 
    return $output;
  }


/**
 *  HTML Generation Functions
 *
 *  The following functions will all generate an HTML page to be displayed before loggin the user in.
 *
 *  @see _duo_generate_page()
 *  @see _duo_generate_help()
 */


/**
 *  Generate Duo Login page header.
 *
 *  @return HTML for the Duo page header.
 */
  function  _duo_generate_page($sig_req, $apihostname) {
    ob_start();

    include('resources/duo_header.php');

    echo "\n\t<script src=\"" . base_path() . drupal_get_path('module', 'duo') . "/duo.js\" ></script>";
    echo "\n\t<script>Duo.init({'host':'" . $apihostname . "','post_action':'" . 
    url("duo_login_process", array("absolute" => TRUE)) . "','sig_request':'" . $sig_req . "'});";
    echo "\t</script>\n";

    echo "\t<div id=\"centered\">\n\t\t";
    echo '<iframe id="duo_iframe" width="100%" height="500" frameborder="0"></iframe>';
    echo "\n\t</div>";

    include('resources/duo_footer.php');

    $doc = ob_get_clean();
    @ob_end_clean();
    return $doc;
  }

/**
 *  Generates Help Text.
 *
 *  This is just to remove all HTML from the module itself.
 *
 *  @return Help HTML
 */
  function _duo_generate_help() {
    $help = '<h1>' . t("Duo Two-Factor Authentication") . '</h1>';

  $help .= "<p>" . t("For more complete documentation, view Duo's") . ' <a href="http://duosecurity.com/docs/drupal">' . t('documentation on the module') . "</a>.</p>";
  
  $help .= "<p>" . t("If you need additional help, contact") . ' <a href="mailto:support@duosecurity.com">support@duosecurity.com</a>.</p>';

    $help .= '<h2>' . t("About") . '</h2>';
    $help .= '<p>' . t("This module adds a second step to Drupal's existing login function by implementing") . " Duo's " . 
  t("two-factor authentication API.") . '</p>';

    $help .= '<p>' . t("Duo's two-factor authentication requires a user to use their phone to log in, in addition to their username and password.  
  After entering a valid username and password, the user will be asked to enroll with Duo. After they register their phones with Duo, 
  they will be asked to authenticate with their phones before being signed in. On following attempts to log in, they won't need to enroll again, 
  they'll only be asked to authenticate.") .  '</p>';


    $help .= '<h2>' . t("Setting up") . '</h2>';

    $help .= '<p>' . t("To set up this module, you need to sign up with an account at") 
  . ' <a href="http://www.duosecurity.com" target="_blank">http://www.duosecurity.com</a>.</p>';

    $help .= '<p>' . t("After signing up with Duo, you will need to create an integration. ") . t("Duo offers a") . ' <a href="http://duosecurity.com/docs">' . 
  t("getting started guide") . "</a> " . t("that explains how to set up an integration.") .'</p>';

    $help .= '<p>' . t("Upon creating an integration, you will be provided with an integration key, and secret key, as well as an API hostname. 
  You'll need this information to configure the module.  Copy and paste the values from the integration to the module configuration page.") . '</p>';
  
    $help .= '<p>' . t("If this plugin is left unconfigured, users will continue to login as usual, without two-factor authentication.") . '</p>';

  
    $help .= '<h2>' . t("Customization") . '</h2>';

    $help .= '<p>' . t("You can customize the look of the login page by editing the files") . " duo_header.php, duo_footer.php " . t("and") . " custom.css " . t("in the module's") .
  " resources " . t("folder. The login form is rendered in between the two files.");


    return $help;
  }
