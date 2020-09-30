
    <script>  
        var map;
        var marker = null;
        var placeMarker = null;

        function done() {
            if (!page.post.lat && !page.post.lng) {
                errorToast('{{ __("mobile.choose_location") }}');
                return;
            }

            $("#mapPicker").hide();
        }
        
        function getCurrentLocation() {
            getLocation(function(latlng){
                page.post.lat=latlng.lat; 
                page.post.lng = latlng.lng;  
                var p = new google.maps.LatLng(lat, lng);
                placeMarker(p, map);
                $("#mapPicker").hide();
            });
        }

        function initMap() { 
            map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: 30.0455965, lng: 31.2387195},
                zoom: 14
            });

            google.maps.event.addListener(map, 'click', function (e) {
                placeMarker(e.latLng, map);
            });

            placeMarker = function(position, map) {
                try {
                    marker.setMap(null);
                } catch (e) {
                }
                marker = new google.maps.Marker({
                    position: position,
                    map: map
                });
                page.post.lat = position.lat();
                page.post.lng = position.lng();
 
                map.panTo(position);
            }

        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD4ow5PXyqH-gJwe2rzihxG71prgt4NRFQ&libraries=places&callback=initMap"
    async defer></script>