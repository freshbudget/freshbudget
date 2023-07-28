<div x-data="{
    data: [
        { year: 2010, count: 10 },
        { year: 2011, count: 20 },
        { year: 2012, count: 15 },
        { year: 2013, count: 25 },
        { year: 2014, count: 22 },
        { year: 2015, count: 30 },
        { year: 2016, count: 28 },
    ],
    chart: null,
}" x-init="
    chart = new window.Chart(
        $refs.chart, {
            type: 'line',
            options: {
                animation: false,
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        left: 0,
                        right: 0,
                        bottom: 0,
                        top: 5
                    },
                    autoPadding: false
                },
                plugins: {
                    legend: {
                        display: false,
                    },
                    filler: {
                        propagate: false,
                    },
                    tooltip: {
                        displayColors: false,
                        backgroundColor: '#fff',
                        borderColor: '#0ea5e9',
                        borderWidth: 1,
                        titleColor: '#0ea5e9',
                        bodyColor: '#0ea5e9',
                        xAlign: 'center',
                        yAlign: 'center',
                    },
                },
                scales: {
                    y: {
                      display: false,
                      beginAtZero: true,
                      grid: {
                        display: false,
                      },
                    },
                    x: {
                        display: false,
                        grid: {
                          display: false
                        },
                    }
                },
              },
            data: {
                labels: data.map(row => row.year),
                datasets: [
                    {
                        borderColor: '#b8c2cc',
                        backgroundColor: 'rgba(207, 223, 243, 0.5)',
                        fill: 'start',
                        label: 'Acquisitions by year',
                        tension: 0.25,
                        data: data.map(row => row.count)
                    }
                ]
            }
        }
    );
">

    <div class="h-36 bg-white rounded border border-gray-300 overflow-hidden relative my-8 inline-block w-1/2">
        <h2 class="font-semibold absolute top-5 left-4 text-gray-500 text-lg">Lifetime Income</h2>
        <canvas x-ref="chart" class="absolute left-0 right-0 w-full max-h-20 bottom-0"></canvas>
    </div>

</div>