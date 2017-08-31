<script type="text/javascript">
 //<![CDATA[
 
    var iconBlue = new GIcon(); 
    iconBlue.image = 'http://labs.google.com/ridefinder/images/mm_20_blue.png';
    iconBlue.shadow = 'http://labs.google.com/ridefinder/images/mm_20_shadow.png';
    iconBlue.iconSize = new GSize(12, 20);
    iconBlue.shadowSize = new GSize(22, 20);
    iconBlue.iconAnchor = new GPoint(6, 20);
    iconBlue.infoWindowAnchor = new GPoint(5, 1);
 
    var iconRed = new GIcon(); 
    iconRed.image = 'http://labs.google.com/ridefinder/images/mm_20_red.png';
    iconRed.shadow = 'http://labs.google.com/ridefinder/images/mm_20_shadow.png';
    iconRed.iconSize = new GSize(12, 20);
    iconRed.shadowSize = new GSize(22, 20);
    iconRed.iconAnchor = new GPoint(6, 20);
    iconRed.infoWindowAnchor = new GPoint(5, 1);
 
    var iconGreen = new GIcon(); 
    iconGreen.image = 'http://labs.google.com/ridefinder/images/mm_20_green.png';
    iconGreen.shadow = 'http://labs.google.com/ridefinder/images/mm_20_shadow.png';
    iconGreen.iconSize = new GSize(12, 20);
    iconGreen.shadowSize = new GSize(22, 20);
    iconGreen.iconAnchor = new GPoint(6, 20);
    iconGreen.infoWindowAnchor = new GPoint(5, 1)
 
    var customIcons = [];
    customIcons["kinoteatr"] = iconBlue;
    customIcons["teatr"] = iconRed;
    customIcons["cafe"] = iconGreen;
 
 
 
  function load() {
      if (GBrowserIsCompatible()) {
        var map = new GMap2(document.getElementById("map"));
        map.addControl(new GSmallMapControl());
        map.addControl(new GMapTypeControl());
        map.setCenter(new GLatLng(47.61,-122.34), 13);
 
        GDownloadUrl("/google/maps", function(data) {
          var xml = GXml.parse(data);
          console.log(xml);
          var markers = xml.documentElement.getElementsByTagName("marker");
          for (var i = 0; i < markers.length; i++) {
            var name = markers[i].getAttribute("name");
            var address = markers[i].getAttribute("address");
             var ssilka = markers[i].getAttribute("ssilka");
             var images = markers[i].getAttribute("images");
 
            var type = markers[i].getAttribute("type");
            var point = new GLatLng(parseFloat(markers[i].getAttribute("lat")),
                                    parseFloat(markers[i].getAttribute("lng")));
            var marker = createMarker(point, name, address, ssilka,  images, type);
            map.addOverlay(marker);
          }
        });
      }
    }
 
    function createMarker(point, name, address, ssilka,  images, type) {
      var marker = new GMarker(point, customIcons[type]);
      var html ='<div style="width: 250px;"><b>' + name +'</b> <br/>' + address+'<br/><img src="'+images+'" with="200"/><br/><a href="'+ssilka+'" target="_blank"/>На сайт</a></div>';
      GEvent.addListener(marker, 'click', function() {
        marker.openInfoWindowHtml(html);
      });
      return marker;
    }
    //]]>
  </script>
 