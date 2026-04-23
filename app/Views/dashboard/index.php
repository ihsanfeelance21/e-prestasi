<?= $this->extend('layout/dashboard_layout') ?>

<?= $this->section('content') ?>
<div class="mb-8">
    <h2 class="text-2xl font-bold text-slate-800">Ringkasan Sistem</h2>
    <p class="text-slate-500 text-sm mt-1">Pantau perkembangan prestasi siswa secara real-time.</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white rounded-xl shadow-sm p-6 border border-slate-100 border-l-4 border-l-primary flex items-center justify-between">
        <div>
            <p class="text-sm font-medium text-slate-500 mb-1">Total Prestasi</p>
            <p class="text-3xl font-bold text-slate-800">124</p>
        </div>
        <div class="p-3 bg-green-50 text-primary rounded-full text-2xl">🏆</div>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-6 border border-slate-100 border-l-4 border-l-accent flex items-center justify-between">
        <div>
            <p class="text-sm font-medium text-slate-500 mb-1">Menunggu Validasi</p>
            <p class="text-3xl font-bold text-slate-800">12</p>
        </div>
        <div class="p-3 bg-yellow-50 text-accent rounded-full text-2xl">⏳</div>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-6 border border-slate-100 border-l-4 border-l-blue-500 flex items-center justify-between">
        <div>
            <p class="text-sm font-medium text-slate-500 mb-1">Total Siswa Aktif</p>
            <p class="text-3xl font-bold text-slate-800">850</p>
        </div>
        <div class="p-3 bg-blue-50 text-blue-500 rounded-full text-2xl">👨‍🎓</div>
    </div>
</div>

<div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6">
    <h3 class="text-lg font-bold text-slate-800 mb-4">Pengumuman Terbaru</h3>
    <div class="p-4 bg-slate-50 rounded-lg border border-slate-200">
        <p class="text-slate-600 text-sm">Selamat datang di versi baru <strong>e-Prestasi</strong>. Anda login sebagai <span class="badge bg-primary text-white px-2 py-0.5 rounded text-xs"><?= session()->get('role_id') == 1 ? 'Administrator' : 'Siswa' ?></span>. Silakan gunakan menu di sebelah kiri untuk navigasi.</p>
    </div>
</div>
<?= $this->endSection() ?>