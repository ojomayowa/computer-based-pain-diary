<?php
session_start();
if (!isset($_SESSION['details'])) {
    header('location: index.php');
}
require 'connection/constants.php';
require 'connection/connection.php';

?>
<?php require_once "header.php"; ?>
<div class="container">
    <div class="top-header">
        <b>Welcome <?php echo $_SESSION['details']['name'] ?></b><br>
        You are here: Pain Graph
    </div>
    <div class="content">
        <?php require_once 'handlers/alerts.php'; ?>
        <div style="max-width: 800px; margin: auto; margin-top: 60px;">
            <canvas id="myChart"> loading graph </canvas>
            <div style="width: 100%; height: auto;">
                <form action="" method="get">
                    <div style="width: 46%; margin: 10px 0; padding: 5px 10px; display: inline-block;">
                        <label> Start Date </label>
                        <input type="text" class="dates" name="start" required value="">
                    </div>
                    <div style="width: 46%; margin: 10px 0; padding: 5px 10px; display: inline-block;">
                        <label> End Date </label>
                        <input type="text" class="dates" name="end" required value="">
                    </div>
                    <div style="width: 46%; margin: 10px 0; padding: 5px 10px; display: inline-block;">
                        <input type="submit" value="SUBMIT" id="submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <input type="hidden" id="start" value="<?php echo $_GET['start'] ?? 'undefined'; ?>">
    <input type="hidden" id="end" value="<?php echo $_GET['end'] ?? 'undefined'; ?>">
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    async function getData() {
        let start = document.querySelector('#start').value;
        let end = document.querySelector('#end').value;
        
        const data = [];
        const label = []
        if (start == 'undefined' & end == 'undefined') {

            const getData = await fetch('handlers/painlog/graphData.php');
            const response = await getData.json();
            console.log('jk', response);
            response.forEach(function(response) {
                data.push(response.scale_per_day);
                label.push(response.day);
            });
        } else {
            const getData = await fetch(`/handlers/painlog/graphData.php?start=${start}&end=${end}`);
            const response = await getData.json();
            console.log(response);
            response.forEach(function(response) {
                data.push(response.scale_per_day);
                label.push(response.day);
            });
        }

        var ctx = document.getElementById('myChart');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: label,
                datasets: [{
                    label: 'Graph of Average Daily Pain Scale',
                    data: data,
                    borderWidth: 3,
                    borderColor: 'rgb(75, 192, 192)',
                    backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 205, 86)'
                    ],
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }
    window.addEventListener('load', function() {
        getData();
    })


    // document.querySelector('#submit').addEventListener('click', function(e) {
    //     let start = document.querySelector('#start').value;
    //     let end = document.querySelector('#end').value;
    //     document.querySelector('#myChart').innerHTML = 'loading chart';
    //     getData(start, end);
    // });
</script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    flatpickr(".dates", {
        dateFormat: "Y-m-d",
    });
</script>
<?php require_once "footer.php"; ?>