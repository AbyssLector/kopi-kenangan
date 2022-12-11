<?php
session_start();
if (!$_SESSION['success']) {
    header("Location: home.php");
    exit();
}
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
</head>

<body>
    <!-- login section start-->
    <section class="h-screen flex flex-wrap">
        <div class="container px-4 w-1/3 flex mx-auto items-center">
            <div name="login" class="bg-white rounded-xl overflow-hidden shadow-lg mx-auto border-black border-2">
                <div class="container mx-auto my-10 px-7">
                    <h3 class="text-black text-center mb-6 w-3/5  mx-auto"><span class="font-bold text-red-600">Selamat!</span>
                        Pemesanan berhasil dilakukan. Silahkan tunggu. Pesanan anda akan diantar dalam waktu yang dekat.
                    </h3>
                    <div class="mx-auto w-4/5 py-2 mb-8 bg-[#BB2028] rounded-xl hover:opacity-80 text-center">
                        <a href="home.php" class="text-white font-bold">Kembali ke beranda</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- login section end -->

    <!-- Footer Start -->
    <footer class="bg-black pt-24 pb-12">
        <div class="flex flex-wrap ">
            <div class="w-full px-4 mb-12">
                <h3 class="text-white text-center mb-4">Copyright @2022 <span class="font-bold">AIS 7 & 10 Team</span>
                    😊😊</h3>
                <h3 class="text-white text-center">This web is made for AIS Class final project</h3>
            </div>
        </div>
    </footer>
    <!-- Footer End -->
    <?php unset($_SESSION['success']); ?>
    <script src="dist/js/script.js"></script>
</body>

</html>