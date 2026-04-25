<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>e-Prestasi | Sistem Informasi Manajemen Prestasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        /* Kustomisasi warna primary jika diperlukan */
        .text-primary {
            color: #16a34a;
        }

        /* green-600 */
        .bg-primary {
            background-color: #16a34a;
        }
    </style>
</head>

<body class="bg-slate-50 min-h-screen flex flex-col">

    <div class="bg-green-800 text-white py-2 px-4 sm:px-6 lg:px-8 hidden md:block">
        <div class="max-w-7xl mx-auto flex flex-wrap justify-between items-center text-xs font-medium tracking-wide gap-2">
            <div class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <span class="truncate">Jl. Pendidikan No. 123, Kota Cerdas, Provinsi Hebat, Kode Pos 12345</span>
            </div>

            <div class="flex items-center gap-4">
                <div class="flex items-center gap-1.5 hover:text-green-300 transition-colors cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                    </svg>
                    <span>+62 812 3456 7890</span>
                </div>
                <div class="w-px h-4 bg-green-600"></div>
                <div class="flex items-center gap-3 text-sm font-bold">
                    <a href="#" class="hover:text-green-400 transition-colors" title="YouTube">▶</a>
                    <a href="#" class="hover:text-green-400 transition-colors" title="Facebook">f</a>
                    <a href="#" class="hover:text-green-400 transition-colors" title="Instagram">📷</a>
                </div>
            </div>
        </div>
    </div>

    <nav class="bg-white border-b border-slate-200 shadow-md sticky top-0 z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-3 sm:py-0 sm:h-24 gap-2">

                <div class="flex items-center gap-2 sm:gap-4 max-w-[65%] sm:max-w-none">
                    <div class="bg-green-600 text-white p-2 sm:p-2.5 rounded-full shadow-md shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 sm:h-10 sm:w-10" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10.394 2.827a1 1 0 00-.788 0l-7 3a1 1 0 000 1.846l7 3a1 1 0 00.788 0l7-3a1 1 0 000-1.846l-7-3z" />
                            <path d="M6.75 6.75C6.75 5.784 7.466 5 8.344 5h3.313c.878 0 1.593.784 1.593 1.75v4.5a.75.75 0 01-1.5 0v-4.5h-3.313v4.5a.75.75 0 01-1.5 0v-4.5z" />
                            <path d="M3 10.246l7 3 7-3v3a1 1 0 01-.553.894l-6 3a1 1 0 01-.894 0l-6-3A1 1 0 013 13.246v-3z" />
                        </svg>
                    </div>

                    <div class="flex flex-col justify-center">
                        <span class="font-extrabold text-lg sm:text-2xl text-[#006039] tracking-tight uppercase leading-none mb-1 sm:mb-1.5 truncate">
                            E-PRESTASI
                        </span>
                        <span class="text-green-600 font-bold text-[10px] sm:text-sm leading-none mb-1 sm:mb-1.5 truncate">
                            Kreatif, Inovatif, Berprestasi
                        </span>
                        <span class="text-slate-500 text-[10px] sm:text-xs font-medium leading-none hidden sm:block truncate">
                            Sistem Informasi Manajemen Sekolah
                        </span>
                    </div>
                </div>

                <div class="hidden lg:flex space-x-8 items-center h-full">
                    <a href="#" class="text-green-700 font-bold border-b-[3px] border-green-600 h-full flex items-center pt-1">Beranda</a>
                    <a href="#" class="text-slate-600 hover:text-green-600 font-semibold h-full flex items-center pt-1 transition-colors">Profil</a>
                    <a href="#" class="text-slate-600 hover:text-green-600 font-semibold h-full flex items-center pt-1 transition-colors">Katalog Prestasi</a>
                    <a href="#" class="text-slate-600 hover:text-green-600 font-semibold h-full flex items-center pt-1 transition-colors">Statistik</a>
                </div>

                <div class="flex items-center shrink-0">
                    <a href="<?= base_url('/login') ?>" class="bg-[#00a651] hover:bg-green-700 text-white px-3 py-2 sm:px-7 sm:py-2.5 rounded-lg text-xs sm:text-base font-bold tracking-wide transition-all shadow-md hover:shadow-lg transform hover:-translate-y-0.5 text-center">
                        Login<span class="hidden sm:inline"> Sistem</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <main class="grow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 md:py-12">

            <div class="bg-green-950 rounded-2xl md:rounded-3xl p-6 md:p-14 lg:p-20 relative overflow-hidden shadow-2xl">
                <div class="absolute right-0 bottom-0 opacity-10 transform translate-x-1/4 translate-y-1/4 hidden sm:block">
                    <div class="w-64 h-64 md:w-96 md:h-96 border-[12px] md:border-16 border-green-400 rounded-3xl"></div>
                    <div class="w-64 h-64 md:w-96 md:h-96 border-[12px] md:border-16 border-green-400 rounded-3xl absolute top-8 -left-8 md:top-12 md:-left-12"></div>
                </div>

                <div class="relative z-10 max-w-3xl">
                    <div class="inline-block bg-green-500/20 border border-green-500/30 text-green-400 px-3 py-1 sm:px-4 sm:py-1.5 rounded-full text-xs sm:text-sm font-semibold tracking-wide mb-6 sm:mb-8 uppercase">
                        Versi 1.0
                    </div>

                    <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold text-white leading-[1.2] md:leading-[1.1] mb-4 sm:mb-6">
                        Sistem Informasi Manajemen <span class="text-green-400">Prestasi Siswa</span>
                    </h1>

                    <p class="text-green-100/80 text-base sm:text-lg md:text-xl max-w-2xl leading-relaxed mb-8 sm:mb-10">
                        Platform pencatatan dan pengelolaan data prestasi siswa secara terpusat. Memudahkan sekolah dalam mendokumentasikan pencapaian akademik dan non-akademik secara transparan.
                    </p>

                    <div class="flex flex-col sm:flex-row flex-wrap gap-3 sm:gap-4">
                        <a href="#katalog" class="bg-green-600 text-white hover:bg-green-500 px-6 py-3 sm:px-8 sm:py-3.5 rounded-xl font-semibold shadow-lg shadow-green-900/20 transition-all duration-200 text-center">
                            Lihat Katalog
                        </a>
                        <a href="<?= base_url('/login') ?>" class="bg-white/10 text-white border border-white/20 hover:bg-white/20 px-6 py-3 sm:px-8 sm:py-3.5 rounded-xl font-semibold transition-all duration-200 flex items-center justify-center gap-2">
                            Masuk Sistem &rarr;
                        </a>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 sm:gap-6 mt-6 md:mt-8">

                <div class="bg-white rounded-2xl p-6 sm:p-8 border border-slate-100 shadow-sm flex flex-col items-center text-center group hover:border-green-200 transition-colors">
                    <div class="bg-green-50 text-green-600 p-3 sm:p-4 rounded-full mb-3 sm:mb-4 group-hover:bg-green-600 group-hover:text-white transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 sm:h-8 sm:w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-7.714 2.143L11 21l-2.286-6.857L1 12l7.714-2.143L11 3z" />
                        </svg>
                    </div>
                    <h3 class="text-3xl sm:text-4xl font-black text-slate-800 mb-1 sm:mb-2">124</h3>
                    <p class="text-slate-500 text-sm sm:text-base font-medium">Total Prestasi</p>
                </div>

                <div class="bg-white rounded-2xl p-6 sm:p-8 border border-slate-100 shadow-sm flex flex-col items-center text-center group hover:border-green-200 transition-colors">
                    <div class="bg-green-50 text-green-600 p-3 sm:p-4 rounded-full mb-3 sm:mb-4 group-hover:bg-green-600 group-hover:text-white transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 sm:h-8 sm:w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <h3 class="text-3xl sm:text-4xl font-black text-slate-800 mb-1 sm:mb-2">86</h3>
                    <p class="text-slate-500 text-sm sm:text-base font-medium">Siswa Aktif</p>
                </div>

                <div class="bg-white rounded-2xl p-6 sm:p-8 border border-slate-100 shadow-sm flex flex-col items-center text-center group hover:border-green-200 transition-colors sm:col-span-2 md:col-span-1">
                    <div class="bg-green-50 text-green-600 p-3 sm:p-4 rounded-full mb-3 sm:mb-4 group-hover:bg-green-600 group-hover:text-white transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 sm:h-8 sm:w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-3xl sm:text-4xl font-black text-slate-800 mb-1 sm:mb-2">100%</h3>
                    <p class="text-slate-500 text-sm sm:text-base font-medium">Tervalidasi Sistem</p>
                </div>

            </div>
        </div>
    </main>

    <footer class="bg-green-900 text-green-50 pt-12 md:pt-16 relative font-sans mt-8 md:mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 md:gap-10">

                <div>
                    <div class="flex items-center gap-3 mb-4">
                        <div class="bg-white text-green-800 p-1.5 rounded-full shadow-sm shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 sm:h-10 sm:w-10" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1.323l3.954 1.582 1.599-.8a1 1 0 01.894 1.79l-1.233.616 1.738 5.42a1 1 0 01-.285 1.05A3.989 3.989 0 0115 15a3.989 3.989 0 01-2.667-1.019 1 1 0 01-.285-1.05l1.715-5.349L11 6.477V16h2a1 1 0 110 2H7a1 1 0 110-2h2V6.477L6.237 7.582l1.715 5.349a1 1 0 01-.285 1.05A3.989 3.989 0 015 15a3.989 3.989 0 01-2.667-1.019 1 1 0 01-.285-1.05l1.738-5.42-1.233-.617a1 1 0 01.894-1.788l1.599.799L9 4.323V3a1 1 0 011-1z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-extrabold text-lg sm:text-xl tracking-tight leading-none mb-1 text-white uppercase">E-PRESTASI</h3>
                            <p class="text-green-400 font-bold text-[10px] sm:text-xs leading-none">Kreatif, Inovatif, Berprestasi</p>
                        </div>
                    </div>
                    <p class="text-green-100/80 text-sm leading-relaxed mb-6">
                        Mencetak generasi yang unggul dalam IPTEK, kokoh dalam IMTAQ, dan berakhlakul karimah melalui pencatatan prestasi yang terintegrasi.
                    </p>
                    <div class="flex gap-3">
                        <a href="#" class="w-9 h-9 rounded-full bg-green-800/50 border border-green-700 flex items-center justify-center hover:bg-green-600 transition-colors">
                            <span class="font-bold text-sm">f</span>
                        </a>
                        <a href="#" class="w-9 h-9 rounded-full bg-green-800/50 border border-green-700 flex items-center justify-center hover:bg-green-600 transition-colors">
                            <span class="font-bold text-sm">📷</span>
                        </a>
                        <a href="#" class="w-9 h-9 rounded-full bg-green-800/50 border border-green-700 flex items-center justify-center hover:bg-green-600 transition-colors">
                            <span class="font-bold text-sm">▶</span>
                        </a>
                        <a href="#" class="w-9 h-9 rounded-full bg-green-800/50 border border-green-700 flex items-center justify-center hover:bg-green-600 transition-colors">
                            <span class="font-bold text-sm">🎵</span>
                        </a>
                    </div>
                </div>

                <div>
                    <h4 class="text-green-400 font-bold tracking-wider uppercase mb-4 md:mb-6 text-sm">Akses Cepat</h4>
                    <ul class="space-y-3 text-sm">
                        <li>
                            <a href="#" class="flex items-center gap-2 text-green-100 hover:text-white transition-colors group">
                                <span class="text-green-500 group-hover:translate-x-1 transition-transform">›</span> Raport Digital Madrasah
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center gap-2 text-green-100 hover:text-white transition-colors group">
                                <span class="text-green-500 group-hover:translate-x-1 transition-transform">›</span> E-Learning
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center gap-2 text-green-100 hover:text-white transition-colors group">
                                <span class="text-green-500 group-hover:translate-x-1 transition-transform">›</span> Sistem Laboratorium
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center gap-2 text-green-100 hover:text-white transition-colors group">
                                <span class="text-green-500 group-hover:translate-x-1 transition-transform">›</span> Siakad
                            </a>
                        </li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-green-400 font-bold tracking-wider uppercase mb-4 md:mb-6 text-sm">Hubungi Kami</h4>
                    <ul class="space-y-4 text-sm text-green-100">
                        <li class="flex items-start gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mt-0.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span class="leading-relaxed">Jl. K.H. Achmad Musayyidi No. 177 Desa Karangdoro Kec. Tegalsari Kab. Banyuwangi, Jawa Timur Kode Pos 68485</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <span>+6285746910126</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <span class="break-all">email@sekolah-anda.com</span>
                        </li>
                    </ul>
                </div>

                <div>
                    <div class="bg-[#0b3d26] rounded-xl p-5 border border-green-800 shadow-lg">
                        <h4 class="text-white font-bold tracking-wider uppercase mb-4 text-sm flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M11 3a1 1 0 100 2h2.586l-6.293 6.293a1 1 0 101.414 1.414L15 6.414V9a1 1 0 102 0V4a1 1 0 00-1-1h-5z" clip-rule="evenodd" />
                                <path fill-rule="evenodd" d="M5 5a2 2 0 00-2 2v8a2 2 0 002 2h8a2 2 0 002-2v-3a1 1 0 10-2 0v3H5V7h3a1 1 0 000-2H5z" clip-rule="evenodd" />
                            </svg>
                            INFO PENDAFTARAN
                        </h4>

                        <div class="w-full h-28 bg-green-800 rounded-lg mb-4 flex items-center justify-center text-green-200/50 text-xs border border-green-700/50 overflow-hidden relative group text-center px-2">
                            <span class="absolute z-10 font-bold tracking-widest">GAMBAR BANNER SPMB</span>
                            <div class="absolute inset-0 bg-green-900/40 mix-blend-multiply"></div>
                        </div>

                        <a href="#" class="w-full bg-[#00a651] hover:bg-green-500 text-white font-bold py-2.5 px-4 rounded-lg flex items-center justify-center gap-2 mb-3 transition-colors shadow-md text-sm sm:text-base">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                            </svg>
                            Daftar Sekarang
                        </a>
                        <a href="#" class="w-full bg-transparent border border-green-700 hover:bg-green-800 text-white font-bold py-2.5 px-4 rounded-lg flex items-center justify-center gap-2 transition-colors text-sm sm:text-base">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Unduh Brosur
                        </a>
                    </div>
                </div>

            </div>

            <div class="mt-10 md:mt-12 pt-6 pb-20 md:pb-6 border-t border-green-800 flex flex-col md:flex-row justify-between items-center gap-4 text-xs text-green-200 text-center md:text-left">
                <p>&copy; <?= date('Y') ?> E-Prestasi. Hak Cipta Dilindungi.</p>
                <p class="flex items-center gap-1">
                    Website dikembangkan dengan <span class="text-red-500 text-sm">❤</span>
                </p>
            </div>

            <button onclick="window.scrollTo({top: 0, behavior: 'smooth'})" class="absolute bottom-6 right-4 sm:right-6 lg:right-8 bg-[#00a651] hover:bg-green-500 text-white p-3 rounded-full shadow-lg transition-transform hover:-translate-y-1 z-10">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                </svg>
            </button>
        </div>
    </footer>

</body>

</html>