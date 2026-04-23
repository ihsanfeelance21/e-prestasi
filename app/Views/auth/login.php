<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="flex items-center justify-center min-h-[75vh]">

    <div class="w-full max-w-md bg-white rounded-2xl shadow-lg border border-slate-100 p-8">

        <div class="text-center mb-8">
            <h2 class="text-3xl font-extrabold text-primary mb-1">e-Prestasi</h2>
            <p class="text-slate-500 text-sm">Masuk untuk mengelola data prestasi siswa</p>
        </div>

        <?php if (session()->getFlashdata('error')): ?>
            <div x-data="{ show: true }" x-show="show" class="bg-red-50 text-red-600 p-3 rounded-lg text-sm mb-4 border border-red-200 flex justify-between items-center">
                <span><?= session()->getFlashdata('error') ?></span>
                <button @click="show = false" class="text-red-400 hover:text-red-600">&times;</button>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('/login') ?>" method="POST" class="space-y-5">
            <?= csrf_field() ?> <div>
                <label for="username" class="block text-sm font-medium text-slate-700 mb-1">Username</label>
                <input type="text" id="username" name="username" required
                    class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all"
                    placeholder="Masukkan username" autocomplete="off">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-slate-700 mb-1">Password</label>
                <input type="password" id="password" name="password" required
                    class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all"
                    placeholder="••••••••">
            </div>

            <button type="submit"
                class="w-full bg-primary hover:bg-primary-hover text-white font-bold py-2.5 rounded-lg shadow-md hover:shadow-lg transition-all flex justify-center items-center">
                Masuk ke Dashboard
            </button>
        </form>

    </div>
</div>
<?= $this->endSection() ?>