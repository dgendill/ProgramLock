<?php
require_once('ProgramLock.php');
use DomsUtil\ProgramLock as ProgramLock;

$lock = new ProgramLock('mylock.txt');
if ($lock->hasAccess()) {
	echo "Lock Aquired. Program is running.";
	sleep(30);
} else {
	echo "Program is already running.";
}
$lock->release();

?>