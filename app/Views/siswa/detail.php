<?= $this->extend('layout/dashboard_layout') ?>

<?= $this->section('content') ?>
<div class="max-w-6xl mx-auto pb-10">

    <div class="mb-6 flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">Detail Siswa</h2>
            <p class="text-slate-500 text-sm mt-1">Informasi lengkap data induk siswa.</p>
        </div>
        <a href="<?= base_url('/siswa') ?>" class="bg-white border border-slate-300 hover:bg-slate-50 text-slate-700 px-4 py-2 rounded-lg text-sm font-medium flex items-center transition-colors shadow-sm">
            <i class="fa-solid fa-arrow-left mr-2"></i> Kembali
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-stretch">

        <div class="lg:col-span-4 xl:col-span-3">
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden h-full flex flex-col">
                <div class="h-1.5 bg-primary"></div>

                <div class="p-6 flex flex-col items-center flex-1">
                    <div class="relative mb-4">
                        <img class="h-28 w-28 rounded-full object-cover border-4 border-slate-50 shadow-md"
                            src="<?= base_url('uploads/siswa/' . esc($siswa['foto_siswa'])) ?>"
                            alt="Foto <?= esc($siswa['nama_siswa']) ?>"
                            onerror="this.src='https://ui-avatars.com/api/?name=<?= urlencode($siswa['nama_siswa']) ?>&background=179300&color=fff&size=200'">
                    </div>

                    <h3 class="text-lg font-bold text-slate-800 text-center mb-1 leading-tight">
                        <?= esc($siswa['nama_siswa']) ?>
                    </h3>
                    <span class="px-3 py-1 bg-slate-100 text-slate-600 rounded-full text-[11px] font-semibold mb-6 uppercase tracking-wider">
                        Kelas <?= esc($siswa['kelas']) ?>
                    </span>

                    <div class="w-full flex flex-col gap-2 mt-auto pt-4">
                        <a href="<?= base_url('siswa/edit/' . $siswa['id']) ?>" class="w-full flex justify-center items-center py-2 bg-amber-50 hover:bg-amber-100 border border-amber-200 text-amber-700 rounded-lg text-sm font-medium transition-colors">
                            <i class="fa-solid fa-pen-to-square mr-2"></i> Edit Data
                        </a>
                        <button onclick="confirmStatus('<?= base_url('siswa/delete/' . $siswa['id']) ?>', 'Hapus Data', 'Data siswa <?= esc($siswa['nama_siswa']) ?> akan dihapus permanen?', 'error')" class="w-full flex justify-center items-center py-2 bg-red-50 hover:bg-red-100 border border-red-200 text-red-700 rounded-lg text-sm font-medium transition-colors">
                            <i class="fa-solid fa-trash mr-2"></i> Hapus
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-8 xl:col-span-9">
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden h-full">

                <div class="flex border-b border-slate-200 bg-slate-50/50">
                    <div class="py-3.5 px-5 text-sm font-semibold text-primary border-b-2 border-primary bg-white flex items-center">
                        <i class="fa-solid fa-user-check mr-2"></i> Data Utama
                    </div>
                </div>

                <div class="p-6 md:p-8 space-y-5">

                    <div class="flex flex-col sm:flex-row sm:items-center gap-1 sm:gap-3">
                        <label class="sm:w-1/3 text-[13px] font-bold text-slate-600 uppercase tracking-wide">Nama Lengkap</label>
                        <div class="sm:w-2/3 flex w-full shadow-sm rounded-lg overflow-hidden border border-slate-200">
                            <span class="flex items-center justify-center bg-slate-50 border-r border-slate-200 w-11 text-slate-400">
                                <i class="fa-solid fa-user text-sm"></i>
                            </span>
                            <div class="flex-1 bg-white px-3 py-2 text-sm text-slate-800 font-medium">
                                <?= esc($siswa['nama_siswa']) ?>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row sm:items-center gap-1 sm:gap-3">
                        <label class="sm:w-1/3 text-[13px] font-bold text-slate-600 uppercase tracking-wide">NISN</label>
                        <div class="sm:w-2/3 flex w-full shadow-sm rounded-lg overflow-hidden border border-slate-200">
                            <span class="flex items-center justify-center bg-slate-50 border-r border-slate-200 w-11 text-slate-400">
                                <i class="fa-solid fa-id-card text-sm"></i>
                            </span>
                            <div class="flex-1 bg-white px-3 py-2 text-sm text-slate-800 font-medium">
                                <?= esc($siswa['nisn']) ?>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row sm:items-center gap-1 sm:gap-3">
                        <label class="sm:w-1/3 text-[13px] font-bold text-slate-600 uppercase tracking-wide">Diterima di Kelas</label>
                        <div class="sm:w-2/3 flex w-full shadow-sm rounded-lg overflow-hidden border border-slate-200">
                            <span class="flex items-center justify-center bg-slate-50 border-r border-slate-200 w-11 text-slate-400">
                                <i class="fa-solid fa-graduation-cap text-sm"></i>
                            </span>
                            <div class="flex-1 bg-white px-3 py-2 text-sm text-slate-800 font-medium">
                                <?= esc($siswa['kelas']) ?>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row sm:items-center gap-1 sm:gap-3">
                        <label class="sm:w-1/3 text-[13px] font-bold text-slate-600 uppercase tracking-wide">Email Utama</label>
                        <div class="sm:w-2/3 flex w-full shadow-sm rounded-lg overflow-hidden border border-slate-200">
                            <span class="flex items-center justify-center bg-slate-50 border-r border-slate-200 w-11 text-slate-400">
                                <i class="fa-solid fa-envelope text-sm"></i>
                            </span>
                            <div class="flex-1 bg-white px-3 py-2 text-sm <?= empty($siswa['email']) ? 'text-slate-400 italic' : 'text-slate-800' ?>">
                                <?= !empty($siswa['email']) ? esc($siswa['email']) : 'Belum ditambahkan' ?>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row sm:items-center gap-1 sm:gap-3">
                        <label class="sm:w-1/3 text-[13px] font-bold text-slate-600 uppercase tracking-wide">No. Handphone</label>
                        <div class="sm:w-2/3 flex w-full shadow-sm rounded-lg overflow-hidden border border-slate-200">
                            <span class="flex items-center justify-center bg-slate-50 border-r border-slate-200 w-11 text-slate-400">
                                <i class="fa-brands fa-whatsapp text-sm"></i>
                            </span>
                            <div class="flex-1 bg-white px-3 py-2 text-sm <?= empty($siswa['no_hp']) ? 'text-slate-400 italic' : 'text-slate-800' ?>">
                                <?= !empty($siswa['no_hp']) ? esc($siswa['no_hp']) : 'Belum ditambahkan' ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

    <div class="mt-6 bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">

        <div class="flex items-center justify-between border-b border-slate-200 bg-slate-50/50 pr-4 md:pr-6">
            <div class="py-3.5 px-5 text-sm font-semibold text-amber-600 border-b-2 border-amber-500 bg-white flex items-center">
                <i class="fa-solid fa-trophy mr-2"></i> Data Prestasi Siswa
            </div>
            <button class="bg-primary hover:bg-blue-600 text-white px-3 py-1.5 rounded text-xs font-medium transition-colors shadow-sm flex items-center">
                <i class="fa-solid fa-plus mr-1.5"></i> Tambah Prestasi
            </button>
        </div>

        <div class="p-5 md:p-6">

            <form action="<?= base_url('siswa/detail/' . $siswa['id']) ?>" method="GET" class="flex flex-col md:flex-row gap-3 items-end mb-6">

                <div class="flex-1 w-full">
                    <label for="keyword" class="block text-[11px] font-bold text-slate-600 uppercase tracking-wide mb-1.5">Cari Lomba</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fa-solid fa-search text-slate-400 text-xs"></i>
                        </div>
                        <input type="text" id="keyword" name="keyword" value="<?= esc($_GET['keyword'] ?? '') ?>" placeholder="Cari nama perlombaan..." class="w-full pl-9 pr-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary text-sm text-slate-700 bg-slate-50 focus:bg-white transition-colors">
                    </div>
                </div>

                <div class="w-full md:w-48">
                    <label for="tingkat" class="block text-[11px] font-bold text-slate-600 uppercase tracking-wide mb-1.5">Tingkatan</label>
                    <select id="tingkat" name="tingkat" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary text-sm text-slate-700 bg-slate-50 focus:bg-white cursor-pointer">
                        <option value="">Semua Tingkat</option>
                        <option value="Sekolah" <?= (($_GET['tingkat'] ?? '') == 'Sekolah') ? 'selected' : '' ?>>Tingkat Sekolah</option>
                        <option value="Kabupaten/Kota" <?= (($_GET['tingkat'] ?? '') == 'Kabupaten/Kota') ? 'selected' : '' ?>>Kabupaten/Kota</option>
                        <option value="Provinsi" <?= (($_GET['tingkat'] ?? '') == 'Provinsi') ? 'selected' : '' ?>>Tingkat Provinsi</option>
                        <option value="Nasional" <?= (($_GET['tingkat'] ?? '') == 'Nasional') ? 'selected' : '' ?>>Tingkat Nasional</option>
                        <option value="Internasional" <?= (($_GET['tingkat'] ?? '') == 'Internasional') ? 'selected' : '' ?>>Internasional</option>
                    </select>
                </div>

                <div class="w-full md:w-32">
                    <label for="per_page" class="block text-[11px] font-bold text-slate-600 uppercase tracking-wide mb-1.5">Tampilkan</label>
                    <select id="per_page" name="per_page" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary text-sm text-slate-700 bg-slate-50 focus:bg-white cursor-pointer" onchange="this.form.submit()">
                        <option value="10" <?= (($_GET['per_page'] ?? '10') == '10') ? 'selected' : '' ?>>10 Data</option>
                        <option value="20" <?= (($_GET['per_page'] ?? '') == '20') ? 'selected' : '' ?>>20 Data</option>
                        <option value="50" <?= (($_GET['per_page'] ?? '') == '50') ? 'selected' : '' ?>>50 Data</option>
                        <option value="all" <?= (($_GET['per_page'] ?? '') == 'all') ? 'selected' : '' ?>>Semua</option>
                    </select>
                </div>

                <div class="w-full md:w-auto flex gap-2">
                    <button type="submit" class="flex-1 md:flex-none bg-slate-800 hover:bg-slate-900 text-white px-4 py-2 rounded-lg font-medium transition-colors flex items-center justify-center text-sm shadow-sm">
                        <i class="fa-solid fa-filter mr-1.5"></i> Filter
                    </button>
                    <?php if (!empty($_GET['keyword']) || !empty($_GET['tingkat'])): ?>
                        <a href="<?= base_url('siswa/detail/' . $siswa['id']) ?>" class="bg-red-50 hover:bg-red-100 text-red-600 border border-red-200 px-3 py-2 rounded-lg font-medium transition-colors flex items-center justify-center text-sm shadow-sm" title="Reset Filter">
                            <i class="fa-solid fa-rotate-right"></i>
                        </a>
                    <?php endif; ?>
                </div>
            </form>

            <?php if (empty($prestasi)): ?>
                <div class="text-center py-10 bg-slate-50 rounded-xl border border-dashed border-slate-300">
                    <div class="inline-flex items-center justify-center w-14 h-14 rounded-full bg-slate-200 mb-3">
                        <i class="fa-solid fa-medal text-2xl text-slate-400"></i>
                    </div>
                    <h4 class="text-base text-slate-700 font-bold mb-1">
                        <?= (!empty($_GET['keyword']) || !empty($_GET['tingkat'])) ? 'Prestasi tidak ditemukan' : 'Belum ada catatan prestasi' ?>
                    </h4>
                    <p class="text-sm text-slate-500">
                        <?= (!empty($_GET['keyword']) || !empty($_GET['tingkat'])) ? 'Tidak ada data lomba yang cocok dengan filter Anda.' : 'Siswa ini belum memiliki data prestasi yang ditambahkan.' ?>
                    </p>
                </div>
            <?php else: ?>
                <div class="overflow-x-auto rounded-lg border border-slate-200">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-100 text-slate-600 text-[11px] uppercase tracking-wider">
                                <th class="px-4 py-3 font-bold border-b border-slate-200 w-10 text-center">No</th>
                                <th class="px-4 py-3 font-bold border-b border-slate-200">Nama Lomba / Kejuaraan</th>
                                <th class="px-4 py-3 font-bold border-b border-slate-200">Tingkat</th>
                                <th class="px-4 py-3 font-bold border-b border-slate-200">Tahun</th>
                                <th class="px-4 py-3 font-bold border-b border-slate-200">Pencapaian</th>
                                <th class="px-4 py-3 font-bold border-b border-slate-200 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm text-slate-700 divide-y divide-slate-100">
                            <?php $no = 1;
                            foreach ($prestasi as $p): ?>
                                <tr class="hover:bg-slate-50 transition-colors">
                                    <td class="px-4 py-3 text-center text-slate-400"><?= $no++ ?></td>
                                    <td class="px-4 py-3 font-medium text-slate-800">
                                        <?= esc($p['nama_lomba']) ?>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="inline-block px-2 py-1 bg-amber-50 text-amber-700 border border-amber-200 rounded text-[11px] font-semibold">
                                            <?= esc($p['tingkat']) ?>
                                        </span>
                                    </td>
                                    <td class="px-4 py-3"><?= esc($p['tahun']) ?></td>
                                    <td class="px-4 py-3 font-bold text-slate-800"><?= esc($p['juara']) ?></td>
                                    <td class="px-4 py-3 text-center">
                                        <button class="text-slate-400 hover:text-amber-500 mx-1 transition-colors" title="Edit Data"><i class="fa-solid fa-pen-to-square"></i></button>
                                        <button class="text-slate-400 hover:text-red-500 mx-1 transition-colors" title="Hapus Data"><i class="fa-solid fa-trash"></i></button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <?php if (isset($pager)): ?>
                    <div class="mt-6 flex justify-center">
                        <?= $pager->links('prestasi', 'tailwind_pagination') // Group paginasi diset 'prestasi' agar tidak bentrok jika ada paginasi lain 
                        ?>
                    </div>
                <?php endif; ?>

            <?php endif; ?>

        </div>
    </div>

</div>
<?= $this->endSection() ?>