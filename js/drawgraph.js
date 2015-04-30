
var redraw, g, renderer;
function drawgraph1(json,key) {
    var parsed = JSON.parse(json);
	//alert("aa"+parsed["anh"]["x"]);
	var pivot = getCookie("PivotKey");
		//alert(pivot);
/* 	$.ajax({
									type:     "GET",
									url:      uri, // <-- Here
									dataType: "jsonp",
									success:function(data, textStatus, jqXHR){									
									$("#abc").fadeIn("slow");	
									$("#abc").html("");
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
												if(data.property['/type/object/name']!= undefined )
													name = data.property['/type/object/name'].values[0].text;
												else name="";
												if(data.property['/common/topic/notable_types']!= undefined )
													type = data.property['/common/topic/notable_types'].values[0].text;
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
												$("#abc").append(str);									
												} 
											});	 
										}
									} 
								});	
  */   var width = 500;
    var height = 300;
    
    g = new Graph();
	for(var i=0;i<parsed.length;i++)
	{
		if(parsed[i].key1==key)	{
		g.addEdge(pivot, parsed[i].key1, { stroke : "#bfa" , fill : "#56f", label : "property" });
		g.addEdge(parsed[i].key, parsed[i].key1, { stroke : "#bfa" , fill : "#56f", label : parsed[i].value });
		}
	}
	 /* for(key in parsed){
		for(value in parsed[key])
			//g.addEdge("cherry", "apple");
			//alert(parsed[key][value]);
			g.addEdge(key, value, { stroke : "#bfa" , fill : "#56f", label : parsed[key][value] });
	}  */
    /* add a simple node */
    /* g.addNode("strawberry");
    g.addNode("cherry");
    g.addNode("1", { label : "Tomato" });
    g.addNode("id35", {
        label : "meat\nand\ngreed" //,
    });
    st = { directed: true, label : "Label",
            "label-style" : {
                "font-size": 20
            }
        };
    g.addEdge("kiwi", "penguin", st);
    g.addEdge("strawberry", "cherry");
    g.addEdge("cherry", "apple");
    g.addEdge("cherry", "apple")
    g.addEdge("1", "id35");
    g.addEdge("penguin", "id35");
    g.addEdge("penguin", "apple");
    g.addEdge("kiwi", "id35");
 */
    /* a directed connection, using an arrow */
   // g.addEdge("1", "cherry", { directed : true } );
    
    /* customize the colors of that edge */
    //g.addEdge("id35", "apple", { stroke : "#bfa" , fill : "#56f", label : "Meat-to-Apple" });
    
    /* add an unknown node implicitly by adding an edge */
   // g.addEdge("strawberry", "apple");

    //	g.removeNode("1");

    /* layout the graph using the Spring layout implementation */
    var layouter = new Graph.Layout.Spring(g);
    
    /* draw the graph using the RaphaelJS draw implementation */
    renderer = new Graph.Renderer.Raphael('canvas', g, width, height);
    
    /* redraw = function() {
        layouter.layout();
        renderer.draw();
    };
    hide = function(id) {
        g.nodes[id].hide();
    };
    show = function(id) {
        g.nodes[id].show();
    }; */
    //    console.log(g.nodes["kiwi"]);
};
/* only do all this when document has finished loading (needed for RaphaelJS) */
function drawgraph() {
    
    var width = 500;
    var height = 300;
    
    g = new Graph();

    /* add a simple node */
    g.addNode("strawberry");
    g.addNode("cherry");
    g.addNode("1", { label : "Tomato" });
    g.addNode("id35", {
        label : "meat\nand\ngreed" //,
    });
    st = { directed: true, label : "Label",
            "label-style" : {
                "font-size": 20
            }
        };
    g.addEdge("kiwi", "penguin", st);
    g.addEdge("strawberry", "cherry");
    g.addEdge("cherry", "apple");
    g.addEdge("cherry", "apple")
    g.addEdge("1", "id35");
    g.addEdge("penguin", "id35");
    g.addEdge("penguin", "apple");
    g.addEdge("kiwi", "id35");

    /* a directed connection, using an arrow */
    g.addEdge("1", "cherry", { directed : true } );
    
    /* customize the colors of that edge */
    g.addEdge("id35", "apple", { stroke : "#bfa" , fill : "#56f", label : "Meat-to-Apple" });
    
    /* add an unknown node implicitly by adding an edge */
    g.addEdge("strawberry", "apple");

    g.removeNode("1");

    /* layout the graph using the Spring layout implementation */
    var layouter = new Graph.Layout.Spring(g);
    
    /* draw the graph using the RaphaelJS draw implementation */
    renderer = new Graph.Renderer.Raphael('canvas', g, width, height);
    
    /* redraw = function() {
        layouter.layout();
        renderer.draw();
    };
    hide = function(id) {
        g.nodes[id].hide();
    };
    show = function(id) {
        g.nodes[id].show();
    }; */
    //    console.log(g.nodes["kiwi"]);
};

