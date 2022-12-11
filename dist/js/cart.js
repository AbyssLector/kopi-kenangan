// Add To Cart

// Kenangan Mantan
var kkmToCart = document.querySelector("#kkm-add");
kkmToCart.addEventListener("click", kkmToCartClicked);

function kkmToCartClicked() {
  document.querySelector("#kkm-quantity").innerText = "1";
  document.querySelector("#kkm-cart").classList.remove("hidden");

  updateCartTotal();
}

// Kopi hitam
var hitamToCart = document.querySelector("#hitam-add");
hitamToCart.addEventListener("click", hitamToCartClicked);

function hitamToCartClicked() {
  document.querySelector("#hitam-quantity").innerText = "1";
  document.querySelector("#hitam-cart").classList.remove("hidden");

  updateCartTotal();
}

// Kopi Bareng Doi
var kbdToCart = document.querySelector("#kbd-add");
kbdToCart.addEventListener("click", kbdToCartClicked);

function kbdToCartClicked() {
  document.querySelector("#kbd-quantity").innerText = "1";
  document.querySelector("#kbd-cart").classList.remove("hidden");

  updateCartTotal();
}

// Kopi Susu
var susuToCart = document.querySelector("#susu-add");
susuToCart.addEventListener("click", susuToCartClicked);

function susuToCartClicked() {
  document.querySelector("#susu-quantity").innerText = "1";
  document.querySelector("#susu-cart").classList.remove("hidden");

  updateCartTotal();
}

// Increase Quantity

// Kenangan Mantan
var plusKKm = document.querySelector("#plus-kkm");
plusKKm.addEventListener("click", tambahKkm);

function tambahKkm() {
  var quantity = parseFloat(document.querySelector("#kkm-quantity").innerText);
  quantity++;
  document.querySelector("#kkm-quantity").innerText = quantity;

  updateCartTotal();
}

// Kopi Susu
var plusSusu = document.querySelector("#plus-susu");
plusSusu.addEventListener("click", tambahSusu);

function tambahSusu() {
  var quantity = parseFloat(document.querySelector("#susu-quantity").innerText);
  quantity++;

  document.querySelector("#susu-quantity").innerText = quantity;
  updateCartTotal();
}

// Kopi Bareng Doi
var plusKbd = document.querySelector("#plus-kbd");
plusKbd.addEventListener("click", tambahKbd);

function tambahKbd() {
  var quantity = parseFloat(document.querySelector("#kbd-quantity").innerText);
  quantity++;

  document.querySelector("#kbd-quantity").innerText = quantity;
  updateCartTotal();
}

// Kopi Hitam
var plusHitam = document.querySelector("#plus-hitam");
plusHitam.addEventListener("click", tambahHitam);

function tambahHitam() {
  var quantity = parseFloat(
    document.querySelector("#hitam-quantity").innerText
  );
  quantity++;

  document.querySelector("#hitam-quantity").innerText = quantity;
  updateCartTotal();
}

// Decrease Quantity

// Kenangan Mantan
var minKkm = document.querySelector("#min-kkm");
minKkm.addEventListener("click", kurangKkm);

function kurangKkm() {
  var quantity = parseFloat(document.querySelector("#kkm-quantity").innerText);
  quantity--;
  if (quantity == 0) {
    document.querySelector("#kkm-quantity").innerText = quantity;
    document.querySelector("#kkm-cart").classList.add("hidden");
  } else {
    document.querySelector("#kkm-quantity").innerText = quantity;
  }

  updateCartTotal();
}

// Kopi Susu
var minSusu = document.querySelector("#min-susu");
minSusu.addEventListener("click", kurangSusu);

function kurangSusu() {
  var quantity = parseFloat(document.querySelector("#susu-quantity").innerText);
  quantity--;
  if (quantity == 0) {
    document.querySelector("#susu-quantity").innerText = quantity;
    document.querySelector("#susu-cart").classList.add("hidden");
  } else {
    document.querySelector("#susu-quantity").innerText = quantity;
  }

  updateCartTotal();
}

// Kopi Bareng Doi
var minKbd = document.querySelector("#min-kbd");
minKbd.addEventListener("click", kurangKbd);

function kurangKbd() {
  var quantity = parseFloat(document.querySelector("#kbd-quantity").innerText);
  quantity--;
  if (quantity == 0) {
    document.querySelector("#kbd-quantity").innerText = quantity;
    document.querySelector("#kbd-cart").classList.add("hidden");
  } else {
    document.querySelector("#kbd-quantity").innerText = quantity;
  }

  updateCartTotal();
}

// Kopi Hitam
var minHitam = document.querySelector("#min-hitam");
minHitam.addEventListener("click", kurangHitam);

function kurangHitam() {
  var quantity = parseFloat(
    document.querySelector("#hitam-quantity").innerText
  );
  quantity--;
  if (quantity == 0) {
    document.querySelector("#hitam-quantity").innerText = quantity;
    document.querySelector("#hitam-cart").classList.add("hidden");
  } else {
    document.querySelector("#hitam-quantity").innerText = quantity;
  }

  updateCartTotal();
}

// Update Total Harga

function updateCartTotal() {
  var cartContainer = document.getElementsByClassName("cart-container")[0];
  var products = cartContainer.getElementsByClassName("product");
  var total = 0;
  for (var i = 0; i < products.length; i++) {
    var product = products[i];
    var prodcutDetails = product.getElementsByClassName("product-details")[0];
    var price = parseFloat(
      prodcutDetails.getElementsByTagName("p")[0].innerText.replace("Rp ", "")
    );
    var produtQuantities =
      product.getElementsByClassName("product-quantities")[0];
    var quantityElement =
      produtQuantities.getElementsByClassName("product-quantity")[0];
    var quantity = parseFloat(quantityElement.innerText);

    total = total + price * quantity;
  }

  document.getElementsByClassName("total-price")[0].innerText = "Rp " + total;
}
function checkout() {
  // const str = document.getElementById("total_price").innerText;
  // const result = str.split(" ");
  // const price = Number(result[1]);

  let cart = {
    'Kopi Kenangan Mantan': Number(document.querySelector("#kkm-quantity").innerText),
    'Kopi Susu': Number(document.querySelector("#susu-quantity").innerText),
    'Kopi Bareng doi': Number(document.querySelector("#kbd-quantity").innerText),
    'Kopi Hitam': Number(document.querySelector("#hitam-quantity").innerText),
  };
  const data = JSON.stringify(cart);
  // alert(data);
  $.ajax({
    url: "http://localhost/kopi-kenangan/controller/checkout.php",
    type: 'POST',
    data: data,
    success: function (res) {
      console.log(res);
      const result = JSON.parse(res);
      if (result.status == 200) {
        // alert("Purchased");
        alert(result.msg);
        window.location.replace('http://localhost/kopi-kenangan/success.php');
      } else {
        alert("failed");
        alert(result.msg);
      }
    }
  });
  // document.querySelector("#kopi_susu").classList.remove('hidden');
}