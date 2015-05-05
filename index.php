<?php
session_start();
?>
<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
	<head>
		<title>Expolatory Search</title>
		<link href="css/style.css" rel='stylesheet' type='text/css' />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" type="image/x-icon" href="images/fav-icon.png" />
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
		</script>
		<script type="text/javascript">
//window.alert = function() {};
//alert = function(){};
window.onerror=function(msg, url, linenumber){
 alert('Error message: '+msg+'\nURL: '+url+'\nLine Number: '+linenumber)
 return true
}
</script>
		<!----webfonts---->
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
		<!----//webfonts---->
		<!-- Global CSS for the page and tiles -->
  		<link rel="stylesheet" href="css/main.css">
  		<!-- //Global CSS for the page and tiles -->
		<!---start-click-drop-down-menu----->
		<script src="js/jquery.min.js"></script>
        <!----start-dropdown--->
         <script type="text/javascript">
			var $ = jQuery.noConflict();
				$(function() {
					$('#activator').click(function(){
						$('#box').animate({'top':'0px'},500);
					});
					$('#boxclose').click(function(){
					$('#box').animate({'top':'-700px'},500);
					});
				});
				$(document).ready(function(){
				//Hide (Collapse) the toggle containers on load
				$(".toggle_container").hide(); 
				//Switch the "Open" and "Close" state per click then slide up/down (depending on open/close state)
				$(".trigger").click(function(){
					$(this).toggleClass("active").next().slideToggle("slow");
						return false; //Prevent the browser jump to the link anchor
				});
									
			});
		</script>
        <!----//End-dropdown--->
		<!---//End-click-drop-down-menu----->
		<script>
		
		//Kiem tra xem tu co phai stop Word khong
		function checkStopWord(word){
			
				var stopWord =["a","about","above","after","again","against","all","am","an","and","any","are","aren't","as",
					"at","be","because","been","before","being","below","between","both","but","by","can't","cannot","could",
					"couldn't","did","didn't","do","does","doesn't","doing","don't","down","during","each","few","for","from",
					"further","had","hadn't","has","hasn't","have","haven't","having","he","he'd","he'll","he's","her",
					"here","here's","hers","herself","him","himself","his","how","how's","i","i'd","i'll","i'm","i've","if","in","into","is","isn't","it","it's","its","itself","let's","me","more","most","mustn't","my","myself","no","nor","not","of","off","on","once","only","or","other","ought","our","ours", 	"ourselves","out","over","own","same","shan't","she","she'd","she'll","she's","should","shouldn't","so","some","such","than","that","that's","the","their","theirs","them","themselves","then","there","there's","these","they","they'd","they'll","they're","they've","this","those","through","to","too","under","until","up","very","was","wasn't","we","we'd","we'll","we're","we've","were","weren't","what","what's","when","when's","where","where's","which","while","who","who's","whom","why","why's","with","won't","would","wouldn't","you","you'd","you'll","you're","you've","your","yours","yourself","yourselves"
				];
			for(var i=0;i<stopWord.length;i++)
				if(stopWord[i] == word)
					return true;
				return false;
	}

	//mo rong truy van voi uri va kieu dau vao
		function getInfoFromType(key, type){
		if(type=="movie:film"){
			type=key.replace("http://data.linkedmdb.org/resource/","");
			var ind = parseInt(type.indexOf("\/"));
			type = type.slice(0,ind);
			type="movie:"+type;
			alert(type+key);
		}
			prefix ="http://www.linkedmdb.org/sparql?query=PREFIX+owl%3A+%3Chttp%3A%2F%2Fwww.w3.org%2F2002%2F07%2Fowl%23%3E%0D%0APREFIX+xsd%3A+%3Chttp%3A%2F%2Fwww.w3.org%2F2001%2FXMLSchema%23%3E%0D%0APREFIX+rdfs%3A+%3Chttp%3A%2F%2Fwww.w3.org%2F2000%2F01%2Frdf-schema%23%3E%0D%0APREFIX+rdf%3A+%3Chttp%3A%2F%2Fwww.w3.org%2F1999%2F02%2F22-rdf-syntax-ns%23%3E%0D%0APREFIX+foaf%3A+%3Chttp%3A%2F%2Fxmlns.com%2Ffoaf%2F0.1%2F%3E%0D%0APREFIX+oddlinker%3A+%3Chttp%3A%2F%2Fdata.linkedmdb.org%2Fresource%2Foddlinker%2F%3E%0D%0APREFIX+map%3A+%3Cfile%3A%2FC%3A%2Fd2r-server-0.4%2Fmapping.n3%23%3E%0D%0APREFIX+db%3A+%3Chttp%3A%2F%2Fdata.linkedmdb.org%2Fresource%2F%3E%0D%0APREFIX+dbpedia%3A+%3Chttp%3A%2F%2Fdbpedia.org%2Fproperty%2F%3E%0D%0APREFIX+skos%3A+%3Chttp%3A%2F%2Fwww.w3.org%2F2004%2F02%2Fskos%2Fcore%23%3E%0D%0APREFIX+dc%3A+%3Chttp%3A%2F%2Fpurl.org%2Fdc%2Fterms%2F%3E%0D%0APREFIX+movie%3A+%3Chttp%3A%2F%2Fdata.linkedmdb.org%2Fresource%2Fmovie%2F%3E%0D%0A";
			var query = "SELECT * WHERE {{<"+key+"> "+type+" ?s}UNION{?s "+type+"<"+key+"> }. ?s foaf:page ?url}";	
			//alert(query);
			var uri = prefix+encodeURIComponent(query).replace(/%20/g,'+')+"&output=json";
		//$("#functionAResult").append(uri+"</br>");
				//alert(query);
							$.ajax({
									type:     "GET",
									url:      uri, // <-- Here
									dataType: "jsonp",
									beforeSend: function (jqXHR) {
													jqXHR.key = "aa";
									},
									success:function(data, textStatus, jqXHR){	
									
									document.getElementById("loading").style.display = 'none';
									$("#abc").fadeIn("slow");
									$(".alert-box").fadeOut();
									
									//$("#abc").append(JSON.stringify(data));
								 		var arr = data['results']['bindings'];
									 for(var i=0;i<arr.length;i++)
										if(arr[i]['url']['value'].search("freebase")!=-1){
											//alert(arr[i]['s']['value']);
											var page = arr[i]["url"]["value"].replace("http://www.freebase.com/view","");
											var uri = "https://www.googleapis.com/freebase/v1/topic"+page+"?key=AIzaSyDZXndLh8k1vpqvtrUPHHVerkEo0Qz98tQ";
											 $.ajax({
												type:     "GET",
												url:      uri, // <-- Here
												dataType: 'json',
												beforeSend: function (jqXHR) {
																jqXHR.key = arr[i]['s']['value'];
																jqXHR.uri = uri;
												},
												success:function(data, textStatus, jqXHR){	
												var name,img,type,des;
												type="";												
												if(data.property['/type/object/name']!= undefined )
													name = data.property['/type/object/name'].values[0].text;
												else name="";
												if(data.property['/type/object/type']!= undefined ){
														for(var k=0;k<data.property['/type/object/type'].values.length;k++){
															var tmp = data.property['/type/object/type'].values[k].text;
															if((tmp.search("Film")!=-1)||(tmp.search("actor")!=-1)||
															(tmp.search("editor")!=-1)||(tmp.search("writer")!=-1)||
															(tmp.search("director")!=-1)||(tmp.search("producer")!=-1))
															if(type=="")
																type = type +"\""+ tmp +"\"";
															else
																type = type +"-\""+ tmp +"\"";
														}
													}
												else type="...";
												if(data.property['/common/topic/description']!= undefined )
													des = data.property['/common/topic/description'].values[0].text;
												else des="";
												  if(data.property['/common/topic/image']!= undefined )
													img ='<img src="https://usercontent.googleapis.com/freebase/v1/image'+data.property['/common/topic/image']['values'][0]['id']+'?key=AIzaSyDZXndLh8k1vpqvtrUPHHVerkEo0Qz98tQ"/>';
													//img =data.property['/common/topic/image']['values'][0]['id'];
												else img=""; 
												//img = ""; 
												//img = data.property['/type/object/name'].values[0].text;
												if(name!=""&&des!="")
												str = '<li><div class="post-info">'
														+img
														+'<div class="post-basic-info">'
														+'	<h3><a href="#" onclick="showPopup(\''+jqXHR.uri+'\');" >'+name+'</a>'
														+'<a href="#"  onclick="addExSearch(\''+encodeURIComponent(name)+'\',\''+jqXHR.key+'\',\''+jqXHR.uri+'\');">Add Seach</a>'
														+'	<span><a href="#"><label> </label>'+type+'</a></span>'
														+'	<p>'+des+'</p>'
														+'</div>'
													+'</div>'
												+'</li>';
												else str="";
													$("#top_box").show();
													$("#topsearch").prepend(str);
																								
												} 
											});	 
										}
									 } 
								});	
				
		}
		
		//Phan tich va tim kiem thuc the
			function search(type){
			$("#loading").fadeIn("slow");
			
				$("#topsearch").html("");			
				$("#allsearch").html("");
				document.getElementById("abc").style.display = 'none';
				str = document.getElementById("text_search").value;
		
				prefix ="http://www.linkedmdb.org/sparql?query=PREFIX+owl%3A+%3Chttp%3A%2F%2Fwww.w3.org%2F2002%2F07%2Fowl%23%3E%0D%0APREFIX+xsd%3A+%3Chttp%3A%2F%2Fwww.w3.org%2F2001%2FXMLSchema%23%3E%0D%0APREFIX+rdfs%3A+%3Chttp%3A%2F%2Fwww.w3.org%2F2000%2F01%2Frdf-schema%23%3E%0D%0APREFIX+rdf%3A+%3Chttp%3A%2F%2Fwww.w3.org%2F1999%2F02%2F22-rdf-syntax-ns%23%3E%0D%0APREFIX+foaf%3A+%3Chttp%3A%2F%2Fxmlns.com%2Ffoaf%2F0.1%2F%3E%0D%0APREFIX+oddlinker%3A+%3Chttp%3A%2F%2Fdata.linkedmdb.org%2Fresource%2Foddlinker%2F%3E%0D%0APREFIX+map%3A+%3Cfile%3A%2FC%3A%2Fd2r-server-0.4%2Fmapping.n3%23%3E%0D%0APREFIX+db%3A+%3Chttp%3A%2F%2Fdata.linkedmdb.org%2Fresource%2F%3E%0D%0APREFIX+dbpedia%3A+%3Chttp%3A%2F%2Fdbpedia.org%2Fproperty%2F%3E%0D%0APREFIX+skos%3A+%3Chttp%3A%2F%2Fwww.w3.org%2F2004%2F02%2Fskos%2Fcore%23%3E%0D%0APREFIX+dc%3A+%3Chttp%3A%2F%2Fpurl.org%2Fdc%2Fterms%2F%3E%0D%0APREFIX+movie%3A+%3Chttp%3A%2F%2Fdata.linkedmdb.org%2Fresource%2Fmovie%2F%3E%0D%0A";
				var arrKey = [];
				var arrType = [];
				var res = str.split(" ");
				var count=0;
				for(var i=0;i<res.length;i++){
					if(i+2<res.length)
						arrKey.push({key:count++,value:res[i]+" "+res[i+1]+" "+res[i+2]});
					if(i+1<res.length)
						arrKey.push({key:count++,value:res[i]+" "+res[i+1]});
					arrKey.push({key:count++,value:res[i]});	
				}
				//module mo rong tu tim kiem voi cac tu khoa de xac dinh kieu
				for(var i=0;i<arrKey.length;i++){
				if(checkStopWord(arrKey[i].value)) continue;
					if(arrKey[i].value == "actor"){
						arrType.push({type:"movie:actor"});
					}
					if(arrKey[i].value == "film"){
						arrType.push({type:"movie:film"});
					}
					if(arrKey[i].value == "editor"){
						arrType.push({type:"movie:editor"});
					}
					if(arrKey[i].value == "director"){
						arrType.push({type:"movie:director"});
					}
					if(arrKey[i].value == "writer"){
						arrType.push({type:"movie:writer"});
					}
					if(arrKey[i].value == "producer"){
						arrType.push({type:"movie:producer"});
					}
				}
				//tim kiem thuc the
				for(var i=0;i<arrKey.length;i++){
				if(checkStopWord(arrKey[i].value)) continue;
				//	Tim kiem thuc the chinh xac
			    var query = "SELECT * WHERE { {{?s dc:title '"+arrKey[i].value+"'} UNION {?s movie:actor_name '"+arrKey[i].value+"'} UNION {?s movie:editor_name '"+arrKey[i].value+"'} UNION {?s movie:director_name '"+arrKey[i].value+"'} UNION {?s movie:writer_name '"+arrKey[i].value+"'} UNION {?s movie:producer_name '"+arrKey[i].value+"'}}. ?s foaf:page ?url.?s rdfs:label ?label}";		
				
						var uri = prefix+encodeURIComponent(query).replace(/%20/g,'+')+"&output=json";
							$.ajax({
									type:     "GET",
									url:      uri, // <-- Here
									dataType: "jsonp",
									beforeSend: function (jqXHR) {
													jqXHR.key = arrKey[i].value;
									},
									success:function(data, textStatus, jqXHR){
									document.getElementById("loading").style.display = 'none';
									$("#abc").fadeIn("slow");
									$(".alert-box").fadeOut();
								 		var arr = data['results']['bindings'];
									 for(var i=0;i<arr.length;i++)
										if(arr[i]['url']['value'].search("freebase")!=-1){
											//alert(arr[i]['s']['value']);
											if(arrType.length>0)
											for(var j=0;j<arrType.length;j++)
											{
												getInfoFromType(arr[i]['s']['value'], arrType[j].type);
											}
											var page = arr[i]["url"]["value"].replace("http://www.freebase.com/view","");
											var uri = "https://www.googleapis.com/freebase/v1/topic"+page+"?key=AIzaSyDZXndLh8k1vpqvtrUPHHVerkEo0Qz98tQ";
											 $.ajax({
												type:     "GET",
												url:      uri, // <-- Here
												dataType: 'json',
												beforeSend: function (jqXHR) {
																jqXHR.key = arr[i]['s']['value'];
																jqXHR.name = arr[i]['label']['value'];
																jqXHR.uri = uri;
												},
												success:function(data, textStatus, jqXHR){	
												var name,img,type,des;
												type="";
												if(data.property['/type/object/name']!= undefined )
													name = data.property['/type/object/name'].values[0].text;
												else name="";
												if(data.property['/type/object/type']!= undefined ){
														for(var k=0;k<data.property['/type/object/type'].values.length;k++){
															var tmp = data.property['/type/object/type'].values[k].text;
															if((tmp.search("Film")!=-1)||(tmp.search("actor")!=-1)||
															(tmp.search("editor")!=-1)||(tmp.search("writer")!=-1)||
															(tmp.search("director")!=-1)||(tmp.search("producer")!=-1))
															if(type=="")
																type = type +"\""+ tmp +"\"";
															else
																type = type +"-\""+ tmp +"\"";
														}
													}
												else type="...";
												if(data.property['/common/topic/description']!= undefined )
													des = data.property['/common/topic/description'].values[0].text;
												else des="";
												  if(data.property['/common/topic/image']!= undefined )
													img ='<img src="https://usercontent.googleapis.com/freebase/v1/image'+data.property['/common/topic/image']['values'][0]['id']+'?key=AIzaSyDZXndLh8k1vpqvtrUPHHVerkEo0Qz98tQ"/>';
													//img =data.property['/common/topic/image']['values'][0]['id'];
												else img=""; 
												//img = ""; 
												//img = data.property['/type/object/name'].values[0].text;
												if(name!=""&&des!="")
												str = '<li><div class="post-info">'
														+img
														+'<div class="post-basic-info">'
														+'	<h3><a href="#" onclick="showPopup(\''+jqXHR.uri+'\');" >'+jqXHR.name+'</a>'
														+'<a href="#"  onclick="addExSearch(\''+encodeURIComponent(name)+'\',\''+jqXHR.key+'\',\''+jqXHR.uri+'\');">Add Seach</a>'
														+'	<span><a href="#"><label> </label>'+type+'</a></span>'
														+'	<p>'+des+'</p>'
														+'</div>'
													+'</div>'
												+'</li>';
												else str="";
												
													$("#top_box").show();
													$("#topsearch").append(str);
																					
												} 
											});	 
										}
									 } 
								});	
	
				//tim kiem thuc the mo rong
				var query = "SELECT * WHERE { ?s rdfs:label ?o . FILTER regex(?o, '"+res[i]+"','i'). ?s foaf:page ?url} limit 16";	
				var uri = prefix+encodeURIComponent(query).replace(/%20/g,'+')+"&output=json";
							$.ajax({
									type:     "GET",
									url:      uri, // <-- Here
									dataType: "jsonp",
									beforeSend: function (jqXHR) {
													jqXHR.key = "aa";
									},
									success:function(data, textStatus, jqXHR){	
									
									document.getElementById("loading").style.display = 'none';
									$("#abc").fadeIn("slow");
									
									//$("#abc").append(JSON.stringify(data));
									var arr;
									if(data['results']['bindings']!= undefined)
								 		arr = data['results']['bindings'];
									 for(var i=0;i<arr.length;i++)
										if(arr[i]['url']['value'].search("freebase")!=-1){
											//alert(arr[i]['s']['value']);
											var page = arr[i]["url"]["value"].replace("http://www.freebase.com/view","");
											var uri = "https://www.googleapis.com/freebase/v1/topic"+page+"?key=AIzaSyDZXndLh8k1vpqvtrUPHHVerkEo0Qz98tQ";
											 $.ajax({
												type:     "GET",
												url:      uri, // <-- Here
												dataType: 'json',
												beforeSend: function (jqXHR) {
																jqXHR.key = arr[i]['s']['value'];
																jqXHR.uri = uri;
												},
												success:function(data, textStatus, jqXHR){	
												var name,img,type,des;
												type="";												
												if(data.property['/type/object/name']!= undefined )
													name = data.property['/type/object/name'].values[0].text;
												else name="";
												if(data.property['/type/object/type']!= undefined ){
														for(var k=0;k<data.property['/type/object/type'].values.length;k++){
															var tmp = data.property['/type/object/type'].values[k].text;
															if((tmp.search("Film")!=-1)||(tmp.search("actor")!=-1)||
															(tmp.search("editor")!=-1)||(tmp.search("writer")!=-1)||
															(tmp.search("director")!=-1)||(tmp.search("producer")!=-1))
															if(type=="")
																type = type +"\""+ tmp +"\"";
															else
																type = type +"-\""+ tmp +"\"";
														}
													}
												else type="...";
												if(data.property['/common/topic/description']!= undefined )
													des = data.property['/common/topic/description'].values[0].text;
												else des="...";
												  if(data.property['/common/topic/image']!= undefined )
													img ='<img src="https://usercontent.googleapis.com/freebase/v1/image'+data.property['/common/topic/image']['values'][0]['id']+'?key=AIzaSyDZXndLh8k1vpqvtrUPHHVerkEo0Qz98tQ"/>';
													//img =data.property['/common/topic/image']['values'][0]['id'];
												else img=""; 
												//img = ""; 
												//img = data.property['/type/object/name'].values[0].text;
												if(name!="")
												str = '<li><div class="post-info">'
														+img
														+'<div class="post-basic-info">'
														+'	<h3><a href="#" onclick="showPopup(\''+jqXHR.uri+'\');" >'+name+'</a>'
														+'<a href="#"  onclick="addExSearch(\''+encodeURIComponent(name)+'\',\''+jqXHR.key+'\',\''+jqXHR.uri+'\');">Add Seach</a>'
														+'	<span><a href="#"><label> </label>'+type+'</a></span>'
														+'	<p>'+des+'</p>'
														+'</div>'
													+'</div>'
												+'</li>';
												else str="";
												$("#all_box").show();
												$("#allsearch").append(str);									
												} 
											});	 
										}
									 } 
								});					
				
				}
			}
			
		//	
			function start(){
				document.getElementById("top_search").style.display = 'block';
				$("#a-start").fadeOut();
			}
			
			
			
			function searchType(key,type){
				$("#loading").fadeIn("slow");
				//$("#keySA").html("");
				document.getElementById("abc").style.display = 'none';
				str = document.getElementById("text_search").value;
				if(type==100){
					str=key;
					key="";
				}
				$.ajax({
				type:"get",
				url:"src/sparql_query.php",
				data:"type="+type+"&text="+str+"&key="+key,
				async:true,
				success:function(kq){
				document.getElementById("loading").style.display = 'none';
				$("#abc").fadeIn("slow");				
				$("#abc").html(kq);
				document.getElementById("more").style.display = 'block';
				}
				})
				
				$.ajax({
				type:"get",
				url:"src/sparql_query1.php",
				data:"type="+type+"&text="+str+"&key="+key,
				async:true,
				success:function(kq){			
				$("#abc").html(kq);
				}
				})
			}
</script>

<script language="javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
<script language="javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.min.js"></script>
<script language="javascript">
$(document).ready(function(){
	(function($){
		$.fn.absoluteCenter = function(){
			this.each(function(){
				var top = -($(this).outerHeight() / 2)+'px';
				var left = -($(this).outerWidth() / 2)+'px';
				$(this).css({'position':'absolute', 'position':'fixed', 'margin-top':top, 'margin-left':left, 'top':'50%', 'left':'50%'});
				return this;
			});
		}
	})(jQuery);
	
	$('a#show-popup').click(function(){
		//Ð?t bi?n cho các d?i tu?ng d? g?i d? dàng
		var bg=$('div#popup-bg');
		var obj=$('div#popup');
		var btnClose=obj.find('#popup-close');
		//Hi?n các d?i tu?ng
		bg.animate({opacity:0.2},0).fadeIn(1000); //cho n?n trong su?t
		obj.fadeIn(1000).draggable({cursor:'move',handle:'#popup-header'}).absoluteCenter(); //can gi?a popup và thêm draggable c?a jquery UI cho ph?n header c?a popup
		//Ðóng popup khi nh?n nút
		btnClose.click(function(){
			bg.fadeOut(1000);
			obj.fadeOut(1000);
		});
		//Ðóng popup khi nh?n background
		bg.click(function(){
			btnClose.click(); //K? th?a nút dóng ? trên
		});
		//Ðóng popup khi nh?n nút Esc trên bàn phím
		$(document).keydown(function(e){
			if(e.keyCode==27){
				btnClose.click(); //K? th?a nút dóng ? trên
			}
		});
		return false;
	});
});

function addExSearch(name,key,uri){
	tmp = document.getElementById("rawSAkey").innerHTML;
	if(encodeURIComponent(tmp)=="%0A")
		$("#rawSAkey").html('');
	$("#rawSAkey").append(" "+key);
	str = '<li ><span id="popup-close" title="Close">x</span> <div class="image_title">'+
				'<a href="#" onclick="showPopup(\''+uri+'\');">'+decodeURIComponent(name)+'</a>'+
			'</div>'+
			'<a href="#">'+
				'<img src="images/3yiC6Yq.jpg"/>'+
			'</a>'+
		'</li>';	
	$("#keySA").append(str);		
}
function showPopup(uri){
//var json = decodeURIComponent(value);

$("div#popup-content").html('<div class="loading1"><div></div><div></div><div></div><div></div><div></div></div></div>');
		  /* var topic_id = '/guid/9202a8c04000641f8000000000034e87';
		  topic_id=uri;
		  var service_url = 'https://www.googleapis.com/freebase/v1/topic';
		  var params = {};
		  $.getJSON(service_url + topic_id + '?callback=?', params, function(topic) {
						$("div#popup-content").html('');	
			$('<div>',{text:topic.property['/common/topic/description'].values[0].value}).appendTo("div#popup-content");
			//$('<div>',{text:topic.property['/type/object/name'].values[0].text}).appendTo("div#popup-header");
		  }); */
		   $.ajax({
				type:     "GET",
				url:      uri, // <-- Here
				dataType: 'json',
				success:function(data){
				var name,img,type,des;
												type="";												
				if(data.property['/type/object/name']!= undefined )
					name = data.property['/type/object/name'].values[0].text;
				else name="";
				if(data.property['/type/object/type']!= undefined ){
														for(var k=0;k<data.property['/type/object/type'].values.length;k++){
															var tmp = data.property['/type/object/type'].values[k].text;
															if((tmp.search("Film")!=-1)||(tmp.search("actor")!=-1)||
															(tmp.search("editor")!=-1)||(tmp.search("writer")!=-1)||
															(tmp.search("director")!=-1)||(tmp.search("producer")!=-1))
															if(type=="")
																type = type +"\""+ tmp +"\"";
															else
																type = type +"-\""+ tmp +"\"";
														}
													}
				else type="...";
				if(data.property['/common/topic/description']!= undefined )
					des = data.property['/common/topic/description'].values[0].value;
				else des="...";
				if(data.property['/common/topic/image']!= undefined )
				img ='<img src="https://usercontent.googleapis.com/freebase/v1/image'+data.property['/common/topic/image']['values'][0]['id']+'?key=AIzaSyDZXndLh8k1vpqvtrUPHHVerkEo0Qz98tQ"/>';
				else img=""; 
				if(name!="")
					str = '<li><div class="post-info">'
					+img
					+'<div class="post-basic-info">'
					+'	<h3><a href="#" >'+name+'</a>'
					+'	<span><a href="#"><label> </label>'+type+'</a></span>'
					+'	<p>'+des+'</p>'
					+'</div>'
					+'</div>'
					+'</li>';
					else str="";
				$("#popup-content").html(str);
				}
				});	 
				
		var bg=$('div#popup-bg');
		var obj=$('div#popup');
		var btnClose=obj.find('#popup-close');
		bg.animate({opacity:0.2},0).fadeIn(500); 
		obj.fadeIn(500).draggable({cursor:'move',handle:'#popup-header'}).absoluteCenter(); 
		btnClose.click(function(){
			bg.fadeOut(500);
			obj.fadeOut(500);
		});
		bg.click(function(){
			btnClose.click(); 
		});
		$(document).keydown(function(e){
			if(e.keyCode==27){
				btnClose.click(); 
			}
		});
}

function showPopupEX(uri,key){
		$("div#popup-content").html('<div class="loading1"><div></div><div></div><div></div><div></div><div></div></div></div>');
		   $.ajax({
				type:     "GET",
				url:      uri, // <-- Here
				dataType: 'json',
				beforeSend: function (jqXHR) {
					jqXHR.key = key;
				},
				success:function(data, textStatus, jqXHR){
				$("#popup-content").html("<div id='canvas'></div>");
				var json = getCookie("RelateArr");
				//var xxx = JSON.parse(json_str);
				drawgraph1(json,jqXHR.key);
				var name,img,type,des;
												type="";												
				if(data.property['/type/object/name']!= undefined )
					name = data.property['/type/object/name'].values[0].text;
				else name="";
				if(data.property['/type/object/type']!= undefined ){
														for(var k=0;k<data.property['/type/object/type'].values.length;k++){
															var tmp = data.property['/type/object/type'].values[k].text;
															if((tmp.search("Film")!=-1)||(tmp.search("actor")!=-1)||
															(tmp.search("editor")!=-1)||(tmp.search("writer")!=-1)||
															(tmp.search("director")!=-1)||(tmp.search("producer")!=-1))
															if(type=="")
																type = type +"\""+ tmp +"\"";
															else
																type = type +"-\""+ tmp +"\"";
														}
													}
				else type="...";
				if(data.property['/common/topic/description']!= undefined )
					des = data.property['/common/topic/description'].values[0].value;
				else des="...";
				if(data.property['/common/topic/image']!= undefined )
				img ='<img src="https://usercontent.googleapis.com/freebase/v1/image'+data.property['/common/topic/image']['values'][0]['id']+'?key=AIzaSyDZXndLh8k1vpqvtrUPHHVerkEo0Qz98tQ"/>';
				else img=""; 
				if(name!="")
					str = '<li><div class="post-info">'
					+img
					+'<div class="post-basic-info">'
					+'	<h3><a href="#" >'+name+'</a>'
					+'	<span><a href="#"><label> </label>'+type+'</a></span>'
					+'	<p>'+des+'</p>'
					+'</div>'
					+'</div>'
					+'</li>';
					else str="";
				$("#popup-content").append(str);
				}
				});	 
				
		var bg=$('div#popup-bg');
		var obj=$('div#popup');
		var btnClose=obj.find('#popup-close');
		bg.animate({opacity:0.2},0).fadeIn(500); 
		obj.fadeIn(500).draggable({cursor:'move',handle:'#popup-header'}).absoluteCenter(); 
		btnClose.click(function(){
			bg.fadeOut(500);
			obj.fadeOut(500);
		});
		bg.click(function(){
			btnClose.click(); 
		});
		$(document).keydown(function(e){
			if(e.keyCode==27){
				btnClose.click(); 
			}
		});	
			
}

function showPopupSimple(key){
		//key = "http://data.linkedmdb.org/resource/actor/29625";
			$("div#popup-content").html('<div class="loading1"><div></div><div></div><div></div><div></div><div></div></div></div>');	
		  $.ajax({
				type:"get",
				url:"src/draw_graph.php",
				data:"key="+key,
				async:true,
				success:function(kq){
				var json = decodeURIComponent(kq);
				$("#popup-content").html("<div id='canvas'></div>");
				drawgraph1(json);
				//$("#popup-content").append(json);
				//$("#keySA").fadeIn();	
				//var tmp = document.getElementById("abc").innerHTML;
				//document.getElementById("abc").innerHTML = tmp + kq;				
				//$("#abc").append(kq);
				}
				})
		  
		  $.ajax({
				type:"get",
				url:"src/searchpage.php",
				data:"key="+key,
				async:true,
				success:function(kq){
				//$("#popup-content").html("<div id='canvas'></div>");
				//drawgraph();
				$("#popup-content").append(kq);
				//$("#keySA").fadeIn();	
				//var tmp = document.getElementById("abc").innerHTML;
				//document.getElementById("abc").innerHTML = tmp + kq;				
				//$("#abc").append(kq);
				}
				})	
			
		var bg=$('div#popup-bg');
		var obj=$('div#popup');
		var btnClose=obj.find('#popup-close');
		bg.animate({opacity:0.2},0).fadeIn(500); 
		obj.fadeIn(500).draggable({cursor:'move',handle:'#popup-header'}).absoluteCenter(); 
		btnClose.click(function(){
			bg.fadeOut(500);
			obj.fadeOut(500);
		});
		bg.click(function(){
			btnClose.click(); 
		});
		$(document).keydown(function(e){
			if(e.keyCode==27){
				btnClose.click(); 
			}
		});
}

function sleep(milliseconds) {
  var start = new Date().getTime();
  for (var i = 0; i < 1e7; i++) {
    if ((new Date().getTime() - start) > milliseconds){
      break;
    }
  }
}


function MaxAB(a,b){
		if(a>b)
			return a;
		return b;	
	}
	function MinAB(a,b){
		if(a<b)
			return a;
		return b;	
	}
	function RelateMeasure(A,B,AB){
	
		w= 279676;
		//$b=SearchA($uriB);
		//$a=SearchA($uriA);
		return (Math.log(MaxAB(A,B))-Math.log(AB))/(Math.log(w)-Math.log(MinAB(A,B)));
	}
	function getKeyValueArray(key,arr){
		for(var i=0;i<arr.length;i++)
			if(arr[i].key==key)
				return arr[i].value;
		return 0;
	}
	function setCookie(name, value, expires, path, domain, secure) {
document.cookie = name + "=" + escape(value) +
((expires == null) ? "" : "; expires=" + expires.toGMTString()) +
((path == null) ? "" : "; path=" + path) +
((domain == null) ? "" : "; domain=" + domain) +
((secure == null) ? "" : "; secure");
}
 
// Read cookie
function getCookie(name){
	var cname = name + "=";
	var dc = document.cookie;
	if (dc.length > 0) {
		begin = dc.indexOf(cname);
		if (begin != -1) {
		begin += cname.length;
		end = dc.indexOf(";", begin);
		if (end == -1) end = dc.length;
		return unescape(dc.substring(begin, end));
		}
	}
	return null;
}

function eraseCookie (name,path,domain) {
if (getCookie(name)) {
document.cookie = name + "=" +
((path == null) ? "" : "; path=" + path) +
((domain == null) ? "" : "; domain=" + domain) +
"; expires=Thu, 01-Jan-70 00:00:01 GMT";
}
}

function sortStringDesc(s1, s2){
          return (s1>s2 ? -1 : (s1 < s2 ? 1 : 0));
     }
	 
function exSearch(){
	var pivot = [];
	var arrA = [];
	var arrAB = [];
	var relatedAB = [];
	var arrNameA = [];
	var arrNameB =[];
	var arrNamePivot = [];
	var arrPivot = [];
	var arrShow = [];
	var arrIMDB = [];
	var countAB = 0;
	var countA = 0;
	
	str = document.getElementById("rawSAkey").innerHTML;
	var mode = $("#typeSearchSA").val();	
	var range = $("#range").val();
	var check = document.getElementById("istest");
    if(check.checked == true)
	
	//str = " http://data.linkedmdb.org/resource/film/72";
	str = " http://data.linkedmdb.org/resource/film/837 http://data.linkedmdb.org/resource/film/2115 http://data.linkedmdb.org/resource/actor/57";
	
	if(encodeURIComponent(str)=="%0A"){
		alert("Please Select SA key");
			return;
	}
	
	document.getElementById("more").style.display = 'none';
	document.getElementById("abc").style.marginTop = "10%";
	$("#abc").fadeOut();
	$("#topsearch").html('');
	$("#allsearch").html('');


	$("#loading").fadeIn("slow");
	$("#keySA").fadeOut();
	var res = str.split(" ");
	prefix ="http://www.linkedmdb.org/sparql?query=PREFIX+owl%3A+%3Chttp%3A%2F%2Fwww.w3.org%2F2002%2F07%2Fowl%23%3E%0D%0APREFIX+xsd%3A+%3Chttp%3A%2F%2Fwww.w3.org%2F2001%2FXMLSchema%23%3E%0D%0APREFIX+rdfs%3A+%3Chttp%3A%2F%2Fwww.w3.org%2F2000%2F01%2Frdf-schema%23%3E%0D%0APREFIX+rdf%3A+%3Chttp%3A%2F%2Fwww.w3.org%2F1999%2F02%2F22-rdf-syntax-ns%23%3E%0D%0APREFIX+foaf%3A+%3Chttp%3A%2F%2Fxmlns.com%2Ffoaf%2F0.1%2F%3E%0D%0APREFIX+oddlinker%3A+%3Chttp%3A%2F%2Fdata.linkedmdb.org%2Fresource%2Foddlinker%2F%3E%0D%0APREFIX+map%3A+%3Cfile%3A%2FC%3A%2Fd2r-server-0.4%2Fmapping.n3%23%3E%0D%0APREFIX+db%3A+%3Chttp%3A%2F%2Fdata.linkedmdb.org%2Fresource%2F%3E%0D%0APREFIX+dbpedia%3A+%3Chttp%3A%2F%2Fdbpedia.org%2Fproperty%2F%3E%0D%0APREFIX+skos%3A+%3Chttp%3A%2F%2Fwww.w3.org%2F2004%2F02%2Fskos%2Fcore%23%3E%0D%0APREFIX+dc%3A+%3Chttp%3A%2F%2Fpurl.org%2Fdc%2Fterms%2F%3E%0D%0APREFIX+movie%3A+%3Chttp%3A%2F%2Fdata.linkedmdb.org%2Fresource%2Fmovie%2F%3E%0D%0A";
	if(mode=="simple"){	
	var query = "SELECT distinct ?o WHERE {{<"+res[1]+"> ?p ?o} UNION {?o ?p <"+res[1]+">}}";
	var uri = prefix+encodeURIComponent(query).replace(/%20/g,'+')+"&output=json";
	var expiration = new Date();
	expiration.setTime(expiration.getTime() + 100000000); //Expire after 10 seconds
	setCookie("PivotKey",res[1],expiration);
	$.ajax({
    type:     "GET",
    url:      uri, // <-- Here
    dataType: "jsonp",
    success: function(data){						
		var arr = data['results']['bindings'];
	   $("#loading").fadeOut("slow");
	   $("#abc").fadeIn();
	   
		$("#top_box").show();
		$("#all_box").show();
		
		$("#keySA").fadeIn();
		//tim kiem tat ca thuoc tinh cua thuc the dau tien
		for(i=0;i<arr.length;i++){
			if(arr[i]['o']['type']=="uri")
				if((arr[i]['o']['value'].search("linkedmdb")!=-1)&&(arr[i]['o']['value'].search("interlink")==-1)
				&&(arr[i]['o']['value'].search("film_film_distributor_relationship")==-1)){
					tmp = arr[i]['o']['value'];
					pivot.push({key:tmp,value:tmp});
				}
		}
		//Tinh trong so cua cac thuco tinh cua thuc the dau tien do
		for(i=1;i<res.length;i++){
		query = "SELECT  (COUNT(distinct ?s) AS ?count) WHERE{ {?s ?o <"+res[i]+">} UNION {<"+res[i]+"> ?o ?s}}";
						uri = prefix+encodeURIComponent(query).replace(/%20/g,'+')+"&output=json";
						  $.ajax({
								type:     "GET",
								url:      uri, // <-- Here
								dataType: "jsonp",
								beforeSend: function (jqXHR) {
										jqXHR.key = res[i];
									},
								success:function(data, textStatus, jqXHR){	
									var key = jqXHR.key;
									if(data['results']['bindings'].length>0){	
									var count = data['results']['bindings'][0]['count']['value'];
									arrPivot.push({key:key,value:count});
					}
									 } 
								});
		}
		//Neu chi co 1 thuc the tim kiem thi dua ra cac thuoc tinh cua thuc the do
		if(res.length==2){
		            var count2=0;
            var countb=0,counta=0;

			for(var j=0;j<pivot.length;j++){
			
						query = "SELECT * WHERE {<"+pivot[j].key+"> foaf:page ?url}";
				uri = prefix+encodeURIComponent(query).replace(/%20/g,'+')+"&output=json";	
				//$("#functionAResult").append(uri+"</br");
					$.ajax({
						type:     "GET",
						url:      uri, // <-- Here
						dataType: "jsonp",
						beforeSend: function (jqXHR) {
								jqXHR.key = pivot[j].key;
							},
						success:function(data, textStatus, jqXHR){						
						var key = jqXHR.key;
						if(data == undefined) return;
						var arr = data['results']['bindings'];
							
							
						 for(var i=0;i<arr.length;i++){
						 if(arr[i]['url']['value'].search("imdb.com")!=-1){
							var page = arr[i]["url"]["value"].replace("http://www.imdb.com/title/","");
							page = page.replace("/","");
							var uri = "http://www.omdbapi.com/?i="+page+"&r=json"; 
							$.ajax({
										type:     "GET",
										url:      uri, // <-- Here
										dataType: 'json',
										beforeSend: function (jqXHR) {
											jqXHR.key=key;
										},
										success:function(data, textStatus, jqXHR){
											var x = parseInt(data["imdbRating"]);
											arrIMDB.push({vote:x,page:arr[0]['url']['value'],key:jqXHR.key});
											 //alert(JSON.stringify(arrIMDB.sort(sortStringDesc)));
										}
							});}
							if(arr[i]['url']['value'].search("freebase")!=-1){
								var page = arr[i]["url"]["value"].replace("http://www.freebase.com/view","");
								var uri = "https://www.googleapis.com/freebase/v1/topic"+page+"?key=AIzaSyDZXndLh8k1vpqvtrUPHHVerkEo0Qz98tQ";
								$.ajax({
									type:     "GET",
									url:      uri, // <-- Here
									dataType: 'json',
									beforeSend: function (jqXHR) {
													jqXHR.uri = uri;
													jqXHR.key = key;
									},
									success:function(data, textStatus, jqXHR){	
									var name,img,type,des;
												type="";
									if(data.property['/type/object/name']!= undefined )
													name = data.property['/type/object/name'].values[0].text;
												else name="";
												if(data.property['/type/object/type']!= undefined ){
														for(var k=0;k<data.property['/type/object/type'].values.length;k++){
															var tmp = data.property['/type/object/type'].values[k].text;
															if((tmp.search("Film")!=-1)||(tmp.search("actor")!=-1)||
															(tmp.search("editor")!=-1)||(tmp.search("writer")!=-1)||
															(tmp.search("director")!=-1)||(tmp.search("producer")!=-1))
															if(type=="")
																type = type +"\""+ tmp +"\"";
															else
																type = type +"-\""+ tmp +"\"";
														}
													}
												else type="...";
												if(data.property['/common/topic/description']!= undefined )
													des = data.property['/common/topic/description'].values[0].text;
												else des="...";
												  if(data.property['/common/topic/image']!= undefined )
													img ='<img src="https://usercontent.googleapis.com/freebase/v1/image'+data.property['/common/topic/image']['values'][0]['id']+'?key=AIzaSyDZXndLh8k1vpqvtrUPHHVerkEo0Qz98tQ"/>';
												else img=""; 
												if(name!=""){
										str = '<li><div class="post-info">'
											+img
											+'<div class="post-basic-info">'
											+'	<h3><a href="#" onclick="showPopupEX(\''+jqXHR.uri+'\',\''+jqXHR.key+'\');" >'+name+'</a>'
											+'<a href="#"  onclick="addExSearch(\''+encodeURIComponent(name)+'\',\''+jqXHR.key+'\',\''+jqXHR.uri+'\');">Add Seach</a>'
											+'	<span><a href="#"><label> </label>'+type+'</a></span>'
											+'	<p>'+des+'</p>'
											+'</div>'
											+'</div>'
												+'</li>';
											arrNameB.push({key:jqXHR.key,value:name});
										//	alert(name);
										//alert(JSON.stringify(arrNameB));	
											}
										else str="";
									count2++;
									if(count2==(pivot.length-1)){
									
										if(arrIMDB.length>=2){
											  for(var i=0;i<arrIMDB.length;i++)												for(var j=i+1;j<arrIMDB.length;j++)
												 if(arrIMDB[i].vote<arrIMDB[j].vote){
														 var tmp = arrIMDB[i].vote;
														arrIMDB[i].vote = arrIMDB[j].vote;
														arrIMDB[j].vote= tmp; 
													}
											for(var i=0;i<3;i++){
												if(arrIMDB[i].page!=undefined){
											var page = arrIMDB[i].page.replace("http://www.freebase.com/view","");
											var uri = "https://www.googleapis.com/freebase/v1/topic"+page+"?key=AIzaSyDZXndLh8k1vpqvtrUPHHVerkEo0Qz98tQ";
											$.ajax({
												type:     "GET",
												url:      uri, // <-- Here
												dataType: 'json',
												beforeSend: function (jqXHR) {
																jqXHR.uri = uri;
																jqXHR.key = arrIMDB[i].key;
												},
												success:function(data, textStatus, jqXHR){
												 var name,img,type,des;
												type="";
												 if(data.property['/type/object/name']!= undefined )
																name = data.property['/type/object/name'].values[0].text;
															else name="";
															if(data.property['/type/object/type']!= undefined ){
														for(var k=0;k<data.property['/type/object/type'].values.length;k++){
															var tmp = data.property['/type/object/type'].values[k].text;
															if((tmp.search("Film")!=-1)||(tmp.search("actor")!=-1)||
															(tmp.search("editor")!=-1)||(tmp.search("writer")!=-1)||
															(tmp.search("director")!=-1)||(tmp.search("producer")!=-1))
															if(type=="")
																type = type +"\""+ tmp +"\"";
															else
																type = type +"-\""+ tmp +"\"";
														}
													}
															else type="...";
														if(data.property['/common/topic/description']!= undefined )
																des = data.property['/common/topic/description'].values[0].text;
															else des="...";
													  if(data.property['/common/topic/image']!= undefined )
																img ='<img src="https://usercontent.googleapis.com/freebase/v1/image'+data.property['/common/topic/image']['values'][0]['id']+'?key=AIzaSyDZXndLh8k1vpqvtrUPHHVerkEo0Qz98tQ"/>';
															else img="";  
															if(name!=""){
													str = '<li><div class="post-info">'
														+img
														+'<div class="post-basic-info">'
														+'	<h3><a href="#" onclick="showPopupEX(\''+jqXHR.uri+'\',\''+jqXHR.key+'\');" >'+name+'</a>'
														+'<a href="#"  onclick="addExSearch(\''+encodeURIComponent(name)+'\',\''+jqXHR.key+'\',\''+jqXHR.uri+'\');">Add Seach</a>'
														+'	<span><a href="#"><label> </label>'+type+'</a></span>'
														+'	<p>'+des+'</p>'
														+'</div>'
														+'</div>'
															+'</li>'; 
														}
													else str="";
													$("#topsearch").append(str);									
												} 
											});	
												}
											}											
											
											 }
										 //alert(JSON.stringify(arrIMDB));
									
									}
									
									
									/* if((type.search("film")!=-1)||(type.search("actor")!=-1)||
									(type.search("editor")!=-1)||(type.search("writer")!=-1)||
									(type.search("director")!=-1)||(type.search("producer")!=-1))
									$("#topsearch").append(str); */
									$("#allsearch").append(str);									
									} 
								});	
							}
							}
						}
						});	
			}
		}
		//Neu co hai thuc the tro len thi thuc hien lan truyen
		if(res.length>2)
		for(i=2;i<res.length;i++){
			for(j=0;j<pivot.length;j++){
			
		query = "SELECT  (COUNT(distinct ?s) AS ?count) WHERE{ {{?s ?o <"+res[i]+">} UNION {<"+res[i]+"> ?o ?s}}.{{?s ?o <"+pivot[j].key+">} UNION {<"+pivot[j].key+"> ?o ?s}}}";
		uri = prefix+encodeURIComponent(query).replace(/%20/g,'+')+"&output=json";
		//$("#functionAResult").append(i+","+j+":"+pivot.length+"</br>");
		  $.ajax({
				type:     "GET",
				url:      uri, // <-- Here
				dataType: "jsonp",
				beforeSend: function (jqXHR) {
                        jqXHR.uri1 = res[i];
						jqXHR.uri2 = pivot[j].key;
                    },
				success:function(data, textStatus, jqXHR){
					var uri1 = jqXHR.uri1; 
					var uri2 = jqXHR.uri2; 
					if(data['results']['bindings']!=undefined)
					if(data['results']['bindings'].length>0){
					var count = data['results']['bindings'][0]['count']['value'];
					arrAB.push({key:uri1,key1:uri2,value:count});
					countAB+=1;			
				query = "SELECT * WHERE {<"+uri2+"> foaf:page ?url}";
				uri = prefix+encodeURIComponent(query).replace(/%20/g,'+')+"&output=json";	
				//$("#functionAResult").append(uri+"</br");
					$.ajax({
						type:     "GET",
						url:      uri, // <-- Here
						dataType: "jsonp",
						beforeSend: function (jqXHR) {
								jqXHR.key = uri2;
							},
						success:function(data, textStatus, jqXHR){
						var key = jqXHR.key;
						var arr = data['results']['bindings'];
						 for(var i=0;i<arr.length;i++)
							if(arr[i]['url']['value'].search("freebase")!=-1){
								var page = arr[i]["url"]["value"].replace("http://www.freebase.com/view","");
								var uri = "https://www.googleapis.com/freebase/v1/topic"+page+"?key=AIzaSyDZXndLh8k1vpqvtrUPHHVerkEo0Qz98tQ";
								$.ajax({
									type:     "GET",
									url:      uri, // <-- Here
									dataType: 'json',
									beforeSend: function (jqXHR) {
													jqXHR.uri = uri;
													jqXHR.key = key;
									},
									success:function(data, textStatus, jqXHR){	
									$("#keySA").fadeIn();
									var name,img,type,des;
												type="";
									if(data.property['/type/object/name']!= undefined )
													name = data.property['/type/object/name'].values[0].text;
												else name="";
												if(data.property['/type/object/type']!= undefined ){
														for(var k=0;k<data.property['/type/object/type'].values.length;k++){
															var tmp = data.property['/type/object/type'].values[k].text;
															if((tmp.search("Film")!=-1)||(tmp.search("actor")!=-1)||
															(tmp.search("editor")!=-1)||(tmp.search("writer")!=-1)||
															(tmp.search("director")!=-1)||(tmp.search("producer")!=-1))
															if(type=="")
																type = type +"\""+ tmp +"\"";
															else
																type = type +"-\""+ tmp +"\"";
														}
													}
												else type="...";
												if(data.property['/common/topic/description']!= undefined )
													des = data.property['/common/topic/description'].values[0].text;
												else des="...";
												  if(data.property['/common/topic/image']!= undefined )
													img ='<img src="https://usercontent.googleapis.com/freebase/v1/image'+data.property['/common/topic/image']['values'][0]['id']+'?key=AIzaSyDZXndLh8k1vpqvtrUPHHVerkEo0Qz98tQ"/>';
												else img=""; 
												if(name!=""){
										str = '<li><div class="post-info">'
											+img
											+'<div class="post-basic-info">'
											+'	<h3><a href="#" onclick="showPopupEX(\''+jqXHR.uri+'\',\''+jqXHR.key+'\');" >'+name+'</a>'
											+'<a href="#"  onclick="addExSearch(\''+encodeURIComponent(name)+'\',\''+jqXHR.key+'\',\''+jqXHR.uri+'\');">Add Seach</a>'
											+'	<span><a href="#"><label> </label>'+type+'</a></span>'
											+'	<p>'+des+'</p>'
											+'</div>'
											+'</div>'
												+'</li>';
											arrNameB.push({key:jqXHR.key,value:name});
										//	alert(name);
										//alert(JSON.stringify(arrNameB));	
											}
										else str="";
									$("#topsearch").append(str);									
									} 
								});	
							}
						}
						});						
					//$("#functionAResult").append(uri1+","+uri2+":");					
					//$("#functionAResult").append(data['results']['bindings'][0]['count']['value']+"</br>");
						query = "SELECT  (COUNT(distinct ?s) AS ?count) WHERE{ {?s ?o <"+uri2+">} UNION {<"+uri2+"> ?o ?s}}";
						uri = prefix+encodeURIComponent(query).replace(/%20/g,'+')+"&output=json";
						//$("#functionAResult").append(i+","+j+":"+pivot.length+"</br>");
						if(getKeyValueArray(uri2,arrA)==0)
						  $.ajax({
								type:     "GET",
								url:      uri, // <-- Here
								dataType: "jsonp",
								beforeSend: function (jqXHR) {
										jqXHR.key = uri2;
									},
								success:function(data, textStatus, jqXHR){
									if(data['results']['bindings'].length>0){	
									//$("#functionAResult").append(jqXHR.key+":");					
									//$("#functionAResult").append(data['results']['bindings'][0]['count']['value']+"</br>");
									var count = data['results']['bindings'][0]['count']['value'];
									arrA.push({key:jqXHR.key,value:count});
									countA +=1;
									//$("#functionAResult").append("aa"+countA+"aa"+countAB+"bb");
									 if(countA==countAB){
											$("#functionAResult").append(JSON.stringify(arrAB[0]));
											for(var i=0;i<arrAB.length;i++){
												
												relatedAB.push({key:arrAB[i].key,key1:arrAB[i].key1,value:RelateMeasure(getKeyValueArray(arrAB[i].key,arrPivot),getKeyValueArray(arrAB[i].key1,arrA),arrAB[i].value)}); 									
											}
											eraseCookie("RelateArr");
											var json = JSON.stringify(relatedAB);
											var expiration = new Date();
											expiration.setTime(expiration.getTime() + 100000000); //Expire after 10 seconds
											setCookie("RelateArr",json,expiration);
											/* for(var i=0;i<relatedAB.length;i++){
												$("#functionAResult").append(relatedAB[i].key+relatedAB[i].key1+":"+relatedAB[i].value+"</br>");	
											} */
											
										}
									
									}
									
									 } 
								});	
					}
					
					else{
						query = "SELECT * WHERE {<"+uri2+"> foaf:page ?url}";
				uri = prefix+encodeURIComponent(query).replace(/%20/g,'+')+"&output=json";	
				//$("#functionAResult").append(uri+"</br");
					$.ajax({
						type:     "GET",
						url:      uri, // <-- Here
						dataType: "jsonp",
						beforeSend: function (jqXHR) {
								jqXHR.key = uri2;
							},
						success:function(data, textStatus, jqXHR){
						var key = jqXHR.key;
						if(data==undefined) return;
						var arr = data['results']['bindings'];
						 for(var i=0;i<arr.length;i++)
							if(arr[i]['url']['value'].search("freebase")!=-1){
								var page = arr[i]["url"]["value"].replace("http://www.freebase.com/view","");
								var uri = "https://www.googleapis.com/freebase/v1/topic"+page+"?key=AIzaSyDZXndLh8k1vpqvtrUPHHVerkEo0Qz98tQ";
								$.ajax({
									type:     "GET",
									url:      uri, // <-- Here
									dataType: 'json',
									beforeSend: function (jqXHR) {
													jqXHR.uri = uri;
													jqXHR.key = key;
									},
									success:function(data, textStatus, jqXHR){	
									$("#keySA").fadeIn();
									var name,img,type,des;
												type="";
									if(data.property['/type/object/name']!= undefined )
													name = data.property['/type/object/name'].values[0].text;
												else name="";
												if(data.property['/type/object/type']!= undefined ){
														for(var k=0;k<data.property['/type/object/type'].values.length;k++){
															var tmp = data.property['/type/object/type'].values[k].text;
															if((tmp.search("Film")!=-1)||(tmp.search("actor")!=-1)||
															(tmp.search("editor")!=-1)||(tmp.search("writer")!=-1)||
															(tmp.search("director")!=-1)||(tmp.search("producer")!=-1))
															if(type=="")
																type = type +"\""+ tmp +"\"";
															else
																type = type +"-\""+ tmp +"\"";
														}
													}
												else type="...";
												if(data.property['/common/topic/description']!= undefined )
													des = data.property['/common/topic/description'].values[0].text;
												else des="...";
												  if(data.property['/common/topic/image']!= undefined )
													img ='<img src="https://usercontent.googleapis.com/freebase/v1/image'+data.property['/common/topic/image']['values'][0]['id']+'?key=AIzaSyDZXndLh8k1vpqvtrUPHHVerkEo0Qz98tQ"/>';
												else img=""; 
												if(name!=""){
										str = '<li><div class="post-info">'
											+img
											+'<div class="post-basic-info">'
											+'	<h3><a href="#" onclick="showPopupEX(\''+jqXHR.uri+'\',\''+jqXHR.key+'\');" >'+name+'</a>'
											+'<a href="#"  onclick="addExSearch(\''+encodeURIComponent(name)+'\',\''+jqXHR.key+'\',\''+jqXHR.uri+'\');">Add Seach</a>'
											+'	<span><a href="#"><label> </label>'+type+'</a></span>'
											+'	<p>'+des+'</p>'
											+'</div>'
											+'</div>'
												+'</li>';
											arrNameB.push({key:jqXHR.key,value:name});
										//	alert(name);
										//alert(JSON.stringify(arrNameB));	
											}
										else str="";
									$("#allsearch").append(str);									
									} 
								});	
							}
						}
						});						
					}

					} 
				});	 
			}
		} 
		
	}
		
});		
	}
else if(mode=="specification"){	
	var tmp="";
	for(var i=1;i<res.length;i++)
		if(i==1)
			tmp=tmp+"{<"+res[i]+"> ?p ?o} UNION {?o ?p <"+res[i]+">}";
		else
			tmp=tmp+" UNION {<"+res[i]+"> ?p ?o} UNION {?o ?p <"+res[i]+">}";

	var query = "SELECT distinct ?o WHERE {"+tmp+"}";
	var uri = prefix+encodeURIComponent(query).replace(/%20/g,'+')+"&output=json";
	var expiration = new Date();
	expiration.setTime(expiration.getTime() + 100000000); //Expire after 10 seconds
	setCookie("PivotKey",res[1],expiration);
	$.ajax({
    type:     "GET",
    url:      uri, // <-- Here
    dataType: "jsonp",
    success: function(data){						
		var arr = data['results']['bindings'];
	   $("#loading").fadeOut("slow");
	   $("#abc").fadeIn();
	   
		$("#top_box").show();
		$("#all_box").show();
		
		$("#keySA").fadeIn();
		//loc ra cac thuc the la uri
		for(i=0;i<arr.length;i++){
			if(arr[i]['o']['type']=="uri")
				if((arr[i]['o']['value'].search("linkedmdb")!=-1)&&(arr[i]['o']['value'].search("interlink")==-1)
				&&(arr[i]['o']['value'].search("film_film_distributor_relationship")==-1)){
					tmp = arr[i]['o']['value'];
					pivot.push({key:tmp,value:tmp});
				}
		}
		//Tinh trong so cua cac thuco tinh cua thuc the dau tien do
		for(i=1;i<res.length;i++){
		query = "SELECT  (COUNT(distinct ?s) AS ?count) WHERE{ {?s ?o <"+res[i]+">} UNION {<"+res[i]+"> ?o ?s}}";
						uri = prefix+encodeURIComponent(query).replace(/%20/g,'+')+"&output=json";
						  $.ajax({
								type:     "GET",
								url:      uri, // <-- Here
								dataType: "jsonp",
								beforeSend: function (jqXHR) {
										jqXHR.key = res[i];
									},
								success:function(data, textStatus, jqXHR){	
									var key = jqXHR.key;
									if(data['results']['bindings'].length>0){	
									var count = data['results']['bindings'][0]['count']['value'];
									arrPivot.push({key:key,value:count});
					}
									 } 
								});
		}
		//Neu chi co 1 thuc the tim kiem thi dua ra cac thuoc tinh cua thuc the do
		if(res.length==2){
		            var count2=0;
            var countb=0,counta=0;

			for(var j=0;j<pivot.length;j++){
			
						query = "SELECT * WHERE {<"+pivot[j].key+"> foaf:page ?url}";
				uri = prefix+encodeURIComponent(query).replace(/%20/g,'+')+"&output=json";	
				//$("#functionAResult").append(uri+"</br");
					$.ajax({
						type:     "GET",
						url:      uri, // <-- Here
						dataType: "jsonp",
						beforeSend: function (jqXHR) {
								jqXHR.key = pivot[j].key;
							},
						success:function(data, textStatus, jqXHR){						
						var key = jqXHR.key;
						if(data == undefined) return;
						var arr = data['results']['bindings'];
							
							
						 for(var i=0;i<arr.length;i++){
						 if(arr[i]['url']['value'].search("imdb.com")!=-1){
							var page = arr[i]["url"]["value"].replace("http://www.imdb.com/title/","");
							page = page.replace("/","");
							var uri = "http://www.omdbapi.com/?i="+page+"&r=json"; 
							$.ajax({
										type:     "GET",
										url:      uri, // <-- Here
										dataType: 'json',
										beforeSend: function (jqXHR) {
											jqXHR.key=key;
										},
										success:function(data, textStatus, jqXHR){
											var x = parseInt(data["imdbRating"]);
											arrIMDB.push({vote:x,page:arr[0]['url']['value'],key:jqXHR.key});
											 //alert(JSON.stringify(arrIMDB.sort(sortStringDesc)));
										}
							});}
							if(arr[i]['url']['value'].search("freebase")!=-1){
								var page = arr[i]["url"]["value"].replace("http://www.freebase.com/view","");
								var uri = "https://www.googleapis.com/freebase/v1/topic"+page+"?key=AIzaSyDZXndLh8k1vpqvtrUPHHVerkEo0Qz98tQ";
								$.ajax({
									type:     "GET",
									url:      uri, // <-- Here
									dataType: 'json',
									beforeSend: function (jqXHR) {
													jqXHR.uri = uri;
													jqXHR.key = key;
									},
									success:function(data, textStatus, jqXHR){	
									var name,img,type,des;
												type="";
									if(data.property['/type/object/name']!= undefined )
													name = data.property['/type/object/name'].values[0].text;
												else name="";
												if(data.property['/type/object/type']!= undefined ){
														for(var k=0;k<data.property['/type/object/type'].values.length;k++){
															var tmp = data.property['/type/object/type'].values[k].text;
															if((tmp.search("Film")!=-1)||(tmp.search("actor")!=-1)||
															(tmp.search("editor")!=-1)||(tmp.search("writer")!=-1)||
															(tmp.search("director")!=-1)||(tmp.search("producer")!=-1))
															if(type=="")
																type = type +"\""+ tmp +"\"";
															else
																type = type +"-\""+ tmp +"\"";
														}
													}
												else type="...";
												if(data.property['/common/topic/description']!= undefined )
													des = data.property['/common/topic/description'].values[0].text;
												else des="...";
												  if(data.property['/common/topic/image']!= undefined )
													img ='<img src="https://usercontent.googleapis.com/freebase/v1/image'+data.property['/common/topic/image']['values'][0]['id']+'?key=AIzaSyDZXndLh8k1vpqvtrUPHHVerkEo0Qz98tQ"/>';
												else img=""; 
												if(name!=""){
										str = '<li><div class="post-info">'
											+img
											+'<div class="post-basic-info">'
											+'	<h3><a href="#" onclick="showPopupEX(\''+jqXHR.uri+'\',\''+jqXHR.key+'\');" >'+name+'</a>'
											+'<a href="#"  onclick="addExSearch(\''+encodeURIComponent(name)+'\',\''+jqXHR.key+'\',\''+jqXHR.uri+'\');">Add Seach</a>'
											+'	<span><a href="#"><label> </label>'+type+'</a></span>'
											+'	<p>'+des+'</p>'
											+'</div>'
											+'</div>'
												+'</li>';
											arrNameB.push({key:jqXHR.key,value:name});
											}
										else str="";
									count2++;
									if(count2==(pivot.length-1)){
									
										if(arrIMDB.length>=2){
											  for(var i=0;i<arrIMDB.length;i++)												for(var j=i+1;j<arrIMDB.length;j++)
												 if(arrIMDB[i].vote<arrIMDB[j].vote){
														 var tmp = arrIMDB[i].vote;
														arrIMDB[i].vote = arrIMDB[j].vote;
														arrIMDB[j].vote= tmp; 
													}
											for(var i=0;i<3;i++){
												if(arrIMDB[i].page!=undefined){
											var page = arrIMDB[i].page.replace("http://www.freebase.com/view","");
											var uri = "https://www.googleapis.com/freebase/v1/topic"+page+"?key=AIzaSyDZXndLh8k1vpqvtrUPHHVerkEo0Qz98tQ";
											$.ajax({
												type:     "GET",
												url:      uri, // <-- Here
												dataType: 'json',
												beforeSend: function (jqXHR) {
																jqXHR.uri = uri;
																jqXHR.key = arrIMDB[i].key;
												},
												success:function(data, textStatus, jqXHR){
												 var name,img,type,des;
												type="";
												 if(data.property['/type/object/name']!= undefined )
																name = data.property['/type/object/name'].values[0].text;
															else name="";
															if(data.property['/type/object/type']!= undefined ){
														for(var k=0;k<data.property['/type/object/type'].values.length;k++){
															var tmp = data.property['/type/object/type'].values[k].text;
															if((tmp.search("Film")!=-1)||(tmp.search("actor")!=-1)||
															(tmp.search("editor")!=-1)||(tmp.search("writer")!=-1)||
															(tmp.search("director")!=-1)||(tmp.search("producer")!=-1))
															if(type=="")
																type = type +"\""+ tmp +"\"";
															else
																type = type +"-\""+ tmp +"\"";
														}
													}
															else type="...";
														if(data.property['/common/topic/description']!= undefined )
																des = data.property['/common/topic/description'].values[0].text;
															else des="...";
													  if(data.property['/common/topic/image']!= undefined )
																img ='<img src="https://usercontent.googleapis.com/freebase/v1/image'+data.property['/common/topic/image']['values'][0]['id']+'?key=AIzaSyDZXndLh8k1vpqvtrUPHHVerkEo0Qz98tQ"/>';
															else img="";  
															if(name!=""){
													str = '<li><div class="post-info">'
														+img
														+'<div class="post-basic-info">'
														+'	<h3><a href="#" onclick="showPopupEX(\''+jqXHR.uri+'\',\''+jqXHR.key+'\');" >'+name+'</a>'
														+'<a href="#"  onclick="addExSearch(\''+encodeURIComponent(name)+'\',\''+jqXHR.key+'\',\''+jqXHR.uri+'\');">Add Seach</a>'
														+'	<span><a href="#"><label> </label>'+type+'</a></span>'
														+'	<p>'+des+'</p>'
														+'</div>'
														+'</div>'
															+'</li>'; 
														}
													else str="";
													$("#topsearch").append(str);									
												} 
											});	
												}
											}											
											
											 }
									
									}
									$("#allsearch").append(str);									
									} 
								});	
							}
							}
						}
						});	
			}
		}
		//Neu co hai thuc the tro len thi thuc hien lan truyen
		if(res.length>2)
		for(i=2;i<res.length;i++){
			for(j=0;j<pivot.length;j++){
			
		query = "SELECT  (COUNT(distinct ?s) AS ?count) WHERE{ {{?s ?o <"+res[i]+">} UNION {<"+res[i]+"> ?o ?s}}.{{?s ?o <"+pivot[j].key+">} UNION {<"+pivot[j].key+"> ?o ?s}}}";
		uri = prefix+encodeURIComponent(query).replace(/%20/g,'+')+"&output=json";
		//$("#functionAResult").append(i+","+j+":"+pivot.length+"</br>");
		  $.ajax({
				type:     "GET",
				url:      uri, // <-- Here
				dataType: "jsonp",
				beforeSend: function (jqXHR) {
                        jqXHR.uri1 = res[i];
						jqXHR.uri2 = pivot[j].key;
                    },
				success:function(data, textStatus, jqXHR){
					var uri1 = jqXHR.uri1; 
					var uri2 = jqXHR.uri2; 
					if(data['results']!=undefined)
					if(data['results']['bindings'].length>0){
					var count = data['results']['bindings'][0]['count']['value'];
					arrAB.push({key:uri1,key1:uri2,value:count});
					countAB+=1;			
				query = "SELECT * WHERE {<"+uri2+"> foaf:page ?url}";
				uri = prefix+encodeURIComponent(query).replace(/%20/g,'+')+"&output=json";	
				//$("#functionAResult").append(uri+"</br");
					$.ajax({
						type:     "GET",
						url:      uri, // <-- Here
						dataType: "jsonp",
						beforeSend: function (jqXHR) {
								jqXHR.key = uri2;
							},
						success:function(data, textStatus, jqXHR){
						var key = jqXHR.key;
						var arr = data['results']['bindings'];
						 for(var i=0;i<arr.length;i++)
							if(arr[i]['url']['value'].search("freebase")!=-1){
								var page = arr[i]["url"]["value"].replace("http://www.freebase.com/view","");
								var uri = "https://www.googleapis.com/freebase/v1/topic"+page+"?key=AIzaSyDZXndLh8k1vpqvtrUPHHVerkEo0Qz98tQ";
								$.ajax({
									type:     "GET",
									url:      uri, // <-- Here
									dataType: 'json',
									beforeSend: function (jqXHR) {
													jqXHR.uri = uri;
													jqXHR.key = key;
									},
									success:function(data, textStatus, jqXHR){	
									$("#keySA").fadeIn();
									var name,img,type,des;
												type="";
									if(data.property['/type/object/name']!= undefined )
													name = data.property['/type/object/name'].values[0].text;
												else name="";
												if(data.property['/type/object/type']!= undefined ){
														for(var k=0;k<data.property['/type/object/type'].values.length;k++){
															var tmp = data.property['/type/object/type'].values[k].text;
															if((tmp.search("Film")!=-1)||(tmp.search("actor")!=-1)||
															(tmp.search("editor")!=-1)||(tmp.search("writer")!=-1)||
															(tmp.search("director")!=-1)||(tmp.search("producer")!=-1))
															if(type=="")
																type = type +"\""+ tmp +"\"";
															else
																type = type +"-\""+ tmp +"\"";
														}
													}
												else type="...";
												if(data.property['/common/topic/description']!= undefined )
													des = data.property['/common/topic/description'].values[0].text;
												else des="...";
												  if(data.property['/common/topic/image']!= undefined )
													img ='<img src="https://usercontent.googleapis.com/freebase/v1/image'+data.property['/common/topic/image']['values'][0]['id']+'?key=AIzaSyDZXndLh8k1vpqvtrUPHHVerkEo0Qz98tQ"/>';
												else img=""; 
												if(name!=""){
										str = '<li><div class="post-info">'
											+img
											+'<div class="post-basic-info">'
											+'	<h3><a href="#" onclick="showPopupEX(\''+jqXHR.uri+'\',\''+jqXHR.key+'\');" >'+name+'</a>'
											+'<a href="#"  onclick="addExSearch(\''+encodeURIComponent(name)+'\',\''+jqXHR.key+'\',\''+jqXHR.uri+'\');">Add Seach</a>'
											+'	<span><a href="#"><label> </label>'+type+'</a></span>'
											+'	<p>'+des+'</p>'
											+'</div>'
											+'</div>'
												+'</li>';
											arrNameB.push({key:jqXHR.key,value:name});
										//	alert(name);
										//alert(JSON.stringify(arrNameB));	
											}
										else str="";
									$("#topsearch").append(str);									
									} 
								});	
							}
						}
						});						
					//$("#functionAResult").append(uri1+","+uri2+":");					
					//$("#functionAResult").append(data['results']['bindings'][0]['count']['value']+"</br>");
						query = "SELECT  (COUNT(distinct ?s) AS ?count) WHERE{ {?s ?o <"+uri2+">} UNION {<"+uri2+"> ?o ?s}}";
						uri = prefix+encodeURIComponent(query).replace(/%20/g,'+')+"&output=json";
						//$("#functionAResult").append(i+","+j+":"+pivot.length+"</br>");
						if(getKeyValueArray(uri2,arrA)==0)
						  $.ajax({
								type:     "GET",
								url:      uri, // <-- Here
								dataType: "jsonp",
								beforeSend: function (jqXHR) {
										jqXHR.key = uri2;
									},
								success:function(data, textStatus, jqXHR){
									if(data['results']['bindings'].length>0){	
									//$("#functionAResult").append(jqXHR.key+":");					
									//$("#functionAResult").append(data['results']['bindings'][0]['count']['value']+"</br>");
									var count = data['results']['bindings'][0]['count']['value'];
									arrA.push({key:jqXHR.key,value:count});
									countA +=1;
									//$("#functionAResult").append("aa"+countA+"aa"+countAB+"bb");
									 if(countA==countAB){
											$("#functionAResult").append(JSON.stringify(arrAB[0]));
											for(var i=0;i<arrAB.length;i++){
												
												relatedAB.push({key:arrAB[i].key,key1:arrAB[i].key1,value:RelateMeasure(getKeyValueArray(arrAB[i].key,arrPivot),getKeyValueArray(arrAB[i].key1,arrA),arrAB[i].value)}); 									
											}
											eraseCookie("RelateArr");
											var json = JSON.stringify(relatedAB);
											var expiration = new Date();
											expiration.setTime(expiration.getTime() + 100000000); //Expire after 10 seconds
											setCookie("RelateArr",json,expiration);
											
										}
									
									}
									
									 } 
								});	
					}
					
					else{
						query = "SELECT * WHERE {<"+uri2+"> foaf:page ?url}";
				uri = prefix+encodeURIComponent(query).replace(/%20/g,'+')+"&output=json";	
				//$("#functionAResult").append(uri+"</br");
					$.ajax({
						type:     "GET",
						url:      uri, // <-- Here
						dataType: "jsonp",
						beforeSend: function (jqXHR) {
								jqXHR.key = uri2;
							},
						success:function(data, textStatus, jqXHR){
						var key = jqXHR.key;
						if(data==undefined) return;
						var arr = data['results']['bindings'];
						 for(var i=0;i<arr.length;i++)
							if(arr[i]['url']['value'].search("freebase")!=-1){
								var page = arr[i]["url"]["value"].replace("http://www.freebase.com/view","");
								var uri = "https://www.googleapis.com/freebase/v1/topic"+page+"?key=AIzaSyDZXndLh8k1vpqvtrUPHHVerkEo0Qz98tQ";
								$.ajax({
									type:     "GET",
									url:      uri, // <-- Here
									dataType: 'json',
									beforeSend: function (jqXHR) {
													jqXHR.uri = uri;
													jqXHR.key = key;
									},
									success:function(data, textStatus, jqXHR){	
									$("#keySA").fadeIn();
									var name,img,type,des;
												type="";
									if(data.property['/type/object/name']!= undefined )
													name = data.property['/type/object/name'].values[0].text;
												else name="";
												if(data.property['/type/object/type']!= undefined ){
														for(var k=0;k<data.property['/type/object/type'].values.length;k++){
															var tmp = data.property['/type/object/type'].values[k].text;
															if((tmp.search("Film")!=-1)||(tmp.search("actor")!=-1)||
															(tmp.search("editor")!=-1)||(tmp.search("writer")!=-1)||
															(tmp.search("director")!=-1)||(tmp.search("producer")!=-1))
															if(type=="")
																type = type +"\""+ tmp +"\"";
															else
																type = type +"-\""+ tmp +"\"";
														}
													}
												else type="...";
												if(data.property['/common/topic/description']!= undefined )
													des = data.property['/common/topic/description'].values[0].text;
												else des="...";
												  if(data.property['/common/topic/image']!= undefined )
													img ='<img src="https://usercontent.googleapis.com/freebase/v1/image'+data.property['/common/topic/image']['values'][0]['id']+'?key=AIzaSyDZXndLh8k1vpqvtrUPHHVerkEo0Qz98tQ"/>';
												else img=""; 
												if(name!=""){
										str = '<li><div class="post-info">'
											+img
											+'<div class="post-basic-info">'
											+'	<h3><a href="#" onclick="showPopupEX(\''+jqXHR.uri+'\',\''+jqXHR.key+'\');" >'+name+'</a>'
											+'<a href="#"  onclick="addExSearch(\''+encodeURIComponent(name)+'\',\''+jqXHR.key+'\',\''+jqXHR.uri+'\');">Add Seach</a>'
											+'	<span><a href="#"><label> </label>'+type+'</a></span>'
											+'	<p>'+des+'</p>'
											+'</div>'
											+'</div>'
												+'</li>';
											arrNameB.push({key:jqXHR.key,value:name});
										//	alert(name);
										//alert(JSON.stringify(arrNameB));	
											}
										else str="";
									$("#allsearch").append(str);									
									} 
								});	
							}
						}
						});						
					}

					} 
				});	 
			}
		} 
		
	}
		
});		
	
	}
}



function clearExSearch(){
	document.getElementById("rawSAkey").innerHTML="";
	document.getElementById("keySA").innerHTML="";
}
</script>
<script type='text/javascript'>
$(document).ready(function(){
    $(window).scroll(function() {
    if ($(window).scrollTop() > 50) {
        $(".accordian1").css("position", "fixed");
    }
    else {
        $(".accordian1").css("position", "static");
    }
});
});
</script>
	
<script type="text/javascript" src="js/graph/raphael-min.js"></script>
    <script type="text/javascript" src="js/graph/dracula_graffle.js"></script>
    <script type="text/javascript" src="js/graph/dracula_graph.js"></script>
    <script type="text/javascript" src="js/drawgraph.js"></script>	
	</head>
	<body>

		<!---start-wrap---->
			<!---start-header---->
			<div class="header">
				<div class="wrap">

				<div class="nav-icon">
					 <a href="#" class="right_bt" id="activator"><span> </span> </a>
				</div>
				 <div class="box" id="box">
					 <div class="box_content">        					                         
						<div class="box_content_center">
						 	<div class="form_content">
								<div class="menu_box_list">
									<ul>
										<li><a href="#"><span>home</span></a></li>
										<li><a href="#"><span>About</span></a></li>
										<li><a href="#"><span>Works</span></a></li>
										<li><a href="#"><span>Clients</span></a></li>
										<li><a href="#"><span>Blog</span></a></li>
										<li><a href="contact.html"><span>Contact</span></a></li>
										<div class="clear"> </div>
									</ul>
								</div>
								<a class="boxclose" id="boxclose"> <span> </span></a>
							</div>                                  
						</div> 	
					</div> 
				</div>       	  
				<div class="top-searchbar" id="top_search" style="display:none;">
						<input placeholder="Enter text here..." id="text_search" type="text" onkeydown="if (event.keyCode == 13) search(10)"/><input type="button" value="" />
						<div>
						<a  class="myButton" onclick= "exSearch();">EX</a><a  class="myButton" onclick= "clearExSearch();">Clear</a>
						<input type="range" min="0" max="100" value="0" step="50" style="width:40px;" onchange="showValueSlider(this.value)" />
						<script>
							function showValueSlider(newValue)
								{
									document.getElementById("range").value=newValue;
								}
						</script>
						<input type="number" id="range" value="0" style="width:40px;"/>
						<select id="typeSearchSA">
						  <option value="simple">Simple</option>
						  <option value="specification">Specification</option>
						</select>
						<input type="checkbox" id="istest" value="ok">Test<br>
						<div class="accordian">
	<ul id="keySA">
	</ul>
</div>
						</div>
				</div>
				
			</div>
		</div>
		<!---//End-header---->
		<!---start-content---->
		<div class="content">

			<div class="wrap">
			 <div id="main" >
			 

		
<div style="display:none" id="rawSAkey">
</div>
<div id="functionAResult" style="display:"></div>
<div id="functionABResult" style="display:"></div>

<div id="popup-bg"></div>
<div id="popup">
	<div id="popup-header"><span id="popup-close" title="Close">x</span></div>
    <div id="popup-content" style="overflow-y: scroll; width:700px; height:400px;">
	<div class="loading1">
							<div></div>
							<div></div>
							<div></div>
							<div></div>
							<div></div>
						</div></div>
</div>
					<div id="loading" class="element" style="display: none;">	
<div style="font-family: 'Open Sans', sans-serif; font-weight: bold;font-size: 50px; color:#741bb1; margin-left:-5%">Searching</div>
											
						<div class="loading3">
							<div></div>
							<div></div>
							<div></div>
							<div></div>
							<div></div>
						</div>
					</div>
			      <ul id="abc">
				  <div class="box_search" id ="top_box" style ="display:none;">
							<h4 style ="background:red;">TOP</h4>
							<div id ="topsearch" style="overflow-y: scroll; width:700px; height:400px;">
							
							</div>
						</div>
						<div class="box_search" id ="all_box" style ="display:none;">
							<h4>RECOMMEND</h4>
							<div id ="allsearch" style="overflow-y: scroll; width:700px; height:400px;">
							
							</div>
						</div>
			        <!-- These are our grid blocks -->
			        	<div class="alert-box" class="tooltips">
							<img src="images/right-icon.png" title="check" />
							
							<p>Expolatory Search Film</p>
							<a class="a-alert" id="a-start" href="#" onclick="start()" >Get Started</a>
						</div>				
						
			        <!-- End of grid blocks -->
			      </ul>
				  
						
				  <div id="more" style="display: none ; margin-left:20%">
				  <a  class="myButton" onclick= "search(0);">Back</a>
				  <a  class="myButton" onclick= "search(1);">Next</a>

				  </div>
			    </div>
			</div>
		</div>
		<!---//End-content---->
		<!----wookmark-scripts---->

		<!----//wookmark-scripts---->
		<!----start-footer--->
		<div class="footer">
			<p>Design by <a href="https://www.facebook.com/dinhduythanh">Đinh Duy Thanh</a></p>
		</div>
		<!----//End-footer--->
		<!---//End-wrap---->
	</body>
</html>

