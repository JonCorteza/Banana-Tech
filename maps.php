<?php include_once('layout/head.php'); ?>
<?php $title = 'Location'; ?>
    <!-- Left Panel -->

    <div class="animated fadeIn">
        <div class="row">

            <div class="col-md-12">
                <div class="card">

                    <div class="card-header">
                        <strong class="card-title">
                            <?= strtoupper($title); ?>
                        </strong>

                    </div>

                    <div class="card-body">

                            <style type="text/css">
                                html {
                                    height: 100%
                                }

                                body {
                                    height: 100%;
                                    margin: 0;
                                    padding: 0
                                }

                                #map_canvas {
                                    height: 100%
                                }
                            </style>
                            <script type="text/javascript"
                                    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDM3Pg0ldVVwWRC8gA1Gohf6zQQkJUwfw0&sensor=false">
                            </script>
                            <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false&libraries=places">
                            </script>

                        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDM3Pg0ldVVwWRC8gA1Gohf6zQQkJUwfw0&callback=myMap"></script>
                            <script type="text/javascript">
                                if (navigator.geolocation) {
                                    navigator.geolocation.getCurrentPosition(success);
                                } else {
                                    alert("Geo Location is not supported on your current browser!");
                                }
                                function success(position) {
                                    var lat = position.coords.latitude;
                                    var long = position.coords.longitude;
                                    var city = position.coords.locality;
                                    var myLatlng = new google.maps.LatLng(lat, long);
                                    var myOptions = {
                                        center: myLatlng,
                                        zoom: 10,
                                        mapTypeId: google.maps.MapTypeId.ROADMAP
                                    };
                                    var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
                                    var marker = new google.maps.Marker({
                                        position: myLatlng,
                                        title: "lat: " + lat + " long: " + long
                                    });

                                    marker.setMap(map);
                                    var infowindow = new google.maps.InfoWindow({ content: "<b>User Address</b><br/> Latitude:" + lat + "<br /> Longitude:" + long + "" });
                                    infowindow.open(map, marker);
                                }
                            </script>

                        <form id="form1" runat="server">
                            <div id="map_canvas" style="width: 500px; height: 400px"></div>
                        </form>


                    </div>
                </div>
            </div>


        </div>
    </div><!-- .animated -->
    </div><!-- .content -->


<?php include_once('layout/footer.php'); ?>