<?= $this->extend('layout/dashboard_layout');
?>

<?= $this->section('content'); ?>
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Manajemen Pengguna</h2>

        <a href="/user/generate-siswa" onclick="return confirm('Sistem akan membuatkan akun untuk semua siswa yang belum memiliki akun. Lanjutkan?')" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded shadow">
            + Generate Akun Siswa Lama
        </a>
    </div>
    <?php if (session()->getFlashdata('success')) : ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')) : ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <div class="bg-white shadow-md rounded my-6 overflow-x-auto">
        <table class="min-w-full bg-white">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">Username/NISN</th>
                    <th class="py-3 px-6 text-left">Nama Siswa</th>
                    <th class="py-3 px-6 text-center">Role</th>
                    <th class="py-3 px-6 text-center">Status</th>
                    <th class="py-3 px-6 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                <?php foreach ($users as $u) : ?>
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6 text-left font-bold"><?= $u['username'] ?></td>
                        <td class="py-3 px-6 text-left"><?= $u['nama_siswa'] ?? '-' ?></td>
                        <td class="py-3 px-6 text-center">
                            <?php if ($u['role_id'] == 1): ?>
                                <span class="bg-purple-200 text-purple-600 py-1 px-3 rounded-full text-xs">Superadmin</span>
                            <?php else: ?>
                                <span class="bg-blue-200 text-blue-600 py-1 px-3 rounded-full text-xs">Siswa</span>
                            <?php endif; ?>
                        </td>
                        <td class="py-3 px-6 text-center">
                            <?php if ($u['locked_until'] !== null && strtotime($u['locked_until']) > time()): ?>
                                <span class="bg-red-200 text-red-600 py-1 px-3 rounded text-xs font-bold">TERKUNCI</span>
                            <?php else: ?>
                                <span class="bg-green-200 text-green-600 py-1 px-3 rounded text-xs">Aktif</span>
                            <?php endif; ?>
                        </td>
                        <td class="py-3 px-6 text-center flex justify-center space-x-2">
                            <?php if ($u['login_attempts'] > 0 || $u['locked_until'] !== null): ?>
                                <a href="/user/reset-login/<?= $u['id'] ?>" class="bg-yellow-500 hover:bg-yellow-600 text-white py-1 px-2 rounded text-xs" onclick="return confirm('Buka kunci akun ini?')">Buka Kunci</a>
                            <?php endif; ?>

                            <a href="/user/reset-password/<?= $u['id'] ?>" class="bg-blue-500 hover:bg-blue-600 text-white py-1 px-2 rounded text-xs" onclick="return confirm('Yakin ingin mereset password akun ini? Password baru akan digenerate otomatis.')">Reset Pass</a>

                            <?php if ($u['role_id'] != 1): ?>
                                <a href="/user/delete/<?= $u['id'] ?>" class="bg-red-500 hover:bg-red-600 text-white py-1 px-2 rounded text-xs" onclick="return confirm('Yakin ingin menghapus akun ini secara permanen?')">Hapus</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection(); ?>