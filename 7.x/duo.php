<?php

/**
 * @file
 * Helper functions for the Duo module.
 *
 * Includes the Duo API to reduce the number of files.
 */

  require_once 'duo_web.php';

/**
 * Generates a random alpha numeric string.
 */
function generate_random_string() {
  return bin2hex(generate_random_bytes(20));
}

/**
 * Generates random bytes.
 *
 * Tries to read from /dev/urandom to create a random number of bytes. Falls
 * back on hashing microtime.
 */
function generate_random_bytes($count) {
  $output = '';
  if (is_readable('/dev/urandom') && ($fh = @fopen('/dev/urandom', 'rb'))) {
    $output = fread($fh, $count);
    fclose($fh);
  }

  /**
   * If we cannot read from urandom this will be our only source of
   * "randomness." By no means is this cryptographically secure. However, we
   * consider it safe for use here because it is a one time only event (on AKEY
   * generation). An attacker cannot choose events which cause AKEY re-
   * generation, and we consider it sufficiently hard to guess or predict
   * the micro time of installation.
   */
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
 * HTML Generation Functions.
 *
 * The following functions will all generate an HTML page to be displayed
 * before logging the user in.
 *
 * @see _duo_generate_page()
 * @see _duo_generate_help()
 */


/**
 * Generate Duo Login page header.
 */
function _duo_generate_page($sig_req, $api_hostname, $reset = FALSE) {
  ob_start();

  include 'resources/duo_header.php';

  $duojs_path = base_path() . drupal_get_path('module', 'duo') . '/' . 'duo.js';
  $adaptive_path = base_path() . drupal_get_path('module', 'duo') . '/' . 'adaptive.css';
  $post_action = url("duo_login_process", array("absolute" => TRUE));
  $iframe_attributes = array(
    'id' => 'duo_iframe',
    'data-host' => $api_hostname,
    'data-sig-request' => $sig_req,
    'data-post-action' => $post_action,
    'frameborder' => '0',
  );
  $iframe_attributes = array_map(function($key, $value) {
    return sprintf('%s="%s"', $key, $value);
  }, array_keys($iframe_attributes), array_values($iframe_attributes));
  $iframe_attributes = implode(" ", $iframe_attributes);

  echo "\n\t<script src=\"" . $duojs_path . "\" ></script>";
  echo '<link rel="stylesheet" type="text/css" href="' . $adaptive_path . '">';
  echo '<iframe ' . $iframe_attributes . '></iframe>';
  echo '<form id="duo_form" method="POST">' . "\n\t\t";
  echo '<input type="hidden" name="reset" value=' . $reset . ' />';
  echo "\n\t</form>";

  include 'resources/duo_footer.php';

  $doc = ob_get_clean();
  @ob_end_clean();
  return $doc;
}

/**
 * Generates Help Text.
 *
 * This is just to remove all HTML from the module itself.
 */
function _duo_generate_help() {
  $help = '<h1>' . t("Duo Two-Factor Authentication") . '</h1>';

  $help .= "<p>" . t("For more complete documentation, view Duo's") . ' <a href="http://www.duosecurity.com/docs/drupal">' . t('documentation on the module') . "</a>.</p>";

  $help .= "<p>" . t("If you need additional help, contact") . ' <a href="mailto:support@duosecurity.com">support@duosecurity.com</a>.</p>';

  $help .= '<h2>' . t("About") . '</h2>';

  $help .= '<p>' . t("This module adds a second step to Drupal's existing login function by implementing") . " Duo's " . t("two-factor authentication API.") . '</p>';

  $help .= '<p>' . t("Duo's two-factor authentication requires a user to use their phone to log in, in addition to their username and password. After entering a valid username and password, the user will be asked to enroll with Duo. After they register their phones with Duo, they will be asked to authenticate with their phones before being signed in. On following attempts to log in, they won't need to enroll again, they'll only be asked to authenticate.") . '</p>';

  $help .= '<h2>' . t("Setting up") . '</h2>';

  $help .= '<p>' . t("To set up this module, you need to sign up with an account at") . ' <a href="http://www.duosecurity.com" target="_blank">http://www.duosecurity.com</a>.</p>';

  $help .= '<p>' . t("After signing up with Duo, you will need to create an integration. Duo offers a") . ' <a href="http://www.duosecurity.com/docs">' . t("getting started guide") . "</a> " . t("that explains how to set up an integration.") . '</p>';

  $help .= '<p>' . t("Upon creating an integration, you will be provided with an integration key, secret key, and API hostname. You'll need this information to configure the module.  Copy and paste the values from the Duo administrative interface into the module configuration page.") . '</p>';

  $help .= '<p>' . t("If the Duo plugin is left unconfigured, users will continue to login as usual without two-factor authentication.") . '</p>';

  $help .= '<h2>' . t("Customization") . '</h2>';

  $help .= '<p>' . t("You can customize the look of the login page by editing the files") . " duo_header.php, duo_footer.php " . t("and") . " custom.css " . t("in the module's") . " resources " . t("folder. The login form is rendered in between the header and footer files.");

  return $help;
}
