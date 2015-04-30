<?php
	//-------------funtion--------------------//
	$movieType = array ("http://data.linkedmdb.org/resource/movie/actor",
	"http://data.linkedmdb.org/resource/movie/film",
	"http://data.linkedmdb.org/resource/movie/editor",
	"http://data.linkedmdb.org/resource/movie/director",
	"http://data.linkedmdb.org/resource/movie/music_contributor",
	"http://data.linkedmdb.org/resource/movie/performance",
	"http://data.linkedmdb.org/resource/movie/producer",
	"http://data.linkedmdb.org/resource/movie/writer"
	);
	$stopWord =array("a","about","above","after","again","against","all","am","an","and","any","are","aren't","as",
			"at","be","because","been","before","being","below","between","both","but","by","can't","cannot","could",
			"couldn't","did","didn't","do","does","doesn't","doing","don't","down","during","each","few","for","from",
			"further","had","hadn't","has","hasn't","have","haven't","having","he","he'd","he'll","he's","her",
			"here","here's","hers","herself","him","himself","his","how","how's","i","i'd","i'll","i'm","i've","if","in",
			"into","is","isn't","it","it's","its","itself","let's","me","more","most","mustn't","my","myself","no","nor",
			"not","of","off","on","once","only","or","other","ought","our","ours", 	"ourselves","out","over","own","same",
			"shan't","she","she'd","she'll","she's","should","shouldn't","so","some","such","than","that","that's","the",
			"their","theirs","them","themselves","then","there","there's","these","they","they'd","they'll","they're",
			"they've","this","those","through","to","too","under","until","up","very","was","wasn't","we","we'd","we'll",
			"we're","we've","were","weren't","what","what's","when","when's","where","where's","which","while","who",
			"who's","whom","why","why's","with","won't","would","wouldn't","you","you'd","you'll","you're","you've",
			"your","yours","yourself","yourselves"
		);
function matchArray($x, $arr){
	for($i=0;$i<count($arr);$i++){
		if($x==$arr[$i])
			return true;
	}
	return false;
}		
function getJson($query){
	$prefix="http://www.linkedmdb.org/sparql?query=PREFIX+owl%3A+%3Chttp%3A%2F%2Fwww.w3.org%2F2002%2F07%2Fowl%23%3E%0D%0APREFIX+xsd%3A+%3Chttp%3A%2F%2Fwww.w3.org%2F2001%2FXMLSchema%23%3E%0D%0APREFIX+rdfs%3A+%3Chttp%3A%2F%2Fwww.w3.org%2F2000%2F01%2Frdf-schema%23%3E%0D%0APREFIX+rdf%3A+%3Chttp%3A%2F%2Fwww.w3.org%2F1999%2F02%2F22-rdf-syntax-ns%23%3E%0D%0APREFIX+foaf%3A+%3Chttp%3A%2F%2Fxmlns.com%2Ffoaf%2F0.1%2F%3E%0D%0APREFIX+oddlinker%3A+%3Chttp%3A%2F%2Fdata.linkedmdb.org%2Fresource%2Foddlinker%2F%3E%0D%0APREFIX+map%3A+%3Cfile%3A%2FC%3A%2Fd2r-server-0.4%2Fmapping.n3%23%3E%0D%0APREFIX+db%3A+%3Chttp%3A%2F%2Fdata.linkedmdb.org%2Fresource%2F%3E%0D%0APREFIX+dbpedia%3A+%3Chttp%3A%2F%2Fdbpedia.org%2Fproperty%2F%3E%0D%0APREFIX+skos%3A+%3Chttp%3A%2F%2Fwww.w3.org%2F2004%2F02%2Fskos%2Fcore%23%3E%0D%0APREFIX+dc%3A+%3Chttp%3A%2F%2Fpurl.org%2Fdc%2Fterms%2F%3E%0D%0APREFIX+movie%3A+%3Chttp%3A%2F%2Fdata.linkedmdb.org%2Fresource%2Fmovie%2F%3E%0D%0A";

	$query=urlencode($query);
	$query=str_replace("%2A","*",$query);
	$url = $prefix.$query."&output=json";
	//SELECT+*+WHERE+%7B%3Fs+%3Fo+%3Fp%7D+LIMIT+10&output=json
	$str = file_get_contents($url);
	$json = json_decode($str, true);
	
	return $json;
	}
function cutinfo($string,$len)
{
    if($len > strlen($string)){$len=strlen($string);};
    $pos = strpos($string, ' ', $len);
    if($pos){$string = substr($string,0,$pos);}else{$string = substr($string,0,$len);}    
    return $string;
}
function getFBSimpleSearch($id){
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
	$des = $topic['property']['/common/topic/description']['values'][0]['value'];
   if(isset($topic['property']['/common/topic/image']['values'][0]['id']))
	 $img='<img src="https://usercontent.googleapis.com/freebase/v1/image'.$topic['property']['/common/topic/image']['values'][0]['id'].'"/>';
	// echo $name.$des;
	echo "";
   if(isset($topic['property']['/common/topic/notable_types']['values'][0]['text']))
		$type=$topic['property']['/common/topic/notable_types']['values'][0]['text'];  
	 if($name!="")
		echo '
						<li><div class="post-info">
								<div class="post-basic-info">
								'.$img.'
									<h3><a href="#">'.$name.'</a>
									<span><a href="#"><label> </label>'.$type.'</a></span>
									<p>'.$des.'</p>
								</div>
							</div>
						</li>'; 
}

function Dbpedia_getinfo($url){
	$db = sparql_connect( "http://dbpedia.org/sparql" );
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
			."PREFIX dbpedia-owl: <http://dbpedia.org/ontology/>"
			."PREFIX dc: <http://purl.org/dc/terms/>";
if( !$db ) { print sparql_errno() . ": " . sparql_error(). "\n"; exit; }
sparql_ns( "foaf","http://xmlns.com/foaf/0.1/" );
$sparql = $prefix."SELECT * WHERE { <".$url."> foaf:isPrimaryTopicOf ?o  }";
$result = sparql_query( $sparql ); 
if( !$result ) { print sparql_errno() . ": " . sparql_error(). "\n"; exit; }
 $row = sparql_fetch_array( $result );
 return $row["o"];
}
function Dbpedia_getthumbal($url){
$db = sparql_connect( "http://dbpedia.org/sparql" );
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
			."PREFIX dbpedia-owl: <http://dbpedia.org/ontology/>"
			."PREFIX dc: <http://purl.org/dc/terms/>";
if( !$db ) { print sparql_errno() . ": " . sparql_error(). "\n"; exit; }
sparql_ns( "foaf","http://xmlns.com/foaf/0.1/" );
$sparql = $prefix."SELECT * WHERE { <".$url."> dbpedia-owl:thumbnail ?o  }";
$result = sparql_query( $sparql ); 
if( !$result ) { print sparql_errno() . ": " . sparql_error(). "\n"; exit; }
 $row = sparql_fetch_array( $result );
 return $row["o"];
}
function DBpedia_comment($url){
if($url=="") return;
$db = sparql_connect( "http://dbpedia.org/sparql" );
 $prefix = "PREFIX dbpedia-owl: <http://dbpedia.org/ontology/>";
if( !$db ) { print sparql_errno() . ": " . sparql_error(). "\n"; exit; }
sparql_ns( "foaf","http://xmlns.com/foaf/0.1/" );
$sparql = $prefix."SELECT * WHERE { <".$url."> dbpedia-owl:abstract ?o  }";
$result = sparql_query( $sparql ); 
if( !$result ) { print sparql_errno() . ": " . sparql_error(). "\n"; exit; }
 $row = sparql_fetch_array( $result );
 return $row["o"];
}

function IsPageExist($url){
			$headers = @get_headers($url);
			if(strpos($headers[0],'404') === false)
			{
			  return true;
			}
			else
			{
			  return false;
			}
}
?>