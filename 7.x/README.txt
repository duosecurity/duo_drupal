** Duo Two-Factor Authentication Module **

Drupal Version:  7.x
Module Version: 1.11
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
1.1 - Bug fix, altered some names.
1.2 - Bug fix, altered names, update SDK.
1.3 - Bug fix, Fixed SDK update.
1.4 - Bug fix, naming + translation issues.
1.5 - Major update to login method, add support for custom login style, moved preview to new page, 
      and adds a duo_strings for constistant naming between the 6.x and 7.x module
1.6 - Bug fix, fix permissions typo, protect forgot password with TFA
1.7 - Bug fix, fix an issue with password resets.
1.8 - Add support for Duo's new enrollment frame.
1.9 - Adaptive iframe, updated Duo Web PHP library, Offline mode support, general cleanup.
1.10 - Update DuoWeb SDK to version 2.3
1.11 - Update DuoWeb SDK to version 2.6


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
