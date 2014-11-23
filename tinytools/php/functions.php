<?php

	/**
	 * gibt einen uebergebenen Wert / Objekt / Array / usw menschenleserlich und formatiert
	 * aus
	 *
	 * @access public
	 * @param mixed $mixed Variable die ausgegeben werden soll
	 * @param boolean $htmlencode optionaler Parameter, der angibt ob die Variable ueber die
	 * 	Function htmlspecialschars ausgegeben werden soll
	 * @return none
	 */
	function debug($mixed, $htmlencode = false) {
		echo '<div class="debug">';
		if($mixed === true) {
			echo 'true';

		} elseif($mixed === false) {
			echo 'false';

		} elseif(is_array($mixed) || is_object($mixed) || $mixed === null) {
			echo '<pre>';
			print_r($mixed);
			echo '</pre>';

		} elseif(is_string($mixed) && $htmlencode === true) {
			echo htmlspecialchars($mixed) . '<br />\n';

		} else {
			echo '<strong>[</strong> ' . $mixed . ' <strong>]</strong><br />' . "\n";
		}
		echo '</div>';
	}

?>