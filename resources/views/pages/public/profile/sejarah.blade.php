@extends('layouts.public', ['title' => 'Sejarah & Visi Misi - PPMTQ Daar El Tazkiyah Sumardi'])

@section('content')
    <!-- Page Header (Editorial Academic Banner) -->
    <section class="bg-white border-b border-[#E5E0D8] pt-12 pb-14 md:pt-16 md:pb-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl space-y-4">
                <div class="flex items-center gap-3">
                    <span class="editorial-label">01 — PROFIL INSTITUSI</span>
                    <span class="w-8 h-px bg-[#B89758]"></span>
                    <span class="text-xs font-mono text-[#4B6358] uppercase tracking-wider">Sejarah & Khazanah</span>
                </div>
                <h1 class="font-sans text-3xl sm:text-4xl md:text-5xl font-bold text-[#0D3B2E] tracking-tight leading-[1.15]">
                    Menempa Generasi Qur'ani Berintegritas dan Berilmu Amaliah
                </h1>
                <p class="text-base sm:text-lg text-[#4B6358] leading-relaxed">
                    Perjalanan sejarah, amanah wakaf keluarga, serta arah haluan pendidikan Pondok Pesantren Modern Tahfidzul Quran Daar El Tazkiyah Sumardi di Ciampea, Bogor.
                </p>
            </div>
        </div>
    </section>

    <!-- Main Content Grid -->
    <section class="py-16 md:py-24 bg-[#FAF8F5]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">

                <!-- Left Column: Sticky Editorial Meta & Leadership Card -->
                <aside class="lg:col-span-4 space-y-8 lg:sticky lg:top-28">
                    <!-- Leadership Citation Card -->
                    <div class="bg-white border border-[#E5E0D8] rounded-md p-6 sm:p-8 space-y-6">
                        <div class="space-y-2 border-b border-[#E5E0D8] pb-5">
                            <span class="editorial-label">PENGASUH PONDOK</span>
                            <h2 class="font-sans text-xl font-bold text-[#0D3B2E]">
                                Ust. Ahmad Ashil Fadhil, S.H., M.H.
                            </h2>
                            <p class="text-xs text-[#059669] font-medium">
                                Institut PTIQ Jakarta & Magister Hukum
                            </p>
                            <p class="font-arabic text-sm text-[#B89758] pt-1" dir="rtl">
                                حفظه الله تعالى ورعاه
                            </p>
                        </div>

                        <blockquote class="text-sm text-[#18181B] leading-relaxed italic border-l-2 border-[#B89758] pl-4">
                            "Pesantren ini didirikan bukan sekadar sebagai tempat menghafal lafazh Al-Qur'an, melainkan kawah candradimuka penempaan adab, ketajaman intelektual, dan keteguhan akhlak santri agar siap menjadi lentera di tengah umat."
                        </blockquote>

                        <div class="pt-2 text-xs text-[#4B6358] space-y-2">
                            <div class="flex justify-between py-1 border-b border-[#E5E0D8]/60">
                                <span>Lokasi Kampus</span>
                                <span class="font-medium text-[#0D3B2E]">Ciampea, Bogor</span>
                            </div>
                            <div class="flex justify-between py-1 border-b border-[#E5E0D8]/60">
                                <span>Basis Kurikulum</span>
                                <span class="font-medium text-[#0D3B2E]">Kemenag RI & Pesantren Salaf</span>
                            </div>
                            <div class="flex justify-between py-1 border-b border-[#E5E0D8]/60">
                                <span>Target Hafalan</span>
                                <span class="font-medium text-[#0D3B2E]">30 Juz Mutqin Bersanad</span>
                            </div>
                        </div>

                        <div class="pt-2">
                            <a href="{{ route('profile.teachers') }}" class="inline-flex items-center gap-2 text-xs font-semibold text-[#0D3B2E] hover:text-[#059669] transition">
                                <span>Lihat Profil Dewan Asatidz Selengkapnya</span>
                                <span aria-hidden="true">&rarr;</span>
                            </a>
                        </div>
                    </div>

                    <!-- Quick Navigation Box -->
                    <div class="bg-white border border-[#E5E0D8] rounded-md p-6 space-y-3">
                        <span class="editorial-label">NAVIGASI PROFIL</span>
                        <ul class="text-sm space-y-2 pt-1 font-medium text-[#18181B]">
                            <li class="border-l-2 border-[#0D3B2E] pl-3 text-[#0D3B2E] font-semibold">
                                Sejarah & Visi Misi
                            </li>
                            <li class="border-l-2 border-transparent pl-3 text-[#4B6358] hover:border-[#E5E0D8] hover:text-[#0D3B2E] transition">
                                <a href="{{ route('profile.teachers') }}">Dewan Asatidz & Tenaga Pendidik</a>
                            </li>
                            <li class="border-l-2 border-transparent pl-3 text-[#4B6358] hover:border-[#E5E0D8] hover:text-[#0D3B2E] transition">
                                <a href="{{ route('profile.facilities') }}">Sarana & Prasarana Kampus</a>
                            </li>
                        </ul>
                    </div>
                </aside>

                <!-- Right Column: Narrative Sejarah & Visi Misi -->
                <div class="lg:col-span-8 space-y-12 bg-white border border-[#E5E0D8] rounded-md p-8 sm:p-12">

                    <!-- Section: Latar Belakang & Sejarah -->
                    <article class="space-y-6">
                        <div class="flex items-center gap-3 border-b border-[#E5E0D8] pb-4">
                            <span class="editorial-label">BAGIAN 01</span>
                            <span class="text-xs text-[#E5E0D8]">|</span>
                            <h2 class="font-sans text-2xl font-bold text-[#0D3B2E]">
                                Titik Tolak & Sejarah Pendirian
                            </h2>
                        </div>

                        <div class="prose max-w-none text-[#18181B] text-base leading-relaxed space-y-4">
                            <p>
                                <strong>Pondok Pesantren Modern Tahfidzul Quran (PPMTQ) Daar El Tazkiyah Sumardi</strong> berakar dari niat luhur keluarga besar Almarhum H. Sumardi untuk mengabadikan amanah wakaf dan bakti umat melalui sarana pendidikan Al-Qur'an berkelanjutan. Berlokasi di kawasan hijau nan hening di Cihideung Udik, Ciampea, Kabupaten Bogor, lingkungan pesantren dirancang secara khusus untuk memberikan kekhusyukan maksimal bagi para santri dalam menghafal Al-Qur'an dan menuntut ilmu-ilmu syar'i.
                            </p>
                            <p>
                                Nama <em>"Daar El Tazkiyah"</em> bermakna <em>"Rumah Penyucian Jiwa"</em> (تزكية النفس), yang menegaskan bahwa menghafal kalamullah bukan sekadar melafalkan huruf dan bait ayat, melainkan proses tazkiyatun nafs: memurnikan hati dari noda duniawi, menegakkan budi pekerti luhur (adab), dan menyuburkan kecintaan sejati kepada Allah dan Rasul-Nya.
                            </p>
                            <p>
                                Dipimpin langsung oleh <strong>Ust. Ahmad Ashil Fadhil, S.H., M.H.</strong>, alumni Institut PTIQ Jakarta dengan bekal sanad keilmuan Al-Qur'an yang mu'tabar, pesantren memadukan kedalaman tradisi kajian kitab kuning khas pesantren salafiyah dengan ketertiban kurikulum akademik madrasah formal tingkat Tsanawiyah (MTS) di bawah bimbingan Kementerian Agama Republik Indonesia.
                            </p>
                        </div>
                    </article>

                    <!-- Section: Visi Utama -->
                    <article class="space-y-6 pt-4 border-t border-[#E5E0D8]">
                        <div class="flex items-center gap-3 border-b border-[#E5E0D8] pb-4">
                            <span class="editorial-label">BAGIAN 02</span>
                            <span class="text-xs text-[#E5E0D8]">|</span>
                            <h2 class="font-sans text-2xl font-bold text-[#0D3B2E]">
                                Visi Utama Pesantren
                            </h2>
                        </div>

                        <!-- Formal Quote Card -->
                        <div class="bg-[#FAF8F5] border-l-4 border-[#0D3B2E] rounded-r-md p-6 sm:p-8 space-y-3">
                            <p class="font-sans text-xl sm:text-2xl text-[#0D3B2E] font-bold leading-relaxed">
                                "Melahirkan generasi Qur'ani yang berilmu, berakhlak mulia, berprestasi dan siap mengabdi untuk umat."
                            </p>
                            <p class="text-sm text-[#4B6358] leading-relaxed">
                                Landasan utama yang menjiwai setiap denyut kehidupan santri di asrama, bilik halaqah, hingga ruang kelas formal, guna membentuk pribadi yang mutafaqqih fiddin, tangguh mental, serta mandiri.
                            </p>
                        </div>
                    </article>

                    <!-- Section: Empat Pilar Misi -->
                    <article class="space-y-6 pt-4 border-t border-[#E5E0D8]">
                        <div class="flex items-center gap-3 border-b border-[#E5E0D8] pb-4">
                            <span class="editorial-label">BAGIAN 03</span>
                            <span class="text-xs text-[#E5E0D8]">|</span>
                            <h2 class="font-sans text-2xl font-bold text-[#0D3B2E]">
                                Misi & Komitmen Pendidikan
                            </h2>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <!-- Misi 1 -->
                            <div class="border border-[#E5E0D8] rounded-md p-6 space-y-2.5 bg-white">
                                <span class="editorial-label text-[#059669]">MISI 01</span>
                                <h3 class="font-sans font-bold text-lg text-[#0D3B2E]">
                                    Menanamkan kecintaan kepada Al-Qur'an
                                </h3>
                                <p class="text-sm text-[#4B6358] leading-relaxed">
                                    Membimbing hafalan 30 juz Al-Qur'an dengan kaidah tajwid tahsin bersanad, tadabbur makna ayat, dan pembiasaan muraja'ah intensif harian.
                                </p>
                            </div>

                            <!-- Misi 2 -->
                            <div class="border border-[#E5E0D8] rounded-md p-6 space-y-2.5 bg-white">
                                <span class="editorial-label text-[#059669]">MISI 02</span>
                                <h3 class="font-sans font-bold text-lg text-[#0D3B2E]">
                                    Membentuk akhlak mulia dan disiplin
                                </h3>
                                <p class="text-sm text-[#4B6358] leading-relaxed">
                                    Menegakkan keteladanan adab Islami, disiplin ibadah fardhu & sunnah berjamaah di masjid, serta pembiasaan hidup mandiri di asrama mukim.
                                </p>
                            </div>

                            <!-- Misi 3 -->
                            <div class="border border-[#E5E0D8] rounded-md p-6 space-y-2.5 bg-white">
                                <span class="editorial-label text-[#059669]">MISI 03</span>
                                <h3 class="font-sans font-bold text-lg text-[#0D3B2E]">
                                    Memberikan pendidikan berkualitas berbasis Islam
                                </h3>
                                <p class="text-sm text-[#4B6358] leading-relaxed">
                                    Memadukan kurikulum keagamaan muadalah pesantren dengan standar nasional Kementerian Agama RI serta wawasan sains, teknologi, dan bahasa.
                                </p>
                            </div>

                            <!-- Misi 4 -->
                            <div class="border border-[#E5E0D8] rounded-md p-6 space-y-2.5 bg-white">
                                <span class="editorial-label text-[#059669]">MISI 04</span>
                                <h3 class="font-sans font-bold text-lg text-[#0D3B2E]">
                                    Mempersiapkan santri berprestasi di tingkat nasional
                                </h3>
                                <p class="text-sm text-[#4B6358] leading-relaxed">
                                    Mengasah talenta santri dalam ajang Musabaqah Hifdzil Qur'an (MHQ), olimpiade sains madrasah, pidato bahasa Arab & Inggris, serta kepemimpinan umat.
                                </p>
                            </div>
                        </div>
                    </article>

                    <!-- Section: Nilai-Nilai Luhur Santri (Panca Jiwa) -->
                    <article class="space-y-6 pt-4 border-t border-[#E5E0D8]">
                        <div class="flex items-center gap-3 border-b border-[#E5E0D8] pb-4">
                            <span class="editorial-label">BAGIAN 04</span>
                            <span class="text-xs text-[#E5E0D8]">|</span>
                            <h2 class="font-sans text-2xl font-bold text-[#0D3B2E]">
                                Nilai Luhur & Karakter Pesantren
                            </h2>
                        </div>

                        <div class="space-y-4 text-sm text-[#18181B] leading-relaxed">
                            <div class="p-4 border-l-2 border-[#B89758] rounded-r-md bg-[#FAF8F5]">
                                <strong class="text-[#0D3B2E] block font-semibold mb-1">1. Keikhlasan (Al-Ikhlas)</strong>
                                <p class="text-[#4B6358]">Segala amal belajar, mengajar, dan beribadah diniatkan semata-mata mengharap ridha Allah Subhanahu Wa Ta'ala, tanpa pamrih kedudukan atau materi.</p>
                            </div>
                            <div class="p-4 border-l-2 border-[#B89758] rounded-r-md bg-[#FAF8F5]">
                                <strong class="text-[#0D3B2E] block font-semibold mb-1">2. Kesederhanaan (Al-Basaathah)</strong>
                                <p class="text-[#4B6358]">Menumbuhkan keteguhan batin, kepedulian terhadap sesama, dan rasa syukur atas setiap nikmat tanpa bermewah-mewah.</p>
                            </div>
                            <div class="p-4 border-l-2 border-[#B89758] rounded-r-md bg-[#FAF8F5]">
                                <strong class="text-[#0D3B2E] block font-semibold mb-1">3. Kemandirian (Al-I'timad 'Alal Nafs)</strong>
                                <p class="text-[#4B6358]">Melatih santri bertanggung jawab atas kebutuhan diri sendiri, disiplin waktu, kebersihan, dan kesiapan memecahkan persoalan hidup.</p>
                            </div>
                            <div class="p-4 border-l-2 border-[#B89758] rounded-r-md bg-[#FAF8F5]">
                                <strong class="text-[#0D3B2E] block font-semibold mb-1">4. Ukhuwah Islamiyah</strong>
                                <p class="text-[#4B6358]">Menjalin persaudaraan erat antarsesama santri dari berbagai daerah di nusantara dalam naungan mahabbah Al-Qur'an.</p>
                            </div>
                        </div>
                    </article>

                    <!-- Bottom CTA to PSB -->
                    <div class="pt-6 border-t border-[#E5E0D8] flex flex-col sm:flex-row items-center justify-between gap-4">
                        <div class="text-xs text-[#4B6358]">
                            Tertarik menyekolahkan putra-putri Anda di PPMTQ Daar El Tazkiyah?
                        </div>
                        <a href="{{ route('psb.index') }}" class="inline-flex items-center gap-2 px-6 py-2.5 rounded-md bg-[#0D3B2E] text-white font-semibold text-xs tracking-wide uppercase hover:bg-[#059669] transition">
                            <span>Informasi Pendaftaran PSB Online</span>
                            <span aria-hidden="true">&rarr;</span>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
