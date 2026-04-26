<?= $this->extend('layout/template'); // Sesuaikan dengan layout utama Anda 
?>

<?= $this->section('content'); ?>
<div class="container mx-auto px-4 py-8">
    <div class="max-w-md mx-auto bg-white p-8 border rounded shadow-md">
        <h2 class="text-2xl font-bold mb-6 text-gray-800 text-center">Ubah Password</h2>

        <?php if (session()->getFlashdata('success')) : ?>
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4 text-sm text-center">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')) : ?>
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4 text-sm text-center">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <form action="/profil/proses-ganti-password" method="POST">
            <?= csrf_field() ?>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Password Lama</label>
                <input type="password" name="password_lama" class="w-full px-3 py-2 border rounded outline-none focus:border-blue-500 <?= validation_show_error('password_lama') ? 'border-red-500' : '' ?>" required>
                <p class="text-red-500 text-xs italic mt-1"><?= validation_show_error('password_lama') ?></p>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Password Baru</label>
                <input type="password" name="password_baru" class="w-full px-3 py-2 border rounded outline-none focus:border-blue-500 <?= validation_show_error('password_baru') ? 'border-red-500' : '' ?>" required>
                <p class="text-gray-500 text-xs mt-1">Min. 6 karakter (kombinasi huruf, angka, & simbol)</p>
                <p class="text-red-500 text-xs italic mt-1"><?= validation_show_error('password_baru') ?></p>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Konfirmasi Password Baru</label>
                <input type="password" name="konfirmasi_password" class="w-full px-3 py-2 border rounded outline-none focus:border-blue-500 <?= validation_show_error('konfirmasi_password') ? 'border-red-500' : '' ?>" required>
                <p class="text-red-500 text-xs italic mt-1"><?= validation_show_error('konfirmasi_password') ?></p>
            </div>

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-200">
                Simpan Password
            </button>
        </form>
    </div>
</div>
<?= $this->endSection(); ?>