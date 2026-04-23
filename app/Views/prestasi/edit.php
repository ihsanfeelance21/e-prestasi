<?= $this->extend('layout/dashboard_layout') ?>

<?= $this->section('content') ?>
<div class="max-w-3xl mx-auto">
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">Edit Prestasi</h2>
            <p class="text-slate-500 text-sm">Perbarui informasi pencapaian Anda.</p>
        </div>
        <a href="<?= base_url('/prestasi') ?>" class="text-slate-500 hover:text-slate-700 transition-colors">
            &larr; Kembali
        </a>
    </div>

    <?php if (session()->getFlashdata('error')): ?>
        <div x-data="{ show: true }" x-show="show" class="mb-6 bg-red-50 text-red-700 p-4 rounded-lg border border-red-200 flex justify-between items-center">
            <p class="font-medium"><?= session()->getFlashdata('error') ?></p>
            <button @click="show = false" class="font-bold">&times;</button>
        </div>
    <?php endif; ?>

    <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6 md:p-8">
        <?php $validation = \Config\Services::validation(); ?>

        <form action="<?= base_url('/prestasi/update/' . $prestasi['id']) ?>" method="POST" class="space-y-6">
            <?= csrf_field() ?>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Nama/Judul Prestasi</label>
                <input type="text" name="judul_prestasi" value="<?= old('judul_prestasi', $prestasi['judul_prestasi']) ?>"
                    class="w-full px-4 py-2 border <?= $validation->hasError('judul_prestasi') ? 'border-red-500' : 'border-slate-300' ?> rounded-lg focus:ring-2 focus:ring-primary outline-none transition-all">
                <div class="text-red-500 text-xs mt-1"><?= $validation->getError('judul_prestasi') ?></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Kategori</label>
                    <select name="kategori" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-primary outline-none transition-all">
                        <option value="Akademik" <?= old('kategori', $prestasi['kategori']) == 'Akademik' ? 'selected' : '' ?>>Akademik</option>
                        <option value="Non-Akademik" <?= old('kategori', $prestasi['kategori']) == 'Non-Akademik' ? 'selected' : '' ?>>Non-Akademik</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Tingkat</label>
                    <select name="tingkat" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-primary outline-none transition-all">
                        <?php $levels = ['Sekolah', 'Kabupaten/Kota', 'Provinsi', 'Nasional', 'Internasional']; ?>
                        <?php foreach ($levels as $l): ?>
                            <option value="<?= $l ?>" <?= old('tingkat', $prestasi['tingkat']) == $l ? 'selected' : '' ?>><?= $l ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Tahun</label>
                <input type="number" name="tahun" value="<?= old('tahun', $prestasi['tahun']) ?>"
                    class="w-full md:w-1/3 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-primary outline-none transition-all">
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Deskripsi Tambahan</label>
                <textarea name="deskripsi" rows="4" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary outline-none transition-all"><?= old('deskripsi', $prestasi['deskripsi']) ?></textarea>
            </div>

            <div class="pt-4 border-t border-slate-100 flex justify-end gap-3">
                <a href="<?= base_url('/prestasi') ?>" class="px-5 py-2.5 text-slate-600 bg-slate-100 rounded-lg">Batal</a>
                <button type="submit" class="px-5 py-2.5 text-white bg-blue-600 hover:bg-blue-700 rounded-lg font-medium shadow-sm transition-colors">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>