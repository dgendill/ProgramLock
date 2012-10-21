<?php
namespace DomsUtil;
use \DateTime;
use \DateTimeZone;

class ProgramLock {

	public $fileName;
	private $mutex;
	private $lockActive;

	public function __construct($fileName = "lock.txt") {
		$this->fileName = $fileName;
		$this->mutex = fopen($fileName, "a+");
		$this->lockActive = flock($this->mutex, LOCK_EX | LOCK_NB );
		if ($this->lockActive) {
			ftruncate($this->mutex, 0);
			$currentDate = new DateTime();
			$currentDate->setTimezone(new DateTimeZone('America/Denver'));
			fwrite($this->mutex, 'Lock aquired on ' . $currentDate->format('D Y-m-d h:i:s A'));
		}
	}

	public function hasAccess() {
		return $this->lockActive;
	}

	public function release() {
		if (is_resource($this->mutex) === false) {
			$this->lockActive = false;
			return true;
		}

		$isMutexClosed = fclose($this->mutex);
		if ($isMutexClosed) {
			$this->lockActive = false;
		}
		return $isMutexClosed;
	}
}
?>