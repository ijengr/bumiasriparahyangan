import './bootstrap';

import Alpine from 'alpinejs';
import { setupLazyImages } from './utils/performance';

window.Alpine = Alpine;

Alpine.start();

// GLightbox (imported so it's bundled by Vite)
import GLightbox from 'glightbox';
import 'glightbox/dist/css/glightbox.min.css';
// Chart.js (expose globally for inline dashboard scripts)
import Chart from 'chart.js/auto';
window.Chart = Chart;

// dashboard chart initializer (imported as module)
import { initDashboardChart } from './dashboard-chart';

// per-page dropdown is now an Alpine component in Blade

document.addEventListener('DOMContentLoaded', function(){
	// Setup lazy image loading
	setupLazyImages();
	
	try {
		// dashboard chart data is embedded in a script tag with id 'dashboard-data'
		const dataEl = document.getElementById('dashboard-data');
		if (dataEl) {
			const payload = JSON.parse(dataEl.textContent || '{}');
			initDashboardChart('messagesChart', payload.months || [], payload.counts || [], payload.unreadCounts || []);
		}
	} catch(e) {
		console.error('Dashboard chart init failed', e);
	}

	try {
		window.glightbox = GLightbox({
			selector: '.glightbox',
			touchNavigation: true,
			loop: false,
			plyr: false,
			keyboardNavigation: true,
			openEffect: 'zoom',
			closeEffect: 'fade',
			moreText: 'Lihat lebih',
			slideExtraAttributes: ['data-description'],
			onOpen: () => {},
			onClose: () => {}
		});
	} catch(e) { console.error('GLightbox init failed', e); }
});
