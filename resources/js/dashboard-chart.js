import Chart from 'chart.js/auto';

export function initDashboardChart(canvasId, labels = [], totalCounts = [], unreadCounts = []) {
    const ctx = document.getElementById(canvasId);
    if (!ctx) return null;

    // Detect dark mode
    const isDark = document.documentElement.classList.contains('dark');
    
    // Dark mode colors
    const textColor = isDark ? '#e5e7eb' : '#374151';
    const gridColor = isDark ? 'rgba(75, 85, 99, 0.2)' : 'rgba(0, 0, 0, 0.1)';
    const emeraldBorder = isDark ? 'rgba(16,185,129,1)' : 'rgba(16,185,129,0.9)';
    const emeraldBg = isDark ? 'rgba(16,185,129,0.15)' : 'rgba(16,185,129,0.12)';
    const blueBorder = isDark ? 'rgba(96,165,250,1)' : 'rgba(59,130,246,0.9)';
    const blueBg = isDark ? 'rgba(96,165,250,0.12)' : 'rgba(59,130,246,0.08)';

    const chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Total pesan',
                    data: totalCounts,
                    borderColor: emeraldBorder,
                    backgroundColor: emeraldBg,
                    fill: true,
                    tension: 0.3,
                    pointRadius: 4,
                    pointBackgroundColor: emeraldBorder,
                    pointBorderColor: isDark ? '#1f2937' : '#ffffff',
                    pointBorderWidth: 2,
                    pointHoverRadius: 6,
                },
                {
                    label: 'Belum terbaca',
                    data: unreadCounts,
                    borderColor: blueBorder,
                    backgroundColor: blueBg,
                    fill: false,
                    tension: 0.3,
                    pointRadius: 3,
                    pointBackgroundColor: blueBorder,
                    pointBorderColor: isDark ? '#1f2937' : '#ffffff',
                    pointBorderWidth: 2,
                    pointHoverRadius: 5,
                    borderDash: [5,3]
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: { 
                legend: { 
                    position: 'top',
                    labels: {
                        color: textColor,
                        padding: 15,
                        font: {
                            size: 12,
                            weight: '500'
                        },
                        usePointStyle: true,
                        pointStyle: 'circle'
                    }
                },
                tooltip: {
                    backgroundColor: isDark ? 'rgba(31, 41, 55, 0.95)' : 'rgba(255, 255, 255, 0.95)',
                    titleColor: isDark ? '#f3f4f6' : '#111827',
                    bodyColor: isDark ? '#e5e7eb' : '#374151',
                    borderColor: isDark ? 'rgba(75, 85, 99, 0.3)' : 'rgba(0, 0, 0, 0.1)',
                    borderWidth: 1,
                    padding: 12,
                    displayColors: true,
                    callbacks: {
                        title: function(tooltipItems) {
                            return tooltipItems[0].label;
                        }
                    }
                }
            },
            scales: { 
                y: { 
                    beginAtZero: true, 
                    ticks: { 
                        stepSize: 1,
                        color: textColor,
                        font: {
                            size: 11
                        }
                    },
                    grid: {
                        color: gridColor,
                        drawBorder: false
                    }
                },
                x: {
                    ticks: {
                        color: textColor,
                        font: {
                            size: 11
                        }
                    },
                    grid: {
                        display: false,
                        drawBorder: false
                    }
                }
            },
            interaction: {
                mode: 'index',
                intersect: false
            }
        }
    });

    // Update chart when dark mode changes
    const observer = new MutationObserver((mutations) => {
        mutations.forEach((mutation) => {
            if (mutation.attributeName === 'class') {
                const isDarkNow = document.documentElement.classList.contains('dark');
                const newTextColor = isDarkNow ? '#e5e7eb' : '#374151';
                const newGridColor = isDarkNow ? 'rgba(75, 85, 99, 0.2)' : 'rgba(0, 0, 0, 0.1)';
                
                // Update colors
                chart.options.plugins.legend.labels.color = newTextColor;
                chart.options.plugins.tooltip.backgroundColor = isDarkNow ? 'rgba(31, 41, 55, 0.95)' : 'rgba(255, 255, 255, 0.95)';
                chart.options.plugins.tooltip.titleColor = isDarkNow ? '#f3f4f6' : '#111827';
                chart.options.plugins.tooltip.bodyColor = isDarkNow ? '#e5e7eb' : '#374151';
                chart.options.plugins.tooltip.borderColor = isDarkNow ? 'rgba(75, 85, 99, 0.3)' : 'rgba(0, 0, 0, 0.1)';
                chart.options.scales.y.ticks.color = newTextColor;
                chart.options.scales.y.grid.color = newGridColor;
                chart.options.scales.x.ticks.color = newTextColor;
                
                // Update dataset colors
                chart.data.datasets[0].borderColor = isDarkNow ? 'rgba(16,185,129,1)' : 'rgba(16,185,129,0.9)';
                chart.data.datasets[0].backgroundColor = isDarkNow ? 'rgba(16,185,129,0.15)' : 'rgba(16,185,129,0.12)';
                chart.data.datasets[0].pointBorderColor = isDarkNow ? '#1f2937' : '#ffffff';
                chart.data.datasets[1].borderColor = isDarkNow ? 'rgba(96,165,250,1)' : 'rgba(59,130,246,0.9)';
                chart.data.datasets[1].backgroundColor = isDarkNow ? 'rgba(96,165,250,0.12)' : 'rgba(59,130,246,0.08)';
                chart.data.datasets[1].pointBorderColor = isDarkNow ? '#1f2937' : '#ffffff';
                
                chart.update('none'); // Update without animation
            }
        });
    });

    observer.observe(document.documentElement, {
        attributes: true,
        attributeFilter: ['class']
    });

    return chart;
}
