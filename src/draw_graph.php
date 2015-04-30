<?php
	session_start();
	if(isset($_GET['key'])){
		
		$arr = $_SESSION['related'];
		$pivot = $_SESSION['pivot'];
		$json = $_SESSION['json'];
		//print_r($arr);
		$arr_res;
		$key = 	$_GET['key'];
		//print_r($arr);
		//echo $key;
		foreach($arr as $key1=>$value1)
			foreach($value1 as $key2=>$value2)
				if($key2==$key){
					$arr_res[replace($key)][replace($key1)] = $value2;
					$arr_res[replace($pivot)][replace($key)]=0;
				}
		$i=0;
		foreach($json as $item){
			$arr_res[replace($pivot)][replace($item)]=0;
			$i++;
			if($i>3) break;
		}
			//echo $value2."</br>";
		echo rawurlencode(json_encode($arr_res, JSON_FORCE_OBJECT));
	}
	
	function replace($value){
		return str_replace("http://data.linkedmdb.org/resource/","",$value);
	}
?>