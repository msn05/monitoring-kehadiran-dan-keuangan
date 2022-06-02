<?php
date_default_timezone_set('Asia/Jakarta');
function basePage($url = null) {
	$base_url = "https://smabplalanpalembang.websitepalcomtech.com/Assets";
	if ($url != null) {
		return $base_url."/".$url;
	} else {
		return $base_url ;
	}
}
function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
function PageApp($url = null) {
	$base_url = "https://smabplalanpalembang.websitepalcomtech.com/App";
	if ($url != null) {
		return $base_url."/".$url;
	} else {
		return $base_url ;
	}
}

function PageLogo($url = null) {
	$base_url = "https://smabplalanpalembang.websitepalcomtech.com/App/Image";
	if ($url != null) {
		return $base_url."/".$url;
	} else {
		return $base_url ;
	}
}

function Title() {
	$App_name =  'Monitoring Siswa SMA Lalan Sungai Lalan Banyuasin';
	return $App_name;
}

function nameDev() {
	$App_name =  'Dedi dan Fathullah Palcomtech Palembang 2019 - 2020 Sistem Informasi';
	return $App_name;
}

