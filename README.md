ProgramLock
===========

ProgramLock is a Mutex that can prevent a program from running multiple time simultaneously.

Example
=======

See Usage.php for example.

Usage
=====

Include ProgramLock.php and add ProgramLock to the current namespace.

    require_once('path/to/ProgramLock.php');
    use DomUtil\ProgramLock as ProgramLock;

You can then create a new ProgramLock using any file name that you like (if no file name is provided the default is 'lock.txt').

    $lock = new ProgramLock('file-lock-name.txt');

You can attempt to aquire the lock by calling the hasAccess() method.

    if ($lock->hasAccess()) {
      // The lock is not being used.  It will now
      // be aquired and the program run...
    } else {
      // The lock is already aquired.  Do not run
      // the program...
    }

After the lock has been aquired it will write the date and time to the filename.  See line 20 of ProgramLock.php

    $currentDate = new DateTime();
    $currentDate->setTimezone(new DateTimeZone('America/Denver'));
    fwrite($this->mutex, 'Lock aquired on ' . $currentDate->format('D Y-m-d h:i:s A'));