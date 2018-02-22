<div id="map" style="height: 100%;"></div>
<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyAA2fBTrIbS0Cu1XDxVsnirupN_QRhXDEU&callback=initialize" type="text/javascript"></script>

<script type="text/javascript">
    function initialize() {
<?php
$con= mysqli_connect("localhost","root","","sample");
   $query="SELECT pointLat, pointLong, pointText  FROM mappoints1";
     $result=mysqli_query($con,$query);
     
?>
var locations = [<?php while($row = mysqli_fetch_array($result))
{?>

['<?php echo $row['pointText'];?>', <?php echo $row['pointLat'];?>, <?php echo   $row['pointLong'];?>],

<?php }?>
];

    var latlng = new google.maps.LatLng(8.506,76.913);
    var myOptions = {
    zoom: 8,
    center: latlng,
    mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    var map = new google.maps.Map(document.getElementById("map"),
        myOptions);

    var infowindow = new google.maps.InfoWindow();

    var marker, i;
    for (i = 0; i < locations.length; i++) {  
        marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        map: map
        });

        google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent(locations[i][0]);
          infowindow.open(map, marker);
         }
        })
        (marker, i));
    }
    }
    google.maps.event.addDomListener(window, 'load', initialize);
    </script>