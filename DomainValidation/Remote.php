<?php namespace DomainValidation;

class Remote {

/**
 * URL to the tld list
 *
 * @param string
 * @access private
 */
	private static $__tldUrl = 'http://data.iana.org/TLD/tlds-alpha-by-domain.txt';

/**
 * TLD File Variable
 *
 * Writes the file to the webroot directory by default
 *
 * @filesource http://data.iana.org/TLD/tlds-alpha-by-domain.txt
 * @param string
 * @access private
 */
	public static $__tldList = 'tlds.txt';

/**
 * Check Url Status
 *
 * @param string $url
 * @access public
 **/
	public function checkUrlStatus($url) {
		$handle = curl_init($url);
		curl_setopt($handle, CURLOPT_HEADER, true);
		curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($handle, CURLOPT_NOBODY, true);
		curl_setopt($handle, CURLOPT_FRESH_CONNECT, true);
		curl_setopt($handle, CURLOPT_TIMEOUT, 5);
		curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 5);
		curl_setopt($handle, CURLOPT_FAILONERROR, true);

		$response = curl_exec($handle);
		$httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
		curl_close($handle);
		return $httpCode;
	}

/**
 * Fetch Tlds and store them in root.
 *
 * @return bool
 */
	public static function fetchTlds() {
		if (self::saveRemoteContents(dirname(dirname(__FILE__)) . '/' . self::$__tldList, self::fetchRemoteContents(self::$__tldUrl))) {
			return true;
		}
		return false;
	}

/**
 * Save remote contents
 *
 * Here we are just going to save data to a specified path/file
 *
 * @access private
 * @param string $saveFile
 * @param string $contentsToSave
 * @return int
 */
	static function saveRemoteContents($saveFile = null, $contentsToSave = null) {
		return file_put_contents($saveFile, $contentsToSave, LOCK_EX);
	}

/**
 * Fetch remote contents
 *
 * Give a url and we will fetch the contents
 *
 * @param string$remoteFile
 * @return string
 */
	static function fetchRemoteContents($remoteFile = null) {
		return file_get_contents($remoteFile);
	}


}
