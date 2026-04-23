<?= $this->extend('layout/dashboard_layout') ?>

<?= $this->section('content') ?>
<?php if (session()->getFlashdata('success')): ?>
    <div x-data="{ show: true }" x-show="show" class="mb-6 bg-green-50 text-green-700 p-4 rounded-lg border border-green-200 flex justify-between items-center shadow-sm">
        <div class="flex items-center gap-2">
            <span class="text-xl">✅</span>
            <p class="font-medium"><?= session()->getFlashdata('success') ?></p>
        </div>
        <button @click="show = false" class="text-green-500 hover:text-green-800 font-bold">&times;</button>
    </div>
<?php endif; ?>

<div class="flex justify-between items-center mb-6">
    <div>
        <h2 class="text-2xl font-bold text-slate-800">Daftar Prestasi</h2>
        <p class="text-slate-500 text-sm">Kelola dan pantau semua data prestasi di sini.</p>
    </div>

    <a href="<?= base_url('/prestasi/create') ?>" class="bg-primary hover:bg-primary-hover text-white px-4 py-2 rounded-lg shadow-sm transition-all flex items-center gap-2">
        <span>+</span> Tambah Prestasi
    </a>
</div>

<div class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead class="bg-slate-50 border-b border-slate-100">
                <tr>
                    <th class="px-6 py-4 text-sm font-semibold text-slate-600">Judul Prestasi</th>
                    <th class="px-6 py-4 text-sm font-semibold text-slate-600">Kategori</th>
                    <th class="px-6 py-4 text-sm font-semibold text-slate-600">Tingkat</th>
                    <th class="px-6 py-4 text-sm font-semibold text-slate-600">Pemilik</th>
                    <th class="px-6 py-4 text-sm font-semibold text-slate-600">Status</th>
                    <th class="px-6 py-4 text-sm font-semibold text-slate-600 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                <?php if (empty($prestasi)): ?>
                    <tr>
                        <td colspan="6" class="px-6 py-10 text-center text-slate-400 italic">
                            Belum ada data prestasi yang tercatat.
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($prestasi as $item): ?>
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-6 py-4 font-medium text-slate-700"><?= $item['judul_prestasi'] ?></td>
                            <td class="px-6 py-4 text-sm text-slate-600"><?= $item['kategori'] ?></td>
                            <td class="px-6 py-4 text-sm text-slate-600"><?= $item['tingkat'] ?></td>
                            <td class="px-6 py-4 text-sm text-slate-600">
                                <span class="bg-slate-100 px-2 py-1 rounded text-xs"><?= $item['username'] ?></span>
                            </td>
                            <td class="px-6 py-4">
                                <?php if ($item['status_validasi'] == 'Disetujui'): ?>
                                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-medium">✓ Disetujui</span>
                                <?php elseif ($item['status_validasi'] == 'Ditolak'): ?>
                                    <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-medium">✕ Ditolak</span>
                                <?php else: ?>
                                    <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-medium">⏳ Menunggu</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center gap-2">
                                    <a href="<?= base_url('/prestasi/edit/' . $item['id']) ?>" class="p-2 text-blue-500 hover:bg-blue-50 rounded-lg transition-colors" title="Edit Data">
                                        ✏️
                                    </a>

                                    <a href="<?= base_url('/prestasi/delete/' . $item['id']) ?>"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus prestasi \'<?= $item['judul_prestasi'] ?>\'? Data yang dihapus tidak dapat dikembalikan.');"
                                        class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition-colors" title="Hapus Data">
                                        🗑️
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>