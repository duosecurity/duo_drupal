** Duo Two Factor Authentication Module **

Drupal Version:  7.x
Module Version: 1.5
Contributors:  Duo Security
Contact:  support@duosecurity.com

Description
-------------------

Adds two factor authentication to your Drupal site.

Features
  *  Phone callback
  *  Sms delivered one-time passcodes
  *  Mobile app to generate one-time passcodes
  *  Mobile app push notifications for easy authentication
  *  Hardware token to generate one-time passcodes
  *  Flexible permissions


REQUIREMENTS
-------------------------

PHP >= 5.1.2, PECL hash >= 1.1 required.  

Javascript must be enabled.  If the end-user doesn't 
have javascript enabled, they will be locked out.


WARNING
----------------

This module makes use of drupal_exit() to avoid displaying the regular
login page.  This means that modules like site-wide analytics will not
work for Duo's login page.

**THE FOLLOWING AFFECTS CONFIGURED MODULES ONLY **

If Duo is configured improperly (You have entered invalid settings), 
you will be locked out unless you disable the Duo Module before
you log out.  

You should always view the preview link after saving the settings.
If you don't see the login/enrollment form make sure you check
your settings to verify they match the integration settings.

If you continue to have problems disable the Duo module from the 
Module page and email support@duosecurity.com. 


Installation
------------------

You can edit the "duo_header.php" and "duo_footer.php"
as well as the "custom.css" in the resources folder
to customize the apperance of the login form.

Other than that, it installs like any other module. 

You will need an account with Duo Security to configure it.

If you don't have an account already, sign up for a free 
account at www.duosecurity.com


Configuration
----------------------

If you have an account with Duo Security, you need
to create a new webSDK integration.

Duo has a guide to setting up an integration here: 
http://www.duosecurity.com/docs/getting_started

You'll be given a secret key, integration key and api hostname.

Open the Duo configuration page, either from the Module page,
or from Configuration -> System -> Duo Configuration Settings
in the Admin menu.

Enter the secret key, integration key and api hostname.

Indicate whether or not your Drupal installation is case sensitive.  If
your installation is case sensitive the usernames "JohnSmith" and "johnsmith"
would be different users.  If they are considered the same username, leave the
box unchecked.

Save your settings.

If you have configured it properly you should 
see the Duo enrollment or login page in the Duo preview section.

If you don't see the enrollment or login form in the preview section
disable the plugin.  See the Warning above.


User Access
-------------------

From the Module page you can configure the module permissions.

Permissions controls who will log in with Duo.  Those who do not have
permission will bypass the two factor authentication.


Contact
-------------

For help, email support@duosecurity,com


Frequently Asked Questions
---------------------------------------------

 * Is Duo really free?
 
    Yes, Duo is free up to 10 users and no credit card is required to get started! 
    If you go beyond 10 users, it's only $3/user/month.
    
* Can I use Duo to protect anything else?
    
    If you're interested in protecting other web applications with Duo's 
    two-factor authentication, check out our web SDK at
    https://github.com/duosecurity/duo_web/ 
    
    We also offer VPN and UNIX integrations.  See more at
    http://www.duosecurity.com
    

Changelog
-----------------
0.3 - Module Weight decreased to allow other modules to run first.
1.0 - Initial Release
1.1 - Bug fix, altered some names.
1.2 - Bug fix, altered names, update SDK.
1.3 - Bug fix, Fixed SDK update.
1.4 - Bug fix, naming + translation issues.
1.5 - Major update to login method, add support for custom login style, moved preview to new page, 
      and adds a duo_strings for constistant naming between the 6.x and 7.x module


File List
------------

  duo /
    duo.info
    duo.install
    duo.js
    duo.php
    duo.module
    duo_strings.php
    duo_web.php
    README.txt
    resources /
      960.css
      custom.css
      duo_header.php
      duo_footer.php
