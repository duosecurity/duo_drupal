** Duo Two-Factor Authentication Module **

Drupal Version:  6.x
Module Version: 1.8
Contributors:  Duo Security
Contact:  info@duosecurity.com


Description
-----------

This module adds Duo two-factor authentication to your Drupal site.


Installation
------------

For detailed installation and configuration instructions, please visit:

    http://www.duosecurity.com/docs/drupal


Contact
-------

Have a question? Drop us a line at info@duosecurity.com.


Changelog
---------

0.3 - Module Weight decreased to allow other modules to run first.
1.0 - Initial Release
1.1 - Bug fix, fixed naming issues
1.2 - Bug fix, fixed other naming and translation issues.
1.3 - Updated SDK
1.4 - Major overhaul of the login method.  Adds custom styling ability.
      Moves preview form to new page.  Uses a php include for naming consistancy 
      between 6 & 7 module
1.5 - Fixed bug where one time passcode wouldn't be protected via TFA
1.6 - Add support for Duo's new enrollment frame.
1.7 - Adaptive iframe, updated Duo Web PHP library, general cleanup.
1.8 - Update DuoWeb SDK to version 2.6


Maintenance/Offline Mode
---------

Unfortunately, Drupal 6 does not support the necessary APIs to enable offline
mode with the Duo module. We recommend that you disable the Duo module before
entering offline mode. If you're stuck in offline mode with the Duo module
enabled then the following database command will manually disable it:

UPDATE system SET status='0' WHERE name='duo';


File List
---------

  duo /
    duo.info
    duo.install
    duo.js
    duo.php
    duo.module
    duo_strings.php
    duo_web.php
    README.txt
    adaptive.css
    resources /
      960.css
      custom.css
      duo_header.php
      duo_footer.php
