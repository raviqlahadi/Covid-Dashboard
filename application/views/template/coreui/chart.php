<script>
    var random = function random() {
        return Math.round(Math.random() * 100);
    };
    var line_label = [
        "01/03/21",
        "02/03/21",
        "03/03/21",
        "04/03/21",
        "05/03/21",
        "06/03/21",
        "07/03/21",
        "08/03/21",
    ]
    var line_data = [
        1,
        2,
        4,
        5,
        5,
        5,
        21,
        22,
    ]
    var lineChart = new Chart(document.getElementById('canvas-1'), {
        type: 'line',
        data: {
            labels: line_label,
            datasets: [{
                label: 'Akumulatif Kasus Positif',
                backgroundColor: 'rgba(0, 0, 220, 0.2)',
                borderColor: 'rgba(0, 0, 220, 0.6)',
                pointBackgroundColor: 'rgba(0, 0, 220, 0.6)',
                pointBorderColor: '#fff',
                data: line_data
            }, ]
        },
        options: {
            responsive: true
        }
    });

    var doughnut_label = [
        "< 17",
        "17-40",
        "> 40"
    ]
    var doughnut_data = [
        10,
        200,
        321
    ]
    var doughnutChart = new Chart(document.getElementById('canvas-3'), {
        type: 'doughnut',
        data: {
            labels: doughnut_label,
            datasets: [{
                data: doughnut_data,
                backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56'],
                hoverBackgroundColor: ['#FF6384', '#36A2EB', '#FFCE56']
            }]
        },
        options: {
            responsive: true
        }
    });

    // sembuh 123
    // dirawat 2012
    // meninggal 321

    var pie_label = [
        "Sembuh",
        "Dirawat",
        "Meninggal"
    ]
    var pie_data = [
        123,
        2012,
        321
    ]

    var pieChart = new Chart(document.getElementById('canvas-5'), {
        type: 'pie',
        data: {
            labels: pie_label,
            datasets: [{
                data: pie_data,
                backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56'],
                hoverBackgroundColor: ['#FF6384', '#36A2EB', '#FFCE56']
            }]
        },
        options: {
            responsive: true
        }
    });
</script>