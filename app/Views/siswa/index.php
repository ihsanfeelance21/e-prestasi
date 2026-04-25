<?= $this->extend('layout/dashboard_layout') ?>

<?= $this->section('content') ?>
<div class="mb-6 flex justify-between items-center">
    <div>
        <h2 class="text-2xl font-bold text-slate-800">🎓 Data Siswa</h2>
        <p class="text-slate-500 text-sm mt-1">Kelola data induk siswa yang berprestasi.</p>
    </div>
    <a href="<?= base_url('siswa/create') ?>" class="bg-primary hover:bg-blue-600 text-white px-4 py-2 rounded-lg font-medium shadow-sm transition-all flex items-center">
        <i class="fa-solid fa-plus mr-2"></i> Tambah Siswa
    </a>
</div>

<div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4 mb-6">
    <form action="<?= base_url('siswa') ?>" method="GET" class="flex flex-col md:flex-row gap-4 items-end">

        <div class="flex-1 w-full">
            <label for="keyword" class="block text-[12px] font-bold text-slate-600 uppercase tracking-wide mb-1.5">Pencarian Siswa</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fa-solid fa-search text-slate-400"></i>
                </div>
                <input type="text" id="keyword" name="keyword" value="<?= esc($_GET['keyword'] ?? '') ?>" placeholder="Cari nama atau NISN..." class="w-full pl-10 pr-3 py-2.5 border border-slate-300 rounded-lg focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary text-sm text-slate-700 bg-slate-50 focus:bg-white transition-colors">
            </div>
        </div>

        <div class="w-full md:w-48">
            <label for="kelas" class="block text-[12px] font-bold text-slate-600 uppercase tracking-wide mb-1.5">Filter Kelas</label>
            <select id="kelas" name="kelas" class="w-full px-3 py-2.5 border border-slate-300 rounded-lg focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary text-sm text-slate-700 bg-slate-50 focus:bg-white cursor-pointer">
                <option value="">Semua Kelas</option>
                <option value="VII" <?= (($_GET['kelas'] ?? '') == 'VII') ? 'selected' : '' ?>>Kelas VII</option>
                <option value="VIII" <?= (($_GET['kelas'] ?? '') == 'VIII') ? 'selected' : '' ?>>Kelas VIII</option>
                <option value="IX" <?= (($_GET['kelas'] ?? '') == 'IX') ? 'selected' : '' ?>>Kelas IX</option>
                <option value="X" <?= (($_GET['kelas'] ?? '') == 'X') ? 'selected' : '' ?>>Kelas X</option>
                <option value="XI" <?= (($_GET['kelas'] ?? '') == 'XI') ? 'selected' : '' ?>>Kelas XI</option>
                <option value="XII" <?= (($_GET['kelas'] ?? '') == 'XII') ? 'selected' : '' ?>>Kelas XII</option>
            </select>
        </div>

        <div class="w-full md:w-40">
            <label for="per_page" class="block text-[12px] font-bold text-slate-600 uppercase tracking-wide mb-1.5">Tampilkan</label>
            <select id="per_page" name="per_page" class="w-full px-3 py-2.5 border border-slate-300 rounded-lg focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary text-sm text-slate-700 bg-slate-50 focus:bg-white cursor-pointer" onchange="this.form.submit()">
                <option value="10" <?= (($_GET['per_page'] ?? '10') == '10') ? 'selected' : '' ?>>10 Data</option>
                <option value="20" <?= (($_GET['per_page'] ?? '') == '20') ? 'selected' : '' ?>>20 Data</option>
                <option value="50" <?= (($_GET['per_page'] ?? '') == '50') ? 'selected' : '' ?>>50 Data</option>
                <option value="100" <?= (($_GET['per_page'] ?? '') == '100') ? 'selected' : '' ?>>100 Data</option>
                <option value="150" <?= (($_GET['per_page'] ?? '') == '150') ? 'selected' : '' ?>>150 Data</option>
                <option value="200" <?= (($_GET['per_page'] ?? '') == '200') ? 'selected' : '' ?>>200 Data</option>
                <option value="300" <?= (($_GET['per_page'] ?? '') == '300') ? 'selected' : '' ?>>300 Data</option>
                <option value="all" <?= (($_GET['per_page'] ?? '') == 'all') ? 'selected' : '' ?>>Semua Data</option>
            </select>
        </div>

        <div class="w-full md:w-auto flex gap-2">
            <button type="submit" class="flex-1 md:flex-none bg-slate-800 hover:bg-slate-900 text-white px-5 py-2.5 rounded-lg font-medium transition-colors flex items-center justify-center text-sm shadow-sm">
                <i class="fa-solid fa-filter mr-2"></i> Terapkan
            </button>
            <?php if (!empty($_GET['keyword']) || !empty($_GET['kelas'])): ?>
                <a href="<?= base_url('siswa') ?>" class="bg-red-50 hover:bg-red-100 text-red-600 border border-red-200 px-4 py-2.5 rounded-lg font-medium transition-colors flex items-center justify-center text-sm shadow-sm" title="Reset Filter">
                    <i class="fa-solid fa-rotate-right"></i>
                </a>
            <?php endif; ?>
        </div>
    </form>
</div>

<?php if (empty($siswa)): ?>
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-12 text-center flex flex-col items-center">
        <div class="text-4xl mb-3">📭</div>
        <h3 class="text-lg font-medium text-slate-800">
            <?= (!empty($_GET['keyword']) || !empty($_GET['kelas'])) ? 'Siswa tidak ditemukan' : 'Belum ada data siswa' ?>
        </h3>
        <p class="text-slate-500 mt-1">
            <?= (!empty($_GET['keyword']) || !empty($_GET['kelas'])) ? 'Cobalah menggunakan kata kunci atau filter kelas yang berbeda.' : 'Silakan klik tombol Tambah Siswa untuk memulai.' ?>
        </p>
    </div>
<?php else: ?>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-6">
        <?php foreach ($siswa as $s): ?>
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5 flex flex-col h-full items-center text-center hover:shadow-md transition-shadow relative overflow-hidden group">

                <div class="mb-4 shrink-0 mt-2">
                    <img class="h-24 w-24 rounded-full object-cover border-4 border-slate-50 shadow-md mx-auto group-hover:scale-105 transition-transform duration-300"
                        src="<?= base_url('uploads/siswa/' . esc($s['foto_siswa'])) ?>"
                        alt="Foto <?= esc($s['nama_siswa']) ?>"
                        onerror="this.src='https://ui-avatars.com/api/?name=<?= urlencode($s['nama_siswa']) ?>&background=179300&color=fff&size=128'">
                </div>

                <div class="grow flex flex-col items-center w-full">
                    <h3 class="font-bold text-slate-800 text-base leading-tight mb-2 line-clamp-2 min-h-12 flex items-center justify-center" title="<?= esc($s['nama_siswa']) ?>">
                        <?= esc($s['nama_siswa']) ?>
                    </h3>

                    <span class="inline-block bg-slate-100 text-slate-600 px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-wider border border-slate-200 mb-4">
                        Kelas <?= esc($s['kelas']) ?>
                    </span>
                </div>

                <div class="mt-auto w-full pt-4 border-t border-slate-100">
                    <a href="<?= base_url('siswa/detail/' . $s['id']) ?>" class="block w-full py-2.5 text-sm font-medium text-primary bg-blue-50 hover:bg-primary hover:text-white rounded-lg transition-colors">
                        <i class="fa-solid fa-eye mr-1"></i> Lihat Detail
                    </a>
                </div>

            </div>
        <?php endforeach; ?>
    </div>

    <?php if (isset($pager)): ?>
        <div class="mt-8 flex justify-center">
            <?= $pager->links('default', 'tailwind_pagination') // Ganti parameter kedua dengan template pagination Anda jika ada 
            ?>
        </div>
    <?php endif; ?>

<?php endif; ?>

<?= $this->endSection() ?>