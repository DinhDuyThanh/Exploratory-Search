<?php 
// Author: John Wright
// Website: http://johnwright.me/blog
// This code is live @ 
// http://johnwright.me/code-examples/sparql-query-in-code-rest-php-and-json-tutorial.php
session_start();
require_once( "sparqllib.php" );
require_once( "function.php" );
 ini_set('max_execution_time', 300);

 if(!isset($_SESSION['offset'])){
	$_SESSION['offset']=0;
 }
if(isset($_GET['type'])){
	if($_GET['type']==1){
		$_SESSION['offset']=$_SESSION['offset']+5;	
		$offset=$_SESSION['offset'];
	}
	else if(($_GET['type']==0)&&($_SESSION['offset']>4)){
	$_SESSION['offset']=$_SESSION['offset']-5;
	$offset=$_SESSION['offset'];
	}
	else if($_GET['type']==10){
		$_SESSION['offset']=0;
		$offset=$_SESSION['offset'];
	}
	else  $offset=0;
 }
$db = sparql_connect( "http://www.linkedmdb.org/sparql" );
//$db1 = sparql_connect( "http://dbpedia.org/sparql"  );

if( !$db ) { print sparql_errno() . ": " . sparql_error(). "\n"; exit; }
sparql_ns( "foaf","http://xmlns.com/foaf/0.1/" );
 $text=$_GET['text'];
 $arr_tmp = explode(" ", $text);
 $k=0;
 $arr;
 for($i=0;$i<count($arr_tmp);$i++){
	if(matchArray($arr_tmp[$i],$stopWord)==false)
		$arr[$k++]=$arr_tmp[$i];
 }
 $arr_text;
 $k=0;
 $tt=count($arr);
 for($i=0;$i<$tt;$i++){
	if($i+2<$tt)
		$arr_text[$k++]=$arr[$i]." ".$arr[$i+1]." ".$arr[$i+2];
	if($i+1<$tt)
		$arr_text[$k++]=$arr[$i]." ".$arr[$i+1];
	$arr_text[$k++]=$arr[$i];		
 }
 echo '<div id="group">';
 for($i=0;$i<count($arr_text);$i++){
	echo '<a href="#" onclick= "searchType(\''.$arr_text[$i].'\',100);" class="keyword">'.$arr_text[$i].'</a>';
 }
 echo '<a href="#" onclick= "searchType(\'film\',200);" class="keyword">Film</a>
			<a href="#" onclick= "searchType(\'actor\',200);" class="keyword">Actor</a>
			<a href="#" onclick= "searchType(\'editor\',200);" class="keyword">Editor</a>
			<a href="#" onclick= "searchType(\'director\',200);" class="keyword">Director</a>
			<a href="#" onclick= "searchType(\'writer\',200);" class="keyword">Writer</a></div>';
			
			
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

for($i=0;$i<count($arr_text);$i++){
$tmp=$arr_text[$i];	

$sparql = $prefix."SELECT * WHERE { ?s rdfs:label ?o . {{?s rdf:type movie:actor} UNION {?s rdf:type movie:film}} . ?s rdf:type ?p . ?s owl:sameAs ?page. FILTER regex(str(?page), '^http://dbpedia.org/') . FILTER regex(?o, '$tmp','i') } limit 6 offset ".$offset;
$sparql = $prefix."SELECT * WHERE { ?s rdfs:label ?o . FILTER regex(?o, '$tmp','i'). ?s foaf:page ?url} limit 4 offset ".$offset;
if((isset($_GET['key']))){
	if(($_GET['key']=="film"))
		$sparql = $prefix."SELECT * WHERE { ?s rdfs:label ?o . FILTER regex(?o, '$tmp','i'). ?s foaf:page ?url. ?s rdf:type movie:film} offset ".$offset;
	if($_GET['key']=="actor")
		$sparql = $prefix."SELECT * WHERE { ?s rdfs:label ?o . FILTER regex(?o, '$tmp','i'). ?s foaf:page ?url. ?s rdf:type movie:actor} offset ".$offset;
if($_GET['key']=="editor")
		$sparql = $prefix."SELECT * WHERE { ?s rdfs:label ?o . FILTER regex(?o, '$tmp','i'). ?s foaf:page ?url. ?s rdf:type movie:editor} offset ".$offset;	
if($_GET['key']=="director")
		$sparql = $prefix."SELECT * WHERE { ?s rdfs:label ?o . FILTER regex(?o, '$tmp','i'). ?s foaf:page ?url. ?s rdf:type movie:director} offset ".$offset;	
if($_GET['key']=="writer")
		$sparql = $prefix."SELECT * WHERE { ?s rdfs:label ?o . FILTER regex(?o, '$tmp','i'). ?s foaf:page ?url. ?s rdf:type movie:writer} offset ".$offset;			
}

$result[$i] = sparql_query( $sparql ); 
if( !$result[$i] ) { print sparql_errno() . ": " . sparql_error(). "\n"; exit; }	
//$json = getJson($sparql);

while( $row = sparql_fetch_array( $result[$i] ))
{
	$url = $row["url"];
	if(strpos($url,"freebase")==0) continue;
	$url = str_replace("http://www.freebase.com/view","",$url);
	
		$name = $row["o"];
		getFreeBase($url,$row["s"]);
			
}



}


function getFreeBase($id,$s){
	$freebase_api_key='AIzaSyDZXndLh8k1vpqvtrUPHHVerkEo0Qz98tQ';
  $service_url = 'https://www.googleapis.com/freebase/v1/topic';
  $topic_id = $id;
  $params = array('key'=>$freebase_api_key);
  $url = $service_url . $topic_id . '?' . http_build_query($params);
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  $topic = json_decode(curl_exec($ch), true);
  curl_close($ch);
	$name="";
     $img="";
	 $des="";
	 $type="";
   if(isset($topic['property']['/type/object/name']['values'][0]['text'])) 
	$name = $topic['property']['/type/object/name']['values'][0]['text'];
   if(isset( $topic['property']['/common/topic/description']['values'][0]['text']))		
	$des = $topic['property']['/common/topic/description']['values'][0]['text'];
   if(isset($topic['property']['/common/topic/image']['values'][0]['id']))
	 $img='<img src="https://usercontent.googleapis.com/freebase/v1/image'.$topic['property']['/common/topic/image']['values'][0]['id'].'"/>';
	// echo $name.$des;
	$c = array("foo", "bar", "baz", "blong");
	$arr_test["anh"]["x"]=2;
	$arr_test["anh"]["y"]=20;
	$arr_test["anh1"]["y"]=3;
	$arr_test["anh1"]["x"]=30;
	echo "";
   if(isset($topic['property']['/common/topic/notable_types']['values'][0]['text']))
		$type=$topic['property']['/common/topic/notable_types']['values'][0]['text'];  
	 if($name!="")
		echo '
						<li >
						<div class="post-info">
								<div class="post-basic-info">
								'.$img.'
									<h3><a onclick="showPopup(\''.$id.'\',\''.rawurlencode(json_encode($arr_test, JSON_FORCE_OBJECT)).'\');" href="#">'.$name.'</a>
									<a href="#"  onclick="addExSearch(\''.rawurlencode($name).'\',\''.$s.'\');">Add Seach</a></h3>
									<span><a href="#"><label> </label>'.$type.'</a></span>
									<p>'.$des.'</p>
								</div>
							</div>
						</li>';   

}  


?>