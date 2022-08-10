function hideCheckout() {
  document.getElementById("payment-btn").style.display = "none";
}
let newCart = JSON.parse(localStorage.getItem('cart'));
for (let i = 0; i < newCart.length; i++) {
  var checkoutContent = `
  <div class="checkout-card">
    <p>--> ${newCart[i].quantity}no of ${newCart[i].name} at a total price of $${newCart[i].price}</p>
  </div>`

  var checkoutRow = document.createElement('div')
  checkoutRow.classList.add('chackout-card')
  checkoutRow.innerHTML = checkoutContent
  document.getElementsByClassName('checkout-group-container')[0].append(checkoutRow)

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

  /* ADMIN DASHBOARD PAGE */
  function showFoodPoint() {
    document.getElementById("admin-title").innerText = "Dashboard";
    document.getElementById("food-point").style.display = "block";
    document.getElementById("upload-product").style.display = "none";
    document.getElementById("add-dispatch").style.display = "none";
    document.getElementById("dispatch-list").style.display = "none";
    document.getElementById("incoming-order").style.display = "none";
    document.getElementById("track-dispatch").style.display = "none";
  }

  function showAddDispatch() {
    document.getElementById("admin-title").innerText = "Add Dispatch";
    document.getElementById("food-point").style.display = "none";
    document.getElementById("upload-product").style.display = "none";
    document.getElementById("add-dispatch").style.display = "block";
    document.getElementById("dispatch-list").style.display = "none";
    document.getElementById("incoming-order").style.display = "none";
    document.getElementById("track-dispatch").style.display = "none";
  }

  function showIncomingOrder() {
    document.getElementById("admin-title").innerText = "Incoming Order";
    document.getElementById("food-point").style.display = "none";
    document.getElementById("upload-product").style.display = "none";
    document.getElementById("add-dispatch").style.display = "none";
    document.getElementById("dispatch-list").style.display = "none";
    document.getElementById("incoming-order").style.display = "block";
    document.getElementById("track-dispatch").style.display = "none";
  }

  function showTrackDispatch() {
    document.getElementById("admin-title").innerText = "Track Dispatch";
    document.getElementById("food-point").style.display = "none";
    document.getElementById("upload-product").style.display = "none";
    document.getElementById("add-dispatch").style.display = "none";
    document.getElementById("dispatch-list").style.display = "none";
    document.getElementById("incoming-order").style.display = "none";
    document.getElementById("track-dispatch").style.display = "block";
  }

  function showDispatchList() {
    document.getElementById("admin-title").innerText = "Dispatch List";
    document.getElementById("food-point").style.display = "none";
    document.getElementById("upload-product").style.display = "none";
    document.getElementById("add-dispatch").style.display = "none";
    document.getElementById("dispatch-list").style.display = "block";
    document.getElementById("incoming-order").style.display = "none";
    document.getElementById("track-dispatch").style.display = "none";
  }

  function showUploadProduct() {
    document.getElementById("admin-title").innerText = "Upload Product";
    document.getElementById("food-point").style.display = "none";
    document.getElementById("upload-product").style.display = "block";
    document.getElementById("add-dispatch").style.display = "none";
    document.getElementById("dispatch-list").style.display = "none";
    document.getElementById("incoming-order").style.display = "none";
    document.getElementById("track-dispatch").style.display = "none";
  }

  /* CATEGORY PAGE */
  function showCategories() {
    document.getElementById("category-title").innerText = "All Products";
    document.getElementById("all-products").style.display = "block";
    document.getElementById("cereals").style.display = "none";
    document.getElementById("drinks").style.display = "none";
    document.getElementById("fruits").style.display = "none";
    document.getElementById("swallow").style.display = "none";
  }
  
  function showCereals() {
    document.getElementById("category-title").innerText = "Cereals";
    document.getElementById("all-products").style.display = "none";
    document.getElementById("cereals").style.display = "block";
    document.getElementById("drinks").style.display = "none";
    document.getElementById("fruits").style.display = "none";
    document.getElementById("swallow").style.display = "none";
  }

  function showDrinks() {
    document.getElementById("category-title").innerText = "Drinks";
    document.getElementById("all-products").style.display = "none";
    document.getElementById("cereals").style.display = "none";
    document.getElementById("drinks").style.display = "block";
    document.getElementById("fruits").style.display = "none";
    document.getElementById("swallow").style.display = "none";
  }

  function showFruits() {
    document.getElementById("category-title").innerText = "Fruits";
    document.getElementById("all-products").style.display = "none";
    document.getElementById("cereals").style.display = "none";
    document.getElementById("drinks").style.display = "none";
    document.getElementById("fruits").style.display = "block";
    document.getElementById("swallow").style.display = "none";
  }

  function showSwallow() {
    document.getElementById("category-title").innerText = "Swallow";
    document.getElementById("all-products").style.display = "none";
    document.getElementById("cereals").style.display = "none";
    document.getElementById("drinks").style.display = "none";
    document.getElementById("fruits").style.display = "none";
    document.getElementById("swallow").style.display = "block";
  }


  /* CART PAGE */

if (document.readyState == 'loading') {
  document.addEventListener('DOMContentLoaded', ready)
} else {
  ready()
}

function ready() {
  var removeCartItemButtons = document.getElementsByClassName('cart-remove-btn')
  for (var i = 0; i < removeCartItemButtons.length; i++) {
      var button = removeCartItemButtons[i]
      button.addEventListener('click', removeCartItem)
  }

  var quantityInputs = document.getElementsByClassName('cart-quantity-input')
  for (var i = 0; i < quantityInputs.length; i++) {
      var input = quantityInputs[i]
      input.addEventListener('change', quantityChanged)
  }

  var addToCartButtons = document.getElementsByClassName('order-btn')
  for (var i = 0; i < addToCartButtons.length; i++) {
      var button = addToCartButtons[i]
      button.addEventListener('click', addToCartClicked)
  }
  document.getElementsByClassName('purchase-btn')[0].addEventListener('click', purchaseClicked)
}

let cartList = [];

function purchaseClicked() {
  // alert('Thank you for your purchase')
  var cartFinalItems = document.getElementsByClassName('cart-group')[0]
  var cartFinalRows = cartFinalItems.getElementsByClassName('cart-card')
  for (var i = 0; i < cartFinalRows.length; i++) {
      var cartFinalRow = cartFinalRows[i]
      var priceFinalPrice =  parseFloat(cartFinalRow.getElementsByClassName('cart-price')[0].innerText.replace('$', ''))
      var productFinalTitle = cartFinalRow.getElementsByClassName('cart-item-title')[0].innerText
      var productFinalQuantity = cartFinalRow.getElementsByClassName('cart-quantity-input')[0].value
      var productFinalId = cartFinalRow.getElementsByClassName('cart-id-input')[0].value
      const cartFinalData = {
        id: productFinalId,
        name: productFinalTitle,
        price: priceFinalPrice,
        quantity: productFinalQuantity,
      }
      cartList.push(cartFinalData);
  }
  localStorage.setItem('cart', JSON.stringify(cartList));

  window.location.href = "/delivery/checkout.php";
  while (cartFinalItems.hasChildNodes()) {
      cartFinalItems.removeChild(cartFinalItems.firstChild)
  }
  updateCartTotal()
}

// function sendToCheckout(data) {
//   var checkoutContent = `
//   <h5>You want to check out the following</h5>
//   <div class="checkout-card" index="${item.id}">
//     <h6>${item.quantity}</h6>
//     <h6>${item.name}</h6>
//     <h6>${item.price}</h6>
//   </div>`
//   document.getElementsByClassName('checkout-group-container')[0].innerHTML =  data.forEach(item => {checkoutContent})
// }
// console.log(cartList)

function removeCartItem(event) {
  var buttonClicked = event.target
  buttonClicked.parentElement.remove()
  updateCartTotal()
}

function quantityChanged(event) {
  var input = event.target
  if (isNaN(input.value) || input.value <= 0) {
      input.value = 1
  }
  updateCartTotal()
}


function addToCartClicked(event) {
  var button = event.target
  var shopItem = button.parentElement
  var title = shopItem.getElementsByClassName('product-item-title')[0].innerText
  var price = shopItem.getElementsByClassName('product-item-price')[0].innerText
  var productId = shopItem.getElementsByClassName('product-input')[0].value
  var imageSrc = shopItem.getElementsByClassName('product-item-image')[0].src
  addItemToCart(title, price, imageSrc,productId)
  updateCartTotal()
}

function addItemToCart(title, price, imageSrc, productId) {
  var cartRow = document.createElement('div')
  cartRow.classList.add('cart-card')
  var cartItems = document.getElementsByClassName('cart-group')[0]
  var cartItemNames = cartItems.getElementsByClassName('cart-item-title')
  for (var i = 0; i < cartItemNames.length; i++) {
      if (cartItemNames[i].innerText == title) {
          alert('This item is already added to the cart')
          return
      }
  }
  var cartRowContents = `
    <div class='cart-img-header'>
    <img src='${imageSrc}' height='100' width='100' alt='Product Image' />
    <div class='cart-card-text'>
        <h6 class="cart-item-title">${title}</h6>
        <p class="cart-price">${price}</p>
    </div>
  </div>
  <input type='hidden' class='cart-id-input' value='${productId}'/>
  <input type='number' class='cart-quantity-input' value='1'/>
  <button type='button' class='cart-remove-btn'>REMOVE</button>
  <hr />`
  cartRow.innerHTML = cartRowContents
  cartItems.append(cartRow)
  cartRow.getElementsByClassName('cart-remove-btn')[0].addEventListener('click', removeCartItem)
  cartRow.getElementsByClassName('cart-quantity-input')[0].addEventListener('change', quantityChanged)
}

function updateCartTotal() {
  var cartItemContainer = document.getElementsByClassName('cart-group')[0]
  var cartRows = cartItemContainer.getElementsByClassName('cart-card')
  var total = 0
  for (var i = 0; i < cartRows.length; i++) {
      var cartRow = cartRows[i]
      var priceElement = cartRow.getElementsByClassName('cart-price')[0]
      var quantityElement = cartRow.getElementsByClassName('cart-quantity-input')[0]
      var price = parseFloat(priceElement.innerText.replace('$', ''))
      var quantity = quantityElement.value
      total = total + (price * quantity)
  }
  total = Math.round(total * 100) / 100
  document.getElementsByClassName('cart-total-price')[0].innerText = '$' + total
}
