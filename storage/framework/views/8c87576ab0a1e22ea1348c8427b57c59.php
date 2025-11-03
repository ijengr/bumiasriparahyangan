<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>Admin - Bumi Asri Parahyangan</title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <!-- GLightbox is bundled via Vite (imported in resources/js/app.js) -->
    <style>
        /* Simple tooltip for collapsed sidebar */
        .sidebar-tooltip{position:relative}
        aside#admin-sidebar:not(.collapsed) .sidebar-tooltip[data-title]:hover::after{display:none !important}
        aside#admin-sidebar.collapsed .sidebar-tooltip[data-title]:hover::after{content:attr(data-title);position:absolute;left:100%;top:50%;transform:translateY(-50%);background:#111827;color:white;padding:6px 8px;border-radius:6px;white-space:nowrap;margin-left:8px;font-size:12px;z-index:9999}
        /* Scoped dark-mode overrides for smoother, elegant dark theme within admin */
        .dark #admin-root {
            --bg-dark: #0b1220; /* page background */
            --panel-dark: #0f1724; /* cards / panels */
            --muted-text: #cbd5e1; /* muted readable text */
            --border-dark: #263242; /* subtle border */
            --emerald-accent: #0ea37a; /* slightly brighter emerald */
        }
    /* apply subtle dark backgrounds and readable text on common utility classes (scoped to admin) */
    .dark #admin-root { background-color: var(--bg-dark) !important; color: var(--muted-text) !important; }
    /* panels / cards */
    .dark #admin-root .bg-white, .dark #admin-root .rounded-lg.bg-white { background-color: var(--panel-dark) !important; color: var(--muted-text) !important; }
    /* page sections */
    .dark #admin-root .bg-gray-50, .dark #admin-root .from-emerald-50 { background-color: #07111a !important; }
    /* header / modal content */
    .dark #admin-root header, .dark #admin-root .dialog-container, .dark #admin-root .modal-content, .dark #admin-root .modal-panel { background-color: var(--panel-dark) !important; color: var(--muted-text) !important; }
    /* sidebar */
    .dark #admin-root aside#admin-sidebar { background-color: #064e3b !important; }
    .dark #admin-root .sidebar-label, .dark #admin-root .sidebar-tooltip { color: #e6f6ef !important; }
    /* borders */
    .dark #admin-root .border-gray-100, .dark #admin-root .border-gray-200, .dark #admin-root .border-gray-300, .dark #admin-root .border { border-color: var(--border-dark) !important; }
    /* text colors: primary and muted */
    .dark #admin-root .text-gray-800, .dark #admin-root .text-gray-900, .dark #admin-root .text-[#1b1b18] { color: var(--muted-text) !important; }
    .dark #admin-root .text-gray-700, .dark #admin-root .text-gray-600, .dark #admin-root .text-gray-500 { color: #94a3b8 !important; }
    /* emerald accents keep visibility */
    .dark #admin-root .text-emerald-600, .dark #admin-root .bg-emerald-600 { color: var(--emerald-accent) !important; background-color: transparent !important; }
    .dark #admin-root .bg-emerald-700 { background-color: #065f46 !important; }
    /* make table cards a bit lighter than page background for contrast */
    .dark #admin-root .card, .dark #admin-root .panel { background-color: #0f1724 !important; color: var(--muted-text) !important; }
    /* buttons and interactive controls */
    .dark #admin-root button, .dark #admin-root .btn, .dark #admin-root .inline-flex { color: var(--muted-text) !important; }
    /* primary/emerald buttons remain bright; neutral white buttons receive panel background */
    .dark #admin-root .bg-white button, .dark #admin-root .btn.bg-white, .dark #admin-root .bg-white { background-color: var(--panel-dark) !important; color: var(--muted-text) !important; border-color: var(--border-dark) !important; }
    /* ensure inputs/selects contrast */
    .dark #admin-root input, .dark #admin-root select, .dark #admin-root textarea { background-color: #07121b !important; color: var(--muted-text) !important; border-color: var(--border-dark) !important; }
    /* common interactive elements */
    .dark #admin-root .btn-primary, .dark #admin-root .btn-emerald, .dark #admin-root .bg-emerald-600 { background-color: #0f5132 !important; color: #e6f6ef !important; border-color: #064e3b !important; }
    .dark #admin-root .btn, .dark #admin-root .btn-secondary, .dark #admin-root .btn-outline { background-color: var(--panel-dark) !important; color: var(--muted-text) !important; border-color: var(--border-dark) !important; }
    .dark #admin-root .btn-danger, .dark #admin-root .bg-red-600 { background-color: #7f1d1d !important; color: #ffecec !important; }
    .dark #admin-root .btn:focus, .dark #admin-root .btn:active { box-shadow: 0 0 0 3px rgba(6,95,70,0.12) !important; }

    /* pagination */
    .dark #admin-root .pagination .page-link, .dark #admin-root .pagination a { background-color: transparent !important; color: var(--muted-text) !important; border-color: var(--border-dark) !important; }
    .dark #admin-root .pagination .active .page-link, .dark #admin-root .pagination .page-item.active .page-link { background-color: #064e3b !important; color: #e6f6ef !important; border-color: #064e3b !important; }

    /* table visuals */
    .dark #admin-root table.table, .dark #admin-root .table-responsive table { color: var(--muted-text) !important; }
    .dark #admin-root table.table thead th { background-color: transparent !important; color: #cbd5e1 !important; border-bottom-color: var(--border-dark) !important; }
    .dark #admin-root table.table tbody tr { background-color: transparent !important; }
    .dark #admin-root table.table tbody td { background-color: transparent !important; color: var(--muted-text) !important; border-color: var(--border-dark) !important; }
    .dark #admin-root table.table.table-striped tbody tr:nth-child(odd) { background-color: rgba(255,255,255,0.01) !important; }

    /* alerts, badges, toasts */
    .dark #admin-root .alert, .dark #admin-root .alert-dismissible { background-color: #0b1620 !important; color: var(--muted-text) !important; border-color: var(--border-dark) !important; }
    .dark #admin-root .badge { background-color: #082826 !important; color: #dff6ec !important; border: 1px solid var(--border-dark) !important; }
    .dark #admin-root .toast { background-color: #08121a !important; color: var(--muted-text) !important; border-color: var(--border-dark) !important; }

    /* dropdowns, popovers and tooltips */
    .dark #admin-root .dropdown-menu, .dark #admin-root .popover, .dark #admin-root .popover-body { background-color: var(--panel-dark) !important; color: var(--muted-text) !important; border-color: var(--border-dark) !important; }
    .dark #admin-root .dropdown-item { color: var(--muted-text) !important; }
    .dark #admin-root .dropdown-item:hover, .dark #admin-root .dropdown-item:focus { background-color: rgba(6,95,70,0.06) !important; }

    /* form labels/help */
    .dark #admin-root label, .dark #admin-root .form-label { color: #cbd5e1 !important; }
    .dark #admin-root .form-help, .dark #admin-root .text-help { color: #94a3b8 !important; }

    /* breadcrumb, nav */
    .dark #admin-root .breadcrumb, .dark #admin-root .nav { background-color: transparent !important; color: var(--muted-text) !important; }

    /* utilities used in unit rows */
    .dark #admin-root .bg-emerald-50, .dark #admin-root .bg-emerald-100 { background-color: rgba(6,95,70,0.06) !important; color: var(--emerald-accent) !important; }
    .dark #admin-root .text-emerald-700, .dark #admin-root .text-emerald-800 { color: var(--emerald-accent) !important; }
    .dark #admin-root .bg-red-50, .dark #admin-root .bg-red-100 { background-color: rgba(127,29,29,0.06) !important; color: #ffb4b4 !important; }
    .dark #admin-root a.edit-btn, .dark #admin-root .edit-btn { background-color: rgba(14,163,122,0.06) !important; color: var(--emerald-accent) !important; border: 1px solid rgba(14,163,122,0.12) !important; }
    .dark #admin-root form.confirm-delete button { background-color: rgba(127,29,29,0.04) !important; color: #ffb4b4 !important; border: 1px solid rgba(127,29,29,0.08) !important; }

    /* table row background corrections (override .bg-white / odd backgrounds) */
    .dark #admin-root tr.bg-white, .dark #admin-root tbody.bg-white, .dark #admin-root tr.odd\:bg-gray-50, .dark #admin-root .odd\:bg-gray-50 { background-color: transparent !important; }
    .dark #admin-root tbody.divide-y > tr { border-bottom-color: var(--border-dark) !important; }
    .dark #admin-root .title-popover-trigger { color: var(--muted-text) !important; }

    /* modal scrollbar styling for dark panels */
    .dark .admin-modal-root .modal-content::-webkit-scrollbar, .dark .bg-white::-webkit-scrollbar { width: 10px; }
    .dark .admin-modal-root .modal-content::-webkit-scrollbar-thumb, .dark .bg-white::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.06); border-radius: 8px; border: 2px solid transparent; background-clip: padding-box; }

    /* Heading and small text readability in admin content */
    .dark #admin-root h1, .dark #admin-root .text-3xl, .dark #admin-root .font-bold { color: var(--muted-text) !important; }
    .dark #admin-root p, .dark #admin-root .text-sm, .dark #admin-root .text-gray-600 { color: #94a3b8 !important; }

    /* Global modal/dialog overrides for elements appended to <body> (ensure visibility) */
    .dark .admin-modal-root .dialog-container, .dark .admin-modal-root .modal-panel, .dark .admin-modal-root .modal-content, .dark .bg-white { background-color: var(--panel-dark) !important; color: var(--muted-text) !important; border-color: var(--border-dark) !important; }
    .dark .admin-modal-root .modal-backdrop, .dark .admin-modal-root > .absolute.inset-0 { background-color: rgba(0,0,0,0.8) !important; }
    /* modal header border and close button styling in dark mode */
    .dark .admin-modal-root .dialog-container > .relative.border-b, .dark .admin-modal-root .dialog-container .border-b { border-bottom: 1px solid var(--border-dark) !important; }
    .dark .admin-modal-root .modal-close-top, .dark .modal-close-top {
        /* emerald close button in dark mode (explicit color because modal is appended to body) */
        background-color: #0ea37a !important; /* explicit emerald */
        color: #e6f6ef !important;
        border: 1px solid rgba(6,95,70,0.12) !important;
        box-shadow: 0 8px 22px rgba(6,95,70,0.12) !important;
        width: 36px !important; height: 36px !important; line-height:36px !important; display:inline-flex; align-items:center; justify-content:center; font-size:16px !important;
    /* position the button inside the header (not floating far above it) */
    top: 8px !important;
    right: 12px !important;
        transform: none !important;
        z-index: 80 !important;
        border-radius: 8px !important;
    }
    .dark .admin-modal-root .modal-close-top:hover, .dark .modal-close-top:hover { background-color: #06966a !important; color: #ffffff !important; }
    /* ensure close button sits above the header edge */
    .dark .admin-modal-root .modal-close-top { z-index: 80; }

    /* keep modal dialog containers clipped to prevent the close button drifting when content scrolls */
    .admin-modal-root .dialog-container, .admin-modal-root .modal-panel, .dialog-container { overflow: hidden !important; }
    .admin-modal-root .dialog-container .modal-close-top, .dialog-container .modal-close-top { position: absolute !important; }

    /* Light-mode: ensure modal close button sits inside header (restore default look) */
    :not(.dark) .admin-modal-root .modal-close-top,
    :not(.dark) .modal-close-top {
        top: 12px !important;
        right: 12px !important;
        width: 36px !important;
        height: 36px !important;
        line-height: 36px !important;
        background-color: #ef4444 !important; /* keep red close in light mode */
        color: #fff !important;
        border: none !important;
        box-shadow: 0 2px 6px rgba(0,0,0,0.08) !important;
        z-index: 70 !important;
    }

    /* Light-mode: ensure dialog header border is subtle and not producing a long visible white line when button sits near it */
    :not(.dark) .admin-modal-root .dialog-container > .relative.border-b,
    :not(.dark) .dialog-container > .relative.border-b,
    :not(.dark) .admin-modal-root .dialog-container .border-b,
    :not(.dark) .dialog-container .border-b { border-bottom: 1px solid rgba(0,0,0,0.06) !important; }

    /* ensure confirm dialog ok/cancel buttons are visible when appended to body */
    .dark .confirm-ok, .dark .confirm-cancel, .dark .confirm-ok.btn, .dark .confirm-cancel.btn { background-color: rgba(6,95,70,0.08) !important; color: var(--muted-text) !important; border: 1px solid var(--border-dark) !important; }

    /* modal footers and headers */
    .dark #admin-root .modal-footer, .dark #admin-root .modal-header { border-top-color: var(--border-dark) !important; }

    /* small interactive utilities */
    .dark #admin-root .chip, .dark #admin-root .pill { background-color: rgba(255,255,255,0.02) !important; color: var(--muted-text) !important; border: 1px solid var(--border-dark) !important; }
        /* neutralize Tailwind gradients in dark mode for admin */
        .dark #admin-root [class*="bg-gradient-to-"], .dark #admin-root .bg-gradient-to-r { background-image: none !important; }
        /* target common gradient color stops used in admin header/toolbars */
        .dark #admin-root .from-gray-50, .dark #admin-root .to-gray-100, .dark #admin-root .to-white, .dark #admin-root .from-emerald-50 { background-image: none !important; background-color: var(--panel-dark) !important; }
        /* also apply a general fallback for components appended to body outside #admin-root (dialogs, confirms) */
        .dark .bg-white, .dark .rounded-lg.bg-white { background-color: var(--panel-dark) !important; color: var(--muted-text) !important; border-color: var(--border-dark) !important; }
        .dark .bg-gradient-to-r, .dark [class*="bg-gradient-to-"] { background-image: none !important; }
        /* Responsive adjustments */
    /* Collapsed sidebar visual: center icons, hide labels, remove stacked squares */
    aside#admin-sidebar.collapsed { width: 72px !important; }
    aside#admin-sidebar.collapsed nav { padding-left: 0.5rem; padding-right: 0.5rem; }
    aside#admin-sidebar.collapsed nav a { justify-content: center; gap: 0; padding: 0.6rem; border-radius: 8px; }
    aside#admin-sidebar.collapsed nav a svg { margin: 0; }
    aside#admin-sidebar.collapsed .sidebar-label { display: none !important; }
    aside#admin-sidebar.collapsed .sidebar-tooltip { display: inline-block !important; }
    aside#admin-sidebar.collapsed .text-white { text-align: center; }
    aside#admin-sidebar.collapsed .rounded-lg { border-radius: 8px; }
    /* Hide the title in collapsed state so it doesn't wrap and push the toggle out of view */
    aside#admin-sidebar.collapsed .text-white.font-bold.text-lg { display: none !important; }
    /* Ensure the collapse toggle stays visible and clickable when collapsed */
    aside#admin-sidebar.collapsed #sidebar-collapse {
        position: absolute !important;
        right: 8px !important;
        top: 10px !important;
        width: 36px !important;
        height: 36px !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        background: rgba(255,255,255,0.06) !important;
        border-radius: 8px !important;
        z-index: 85 !important;
        color: #ffffff !important;
    }
    /* Slight hover emphasis for the toggle when collapsed */
    aside#admin-sidebar.collapsed #sidebar-collapse:hover { background: rgba(255,255,255,0.12) !important; }
        .table-responsive{overflow-x:auto;-webkit-overflow-scrolling:touch}
        .table-responsive table{min-width:720px}
        /* compact table styling on small screens */
        @media (max-width: 768px) {
            .max-w-7xl { padding-left: 0.75rem; padding-right: 0.75rem; }
            .table-responsive table td, .table-responsive table th { padding: 0.5rem 0.6rem; font-size: 13px; }
            .sidebar-label { display: none; }
            /* make action buttons smaller */
            .btn-sm{padding:.28rem .5rem;font-size:.78rem}
            /* hide less-important columns on mobile for units table */
            .table-responsive table thead th.col-land,
            .table-responsive table thead th.col-parking,
            .table-responsive table thead th.col-year { display: none !important; }
            /* fallback: hide body cells by column index if classes missing */
            .table-responsive table tbody td:nth-child(7), /* land */
            .table-responsive table tbody td:nth-child(10), /* parkir index may vary */
            .table-responsive table tbody td:nth-child(11)  /* tahun index may vary */ { display: none !important; }
        }
        /* Mobile sidebar overlay & behaviour */
        #admin-sidebar.mobile-open{position:fixed;left:0;top:0;bottom:0;width:260px;z-index:60;transform:none;box-shadow:0 10px 30px rgba(2,6,23,0.6)}
        .mobile-sidebar-backdrop{position:fixed;inset:0;background:rgba(0,0,0,0.4);z-index:55;display:none}
        .mobile-sidebar-backdrop.show{display:block}
        /* Prevent body scroll when mobile sidebar is open */
        .no-scroll, .no-scroll body { overflow: hidden !important; height: 100% !important; }
        /* make topbar sticky and compact on mobile */
        header { position: sticky; top: 0; z-index: 40; }
        @media (max-width: 768px) {
            header .max-w-7xl { padding-left: 0.5rem; padding-right: 0.5rem; }
            header .h-16 { height: 48px; }
            header .text-lg { font-size: 1rem; }
            header .gap-6 { gap: 0.5rem }
            #theme-toggle { padding: 0.35rem }
        }
    </style>
</head>
<body id="admin-root" class="min-h-screen bg-gray-50 dark:bg-[#0a0a0a] font-sans text-gray-800 dark:text-[#EDEDEC]">
    <div class="min-h-screen flex">
        
        <aside id="admin-sidebar" class="hidden md:flex flex-col w-64 bg-gradient-to-b from-emerald-700 to-emerald-800 dark:from-emerald-900 dark:to-emerald-950 text-white shadow-2xl transition-all duration-300">
            
            <div class="h-16 flex items-center px-5 border-b border-emerald-600/30 dark:border-emerald-700/50 bg-emerald-800/20 dark:bg-black/20">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-white/10 dark:bg-white/5 flex items-center justify-center backdrop-blur-sm">
                        <svg class="w-6 h-6 text-emerald-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                    </div>
                    <div class="sidebar-label">
                        <div class="text-white font-bold text-base">Bumi Asri</div>
                        <div class="text-emerald-200 text-xs">Parahyangan</div>
                    </div>
                </div>
                <button id="sidebar-collapse" title="Toggle sidebar" class="ms-auto ml-2 p-2 rounded-lg text-white/70 hover:text-white hover:bg-white/10 dark:hover:bg-white/5 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"/></svg>
                </button>
                <!-- mobile close button -->
                <button id="mobile-sidebar-close" class="ml-2 inline-flex items-center justify-center w-9 h-9 rounded-lg bg-white/10 text-white hover:bg-white/20 md:hidden transition-all" aria-label="Close sidebar" title="Close sidebar">✕</button>
            </div>

            
            <nav class="flex-1 p-3 space-y-1 overflow-y-auto">
                <a href="<?php echo e(route('admin.dashboard')); ?>" class="sidebar-tooltip flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/10 dark:hover:bg-white/5 transition-all group <?php echo e(request()->routeIs('admin.dashboard') ? 'bg-white/15 dark:bg-white/10 shadow-lg font-semibold' : 'text-white/90'); ?>" data-title="Dashboard">
                    <div class="w-5 h-5 flex items-center justify-center">
                        <svg class="w-5 h-5 text-emerald-100 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                    </div>
                    <span class="sidebar-label text-sm">Dashboard</span>
                </a>

                <a href="<?php echo e(route('admin.units.index')); ?>" class="sidebar-tooltip flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/10 dark:hover:bg-white/5 transition-all group <?php echo e(request()->routeIs('admin.units.*') ? 'bg-white/15 dark:bg-white/10 shadow-lg font-semibold' : 'text-white/90'); ?>" data-title="Units">
                    <div class="w-5 h-5 flex items-center justify-center">
                        <svg class="w-5 h-5 text-emerald-100 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <span class="sidebar-label text-sm">Units</span>
                </a>

                <a href="<?php echo e(route('admin.facilities.index')); ?>" class="sidebar-tooltip flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/10 dark:hover:bg-white/5 transition-all group <?php echo e(request()->routeIs('admin.facilities.*') ? 'bg-white/15 dark:bg-white/10 shadow-lg font-semibold' : 'text-white/90'); ?>" data-title="Facilities">
                    <div class="w-5 h-5 flex items-center justify-center">
                        <svg class="w-5 h-5 text-emerald-100 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                    </div>
                    <span class="sidebar-label text-sm">Facilities</span>
                </a>

                <a href="<?php echo e(route('admin.gallery.index')); ?>" class="sidebar-tooltip flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/10 dark:hover:bg-white/5 transition-all group <?php echo e(request()->routeIs('admin.gallery.*') ? 'bg-white/15 dark:bg-white/10 shadow-lg font-semibold' : 'text-white/90'); ?>" data-title="Gallery">
                    <div class="w-5 h-5 flex items-center justify-center">
                        <svg class="w-5 h-5 text-emerald-100 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <span class="sidebar-label text-sm">Gallery</span>
                </a>

                <a href="<?php echo e(route('admin.messages.index')); ?>" class="sidebar-tooltip flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/10 dark:hover:bg-white/5 transition-all group <?php echo e(request()->routeIs('admin.messages.*') ? 'bg-white/15 dark:bg-white/10 shadow-lg font-semibold' : 'text-white/90'); ?>" data-title="Messages">
                    <div class="w-5 h-5 flex items-center justify-center">
                        <svg class="w-5 h-5 text-emerald-100 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <span class="sidebar-label text-sm">Messages</span>
                </a>

                <div class="my-3 border-t border-emerald-600/30 dark:border-emerald-700/50"></div>

                <a href="<?php echo e(route('admin.settings.index')); ?>" class="sidebar-tooltip flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/10 dark:hover:bg-white/5 transition-all group <?php echo e(request()->routeIs('admin.settings.*') ? 'bg-white/15 dark:bg-white/10 shadow-lg font-semibold' : 'text-white/90'); ?>" data-title="Settings">
                    <div class="w-5 h-5 flex items-center justify-center">
                        <svg class="w-5 h-5 text-emerald-100 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <span class="sidebar-label text-sm">Pengaturan</span>
                </a>
            </nav>

            
            <div class="p-4 border-t border-emerald-600/30 dark:border-emerald-700/50 bg-emerald-800/20 dark:bg-black/20">
                <div class="sidebar-label text-xs text-emerald-200/80 text-center">
                    © 2025 Bumi Asri Parahyangan
                </div>
            </div>
        </aside>

        <div class="flex-1 flex flex-col">
            
            <header class="sticky top-0 z-40 bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-800 shadow-sm backdrop-blur-md bg-white/95 dark:bg-gray-900/95">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex items-center justify-between h-16">
                        
                        <div class="flex items-center gap-4">
                            <button id="mobile-menu-toggle" class="md:hidden p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 text-gray-700 dark:text-gray-300 transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                            </button>
                            <div class="flex items-center gap-3">
                                <div class="hidden md:flex w-8 h-8 rounded-lg bg-gradient-to-br from-emerald-500 to-teal-600 items-center justify-center shadow-md">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-sm font-semibold text-gray-900 dark:text-gray-100"><?php echo $__env->yieldContent('page-title', 'Admin Panel'); ?></div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400 hidden sm:block">Bumi Asri Parahyangan</div>
                                </div>
                            </div>
                        </div>

                        
                        <div class="flex items-center gap-2">
                            
                            <button id="header-sidebar-toggle" class="hidden md:flex p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 text-gray-600 dark:text-gray-400 transition-colors" title="Toggle sidebar">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                            </button>

                            
                            <a href="<?php echo e(route('landing.index')); ?>" class="hidden sm:flex items-center gap-2 px-3 py-2 text-sm text-gray-600 dark:text-gray-400 hover:text-emerald-600 dark:hover:text-emerald-400 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                <span class="hidden lg:inline">Back to Site</span>
                            </a>

                            
                            <button id="theme-toggle" class="p-2.5 rounded-lg bg-gradient-to-br from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white shadow-md hover:shadow-lg transition-all" title="Toggle Dark Mode" aria-pressed="false">
                                <svg id="theme-icon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1M4.22 4.22l.7.7M18.36 18.36l.7.7M1 12h1m16 0h1M4.22 19.78l.7-.7M18.36 5.64l.7-.7"/>
                                </svg>
                            </button>

                            
                            <div class="relative">
                                <?php if (isset($component)) { $__componentOriginaldf8083d4a852c446488d8d384bbc7cbe = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldf8083d4a852c446488d8d384bbc7cbe = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dropdown','data' => ['align' => 'right','width' => '48']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dropdown'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['align' => 'right','width' => '48']); ?>
                                     <?php $__env->slot('trigger', null, []); ?> 
                                        <button class="inline-flex items-center gap-2 px-3 py-2 border border-gray-200 dark:border-gray-700 text-sm font-medium rounded-lg text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 transition-all">
                                            <?php if(Auth::user()->avatar): ?>
                                                <img src="<?php echo e(asset('storage/' . Auth::user()->avatar)); ?>" alt="<?php echo e(Auth::user()->name); ?>" class="w-7 h-7 rounded-full object-cover ring-2 ring-emerald-500/20">
                                            <?php else: ?>
                                                <div class="w-7 h-7 rounded-full bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center text-white text-xs font-bold">
                                                    <?php echo e(strtoupper(substr(Auth::user()->name, 0, 1))); ?>

                                                </div>
                                            <?php endif; ?>
                                            <span class="hidden sm:inline"><?php echo e(Auth::user()->name); ?></span>
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                     <?php $__env->endSlot(); ?>
                                     <?php $__env->slot('content', null, []); ?> 
                                        <!-- User Info Header -->
                                        <div class="px-4 py-3 border-b border-gray-100 dark:border-gray-700 bg-gradient-to-br from-emerald-50 to-teal-50 dark:from-emerald-900/20 dark:to-teal-900/20">
                                            <div class="flex items-center gap-3">
                                                <?php if(Auth::user()->avatar): ?>
                                                    <img src="<?php echo e(asset('storage/' . Auth::user()->avatar)); ?>" alt="<?php echo e(Auth::user()->name); ?>" class="w-10 h-10 rounded-full object-cover ring-2 ring-emerald-500/20">
                                                <?php else: ?>
                                                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center text-white font-bold ring-2 ring-emerald-500/20">
                                                        <?php echo e(strtoupper(substr(Auth::user()->name, 0, 1))); ?>

                                                    </div>
                                                <?php endif; ?>
                                                <div class="flex-1 min-w-0">
                                                    <p class="text-sm font-bold text-gray-900 dark:text-white truncate"><?php echo e(Auth::user()->name); ?></p>
                                                    <p class="text-xs text-gray-600 dark:text-gray-400 truncate"><?php echo e(Auth::user()->email); ?></p>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Menu Items -->
                                        <div class="py-1">
                                            <?php if (isset($component)) { $__componentOriginal68cb1971a2b92c9735f83359058f7108 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal68cb1971a2b92c9735f83359058f7108 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dropdown-link','data' => ['href' => route('admin.profile.edit')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dropdown-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('admin.profile.edit'))]); ?>
                                                <div class="flex items-center gap-3">
                                                    <div class="w-8 h-8 rounded-lg bg-emerald-100 dark:bg-emerald-900/30 flex items-center justify-center flex-shrink-0">
                                                        <svg class="w-4 h-4 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                        </svg>
                                                    </div>
                                                    <div>
                                                        <div class="text-sm font-semibold">Profil Saya</div>
                                                        <div class="text-xs text-gray-500 dark:text-gray-400">Kelola profil Anda</div>
                                                    </div>
                                                </div>
                                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal68cb1971a2b92c9735f83359058f7108)): ?>
<?php $attributes = $__attributesOriginal68cb1971a2b92c9735f83359058f7108; ?>
<?php unset($__attributesOriginal68cb1971a2b92c9735f83359058f7108); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal68cb1971a2b92c9735f83359058f7108)): ?>
<?php $component = $__componentOriginal68cb1971a2b92c9735f83359058f7108; ?>
<?php unset($__componentOriginal68cb1971a2b92c9735f83359058f7108); ?>
<?php endif; ?>
                                        </div>

                                        <!-- Logout Section -->
                                        <div class="border-t border-gray-100 dark:border-gray-700 py-1">
                                            <form method="POST" action="<?php echo e(route('logout')); ?>">
                                                <?php echo csrf_field(); ?>
                                                <?php if (isset($component)) { $__componentOriginal68cb1971a2b92c9735f83359058f7108 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal68cb1971a2b92c9735f83359058f7108 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dropdown-link','data' => ['href' => route('logout'),'onclick' => 'event.preventDefault(); this.closest(\'form\').submit();','class' => 'hover:bg-red-50 dark:hover:bg-red-900/20']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dropdown-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('logout')),'onclick' => 'event.preventDefault(); this.closest(\'form\').submit();','class' => 'hover:bg-red-50 dark:hover:bg-red-900/20']); ?>
                                                    <div class="flex items-center gap-3">
                                                        <div class="w-8 h-8 rounded-lg bg-red-100 dark:bg-red-900/30 flex items-center justify-center flex-shrink-0">
                                                            <svg class="w-4 h-4 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                                            </svg>
                                                        </div>
                                                        <div>
                                                            <div class="text-sm font-semibold text-red-600 dark:text-red-400">Keluar</div>
                                                            <div class="text-xs text-gray-500 dark:text-gray-400">Logout dari akun</div>
                                                        </div>
                                                    </div>
                                                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal68cb1971a2b92c9735f83359058f7108)): ?>
<?php $attributes = $__attributesOriginal68cb1971a2b92c9735f83359058f7108; ?>
<?php unset($__attributesOriginal68cb1971a2b92c9735f83359058f7108); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal68cb1971a2b92c9735f83359058f7108)): ?>
<?php $component = $__componentOriginal68cb1971a2b92c9735f83359058f7108; ?>
<?php unset($__componentOriginal68cb1971a2b92c9735f83359058f7108); ?>
<?php endif; ?>
                                            </form>
                                        </div>
                                     <?php $__env->endSlot(); ?>
                                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaldf8083d4a852c446488d8d384bbc7cbe)): ?>
<?php $attributes = $__attributesOriginaldf8083d4a852c446488d8d384bbc7cbe; ?>
<?php unset($__attributesOriginaldf8083d4a852c446488d8d384bbc7cbe); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldf8083d4a852c446488d8d384bbc7cbe)): ?>
<?php $component = $__componentOriginaldf8083d4a852c446488d8d384bbc7cbe; ?>
<?php unset($__componentOriginaldf8083d4a852c446488d8d384bbc7cbe); ?>
<?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <main class="p-6">
                <div class="max-w-7xl mx-auto">
                    
                    <div class="flex items-center justify-between mb-6">
                        <div class="text-sm text-gray-500"><?php echo $__env->yieldContent('breadcrumbs'); ?></div>
                        <div>
                            <?php echo $__env->yieldContent('page-actions'); ?>
                        </div>
                    </div>

                    <?php echo $__env->yieldContent('content'); ?>
                </div>
            </main>
        </div>
    </div>
    <script>
        // ensure an aria-live region exists for screen reader announcements
        (function(){
            if (!document.getElementById('sr-live')){
                const live = document.createElement('div');
                live.id = 'sr-live';
                live.setAttribute('aria-live','polite');
                live.setAttribute('aria-atomic','true');
                live.style.position = 'absolute';
                live.style.left = '-9999px';
                live.style.width = '1px';
                live.style.height = '1px';
                live.style.overflow = 'hidden';
                document.body.appendChild(live);
            }
        })();
        // Sidebar persist
        const sidebar = document.getElementById('admin-sidebar');
        const collapseBtn = document.getElementById('sidebar-collapse');
        const headerToggle = document.getElementById('header-sidebar-toggle');
        function setSidebarState(collapsed) {
            if (!sidebar) return;
            if (collapsed) {
                sidebar.classList.add('collapsed');
            } else {
                sidebar.classList.remove('collapsed');
            }
            localStorage.setItem('sidebarCollapsed', collapsed ? '1' : '0');
        }
        if (collapseBtn) collapseBtn.addEventListener('click', () => setSidebarState(localStorage.getItem('sidebarCollapsed') !== '1'));
        if (headerToggle) headerToggle.addEventListener('click', () => setSidebarState(localStorage.getItem('sidebarCollapsed') !== '1'));
        // initialize
        setTimeout(() => { setSidebarState(localStorage.getItem('sidebarCollapsed') === '1'); }, 100);

        // Theme toggle
        const themeToggle = document.getElementById('theme-toggle');
        const themeIcon = document.getElementById('theme-icon');
        function setTheme(dark) {
            try {
                if (dark) document.documentElement.classList.add('dark'); else document.documentElement.classList.remove('dark');
                localStorage.setItem('darkTheme', dark ? '1' : '0');
                // swap icon (simple)
                if (themeIcon) themeIcon.innerHTML = dark ? '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"/>' : '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1M4.22 4.22l.7.7M18.36 18.36l.7.7M1 12h1m16 0h1M4.22 19.78l.7-.7M18.36 5.64l.7-.7"/>';
                
            } catch (e) {  }
        }

        themeToggle?.addEventListener('click', () => {
            try {
                const currently = localStorage.getItem('darkTheme') === '1';
                const next = !currently;
                setTheme(next);
            } catch (e) {  }
        });

        // initialize theme: prefer saved setting, otherwise use system preference
        setTimeout(() => {
            try {
                const saved = localStorage.getItem('darkTheme');
                const prefers = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
                if (saved === '1' || saved === '0') setTheme(saved === '1'); else setTheme(prefers);
            } catch (e) {  }
        }, 100);

        // Mobile off-canvas toggling
        document.getElementById('mobile-menu-toggle')?.addEventListener('click', function () {
            const aside = document.getElementById('admin-sidebar');
            if (!aside) return;
            // open as overlay on small screens
            const backdropId = 'mobile-sidebar-backdrop';
            let backdrop = document.getElementById(backdropId);
            if (!backdrop) {
                backdrop = document.createElement('div');
                backdrop.id = backdropId;
                backdrop.className = 'mobile-sidebar-backdrop';
                document.body.appendChild(backdrop);
                backdrop.addEventListener('click', function(){
                    aside.classList.remove('mobile-open');
                    backdrop.classList.remove('show');
                    document.documentElement.classList.remove('no-scroll');
                    document.body.classList.remove('no-scroll');
                });
            }
            const isOpen = aside.classList.contains('mobile-open');
            if (!isOpen) {
                // opening
                aside.classList.add('mobile-open');
                aside.classList.remove('hidden');
                backdrop.classList.add('show');
                document.documentElement.classList.add('no-scroll');
                document.body.classList.add('no-scroll');
            } else {
                // closing
                aside.classList.remove('mobile-open');
                // re-hide on mobile
                aside.classList.add('hidden');
                backdrop.classList.remove('show');
                document.documentElement.classList.remove('no-scroll');
                document.body.classList.remove('no-scroll');
            }
            // wire close button (attach once)
            const closeBtn = document.getElementById('mobile-sidebar-close');
            if (closeBtn && !closeBtn._wired) {
                closeBtn.addEventListener('click', function(){ aside.classList.remove('mobile-open'); aside.classList.add('hidden'); backdrop.classList.remove('show'); document.documentElement.classList.remove('no-scroll'); document.body.classList.remove('no-scroll'); });
                closeBtn._wired = true;
            }
        });

        // Modal helper
        function openModal(html) {
            const modal = document.createElement('div');
            modal.className = 'admin-modal-root fixed inset-0 z-50 flex items-center justify-center';
            
            // Check dark mode
            const isDark = document.documentElement.classList.contains('dark');
            const bgClass = isDark ? 'bg-gray-800' : 'bg-white';
            const borderClass = isDark ? 'border-gray-700' : 'border-gray-200';
            
            modal.innerHTML = `
                <div class="modal-backdrop absolute inset-0 bg-black/60 dark:bg-black/80 opacity-0 transition-opacity duration-300"></div>
                <div class="modal-panel relative z-50 w-full h-full flex items-end md:items-center justify-center p-4">
                    <div class="dialog-container w-full md:w-11/12 lg:max-w-4xl ${bgClass} rounded-t-2xl md:rounded-2xl shadow-2xl overflow-hidden flex flex-col max-h-[90vh] transform transition-all duration-300 translate-y-6 opacity-0 md:scale-95 border ${borderClass}" role="dialog" aria-modal="true" tabindex="-1">
                        <div class="relative px-6 py-4 bg-gradient-to-r from-emerald-50 to-teal-50 dark:from-emerald-900/30 dark:to-teal-900/30 border-b ${borderClass}">
                            <button type="button" class="modal-close-top absolute top-3 right-3 inline-flex items-center justify-center w-10 h-10 rounded-lg bg-gradient-to-br from-emerald-600 to-teal-600 dark:from-emerald-500 dark:to-teal-500 text-white hover:from-emerald-700 hover:to-teal-700 dark:hover:from-emerald-600 dark:hover:to-teal-600 focus:outline-none focus:ring-2 focus:ring-emerald-400 dark:focus:ring-emerald-500 transition-all shadow-lg hover:shadow-xl transform hover:scale-105" aria-label="Close modal">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                            <h3 class="text-lg md:text-xl font-bold text-gray-900 dark:text-white pr-12">Form Data</h3>
                        </div>
                        <div class="modal-content overflow-auto p-6">${html}</div>
                    </div>
                </div>
            `;

            document.body.appendChild(modal);

            // focus trap and escape handling
            const panel = modal.querySelector('.modal-panel');
            const content = modal.querySelector('.modal-content');
            const closeBtn = modal.querySelector('.modal-close-top');

            // Force-close button color/appearance using inline styles so it shows correctly
            // even when the modal is appended to <body> and outside #admin-root scope.
            try {
                if (closeBtn) {
                    if (document.documentElement.classList.contains('dark')) {
                        closeBtn.style.setProperty('background-color', '#0ea37a', 'important');
                        closeBtn.style.setProperty('color', '#e6f6ef', 'important');
                        closeBtn.style.setProperty('border', '1px solid rgba(6,95,70,0.12)', 'important');
                        closeBtn.style.setProperty('box-shadow', '0 8px 22px rgba(6,95,70,0.12)', 'important');
                        closeBtn.style.setProperty('border-radius', '8px', 'important');
                        closeBtn.style.setProperty('top', '8px', 'important');
                    } else {
                        closeBtn.style.setProperty('background-color', '#ef4444', 'important');
                        closeBtn.style.setProperty('color', '#ffffff', 'important');
                        closeBtn.style.setProperty('border', 'none', 'important');
                        closeBtn.style.setProperty('box-shadow', '0 2px 6px rgba(0,0,0,0.08)', 'important');
                        closeBtn.style.setProperty('border-radius', '8px', 'important');
                        closeBtn.style.setProperty('top', '12px', 'important');
                    }
                    // simple hover feedback (inline since we can't rely on CSS cascade order here)
                    closeBtn.addEventListener('mouseover', function(){ this.style.filter = 'brightness(0.92)'; });
                    closeBtn.addEventListener('mouseout', function(){ this.style.filter = ''; });
                }
            } catch (e) { /* ignore style errors */ }

            // capture opener to restore focus later
            const opener = document.activeElement;

            // setup helpers for content (image preview, price formatting etc)
            try { setupModalFormHelpers(content); } catch(e){  }

            // Accessible focusable elements inside modal
            const focusableSelector = 'a[href], area[href], input:not([disabled]), select:not([disabled]), textarea:not([disabled]), button:not([disabled]), [tabindex]:not([tabindex="-1"])';
            let focusable = Array.from(content.querySelectorAll(focusableSelector));
            if (focusable.length === 0) {
                // if nothing focusable, make panel focusable
                panel.setAttribute('tabindex', '-1');
                focusable = [panel];
            }

            const firstFocusable = focusable[0];
            const lastFocusable = focusable[focusable.length - 1];

            function handleKeydown(e) {
                if (e.key === 'Escape') {
                    e.preventDefault();
                    closeModal();
                    return;
                }
                if (e.key === 'Tab') {
                    // handle tab cycling
                    if (e.shiftKey) { // backward
                        if (document.activeElement === firstFocusable) {
                            e.preventDefault();
                            lastFocusable.focus();
                        }
                    } else { // forward
                        if (document.activeElement === lastFocusable) {
                            e.preventDefault();
                            firstFocusable.focus();
                        }
                    }
                }
            }

            function closeModal(){
                // reverse animation then cleanup
                try {
                    const backdropEl = modal.querySelector('.modal-backdrop');
                    const dialogEl = modal.querySelector('.dialog-container');
                    // start reverse animation
                    if (backdropEl) backdropEl.classList.remove('opacity-100');
                    if (dialogEl) {
                        dialogEl.classList.add('translate-y-6','opacity-0','md:scale-95');
                    }
                    // small timeout to allow animation
                    setTimeout(()=>{
                        document.removeEventListener('keydown', handleKeydown);
                        closeBtn.removeEventListener('click', closeModal);
                        if (modal && modal.parentNode) modal.parentNode.removeChild(modal);
                        // restore focus to opener if possible
                        try { if (opener && opener.focus) opener.focus(); } catch (e) {}
                    }, 320);
                } catch (er) {
                    document.removeEventListener('keydown', handleKeydown);
                    closeBtn.removeEventListener('click', closeModal);
                    if (modal && modal.parentNode) modal.parentNode.removeChild(modal);
                }
            }

            // wire events
            document.addEventListener('keydown', handleKeydown);
            closeBtn.addEventListener('click', closeModal);

            // animate in: show backdrop and lift dialog
            const backdropEl = modal.querySelector('.modal-backdrop');
            const dialogEl = modal.querySelector('.dialog-container');
            // force a reflow then toggle classes
            requestAnimationFrame(() => {
                if (backdropEl) backdropEl.classList.add('opacity-100');
                if (dialogEl) {
                    dialogEl.classList.remove('translate-y-6','opacity-0');
                    dialogEl.classList.remove('md:scale-95');
                }
            });

            // set initial focus to the first focusable element or the dialog itself
            setTimeout(() => {
                try { (firstFocusable || panel).focus(); } catch (e) {}
            }, 120);

            return modal;
        }

        function setupModalFormHelpers(container){
            if (!container) return;
            // image preview wiring
            const imgInput = container.querySelector('#image-input');
            const preview = container.querySelector('#preview-image');
            if (imgInput && preview) {
                imgInput.addEventListener('change', function(e){
                    const f = this.files && this.files[0];
                    if (!f) return;
                    preview.src = URL.createObjectURL(f);
                });
                // clicking preview opens a fullscreen lightbox with zoom controls
                preview.style.cursor = 'zoom-in';
                const openPreviewHandler = function(e){
                    const src = preview.src;
                    if (!src) return;
                    openImageLightbox(src);
                };
                // use onclick to avoid stacking multiple listeners when modal re-opens
                preview.onclick = openPreviewHandler;
            }

            // price formatting wiring
            const price = container.querySelector('#price-input');
            if (price){
                function formatRupiah(v){
                    if (!v) return '';
                    const digits = v.toString().replace(/\D/g,'');
                    return digits.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                }
                price.addEventListener('input', function(){
                    try {
                        const pos = this.selectionStart;
                        const raw = this.value;
                        const formatted = formatRupiah(raw);
                        this.value = formatted;
                        this.selectionStart = this.selectionEnd = Math.max(0, this.value.length - (raw.length - pos));
                    } catch (err) { /* ignore */ }
                });
                const form = price.closest('form');
                if (form) {
                    form.addEventListener('submit', function(e){
                        // Prevent default form submit for modal forms; we will handle via AJAX
                        if (container && container.closest) {
                            e.preventDefault();
                            ajaxSubmitForm(this, container);
                        } else {
                            price.value = price.value.replace(/\D/g, '') || '';
                        }
                    });
                }
            }
        }

        // AJAX submit helper for modal forms
        async function ajaxSubmitForm(form, modalContainer){
            clearFormErrors(form);
            const url = form.getAttribute('action');
            const method = (form.querySelector('input[name=_method]')||{}).value || form.method || 'POST';
            const fd = new FormData(form);
            // ensure price is numeric
            const priceEl = form.querySelector('#price-input');
            if (priceEl) fd.set('price', priceEl.value.replace(/\D/g,''));

            // If method is PUT/PATCH/DELETE, send as POST and include _method override
            const methodUpper = (method || 'POST').toString().toUpperCase();
            let fetchMethod = methodUpper;
            if (['PUT','PATCH','DELETE'].includes(methodUpper)) {
                fetchMethod = 'POST';
                fd.set('_method', methodUpper);
            }

            try {
                const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                const res = await fetch(url, { method: fetchMethod, headers: { 'X-CSRF-TOKEN': token, 'X-Requested-With': 'XMLHttpRequest' }, body: fd });
                // Try to detect response type robustly
                let json = null;
                let text = null;
                const ct = (res.headers.get('content-type') || '').toLowerCase();
                if (ct.includes('application/json')) {
                    json = await res.json().catch(()=>null);
                } else {
                    // try to parse as json, otherwise treat as HTML/text
                    text = await res.text().catch(()=>null);
                    if (text) {
                        try { json = JSON.parse(text); } catch (e) { json = null; }
                    }
                }

                
                if (!res.ok) {
                    if (res.status === 422 && json && json.errors) {
                        showFormErrors(form, json.errors);
                        return;
                    }
                    // If server returned HTML with validation, try to surface it
                    if (res.status === 422 && text) {
                        // try to find validation errors rendered next to inputs and inject into the modal form
                        try {
                            const parser = new DOMParser();
                            const doc = parser.parseFromString(text, 'text/html');
                            const serverForm = doc.querySelector('form');
                            if (serverForm) {
                                // replace modal content with server-rendered form
                                const modalRoot = modalContainer.closest && modalContainer.closest('.admin-modal-root') ? modalContainer.closest('.admin-modal-root') : null;
                                if (modalRoot) {
                                    const content = modalRoot.querySelector('.modal-content');
                                    if (content) content.innerHTML = serverForm.outerHTML;
                                }
                            }
                        } catch (ee) { /* ignore */ }
                        return;
                    }
                    throw json || new Error('Server error');
                }

                // success: insert or update row
                
                if (json && json.row && json.unit) {
                    const parser = new DOMParser();
                    let doc = parser.parseFromString(json.row || '', 'text/html');
                    let newRow = doc.querySelector('tr');
                    // fallback: some fragments aren't picked by DOMParser; try temporary container
                    if (!newRow && json.row) {
                        try {
                            const temp = document.createElement('tbody');
                            temp.innerHTML = json.row;
                            newRow = temp.querySelector('tr');
                            
                        } catch (e) {  }
                    }
                    // try to find existing row by id or data-unit-id attribute
                    let existing = document.getElementById('unit-row-' + json.unit.id);
                    if (!existing) existing = document.querySelector('tr[data-unit-id="' + json.unit.id + '"]');
                    
                    if (newRow) {
                        // ensure newRow has identifying attributes so subsequent lookups work
                        if (!newRow.getAttribute('id')) newRow.setAttribute('id', 'unit-row-' + json.unit.id);
                        if (!newRow.getAttribute('data-unit-id')) newRow.setAttribute('data-unit-id', json.unit.id);

                        if (existing) {
                            existing.replaceWith(newRow);
                        } else {
                            const tbody = document.querySelector('table.min-w-full tbody');
                            // double-check no duplicate by id or data attribute
                            const maybeExisting = document.getElementById('unit-row-' + json.unit.id) || document.querySelector('tr[data-unit-id="' + json.unit.id + '"]');
                            if (maybeExisting) maybeExisting.replaceWith(newRow);
                            else if (tbody) {
                                // compute index: start + currentRows + 1
                                try {
                                    const table = document.querySelector('table.min-w-full');
                                    const start = parseInt(table.getAttribute('data-start') || '0', 10) || 0;
                                    const perPage = parseInt(table.getAttribute('data-per-page') || '12', 10) || 12;
                                    // new index is start + number of existing rows in tbody + 1
                                    const currentCount = tbody.querySelectorAll('tr').length;
                                    const newIndex = start + currentCount + 1;
                                    // update first cell in newRow if exists
                                    const firstCell = newRow.querySelector('td');
                                    if (firstCell) firstCell.textContent = newIndex;
                                } catch (e) { /* ignore */ }
                                tbody.prepend(newRow);
                            }
                        }
                    } else if (existing && json.unit) {
                        
                        // Fallback: update fields in place using known data points
                        try {
                            const titleEl = existing.querySelector('[data-unit-title]');
                            const descEl = existing.querySelector('[data-unit-desc]');
                            const thumbEl = existing.querySelector('[data-unit-thumb]');
                            const priceEl = existing.querySelector('[data-unit-price]');
                            if (titleEl) titleEl.textContent = json.unit.title || titleEl.textContent;
                            if (descEl) descEl.textContent = (json.unit.description || '').substring(0,60);
                            if (thumbEl) {
                                const imgSrc = json.unit.image ? (json.unit.image.startsWith('http') ? json.unit.image : ('/storage/' + json.unit.image)) : thumbEl.getAttribute('data-unit-thumb');
                                thumbEl.src = imgSrc;
                            }
                            if (priceEl) priceEl.textContent = 'Rp ' + (json.unit.price ? Number(json.unit.price).toLocaleString('id-ID') : '-');
                            
                        } catch (e) {  }
                    }
                } else if (json && Array.isArray(json.rows) && json.rows.length) {
                    // Generic handler for endpoints that return multiple rendered rows (e.g., gallery multi-upload)
                    try {
                        const parser = new DOMParser();
                        json.rows.forEach(html => {
                            try {
                                const doc = parser.parseFromString(html, 'text/html');
                                const tr = doc.querySelector('tr');
                                if (tr) {
                                    const tbody = document.querySelector('table.min-w-full tbody');
                                    if (tbody) {
                                        // ensure id/data attributes preserved
                                        tbody.prepend(tr);
                                    } else {
                                        // fallback: find any table tbody on page
                                        const anyTbody = document.querySelector('tbody');
                                        if (anyTbody) anyTbody.prepend(tr);
                                    }
                                } else {
                                    // not a table row - insert into .grid if present (gallery)
                                    const grid = document.querySelector('.grid');
                                    if (grid) {
                                        const wrapper = document.createElement('div');
                                        wrapper.className = 'group';
                                        wrapper.innerHTML = html;
                                        grid.prepend(wrapper);
                                    } else {
                                        // as a final fallback, append to modal container parent
                                        try { modalContainer.insertAdjacentHTML('afterend', html); } catch(e){}
                                    }
                                }
                            } catch (innerErr) {  }
                        });
                    } catch (e) {  }
                } else if (json && Array.isArray(json.items) && json.items.length) {
                    // If server returned items (model data) but no rendered rows, create simple gallery cards
                    try {
                        const grid = document.querySelector('.grid');
                        json.items.forEach(it => {
                            try {
                                const wrapper = document.createElement('div');
                                wrapper.className = 'group';
                                const imgSrc = it.path && it.path.startsWith('http') ? it.path : ('/storage/' + it.path);
                                const caption = it.caption || '';
                                wrapper.innerHTML = `
                                    <div class="card bg-white rounded overflow-hidden shadow-sm">
                                        <a href="${imgSrc}" class="glightbox">
                                            <img src="${imgSrc}" alt="${caption}" class="w-full h-44 object-cover">
                                        </a>
                                        <div class="p-2 text-sm text-gray-700">${caption}</div>
                                    </div>
                                `;
                                if (grid) grid.prepend(wrapper);
                            } catch (e) {  }
                        });
                    } catch (e) {  }
                } else if (!json && text) {
                    
                    // If server returned HTML (not JSON), try to extract a <tr> and use it
                    try {
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(text, 'text/html');
                        const newRow = doc.querySelector('tr');
                        if (newRow) {
                            const tbody = document.querySelector('table.min-w-full tbody');
                            const idAttr = newRow.getAttribute('id');
                            
                            if (idAttr) {
                                const existing = document.getElementById(idAttr);
                                if (existing) existing.replaceWith(newRow);
                                else if (tbody) tbody.prepend(newRow);
                            } else if (tbody) tbody.prepend(newRow);
                        }
                    } catch (e) { /* ignore */ }
                }

                // close modal with fade, prefer triggering the modal's top-close so its cleanup runs
                try {
                    const modalRoot = modalContainer && modalContainer.closest ? modalContainer.closest('.admin-modal-root') : null;
                    const topClose = modalRoot ? modalRoot.querySelector('.modal-close-top') : null;
                    if (topClose) topClose.click();
                    else if (modalRoot) fadeOutAndRemove(modalRoot);
                    else fadeOutAndRemove(modalContainer);
                } catch (e) {
                    fadeOutAndRemove(modalContainer);
                }
                showToast(json && json.message ? json.message : 'Sukses', 'success');
            } catch (err) {
                
                showToast('Gagal menyimpan data', 'error');
            }
        }

        function showFormErrors(form, errors){
            for (const key in errors) {
                const el = form.querySelector('[name="'+key+'"]');
                if (el) {
                    const wrap = document.createElement('div');
                    wrap.className = 'text-xs text-red-600 mt-1';
                    wrap.innerText = errors[key].join(' ');
                    el.insertAdjacentElement('afterend', wrap);
                }
            }
        }

        function clearFormErrors(form){
            form.querySelectorAll('.text-xs.text-red-600').forEach(e=>e.remove());
        }

        // Lightweight image lightbox with zoom and pan
        function openImageLightbox(src){
            const root = document.createElement('div');
            root.className = 'fixed inset-0 flex items-center justify-center bg-black/80';
            // inline style to ensure it's above modal z-index
            root.style.zIndex = 99999;
            root.style.cursor = 'zoom-out';
            root.innerHTML = `
                <div class="relative max-w-full max-h-full overflow-hidden">
                    <img src="${src}" alt="Preview" class="lightbox-img max-w-full max-h-[80vh] transform transition-transform duration-180" style="will-change:transform;">
                    <div class="absolute top-4 right-4 flex gap-2">
                        <button class="lb-zoom-in bg-white/90 rounded px-2 py-1">+</button>
                        <button class="lb-zoom-out bg-white/90 rounded px-2 py-1">-</button>
                        <button class="lb-close bg-white/90 rounded px-2 py-1">Close</button>
                    </div>
                </div>
            `;

            document.body.appendChild(root);
            // create a fresh Image node to avoid reusing the modal preview element
            const imgEl = new Image();
            imgEl.className = 'lightbox-img max-w-full max-h-[80vh] transform transition-transform duration-180';
            imgEl.style.willChange = 'transform';
            imgEl.src = src;
            const container = root.querySelector('div > .relative') || root.querySelector('div');
            // if container exists, replace its img placeholder
            const placeholder = root.querySelector('img.lightbox-img');
            if (placeholder) placeholder.replaceWith(imgEl);
            const img = imgEl;
            const zoomIn = root.querySelector('.lb-zoom-in');
            const zoomOut = root.querySelector('.lb-zoom-out');
            const closeBtn = root.querySelector('.lb-close');
            let scale = 1;
            let isPanning = false;
            let startX = 0, startY = 0, translateX = 0, translateY = 0;

            function updateTransform(){
                img.style.transform = `translate(${translateX}px, ${translateY}px) scale(${scale})`;
            }

            zoomIn.addEventListener('click', function(e){ e.stopPropagation(); scale = Math.min(4, scale + 0.25); updateTransform(); });
            zoomOut.addEventListener('click', function(e){ e.stopPropagation(); scale = Math.max(0.5, scale - 0.25); if (scale === 1){ translateX = translateY = 0; } updateTransform(); });
            closeBtn.addEventListener('click', function(e){ e.stopPropagation(); cleanup(); });

            root.addEventListener('mousedown', function(e){
                if (e.target === img) {
                    isPanning = true; startX = e.clientX - translateX; startY = e.clientY - translateY; root.style.cursor = 'grabbing';
                }
            });
            document.addEventListener('mousemove', function(e){
                if (!isPanning) return; translateX = e.clientX - startX; translateY = e.clientY - startY; updateTransform();
            });
            document.addEventListener('mouseup', function(){ if (isPanning) { isPanning = false; root.style.cursor = 'zoom-out'; } });

            // touch pan support
            root.addEventListener('touchstart', function(e){ if (e.touches && e.touches[0]) { const t=e.touches[0]; isPanning = true; startX = t.clientX - translateX; startY = t.clientY - translateY; } }, {passive:true});
            root.addEventListener('touchmove', function(e){ if (!isPanning) return; const t = e.touches[0]; translateX = t.clientX - startX; translateY = t.clientY - startY; updateTransform(); }, {passive:true});
            root.addEventListener('touchend', function(){ isPanning = false; });

            // double click / double tap toggle fit/100%
            let lastTap = 0;
            img.addEventListener('dblclick', function(e){ e.stopPropagation(); if (scale === 1) { scale = 2; } else { scale = 1; translateX = translateY = 0; } updateTransform(); });

            function onKey(e){
                if (e.key === 'Escape') { cleanup(); }
                if (e.key === 'ArrowUp') { e.preventDefault(); scale = Math.min(4, scale + 0.25); updateTransform(); }
                if (e.key === 'ArrowDown') { e.preventDefault(); scale = Math.max(0.5, scale - 0.25); if (scale === 1) { translateX = translateY = 0; } updateTransform(); }
                if (e.key === '0') { e.preventDefault(); scale = 1; translateX = translateY = 0; updateTransform(); }
            }

            root.addEventListener('click', function(){ cleanup(); });
            document.addEventListener('keydown', onKey);

            function cleanup(){
                try {
                    document.removeEventListener('keydown', onKey);
                    root.remove();
                } catch (e) {}
            }
        }

        // simple fade out and remove for modal container
        function fadeOutAndRemove(modalEl){
            if (!modalEl) return;
            modalEl.style.transition = 'opacity 240ms ease, transform 240ms ease';
            modalEl.style.opacity = '0';
            modalEl.style.transform = 'translateY(-8px)';
            setTimeout(()=> modalEl.remove(), 260);
        }

        // Bulk actions: delete multiple via AJAX (centralized handler - uses customConfirm)
        // helper: scheduleDelete supports undo within a timeout before sending server request
        function scheduleDelete({ ids, endpoint, previewItems = [], undoSeconds = 6 }){
            // remove UI immediately (optimistic) but keep a record to restore if undone
            const removedNodes = [];
            ids.forEach(id => {
                const cb = document.querySelector(`input[data-bulk][value="${id}"]`);
                if (!cb) return;
                const group = cb.closest('.group') || cb.closest('label') || cb.closest('div');
                if (group) { removedNodes.push({ id, node: group, parent: group.parentNode, next: group.nextSibling }); group.remove(); }
                else { removedNodes.push({ id, node: cb, parent: cb.parentNode, next: cb.nextSibling }); cb.remove(); }
            });

            let undone = false;
            const toastEl = document.createElement('div');
            toastEl.className = 'fixed bottom-6 right-6 z-50 px-4 py-2 rounded shadow-lg text-white';
            toastEl.style.background = '#f59e0b';
            toastEl.innerHTML = `${ids.length} item dihapus. <button class="undo-btn ml-3 underline">Undo</button>`;
            document.body.appendChild(toastEl);

            const cleanupToast = ()=>{ try { toastEl.remove(); } catch(e){} };

            return new Promise((resolve,reject)=>{
                const timeout = setTimeout(async () => {
                    if (undone) return resolve({ undone: true });
                    try {
                        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                        const res = await fetch(endpoint, { method: 'POST', headers: { 'Content-Type':'application/json', 'X-CSRF-TOKEN': token, 'Accept': 'application/json' }, body: JSON.stringify({ ids }) });
                        const data = await res.json().catch(()=>({}));
                        cleanupToast();
                        if (!res.ok) throw data;
                        resolve({ undone: false, response: data });
                    } catch (err) {
                        // restore UI
                        removedNodes.forEach(r => { try { if (r.parent) r.parent.insertBefore(r.node, r.next); } catch(e){} });
                        cleanupToast();
                        reject(err);
                    }
                }, undoSeconds * 1000);

                toastEl.querySelector('.undo-btn').addEventListener('click', function(){
                    undone = true;
                    clearTimeout(timeout);
                    // restore removed nodes
                    removedNodes.forEach(r => { try { if (r.parent) r.parent.insertBefore(r.node, r.next); } catch(e){} });
                    cleanupToast();
                    resolve({ undone: true });
                });
            });
        }

        document.addEventListener('click', function (e) {
            if (e.target && e.target.matches('[data-bulk-delete]')) {
                const btn = e.target;
                const bulkName = btn.getAttribute('data-bulk-name') || 'unit';
                const checkboxes = document.querySelectorAll('input[data-bulk]');
                const ids = Array.from(checkboxes).filter(cb => cb.checked).map(cb => cb.value);
                if (ids.length === 0) { showToast('Pilih minimal satu ' + bulkName + '.', 'error'); return; }

                // collect selected item titles/thumbs for preview
                const items = Array.from(checkboxes).filter(cb => cb.checked).map(cb => {
                    const tr = cb.closest('tr');
                    let title = null;
                    if (tr) {
                        const titleEl = tr.querySelector('[data-unit-title]');
                        if (titleEl && titleEl.textContent && titleEl.textContent.trim()) title = titleEl.textContent.trim();
                        else {
                            // fallback: try common cell selectors
                            const alt = tr.querySelector('td:nth-child(4)') || tr.querySelector('td');
                            if (alt && alt.textContent && alt.textContent.trim()) title = alt.textContent.trim();
                        }
                    }
                    const thumbEl = tr ? tr.querySelector('img[data-unit-thumb]') : null;
                    const thumb = thumbEl ? (thumbEl.getAttribute('data-unit-thumb') || thumbEl.src) : null;
                    return { title: title || ('#' + cb.value), thumb };
                });

                customConfirm(`Hapus ${ids.length} ${bulkName}? Aksi ini tidak dapat dibatalkan.`, { title: 'Hapus ' + bulkName, confirmText: 'Hapus', cancelText: 'Batal', items })
                .then(confirmed => {
                    if (!confirmed) return;
                    btn.disabled = true;
                    const originalText = btn.innerText;
                    btn.innerText = 'Menghapus...';
                    scheduleDelete({ ids, endpoint: btn.getAttribute('data-bulk-delete'), previewItems: items, undoSeconds: 6 })
                    .then(result => {
                        btn.disabled = false;
                        btn.innerText = originalText;
                        if (result && result.undone) {
                            showToast('Penghapusan dibatalkan', 'info');
                        } else {
                            const removed = (result && result.response && result.response.deleted) ? result.response.deleted : ids;
                            showToast(`${removed.length} ${bulkName} dihapus`, 'success');
                        }
                    }).catch(err => {
                        btn.disabled = false;
                        btn.innerText = originalText;
                        
                        const message = (err && err.message) ? err.message : ('Gagal menghapus ' + bulkName);
                        showToast(message, 'error');
                    });
                });
            }
        });

        // Close modal when an element with .modal-cancel is clicked (delegated)
        document.addEventListener('click', function (e) {
            const el = e.target.closest && e.target.closest('.modal-cancel');
            if (el) {
                const modalRoot = el.closest('.admin-modal-root');
                if (modalRoot) {
                    const topClose = modalRoot.querySelector('.modal-close-top');
                    if (topClose) topClose.click();
                    else fadeOutAndRemove(modalRoot);
                }
            }
        });

        // Simple toast helper
        function showToast(message, type = 'info') {
            const toast = document.createElement('div');
            toast.className = 'fixed bottom-6 right-6 z-50 px-4 py-2 rounded shadow-lg text-white';
            toast.style.background = type === 'error' ? '#ef4444' : (type === 'success' ? '#10b981' : '#374151');
            toast.innerText = message;
            document.body.appendChild(toast);
            // announce to screen readers
            try { const sr = document.getElementById('sr-live'); if (sr) sr.textContent = message; } catch (e) {}
            setTimeout(() => toast.remove(), 3500);
        }

        // Custom confirm dialog returning a Promise<boolean>
        // message: string, options: { title?, confirmText?, cancelText? }
        window.customConfirm = function(message, options = {}) {
            options = Object.assign({ title: 'Konfirmasi', confirmText: 'OK', cancelText: 'Batal', items: [] }, options || {});
            return new Promise((resolve) => {
                const root = document.createElement('div');
                root.className = 'fixed inset-0 flex items-center justify-center';
                root.style.zIndex = '99999';
                // build items HTML if provided
                let itemsHtml = '';
                // helper to detect placeholder/thumb fallbacks we shouldn't treat as real thumbs
                function isPlaceholderThumb(u){
                    if (!u) return true;
                    try {
                        const lower = u.toString().toLowerCase();
                        if (lower.indexOf('placeholder') !== -1) return true;
                        if (/placeholder(-square)?\.svg$/.test(lower)) return true;
                        return false;
                    } catch (e) { return true; }
                }

                // helper to create an inline SVG data URI for initials (better visual than an empty div)
                function svgDataUri(initials){
                    const bg = '#ecfdf5'; // emerald-50
                    const fg = '#065f46'; // emerald-900
                    const svg = `<svg xmlns='http://www.w3.org/2000/svg' width='120' height='80' viewBox='0 0 120 80'>`+
                        `<rect width='100%' height='100%' fill='${bg}' rx='8'/>`+
                        `<text x='50%' y='50%' dy='0.35em' text-anchor='middle' font-family='Inter, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial' font-size='28' fill='${fg}' font-weight='600'>${initials}</text>`+
                        `</svg>`;
                    return 'data:image/svg+xml;utf8,' + encodeURIComponent(svg);
                }
                if (Array.isArray(options.items) && options.items.length) {
                    itemsHtml = '<div class="mb-3"><div class="flex gap-3 overflow-x-auto py-2">';
                    options.items.slice(0,12).forEach(it => {
                        const safeTitle = (it.title || '').replace(/</g,'&lt;').replace(/>/g,'&gt;');
                        const initials = safeTitle.split(' ').map(s=>s[0]).join('').slice(0,2).toUpperCase() || '#';
                        const hasThumb = it.thumb && !isPlaceholderThumb(it.thumb);
                        if (hasThumb) {
                            itemsHtml += `<div class="flex-shrink-0 text-xs text-gray-700 flex flex-col items-center gap-1 item-wrap">
                                <img src="${it.thumb}" alt="${safeTitle}" class="w-12 h-8 object-cover rounded shadow-sm border border-gray-200" onerror="this.onerror=null;this.src='${svgDataUri(initials)}'">
                                <div class="truncate max-w-[72px] text-center mt-1">${safeTitle}</div>
                            </div>`;
                        } else {
                            const dataUri = svgDataUri(initials);
                            itemsHtml += `<div class="flex-shrink-0 text-xs text-gray-700 flex flex-col items-center gap-1">
                                <img src="${dataUri}" alt="${safeTitle}" class="w-12 h-8 rounded shadow-sm border border-gray-100 object-cover">
                                <div class="truncate max-w-[72px] text-center mt-1">${safeTitle}</div>
                            </div>`;
                        }
                    });
                    itemsHtml += '</div></div>';
                }

                root.innerHTML = `
                    <div class="absolute inset-0" style="background-color: rgba(0,0,0,0.96);"></div>
                    <div class="bg-white rounded-lg shadow-xl z-50 w-full max-w-lg mx-4" style="opacity:0; transform: translateY(8px) scale(0.98); transition:opacity 180ms ease, transform 200ms ease;">
                        <div class="p-4 border-b">
                            <h3 class="text-lg font-semibold text-gray-900">${options.title}</h3>
                        </div>
                        <div class="p-4 text-sm text-gray-700">
                            ${itemsHtml}
                            <p>${message}</p>
                        </div>
                        <div class="p-4 border-t flex justify-end gap-3">
                            <button class="confirm-cancel px-4 py-2 rounded bg-gray-100 text-gray-800">${options.cancelText}</button>
                            <button class="confirm-ok px-4 py-2 rounded bg-emerald-600 text-white">${options.confirmText}</button>
                        </div>
                    </div>
                `;
                document.body.appendChild(root);

                const panel = root.querySelector('.bg-white.rounded-lg');
                // animate in
                requestAnimationFrame(()=>{ try { panel.style.opacity = '1'; panel.style.transform = 'translateY(0) scale(1)'; } catch(e){} });

                const okBtn = root.querySelector('.confirm-ok');
                const cancelBtn = root.querySelector('.confirm-cancel');

                function cleanup(result) {
                    try { document.removeEventListener('keydown', onKey); } catch (e) {}
                    try {
                        // animate out
                        panel.style.opacity = '0'; panel.style.transform = 'translateY(8px) scale(0.98)';
                        setTimeout(()=> { try { root.remove(); } catch (e) {} }, 220);
                    } catch (e) { try { root.remove(); } catch (er) {} }
                    // resolve after animation
                    setTimeout(()=> resolve(result), 240);
                }

                function onKey(e){
                    if (e.key === 'Escape') cleanup(false);
                    if (e.key === 'Enter') cleanup(true);
                }

                okBtn.addEventListener('click', function(e){ e.preventDefault(); cleanup(true); });
                cancelBtn.addEventListener('click', function(e){ e.preventDefault(); cleanup(false); });
                const backdropEl = root.querySelector('.absolute.inset-0');
                if (backdropEl) backdropEl.addEventListener('click', function(){ cleanup(false); });
                document.addEventListener('keydown', onKey);

                // focus management
                setTimeout(()=> { try { okBtn.focus(); } catch (e){} }, 60);
            });
        }

        // Inline edit modal for edit links (use closest to handle clicks on child elements)
        document.addEventListener('click', function (e) {
            const btn = e.target && e.target.closest ? e.target.closest('.edit-btn') : null;
            if (btn) {
                e.preventDefault();
                const url = btn.getAttribute('data-edit-url') || btn.dataset.editUrl;
                if (!url) return;
                fetch(url, {headers: {'X-Requested-With': 'XMLHttpRequest'}})
                    .then(r => r.text())
                    .then(html => {
                        // Try to extract form from HTML response
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(html, 'text/html');
                        const form = doc.querySelector('form');
                        if (form) {
                            // Ensure the form posts back to update endpoint; keep as-is
                            openModal(form.outerHTML);
                        } else {
                            openModal(html);
                        }
                    }).catch(err => {
                        
                        showToast('Gagal memuat form edit', 'error');
                    });
            }
        });

        // Create unit modal trigger
        document.getElementById('create-unit-btn')?.addEventListener('click', function(e){
            e.preventDefault();
            const url = this.getAttribute('data-url');
            fetch(url, {headers: {'X-Requested-With': 'XMLHttpRequest'}})
                .then(r => r.text())
                .then(html => {
                    // server partial already includes form; inject directly
                    openModal(html);
                }).catch(err => {
                    
                    showToast('Gagal memuat form create', 'error');
                });
        });

        // Create facility modal trigger (mirror create-unit behavior)
        document.getElementById('create-facility-btn')?.addEventListener('click', function(e){
            e.preventDefault();
            const url = this.getAttribute('data-url');
            fetch(url, {headers: {'X-Requested-With': 'XMLHttpRequest'}})
                .then(r => r.text())
                .then(html => {
                    openModal(html);
                }).catch(err => {
                    
                    showToast('Gagal memuat form create', 'error');
                });
        });

        // GLightbox is bundled via Vite (imported in resources/js/app.js). If the bundle hasn't initialized, try to init when available.
        (function(){
            try {
                if (window.glightbox && typeof window.glightbox === 'object') return;
                // wait a short moment for app bundle to initialize
                setTimeout(function(){
                    try {
                        if (window.glightbox && typeof window.glightbox === 'object') return;
                        if (window.GLightbox || window.GLightboxInit) {
                            window.glightbox = GLightbox({ selector: '.glightbox', touchNavigation: true, loop: false });
                        }
                    } catch (e) { /* ignore inner init errors */ }
                }, 300);
            } catch (e) { /* ignore */ }
        })();

        // Interactive accessible popover for title preview
        (function(){
            let pop = null;
            let pinned = false;
            function ensurePopover(){
                if (!pop) {
                    pop = document.createElement('div');
                    pop.className = 'absolute z-50 bg-white shadow-lg rounded p-3 text-sm max-w-xs ring-1 ring-black ring-opacity-5';
                    pop.setAttribute('role','dialog');
                    pop.setAttribute('aria-modal','false');
                    pop.tabIndex = -1;
                    document.body.appendChild(pop);
                }
                return pop;
            }
            function showPopover(target){
                if (!target) return;
                const el = ensurePopover();
                const title = target.getAttribute('data-unit-title') || target.textContent || '';
                const desc = target.getAttribute('title') || '';
                el.innerHTML = `<div class="font-semibold text-gray-900 mb-1">${title}</div><div class="text-gray-600">${desc}</div>`;
                const rect = target.getBoundingClientRect();
                el.style.left = Math.max(8, rect.left + window.scrollX) + 'px';
                el.style.top = (rect.bottom + window.scrollY + 8) + 'px';
                el.style.display = 'block';
                // make focusable so keyboard users can enter it
                el.tabIndex = 0;
            }
            function hidePopover(){ if (pop && !pinned) pop.style.display = 'none'; }

            // Toggle pin on click (click to keep popover open)
            document.addEventListener('click', function(e){
                const t = e.target.closest && e.target.closest('.title-popover-trigger');
                if (t) {
                    // toggle pinned state
                    pinned = !pinned;
                    if (pinned) showPopover(t); else hidePopover();
                    return;
                }
                // click outside closes popover unless pinned
                if (pop && !e.target.closest('.title-popover-trigger') && !e.target.closest('[role="dialog"]')) {
                    pinned = false; hidePopover();
                }
            });

            // mouseover/focus to show
            document.addEventListener('mouseover', function(e){ const t = e.target.closest && e.target.closest('.title-popover-trigger'); if (t) { showPopover(t); } });
            document.addEventListener('focusin', function(e){ const t = e.target.closest && e.target.closest('.title-popover-trigger'); if (t) { showPopover(t); } });
            // mouseout/blur to hide (unless pinned)
            document.addEventListener('mouseout', function(e){ const t = e.target.closest && e.target.closest('.title-popover-trigger'); if (t) { hidePopover(); } });
            document.addEventListener('focusout', function(e){ const t = e.target.closest && e.target.closest('.title-popover-trigger'); if (t) { hidePopover(); } });

            // Escape to close
            document.addEventListener('keydown', function(e){ if (e.key === 'Escape') { pinned = false; hidePopover(); } });
        })();
    </script>
    
    
    <script src="https://cdn.jsdelivr.net/npm/compressorjs@1.2.1/dist/compressor.min.js"></script>
    
    
    <div id="confirmModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-[9999] flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full transform transition-all scale-95 opacity-0" id="confirmModalContent">
            <div class="p-6">
                <div class="flex items-center justify-center w-16 h-16 mx-auto bg-red-100 rounded-full mb-4">
                    <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 text-center mb-2">Hapus Gambar</h3>
                <p class="text-gray-600 text-center mb-6" id="confirmMessage">Apakah Anda yakin ingin menghapus gambar ini?</p>
                <div class="flex gap-3">
                    <button type="button" id="confirmCancel" class="flex-1 px-4 py-2.5 border-2 border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition-all">
                        Batal
                    </button>
                    <button type="button" id="confirmOk" class="flex-1 px-4 py-2.5 bg-gradient-to-r from-red-600 to-red-700 text-white font-semibold rounded-lg hover:from-red-700 hover:to-red-800 transition-all shadow-lg">
                        Hapus
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    
    <script>
        window.showConfirm = function(message) {
            return new Promise(function(resolve) {
                const modal = document.getElementById('confirmModal');
                const content = document.getElementById('confirmModalContent');
                const messageEl = document.getElementById('confirmMessage');
                const okBtn = document.getElementById('confirmOk');
                const cancelBtn = document.getElementById('confirmCancel');
                
                messageEl.textContent = message || 'Apakah Anda yakin?';
                
                modal.classList.remove('hidden');
                setTimeout(function() {
                    content.classList.remove('scale-95', 'opacity-0');
                    content.classList.add('scale-100', 'opacity-100');
                }, 10);
                
                function close(result) {
                    content.classList.remove('scale-100', 'opacity-100');
                    content.classList.add('scale-95', 'opacity-0');
                    setTimeout(function() {
                        modal.classList.add('hidden');
                        resolve(result);
                    }, 200);
                }
                
                okBtn.onclick = function() { close(true); };
                cancelBtn.onclick = function() { close(false); };
                modal.onclick = function(e) { 
                    if (e.target === modal) close(false); 
                };
            });
        };
    </script>
    
    
    <script>
        window.deleteSingleImage = function(button) {
            showConfirm('Apakah Anda yakin ingin menghapus gambar ini?').then(function(confirmed) {
                if (!confirmed) return;
            
            const container = button.closest('.image-item');
            if (!container) {
                alert('Container tidak ditemukan');
                return;
            }
            
            const imagePath = container.getAttribute('data-image-path');
            const form = button.closest('form');
            
            let unitId = form ? form.getAttribute('data-unit-id') : null;
            
            if (!unitId) {
                const idInput = form ? form.querySelector('input[name="id"]') : null;
                unitId = idInput ? idInput.value : null;
            }
            
            if (!unitId) {
                alert('Unit ID tidak ditemukan');
                return;
            }
            
            button.disabled = true;
            const originalHTML = button.innerHTML;
            button.innerHTML = '<svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>';
            
            fetch('/admin/units/' + unitId + '/delete-image', {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ image_path: imagePath })
            })
            .then(function(response) { return response.json(); })
            .then(function(data) {
                if (data.success) {
                    container.style.opacity = '0';
                    container.style.transform = 'scale(0.8)';
                    container.style.transition = 'all 0.3s ease';
                    
                    setTimeout(function() {
                        container.remove();
                        
                        const grid = document.getElementById('existing-images-grid');
                        if (grid && grid.children.length === 0) {
                            grid.parentElement.remove();
                        }
                    }, 300);
                } else {
                    showAlert(data.message || 'Gagal menghapus gambar', 'error');
                    button.disabled = false;
                    button.innerHTML = originalHTML;
                }
            })
            .catch(function(error) {
                showAlert('Error: ' + error.message, 'error');
                button.disabled = false;
                button.innerHTML = originalHTML;
            });
            });
        };
    </script>
    
    
    <div id="alertModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-[9999] flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full transform transition-all scale-95 opacity-0" id="alertModalContent">
            <div class="p-6">
                <div class="flex items-center justify-center w-16 h-16 mx-auto rounded-full mb-4" id="alertIcon">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 text-center mb-2" id="alertTitle">Informasi</h3>
                <p class="text-gray-600 text-center mb-6" id="alertMessage">Pesan</p>
                <button type="button" id="alertOk" class="w-full px-4 py-2.5 bg-gradient-to-r from-emerald-600 to-green-700 text-white font-semibold rounded-lg hover:from-emerald-700 hover:to-green-800 transition-all shadow-lg">
                    OK
                </button>
            </div>
        </div>
    </div>
    
    
    <script>
        window.showAlert = function(message, type) {
            type = type || 'info';
            const modal = document.getElementById('alertModal');
            const content = document.getElementById('alertModalContent');
            const messageEl = document.getElementById('alertMessage');
            const titleEl = document.getElementById('alertTitle');
            const iconEl = document.getElementById('alertIcon');
            const okBtn = document.getElementById('alertOk');
            
            messageEl.textContent = message;
            
            if (type === 'error') {
                titleEl.textContent = 'Error';
                iconEl.className = 'flex items-center justify-center w-16 h-16 mx-auto bg-red-100 rounded-full mb-4';
                iconEl.innerHTML = '<svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>';
            } else if (type === 'success') {
                titleEl.textContent = 'Berhasil';
                iconEl.className = 'flex items-center justify-center w-16 h-16 mx-auto bg-green-100 rounded-full mb-4';
                iconEl.innerHTML = '<svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>';
            } else {
                titleEl.textContent = 'Informasi';
                iconEl.className = 'flex items-center justify-center w-16 h-16 mx-auto bg-blue-100 rounded-full mb-4';
                iconEl.innerHTML = '<svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>';
            }
            
            modal.classList.remove('hidden');
            setTimeout(function() {
                content.classList.remove('scale-95', 'opacity-0');
                content.classList.add('scale-100', 'opacity-100');
            }, 10);
            
            function close() {
                content.classList.remove('scale-100', 'opacity-100');
                content.classList.add('scale-95', 'opacity-0');
                setTimeout(function() {
                    modal.classList.add('hidden');
                }, 200);
            }
            
            okBtn.onclick = close;
            modal.onclick = function(e) { 
                if (e.target === modal) close(); 
            };
        };
    </script>
    
    
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>

<?php /**PATH D:\Project\BumiAsriParahyangan\resources\views/layouts/admin.blade.php ENDPATH**/ ?>