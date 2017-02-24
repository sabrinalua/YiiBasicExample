<?php 
namespace vendor\custom;

class WebHandler{

	// @var $agent is $_SERVER['HTTP_USER_AGENT'] or any name you want
	public function getRequest($url, $body, $head, $agent, $reqStatus=200){
		$url= $url.'?';
		foreach ($body as $key => $value) {
			$add = $key.'='.$value;
			$url=$url.'&'.$add;
		}

		$ch=curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $head);
		curl_setopt($ch, CURLOPT_USERAGENT, $agent);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_TIMEOUT, 400);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);		

		$response = curl_exec($ch);
		$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		$curl_errno = curl_errno($ch);
		curl_close($ch);

		if($status==$reqStatus){
			return $response;
		}else{
			return $curl_errno;
		}

	}

	public function postRequest($url, $body, $head, $agent, $reqStatus=200){
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $head);
		curl_setopt($curl, CURLOPT_USERAGENT, $agent);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_POST, true);            
		curl_setopt($curl, CURLOPT_POSTFIELDS, $body);		
		curl_setopt($curl, CURLOPT_HEADER, 0);

		$response = curl_exec($curl);
		$status=curl_getinfo($curl, CURLINFO_HTTP_CODE);
		$curl_errno = curl_errno($curl);
		curl_close($curl);

		if($status==$reqStatus){
			return $response;
		}else{
			return $curl_errno;
		}
	}

	//body has to be json
	public function putRequest2($url, $body, $head, $agent, $reqStatus=200){
		$data = http_build_query($body);
		$length = strlen($data);

		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $head);
		curl_setopt($curl, CURLOPT_USERAGENT, $agent);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_PUT, true);            		
		curl_setopt($curl, CURLOPT_INFILE, $data);
		curl_setopt($curl, CURLOPT_INFILESIZE, $length);
		curl_setopt($curl, CURLOPT_HEADER, 0);

		$response = curl_exec($curl);
		$status=curl_getinfo($curl, CURLINFO_HTTP_CODE);
		$curl_errno = curl_errno($curl);
		curl_close($curl);

		if($status==$reqStatus){
			return $response;
		}else{
			return $curl_errno;
		}
	}

	public function putRequest($url, $body, $head, $agent, $reqStatus=200){
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $head);
		curl_setopt($curl, CURLOPT_USERAGENT, $agent);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
		curl_setopt($curl, CURLOPT_POSTFIELDS, $body);
		curl_setopt($curl, CURLOPT_HEADER, 0);
		
		$response = curl_exec($curl);
		$status=curl_getinfo($curl, CURLINFO_HTTP_CODE);
		$curl_errno = curl_errno($curl);
		curl_close($curl);

		if($status==$reqStatus){
			return $response;
		}else{
			return $curl_errno;
		}
	}
}

?>