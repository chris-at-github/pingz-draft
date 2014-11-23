<?php
/**
 * @version		$Id: widget.php
 * @package		TinyTools
 * @copyright	Copyright (C) 2012 Christian Pschorr
 * @license		GNU/GPL
 */
class tWidget {

	/**
	 * Instanz auf das eigene Objekt, um mehrfache Instanzen zu verhindern
	 * @var array $_instance
	 * @access private
	 */
	private static $instance = null;

	/**
	 * Optionen, die bei der Generierung des HTML-Codes verwendet werden
	 * @var array $_options
	 * @access private
	 */
	private $options = null;

	/**
	 * Key:Value Liste mit den Elementen, die zur Verfuegung stehen
	 * @var array $_data
	 * @access private
	 */
	private $data = null;

	/**
	 * globale Konfiguration aus der config.php
	 * @var string $_config
	 * @access private
	 */
	private $config = null;

	/**
	 * Konstruktor der Klasse tMenu
	 *
	 * @param none
	 * @return none
	 */
	private function __construct() {
	}

	/**
	 * Singleton-Methode
	 *
	 * @param none
	 * @return object Instanz auf die Klasse tMenu
	 */
	static public function singleton() {
		if(self::$instance === null) {
			self::$instance = new self;
		}
		return self::$instance;
	}

	/**
	 * Daten der Elementverknuepfungen setzen
	 *
	 * @param array $data Daten der Elemente
	 * @return object Instanz auf das tMenu Objekt
	 */
	public function setData($data) {
		if(is_array($data)) {
			$this->data = $data;
		}
		return $this;
	}

	/**
	 * setzt die globale Konfiguration
	 *
	 * @param array $config Konfiguration aus der config.php
	 * @return object Instanz auf das tMenu Objekt
	 */
	public function setConfiguration($config) {
		if(is_array($config)) {
			$this->config = $config;
		}
		return $this;
	}

	/**
	 * setzt die Optionen, die bei der Generierung des HTML-Codes verwendet werden
	 *
	 * @param array $options Optionen
	 * @return object Instanz auf das tMenu Objekt
	 */
	public function setOptions($options) {
		if(is_array($options)) {
			$this->options = array_merge($this->options, $options);
		}
		return $this;
	}

	/**
	 * rendert die Elemente eine angegebenen Position
	 *
	 * @param string $position Position, die gerendert werden soll
	 * @return string HTML-Code der gerenderten Elemente
	 */
	public function render($key, $attr = array(), $config = array(), $data = null) {
		$ret = null;
		
		if($data === null) {
			$data = $this->data;
		}

		if($data !== null && isset($data[$key]) === true) {
		
			if(is_array($data[$key]) === true) {		
				$ret = array();
				
				foreach($data[$key] as $k => $v) {
					$ret[] = $this->render($k, $attr, $config, $data[$key]);
				}

				return implode("\n", $ret);
			}
		
			if(is_file($file = ($_SERVER['DOCUMENT_ROOT'] . $data[$key]))) {
			
				// Konfig bereitstellen
				$config = array_merge($this->config, $config);
			
				// Variablen zuweisen, die im Include vorhanden sein sollen
				extract($attr);
			
				ob_start();
				include($file);
				$ret = ob_get_contents();
				ob_end_clean();
			}			
		}
		
		return $ret;
	}
}
?>