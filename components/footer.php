<div class="bottom-navigation-bar fixed-bottom w-full bg-white shadow">
        <div class="container text-center">
            <div class="row">
                <a href="/" class="text-black text-decoration-none col d-flex flex-column py-3">
                    <i class="fas fa-home pb-2 mb-1"></i>
                    <p class="mb-0">Beranda</p>
                </a>
                <a href="/subjects.php" class="text-black text-decoration-none col d-flex flex-column py-3">
                    <i class="fas fa-calendar pb-2 mb-1"></i>
                    <p class="mb-0">Pelajaran</p>
                </a>
                <a href="/history.php" class="text-black text-decoration-none col d-flex flex-column py-3">
                    <i class="fas fa-clock pb-2 mb-1"></i>
                    <p class="mb-0">Riwayat</p>
                </a>
            </div>
        </div>
    </div>
    <script src="./assets/fontawesome/all.min.js"></script>
    <script src="./assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="./assets/sweetalert/sweetalert2@11.js"></script>

    <script>
        <?php if (isset($_SESSION['message']['user']['success']['presence-in'])):
            if ($_SESSION['message']['user']['success']['presence-in'] == true): 
                $_SESSION['message']['user']['success']['presence-in'] = false;
            ?>
            Swal.fire(
                'Status Presensi',
                'Presensi Berhasil Dilakukan, Selamat Mengajar!',
                'success'
            );
        <?php endif;
        endif; ?>

        <?php if (isset($_SESSION['message']['user']['success']['presence-out'])):
            if ($_SESSION['message']['user']['success']['presence-out'] == true): 
                $_SESSION['message']['user']['success']['presence-out'] = false;
            ?>
            Swal.fire(
                'Status Presensi',
                'Terima kasih untuk hari ini, presensi keluar berhasil!',
                'success'
            );
        <?php endif;
        endif; ?>
    </script>
</body>
</html>