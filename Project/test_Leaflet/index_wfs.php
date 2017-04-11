<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <title>OpenStreetFood</title>
        <link rel="stylesheet" href="lib/leaflet/leaflet.css"/>
        <link rel="stylesheet" href="lib/leaflet/leaflet.label.css"/>
        
        <link rel="stylesheet" href="https://domoritz.github.io/leaflet-locatecontrol/dist/L.Control.Locate.min.css" />
		
        <script src="lib/leaflet/leaflet.js"></script>
        <script src="data/dehradun.geojson"></script>
        
        <script src="lib/leaflet/leaflet.label.js"></script>
        <script src="https://domoritz.github.io/leaflet-locatecontrol/dist/L.Control.Locate.min.js" charset="utf-8"></script>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        
        <style type="text/css">
            #map {height: 550px;} 
            .legend{background:white; line-height:1.5em}
            .legend i {width:2em; float:left}
        </style>
    </head> 
    
    <body>
    <div id='map'></div>
    <script>
        var map=L.map('map').setView([30.316, 78.032], 14);
        var osm = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');
        map.addLayer(osm);
        
        //var dehradun=new L.geoJson()
        var owsrootUrl='http://localhost:8080/geoserver/annie_webgis/ows';
        var defaultParam={
            service : 'WFS',
            version:'1.0.0',
            request: 'GetFeature',
            typeName:'annie_webgis:ddoon_nukkad',
            outputFormat:'text/javascript',
            format_options: 'callback:getJson',
            SrsName:  'EPSG:4326'
            }
        var parameters=L.Util.extend(defaultParam);
        var URL =owsrootUrl+L.Util.getParamString(parameters);
        
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
                    popupOptions={maxWidth:200};
                    layer.bindPopup("Aaja bhai", popupOptions); //WE HAVE TO ADD ATTRIBUTES HERE
                    }
                
        }).addTo(map);
        
        
    }
    });
        //var point =[30.33,78.05];
        //var marker=L.marker(point).addTo(map); //simple marker
        
    
        
    </script>
    </body>
        
        
</html>