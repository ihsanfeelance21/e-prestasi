<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title : 'e-Prestasi' ?> | Panel Aplikasi</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://unpkg.com/htmx.org@1.9.11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-bglight text-slate-800 font-sans antialiased" x-data="{ sidebarOpen: false }">

    <div class="flex h-screen overflow-hidden">

        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="fixed inset-y-0 left-0 z-50 w-64 bg-slate-900 text-white transition-transform duration-300 ease-in-out md:relative md:translate-x-0 flex flex-col">

            <div class="flex items-center justify-center h-16 bg-slate-950 border-b border-slate-800">
                <h1 class="text-xl font-bold text-accent tracking-wider">🏆 e-Prestasi</h1>
            </div>

            <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
                <a href="<?= base_url('/dashboard') ?>"
                    class="flex items-center px-4 py-3 mb-2 rounded-lg transition-all duration-200 
   <?= url_is('dashboard') ? 'bg-primary text-white shadow-md shadow-primary/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' ?>">
                    <span class="mr-3">🏠</span>
                    <span class="font-medium">Dashboard</span>
                </a>
                <a href="<?= base_url('/prestasi') ?>"
                    class="flex items-center px-4 py-3 mb-2 rounded-lg transition-all duration-200 
   <?= url_is('prestasi*') ? 'bg-primary text-white shadow-md shadow-primary/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' ?>">
                    <span class="mr-3">🏆</span>
                    <span class="font-medium">Data Prestasi</span>
                </a>
                <a href="<?= base_url('/siswa') ?>"
                    class="flex items-center px-4 py-3 mb-2 rounded-lg transition-all duration-200 
    <?= url_is('siswa*') ? 'bg-primary text-white shadow-md shadow-primary/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' ?>">
                    <span class="mr-3">🎓</span>
                    <span class="font-medium">Data Siswa</span>
                </a>
                <?php if (session()->get('role_id') == 1): // Menu khusus Admin 
                ?>
                    <a href="#" class="flex items-center px-4 py-3 hover:bg-slate-800 text-slate-300 rounded-lg transition-colors">
                        <span>👥 Manajemen Pengguna</span>
                    </a>
                <?php endif; ?>
            </nav>

            <div class="p-4 border-t border-slate-800">
                <a href="<?= base_url('/logout') ?>" class="flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-red-500 bg-red-500/10 rounded-lg hover:bg-red-500 hover:text-white transition-all">
                    🚪 Logout
                </a>
            </div>
        </aside>

        <div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 z-40 bg-black/50 md:hidden" x-transition.opacity></div>

        <div class="flex flex-col flex-1 overflow-hidden">

            <header class="flex items-center justify-between h-16 px-6 bg-white border-b border-slate-200 shadow-sm">
                <button @click="sidebarOpen = !sidebarOpen" class="text-slate-500 focus:outline-none md:hidden">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>

                <div class="flex items-center ml-auto">
                    <span class="text-sm font-medium text-slate-700 mr-2">Halo, <span class="capitalize text-primary font-bold"><?= session()->get('username') ?></span></span>
                    <div class="w-8 h-8 rounded-full bg-accent flex items-center justify-center text-white font-bold">
                        <?= strtoupper(substr(session()->get('username'), 0, 1)) ?>
                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-y-auto p-6">
                <?= $this->renderSection('content') ?>
            </main>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function confirmStatus(url, action, text, icon = 'question') {
            Swal.fire({
                title: 'Konfirmasi ' + action,
                text: text,
                icon: icon,
                showCancelButton: true,
                confirmButtonColor: icon === 'error' ? '#ef4444' : (icon === 'warning' ? '#f59e0b' : '#3b82f6'),
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Ya, Lanjutkan!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });
        }

        // Notifikasi Otomatis untuk Flashdata
        <?php if (session()->getFlashdata('success')) : ?>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '<?= session()->getFlashdata('success') ?>',
                timer: 2500,
                showConfirmButton: false
            });
        <?php endif; ?>
    </script>

</body>

</html>