<?php
session_start();
require_once( "sparqllib.php" );
	require_once( "function.php" );
	 ini_set('max_execution_time', 3000);
 $db = sparql_connect( "http://www.linkedmdb.org/sparql" );

if( !$db ) { print sparql_errno() . ": " . sparql_error(). "\n"; exit; }
sparql_ns( "foaf","http://xmlns.com/foaf/0.1/" );
	if(isset($_GET['uri'])){
		getFBSimpleSearch($_GET['uri']);
	}
	if(isset($_GET['key'])){
		$uri=$_GET['key'];
		$prefix="http://www.linkedmdb.org/sparql?query=PREFIX+owl%3A+%3Chttp%3A%2F%2Fwww.w3.org%2F2002%2F07%2Fowl%23%3E%0D%0APREFIX+xsd%3A+%3Chttp%3A%2F%2Fwww.w3.org%2F2001%2FXMLSchema%23%3E%0D%0APREFIX+rdfs%3A+%3Chttp%3A%2F%2Fwww.w3.org%2F2000%2F01%2Frdf-schema%23%3E%0D%0APREFIX+rdf%3A+%3Chttp%3A%2F%2Fwww.w3.org%2F1999%2F02%2F22-rdf-syntax-ns%23%3E%0D%0APREFIX+foaf%3A+%3Chttp%3A%2F%2Fxmlns.com%2Ffoaf%2F0.1%2F%3E%0D%0APREFIX+oddlinker%3A+%3Chttp%3A%2F%2Fdata.linkedmdb.org%2Fresource%2Foddlinker%2F%3E%0D%0APREFIX+map%3A+%3Cfile%3A%2FC%3A%2Fd2r-server-0.4%2Fmapping.n3%23%3E%0D%0APREFIX+db%3A+%3Chttp%3A%2F%2Fdata.linkedmdb.org%2Fresource%2F%3E%0D%0APREFIX+dbpedia%3A+%3Chttp%3A%2F%2Fdbpedia.org%2Fproperty%2F%3E%0D%0APREFIX+skos%3A+%3Chttp%3A%2F%2Fwww.w3.org%2F2004%2F02%2Fskos%2Fcore%23%3E%0D%0APREFIX+dc%3A+%3Chttp%3A%2F%2Fpurl.org%2Fdc%2Fterms%2F%3E%0D%0APREFIX+movie%3A+%3Chttp%3A%2F%2Fdata.linkedmdb.org%2Fresource%2Fmovie%2F%3E%0D%0A";
		$query = "SELECT * WHERE {<$uri> foaf:page ?url}";	
		$query=urlencode($query);
		$query=str_replace("%2A","*",$query);
		$url = $prefix.$query."&output=json";
		 $str = file_get_contents($url);
		$json = json_decode($str, true);
		foreach($json['results']['bindings'] as $item)
		if(strpos($item['url']['value'],"freebase")!=0){
			getFBSimpleSearch(str_replace("http://www.freebase.com/view","",$item['url']['value']));
		} 
	}
	

?>