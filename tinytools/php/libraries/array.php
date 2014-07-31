<?php
/**
 * @version		$Id: array.php
 * @package		TinyTools
 * @copyright	Copyright (C) 2012 Christian Pschorr
 * @license		GNU/GPL
 */
class tArray {

	/**
	 * Explodes a $string delimited by $delimeter and passes each item in the array through intval().
	 * Corresponds to explode(), but with conversion to integers for all values.
	 *
	 * @param string $delimiter Delimiter string to explode with
	 * @param string $string The string to explode
	 * @return array Exploded values, all converted to integers
	 * @api
	 */
	static public function integerExplode($delimiter, $string) {
		$chunksArr = explode($delimiter, $string);
		foreach ($chunksArr as $key => $value) {
			$chunks[$key] = intval($value);
		}
		return $chunks;
	}

	/**
	 * Explodes a string and trims all values for whitespace in the ends.
	 * If $onlyNonEmptyValues is set, then all blank ('') values are removed.
	 *
	 * @param string $delimiter Delimiter string to explode with
	 * @param string $string The string to explode
	 * @param boolean $onlyNonEmptyValues If set, all empty values (='') will NOT be set in output
	 * @return array Exploded values
	 * @api
	 */
	static public function trimExplode($delimiter, $string, $onlyNonEmptyValues = FALSE) {
		$chunksArr = explode($delimiter, $string);
		$newChunksArr = array();
		foreach ($chunksArr as $value) {
			if ($onlyNonEmptyValues === FALSE || strcmp('', trim($value))) {
				$newChunksArr[] = trim($value);
			}
		}
		reset($newChunksArr);
		return $newChunksArr;
	}

	/**
	 * Merges two arrays recursively and "binary safe" (integer keys are overridden as well), overruling similar values in the first array ($firstArray) with the values of the second array ($secondArray)
	 * In case of identical keys, ie. keeping the values of the second.
	 *
	 * @param array First array
	 * @param array Second array, overruling the first array
	 * @param boolean If set, keys that are NOT found in $firstArray (first array) will not be set. Thus only existing value can/will be overruled from second array.
	 * @param boolean If set (which is the default), values from $secondArray will overrule if they are empty (according to PHP's empty() function)
	 * @return array Resulting array where $secondArray values has overruled $firstArray values
	 * @api
	 */
	static public function arrayMergeRecursive(array $firstArray, array $secondArray, $dontAddNewKeys = false, $emptyValuesOverride = true) {
		foreach ($secondArray as $key => $value) {
			if (array_key_exists($key, $firstArray) && is_array($firstArray[$key])) {
				if (is_array($secondArray[$key])) {
					$firstArray[$key] = self::arrayMergeRecursive($firstArray[$key], $secondArray[$key], $dontAddNewKeys, $emptyValuesOverride);
				}
			} else {
				if ($dontAddNewKeys) {
					if (array_key_exists($key, $firstArray)) {
						if ($emptyValuesOverride || !empty($value)) {
							$firstArray[$key] = $value;
						}
					}
				} else {
					if ($emptyValuesOverride || !empty($value)) {
						$firstArray[$key] = $value;
					}
				}
			}
		}
		reset($firstArray);
		return $firstArray;
	}

	/**
	 * Replacement for array_reduce that allows any type for $initial (instead
	 * of only integer)
	 *
	 * @param array $array the array to reduce
	 * @param string $function the reduce function with the same order of parameters as in the native array_reduce (i.e. accumulator first, then current array element)
	 * @param mixed $initial the initial accumulator value
	 * @return mixed
	 * @api
	 */
	static public function arrayReduce(array $array, $function, $initial = null) {
		$accumlator = $initial;
		foreach($array as $value) {
			$accumlator = $function($accumlator, $value);
		}
		return $accumlator;
	}

	/**
	 * Returns the value of a nested array by following the specifed path.
	 *
	 * @param array $array The array to traverse
	 * @param array $path The path to follow, ie. a simple array of keys
	 * @return mixed The value found, NULL if the path didn't exist
	 * @api
	 */
	static public function getValueByPath(array $array, array $path) {
		$key = array_shift($path);
		if(isset($array[$key])) {
			if(count($path) > 0) {
				return (is_array($array[$key])) ? self::getValueByPath($array[$key], $path) : null;
			} else {
				return $array[$key];
			}
		} else {
			return null;
		}
	}
}
?>