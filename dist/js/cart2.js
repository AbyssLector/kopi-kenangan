if (document.readyState == "loading") {
  document.addEventListener("DOMContentLoaded", ready);
} else {
  ready();
}
let cart = {
  'Kopi Kenangan Mantan': 0,
  'Kopi Susu': 0,
  'Kopi Bareng doi': 0,
  'Kopi Hitam': 0,
};
function ready() {
  var addToCartBtn = document.getElementsByClassName("btn-add-to-cart");
  for (var i = 0; i < addToCartBtn.length; i++) {
    var btn = addToCartBtn[i];
    btn.addEventListener("click", addToCartClicked);
  }

  var quantityInputs = document.getElementsByClassName("product-quantity");
  for (var i = 0; i < quantityInputs.length; i++) {
    var input = quantityInputs[i];
    input.addEventListener("change", quantityChanged);
  }
}

function quantityChanged(event) {
  var input = event.target;
  if (isNaN(input.value) || input.value <= 0) {
    input.value = 1;
  }
  updateCartTotal();
}

function addToCartClicked(event) {
  var button = event.target;
  var productDetail =
    button.parentElement.parentElement.parentElement.parentElement;
  //   console.log(productDetail);

  //get prodcut name
  var productName = productDetail.getElementsByClassName("product-name")[0];
  var name = productName.getElementsByTagName("h2")[0].innerText;

  // get product price
  var productPrices = productDetail.getElementsByClassName("product-price")[0];
  var productPrice = productPrices.getElementsByClassName("flex")[0];
  var price = parseFloat(
    productPrice.getElementsByTagName("p")[0].innerText.replace("Rp ", "")
  );
  addItemToCart(name, price);
  updateCartTotal();
}

function addItemToCart(name, price) {
  var cartContainer = document.getElementsByClassName("cart-container")[0];
  var cartRow = document.createElement("div");
  cartRow.classList.add("cart-row");
  var cartRowContents = `
    <div class="border-b py-5 flex justify-between product">
    <div class="my-auto product-details">
      <h3 class="font-bold">${name}</h3>
      <p>Rp ${price}</p>
    </div>
    <div class="my-auto product-quantities">
      <input class="product-quantity w-10 h-6 border-solid border text-center border-[#56CCF2] bg-[#eee]" type="number" value="1">
    </div>
  </div>
    `;
  cartRow.innerHTML = cartRowContents;
  cartContainer.append(cartRow);
  cart[name]++;
}

function updateCartTotal() {
  var cartContainer = document.getElementsByClassName("cart-container")[0];
  var cartRows = cartContainer.getElementsByClassName("cart-row");
  var total = 0;
  for (var i = 0; i < cartRows.length; i++) {
    var cartRow = cartRows[i];
    var product = cartRow.getElementsByClassName("product")[0];
    var prodcutDetails = product.getElementsByClassName("product-details")[0];
    var price = parseFloat(
      prodcutDetails.getElementsByTagName("p")[0].innerText.replace("Rp ", "")
    );
    var produtQuantities =
      product.getElementsByClassName("product-quantities")[0];
    var quantityElement =
      produtQuantities.getElementsByClassName("product-quantity")[0];
    var quantity = quantityElement.value;

    total = total + price * quantity;
  }

  document.getElementsByClassName("total-price")[0].innerText = "RP " + total;
}
function checkout() {
  // const str = document.getElementById("total_price").innerText;
  // const result = str.split(" ");
  // const price = Number(result[1]);
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
        alert("Purchased");
        alert(result.msg);
      } else {
        alert("failed");
        alert(result.msg);
      }
    }
  });
  // document.querySelector("#kopi_susu").classList.remove('hidden');

}