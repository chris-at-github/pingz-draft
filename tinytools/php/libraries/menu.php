<?php
/**
 * @version		$Id: menu.php
 * @package		TinyTools
 * @copyright	Copyright (C) 2012 Christian Pschorr
 * @license		GNU/GPL
 */
class tMenu {

	/**
	 * Instanz auf das eigene Objekt, um mehrfache Instanzen zu verhindern
	 * @var array $_instance
	 * @access private
	 */
	private static $_instance = null;

	/**
	 * Daten, die fuer die Anzeige, der Menueeintraege benoetigt werden
	 * @var array $_data
	 * @access private
	 */
	private $_data = null;

	/**
	 * Optionen, die bei der Generierung des HTML-Codes verwendet werden
	 * @var array $_options
	 * @access private
	 */
	private $_options = null;

	/**
	 * globale Konfiguration aus der config.php
	 * @var string $_config
	 * @access private
	 */
	private $config = null;	

	/**
	 * aktiver Pfad
	 * @var string $_active
	 * @access private
	 */
	private $_active = null;

	/**
	 * Array mit den Breadcrumbeintraegen
	 * @var array $_breadcrumb
	 * @access private
	 */
	private $_breadcrumb = array();

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
		if(self::$_instance === null) {
			self::$_instance = new self;
		}
		return self::$_instance;
	}

	/**
	 * durchlaeuft den aktiven Pfad und setzt die Menuepunkte auf aktiv
	 *
	 * @param array $data Daten mit den Menueeintraegen
	 * @return array Daten mit den Menueeintraegen + dem Flag welche aktiv sind
	 */
	private function _setDataActive($data, $r = 0) {
		$active	= $this->_active;
		$active	= trim($active, '/');

		$arr		= explode('/', $active);
		$active	= array();

		for($i = 0; $i <= $r; $i++) {
			$active[] = $arr[$i];
		}
		$active = '/' . implode('/', $active) . '/';

		if(array_key_exists($active, $data)) {
			$data[$active]['active'] 	= true;

			if(array_key_exists($active, $this->_breadcrumb) === false) {
				$this->_breadcrumb[$active]	= array(
					'url'		=> $active,
					'title'	=> $data[$active]['title']
				);
			}

			if(array_key_exists('children', $data[$active])) {
				$data[$active]['children'] = $this->_setDataActive($data[$active]['children'], ++$r);
			}
		}

		return $data;
	}

	/**
	 * setzt alle Einstellungen auf den Ursprungswert zurueck
	 *
	 * @param none
	 * @return object Instanz auf das tMenu Objekt
	 */
	public function reset() {
		$this->_data 		= null;
		$this->_options	= array(
			'ulHtmlClass'		=> null,
			'renderUlTag'		=> true,
			'setFirstChild'	=> true,
			'maxDepth'			=> 10,
			'minDepth'			=> 1,
			'expandActive'	=> true
		);

		return $this;
	}

	/**
	 * Daten der Menueeintraege setzen
	 *
	 * @param array $data Daten der Menueeintraege
	 * @return object Instanz auf das tMenu Objekt
	 */
	public function setData($data) {
		if(is_array($data)) {
			if($this->_active !== null) {
				$data = $this->_setDataActive($data);
			}

			$this->_data = $data;
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
			$this->_options = array_merge($this->_options, $options);
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
			$this->_config = $config;
		}
		return $this;
	}

	/**
	 * setzt den aktiven Pfad
	 *
	 * @param string $str aktiver Pfad
	 * @return object Instanz auf das tMenu Objekt
	 */
	public function setActive($str) {
		$str = str_replace('index.html', null, $str);
		$str = '/' . trim($str, '/') . '/';

		$this->_active = $str;

		return $this;
	}
	
	/**
	 * liefert den Title des aktiven Elements
	 *
	 * @param none
	 * @return string Titel des aktiven Elements
	 */
	public function getActiveTitle() {
		$title 	= array();
		$ret		= null;
		
		if(empty($this->_breadcrumb) === false) {
			$ret = $this->_breadcrumb[$this->_active]['title'];
		}
		
		return $ret;		
	}	

	/**
	 * baut den HTML-Code zusammen und gibt ihn zurueck
	 *
	 * @param none
	 * @return string HTML-Code
	 */
	public function render($data = null, $options = null, $r = 1) {
		$html = '';

		if($data === null) {
			$data = $this->_data;
		}
		if($options === null) {
			$options = $this->_options;
		}

		$minDepthEnabled = false;
		if($r >= $this->_options['minDepth']) {
			$minDepthEnabled = true;
		}
		
		$i = 0;
		$n = count($data);

		foreach($data as $url => $item) {
			$i++;

			if($item['menu'] !== false) {

				if($minDepthEnabled === true) {
					$liHtmlClass = '';
					if($i === 1 && $this->_options['setFirstChild'] === true) {
						$liHtmlClass = ' class="first-child"';
					}
					if($i === $n) {
						$liHtmlClass = ' class="last-child"';
					}

					$aHtmlClass = '';
					if($item['active'] === true) {
						$aHtmlClass = ' class="active"';
					}
				}

				$children = '';
				if(
					array_key_exists('children', $item) &&
					$r < $this->_options['maxDepth'] &&
					(
						($item['active'] === true && $this->_options['expandActive'] === true) ||
						$this->_options['expandActive'] === false
					)
				) {
					$children = $this->render($item['children'], null, ++$r);
				}

				if($minDepthEnabled === true) {
					$html .= '<li' . $liHtmlClass . '><a' . $aHtmlClass . ' href="' . $url . '">' . $item['title'] . '</a>' . $children . '</li>';
				} else {
					$html .= $children;
				}
			}
		}

		if($this->_options['renderUlTag'] === true && $minDepthEnabled === true && empty($html) === false) {
			$ulHtmlClass = '';
			if($this->_options['ulHtmlClass'] !== null) {
				$ulHtmlClass = ' class="' . $this->_options['ulHtmlClass'] . '"';
			}

			$html = '<ul' . $ulHtmlClass . '>' . $html . '</ul>' . "\n";
		}

		return $html;
	}

	/**
	 * baut den HTML-Code fuer den Breadcrumb zusammen
	 *
	 * @param none
	 * @return string HTML-Code
	 */
	public function renderBreadcrumb() {
		$html = '';

		if($this->_options['renderUlTag'] === true) {
			$ulHtmlClass = '';
			if($this->_options['ulHtmlClass'] !== null) {
				$ulHtmlClass = ' class="' . $this->_options['ulHtmlClass'] . '"';
			}

			$html .= '<ul' . $ulHtmlClass . '>';
		}

		$i = 0;
		$n = count($this->_breadcrumb);

		if(isset($this->_config['breadcrumb']['root'])) {
			$liHtmlClass = '';
			if($i === 1 && $this->_options['setFirstChild'] === true) {
				$liHtmlClass = ' class="first-child"';
			}
			$html .= '<li' . $liHtmlClass . '>';
			$html .= '<a href="' . $this->_config['breadcrumb']['root']['url'] . '">' . $this->_config['breadcrumb']['root']['title'] . '</a><span>' . $this->_config['breadcrumb']['root']['seperator'] . '</span>';
			$html .= '</li>';

			$i++;
			$n++;
		}

		foreach($this->_breadcrumb as $item) {
			$i++;

			$liHtmlClass = '';
			if($i === 1 && $this->_options['setFirstChild'] === true) {
				$liHtmlClass = ' class="first-child"';
			}
			if($i === $n) {
				$liHtmlClass = ' class="last-child"';
			}

			$html .= '<li' . $liHtmlClass . '>';
			if($i === $n) {
				$html .= '<strong>' . $item['title'] . '</strong>';
			} else {
				$html .= '<a href="' . $item['url'] . '">' . $item['title'] . '</a><span>' . $this->_config['breadcrumb']['root']['seperator'] . '</span>';
			}
			$html .= '</li>';
		}

		if($this->_options['renderUlTag'] === true) {
			$html .= '</ul>' . "\n";
		}

		return $html;
	}

	/**
	 * baut einen Seitentitel aus dem Breadcrumb-Stuecken zusammen
	 *
	 * @param none
	 * @return string HTML-Code
	 */
	public function renderBreadcrumbTitle() {
		$title 	= array();
		$ret		= null;

		if(empty($this->_breadcrumb) === false) {
			foreach(array_reverse($this->_breadcrumb) as $item) {
				$title[] = $item['title'];
			}
			$ret 	= implode($this->_config['breadcrumb']['seperator'], $title);
			$ret .= $this->_config['breadcrumb']['seperator'];
		}
		return $ret;
	}
}
?>