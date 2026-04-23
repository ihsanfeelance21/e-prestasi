<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pendataan Prestasi Siswa</title>

    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script src="https://unpkg.com/htmx.org@1.9.11"></script>
</head>

<body class="bg-bglight text-slate-900 font-sans antialiased min-h-screen flex flex-col">

    <header class="bg-primary text-white shadow-md p-4">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold tracking-tight">🏆 e-Prestasi</h1>
            <nav>
                <a href="#" class="hover:text-accent transition-colors font-medium">Login</a>
            </nav>
        </div>
    </header>

    <main class="container mx-auto p-4 flex-grow mt-6">
        <?= $this->renderSection('content') ?>
    </main>

    <footer class="bg-white border-t border-slate-200 mt-auto p-4 text-center text-sm text-slate-500">
        &copy; <?= date('Y') ?> Lembaga Pendidikan. Dibangun dengan CodeIgniter 4 & Tailwind CSS.
    </footer>

</body>

</html>