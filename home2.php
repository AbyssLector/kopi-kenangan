<?php
session_start();
error_reporting(0);
// die($_SESSION['notelp'] . $_SESSION['username']);
if (!isset($_SESSION['notelp']) && !isset($_SESSION['username']) && !isset($_SESSION['jwt'])) {
  header("Location: login.php");
  exit();
}
$url = 'http://localhost:3000/api/users';
$authorization = "Authorization: Bearer " . $_SESSION['jwt'];
// echo $fields_string;

//open connection
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", $authorization));
$result = curl_exec($ch);
$result = json_decode($result);
if (!$result->data->user_balance) {
  $balance = "Rp. -";
} else {
  $balance = "Rp. " . number_format($result->data->user_balance, 2, ',', '.');
}
// echo $_REQUEST['price'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kopi Kenangan - Cart</title>
  <!-- <link rel="stylesheet" href="dist/output.css"> -->
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="dist/js/cart.js" async></script>
</head>

<body>
  <!-- Header Start -->
  <header class="bg-white fixed top-0 left-0 w-full flex items-center z-50 mb-0">
    <div class="container mx-auto w-[85%]">
      <div class="flex items-center justify-between relative">
        <img src="dist/img/logo.png" alt="logo kopken" class="w-20 block py-4 pl-6">
        <div class="flex items-center">
          <button id="hamburger" name="hamburger" type="button" class="block absolute right-4 lg:hidden">
            <span class="hamburger-line origin-top-left transition duration-300 ease-in-out"></span>
            <span class="hamburger-line transition duration-300 ease-in-out"></span>
            <span class="hamburger-line origin-bottom-left transition duration-300 ease-in-out"></span>
          </button>

          <nav id="nav-menu" class="hidden absolute py-5 bg-white shadow-lg rounded-lg max-w-[250px] w-full right-4 top-full lg:block lg:static lg:bg-transparent lg:max-w-full lg:shadow-none lg:rounded-none">
            <ul class="block lg:flex">
              <li class="group">
                <a href="#" class="text-base text-black py-2 mx-8 flex group-hover:text-[#BB2028]">Home</a>
              </li>
              <li class="group">
                <a href="#" class="text-base text-black py-2 mx-8 flex group-hover:text-[#BB2028]">History</a>
              </li>
              <li class="group">
                <a href="#" class="text-base text-black py-2 mx-8 flex group-hover:text-[#BB2028]">Login</a>
              </li>
              <li class="group">
                <a href="#" class="text-base text-black py-2 mx-8 flex group-hover:text-[#BB2028]">Logout</a>
              </li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </header>
  <!-- Header End -->

  <!-- Product Section Start -->
  <section id="product" class="px-32 py-2 bg-[#F4F4F4]">
    <div class="flex flex-wrap mt-28 mb-32">
      <div class="w-3/5 pr-5">
        <div class="grid grid-cols-2 gap-6 w-full product-container">
          <div class="relative mx-auto w-full product-card">
            <div class="shadow-lg p-4 rounded-lg bg-white product-detail">
              <div class="flex justify-center relative rounded-lg overflow-hidden h-52">
                <img src="dist/img/placeholder.png" alt="makan" class="p-8 rounded-t-lg" />
              </div>
              <div class="mt-1 product-name">
                <h2 class="font-bold text-base md:text-lg text-gray-800">Kopi Kenangan Mantan</h2>
              </div>
              <div class="grid grid-cols-2 mt-2 product-price">
                <div class="flex items-center">
                  <p class="text-sm text-gray-800">Rp 17000</p>
                </div>
                <div class="flex justify-end">
                  <button class="btn-add-to-cart bg-[#BB2028] w-7 h-7 rounded-full text-white hover:bg-opacity-80">
                    <i class="fa-solid fa-plus "></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
          <div class="relative mx-auto w-full product-card">
            <div class="shadow-lg p-4 rounded-lg bg-white product-detail">
              <div class="flex justify-center relative rounded-lg overflow-hidden h-52">
                <img src="dist/img/placeholder.png" alt="makan" class="p-8 rounded-t-lg" />
              </div>
              <div class="mt-1 product-name">
                <h2 class="font-bold text-base md:text-lg text-gray-800">Kopi Susu</h2>
              </div>
              <div class="grid grid-cols-2 mt-2 product-price">
                <div class="flex items-center">
                  <p class="text-sm text-gray-800">Rp 18000</p>
                </div>
                <div class="flex justify-end">
                  <button class="btn-add-to-cart bg-[#BB2028] w-7 h-7 rounded-full text-white hover:bg-opacity-80">
                    <i class="fa-solid fa-plus "></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
          <div class="relative mx-auto w-full product-card">
            <div class="shadow-lg p-4 rounded-lg bg-white product-detail">
              <div class="flex justify-center relative rounded-lg overflow-hidden h-52">
                <img src="dist/img/placeholder.png" alt="makan" class="p-8 rounded-t-lg" />
              </div>
              <div class="mt-1 product-name">
                <h2 class="font-bold text-base md:text-lg text-gray-800">Kopi Bareng doi</h2>
              </div>
              <div class="grid grid-cols-2 mt-2 product-price">
                <div class="flex items-center">
                  <p class="text-sm text-gray-800">Rp 19000</p>
                </div>
                <div class="flex justify-end">
                  <button class="btn-add-to-cart bg-[#BB2028] w-7 h-7 rounded-full text-white hover:bg-opacity-80">
                    <i class="fa-solid fa-plus "></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
          <div id="kopi_susu" class="relative mx-auto w-full product-card hidden">
            <div class="shadow-lg p-4 rounded-lg bg-white product-detail">
              <div class="flex justify-center relative rounded-lg overflow-hidden h-52">
                <img src="dist/img/placeholder.png" alt="makan" class="p-8 rounded-t-lg" />
              </div>
              <div class="mt-1 product-name">
                <h2 class="font-bold text-base md:text-lg text-gray-800">Kopi Hitam</h2>
              </div>
              <div class="grid grid-cols-2 mt-2 product-price">
                <div class="flex items-center">
                  <p class="text-sm text-gray-800">Rp 20000</p>
                </div>
                <div class="flex justify-end">
                  <button class="btn-add-to-cart bg-[#BB2028] w-7 h-7 rounded-full text-white hover:bg-opacity-80">
                    <i class="fa-solid fa-plus "></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="w-full lg:w-2/5 pl-5 border-l-[1.5px]">
        <div name="list-item" class="bg-white rounded-xl shadow-lg overflow-hidden mb-10">
          <div class="container mx-auto px-7 cart-container">
          </div>
        </div>
        <div name="invoice" class="bg-white rounded-xl overflow-hidden shadow-lg mb-10">
          <div class="container mx-auto my-5 px-7">
            <h3 class="text-black font-bold">Saldo</h3>
            <div class="mt-2 flex items-center justify-between relative">
              <img src="dist/img/logo-gopay.png" alt="gopay" class="inline-block w-[66px]">
              <p class="inline-block font-bold"><?= $balance ?></p>
            </div>
            <hr class="mt-5">
            <h3 class="mt-2 text-black font-bold">Detail Pembayaran</h3>
            <div class="mt-2 flex items-center justify-between relative">
              <p>Total Harga</p>
              <p id="total_price" class="inline-block total-price">Rp 0</p>
            </div>
            <button onclick="checkout();" class="w-full py-2 mt-6 bg-[#BB2028] rounded-xl text-white font-bold text-center hover:opacity-80">Checkout</button>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Produt Section End -->

  <!-- Footer Start -->
  <footer class="bg-black pt-24 pb-12">
    <div class="flex flex-wrap ">
      <div class="w-full px-4 mb-12">
        <h3 class="text-white text-center mb-4">Copyright @2022 <span class="font-bold">AIS 7 & 10 Team</span> 😊😊</h3>
        <h3 class="text-white text-center">This web is made for AIS Class final project</h3>
      </div>
    </div>
  </footer>
  <!-- Footer End -->
  <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
  <script src="dist/js/script.js"></script>
</body>

</html>