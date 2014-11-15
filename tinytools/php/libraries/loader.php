<?php
/**
 * @version		$Id: loader.php
 * @package		TinyTools
 * @copyright	Copyright (C) 2012 Christian Pschorr
 * @license		GNU/GPL
 */
class tLoader {

	/**
	 * Liste von bereits geladene Klassen und Dateien
	 * @var array $_storage
	 * @access private
	 */
	private static $_storage = array();

	/**
	 * Grundmethode der Klasse bLoader; sie entscheidet selbststaendig ob
	 * eine Library, Helper, Controller oder Model geladen werden soll
	 *
	 * @param string $name Name der Klasse die geladen werden soll
	 * @return boolean
	 */
	public static function _($classname) {
		$filename		= strtolower(ltrim($classname, 't'));

		// Instanz zur Klasse
		if(self::import($filename) && class_exists($classname)) {
			return true;
		}

		// Fehlermeldung falls irgendetwas beim Laden oder initialisieren der Klasse nicht funktioniert hat
		trigger_error('Bibliothek ' . $classname . ' konnte nicht gefunden oder geladen werden.', E_USER_ERROR);
		return false;
	}

	/**
	 * prueft anhand des uebergebenen Hashwertes ob eine Datei bereits includiert wurde
	 *
	 * @param string $hash Pfad der Datei = Schluessel im globalen Array $_storage
	 * @return boolean wurde die Datei bereits includiert true, ansonsten false
	 */
	public static function exists($hash) {
		return array_key_exists(base64_encode($hash), self::$_storage);
	}

	/**
	 * registriert eine Datei als bereits geladen
	 * der uebergebene Pfad ($hash) wird als Schluessel im globalen Array $_storage
	 * eingetragen
	 *
	 * @param string $hash Pfad der Datei = Schluessel im globalen Array $_storage
	 * @return none
	 */
	private static function register($hash) {
		self::$_storage[base64_encode($hash)] = true;
	}

	/**
	 * importiert eine Datei innerhalb des BASE Projektes
	 *
	 * @param string|array $filepath Pfad zu der Datei die geladen werden soll; es wird automatisch der
	 *	Pfad BPATH davor gesetzt
	 * 	optional darf die Variable $filepath ein Array sein, welche Eintraege einem Dateipfad
	 * 	entsprechen, sie muessen in diesem Fall jedoch alle vom selben Typ sein
	 * @return boolean wurde die Datei erfolgreich geladen true, ansonsten false
	 */
	private static function import($filepath) {

		// es ist ein Array aus Pfaden
		if(is_array($filepath)) {
			foreach($filepath as $tmp) { tLoader::import($tmp); }
			return true;
		}

		$fileinfo = pathinfo($filepath);
		if(!isset($fileinfo['dirname']) || $fileinfo['dirname'] == '.') {
			$fileinfo['dirname'] = '';
		}

		$filepath = $_SERVER['DOCUMENT_ROOT'] . '/tinytools/php/libraries/' . $fileinfo['dirname'] . '/' . strtolower($fileinfo['basename']);
		$filepath = preg_replace('#[/\\\\]+#', '/', $filepath);

		if(!isset($fileinfo['extension']) || empty($fileinfo['extension'])) {
			$filepath .= '.php';
		}

		if(is_file($filepath) === true && tLoader::exists($filepath) === false) {
			tLoader::register($filepath);
			include($filepath);

			return true;
		}

//		trigger_error('Datei ' . $filepath . ' kann nicht gefunden werden', E_USER_ERROR);
		return false;
	}
}

?>
