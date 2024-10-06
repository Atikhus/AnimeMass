const mangaData = {
    labels: ['One Piece', 'Naruto', 'Bleach', 'Dragon Ball', 'Death Note'],
    data: [500, 400, 300, 350, 250]
};

const mangakaData = {
    labels: ['Eiichiro Oda', 'Masashi Kishimoto', 'Tite Kubo', 'Akira Toriyama', 'Tsugumi Ohba'],
    data: [1000, 800, 600, 750, 500]
};

const readerData = {
    labels: ['13-17', '18-24', '25-34', '35-44', '45+'],
    data: [30, 40, 15, 10, 5]
};

// Función para crear gráficos
function createChart(canvasId, chartData, chartType = 'bar') {
    const ctx = document.getElementById(canvasId).getContext('2d');
    return new Chart(ctx, {
        type: chartType,
        data: {
            labels: chartData.labels,
            datasets: [{
                label: 'Popularidad',
                data: chartData.data,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.7)',
                    'rgba(54, 162, 235, 0.7)',
                    'rgba(255, 206, 86, 0.7)',
                    'rgba(75, 192, 192, 0.7)',
                    'rgba(153, 102, 255, 0.7)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Estadísticas'
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}


function handleNavigation() {
    const navLinks = document.querySelectorAll('.sidebar a');
    const sections = document.querySelectorAll('.dashboard-item');

    navLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            const targetId = link.getAttribute('data-section');


            navLinks.forEach(link => link.classList.remove('active'));
            link.classList.add('active');


            sections.forEach(section => {
                if (section.id === targetId) {
                    section.classList.add('active');
                } else {
                    section.classList.remove('active');
                }
            });


            charts[targetId].update();
        });
    });
}


const charts = {};


window.onload = function() {
    
    charts['manga-stats'] = createChart('mangaChart', mangaData);
    charts['mangaka-stats'] = createChart('mangakaChart', mangakaData);
    charts['reader-stats'] = createChart('readerChart', readerData, 'pie');


    handleNavigation();


    document.querySelector('.sidebar a').click();
};


window.addEventListener('resize', function() {
    Object.values(charts).forEach(chart => chart.resize());
});