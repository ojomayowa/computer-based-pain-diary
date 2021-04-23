<!DOCTYPE html>
<html>

<head>
    <title> DASHBOARD </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/css/ion.rangeSlider.min.css" />
    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/app.css">
    <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="Toast/css/Toast.min.css">
    <link rel="stylesheet" type="text/css" href="fancybox/jquery.fancybox.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link href="css/alerts.css" rel="stylesheet">
    <style>
        header {
            width: 75% !important;
            margin: 30px auto 0 auto !important;
            background-color: rgb(4, 120, 87);
        }

        header>img {
            width: 80%;
        }

        .top-header {
            width: 94%;
            height: auto;
            margin: auto;
            padding: 20px 3%;
            border-bottom: 1px solid #E1E1E1;
        }
    </style>
</head>

<body>
    <div class="outerwrapper">
        <div class="sidebar">
            <header>
                <strong>PAIN DIARY</strong>
            </header>
            <div class="desktop">
                <div class="sidebar-link"><a href="dashboard.php"><i class="fa fa-home"></i> DASHBOARD </a></div>
                <div class="sidebar-link"><a href="painlog.php"><i class="fa fa-home"></i> PAIN LOG </a></div>
                <div class="sidebar-link"><a href="report.php"><i class="fa fa-home"></i> REPORTS </a></div>
                <div class="sidebar-link"><a href="graph.php"><i class="fa fa-home"></i> GRAPHS </a></div>
                <div class="sidebar-link"><a href="logout.php" title="Logout"><i class="fa fa-sign-out"></i> LOGOUT </a></div>
                <div class="sidebar-link"><a href="handlers/auth/delete.php" title="Logout"><i class="fa fa-sign-out"></i> DELETE ACCOUNT </a></div>
            </div>
        </div>