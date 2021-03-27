<script>
    var line_label = JSON.parse('<?php echo $date_string ?>')
    var line_data = JSON.parse('<?php echo $total_patient_string ?>')
    var line_data_daily = JSON.parse('<?php echo $patient_string ?>')
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
            }, {
                label: 'Kasus Positif Harian',
                backgroundColor: 'rgba(43, 121, 100, 0.2)',
                borderColor: 'rgba(43, 121, 100, 0.6)',
                pointBackgroundColor: 'rgba(43, 121, 100, 0.6)',
                pointBorderColor: '#fff',
                data: line_data_daily
            }]
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
    var doughnut_data = JSON.parse('<?php echo $cluster_by_age ?>')
    console.log(doughnut_data)
    var doughnutChart = new Chart(document.getElementById('canvas-3'), {
        type: 'doughnut',
        data: {
            labels: doughnut_label,
            datasets: [{
                data: doughnut_data,
                backgroundColor: ['#3399ff', '#321fdb', '#636f83'],
                hoverBackgroundColor: ['#3399ff', '#321fdb', '#636f83']
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
    var pie_data = JSON.parse('<?php echo $cluster_by_status ?>')

    var pieChart = new Chart(document.getElementById('canvas-5'), {
        type: 'pie',
        data: {
            labels: pie_label,
            datasets: [{
                data: pie_data,
                backgroundColor: ['#2eb85c', '#f9b115', '#e55353'],
                hoverBackgroundColor: ['#2eb85c', '#f9b115', '#e55353']
            }]
        },
        options: {
            responsive: true
        }
    });
</script>