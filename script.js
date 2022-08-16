if (window.location.href.match('checkout.php')){
window.addEventListener('load', hideCheckout);
let userData = JSON.parse(sessionStorage.getItem('mydata'))
document.getElementById("payment-btn").addEventListener('click', () => {
  $tx_ref = "food-point-" + Math.floor(Math.random() * 999999999999999);
  $order_name = Math.floor(Math.random() * 9999) + '-' + Math.floor(Math.random() * 9999) + '-' + Math.floor(Math.random() * 9999);
  $amount = sessionStorage.getItem('cart-total-price');
  $delivery_location = document.getElementById("search").value;

  let eachItem = JSON.parse(localStorage.getItem('cart'))
  for (let i = 0; i < eachItem.length; i++) {
    eachItem[i]['order-name'] = $order_name;
  }

  /* FLUTTERWAVE CHECKOUT FUNCTION */
  FlutterwaveCheckout({
    public_key: "FLWPUBK_TEST-b81e1965b64a823fecfa2e5cef0783bd-X",
    tx_ref: $tx_ref,
    amount: $amount,
    currency: "USD",
    payment_options: "card",
    callback: function (payment) {
      if (payment.status === "successful") {
        console.log(payment);
      localStorage.setItem('payment', JSON.stringify(payment));
        UpdateOrderDetails({
        order_name: $order_name,
        status: payment.status,
        tx_ref: payment.tx_ref,
        tx_id: payment.transaction_id
        })
        alert("Payment was successful")
      };
      SendEachProductDetails(eachItem)
    },
    onclose: function(incomplete) {
      if (incomplete || window.verified === false) {
          UpdateOrderDetails({
            order_name: $order_name,
            status: "failed",
            tx_ref: "",
            tx_id: "",
            })
        } else {
          window.location.href = "account.php#order-history"
        }
    },
    meta: {
      user_id: userData.userId,
      order_name: $order_name,
      delivery_location: $delivery_location
    },
    customer: {
      email: userData.email,
      phone_number: userData.phoneNumber,
      name: userData.name,
    },
    customizations: {
      title: "The Food Point",
      description: "Payment for food order",
      logo: "https://i.ibb.co/gTBPJ48/logo.jpg",
    },
  });

  SendOrderDetails({
    user_id: userData.userId,
    order_name: $order_name,
    amount: $amount,
    status: "pending",
    delivery_location: $delivery_location
  });
})

}

function SendEachProductDetails (eachItem) {
  axios.post('dataserver-each-product.php', eachItem)
  .then(response => {
    console.log(response);
})
.catch(error => {
    console.log(error)
})
}

function UpdateOrderDetails(updateData) {
  axios.post('dataserver-update.php', updateData)
  .then(response => {
    console.log(response);
})
.catch(error => {
    console.log(error)
})
}

function SendOrderDetails(uploadData) {
  axios.post('dataserver.php', uploadData)
  .then(response => {
    console.log(response);
})
.catch(error => {
    console.log(error)
})
}
function hideCheckout() {
  document.getElementById("payment-btn").style.display = "none";

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
}

if (window.location.href.match('account.php')){
  userData = {
    userId: document.getElementById('details-id').value,
    email: document.getElementById('details-email').innerText,
    phoneNumber: document.getElementById('details-phone').innerText,
    name: document.getElementById('details-fullname').innerText,
    }
    sessionStorage.setItem('mydata', JSON.stringify(userData));
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

      google.maps.event.addListener(marker, "dragend", function () {

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
              // Get Delivery Position
              document.getElementById("search").value =
                response.results[0].formatted_address;
            } else {
              window.alert("No results found");
            }
          })
          .catch((e) => window.alert("Geocoder failed due to: " + e));
      });
    } else {
      alert("Geocode was not successful for the following reason: " + status);
    }
  });

  if (place.geometry.viewport) {
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

// function initDirection() {}
function initMapp(location) {
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
// food point location
  let start = "17 Adetoro Rd, 230103, Osogbo, Nigeria";
  let end = location;
  var request = {
    origin: start,
    destination: end,
    travelMode: "DRIVING",
  };
  directionsService.route(request, function (result, status) {
    if (status == "OK") {
      directionsRenderer.setDirections(result);
      document.getElementById("user-delivery-distance").innerText = result.routes[0].legs[0].distance.text;
      document.getElementById("user-delivery-time").innerText = result.routes[0].legs[0].duration.text;
      document.getElementById("user-delivery-location").innerText = result.routes[0].legs[0].end_address;
    }
  });
}

/* ORDER TRACKING */
// if (window.location.href.match('account.php#track-order')){
document.getElementById("user-order-number").addEventListener("change", () => {
  let orderNumber = document.getElementById("user-order-number").value.trim();

document.getElementById("track-order-btn").addEventListener("click", trackingOrder);

function trackingOrder() {
  sendOrderNumber({number: orderNumber});
}

function sendOrderNumber(trackingData) {
  axios.post('dataserver-tracking.php', trackingData)
  .then(response => {
    k=1;
let productList = response.data.all_user_products_result;
    for (let i = 0; i < productList.length; i++) {
      var productListContent = `
      <tr>
           <td>${k++}</td>
           <td>${productList[i].product_quantity}</td>
           <td>${productList[i].product_title}</td>
           <td>$${productList[i].product_price}</td>
      </tr>`

      var productListRow = document.createElement('tr')
      productListRow.innerHTML = productListContent
      document.getElementById('track-order-list').append(productListRow)
    }
 document.getElementById("user-total-amount").innerText = "$" + response.data.delivery_result.order_amount;
 document.getElementById("order-name").innerText = response.data.delivery_result.order_name;
 initMapp(response.data.delivery_result.delivery_location);

})
.catch(error => {
    console.log(error)
})
}
});
// }
  /* MY ACCOUNT PAGE */
  function showProfile() {
    showLoader()
    document.getElementById("account-title").innerText = "My Profile";
    // document.getElementById("account-page").style.display = "block";
    document.getElementById("profile").style.display = "block";
    document.getElementById("update-profile").style.display = "none";
    document.getElementById("order-history").style.display = "none";
    document.getElementById("track-order").style.display = "none";
  }

  function showUpdateProfile() {
    showLoader()
    document.getElementById("account-title").innerText = "Update Profile";
    document.getElementById("profile").style.display = "none";
    document.getElementById("update-profile").style.display = "block";
    document.getElementById("order-history").style.display = "none";
    document.getElementById("track-order").style.display = "none";
  }

  function showOrderHistory() {
    showLoader()
    document.getElementById("account-title").innerText = "Order History";
    document.getElementById("profile").style.display = "none";
    document.getElementById("update-profile").style.display = "none";
    document.getElementById("order-history").style.display = "block";
    document.getElementById("track-order").style.display = "none";
  }

  function showTrackOrder() {
    showLoader()
    document.getElementById("account-title").innerText = "Track Order";
    document.getElementById("profile").style.display = "none";
    document.getElementById("update-profile").style.display = "none";
    document.getElementById("order-history").style.display = "none";
    document.getElementById("track-order").style.display = "block";
  }

  function showLoader() {
    document.getElementById("loader").style.display = "block";
    document.getElementById("bk").style.display = "block";
    setTimeout( () => {
      document.getElementById("loader").style.display = "none";
      document.getElementById("bk").style.display = "none";
    }, 1000)
    
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
  // while (cartFinalItems.hasChildNodes()) {
  //     cartFinalItems.removeChild(cartFinalItems.firstChild)
  // }
  updateCartTotal()
}


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

  sessionStorage.setItem('cart-total-price', total)
}


