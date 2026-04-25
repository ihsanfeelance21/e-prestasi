<?= $this->extend('layout/dashboard_layout') ?> <?= $this->section('content') ?>
<div class="max-w-4xl mx-auto">
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">Edit Data Siswa</h2>
            <p class="text-slate-500 text-sm mt-1">Perbarui informasi atau pas foto siswa.</p>
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
        <form action="<?= base_url('/siswa/update/' . $siswa['id']) ?>" method="POST" enctype="multipart/form-data" class="p-6">
            <?= csrf_field() ?>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_siswa" value="<?= old('nama_siswa') ?? esc($siswa['nama_siswa']) ?>" required
                            oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')"
                            class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">NISN <span class="text-red-500">*</span></label>
                            <input type="text" name="nisn" value="<?= old('nisn') ?? esc($siswa['nisn']) ?>" required
                                inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary outline-none">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Kelas <span class="text-red-500">*</span></label>
                            <?php $kelasSaatIni = old('kelas') ?? $siswa['kelas']; ?>
                            <select name="kelas" required class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary outline-none bg-white">
                                <option value="X" <?= $kelasSaatIni == 'X' ? 'selected' : '' ?>>Kelas X</option>
                                <option value="XI" <?= $kelasSaatIni == 'XI' ? 'selected' : '' ?>>Kelas XI</option>
                                <option value="XII" <?= $kelasSaatIni == 'XII' ? 'selected' : '' ?>>Kelas XII</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Email</label>
                        <input type="email" name="email" value="<?= old('email') ?? esc($siswa['email']) ?>"
                            class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary outline-none">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">No HP/WA</label>
                        <input type="text" name="no_hp" value="<?= old('no_hp') ?? esc($siswa['no_hp']) ?>"
                            inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                            class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary outline-none">
                    </div>
                </div>

                <div x-data="{ imageUrl: '<?= base_url('uploads/siswa/' . $siswa['foto_siswa']) ?>' }">
                    <label class="block text-sm font-medium text-slate-700 mb-1">Pas Foto (Biarkan kosong jika tidak diubah)</label>
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-slate-300 border-dashed rounded-lg hover:border-primary transition-colors bg-slate-50 relative">
                        <div class="space-y-1 text-center">

                            <template x-if="imageUrl">
                                <img :src="imageUrl" class="mx-auto h-40 w-40 object-cover rounded-full border-4 border-white shadow-md mb-3">
                            </template>

                            <div class="flex text-sm text-slate-600 justify-center">
                                <label for="foto" class="relative cursor-pointer bg-white rounded-md font-medium text-primary hover:text-primary-hover focus-within:outline-none">
                                    <span>Ganti foto</span>
                                    <input id="foto" name="foto" type="file" class="sr-only" accept="image/png, image/jpeg, image/jpg, image/webp"
                                        @change="imageUrl = URL.createObjectURL($event.target.files[0])">
                                </label>
                            </div>
                            <p class="text-xs text-slate-500">Maks 2MB. Format WebP didukung.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-8 border-t border-slate-200 pt-5 flex justify-end">
                <button type="submit" class="bg-primary hover:bg-primary-hover text-white px-6 py-2.5 rounded-lg font-medium shadow-sm transition-all focus:ring-2 focus:ring-offset-2 focus:ring-primary flex items-center">
                    <span>💾 Simpan Perubahan</span>
                </button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>