<?php
session_start();
require_once( "sparqllib.php" );
require_once( "function.php" );
error_reporting(E_ERROR | E_PARSE);
 ini_set('max_execution_time', 3000);
 //$db = sparql_connect( "http://dbpedia.org/sparql" );
$db = sparql_connect( "http://www.linkedmdb.org/sparql" );
if( !$db ) { print sparql_errno() . ": " . sparql_error(). "\n"; exit; }
sparql_ns( "foaf","http://xmlns.com/foaf/0.1/" );
function SearchA($uri){
	$prefix = "PREFIX owl: <http://www.w3.org/2002/07/owl#>"
			."PREFIX xsd: <http://www.w3.org/2001/XMLSchema#>"
			."PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>"
			."PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>"
			."PREFIX foaf: <http://xmlns.com/foaf/0.1/>"
			."PREFIX oddlinker: <http://data.linkedmdb.org/resource/oddlinker/>"
			."PREFIX map: <file:/C:/d2r-server-0.4/mapping.n3#>"
			."PREFIX db: <http://data.linkedmdb.org/resource/>"
			."PREFIX dbpedia: <http://dbpedia.org/property/>"
			."PREFIX skos: <http://www.w3.org/2004/02/skos/core#>"
			."PREFIX dc: <http://purl.org/dc/terms/>"
			."PREFIX movie: <http://data.linkedmdb.org/resource/movie/>";
		$sparql = $prefix."SELECT  (COUNT(distinct ?s) AS ?count) WHERE{ {?s ?o <$uri>} UNION {<$uri> ?o ?s}}";
		

		//$sparql =$prefix."SELECT * WHERE { ?s rdfs:label ?o} limit 10";
		$result = sparql_query( $sparql ); 
		if( !$result ) { print sparql_errno() . ": " . sparql_error(). "\n"; exit; }
		$row = sparql_fetch_array( $result );
		return $row["count"];
	}
	function getAllProperty($uri){
	$prefix="http://www.linkedmdb.org/sparql?query=PREFIX+owl%3A+%3Chttp%3A%2F%2Fwww.w3.org%2F2002%2F07%2Fowl%23%3E%0D%0APREFIX+xsd%3A+%3Chttp%3A%2F%2Fwww.w3.org%2F2001%2FXMLSchema%23%3E%0D%0APREFIX+rdfs%3A+%3Chttp%3A%2F%2Fwww.w3.org%2F2000%2F01%2Frdf-schema%23%3E%0D%0APREFIX+rdf%3A+%3Chttp%3A%2F%2Fwww.w3.org%2F1999%2F02%2F22-rdf-syntax-ns%23%3E%0D%0APREFIX+foaf%3A+%3Chttp%3A%2F%2Fxmlns.com%2Ffoaf%2F0.1%2F%3E%0D%0APREFIX+oddlinker%3A+%3Chttp%3A%2F%2Fdata.linkedmdb.org%2Fresource%2Foddlinker%2F%3E%0D%0APREFIX+map%3A+%3Cfile%3A%2FC%3A%2Fd2r-server-0.4%2Fmapping.n3%23%3E%0D%0APREFIX+db%3A+%3Chttp%3A%2F%2Fdata.linkedmdb.org%2Fresource%2F%3E%0D%0APREFIX+dbpedia%3A+%3Chttp%3A%2F%2Fdbpedia.org%2Fproperty%2F%3E%0D%0APREFIX+skos%3A+%3Chttp%3A%2F%2Fwww.w3.org%2F2004%2F02%2Fskos%2Fcore%23%3E%0D%0APREFIX+dc%3A+%3Chttp%3A%2F%2Fpurl.org%2Fdc%2Fterms%2F%3E%0D%0APREFIX+movie%3A+%3Chttp%3A%2F%2Fdata.linkedmdb.org%2Fresource%2Fmovie%2F%3E%0D%0A";
	//$query = "SELECT * WHERE {{<$uri> ?p ?o} UNION {?o ?p <$uri>}}";	
	$query = "SELECT distinct ?o WHERE {{<$uri> ?p ?o} UNION {?o ?p <$uri>}}";	
	$query=urlencode($query);
	$query=str_replace("%2A","*",$query);
	$url = $prefix.$query."&output=json";
	$str = file_get_contents($url);
	$json = json_decode($str, true);
	return $json;
	}
	function SearchAB($uriA,$uriB){
		$prefix = "PREFIX owl: <http://www.w3.org/2002/07/owl#>"
			."PREFIX xsd: <http://www.w3.org/2001/XMLSchema#>"
			."PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>"
			."PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>"
			."PREFIX foaf: <http://xmlns.com/foaf/0.1/>"
			."PREFIX oddlinker: <http://data.linkedmdb.org/resource/oddlinker/>"
			."PREFIX map: <file:/C:/d2r-server-0.4/mapping.n3#>"
			."PREFIX db: <http://data.linkedmdb.org/resource/>"
			."PREFIX dbpedia: <http://dbpedia.org/property/>"
			."PREFIX skos: <http://www.w3.org/2004/02/skos/core#>"
			."PREFIX dc: <http://purl.org/dc/terms/>"
			."PREFIX movie: <http://data.linkedmdb.org/resource/movie/>";
		$sparql = $prefix."SELECT  (COUNT(distinct ?s) AS ?count) WHERE{ {{?s ?o <$uriA>} UNION {<$uriA> ?o ?s}}.{{?s ?o <$uriB>} UNION {<$uriB> ?o ?s}}}";
		

		//$sparql =$prefix."SELECT * WHERE { ?s rdfs:label ?o} limit 10";
		$result = sparql_query( $sparql ); 
		if( !$result ) { print sparql_errno() . ": " . sparql_error(). "\n"; exit; }
		 $row = sparql_fetch_array( $result );
		return $row["count"]; 
	}
	function MaxAB($a,$b){
		if($a>$b)
			return $a;
		return $b;	
	}
	function MinAB($a,$b){
		if($a<$b)
			return $a;
		return $b;	
	}
	function RelateMeasure($A,$B,$AB){
	
		$w= 279676;
		//$b=SearchA($uriB);
		//$a=SearchA($uriA);
		return (log(MaxAB($A,$B))-log($AB))/(log($w)-log(MinAB($A,$B)));
	}
		function getinfo($uri){
	$uri = str_replace("http://www.freebase.com/view","",$uri);
		$freebase_api_key="AIzaSyDZXndLh8k1vpqvtrUPHHVerkEo0Qz98tQ";
	  $service_url = 'https://www.googleapis.com/freebase/v1/topic';
	  $topic_id = $uri;
	  $params = array('key'=>$freebase_api_key);
	  $url = $service_url . $topic_id . '?' . http_build_query($params);
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_URL,$url);
	$result=curl_exec($ch);
	curl_close($ch);
	$json=json_decode($result, true);
	$img="";
	if(isset($json['property']['/common/topic/image']['values'][0]['id']))
		$img = '<img src="https://usercontent.googleapis.com/freebase/v1/image'.$json['property']['/common/topic/image']['values'][0]['id'].'"/>';
	echo '<li >	<div class="post-info">
								<div class="post-basic-info">'.$img.'
									<h3><a onclick="showPopupEX(\''.$uri.'\');" href="#">'.$json['property']['/type/object/name']['values'][0]['value'].'</a>
									<span><a href="#"><label> </label>'.$json['property']['/type/object/type']['values'][2]['text'].'</a></span>
									<p>'.$json['property']['/common/topic/description']['values'][0]['text'].'</p>
								</div>
							</div>
						</li>';
	}	
function showResult($uri){
	$prefix="http://www.linkedmdb.org/sparql?query=PREFIX+owl%3A+%3Chttp%3A%2F%2Fwww.w3.org%2F2002%2F07%2Fowl%23%3E%0D%0APREFIX+xsd%3A+%3Chttp%3A%2F%2Fwww.w3.org%2F2001%2FXMLSchema%23%3E%0D%0APREFIX+rdfs%3A+%3Chttp%3A%2F%2Fwww.w3.org%2F2000%2F01%2Frdf-schema%23%3E%0D%0APREFIX+rdf%3A+%3Chttp%3A%2F%2Fwww.w3.org%2F1999%2F02%2F22-rdf-syntax-ns%23%3E%0D%0APREFIX+foaf%3A+%3Chttp%3A%2F%2Fxmlns.com%2Ffoaf%2F0.1%2F%3E%0D%0APREFIX+oddlinker%3A+%3Chttp%3A%2F%2Fdata.linkedmdb.org%2Fresource%2Foddlinker%2F%3E%0D%0APREFIX+map%3A+%3Cfile%3A%2FC%3A%2Fd2r-server-0.4%2Fmapping.n3%23%3E%0D%0APREFIX+db%3A+%3Chttp%3A%2F%2Fdata.linkedmdb.org%2Fresource%2F%3E%0D%0APREFIX+dbpedia%3A+%3Chttp%3A%2F%2Fdbpedia.org%2Fproperty%2F%3E%0D%0APREFIX+skos%3A+%3Chttp%3A%2F%2Fwww.w3.org%2F2004%2F02%2Fskos%2Fcore%23%3E%0D%0APREFIX+dc%3A+%3Chttp%3A%2F%2Fpurl.org%2Fdc%2Fterms%2F%3E%0D%0APREFIX+movie%3A+%3Chttp%3A%2F%2Fdata.linkedmdb.org%2Fresource%2Fmovie%2F%3E%0D%0A";
	$query = "SELECT * WHERE {<$uri> foaf:page ?url . <$uri> rdfs:label ?name . <$uri> rdf:type ?type}";	
	$query=urlencode($query);
	$query=str_replace("%2A","*",$query);
	$url = $prefix.$query."&output=json";
	//echo $uri;
	 $str = file_get_contents($url);
	$json = json_decode($str, true);
	 foreach($json['results']['bindings'] as $item)
		if((strpos($item['url']['value'],"freebase")!=0)&&(strpos($item['type']['value'],"linkedmdb")!=0)){
			echo '<li >	<div class="post-info">
								<div class="post-basic-info">
									<h3><a onclick="showPopupEX(\''.str_replace("http://www.freebase.com/view","",$item['url']['value']).'\');" href="#">'.$item['name']['value'].'</a>
									<a onclick="addExSearch(\''.rawurlencode($item['name']['value']).'\',\''.$uri.'\');" href="#">Add Seach</a></h3>
									<span><a href="#"><label> </label>'.str_replace("http://data.linkedmdb.org/resource/movie/","",$item['type']['value']).'</a></span>
									<p></p>
								</div>
							</div>
					</li>';
		}  
			// getinfo($item['url']['value']);
	//echo $json['results']['bindings'][0]['page']['value'];
	}
	
	if(isset($_GET['uri'])){
	if(isset($_GET['type'])){
		$type= $_GET['type'];
		$uri = trim($_GET['uri']);
		if($type==0){
			$_SESSION['pivot']=$uri;
			$json = getAllProperty($uri);
			$arr;
			foreach($json['results']['bindings'] as $item){
							if($item['o']['type']=="uri")
								if(matchArray($item['o']['value'],$movieType)==false)
								if((strpos($item['o']['value'],"interlink")==0)&&(strpos($item['o']['value'],"film_film_distributor_relationship")==0))
								//if(strpos($item['o']['value'],"actor")!=0)
									if(strpos($item['o']['value'],"linkedmdb")!=0){
									 $arr[$item['o']['value']] = $item['o']['value'];
								}	
						}
					$_SESSION['json'] = $arr;
					//echo json_encode($arr, JSON_FORCE_OBJECT);
					//echo "tong thoi gian".($end-$start);
		}
		if($type==1){
		$start = round(microtime(true) * 1000);
			$arr_tmp = explode(" ", $uri);
			$arr;
			foreach($arr_tmp as $item){
				$arr[$item] = SearchA($item);
			}  
			$_SESSION['key'] = $arr;	
					//echo json_encode($arr, JSON_FORCE_OBJECT);
					
$stop = round(microtime(true) * 1000);
//echo "tong thoi gian:".($stop-$start);
					//echo "tong thoi gian".($end-$start);
			}
	if($type==2){
	$start = round(microtime(true) * 1000);
				foreach($_SESSION['json'] as $item){
				//str_replace("http://data.linkedmdb.org/resource/movie/","http://data.linkedmdb.org/resource/",$item);
				if($_GET['mode']=="specification")
				showResult($item);
			else
				echo '<li >	<div class="post-info">
												<div class="post-basic-info">
													<h3><a onclick="showPopupSimple(\''.$item.'\');" "href="#">'.str_replace("http://data.linkedmdb.org/resource/","",$item).'</a>
													<a onclick="addExSearch(\''.str_replace("http://data.linkedmdb.org/resource/","",$item).'\',\''.$item.'\');" href="#">Add Seach</a></h3>
													<p></p>
												</div>
											</div>
									</li>';
				}
			//print_r($arr_related);		
			echo "--------------------</br>";
			//print_r($_SESSION['timeAB']);
			//print_r($_SESSION['timeA']);
					//echo json_encode($arr, JSON_FORCE_OBJECT);
					
			$stop = round(microtime(true) * 1000);
			echo "tong thoi gian:".($stop-$start);
					//echo "tong thoi gian".($end-$start); 
			}	
		if($type==3){
		$result = 0;
		$start = round(microtime(true) * 1000);
		//echo $start;
		//echo "aaaaaaaaaa".$uri;
			$json = $_SESSION['json'];
			$arr;
			$arr_a;
			$arr_related;
			$t=count($json);
		 	foreach($json as $item){
				$x = SearchAB($uri,$item);
				if($x!=null){
					$result+=1;
					$arr[$item][$uri] = $x;
					if(!isset($arr_a[$item])){
						$arr_a[$item] = SearchA($item);
						$arr_related[$item] = RelateMeasure($arr_a[$item],$_SESSION['key'][$uri],$x);
						if($_GET['mode']=="specification")
				showResult($item);
			else
				echo '<li >	<div class="post-info">
												<div class="post-basic-info">
													<h3><a onclick="showPopupSimple(\''.$item.'\');" "href="#">'.str_replace("http://data.linkedmdb.org/resource/","",$item).'</a>
													<a onclick="addExSearch(\''.str_replace("http://data.linkedmdb.org/resource/","",$item).'\',\''.$item.'\');" href="#">Add Seach</a></h3>
													<p></p>
												</div>
											</div>
									</li>';	
						}
					}
			}	
			$_SESSION['related'][$uri] = $arr_related;
			//print_r($_SESSION['related']);
			if($result==0){
				foreach($_SESSION['json'] as $item){
				//str_replace("http://data.linkedmdb.org/resource/movie/","http://data.linkedmdb.org/resource/",$item);
				if($_GET['mode']=="specification")
				showResult($item);
			else
				echo '<li >	<div class="post-info">
												<div class="post-basic-info">
													<h3><a onclick="showPopupSimple(\''.$item.'\');" "href="#">'.str_replace("http://data.linkedmdb.org/resource/","",$item).'</a>
													<a onclick="addExSearch(\''.str_replace("http://data.linkedmdb.org/resource/","",$item).'\',\''.$item.'\');" href="#">Add Seach</a></h3>
													<p></p>
												</div>
											</div>
									</li>';
									}	
			}
			//print_r($arr_related);		
			echo "--------------------</br>";
			//print_r($_SESSION['timeAB']);
			//print_r($_SESSION['timeA']);
					//echo json_encode($arr, JSON_FORCE_OBJECT);
					
			$stop = round(microtime(true) * 1000);
			echo "tong thoi gian:".($stop-$start);
					//echo "tong thoi gian".($end-$start); 
			}	
	}
	
}	
?>