{{-- Modern Navbar with Glassmorphism - Fixed Sticky --}}
<header class="fixed top-0 left-0 right-0 z-[9999] bg-white/95 backdrop-blur-xl border-b border-emerald-100/50 shadow-lg shadow-emerald-100/20 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">
            {{-- Logo/Brand --}}
            <a href="{{ route('landing.index') }}" class="group flex items-center gap-3">
                <div class="w-12 h-12 bg-gradient-to-br from-emerald-600 to-teal-600 rounded-2xl flex items-center justify-center shadow-lg transform group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                </div>
                <div class="flex flex-col">
                    <span class="text-xl font-extrabold bg-gradient-to-r from-emerald-700 to-teal-700 bg-clip-text text-transparent">Bumi Asri</span>
                    <span class="text-xs font-semibold text-gray-600 -mt-1">Parahyangan</span>
                </div>
            </a>

            {{-- Desktop Navigation --}}
            <nav class="hidden lg:flex items-center gap-1">
                <a href="{{ route('landing.index') }}" class="group relative px-5 py-2.5 text-gray-700 hover:text-emerald-700 font-semibold transition-colors duration-300 {{ request()->routeIs('landing.index') ? 'text-emerald-700' : '' }}">
                    <span class="relative z-10">Beranda</span>
                    <div class="absolute inset-0 bg-gradient-to-r from-emerald-50 to-teal-50 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300 {{ request()->routeIs('landing.index') ? 'opacity-100' : '' }}"></div>
                    @if(request()->routeIs('landing.index'))
                    <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-1/2 h-1 bg-gradient-to-r from-emerald-600 to-teal-600 rounded-full"></div>
                    @endif
                </a>
                
                <a href="{{ route('landing.about') }}" class="group relative px-5 py-2.5 text-gray-700 hover:text-emerald-700 font-semibold transition-colors duration-300 {{ request()->routeIs('landing.about') ? 'text-emerald-700' : '' }}">
                    <span class="relative z-10">Tentang</span>
                    <div class="absolute inset-0 bg-gradient-to-r from-emerald-50 to-teal-50 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300 {{ request()->routeIs('landing.about') ? 'opacity-100' : '' }}"></div>
                    @if(request()->routeIs('landing.about'))
                    <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-1/2 h-1 bg-gradient-to-r from-emerald-600 to-teal-600 rounded-full"></div>
                    @endif
                </a>
                
                <a href="{{ route('landing.facilities') }}" class="group relative px-5 py-2.5 text-gray-700 hover:text-emerald-700 font-semibold transition-colors duration-300 {{ request()->routeIs('landing.facilities') ? 'text-emerald-700' : '' }}">
                    <span class="relative z-10">Fasilitas</span>
                    <div class="absolute inset-0 bg-gradient-to-r from-emerald-50 to-teal-50 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300 {{ request()->routeIs('landing.facilities') ? 'opacity-100' : '' }}"></div>
                    @if(request()->routeIs('landing.facilities'))
                    <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-1/2 h-1 bg-gradient-to-r from-emerald-600 to-teal-600 rounded-full"></div>
                    @endif
                </a>
                
                <a href="{{ route('landing.units') }}" class="group relative px-5 py-2.5 text-gray-700 hover:text-emerald-700 font-semibold transition-colors duration-300 {{ request()->routeIs('landing.units*') ? 'text-emerald-700' : '' }}">
                    <span class="relative z-10">Unit</span>
                    <div class="absolute inset-0 bg-gradient-to-r from-emerald-50 to-teal-50 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300 {{ request()->routeIs('landing.units*') ? 'opacity-100' : '' }}"></div>
                    @if(request()->routeIs('landing.units*'))
                    <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-1/2 h-1 bg-gradient-to-r from-emerald-600 to-teal-600 rounded-full"></div>
                    @endif
                </a>
                
                <a href="{{ route('landing.gallery') }}" class="group relative px-5 py-2.5 text-gray-700 hover:text-emerald-700 font-semibold transition-colors duration-300 {{ request()->routeIs('landing.gallery') ? 'text-emerald-700' : '' }}">
                    <span class="relative z-10">Galeri</span>
                    <div class="absolute inset-0 bg-gradient-to-r from-emerald-50 to-teal-50 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300 {{ request()->routeIs('landing.gallery') ? 'opacity-100' : '' }}"></div>
                    @if(request()->routeIs('landing.gallery'))
                    <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-1/2 h-1 bg-gradient-to-r from-emerald-600 to-teal-600 rounded-full"></div>
                    @endif
                </a>
                
                <a href="{{ route('landing.contact') }}" class="group relative ml-2 px-6 py-3 bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-300 overflow-hidden">
                    <div class="absolute inset-0 bg-white/20 transform -skew-x-12 -translate-x-full group-hover:translate-x-full transition-transform duration-700"></div>
                    <span class="relative flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        Kontak
                    </span>
                </a>
            </nav>

            {{-- Mobile Menu Button --}}
            <button id="mobile-menu-btn" class="lg:hidden p-2.5 text-gray-700 hover:text-emerald-700 hover:bg-emerald-50 rounded-xl transition-all duration-300">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path class="menu-icon-open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16"/>
                    <path class="menu-icon-close hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>

    {{-- Mobile Navigation --}}
    <div id="mobile-menu" class="hidden lg:hidden border-t border-emerald-100 bg-white/95 backdrop-blur-xl">
        <nav class="max-w-7xl mx-auto px-4 py-6 space-y-2">
            <a href="{{ route('landing.index') }}" class="group flex items-center gap-3 px-4 py-3 text-gray-700 hover:text-emerald-700 font-semibold rounded-xl hover:bg-gradient-to-r hover:from-emerald-50 hover:to-teal-50 transition-all duration-300 {{ request()->routeIs('landing.index') ? 'text-emerald-700 bg-gradient-to-r from-emerald-50 to-teal-50' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Beranda
            </a>
            
            <a href="{{ route('landing.about') }}" class="group flex items-center gap-3 px-4 py-3 text-gray-700 hover:text-emerald-700 font-semibold rounded-xl hover:bg-gradient-to-r hover:from-emerald-50 hover:to-teal-50 transition-all duration-300 {{ request()->routeIs('landing.about') ? 'text-emerald-700 bg-gradient-to-r from-emerald-50 to-teal-50' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Tentang
            </a>
            
            <a href="{{ route('landing.facilities') }}" class="group flex items-center gap-3 px-4 py-3 text-gray-700 hover:text-emerald-700 font-semibold rounded-xl hover:bg-gradient-to-r hover:from-emerald-50 hover:to-teal-50 transition-all duration-300 {{ request()->routeIs('landing.facilities') ? 'text-emerald-700 bg-gradient-to-r from-emerald-50 to-teal-50' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
                Fasilitas
            </a>
            
            <a href="{{ route('landing.units') }}" class="group flex items-center gap-3 px-4 py-3 text-gray-700 hover:text-emerald-700 font-semibold rounded-xl hover:bg-gradient-to-r hover:from-emerald-50 hover:to-teal-50 transition-all duration-300 {{ request()->routeIs('landing.units*') ? 'text-emerald-700 bg-gradient-to-r from-emerald-50 to-teal-50' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                Unit
            </a>
            
            <a href="{{ route('landing.gallery') }}" class="group flex items-center gap-3 px-4 py-3 text-gray-700 hover:text-emerald-700 font-semibold rounded-xl hover:bg-gradient-to-r hover:from-emerald-50 hover:to-teal-50 transition-all duration-300 {{ request()->routeIs('landing.gallery') ? 'text-emerald-700 bg-gradient-to-r from-emerald-50 to-teal-50' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                Galeri
            </a>
            
            <a href="{{ route('landing.contact') }}" class="group flex items-center justify-center gap-2 px-4 py-4 mt-4 bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-300">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                Hubungi Kami
            </a>
        </nav>
    </div>
</header>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    const menuIconOpen = document.querySelector('.menu-icon-open');
    const menuIconClose = document.querySelector('.menu-icon-close');
    
    if (mobileMenuBtn && mobileMenu) {
        mobileMenuBtn.addEventListener('click', function() {
            const isHidden = mobileMenu.classList.contains('hidden');
            
            if (isHidden) {
                mobileMenu.classList.remove('hidden');
                menuIconOpen.classList.add('hidden');
                menuIconClose.classList.remove('hidden');
            } else {
                mobileMenu.classList.add('hidden');
                menuIconOpen.classList.remove('hidden');
                menuIconClose.classList.add('hidden');
            }
        });
        
        // Close mobile menu when clicking outside
        document.addEventListener('click', function(event) {
            const isClickInside = mobileMenuBtn.contains(event.target) || mobileMenu.contains(event.target);
            
            if (!isClickInside && !mobileMenu.classList.contains('hidden')) {
                mobileMenu.classList.add('hidden');
                menuIconOpen.classList.remove('hidden');
                menuIconClose.classList.add('hidden');
            }
        });
    }
});
</script>
@endpush
