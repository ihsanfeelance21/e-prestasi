<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="bg-white p-8 rounded-xl shadow-sm border border-slate-100 text-center">
    <h2 class="text-3xl font-bold text-primary mb-4">Selamat Datang di e-Prestasi</h2>
    <p class="text-slate-600 mb-8 max-w-2xl mx-auto">
        Platform modern untuk mencatat, melacak, dan melaporkan pencapaian siswa secara *seamless*.
    </p>

    <div x-data="{ open: false }" class="mt-6 border-t pt-6">
        <button
            @click="open = !open"
            class="bg-accent hover:bg-yellow-600 text-white font-bold py-2 px-6 rounded-lg transition-transform transform hover:scale-105 shadow-md">
            Uji Interaksi Alpine.js
        </button>

        <div x-show="open" x-transition.opacity class="mt-4 p-4 bg-green-50 text-primary border border-green-200 rounded-lg">
            🎉 Mantap! Alpine.js bekerja dengan sempurna tanpa perlu memuat ulang halaman!
        </div>
    </div>
</div>
<?= $this->endSection() ?>