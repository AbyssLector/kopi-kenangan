<?php
include 'config/db.php';
session_start();
error_reporting(0);
if (!isset($_SESSION['notelp']) && !isset($_SESSION['username']) && !isset($_SESSION['jwt'])) {
  header("Location: login.php");
  exit();
}
$sql = "SELECT * FROM transaction WHERE notelp={$_SESSION['notelp']}";
$result = $conn->query($sql);


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
                <a href="home.php" class="text-base text-black py-2 mx-8 flex group-hover:text-[#BB2028]">Home</a>
              </li>
              <li class="group">
                <a href="history.php" class="text-base text-black py-2 mx-8 flex group-hover:text-[#BB2028]">History</a>
              </li>
              <li class="group">
                <a href="logout.php" class="text-base text-black py-2 mx-8 flex group-hover:text-[#BB2028]">Logout</a>
              </li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </header>
  <!-- Header End -->

  <!-- Table Section Start -->
  <section class="mt-20">
    <div class="py-5 mb-20">
      <h3 class="font-bold text-center text-4xl">Transaction History</h3>
    </div>
    <div class="md:px-32 py-8 w-full mb-12">
      <div class="shadow overflow-hidden rounded border-b border-gray-200">
        <table class="min-w-full bg-white mb-20">
          <thead class="bg-gray-800 text-white">
            <tr>
              <th class="text-left py-3 px-4 uppercase font-semibold text-sm">No</th>
              <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Amount</th>
              <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Items</th>
              <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Date</td>
            </tr>
          </thead>
          <tbody class="text-gray-700">
            <?php
            $i = 1;
            while ($row = $result->fetch_assoc()) : ?>
              <tr>
                <td class="text-left py-3 px-4"><?= $i; ?></td>
                <td class="text-left py-3 px-4"><?= "Rp. " . number_format($row['amount'], 2, ',', '.'); ?></td>
                <td class="text-left py-3 px-4"><a class="hover:text-blue-500">

                    <?php
                    $temp = json_decode($row['data']);
                    echo "<ul>";
                    if ($temp->{"Kopi Kenangan Mantan"})
                      echo "<li>Kopi Kenangan Mantan: " . $temp->{"Kopi Kenangan Mantan"} . "</li>";
                    if ($temp->{"Kopi Susu"})
                      echo "<li>Kopi Susu: " . $temp->{"Kopi Susu"} . "</li>";
                    if ($temp->{"Kopi Bareng doi"})
                      echo "<li>Kopi Bareng doi: " . $temp->{"Kopi Bareng doi"} . "</li>";
                    if ($temp->{"Kopi Hitam"})
                      echo "<li>Kopi Hitam: " . $temp->{"Kopi Hitam"} . "</li>";
                    echo "</ul>";
                    ?>
                  </a></td>
                <td class="text-left py-3 px-4"><a class="hover:text-blue-500"><?= $row['created_at']; ?></a></td>
              </tr>
              <?php $i++; ?>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>
  <!-- Table Section End -->

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

  <script src="dist/js/script.js"></script>
  <script src="dist/js/cart.js"></script>
</body>

</html>