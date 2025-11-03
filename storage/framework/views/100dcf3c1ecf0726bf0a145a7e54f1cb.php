

<?php $__env->startSection('content'); ?>

<section class="relative bg-gradient-to-br from-emerald-50 via-white to-teal-50 py-20 lg:py-28 overflow-hidden">
    
    <div class="absolute top-0 right-0 w-96 h-96 bg-gradient-to-br from-emerald-300/20 to-emerald-500/10 rounded-full blur-3xl animate-blob"></div>
    <div class="absolute top-20 left-20 w-72 h-72 bg-gradient-to-br from-teal-300/20 to-teal-500/10 rounded-full blur-3xl animate-blob animation-delay-2000"></div>
    <div class="absolute bottom-20 right-1/4 w-80 h-80 bg-gradient-to-br from-emerald-400/10 to-teal-400/10 rounded-full blur-3xl animate-blob animation-delay-4000"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-4xl mx-auto" data-aos="fade-up">
            
            <div class="inline-flex items-center gap-2 px-5 py-2.5 bg-white/80 backdrop-blur-sm shadow-lg border border-emerald-100 text-emerald-700 rounded-full mb-6">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <span class="font-bold text-sm"><?php echo e($siteSettings['badge_gallery'] ?? 'GALERI KAMI'); ?></span>
            </div>

            
            <h1 class="text-5xl lg:text-6xl font-extrabold text-gray-900 mb-6 leading-tight pb-2">
                <span class="block"><?php echo e($siteSettings['gallery_title'] ?? 'Keindahan'); ?></span>
                <span class="block bg-gradient-to-r from-emerald-600 via-teal-600 to-emerald-700 bg-clip-text text-transparent leading-normal pb-1">Lingkungan Kami</span>
            </h1>

            
            <p class="text-xl text-gray-600 max-w-3xl mx-auto mb-8 leading-relaxed">
                <?php echo e($siteSettings['gallery_subtitle'] ?? 'Jelajahi foto-foto lingkungan, fasilitas, dan suasana komunitas di Bumi Asri Parahyangan.'); ?>

            </p>

            
        </div>
    </div>
</section>


<section class="py-16 lg:py-24 bg-white relative"
         x-data="{ loading: true, view: 'grid' }" 
         x-init="setTimeout(() => loading = false, 300)">
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <?php if($images->count() > 0): ?>
            
            <div class="mb-10 flex flex-col sm:flex-row items-center justify-between gap-4" data-aos="fade-up">
                <div class="flex items-center gap-3">
                    <div class="px-4 py-2 bg-emerald-50 border border-emerald-200 rounded-xl">
                        <span class="text-sm text-gray-600">Menampilkan</span>
                        <span class="font-bold text-emerald-600 ml-1"><?php echo e($images->count()); ?></span>
                        <span class="text-sm text-gray-600 mx-1">dari</span>
                        <span class="font-bold text-emerald-600"><?php echo e($images->total()); ?></span>
                        <span class="text-sm text-gray-600 ml-1">foto</span>
                    </div>
                </div>

                
                <div class="flex items-center gap-2 bg-gray-100 p-1.5 rounded-xl">
                    <button @click="view = 'grid'" 
                            :class="view === 'grid' ? 'bg-white shadow-md' : 'hover:bg-gray-200'"
                            class="px-4 py-2 rounded-lg transition-all flex items-center gap-2">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM13 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2h-2z"/>
                        </svg>
                        <span class="text-sm font-medium">Grid</span>
                    </button>
                    <button @click="view = 'masonry'" 
                            :class="view === 'masonry' ? 'bg-white shadow-md' : 'hover:bg-gray-200'"
                            class="px-4 py-2 rounded-lg transition-all flex items-center gap-2">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                        </svg>
                        <span class="text-sm font-medium">Masonry</span>
                    </button>
                </div>
            </div>

            
            <div x-show="loading" x-transition class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                <?php for($i = 0; $i < 12; $i++): ?>
                    <div class="bg-gray-200 rounded-2xl h-72 animate-pulse"></div>
                <?php endfor; ?>
            </div>

            
            <div x-show="!loading && view === 'grid'" 
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 transform scale-95"
                 x-transition:enter-end="opacity-100 transform scale-100"
                 class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                <?php
                    // Simply use all images from the paginator without limiting by caption
                    $filtered = (method_exists($images, 'getCollection') ? $images->getCollection() : collect($images));
                ?>
                <?php $__currentLoopData = $filtered; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        // Determine image URL
                        $publicFallback = asset('images/placeholder-square.svg');
                        $imgUrl = $publicFallback;
                        if (!empty($img->path)) {
                            $pubCandidate = public_path(ltrim($img->path, '/'));
                            if (file_exists($pubCandidate)) {
                                $imgUrl = asset(ltrim($img->path, '/'));
                            } else {
                                $basename = basename($img->path);
                                $samplePub = public_path('images/samples/' . $basename);
                                if (file_exists($samplePub)) {
                                    $imgUrl = asset('images/samples/' . $basename);
                                } else {
                                    $storedPath = storage_path('app/public/' . ltrim($img->path, '/'));
                                    if (file_exists($storedPath)) {
                                        $imgUrl = asset('storage/' . ltrim($img->path, '/'));
                                    }
                                }
                            }
                        }
                    ?>

                    
                    <div class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 overflow-hidden transform hover:-translate-y-2" 
                         data-aos="zoom-in" 
                         data-aos-delay="<?php echo e(($index % 8) * 50); ?>">
                        
                        
                        <div class="relative h-72 bg-gray-100 overflow-hidden">
                            <a href="<?php echo e($imgUrl); ?>" class="block w-full h-full glightbox" data-gallery="gallery" data-title="<?php echo e(e($img->caption)); ?>">
                                <img src="<?php echo e($imgUrl); ?>" 
                                     alt="<?php echo e($img->caption ?? 'Gallery Image'); ?>" 
                                     class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700" 
                                     loading="lazy">
                                
                                
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/0 to-black/0 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                
                                
                                <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300">
                                    <div class="w-16 h-16 bg-white/90 backdrop-blur-sm rounded-full flex items-center justify-center transform scale-0 group-hover:scale-100 transition-transform duration-300 shadow-2xl">
                                        <svg class="w-8 h-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/>
                                        </svg>
                                    </div>
                                </div>
                            </a>
                        </div>

                        
                        <?php if($img->caption): ?>
                        <div class="p-4 bg-white border-t border-gray-100">
                            <div class="flex items-start gap-2">
                        
                                <p class="text-sm font-medium text-gray-900 line-clamp-2"><?php echo e($img->caption); ?></p>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            
            <div x-show="!loading && view === 'masonry'" 
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 transform scale-95"
                 x-transition:enter-end="opacity-100 transform scale-100"
                 class="columns-1 sm:columns-2 lg:columns-3 xl:columns-4 gap-6 space-y-6">
                <?php $__currentLoopData = $filtered; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        // Determine image URL
                        $publicFallback = asset('images/placeholder-square.svg');
                        $imgUrl = $publicFallback;
                        if (!empty($img->path)) {
                            $pubCandidate = public_path(ltrim($img->path, '/'));
                            if (file_exists($pubCandidate)) {
                                $imgUrl = asset(ltrim($img->path, '/'));
                            } else {
                                $basename = basename($img->path);
                                $samplePub = public_path('images/samples/' . $basename);
                                if (file_exists($samplePub)) {
                                    $imgUrl = asset('images/samples/' . $basename);
                                } else {
                                    $storedPath = storage_path('app/public/' . ltrim($img->path, '/'));
                                    if (file_exists($storedPath)) {
                                        $imgUrl = asset('storage/' . ltrim($img->path, '/'));
                                    }
                                }
                            }
                        }
                    ?>

                    <div class="group relative break-inside-avoid bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 overflow-hidden mb-6" 
                         data-aos="fade-up" 
                         data-aos-delay="<?php echo e(($index % 8) * 50); ?>">
                        
                        <div class="relative overflow-hidden">
                            <a href="<?php echo e($imgUrl); ?>" class="block glightbox" data-gallery="gallery-masonry" data-title="<?php echo e(e($img->caption)); ?>">
                                <img src="<?php echo e($imgUrl); ?>" 
                                     alt="<?php echo e($img->caption ?? 'Gallery Image'); ?>" 
                                     class="w-full object-cover transform group-hover:scale-110 transition-transform duration-700" 
                                     loading="lazy">
                                
                                <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                
                                <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <div class="w-12 h-12 bg-white/90 backdrop-blur-sm rounded-full flex items-center justify-center transform scale-0 group-hover:scale-100 transition-transform duration-300">
                                        <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                        </svg>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <?php if($img->caption): ?>
                        <div class="p-3">
                            <p class="text-xs font-medium text-gray-700"><?php echo e($img->caption); ?></p>
                        </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            
            <?php if($images->hasPages()): ?>
            <div class="mt-16 space-y-6" data-aos="fade-up">
                
                <div class="flex items-center justify-center gap-2 text-sm font-medium">
                    <div class="px-4 py-2 bg-gradient-to-r from-emerald-50 to-teal-50 border border-emerald-200 rounded-full text-gray-700">
                        <span class="text-emerald-600 font-bold"><?php echo e($images->firstItem()); ?></span>
                        <span class="mx-1">-</span>
                        <span class="text-emerald-600 font-bold"><?php echo e($images->lastItem()); ?></span>
                        <span class="mx-2 text-gray-400">dari</span>
                        <span class="text-emerald-600 font-bold"><?php echo e($images->total()); ?></span>
                        <span class="ml-1">foto</span>
                    </div>
                </div>

                
                <div class="flex justify-center">
                    <?php echo e($images->links()); ?>

                </div>
            </div>
            <?php endif; ?>
        <?php else: ?>
            
            <div x-show="!loading" class="text-center py-24 bg-gradient-to-br from-gray-50 to-gray-100 rounded-3xl border-2 border-dashed border-gray-300" data-aos="fade-up">
                <div class="w-24 h-24 bg-gradient-to-br from-emerald-100 to-emerald-200 rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg">
                    <svg class="w-12 h-12 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-700 mb-3">Galeri Sedang Dipersiapkan</h3>
                <p class="text-gray-500 max-w-md mx-auto">Foto-foto terbaru akan segera ditambahkan untuk menampilkan keindahan dan fasilitas Bumi Asri Parahyangan.</p>
            </div>
        <?php endif; ?>
    </div>
</section>


<section class="py-20 bg-gradient-to-br from-emerald-600 via-emerald-500 to-teal-600 relative overflow-hidden">
    
    <div class="absolute inset-0 opacity-20">
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-white rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-white rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>
    </div>
    
    <div class="relative max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12" data-aos="fade-up">
            <h2 class="text-3xl lg:text-4xl font-bold text-white mb-3">Bumi Asri Parahyangan</h2>
            <p class="text-emerald-100 text-lg">Hunian Modern dengan Fasilitas Lengkap</p>
        </div>

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8" data-aos="fade-up" data-aos-delay="100">
            
            <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 text-center border border-white/20 hover:bg-white/20 transition-all duration-300 transform hover:-translate-y-1">
                <div class="text-4xl lg:text-5xl font-bold text-white mb-2"><?php echo e($images->total()); ?>+</div>
                <div class="text-emerald-50 font-medium">Foto Gallery</div>
            </div>

            
            <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 text-center border border-white/20 hover:bg-white/20 transition-all duration-300 transform hover:-translate-y-1" data-aos-delay="150">
                <div class="text-4xl lg:text-5xl font-bold text-white mb-2">15+</div>
                <div class="text-emerald-50 font-medium">Area Fasilitas</div>
            </div>

            
            <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 text-center border border-white/20 hover:bg-white/20 transition-all duration-300 transform hover:-translate-y-1" data-aos-delay="200">
                <div class="text-4xl lg:text-5xl font-bold text-white mb-2">5</div>
                <div class="text-emerald-50 font-medium">Tipe Hunian</div>
            </div>

            
            <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 text-center border border-white/20 hover:bg-white/20 transition-all duration-300 transform hover:-translate-y-1" data-aos-delay="250">
                <div class="text-4xl lg:text-5xl font-bold text-white mb-2">100+</div>
                <div class="text-emerald-50 font-medium">Keluarga</div>
            </div>
        </div>
    </div>
</section>

<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const hero = document.querySelector('.hero-rotator');
    if (!hero) return;
    let images = [];
    try { images = JSON.parse(hero.getAttribute('data-images') || '[]'); } catch(e) { images = []; }
    if (!images.length) return;
    const imgEl = hero.querySelector('.rotator-hero-img');
    if (!imgEl) return;

    let idx = 0;
    // Start at random image
    idx = Math.floor(Math.random() * images.length);
    imgEl.src = images[idx];

    function rotate() {
        let next = Math.floor(Math.random() * images.length);
        if (next === idx) next = (next + 1) % images.length;
        const pre = new Image();
        pre.src = images[next];
        pre.onload = function() {
            imgEl.style.transition = 'opacity 400ms';
            imgEl.style.opacity = '0';
            setTimeout(function() {
                imgEl.src = images[next];
                imgEl.style.opacity = '1';
                idx = next;
            }, 420);
        };
        pre.onerror = function() { idx = next; };
    }

    // Randomized interval to avoid synchronous swaps
    (function schedule() {
        const delay = 4000 + Math.floor(Math.random() * 5000);
        setTimeout(function() { rotate(); schedule(); }, delay);
    })();
});
</script>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Project\BumiAsriParahyangan\resources\views/landing/gallery.blade.php ENDPATH**/ ?>