<!DOCTYPE html>
<html>

<head>
    <title>Leaflet Time Slider Example</title>
    <meta charset="utf-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}">
    <link rel="stylesheet" href="https://cdn.leafletjs.com/leaflet-0.7.2/leaflet.css" />
    <!--[if lte IE 8]><link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.5.1/leaflet.ie.css" /><![endif]-->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/myCss.css') }}">
</head>

<body>
    <div class="row" style="margin: 50px;">
     
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div id="map" style="width: 100%; height: 600px" align="center"></div>
        </div>
    </div>

    <script src="https://cdn.leafletjs.com/leaflet-0.7.2/leaflet.js"></script>
    <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>

    <!-- Include this library for mobile touch support  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.2/jquery.ui.touch-punch.min.js"></script>


    <script src="{{ asset('js/SliderControl.js') }}"></script>

    <script>
    var sliderControl = null;

    var myMap = L.map('map').setView([52.06, 7.40], 10);

    L.tileLayer('https://{s}.tile.osm.org/{z}/{x}/{y}.png', {}).addTo(myMap)z;
    


    //Fetch some data from a GeoJSON file
    $.getJSON("{{ asset('json/points.json') }}", function(json) {
        var testlayer = L.geoJson(json),
            // sliderControl = L.control.sliderControl({
            //     position: "bottomleft",
            //     layer: testlayer
            // });

        //For a Range-Slider use the range property:
        sliderControl = L.control.sliderControl({
            position: "bottomleft",
            layer: testlayer,
            range: true
        });
      

        //Make sure to add the slider to the map ;-)
        myMap.addControl(sliderControl);
        //And initialize the slider
        sliderControl.startSlider();
    });
    </script>
</body>

</html>
