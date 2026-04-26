<?= $this->extend('layout/dashboard_layout') ?> <?= $this->section('content') ?>
<div class="max-w-4xl mx-auto">
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">Tambah Siswa Baru</h2>
            <p class="text-slate-500 text-sm mt-1">Masukkan data lengkap dan unggah pas foto (Otomatis kompres ke WebP).</p>
        </div>
        <a href="<?= base_url('/siswa') ?>" class="text-slate-500 hover:text-slate-800 flex items-center transition-colors">
            <span class="mr-1">←</span> Kembali
        </a>
    </div>

    <?php if (session('validation') && session('validation')->getErrors()) : ?>
        <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-md">
            <div class="text-red-700 text-sm">
                <?= session('validation')->listErrors() ?>
            </div>
        </div>
    <?php endif; ?>

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <form action="<?= base_url('/siswa/store') ?>" method="POST" enctype="multipart/form-data" class="p-6">
            <?= csrf_field() ?>
            <?php if (session()->getFlashdata('errors')) : ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <ul class="list-disc pl-5">
                        <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach ?>
                    </ul>
                </div>
            <?php endif ?>

            <?php if (session()->getFlashdata('error')) : ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <?= esc(session()->getFlashdata('error')) ?>
                </div>
            <?php endif ?>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_siswa" value="<?= old('nama_siswa') ?>" required
                            oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')"
                            class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">NISN <span class="text-red-500">*</span></label>
                            <input type="text" name="nisn" value="<?= old('nisn') ?>" required
                                inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary outline-none">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Kelas <span class="text-red-500">*</span></label>
                            <select name="kelas" required class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary outline-none bg-white">
                                <option value="">Pilih Kelas</option>
                                <option value="X" <?= old('kelas') == 'X' ? 'selected' : '' ?>>Kelas X</option>
                                <option value="XI" <?= old('kelas') == 'XI' ? 'selected' : '' ?>>Kelas XI</option>
                                <option value="XII" <?= old('kelas') == 'XII' ? 'selected' : '' ?>>Kelas XII</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Email</label>
                        <input type="email" name="email" value="<?= old('email') ?>"
                            class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary outline-none">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">No HP/WA</label>
                        <input type="text" name="no_hp" value="<?= old('no_hp') ?>"
                            inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                            class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary outline-none">
                    </div>
                </div>

                <div x-data="{ imageUrl: '' }">
                    <label class="block text-sm font-medium text-slate-700 mb-1">Pas Foto (Maks 2MB)</label>
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-slate-300 border-dashed rounded-lg hover:border-primary transition-colors bg-slate-50 relative">
                        <div class="space-y-1 text-center">

                            <template x-if="imageUrl">
                                <img :src="imageUrl" class="mx-auto h-40 w-32 object-cover rounded-md border border-slate-200 shadow-sm mb-3">
                            </template>

                            <template x-if="!imageUrl">
                                <svg class="mx-auto h-12 w-12 text-slate-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </template>

                            <div class="flex text-sm text-slate-600 justify-center">
                                <label for="foto" class="relative cursor-pointer bg-white rounded-md font-medium text-primary hover:text-primary-hover focus-within:outline-none">
                                    <span>Upload file foto</span>
                                    <input id="foto" name="foto" type="file" class="sr-only" accept="image/png, image/jpeg, image/jpg, image/webp"
                                        @change="imageUrl = URL.createObjectURL($event.target.files[0])">
                                </label>
                            </div>
                            <p class="text-xs text-slate-500">PNG, JPG, JPEG maks 2MB</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-8 border-t border-slate-200 pt-5 flex justify-end">
                <button type="submit" class="bg-primary hover:bg-primary-hover text-white px-6 py-2.5 rounded-lg font-medium shadow-sm transition-all focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                    Simpan Data Siswa
                </button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>