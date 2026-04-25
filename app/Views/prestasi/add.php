<?= $this->extend('layout/dashboard_layout') ?>

<?= $this->section('content') ?>
<div class="max-w-3xl mx-auto">
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">Tambah Prestasi Baru</h2>
            <p class="text-slate-500 text-sm">Masukkan detail pencapaian dengan benar dan valid.</p>
        </div>
        <a href="<?= base_url('/prestasi') ?>" class="text-slate-500 hover:text-slate-700 transition-colors">
            &larr; Kembali
        </a>
    </div>

    <?php if (session()->getFlashdata('error')): ?>
        <div x-data="{ show: true }" x-show="show" class="mb-6 bg-red-50 text-red-700 p-4 rounded-lg border border-red-200 flex justify-between items-center shadow-sm">
            <div class="flex items-center gap-2">
                <span class="text-xl">⚠️</span>
                <p class="font-medium"><?= session()->getFlashdata('error') ?></p>
            </div>
            <button @click="show = false" class="text-red-500 hover:text-red-800 font-bold">&times;</button>
        </div>
    <?php endif; ?>

    <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6 md:p-8">

        <?php $validation = \Config\Services::validation(); ?>

        <form action="<?= base_url('/prestasi/store') ?>" method="POST" class="space-y-6">
            <?= csrf_field() ?>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Nama Siswa</label>

                <?php if (isset($siswa_terpilih)): ?>
                    <input type="hidden" name="nisn_siswa" value="<?= $siswa_terpilih['nisn'] ?>">
                    <input type="text" value="<?= $siswa_terpilih['nama_siswa'] ?>" readonly
                        class="w-full px-3 py-2 border rounded-lg bg-slate-100 text-slate-600 cursor-not-allowed">

                <?php else: ?>
                    <select name="nisn_siswa" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">-- Pilih Siswa --</option>
                        <?php foreach ($semua_siswa as $s): ?>
                            <option value="<?= $s['nisn'] ?>" <?= old('nisn_siswa') == $s['nisn'] ? 'selected' : '' ?>>
                                <?= $s['nama_siswa'] ?> (NISN: <?= $s['nisn'] ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>

                <?php endif; ?>

                <?php if (session('validation') && session('validation')->hasError('nisn_siswa')): ?>
                    <p class="text-red-500 text-sm mt-1"><?= session('validation')->getError('nisn_siswa') ?></p>
                <?php endif; ?>
            </div>
            <div>
                <label for="judul_prestasi" class="block text-sm font-medium text-slate-700 mb-1">Nama/Judul Prestasi <span class="text-red-500">*</span></label>
                <input type="text" id="judul_prestasi" name="judul_prestasi" value="<?= old('judul_prestasi') ?>"
                    class="w-full px-4 py-2 border <?= $validation->hasError('judul_prestasi') ? 'border-red-500 focus:ring-red-500' : 'border-slate-300 focus:ring-primary' ?> rounded-lg focus:ring-2 outline-none transition-all">
                <div class="text-red-500 text-xs mt-1"><?= $validation->getError('judul_prestasi') ?></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="kategori" class="block text-sm font-medium text-slate-700 mb-1">Kategori <span class="text-red-500">*</span></label>
                    <select id="kategori" name="kategori"
                        class="w-full px-4 py-2 border <?= $validation->hasError('kategori') ? 'border-red-500 focus:ring-red-500' : 'border-slate-300 focus:ring-primary' ?> rounded-lg focus:ring-2 outline-none transition-all">
                        <option value="">-- Pilih Kategori --</option>
                        <option value="Akademik" <?= old('kategori') == 'Akademik' ? 'selected' : '' ?>>Akademik</option>
                        <option value="Non-Akademik" <?= old('kategori') == 'Non-Akademik' ? 'selected' : '' ?>>Non-Akademik</option>
                    </select>
                    <div class="text-red-500 text-xs mt-1"><?= $validation->getError('kategori') ?></div>
                </div>

                <div>
                    <label for="tingkat" class="block text-sm font-medium text-slate-700 mb-1">Tingkat <span class="text-red-500">*</span></label>
                    <select id="tingkat" name="tingkat"
                        class="w-full px-4 py-2 border <?= $validation->hasError('tingkat') ? 'border-red-500 focus:ring-red-500' : 'border-slate-300 focus:ring-primary' ?> rounded-lg focus:ring-2 outline-none transition-all">
                        <option value="">-- Pilih Tingkat --</option>
                        <option value="Sekolah" <?= old('tingkat') == 'Sekolah' ? 'selected' : '' ?>>Sekolah</option>
                        <option value="Kabupaten/Kota" <?= old('tingkat') == 'Kabupaten/Kota' ? 'selected' : '' ?>>Kabupaten/Kota</option>
                        <option value="Provinsi" <?= old('tingkat') == 'Provinsi' ? 'selected' : '' ?>>Provinsi</option>
                        <option value="Nasional" <?= old('tingkat') == 'Nasional' ? 'selected' : '' ?>>Nasional</option>
                        <option value="Internasional" <?= old('tingkat') == 'Internasional' ? 'selected' : '' ?>>Internasional</option>
                    </select>
                    <div class="text-red-500 text-xs mt-1"><?= $validation->getError('tingkat') ?></div>
                </div>
            </div>

            <div>
                <label for="tahun" class="block text-sm font-medium text-slate-700 mb-1">Tahun <span class="text-red-500">*</span></label>
                <input type="number" id="tahun" name="tahun" value="<?= old('tahun') ?>"
                    class="w-full md:w-1/3 px-4 py-2 border <?= $validation->hasError('tahun') ? 'border-red-500 focus:ring-red-500' : 'border-slate-300 focus:ring-primary' ?> rounded-lg focus:ring-2 outline-none transition-all"
                    placeholder="Contoh: 2023">
                <div class="text-red-500 text-xs mt-1"><?= $validation->getError('tahun') ?></div>
            </div>

            <div>
                <label for="deskripsi" class="block text-sm font-medium text-slate-700 mb-1">Deskripsi Tambahan (Opsional)</label>
                <textarea id="deskripsi" name="deskripsi" rows="4"
                    class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary outline-none transition-all"
                    placeholder="Tuliskan keterangan singkat mengenai prestasi ini..."><?= old('deskripsi') ?></textarea>
            </div>

            <div class="pt-4 border-t border-slate-100 flex justify-end gap-3">
                <a href="<?= base_url('/prestasi') ?>" class="px-5 py-2.5 text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-lg font-medium transition-colors">Batal</a>
                <button type="submit" class="px-5 py-2.5 text-white bg-primary hover:bg-primary-hover rounded-lg font-medium shadow-sm transition-colors">Simpan Prestasi</button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>