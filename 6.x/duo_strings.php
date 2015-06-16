<?php
/**
 * @file
 * Titles.
 */

// Config title strings.
$duo_titles['config_form'] = t('Duo two-factor configuration');
$duo_titles['integration_key'] = t('Integration key');
$duo_titles['secret_key'] = t('Secret key');
$duo_titles['api_hostname'] = t('API hostname');
$duo_titles['form_preview'] = t('Form preview');
$duo_titles['preview_url'] = t('View the login/enrollment form.');

// Permission title string.
$duo_titles['permission'] = t('Log in with Duo two-factor authentication');


/**
 * Descriptions.
 */

// Config description strings.
$duo_descriptions['config_form'] = t('Setup the Duo module with your integration settings.');
$duo_descriptions['integration_key'] = t('Integration key from the Duo administrative interface');
$duo_descriptions['secret_key'] = t('Secret key from the Duo administrative interface');
$duo_descriptions['api_hostname'] = t('API hostname from the Duo administrative interface');
$duo_descriptions['form_preview'] = t("Follow the link above to ensure that you have configured the module correctly.  If you don't see an enrollment/login form, verify that you have entered the proper keys and hostname.  If the problem persists, disable the module and contact") . ' <a href="mailto:support@duosecurity.com">support@duosecurity.com</a>';

// Permission description string.
$duo_descriptions['permission'] = t('Require the selected roles to authenticate with two-factor authentication.');


/**
 * Error Messages.
 */

// Login errors.
$duo_error['logged_in'] = t("You are already logged in.");
$duo_error['login_invalid'] = t("Invalid username or password.");

// Config errors.
$duo_error['invalid_ikey'] = t("The integration key you have entered is the incorrect length.  Please check the value before trying again.");
$duo_error['invalid_skey'] = t("The secret key you have entered is the incorrect length.  Please check the value before trying again.");
$duo_error['short_api'] = t("The API hostname you have entered is too short.  Please check the value before trying again.");
$duo_error['bad_configuration'] = t("The module hasn't been configured properly.  Check your settings before trying again.");

// Two-factor errors.
$duo_error['tfa_not_recieved'] = t("The required information wasn't received.  Please try again.");
$duo_error['tfa_invalid'] = t("Secondary authentication credentials were invalid, or the user cannot be loaded.");

// PHP version error.
$duo_error['php_invalid'] = t("You are running an unsupported") . " PHP " . t("installation.") . " PHP >= 5.1.2, PECL >= 1.1" . t("required.");
