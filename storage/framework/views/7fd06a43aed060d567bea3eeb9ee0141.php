<?php
    // $units may be a Collection or Paginator
    $loopIndex = 0;
?>
<?php $__empty_1 = true; $__currentLoopData = $units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <div data-aos="fade-up" data-aos-delay="<?php echo e(($loopIndex++ % 6) * 100); ?>">
        <?php if (isset($component)) { $__componentOriginal67f11107e09f72091137bdb0ec5c0aed = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal67f11107e09f72091137bdb0ec5c0aed = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.unit-card','data' => ['id' => $unit->id,'image' => $unit->image,'title' => $unit->title,'type' => $unit->type,'landArea' => $unit->land_area,'price' => $unit->price,'bedrooms' => $unit->bedrooms,'bathrooms' => $unit->bathrooms,'floorArea' => $unit->floor_area,'parking' => $unit->parking,'builtYear' => $unit->built_year]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('unit-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($unit->id),'image' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($unit->image),'title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($unit->title),'type' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($unit->type),'land_area' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($unit->land_area),'price' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($unit->price),'bedrooms' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($unit->bedrooms),'bathrooms' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($unit->bathrooms),'floor_area' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($unit->floor_area),'parking' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($unit->parking),'built_year' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($unit->built_year)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal67f11107e09f72091137bdb0ec5c0aed)): ?>
<?php $attributes = $__attributesOriginal67f11107e09f72091137bdb0ec5c0aed; ?>
<?php unset($__attributesOriginal67f11107e09f72091137bdb0ec5c0aed); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal67f11107e09f72091137bdb0ec5c0aed)): ?>
<?php $component = $__componentOriginal67f11107e09f72091137bdb0ec5c0aed; ?>
<?php unset($__componentOriginal67f11107e09f72091137bdb0ec5c0aed); ?>
<?php endif; ?>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <div class="col-span-full">
        <div class="text-center py-16 bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-700 rounded-2xl border-2 border-dashed border-gray-300 dark:border-gray-600">
            <div class="w-16 h-16 bg-gray-200 dark:bg-gray-600 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-gray-400 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
            </div>
            <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-2"><?php echo e($siteSettings['empty_units'] ?? 'Belum Ada Unit'); ?></h3>
            <p class="text-gray-500 dark:text-gray-400"><?php echo e($siteSettings['empty_units_desc'] ?? 'Belum ada unit yang tersedia saat ini. Silakan cek kembali nanti.'); ?></p>
        </div>
    </div>
<?php endif; ?>
<?php /**PATH D:\Project\BumiAsriParahyangan\resources\views/landing/_unit_cards.blade.php ENDPATH**/ ?>