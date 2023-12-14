@extends('users.layouts.app')

<meta name="csrf-token" content="{{ csrf_token() }}">


@section('content')
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <div class="content-wrapper">
        <div id="map" style="height: 500px; display: none;"></div>
        {{-- <button onclick="checkIn()" class="btn bg-indigo ">Check-In</button> --}}
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-6">
                    <h2>Check-In/Check-Out</h2>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-12">
                    <button class="btn bg-indigo mr-2 " onclick="checkIn()">Check In</button>
                    <button class="btn bg-Maroon">Check Out</button>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>John Doe</td>
                            <td>Checked In</td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Jane Doe</td>
                            <td>Checked Out</td>
                        </tr>
                        <!-- Add more rows as needed -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@section('scripts')
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        var map = L.map('map').setView([0, 0], 13);
        var watchId;

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        function startTracking() {
            // Start continuous location tracking
            watchId = navigator.geolocation.watchPosition(
                function(position) {
                    // Update map
                    var marker = L.marker([position.coords.latitude, position.coords.longitude]).addTo(map);
                    map.panTo(new L.LatLng(position.coords.latitude, position.coords.longitude));
                    console.log(position.coords.latitude, position.coords.longitude);
                    toastr.success(position.coords.latitude, position.coords.longitude,'Long');
                    // Store the current location in variables accessible to checkIn function
                    currentLatitude = position.coords.latitude;
                    currentLongitude = position.coords.longitude;
                },
                function(error) {
                    toastr.error(error.message,'Error getting location:');
                }, {
                    enableHighAccuracy: true,
                    timeout: 5000,
                    maximumAge: 0
                }
            );
            console.log(watchId);
        }

        function stopTracking() {
            // Stop location tracking
            navigator.geolocation.clearWatch(watchId);
        }

        function checkIn() {
            if (typeof currentLatitude === 'undefined' || typeof currentLongitude === 'undefined') {
                // Show toastr message
                toastr.error('Please ensure your location is enabled and try again.');
                // Prevent further execution
                return;
            }
            // Send AJAX request to log the current location
            $.ajax({
                type: 'POST',
                url: '{{route('attendance.store')}}',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    latitude: currentLatitude,
                    longitude: currentLongitude
                },
                success: function(response) {
                    toastr.info(response);
                },
                error: function(error) {
                    toastr.error('Error checking in:', error);
                }
            });
        }

        // Start tracking when the page loads
        startTracking();
    </script>
@endsection
@endsection
