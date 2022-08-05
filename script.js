function hideCheckout() {
    document.getElementById("payment-btn").style.display = "none";
}

let searchBox;
function initAutocomplete() {
  searchBox = new google.maps.places.Autocomplete(
    document.getElementById("search"),
    {
      componentRestrictions: { country: ["NG"] },
      fields: ["place_id", "geometry", "name"],
    }
  );
  searchBox.addListener("place_changed", onChange);
}

// Listen for the event fired when the user selects a prediction and retrieve
// more details for that place.

function onChange() {
// show payment button on checkout page
document.getElementById("payment-btn").style.display = "block";

// get location from map
  const place = searchBox.getPlace();

  // For the place, get the icon, name and location.
  const bounds = new google.maps.LatLngBounds();

  // The location of ososgbo
  const osogbo = { lat: 7.782671, lng: 4.541814 };
  // The map, centered at osogbo
  const map = new google.maps.Map(document.getElementById("map"), {
    zoom: 16,
    center: osogbo,
  });

  if (!place.geometry || !place.geometry.location) {
    alert("Place selected can't be located on map");
    return;
  }
  const icon = {
    url: place.icon,
    size: new google.maps.Size(71, 71),
    origin: new google.maps.Point(0, 0),
    anchor: new google.maps.Point(17, 34),
    scaledSize: new google.maps.Size(25, 25),
  };

  // Create a marker for each place.
  // const marker = new google.maps.Marker({
  //   map,
  //   icon,
  //   title: place.name,
  //   position: place.geometry.location,
  //   draggable: true
  // });

  var placeId = place.place_id;
  const geocoder = new google.maps.Geocoder();

  geocoder.geocode({ placeId: placeId }, function (results, status) {
    if (status == "OK") {
      map.setCenter(results[0].geometry.location);
      const marker = new google.maps.Marker({
        map: map,
        position: results[0].geometry.location,
        draggable: true,
      });

      console.log(results[0].formatted_address);
      google.maps.event.addListener(marker, "dragend", function () {
        console.log(this.getPosition());

        const latlng = {
          lat: this.getPosition().lat(),
          lng: this.getPosition().lng(),
        };

        geocoder
          .geocode({ location: latlng })
          .then((response) => {
            if (response.results[0]) {
              map.setZoom(17);
              const newMarker = new google.maps.Marker({
                position: latlng,
                map: map,
                draggable: true,
              });
              newMarker.setMap(null);

              document.getElementById("search").value =
                response.results[0].formatted_address;
              console.log(response.results[0].formatted_address);
            } else {
              window.alert("No results found");
            }
          })
          .catch((e) => window.alert("Geocoder failed due to: " + e));

        //   map.setCenter(results[0].geometry.location);
        // const marker = new google.maps.Marker({
        //     map: map,
        //     position: results[0].geometry.location,
        //     draggable: true
        // });
      });
    } else {
      alert("Geocode was not successful for the following reason: " + status);
    }
  });

  if (place.geometry.viewport) {
    console.log(place.geometry.viewport);

    // Only geocodes have viewport.
    bounds.union(place.geometry.viewport);
  } else {
    bounds.extend(place.geometry.location);
  }

  map.fitBounds(bounds);
}

function directionRequest() {
  const myDirection = new google.maps.DirectionService();
  myDirection.route({}, initDirection());
}

function initDirection() {}
function initMapp() {
  let directionsService = new google.maps.DirectionsService();
  let directionsRenderer = new google.maps.DirectionsRenderer();

  const osogbo2 = { lat: 7.782671, lng: 4.541814 };
  // The map, centered at osogbo
  const mapOptions = {
    zoom: 16,
    center: osogbo2,
  };

  let mapp = new google.maps.Map(document.getElementById("map2"), mapOptions);
  directionsRenderer.setMap(mapp);

  let start = "QGV8+8XQ, 230103, Osogbo, Nigeria";
  let end = document.getElementById("search").value;
  var request = {
    origin: start,
    destination: end,
    travelMode: "DRIVING",
  };
  directionsService.route(request, function (result, status) {
    if (status == "OK") {
      directionsRenderer.setDirections(result);
      console.log(result);
      console.log(result.routes[0].legs[0].distance.text);
      console.log(result.routes[0].legs[0].duration.text);
      console.log(result.routes[0].legs[0].end_address);
      console.log(result.routes[0].legs[0].start_address);
    }
  });
}


/* FLUTTERWAVE CHECKOUT FUNCTION */
  function makePayment() {
    FlutterwaveCheckout({
      public_key: "FLWPUBK_TEST-SANDBOXDEMOKEY-X",
      tx_ref: "titanic-48981487343MDI0NzMx",
      amount: 54600,
      currency: "NGN",
      payment_options: "card, banktransfer, ussd",
      redirect_url: "https://glaciers.titanic.com/handle-flutterwave-payment",
      meta: {
        consumer_id: 23,
        consumer_mac: "92a3-912ba-1192a",
      },
      customer: {
        email: "rose@unsinkableship.com",
        phone_number: "08102909304",
        name: "Rose DeWitt Bukater",
      },
      customizations: {
        title: "The Food Point",
        description: "Payment for tour order",
        logo: "https://i.ibb.co/gTBPJ48/logo.jpg",
      },
    });
  }


  /* MY ACCOUNT PAGE */
  function showProfile() {
    document.getElementById("account-title").innerText = "My Profile";
    document.getElementById("profile").style.display = "block";
    document.getElementById("update-profile").style.display = "none";
    document.getElementById("order-history").style.display = "none";
    document.getElementById("track-order").style.display = "none";
  }

  function showUpdateProfile() {
    document.getElementById("account-title").innerText = "Update Profile";
    document.getElementById("profile").style.display = "none";
    document.getElementById("update-profile").style.display = "block";
    document.getElementById("order-history").style.display = "none";
    document.getElementById("track-order").style.display = "none";
  }

  function showOrderHistory() {
    document.getElementById("account-title").innerText = "Order History";
    document.getElementById("profile").style.display = "none";
    document.getElementById("update-profile").style.display = "none";
    document.getElementById("order-history").style.display = "block";
    document.getElementById("track-order").style.display = "none";
  }

  function showTrackOrder() {
    document.getElementById("account-title").innerText = "Track Order";
    document.getElementById("profile").style.display = "none";
    document.getElementById("update-profile").style.display = "none";
    document.getElementById("order-history").style.display = "none";
    document.getElementById("track-order").style.display = "block";
  }