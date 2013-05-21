<h1>Software Libre Repositorio</h1>
<div id="map" style="width: 100%; height:300px;"></div>
<script src="assets/js/OpenLayers.js"></script>
<script>
    map = new OpenLayers.Map("map");
    map.addLayer(new OpenLayers.Layer.OSM());
    map.zoomToMaxExtent();
	map.setCenter(
		new OpenLayers.LonLat(-74.81449, 10.96474).transform(
			new OpenLayers.Projection("EPSG:4326"),
			map.getProjectionObject()
		), 12
	);   
</script>

