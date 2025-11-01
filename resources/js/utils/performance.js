/**
 * Performance utilities for debouncing and throttling
 */

/**
 * Debounce function - delays execution until after wait time has elapsed
 * @param {Function} func - Function to debounce
 * @param {number} wait - Wait time in milliseconds
 * @returns {Function} Debounced function
 */
export function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

/**
 * Throttle function - ensures function is called at most once per specified time period
 * @param {Function} func - Function to throttle
 * @param {number} limit - Time limit in milliseconds
 * @returns {Function} Throttled function
 */
export function throttle(func, limit) {
    let inThrottle;
    return function(...args) {
        if (!inThrottle) {
            func.apply(this, args);
            inThrottle = true;
            setTimeout(() => inThrottle = false, limit);
        }
    };
}

/**
 * requestIdleCallback polyfill
 */
if (!('requestIdleCallback' in window)) {
    window.requestIdleCallback = (cb, options) => {
        const start = Date.now();
        return setTimeout(() => {
            cb({
                didTimeout: false,
                timeRemaining: () => Math.max(0, 50 - (Date.now() - start))
            });
        }, 1);
    };
}

if (!('cancelIdleCallback' in window)) {
    window.cancelIdleCallback = (id) => clearTimeout(id);
}

/**
 * Optimized DOM selector with caching
 */
export class DOMCache {
    constructor() {
        this.cache = new Map();
    }

    get(selector) {
        if (!this.cache.has(selector)) {
            this.cache.set(selector, document.querySelector(selector));
        }
        return this.cache.get(selector);
    }

    getAll(selector) {
        const key = `all:${selector}`;
        if (!this.cache.has(key)) {
            this.cache.set(key, document.querySelectorAll(selector));
        }
        return this.cache.get(key);
    }

    clear() {
        this.cache.clear();
    }
}

/**
 * Image lazy load helper
 */
export function setupLazyImages() {
    const lazyImages = document.querySelectorAll('img[loading="lazy"]');
    
    lazyImages.forEach(img => {
        if (img.complete) {
            img.classList.add('loaded');
        } else {
            img.addEventListener('load', function() {
                this.classList.add('loaded');
            });
        }
    });
}

export default {
    debounce,
    throttle,
    DOMCache,
    setupLazyImages
};
