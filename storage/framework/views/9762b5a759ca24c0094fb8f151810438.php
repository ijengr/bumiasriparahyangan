<nav x-data="{ open: false }" class="bg-white/95 backdrop-blur-sm border-b border-gray-200 sticky top-0 z-50 shadow-sm" role="navigation" aria-label="Main navigation">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- Logo -->
                <a href="<?php echo e(route('landing.index')); ?>" class="flex items-center space-x-3 group" aria-label="Home - <?php echo e($siteSettings['company_name'] ?? 'Bumi Asri'); ?>">
                    <?php if(!empty($siteSettings['company_logo'] ?? null)): ?>
                    <!-- Custom Logo Image -->
                    <div class="relative">
                        <div class="absolute -inset-1 bg-gradient-to-r from-emerald-600 to-teal-600 rounded-lg blur opacity-25 group-hover:opacity-50 transition duration-300" aria-hidden="true"></div>
                        <div class="relative bg-white rounded-lg p-1 shadow-lg border-2 border-emerald-100">
                            <img src="<?php echo e($siteSettings['company_logo']); ?>" alt="<?php echo e($siteSettings['company_name'] ?? 'Logo'); ?>" class="w-10 h-10 object-contain">
                        </div>
                    </div>
                    <?php else: ?>
                    <!-- Default Icon Logo -->
                    <div class="relative">
                        <div class="absolute -inset-1 bg-gradient-to-r from-emerald-600 to-teal-600 rounded-lg blur opacity-25 group-hover:opacity-50 transition duration-300" aria-hidden="true"></div>
                        <div class="relative bg-gradient-to-br from-emerald-600 to-teal-600 text-white rounded-lg p-2 shadow-lg">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                        </div>
                    </div>
                    <?php endif; ?>
                    <div class="flex flex-col">
                        <span class="text-lg font-bold bg-gradient-to-r from-emerald-700 to-teal-700 bg-clip-text text-transparent"><?php echo e($siteSettings['company_name'] ?? 'Bumi Asri'); ?></span>
                        <span class="text-xs text-gray-600 -mt-1"><?php echo e($siteSettings['company_tagline'] ?? 'Parahyangan'); ?></span>
                    </div>
                </a>

                <!-- Navigation Links (Desktop) -->
                <div class="hidden md:flex md:items-center md:space-x-1 md:ml-10">
                    <a href="<?php echo e(route('landing.index')); ?>" 
                       class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 <?php echo e(request()->routeIs('landing.index') ? 'bg-emerald-50 text-emerald-700 shadow-sm' : 'text-gray-600 hover:text-emerald-700 hover:bg-emerald-50/50'); ?>"
                       aria-current="<?php echo e(request()->routeIs('landing.index') ? 'page' : 'false'); ?>">
                        <div class="flex items-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                            <span>Beranda</span>
                        </div>
                    </a>

                    <a href="<?php echo e(route('landing.units')); ?>" 
                       class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 <?php echo e(request()->routeIs('landing.units') ? 'bg-emerald-50 text-emerald-700 shadow-sm' : 'text-gray-600 hover:text-emerald-700 hover:bg-emerald-50/50'); ?>"
                       aria-current="<?php echo e(request()->routeIs('landing.units') ? 'page' : 'false'); ?>">
                        <div class="flex items-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                            <span>Unit</span>
                        </div>
                    </a>

                    <a href="<?php echo e(route('landing.gallery')); ?>" 
                       class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 <?php echo e(request()->routeIs('landing.gallery') ? 'bg-emerald-50 text-emerald-700 shadow-sm' : 'text-gray-600 hover:text-emerald-700 hover:bg-emerald-50/50'); ?>">
                        <div class="flex items-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span>Galeri</span>
                        </div>
                    </a>

                    <a href="<?php echo e(route('landing.facilities')); ?>" 
                       class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 <?php echo e(request()->routeIs('landing.facilities') ? 'bg-emerald-50 text-emerald-700 shadow-sm' : 'text-gray-600 hover:text-emerald-700 hover:bg-emerald-50/50'); ?>">
                        <div class="flex items-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                            <span>Fasilitas</span>
                        </div>
                    </a>

                    <a href="<?php echo e(route('landing.contact')); ?>" 
                       class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 <?php echo e(request()->routeIs('landing.contact') ? 'bg-emerald-50 text-emerald-700 shadow-sm' : 'text-gray-600 hover:text-emerald-700 hover:bg-emerald-50/50'); ?>">
                        <div class="flex items-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <span>Kontak</span>
                        </div>
                    </a>

                    <a href="<?php echo e(route('landing.about')); ?>" 
                       class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 <?php echo e(request()->routeIs('landing.about') ? 'bg-emerald-50 text-emerald-700 shadow-sm' : 'text-gray-600 hover:text-emerald-700 hover:bg-emerald-50/50'); ?>">
                        <div class="flex items-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>Tentang Kami</span>
                        </div>
                    </a>
                </div>
            </div>

            <!-- CTA Button (Desktop) -->
            <div class="hidden md:flex md:items-center md:space-x-4">
                <a href="<?php echo e(route('landing.contact')); ?>" 
                   class="px-5 py-2 bg-gradient-to-r from-emerald-600 to-teal-600 text-white rounded-lg text-sm font-semibold shadow-md hover:shadow-lg hover:from-emerald-700 hover:to-teal-700 transform hover:-translate-y-0.5 transition-all duration-200"
                   aria-label="Contact us">
                    Hubungi Kami
                </a>
            </div>

            <!-- Mobile menu button -->
            <div class="flex items-center md:hidden">
                <button @click="open = !open" 
                        type="button" 
                        class="inline-flex items-center justify-center p-2 rounded-lg text-gray-600 hover:text-emerald-700 hover:bg-emerald-50 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-emerald-500 transition-colors"
                        aria-expanded="false"
                        :aria-expanded="open.toString()"
                        aria-controls="mobile-menu"
                        aria-label="Toggle navigation menu">
                    <span class="sr-only">Open main menu</span>
                    <svg class="h-6 w-6" :class="{'hidden': open, 'block': !open}" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg class="h-6 w-6" :class="{'block': open, 'hidden': !open}" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu -->
    <div x-show="open" 
         id="mobile-menu"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-1"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-1"
         class="md:hidden bg-white border-t border-gray-200 shadow-lg">
        <div class="px-4 pt-2 pb-3 space-y-1">
            <a href="<?php echo e(route('landing.index')); ?>" 
               class="flex items-center space-x-3 px-4 py-3 rounded-lg text-sm font-medium transition-colors <?php echo e(request()->routeIs('landing.index') ? 'bg-emerald-50 text-emerald-700' : 'text-gray-600 hover:bg-emerald-50/50 hover:text-emerald-700'); ?>">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                <span>Beranda</span>
            </a>

            <a href="<?php echo e(route('landing.units')); ?>" 
               class="flex items-center space-x-3 px-4 py-3 rounded-lg text-sm font-medium transition-colors <?php echo e(request()->routeIs('landing.units') ? 'bg-emerald-50 text-emerald-700' : 'text-gray-600 hover:bg-emerald-50/50 hover:text-emerald-700'); ?>">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
                <span>Unit</span>
            </a>

            <a href="<?php echo e(route('landing.gallery')); ?>" 
               class="flex items-center space-x-3 px-4 py-3 rounded-lg text-sm font-medium transition-colors <?php echo e(request()->routeIs('landing.gallery') ? 'bg-emerald-50 text-emerald-700' : 'text-gray-600 hover:bg-emerald-50/50 hover:text-emerald-700'); ?>">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <span>Galeri</span>
            </a>

            <a href="<?php echo e(route('landing.facilities')); ?>" 
               class="flex items-center space-x-3 px-4 py-3 rounded-lg text-sm font-medium transition-colors <?php echo e(request()->routeIs('landing.facilities') ? 'bg-emerald-50 text-emerald-700' : 'text-gray-600 hover:bg-emerald-50/50 hover:text-emerald-700'); ?>">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                </svg>
                <span>Fasilitas</span>
            </a>

            <a href="<?php echo e(route('landing.contact')); ?>" 
               class="flex items-center space-x-3 px-4 py-3 rounded-lg text-sm font-medium transition-colors <?php echo e(request()->routeIs('landing.contact') ? 'bg-emerald-50 text-emerald-700' : 'text-gray-600 hover:bg-emerald-50/50 hover:text-emerald-700'); ?>">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
                <span>Kontak</span>
            </a>

            <a href="<?php echo e(route('landing.about')); ?>" 
               class="flex items-center space-x-3 px-4 py-3 rounded-lg text-sm font-medium transition-colors <?php echo e(request()->routeIs('landing.about') ? 'bg-emerald-50 text-emerald-700' : 'text-gray-600 hover:bg-emerald-50/50 hover:text-emerald-700'); ?>">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>Tentang Kami</span>
            </a>
        </div>

        <div class="pt-4 pb-3 border-t border-gray-200">
            <div class="px-4 space-y-2">
              
                
                <a href="<?php echo e(route('landing.contact')); ?>" 
                   class="block px-4 py-2 text-center bg-gradient-to-r from-emerald-600 to-teal-600 text-white rounded-lg text-sm font-semibold shadow-md hover:shadow-lg hover:from-emerald-700 hover:to-teal-700 transition-all">
                    Hubungi Kami
                </a>
            </div>
        </div>
    </div>
</nav>
<?php /**PATH D:\Project\BumiAsriParahyangan\resources\views/layouts/landing-navigation.blade.php ENDPATH**/ ?>