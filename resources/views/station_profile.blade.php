@extends('layouts.app')
@section('style')
<script language="javascript" type="text/javascript">

    var map;
    var geocoder;
    function InitializeMap() {

        var latlng = new google.maps.LatLng(-34.397, 150.644);
        var myOptions =
        {
            zoom: 8,
            center: latlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            disableDefaultUI: true
        };
        map = new google.maps.Map(document.getElementById("map"), myOptions);
    }

    function FindLocaiton() {
        geocoder = new google.maps.Geocoder();
        InitializeMap();

        var address = document.getElementById("addressinput").value;
        geocoder.geocode({ 'address': address }, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                map.setCenter(results[0].geometry.location);
                var marker = new google.maps.Marker({
                    map: map,
                    position: results[0].geometry.location
                });

            }
            else {
                alert("Geocode was not successful for the following reason: " + status);
            }
        });

    }


    function Button1_onclick() {
        FindLocaiton();
    }

    window.onload = InitializeMap;

</script>
<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
<style>

.fb-profile img.fb-image-lg{
    z-index: 0;
    width: 100%;  
    margin-bottom: 10px;
}

.fb-image-profile
{
    margin: -90px 10px 0px 50px;
    z-index: 9;
    width: 20%; 
}

@media (max-width:768px)
{
    
.fb-profile-text>h1{
    font-weight: 700;
    font-size:16px;
}

.fb-image-profile
{
    margin: -45px 10px 0px 25px;
    z-index: 9;
    width: 20%; 
}
}
.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  max-width: 300px;
  margin: auto;
  text-align: center;
  font-family: arial;
}

.title {
  color: grey;
  font-size: 18px;
}

button {
  border: none;
  outline: 0;
  display: inline-block;
  padding: 8px;
  color: white;
  background-color: #000;
  text-align: center;
  cursor: pointer;
  width: 100%;
  font-size: 18px;
}
a {
  text-decoration: none;
  font-size: 22px;
  color: black;
}

button:hover, a:hover {
  opacity: 0.7;
}
table {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
  border: 1px solid #ddd;
}

th, td {
  text-align: left;
  padding: 16px;
}

tr:nth-child(even) {
  background-color: #f2f2f2
}
</style>
@endsection
@section('content')
<div class="main">
<!-- <table>
<tr>
<td>
    <input id="addressinput" type="text" style="width: 447px" />   
</td>
<td>
    <input id="Button1" type="button" value="Find" onclick="return Button1_onclick()" /></td>
</tr>
<tr>
<td colspan ="2">
<div id ="map" style="height: 253px" >
</div>
</td>
</tr>
</table> -->
<br>
<div class="fb-profile">
<div style="width: 100%"><iframe width="100%" height="300" src="https://maps.google.com/maps?width=100%&amp;height=600&amp;hl=en&amp;coord=23.7517296,-90.3778703&amp;q=Dhanmondi%2032+(Dhanmondi%2032)&amp;ie=UTF8&amp;t=&amp;z=16&amp;iwloc=A&amp;output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"><a href="https://www.maps.ie/map-my-route/">Create a route on google maps</a></iframe></div><br />
     
      
        
        <div class="fb-profile-text">
            <h1>Dhanmondi 32</h1>
            <p>Lorem ipsum dolor mit</p>
        </div>
        <button type="button" class="btn btn-primary">Give Feedback</button>
    </div>

<table>
  <tr>
    <th>Transport Name</th>
    <th>Image</th>
    <th>Description</th>
    <th>Likes</th>
    <th>Dislikes</th>
    <th>Action</th>
  </tr>
  <tr>
    <td>MTCL</td>
    <td>MTCL</td>
    <td>01777347634</td>
    <td>50</td>
    <td>50</td>
    <td> <button type="button" class="btn btn-primary">Give Feedback</button></td>
  </tr>
  <tr>
  <td>MTCL</td>
    <td>MTCL</td>
    <td>01777347634</td>
    <td>50</td>
    <td>50</td>
    <td> <button type="button" class="btn btn-primary">Give Feedback</button></td>
  </tr>
  <tr>
  <td>MTCL</td>
    <td>MTCL</td>
    <td>01777347634</td>
    <td>50</td>
    <td>50</td>
    <td> <button type="button" class="btn btn-primary">Give Feedback</button></td>
  </tr>
</table>

</div>
@endsection