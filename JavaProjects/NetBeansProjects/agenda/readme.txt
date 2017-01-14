+==========================+
|  Table of contents:      |
+--------------------------+
|  0. About this document  |
|  1. About the program    |
|  2. License              |
|  3. Install              |
|  4. Quick notes          |
|  5. Manual               |
|  6. FAQ                  |
|  7. Contact              |
+==========================+


0. About this document:
=======================
This document is intented to be continuously in development. This document will
be updated as the program evolves. Herein you should always be able to find the 
most recent information regarding php-Agenda.

Changelog:
Thomas ~ 2007-08-23: Section on registration
Thomas ~ 2007-08-20: Section on reminders
Thomas ~ 2007-08-06: Section on guest access.
Thomas ~ 2007-02-26: Some minor changes
Thomas ~ 2006-10-02: Added some information and rewrote some parts
Thomas ~ 2006-09-30: The first draft of this document.

1. About the program:
=====================
1.1 Overview
------------
The Simple PHP-agenda is a small and versatile tool to manage your agenda. 

1.2 Versioning system
---------------------
The versioning system started at 0.1 which is equal to 0.1.0. The version number
consists of three parts <major>.<minor>.<micro>. The major number will be
increased with each release that requires changes to the database and therefore
will require a specific update script to migrate from a release with a lower
major number. Minor releases contain additional features compared to the
previous minor release. Micro releases finaly fix bugs, layout changes, 
minor changes that do not add up to a new feature and so on. Minor and micro
releases will not require any migration utility and can be installed over the 
previous version.


2. License:
===========
The program is supplied under the terms of GNU GPL (see also license.txt).

3. Install:
===========
A more detailed install guide can be found in the install.txt file.

4. Quick Notes:
===============
- the layout has some known glitches and is far from finished, this will be 
addressed in future releases.

5. Manual:
==========
This document is still a work in progress. Currently we feel that the 
application is rather straightforward and requires little to no explanation. 
If you disagree please drop us a note an we will be happy to provide you with 
some pointers or we can make the UI more intuivily. See section 7 for contact 
information.

5.1. Guest access
-----------------
You can allow guests to see your agenda by setting the $allowGuestAccess flag 
to true in the config.inc.php file. This feature is still experimental so any
feedback is welcomed.

5.2. Reminders
--------------
You can enable reminders (daily, some time before the event) in the config.in.php
file. You will also need to add two scripts to your cron. This is detailed in the
install.txt file.

5.3. Registration
-----------------
In the config file is  flag to control whether people can sign up to your agenda. 
If this is set to false, admins can still register new users in the admin center.
Each user gets his/her password mailed when they first register, so when an admin
registers a new user, this new users gets his/her password.


6. FAQ:
=======
Thus far nobody asked any questions about the program so there aren't any 
'frequently' asked ones. Some feedback would be great to start compiling this 
list.

7. Contact:
===========
You can report bugs, request features, types or just send us an E-mail by
visiting the project page for the program at Sourceforge.
http://php-agenda.sourceforge.net/