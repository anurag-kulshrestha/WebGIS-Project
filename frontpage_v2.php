<!DOCTYPE html>
<html>
  <head>
    <title>Nukkad Food!!!</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
	<link href="css/bootstrap-responsive.css" rel="stylesheet">  <!-- Responsive Bootstrap used here -->
	
	<link rel="stylesheet" href="test_Leaflet/lib/leaflet/leaflet.css"/>		<!-- Leaflet css file here  -->
    <link rel="stylesheet" href="test_Leaflet/lib/leaflet/leaflet.label.css"/>	<!-- Leaflet -->
	
	 <script src="test_Leaflet/data/dehradun.geojson"></script>
	<script src="http://code.jquery.com/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
	<script src="test_Leaflet/lib/leaflet/leaflet.js"></script>
    
    <script src="test_Leaflet/lib/leaflet/leaflet.label.js"></script>
	<script src="https://domoritz.github.io/leaflet-locatecontrol/dist/L.Control.Locate.min.js" charset="utf-8"></script>  <!-- Locate control plugin here  -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
	
	<style type="text/css">
            #map {{
					width: 600px;
					height:600px;
					min-height: 100%;
					min-width: 100%;
					display: block;
				}} 
            .legend{background:white; line-height:1.5em}
            .legend i {width:2em; float:left}
			
			.span2 {
					background-color: azure;
				}
    </style>
	
	
	
	
  </head>
  <body>
	<script type = "text/javascript">
		/*function toggleVisibility(id) {
		   var el = document.getElementById(id);

		   if (el.style.visibility=="visible") {
				  el.style.visibility="hidden";
			 }
			 else {
				  el.style.visibility="visible";
			 }
		 }*/
	</script>
	<div class="container-fluid">
	  <div class="row-fluid">
		<div class="span2">  <!-- Side Bar -->
			<ul class = "thumbnails">
				<li class = "span11">
					<a href = "#" class = "thumbnail">
                                                
						<img data-src = "holder.js/300x200" src = "images/banner.png" alt = "OSF Logo" align = "middle">
					</a>
			</ul>
			<!--<img src = "images/banner.png" class = "img-polaroid" height = 150 width = 200> -->
			<BR><P class = "lead"><em><i class = "icon-list"></i>&nbspChoose</em></P>
			<ul class="thumbnails">
			  <li class="span4">
				<a href="#" class="thumbnail">
				  <img title='Chai' data-src="holder.js/300x200" src = "images/teacup.png" alt="Chai" onclick = "updateTable('only_chai')">
				  <li class = "span4"><img title='Chaat' data-src="holder.js/300x200" src = "images/chaat.png" alt="Chaat" onclick = "updateTable('only_chaat')">
				  <li class = "span4"><img title='Paan' data-src="holder.js/300x200" src = "images/paan.png" alt="Paan" onclick = "updateTable('only_pan')">
				</a>
			   
			</ul>
			<hr>
			<button class = "btn btn-link" onclick="addPoint()">Click here for adding a new point
			<!--<form action = "" method = "get" name = "choice">
			<OL>
				<LI><label class = "checkbox inline">
				<input title = "chai" type = "checkbox" name = "tea" id = "tea" onchange = "toggleVisibility('imgtea')">Tea</label> 
				<LI><label class = "checkbox inline">
				<input title = "snacks" type = "checkbox" name = "snacks" id = "snacks" onchange = "toggleVisibility('imgsnacks')">Snacks</label>
				<LI><label class = "checkbox inline">
				<input title = "paan" type = "checkbox" name = "paan" id = "paan" onchange = "toggleVisibility('imgpaan')">Paan</label>
			</OL>
			<input type = "submit" name = "sub">
			</form>
			<img id="imgtea" src="images\Boss Ek Cutting Chai_zpsd3vsxpys.jpg"  style="visibility:hidden" height = 150 width = 120 class = "img-polaroid"/>
			<img id="imgsnacks" src="images\chaat.jpg"  style="visibility:hidden" height = 160 width = 140 class = "img-polaroid"/>
			<img id="imgpaan" src="images\dribble_paan-beedi_shop.jpg"  style="visibility:hidden" height = 160 width = 160 class = "img-polaroid"/>
			LIST OF STREET FOOD VENDORS IN THE FORM OF TABLE HERE!!! -->
		</div>
		<div id ='map' class="span10">  <!-- Map here -->
			<!-- - __ -  :) -->
			<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><BR><BR>
			<script>
				var map=L.map('map', {
                                    attributionControl:false
                                    }).setView([30.316, 78.032], 14);
                                    L.control.attribution({prefix: '<p class="text-info">Powered by Bootstrap, Leaflet API, OpenStreetMap & Inkscape</p>'}).addTo(map);
				var osm = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');
				map.addLayer(osm);
				dabaDiya("ddoon_nukkad");
				// Zoom to area around IIRS
				map.panTo(new L.LatLng(30.3408, 78.0441));
				
				function insert(lat, lon){
                                    var WFSLayer=null;
                                        //var lat=30.34112079;
                                        //var lon=78.052686 ;
                                        
                                        //var details= {shop_name:'nayi dukaan',chai:'yes',chaat:'no',lat:lat,lon:lon}
                                        
                                        var ajax=$.ajax({
                                            
                                            type:'get',
                                            url:'insert.php',
                                            data: {name:'Anurag',
                                            lati:+lat,
                                            long:+lon},
                                            //data:details,
                                            dataType:'json',
                                            //jsonpCallback:'getJson',
                                            success: function(response){
                                                //alert(response);
                                                updateTable("ddoon_nukkad");
                                                /*
                                               WFSLayer=L.geoJson(response,{
                                                        style: function(feature){
                                                            return{
                                                                stroke:false,
                                                                fillColor:'FFFF8F',
                                                                fillOpacity:0
                                                                };
                                                            },
                                                        onEachFeature:function(feature, layer){
                                                            popupOptions={maxWidth:200};
                                                            layer.bindPopup("Aaja bhai", popupOptions); //WE HAVE TO ADD ATTRIBUTES HERE
                                                            }
                                                        
                                                }).addTo(map);
                                         */
                                         
                                         }
                                    });
                                    }
				
				//var dehradun=new L.geoJson()
				function dabaDiya(layername){
    
                                        var owsrootUrl='http://172.26.91.77:8080/geoserver/annie_webgis/ows';
                                        var defaultParam={
                                            service : 'WFS',
                                            version:'1.0.0',
                                            request: 'GetFeature',
                                            typeName:'annie_webgis:'+layername,
                                            outputFormat:'text/javascript',
                                            format_options: 'callback:getJson',
                                            SrsName:  'EPSG:4326'
                                            }
                                        var parameters=L.Util.extend(defaultParam);
                                        var URL = owsrootUrl+L.Util.getParamString(parameters);
                                        
                                        var WFSLayer=null;
                                        var ajax=$.ajax({
                                            url:URL,
                                            dataType:'jsonp',
                                            jsonpCallback:'getJson',
                                            success: function(response){
                                                WFSLayer=L.geoJson(response,{
                                                style: function(feature){
                                                    return{
                                                        stroke:false,
                                                        fillColor:'FFFF8F',
                                                        fillOpacity:0
                                                        };
                                                    },
                                                onEachFeature:function(feature, layer){
                                                    popupOptions={maxWidth:600, maxHeight:450};
                                                            layer.bindPopup('<ul class="thumbnails"><li class="span12">'+
                                                            '<div class="thumbnail">'+
                                                            '<img data-src="holder.js/260x120" src = "images/tea.jpg" alt="">'+
                                                            '<h3>'+feature.properties.shop_name+'</h3>'+
                                                            '<p><address><strong>'+feature.properties.owner_name+
                                                            '</strong><BR>'+feature.properties.address+
                                                            //'<BR><img src = "images/teacup.png" height = 60 width = 40> - '+feature.properties.chai+
                                                            //'<BR><img src = "images/chaat.png" height = 60 width = 40> - '+feature.properties.chaat+
                                                            //'<BR><img src = "images/paan.png" height = 60 width = 40> - '+feature.properties.pan+
                                                            returnIMG(feature)+
                                                            '<BR></address></p></div></li></ul>', popupOptions); //WE HAVE TO ADD ATTRIBUTES HERE
                                                            layer.on('mouseover', function (e) {
                                                                    this.openPopup();
                                                            });
                                                            layer.on('mouseout', function (e) {
                                                                    this.closePopup();
                                                            });
                                                    }
                                                
                                        }).addTo(map);
                                        
                                        map.addLayer(dehraroads);
                                        map.fitBounds(dehraroads.getBounds());
                                        
                                        //Function returns icon images according to availability of tea, snacks or paan
                                        function returnIMG(feature){
                                            var str="";
                                            if(feature.properties.chai=='yes')
                                            str += '<img src = "images/teacup.png" height = 60 width = 40>';
                                            if(feature.properties.chaat=='yes')
                                            str+= '<img src = "images/chaat.png" height = 60 width = 40>';
                                            if(feature.properties.pan=='yes')
                                            str+= '<img src = "images/paan.png" height = 60 width = 40>';
                                            return '<br>'+str+'<br>';
                                            }
                                        
                                    }
                                    });
                                        
                                        }
                                    
                                        
                                        
                                    function updateTable(newLayerName){
                                        map.eachLayer(function (layer) {
                                            map.removeLayer(layer);
                                        });
                                        var osm = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');
                                        map.addLayer(osm);
                                        dabaDiya(newLayerName);
                                        }
				
				var dehraroads;
            
                                    function highlightFeature(e){
                                        var layer = e.target;
                                        layer.setStyle(
                                            {
                                            weight:5,
                                            color:'black'
                                            //fillColor: 'white'
                                            //fillOpacity: 0.5
                                            }
                                        );
                                        if(!L.Browser.ie && !L.Browser.opera)
                                        layer.bringToFront();
                                        
                                    }
                                    
                                    function resetHighlight(e){
                                        dehraroads.resetStyle(e.target);
                                        }
                                        
                                    function zoomToFeature(e){
                                        map.fitBounds(e.target.getBounds());
                                        }
                                        
                                    function roadsOnEachFeature(feature, layer){
                                        layer.bindLabel(feature.properties.name, {noHide:true});
                                        layer.on(
                                            {
                                                mouseover:highlightFeature,
                                                mouseout:resetHighlight,
                                                click:zoomToFeature
                                            }
                                        );
                                        }
                                    
                                    function colaba_style(feature){
                                        return{
                                            //color: getroadColor(feature.properties.name),
                                            //color: getroadColor(),
                                            color: 'red',
                                            opacity:1,
                                            dashArray:2
                                        }
                                    }
                                    function getroadColor(name){
                                        //if(high.localeCompare('residential')==0)
                                        if(name!=null)
                                        //var a=1;
                                        //var b=1;
                                        //if(a==b)
                                            return 'green';
                                        else
                                            return 'red';
                                    }
				
				//DEHRADUN ROADS
				dehraroads=L.geoJson(
                                    roads_dehra,
                                        {style: colaba_style,
                                         //onEachFeature: roadsOnEachFeature
                                         }
                                    ).addTo(map);
                                
                                map.fitBounds(dehraroads.getBounds());
                                
                                //overlays = L.featureGroup().addTo(map);
                                map.addControl(new L.Control.Layers({ "Roads":dehraroads}, {}));
                                
                                
                                
                                
				
				
				//Locate Control plugin used here
				L.control.locate({
				locateOptions: {
				   enableHighAccuracy: true
				}}).addTo(map);
				//var point =[30.33,78.05];
				//var marker=L.marker(point).addTo(map); //simple marker
				
				
				
				
                                /*map.on('click',function(e, layer){
                                    var lat=e.latlng.lat;
                                    var lon=e.latlng.lng;
                                    popupOptions={maxWidth:600, maxHeight:450};
                                                            layer.bindPopup('<form action=loadWKT.php method="post">' +
                                                            'ID: <input type="text" id="id" name="id">'+
                                                            'Shop Name:<input type="text" id="sh_name" name="sh_name">'+
                                                            'LAT:<input type="text" id="lati" name="lati" value='+lat+'>'+
                                                            'LON:<input type="text" id="longi" name="longi" value='+lon+'>'+
                                            '<input type="submit" value="Insert Point">' +'</form>', popupOptions); 
                                    });
				*/
				var count=0;
				function addPoint(){
				map.on('click', function(e) {
                                    
                                    var lat=e.latlng.lat;
                                    var lon=e.latlng.lng;
                                    //alert(lat+lon);
                                    if(count==0){
                                    insert(lat,lon);
                                    }
                                    count++;
                                    //var popLocation=new L.LatLng(e.latlng.lat, e.latlng.lng);
                                    //var popup=L.popup().setLatLng(popLocation).setContent("Latitude, Lonngitude : " + e.latlng.lat + ", " + e.latlng.lng).openOn(map);
                                    //alert("Lat, Lon : " + e.latlng.lat + ", " + e.latlng.lng)
                                    });
                                
                                map.off('click', e);
                                }
                                
                                
                                
			</script>
			
		  
		</div>
	  </div>
	</div>
	
        
	

	
  </body>
</html>