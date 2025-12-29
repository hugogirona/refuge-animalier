@props([
    'type' => 'line',
    'title' => '',
    'labels' => [],
    'data' => [],
    'colors' => ['#F97316', '#3B82F6', '#10B981', '#EF4444', '#8B5CF6'],
    'height' => 'h-64'
])

<article
        class="bg-white rounded-xl border border-neutral-200 p-6 shadow-sm"
        x-data="{
        chart: null,
        init() {
            const type = @js($type);
            const labels = @js($labels);
            const data = @js($data);
            const colors = @js($colors);
            const title = @js($title);

            const isLine = type === 'line';
            const isAxisChart = isLine || type === 'bar';

            this.chart = new Chart (this.$refs.canvas.getContext('2d'), {
                type: type,
                data: {
                    labels: labels,
                    datasets: [{
                        label: title,
                        data: data,
                        backgroundColor: isLine ? 'transparent' : colors,
                        borderColor: isLine ? '#F97316' : '#ffffff',
                        borderWidth: 2,
                        pointBackgroundColor: '#fff',
                        pointBorderColor: '#F97316',
                        pointRadius: 4,
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: !isLine,
                            position: 'bottom',
                            labels: { usePointStyle: true, padding: 20 }
                        }
                    },
                    scales: {
                        y: {
                            display: isAxisChart,
                            beginAtZero: true,
                            grid: { borderDash: [2, 4], color: '#e5e7eb' }
                        },
                        x: {
                            display: isAxisChart,
                            grid: { display: false }
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index',
                    }
                }
            });
        }
    }"
>
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-lg font-bold text-grayscale-text-title">{{ $title }}</h3>
    </div>
    <div class="{{ $height }} relative w-full">
        <canvas x-ref="canvas"></canvas>
    </div>
</article>
