<?php namespace DomainValidation;

class Remote {

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


}