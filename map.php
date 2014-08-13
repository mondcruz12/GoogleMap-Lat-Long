<table id="tbl" border="1">
<thead>
<tr>
    <th>Location</th>
    <th>Latitude</th>
    <th>longtitude</th>
</tr>
</thead>
</table>

<?php
$data = file_get_contents("Bukidnon.csv"); //read the file
$convert = explode("\n", $data); //create array separate by new line


?>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script language="javascript">
       var geocoder = new google.maps.Geocoder();
       var addresses = [
        <?php foreach ($convert as $keys => $vals){
                echo '"'.trim($vals).'",';
            }
        ?>
         ];
var x = 0;

function doLoop() {
    if (x < addresses.length)
        process();
}

function process() {
    getLangLot(addresses[x],callback);
    window.status = addresses[x++];
    setTimeout("doLoop();",1000);
}


var callback = function (address,long,lat){
    $("#tbl").append("<tr><td>"+address+"</td><td>"+lat+"</td><td>"+long+"</td></tr>");
}

function getLangLot(address, callback){

    geocoder.geocode({ 'address': address }, function (results, status) {                                                                              
                if (status == google.maps.GeocoderStatus.OK) {
                    var latitude = results[0].geometry.location.lat();
                    var longitude = results[0].geometry.location.lng();
                    callback(address,longitude,latitude);
                 } 
    });

      

}

//  start the process
doLoop();



</script>