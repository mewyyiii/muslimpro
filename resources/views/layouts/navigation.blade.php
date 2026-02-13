<nav x-data="{ open: false }" class="relative bg-gradient-to-r from-teal-500 to-emerald-500 shadow-lg sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo & Brand -->
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                    <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center shadow-md group-hover:scale-110 transition-transform">
                        <svg
                            viewBox="0 0 120 120"
                            class="w-6 h-6"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <!-- string -->
                            <path d="M60 8 Q65 12 60 16" stroke="#48bb78" stroke-width="3" fill="none"/>

                            <!-- beads -->
                            <circle cx="48" cy="22" r="6" fill="#48bb78"/>
                            <circle cx="60" cy="20" r="6" fill="#48bb78"/>
                            <circle cx="72" cy="22" r="6" fill="#48bb78"/>

                            <circle cx="44" cy="34" r="6" fill="#48bb78"/>
                            <circle cx="76" cy="34" r="6" fill="#48bb78"/>

                            <circle cx="46" cy="48" r="6" fill="#48bb78"/>
                            <circle cx="74" cy="48" r="6" fill="#48bb78"/>

                            <circle cx="52" cy="62" r="6" fill="#48bb78"/>
                            <circle cx="68" cy="62" r="6" fill="#48bb78"/>

                            <!-- tassel -->
                            <path
                                d="M56 72 L54 84
                                M60 72 L60 88
                                M64 72 L66 84"
                                stroke="#48bb78"
                                stroke-width="2"
                                stroke-linecap="round"
                            />
                        </svg>
                    </div>
                    <span class="text-xl font-bold text-white hidden sm:block">Al-Huda</span>
                </a>
            </div>

            <!-- Title Al-Huda di tengah — MOBILE ONLY -->
            <span class="md:hidden absolute left-1/2 -translate-x-1/2 pointer-events-none navbar-title-mobile">
                Al-Huda
            </span>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center space-x-1">
                <!-- Beranda -->
                <a href="{{ route('home') }}" 
                   class="nav-link px-4 py-2 rounded-lg text-white font-medium hover:bg-white/20 transition-all duration-200 {{ request()->routeIs('home') ? 'bg-white/30' : '' }}">
                    <svg class="w-5 h-5 inline-block mr-1 -mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    Beranda
                </a>

                <!-- Al-Quran -->
                <a href="{{ route('quran.index') }}" 
                   class="nav-link px-4 py-2 rounded-lg text-white font-medium hover:bg-white/20 transition-all duration-200 {{ request()->routeIs('quran.*') ? 'bg-white/30' : '' }}">
                    <svg class="w-5 h-5 inline-block mr-1 -mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                    Al-Quran
                </a>

                <!-- Asmaul Husna - Angka 99 -->
                <a href="{{ route('asmaul-husna.index') }}" 
                   class="nav-link px-4 py-2 rounded-lg text-white font-medium hover:bg-white/20 transition-all duration-200 {{ request()->routeIs('asmaul-husna.*') ? 'bg-white/30' : '' }}">
                    <svg class="w-5 h-5 inline-block mr-1 -mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <text x="2" y="18" font-family="Arial, sans-serif" font-size="14" font-weight="bold" fill="currentColor">99</text>
                    </svg>
                    Asmaul Husna
                </a>
                
                <!-- Doa Pendek - Icon Bulan & Bintang -->
                <a href="{{ route('doa-pendek.index') }}" 
                class="nav-link px-4 py-2 rounded-lg text-white font-medium hover:bg-white/20 transition-all duration-200 {{ request()->routeIs('doa-pendek.*') ? 'bg-white/30' : '' }}">
                    
                    <svg class="w-5 h-5 inline-block mr-1 -mt-1" 
                        fill="currentColor" 
                        viewBox="0 0 24 24" 
                        xmlns="http://www.w3.org/2000/svg">

                        <defs>
                            <!-- Mask untuk membuat bentuk bulan sabit tebal -->
                            <mask id="crescent-mask">
                                <rect width="24" height="24" fill="white"/>
                                <!-- Lingkaran putih yang "memotong" bagian kanan bulan -->
                                <circle cx="14.5" cy="9.5" r="6.8" fill="black"/>
                            </mask>
                        </defs>

                        <!-- Bulan sabit: lingkaran besar dipotong mask → hasilnya tebal & membulat -->
                        <circle cx="10" cy="13.5" r="7.5" mask="url(#crescent-mask)"/>

                        <!-- Bintang 5 sudut solid & gemuk (di pojok kanan atas) -->
                        <polygon points="
                            19,1.5
                            20.4,5.7
                            24.8,5.7
                            21.3,8.3
                            22.7,12.5
                            19,9.8
                            15.3,12.5
                            16.7,8.3
                            13.2,5.7
                            17.6,5.7
                        "/>

                    </svg>
                    Doa Pendek
                </a>

                <!-- Tasbih - Icon Lingkaran Tasbih dengan Tassel (TIDAK DIUBAH) -->
                <a href="{{ route('tasbih.index') }}" 
                   class="nav-link px-4 py-2 rounded-lg text-white font-medium hover:bg-white/20 transition-all duration-200 {{ request()->routeIs('tasbih.*') ? 'bg-white/30' : '' }}">
                    <svg class="w-5 h-5 inline-block mr-1 -mt-1" fill="currentColor" viewBox="0 0 24 24">
                        <!-- Beads circle -->
                        <circle cx="3" cy="12" r="2"/>
                        <circle cx="5.5" cy="8" r="2"/>
                        <circle cx="9" cy="5.5" r="2"/>
                        <circle cx="12" cy="3" r="2"/>
                        <circle cx="15" cy="5.5" r="2"/>
                        <circle cx="18.5" cy="8" r="2"/>
                        <circle cx="21" cy="12" r="2"/>
                        <circle cx="18.5" cy="16" r="2"/>
                        <circle cx="15" cy="18.5" r="2"/>
                        <circle cx="12" cy="21" r="2"/>
                        <circle cx="9" cy="18.5" r="2"/>
                        <circle cx="5.5" cy="16" r="2"/>
                        <!-- Tassel -->
                        <rect x="11" y="21" width="2" height="3" rx="0.5"/>
                        <circle cx="12" cy="24.5" r="1"/>
                    </svg>
                    Tasbih
                </a>

                <!-- Kiblat - Icon Ka'bah (Seperti gambar yang diupload) -->
                <a href="{{ route('qibla.index') }}" 
                class="nav-link px-4 py-2 rounded-lg text-white font-medium hover:bg-white/20 transition-all duration-200 {{ request()->routeIs('qibla.*') ? 'bg-white/30' : '' }}">
                    
                    <svg class="w-5 h-5 inline-block mr-1 -mt-1" fill="currentColor" viewBox="0 0 100 100">
                        <!-- Top section (Atap) -->
                        <polygon points="50,5 95,25 95,30 5,30 5,25"/>
                        
                        <!-- Layer 1 - dengan ornamen diamond -->
                        <rect x="10" y="30" width="80" height="8"/>
                        
                        <!-- Diamond ornaments layer 1 -->
                        <rect x="18" y="32" width="4" height="4" transform="rotate(45 20 34)"/>
                        <rect x="38" y="32" width="4" height="4" transform="rotate(45 40 34)"/>
                        <rect x="58" y="32" width="4" height="4" transform="rotate(45 60 34)"/>
                        <rect x="78" y="32" width="4" height="4" transform="rotate(45 80 34)"/>
                        
                        <!-- Layer 2 - Main body dengan door -->
                        <rect x="15" y="38" width="70" height="20"/>
                        
                        <!-- Door (Pintu Ka'bah) -->
                        <rect x="42" y="42" width="16" height="12" fill="white" opacity="0.15"/>
                        
                        <!-- Diamond ornaments layer 2 (kiri dan kanan door) -->
                        <rect x="22" y="46" width="4" height="4" transform="rotate(45 24 48)"/>
                        <rect x="74" y="46" width="4" height="4" transform="rotate(45 76 48)"/>
                        
                        <!-- Layer 3 - dengan ornamen diamond -->
                        <rect x="10" y="58" width="80" height="8"/>
                        
                        <!-- Diamond ornaments layer 3 -->
                        <rect x="18" y="60" width="4" height="4" transform="rotate(45 20 62)"/>
                        <rect x="38" y="60" width="4" height="4" transform="rotate(45 40 62)"/>
                        <rect x="58" y="60" width="4" height="4" transform="rotate(45 60 62)"/>
                        <rect x="78" y="60" width="4" height="4" transform="rotate(45 80 62)"/>
                        
                        <!-- Bottom layer 1 -->
                        <rect x="8" y="66" width="84" height="6"/>
                        
                        <!-- Bottom layer 2 (Base/Foundation) -->
                        <rect x="5" y="72" width="90" height="8"/>
                        
                        <!-- Bottom layer 3 (Paling bawah) -->
                        <rect x="2" y="80" width="96" height="6"/>
                    </svg>
                    
                    Kiblat
                </a>


                <!-- Tracking Shalat - Icon Orang Shalat/Sujud (Image 2 - Kanan) -->
                <a href="{{ route('prayer-tracking.index') }}" 
                   class="nav-link px-4 py-2 rounded-lg text-white font-medium hover:bg-white/20 transition-all duration-200 {{ request()->routeIs('prayer-tracking.*') ? 'bg-white/30' : '' }}">
                    <svg class="w-5 h-5 inline-block mr-1 -mt-1" fill="currentColor" viewBox="0 0 700 382" xmlns="http://www.w3.org/2000/svg">
                        <polygon fill="currentColor" points="284.0,0.0 286.0,0.0 288.0,0.0 290.0,0.0 292.0,0.0 294.0,0.0 296.0,0.0 298.0,0.0 300.0,0.0 302.0,0.0 304.0,0.0 306.0,0.0 308.0,2.0 310.0,2.0 312.0,2.0 314.0,2.0 316.0,2.0 318.0,2.0 320.0,2.0 322.0,2.0 324.0,2.0 326.0,2.0 328.0,2.0 330.0,2.0 332.0,2.0 334.0,2.0 336.0,2.0 338.0,2.0 340.0,2.0 342.0,2.0 344.0,4.0 346.0,4.0 348.0,4.0 350.0,4.0 352.0,4.0 354.0,4.0 356.0,4.0 358.0,6.0 360.0,6.0 362.0,6.0 364.0,6.0 366.0,6.0 368.0,8.0 370.0,8.0 372.0,8.0 374.0,8.0 376.0,8.0 378.0,10.0 380.0,10.0 382.0,10.0 384.0,12.0 386.0,12.0 388.0,12.0 390.0,14.0 392.0,14.0 394.0,14.0 396.0,16.0 398.0,16.0 400.0,18.0 402.0,18.0 404.0,20.0 406.0,20.0 408.0,22.0 410.0,22.0 412.0,22.0 414.0,24.0 416.0,24.0 418.0,26.0 420.0,26.0 422.0,28.0 424.0,28.0 426.0,28.0 428.0,30.0 430.0,30.0 432.0,30.0 434.0,32.0 436.0,32.0 438.0,34.0 440.0,34.0 442.0,34.0 444.0,36.0 446.0,36.0 448.0,36.0 450.0,38.0 452.0,38.0 454.0,40.0 456.0,40.0 458.0,42.0 460.0,42.0 462.0,42.0 464.0,44.0 466.0,44.0 468.0,46.0 470.0,46.0 472.0,48.0 474.0,48.0 476.0,50.0 478.0,50.0 480.0,52.0 482.0,52.0 484.0,54.0 486.0,54.0 488.0,56.0 490.0,58.0 492.0,58.0 494.0,60.0 496.0,62.0 498.0,62.0 500.0,64.0 502.0,66.0 504.0,66.0 506.0,68.0 508.0,68.0 510.0,70.0 512.0,72.0 514.0,74.0 516.0,74.0 518.0,76.0 520.0,78.0 522.0,78.0 524.0,80.0 526.0,82.0 528.0,84.0 530.0,84.0 532.0,86.0 534.0,88.0 536.0,90.0 538.0,90.0 540.0,92.0 542.0,94.0 544.0,96.0 546.0,98.0 548.0,100.0 550.0,102.0 552.0,104.0 554.0,106.0 556.0,108.0 558.0,110.0 560.0,112.0 562.0,114.0 564.0,116.0 566.0,118.0 568.0,120.0 570.0,122.0 570.0,124.0 572.0,126.0 574.0,128.0 576.0,130.0 576.0,132.0 578.0,134.0 580.0,136.0 582.0,138.0 582.0,140.0 584.0,142.0 586.0,144.0 586.0,146.0 588.0,148.0 588.0,150.0 590.0,152.0 592.0,154.0 592.0,156.0 594.0,158.0 594.0,160.0 596.0,162.0 598.0,164.0 598.0,166.0 600.0,168.0 602.0,170.0 604.0,172.0 604.0,174.0 606.0,176.0 606.0,178.0 608.0,180.0 608.0,182.0 608.0,184.0 610.0,186.0 610.0,188.0 612.0,190.0 612.0,192.0 614.0,194.0 616.0,196.0 616.0,198.0 616.0,200.0 616.0,202.0 616.0,204.0 616.0,206.0 614.0,208.0 616.0,210.0 618.0,212.0 620.0,212.0 622.0,212.0 624.0,212.0 626.0,210.0 628.0,210.0 630.0,210.0 632.0,210.0 634.0,210.0 636.0,210.0 638.0,210.0 640.0,210.0 642.0,210.0 644.0,210.0 646.0,210.0 648.0,210.0 650.0,212.0 652.0,212.0 654.0,212.0 656.0,214.0 658.0,214.0 660.0,216.0 662.0,216.0 664.0,218.0 666.0,218.0 668.0,220.0 670.0,222.0 672.0,222.0 674.0,224.0 676.0,226.0 678.0,228.0 680.0,230.0 682.0,232.0 684.0,234.0 686.0,236.0 688.0,238.0 688.0,240.0 690.0,242.0 690.0,244.0 692.0,246.0 692.0,248.0 694.0,250.0 694.0,252.0 696.0,254.0 696.0,256.0 696.0,258.0 698.0,260.0 698.0,262.0 698.0,264.0 698.0,266.0 698.0,268.0 698.0,270.0 698.0,272.0 698.0,274.0 698.0,276.0 698.0,278.0 698.0,280.0 698.0,282.0 696.0,284.0 696.0,286.0 696.0,288.0 696.0,290.0 694.0,292.0 694.0,294.0 694.0,296.0 692.0,298.0 692.0,300.0 690.0,302.0 690.0,304.0 688.0,306.0 686.0,308.0 686.0,310.0 684.0,312.0 684.0,314.0 682.0,316.0 680.0,318.0 678.0,320.0 676.0,322.0 676.0,324.0 674.0,326.0 672.0,326.0 670.0,328.0 668.0,330.0 666.0,330.0 664.0,330.0 662.0,332.0 660.0,332.0 658.0,332.0 656.0,334.0 654.0,334.0 652.0,334.0 650.0,336.0 648.0,336.0 646.0,336.0 644.0,336.0 642.0,336.0 640.0,336.0 638.0,336.0 636.0,336.0 634.0,336.0 632.0,334.0 630.0,334.0 628.0,332.0 626.0,332.0 624.0,330.0 622.0,330.0 620.0,330.0 618.0,330.0 616.0,330.0 614.0,330.0 612.0,332.0 610.0,332.0 608.0,332.0 606.0,334.0 604.0,334.0 602.0,336.0 600.0,336.0 598.0,336.0 596.0,336.0 594.0,334.0 594.0,332.0 594.0,330.0 592.0,328.0 590.0,326.0 588.0,326.0 586.0,324.0 584.0,324.0 582.0,324.0 582.0,322.0 580.0,320.0 578.0,320.0 576.0,320.0 574.0,318.0 572.0,318.0 570.0,318.0 568.0,318.0 566.0,316.0 564.0,316.0 562.0,314.0 560.0,314.0 558.0,314.0 556.0,314.0 554.0,314.0 552.0,314.0 550.0,314.0 548.0,314.0 546.0,314.0 544.0,314.0 542.0,314.0 540.0,314.0 538.0,314.0 536.0,314.0 534.0,314.0 532.0,314.0 530.0,314.0 528.0,314.0 526.0,314.0 524.0,314.0 522.0,314.0 520.0,314.0 518.0,314.0 516.0,314.0 514.0,314.0 512.0,314.0 510.0,314.0 508.0,314.0 506.0,314.0 504.0,314.0 502.0,316.0 500.0,314.0 498.0,314.0 496.0,314.0 494.0,314.0 492.0,314.0 490.0,316.0 492.0,318.0 494.0,320.0 496.0,320.0 496.0,322.0 498.0,324.0 500.0,324.0 502.0,326.0 504.0,328.0 506.0,330.0 508.0,332.0 510.0,334.0 512.0,336.0 514.0,338.0 516.0,340.0 518.0,342.0 520.0,344.0 522.0,344.0 524.0,346.0 526.0,346.0 528.0,346.0 530.0,346.0 532.0,346.0 534.0,346.0 536.0,346.0 538.0,348.0 540.0,346.0 542.0,346.0 544.0,346.0 546.0,346.0 548.0,348.0 550.0,348.0 552.0,348.0 554.0,348.0 556.0,348.0 558.0,350.0 560.0,350.0 562.0,350.0 564.0,350.0 566.0,352.0 568.0,352.0 570.0,352.0 572.0,352.0 574.0,354.0 576.0,354.0 578.0,354.0 580.0,354.0 582.0,356.0 584.0,356.0 586.0,356.0 588.0,356.0 590.0,356.0 592.0,358.0 594.0,358.0 596.0,358.0 598.0,360.0 600.0,360.0 602.0,360.0 604.0,360.0 606.0,362.0 608.0,362.0 610.0,364.0 612.0,364.0 612.0,366.0 614.0,368.0 614.0,370.0 614.0,372.0 612.0,374.0 610.0,376.0 608.0,376.0 606.0,378.0 604.0,378.0 602.0,378.0 600.0,378.0 598.0,378.0 596.0,378.0 594.0,378.0 592.0,378.0 590.0,378.0 588.0,378.0 586.0,378.0 584.0,378.0 582.0,378.0 580.0,378.0 578.0,378.0 576.0,378.0 574.0,378.0 572.0,378.0 570.0,378.0 568.0,378.0 566.0,378.0 564.0,378.0 562.0,378.0 560.0,378.0 558.0,378.0 556.0,378.0 554.0,378.0 552.0,378.0 550.0,378.0 548.0,378.0 546.0,378.0 544.0,378.0 542.0,378.0 540.0,378.0 538.0,380.0 536.0,380.0 534.0,380.0 532.0,380.0 530.0,380.0 528.0,380.0 526.0,380.0 524.0,378.0 522.0,378.0 520.0,376.0 518.0,374.0 516.0,372.0 514.0,372.0 512.0,372.0 510.0,372.0 508.0,372.0 506.0,374.0 504.0,374.0 502.0,374.0 500.0,376.0 498.0,376.0 496.0,376.0 494.0,376.0 492.0,376.0 490.0,374.0 488.0,374.0 486.0,372.0 484.0,372.0 482.0,370.0 482.0,368.0 480.0,366.0 478.0,366.0 476.0,364.0 474.0,362.0 472.0,360.0 470.0,358.0 468.0,356.0 466.0,356.0 464.0,354.0 462.0,354.0 460.0,352.0 458.0,352.0 456.0,350.0 454.0,350.0 452.0,348.0 450.0,346.0 448.0,346.0 446.0,344.0 444.0,342.0 442.0,340.0 440.0,340.0 440.0,338.0 438.0,336.0 436.0,336.0 434.0,334.0 432.0,332.0 432.0,330.0 430.0,328.0 428.0,326.0 426.0,324.0 426.0,322.0 424.0,320.0 422.0,318.0 420.0,316.0 418.0,314.0 416.0,312.0 414.0,310.0 412.0,308.0 410.0,306.0 408.0,304.0 406.0,302.0 404.0,302.0 402.0,300.0 400.0,300.0 398.0,300.0 396.0,300.0 394.0,300.0 392.0,302.0 392.0,304.0 392.0,306.0 392.0,308.0 392.0,310.0 392.0,312.0 392.0,314.0 392.0,316.0 392.0,318.0 392.0,320.0 392.0,322.0 392.0,324.0 392.0,326.0 392.0,328.0 392.0,330.0 392.0,332.0 392.0,334.0 392.0,336.0 392.0,338.0 392.0,340.0 392.0,342.0 392.0,344.0 392.0,346.0 392.0,348.0 392.0,350.0 392.0,352.0 392.0,354.0 392.0,356.0 390.0,358.0 390.0,360.0 388.0,362.0 388.0,364.0 386.0,366.0 384.0,368.0 382.0,370.0 380.0,372.0 378.0,374.0 376.0,376.0 374.0,376.0 372.0,378.0 370.0,378.0 368.0,378.0 366.0,378.0 364.0,378.0 362.0,378.0 360.0,380.0 358.0,380.0 356.0,380.0 354.0,380.0 352.0,380.0 350.0,380.0 348.0,380.0 346.0,380.0 344.0,380.0 342.0,380.0 340.0,380.0 338.0,380.0 336.0,380.0 334.0,380.0 332.0,380.0 330.0,380.0 328.0,380.0 326.0,380.0 324.0,380.0 322.0,380.0 320.0,380.0 318.0,380.0 316.0,380.0 314.0,380.0 312.0,380.0 310.0,380.0 308.0,380.0 306.0,380.0 304.0,380.0 302.0,380.0 300.0,380.0 298.0,380.0 296.0,380.0 294.0,380.0 292.0,380.0 290.0,380.0 288.0,380.0 286.0,378.0 284.0,378.0 282.0,378.0 280.0,378.0 278.0,378.0 276.0,376.0 274.0,376.0 272.0,376.0 270.0,376.0 268.0,376.0 266.0,376.0 264.0,374.0 262.0,374.0 260.0,374.0 258.0,374.0 256.0,374.0 254.0,374.0 252.0,372.0 250.0,372.0 248.0,372.0 246.0,372.0 244.0,372.0 242.0,372.0 240.0,372.0 238.0,372.0 236.0,372.0 234.0,372.0 232.0,372.0 230.0,372.0 228.0,370.0 226.0,370.0 224.0,370.0 222.0,370.0 220.0,370.0 218.0,370.0 216.0,370.0 214.0,370.0 212.0,370.0 210.0,370.0 208.0,370.0 206.0,370.0 204.0,370.0 202.0,370.0 200.0,370.0 198.0,370.0 196.0,370.0 194.0,370.0 192.0,370.0 190.0,370.0 188.0,368.0 186.0,370.0 184.0,368.0 182.0,370.0 180.0,370.0 178.0,368.0 176.0,368.0 174.0,368.0 172.0,368.0 170.0,368.0 168.0,368.0 166.0,368.0 164.0,368.0 162.0,368.0 160.0,368.0 158.0,368.0 156.0,368.0 154.0,368.0 152.0,368.0 150.0,368.0 148.0,368.0 146.0,368.0 144.0,368.0 142.0,368.0 140.0,368.0 138.0,368.0 136.0,368.0 134.0,368.0 132.0,368.0 130.0,368.0 128.0,366.0 126.0,368.0 124.0,368.0 122.0,366.0 120.0,366.0 118.0,366.0 116.0,366.0 114.0,366.0 112.0,368.0 110.0,368.0 108.0,368.0 106.0,368.0 104.0,368.0 102.0,368.0 100.0,366.0 98.0,366.0 96.0,364.0 94.0,362.0 92.0,360.0 92.0,358.0 92.0,356.0 90.0,354.0 90.0,352.0 90.0,350.0 90.0,348.0 90.0,346.0 90.0,344.0 90.0,342.0 90.0,340.0 90.0,338.0 90.0,336.0 90.0,334.0 90.0,332.0 90.0,330.0 90.0,328.0 90.0,326.0 90.0,324.0 90.0,322.0 90.0,320.0 90.0,318.0 90.0,316.0 90.0,314.0 88.0,312.0 86.0,310.0 84.0,310.0 82.0,308.0 80.0,308.0 78.0,306.0 76.0,306.0 74.0,306.0 72.0,306.0 70.0,306.0 68.0,306.0 66.0,308.0 64.0,308.0 62.0,308.0 60.0,310.0 58.0,310.0 56.0,312.0 54.0,312.0 52.0,312.0 50.0,312.0 48.0,314.0 46.0,314.0 44.0,314.0 42.0,316.0 40.0,316.0 38.0,318.0 36.0,318.0 34.0,320.0 32.0,322.0 32.0,324.0 30.0,326.0 30.0,328.0 30.0,330.0 28.0,332.0 28.0,334.0 28.0,336.0 28.0,338.0 26.0,340.0 26.0,342.0 26.0,344.0 24.0,346.0 24.0,348.0 22.0,350.0 20.0,352.0 20.0,354.0 18.0,356.0 16.0,356.0 14.0,358.0 12.0,360.0 10.0,360.0 8.0,360.0 6.0,362.0 4.0,360.0 2.0,360.0 0.0,358.0 0.0,356.0 0.0,354.0 0.0,352.0 0.0,350.0 0.0,348.0 0.0,346.0 0.0,344.0 0.0,342.0 0.0,340.0 0.0,338.0 0.0,336.0 0.0,334.0 0.0,332.0 0.0,330.0 0.0,328.0 0.0,326.0 0.0,324.0 0.0,322.0 0.0,320.0 0.0,318.0 2.0,316.0 2.0,314.0 2.0,312.0 2.0,310.0 2.0,308.0 4.0,306.0 4.0,304.0 4.0,302.0 4.0,300.0 6.0,298.0 6.0,296.0 6.0,294.0 8.0,292.0 8.0,290.0 10.0,288.0 10.0,286.0 12.0,284.0 14.0,282.0 16.0,282.0 18.0,280.0 20.0,278.0 22.0,276.0 24.0,276.0 26.0,274.0 28.0,272.0 30.0,270.0 32.0,268.0 34.0,266.0 36.0,264.0 38.0,262.0 40.0,260.0 42.0,258.0 44.0,256.0 44.0,254.0 46.0,252.0 48.0,250.0 50.0,248.0 50.0,246.0 52.0,244.0 54.0,242.0 56.0,240.0 56.0,238.0 58.0,236.0 58.0,234.0 60.0,232.0 62.0,230.0 62.0,228.0 64.0,226.0 66.0,224.0 68.0,222.0 70.0,220.0 72.0,218.0 74.0,216.0 76.0,216.0 78.0,214.0 80.0,214.0 82.0,214.0 84.0,216.0 86.0,216.0 88.0,218.0 90.0,218.0 92.0,220.0 94.0,222.0 96.0,222.0 98.0,224.0 100.0,226.0 102.0,226.0 104.0,228.0 106.0,230.0 108.0,230.0 110.0,230.0 112.0,232.0 114.0,232.0 116.0,232.0 118.0,232.0 120.0,232.0 122.0,232.0 124.0,232.0 126.0,232.0 128.0,234.0 130.0,234.0 132.0,234.0 134.0,234.0 136.0,234.0 138.0,234.0 140.0,234.0 142.0,234.0 144.0,234.0 146.0,234.0 148.0,236.0 150.0,236.0 152.0,236.0 154.0,236.0 156.0,236.0 158.0,236.0 160.0,236.0 162.0,238.0 164.0,238.0 166.0,238.0 168.0,238.0 170.0,238.0 172.0,238.0 174.0,238.0 176.0,240.0 178.0,240.0 180.0,240.0 182.0,240.0 184.0,240.0 186.0,240.0 188.0,242.0 190.0,242.0 192.0,242.0 194.0,242.0 196.0,242.0 198.0,242.0 200.0,242.0 202.0,242.0 204.0,242.0 206.0,242.0 208.0,242.0 210.0,242.0 212.0,242.0 214.0,242.0 216.0,242.0 218.0,242.0 220.0,242.0 222.0,242.0 224.0,242.0 226.0,242.0 228.0,242.0 230.0,242.0 232.0,242.0 234.0,242.0 236.0,242.0 238.0,242.0 240.0,242.0 242.0,242.0 244.0,242.0 246.0,242.0 248.0,242.0 250.0,242.0 252.0,242.0 254.0,242.0 256.0,240.0 258.0,240.0 260.0,240.0 262.0,238.0 264.0,236.0 264.0,234.0 266.0,232.0 266.0,230.0 264.0,228.0 264.0,226.0 264.0,224.0 262.0,222.0 262.0,220.0 260.0,218.0 260.0,216.0 258.0,214.0 256.0,212.0 256.0,210.0 254.0,208.0 252.0,206.0 252.0,204.0 250.0,202.0 248.0,200.0 248.0,198.0 246.0,196.0 244.0,194.0 244.0,192.0 242.0,190.0 240.0,188.0 240.0,186.0 238.0,184.0 236.0,182.0 236.0,180.0 234.0,178.0 232.0,176.0 232.0,174.0 230.0,172.0 230.0,170.0 228.0,168.0 226.0,166.0 226.0,164.0 224.0,162.0 224.0,160.0 222.0,158.0 222.0,156.0 220.0,154.0 220.0,152.0 218.0,150.0 218.0,148.0 216.0,146.0 216.0,144.0 214.0,142.0 214.0,140.0 212.0,138.0 212.0,136.0 212.0,134.0 210.0,132.0 210.0,130.0 210.0,128.0 210.0,126.0 210.0,124.0 210.0,122.0 208.0,120.0 208.0,118.0 208.0,116.0 208.0,114.0 208.0,112.0 208.0,110.0 208.0,108.0 208.0,106.0 208.0,104.0 208.0,102.0 208.0,100.0 208.0,98.0 210.0,96.0 210.0,94.0 210.0,92.0 210.0,90.0 210.0,88.0 212.0,86.0 212.0,84.0 212.0,82.0 212.0,80.0 214.0,78.0 214.0,76.0 214.0,74.0 216.0,72.0 216.0,70.0 216.0,68.0 218.0,66.0 218.0,64.0 218.0,62.0 220.0,60.0 220.0,58.0 220.0,56.0 222.0,54.0 222.0,52.0 224.0,50.0 224.0,48.0 226.0,46.0 226.0,44.0 228.0,42.0 228.0,40.0 230.0,38.0 230.0,36.0 232.0,34.0 232.0,32.0 234.0,30.0 236.0,28.0 236.0,26.0 238.0,24.0 240.0,22.0 240.0,20.0 242.0,18.0 244.0,16.0 246.0,14.0 248.0,12.0 250.0,10.0 252.0,8.0 254.0,6.0 256.0,6.0 258.0,4.0 260.0,4.0 262.0,4.0 264.0,4.0 266.0,2.0 268.0,2.0 270.0,2.0 272.0,2.0 274.0,2.0 276.0,2.0 278.0,2.0 280.0,2.0 282.0,2.0"/>
                    </svg>
                    Shalat
                </a>
            </div>

            <!-- User Menu & Burger Button -->
            <div class="flex items-center space-x-2">
                @auth
                    <!-- Desktop User Dropdown -->
                    <div class="relative hidden md:block" x-data="{ userOpen: false, showLogoutModal: false }">
                        <button @click="userOpen = !userOpen" 
                                class="flex items-center space-x-2 px-3 py-2 rounded-lg text-white hover:bg-white/20 transition-all duration-200">
                            {{-- Avatar Image atau Initial --}}
                            <div class="w-8 h-8 rounded-full overflow-hidden ring-2 ring-white/30 flex-shrink-0">
                                @if(auth()->user()->avatar)
                                    <img src="{{ asset('storage/'.auth()->user()->avatar) }}" 
                                         alt="{{ auth()->user()->name }}"
                                         class="w-full h-full object-cover">
                                @else
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=14b8a6&color=fff&size=128" 
                                         alt="{{ auth()->user()->name }}"
                                         class="w-full h-full object-cover">
                                @endif
                            </div>
                            <span class="hidden lg:block font-medium">{{ auth()->user()->name }}</span>
                            <svg class="w-4 h-4 transition-transform" :class="{'rotate-180': userOpen}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <!-- Dropdown Menu -->
                        <div x-show="userOpen" 
                             @click.away="userOpen = false"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95"
                             class="absolute right-0 mt-2 w-48 rounded-lg shadow-xl bg-white overflow-hidden z-50"
                             style="display: none;">
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-3 text-gray-700 hover:bg-teal-50 transition-colors">
                                <svg class="w-5 h-5 inline-block mr-2 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Profile
                            </a>
                            <button @click="userOpen = false; showLogoutModal = true" 
                                    class="w-full text-left px-4 py-3 text-gray-700 hover:bg-teal-50 transition-colors border-t border-gray-100">
                                <svg class="w-5 h-5 inline-block mr-2 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                </svg>
                                Logout
                            </button>
                        </div>

                        {{-- Modal Konfirmasi Logout --}}
                        <div x-show="showLogoutModal"
                             x-transition:enter="transition ease-out duration-500"
                             x-transition:enter-start="opacity-0"
                             x-transition:enter-end="opacity-100"
                             x-transition:leave="transition ease-in duration-300"
                             x-transition:leave-start="opacity-100"
                             x-transition:leave-end="opacity-0"
                             class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm"
                             @click.self="showLogoutModal = false"
                             style="display: none;">

                            <div x-show="showLogoutModal"
                                 x-transition:enter="transition ease-out duration-500"
                                 x-transition:enter-start="opacity-0 scale-75 translate-y-8"
                                 x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                                 x-transition:leave="transition ease-in duration-300"
                                 x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                                 x-transition:leave-end="opacity-0 scale-90 translate-y-4"
                                 class="bg-white rounded-3xl shadow-2xl p-8 w-full max-w-sm text-center">

                                {{-- Icon Logout --}}
                                <div class="w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-6">
                                    <svg class="w-10 h-10 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                    </svg>
                                </div>

                                {{-- Title & Description --}}
                                <h4 class="text-xl font-bold text-gray-800 mb-2">Keluar dari Akun?</h4>
                                <p class="text-sm text-gray-500 mb-8">
                                    Kamu akan keluar dari sesi ini. Yakin ingin melanjutkan?
                                </p>

                                {{-- Buttons --}}
                                <div class="flex flex-col gap-3">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit"
                                                class="w-full px-6 py-3 bg-teal-500 hover:bg-teal-600 text-white font-semibold rounded-xl transition-colors shadow-md">
                                            Ya, Keluar
                                        </button>
                                    </form>
                                    <button type="button"
                                            @click="showLogoutModal = false"
                                            class="w-full px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-xl transition-colors">
                                        Batal
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="hidden md:flex items-center space-x-2">
                        <a href="{{ route('login') }}" class="px-4 py-2 rounded-lg text-white font-medium hover:bg-white/20 transition-all duration-200">
                            Login
                        </a>
                        <a href="{{ route('register') }}" class="px-4 py-2 rounded-lg bg-white text-teal-600 font-semibold hover:bg-white/90 transition-all duration-200 shadow-md">
                            Register
                        </a>
                    </div>
                @endauth

                <!-- Mobile Burger Menu -->
                <button @click="open = !open" class="md:hidden p-2 rounded-lg text-white hover:bg-white/20 transition-all duration-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Navigation Menu -->
        <div x-show="open" 
             @click.away="open = false"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 transform -translate-y-2"
             x-transition:enter-end="opacity-100 transform translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 transform translate-y-0"
             x-transition:leave-end="opacity-0 transform -translate-y-2"
             class="md:hidden py-3 space-y-1">
            
            <a href="{{ route('home') }}" 
               class="block px-3 py-2 rounded-lg text-white font-medium hover:bg-white/20 transition-all duration-200 {{ request()->routeIs('home') ? 'bg-white/30' : '' }}">
                <svg class="w-5 h-5 inline-block mr-2 -mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                Beranda
            </a>
            <a href="{{ route('quran.index') }}" 
               class="block px-3 py-2 rounded-lg text-white font-medium hover:bg-white/20 transition-all duration-200 {{ request()->routeIs('quran.*') ? 'bg-white/30' : '' }}">
                <svg class="w-5 h-5 inline-block mr-2 -mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
                Al-Quran
            </a>
            <a href="{{ route('asmaul-husna.index') }}" 
               class="block px-3 py-2 rounded-lg text-white font-medium hover:bg-white/20 transition-all duration-200 {{ request()->routeIs('asmaul-husna.*') ? 'bg-white/30' : '' }}">
                <svg class="w-5 h-5 inline-block mr-2 -mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <text x="2" y="18" font-family="Arial, sans-serif" font-size="14" font-weight="bold" fill="currentColor">99</text>
                </svg>
                Asmaul Husna
            </a>
            
            <!-- DOA PENDEK Mobile - Bulan & Bintang -->
            <a href="{{ route('doa-pendek.index') }}" 
               class="block px-3 py-2 rounded-lg text-white font-medium hover:bg-white/20 transition-all duration-200 {{ request()->routeIs('doa-pendek.*') ? 'bg-white/30' : '' }}">
                <svg class="w-5 h-5 inline-block mr-2 -mt-1" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M9 2 C5 3, 2 7, 2 12 C2 17, 5 21, 9 22 C6 21, 4 17, 4 12 C4 7, 6 3, 9 2 Z"/>
                    <path d="M16 6 L17 9 L20 10 L17 11 L16 14 L15 11 L12 10 L15 9 Z"/>
                </svg>
                Doa-doa
            </a>
            
            <!-- TASBIH Mobile (TIDAK DIUBAH) -->
            <a href="{{ route('tasbih.index') }}" 
               class="block px-3 py-2 rounded-lg text-white font-medium hover:bg-white/20 transition-all duration-200 {{ request()->routeIs('tasbih.*') ? 'bg-white/30' : '' }}">
                <svg class="w-5 h-5 inline-block mr-2 -mt-1" fill="currentColor" viewBox="0 0 24 24">
                    <circle cx="3" cy="12" r="2"/>
                    <circle cx="5.5" cy="8" r="2"/>
                    <circle cx="9" cy="5.5" r="2"/>
                    <circle cx="12" cy="3" r="2"/>
                    <circle cx="15" cy="5.5" r="2"/>
                    <circle cx="18.5" cy="8" r="2"/>
                    <circle cx="21" cy="12" r="2"/>
                    <circle cx="18.5" cy="16" r="2"/>
                    <circle cx="15" cy="18.5" r="2"/>
                    <circle cx="12" cy="21" r="2"/>
                    <circle cx="9" cy="18.5" r="2"/>
                    <circle cx="5.5" cy="16" r="2"/>
                    <rect x="11" y="21" width="2" height="3" rx="0.5"/>
                    <circle cx="12" cy="24.5" r="1"/>
                </svg>
                Tasbih Digital
            </a>
            
            <!-- KIBLAT Mobile - Masjid -->
            <a href="{{ route('qibla.index') }}" 
               class="block px-3 py-2 rounded-lg text-white font-medium hover:bg-white/20 transition-all duration-200 {{ request()->routeIs('qibla.*') ? 'bg-white/30' : '' }}">
                <svg class="w-5 h-5 inline-block mr-2 -mt-1" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M8 11 C8 11, 10 8, 12 8 C14 8, 16 11, 16 11 L16 18 L8 18 Z"/>
                    <path d="M12 5 C11.2 5, 10.5 5.7, 10.5 6.5 C10.5 7.3, 11.2 8, 12 8 C11.6 8, 11.3 7.5, 11.3 7 C11.3 6.5, 11.6 6.2, 12 6.2 Z"/>
                    <rect x="6" y="10" width="2" height="8"/>
                    <circle cx="7" cy="9" r="1"/>
                    <rect x="16" y="10" width="2" height="8"/>
                    <circle cx="17" cy="9" r="1"/>
                    <rect x="6" y="18" width="12" height="1"/>
                </svg>
                Arah Kiblat
            </a>
            
            <!-- SHALAT Mobile - Orang Sujud -->
            <a href="{{ route('prayer-tracking.index') }}" 
               class="block px-3 py-2 rounded-lg text-white font-medium hover:bg-white/20 transition-all duration-200 {{ request()->routeIs('prayer-tracking.*') ? 'bg-white/30' : '' }}">
                <svg class="w-5 h-5 inline-block mr-2 -mt-1" fill="currentColor" viewBox="0 0 24 24">
                    <circle cx="12" cy="5" r="2.5"/>
                    <path d="M12 7.5 C12 7.5, 11 10, 10 11 L8 12"/>
                    <path d="M12 7.5 C12 7.5, 13 10, 14 11 L16 12"/>
                    <path d="M10 11 L9 15"/>
                    <path d="M14 11 L15 15"/>
                    <ellipse cx="8" cy="13" rx="1.5" ry="1"/>
                    <ellipse cx="16" cy="13" rx="1.5" ry="1"/>
                    <rect x="6" y="16" width="12" height="1" rx="0.5" opacity="0.4"/>
                </svg>
                Tracking Shalat
            </a>

            @auth
                <div class="border-t border-white/20 pt-3 mt-3" x-data="{ showLogoutModalMobile: false }">
                    {{-- Avatar + Name di Mobile --}}
                    <div class="flex items-center gap-3 px-3 py-2 mb-2">
                        <div class="w-10 h-10 rounded-full overflow-hidden ring-2 ring-white/30 flex-shrink-0">
                            @if(auth()->user()->avatar)
                                <img src="{{ asset('storage/'.auth()->user()->avatar) }}" 
                                     alt="{{ auth()->user()->name }}"
                                     class="w-full h-full object-cover">
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=14b8a6&color=fff&size=128" 
                                     alt="{{ auth()->user()->name }}"
                                     class="w-full h-full object-cover">
                            @endif
                        </div>
                        <div class="text-white/90 text-sm font-medium">
                            {{ auth()->user()->name }}
                        </div>
                    </div>
                    
                    <a href="{{ route('profile.edit') }}" class="block px-3 py-2 rounded-lg text-white font-medium hover:bg-white/20 transition-all duration-200">
                        <svg class="w-5 h-5 inline-block mr-2 -mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Profile
                    </a>
                    <button @click="showLogoutModalMobile = true" 
                            class="w-full text-left px-3 py-2 rounded-lg text-white font-medium hover:bg-white/20 transition-all duration-200">
                        <svg class="w-5 h-5 inline-block mr-2 -mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        Logout
                    </button>

                    {{-- Modal Konfirmasi Logout Mobile --}}
                    <div x-show="showLogoutModalMobile"
                         x-transition:enter="transition ease-out duration-500"
                         x-transition:enter-start="opacity-0"
                         x-transition:enter-end="opacity-100"
                         x-transition:leave="transition ease-in duration-300"
                         x-transition:leave-start="opacity-100"
                         x-transition:leave-end="opacity-0"
                         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm"
                         @click.self="showLogoutModalMobile = false"
                         style="display: none;">

                        <div x-show="showLogoutModalMobile"
                             x-transition:enter="transition ease-out duration-500"
                             x-transition:enter-start="opacity-0 scale-75 translate-y-8"
                             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-300"
                             x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                             x-transition:leave-end="opacity-0 scale-90 translate-y-4"
                             class="bg-white rounded-3xl shadow-2xl p-8 w-full max-w-sm text-center">

                            {{-- Icon Logout --}}
                            <div class="w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-6">
                                <svg class="w-10 h-10 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                </svg>
                            </div>

                            {{-- Title & Description --}}
                            <h4 class="text-xl font-bold text-gray-800 mb-2">Keluar dari Akun?</h4>
                            <p class="text-sm text-gray-500 mb-8">
                                Kamu akan keluar dari sesi ini. Yakin ingin melanjutkan?
                            </p>

                            {{-- Buttons --}}
                            <div class="flex flex-col gap-3">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                            class="w-full px-6 py-3 bg-teal-500 hover:bg-teal-600 text-white font-semibold rounded-xl transition-colors shadow-md">
                                        Ya, Keluar
                                    </button>
                                </form>
                                <button type="button"
                                        @click="showLogoutModalMobile = false"
                                        class="w-full px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-xl transition-colors">
                                    Batal
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="border-t border-white/20 pt-3 mt-3 space-y-1">
                    <a href="{{ route('login') }}" class="block px-3 py-2 rounded-lg text-white font-medium hover:bg-white/20 transition-all duration-200">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="block px-3 py-2 rounded-lg bg-white text-teal-600 font-semibold hover:bg-white/90 transition-all duration-200">
                        Register
                    </a>
                </div>
            @endauth
        </div>
    </div>
</nav>

<style>
@media (max-width: 767px) {
    .navbar-title-mobile {
        font-size: 1.5rem;
        font-weight: 700;
        letter-spacing: 0.06em;

        /* Shimmer gradient text */
        background: linear-gradient(
            90deg,
            rgba(255,255,255,0.6) 0%,
            rgba(255,255,255,1)   30%,
            rgba(255,255,255,0.6) 50%,
            rgba(255,255,255,1)   70%,
            rgba(255,255,255,0.6) 100%
        );
        background-size: 200% auto;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;

        /* Fade + slide up saat pertama load */
        animation:
            navTitleEntrance 5s cubic-bezier(0.22, 1, 0.36, 1) both,
            navTitleShimmer  3s linear 1.2s infinite;

        /* Glow effect */
        filter: drop-shadow(0 0 8px rgba(255,255,255,0.4));
        white-space: nowrap;
    }

    /* Animasi 1: Fade + slide up */
    @keyframes navTitleEntrance {
        from {
            opacity: 0;
            transform: translateX(-50%) translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateX(-50%) translateY(0);
        }
    }

    /* Animasi 2: Shimmer berkelanjutan */
    @keyframes navTitleShimmer {
        0%   { background-position: 200% center; }
        100% { background-position: -200% center; }
    }
}
</style>