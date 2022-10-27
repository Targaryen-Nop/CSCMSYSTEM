<?php

session_start();
date_default_timezone_set("Asia/Bangkok");


if (@$_SESSION['login_id'] == "") {
    echo "<meta http-equiv='refresh' content='0; url=login.php'>";
    exit;
}


include "connectdb.php";



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CSCM System</title>


    <link rel="stylesheet" type="text/css" href="./css/document.css">


    <!-- Use for 3D Button -->
    <link href="https://fonts.googleapis.com/css?family=Cabin:400,500,600,bold" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=PT+Sans+Narrow:regular,bold" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Droid+Sans:bold+Lobster" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet" type="text/css">

    <!-- Use for Bootstrap 4 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <!-- Use for Chart.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
    <script src='chart-plugin/chartjs-plugin-datalabels.min.js' type='text/javascript'></script>

    <!-- Use for Bootstrap Multi Select -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.js">
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css" />

    <!-- Use for Datatable -->
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.10.24/api/order.neutral().js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css" />

    <!-- Use for Datatable Mark or Highlight -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mark.js/8.11.1/jquery.mark.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.10.13/features/mark.js/datatables.mark.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/plug-ins/1.10.13/features/mark.js/datatables.mark.min.css" />

    <!-- Use for Date -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css" />

    <!-- Use for Time -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.13.16/jquery.timepicker.min.js" integrity="sha512-huX0hcUeIkgR0QvTlhxNpIAcwiN2sABe3VwyzeZAYjMPn3OU71t9ZLlk6qs27Q049SPgeB/Az12jv/ayedXoAw==" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.13.16/jquery.timepicker.min.css" integrity="sha512-GgUcFJ5lgRdt/8m5A0d0qEnsoi8cDoF0d6q+RirBPtL423Qsj5cI9OxQ5hWvPi5jjvTLM/YhaaFuIeWCLi6lyQ==" crossorigin="anonymous" />

    <!-- Use for Booststrap Select or Selectpicker -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">

    <!-- Use for Chosen 1.8 -->
    <link href='chosen/chosen.min.css' rel='stylesheet' type='text/css'>
    <script src='chosen/chosen.jquery.min.js' type='text/javascript'></script>

    <!-- Use for Font Awesome -->
    <script src="https://kit.fontawesome.com/95e0a11daf.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Use for Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    <!-- #################################################################################3######## -->

    <!----->

</head>

<style>
    * {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
    }

    nav {
        box-shadow: 0px 8px 10px 3px rgba(0, 0, 0, 0.12);
    }
</style>
<nav class="navbar navbar-expand-xl  py-3">
    <a class="navbar-brand" href="#"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">

        </ul>
        <div class="nav-item dropdown">
            <a class="nav-link dropdown-toggle font-th" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                <?php echo  $_SESSION['user_nameth'] . " " . $_SESSION['user_lnameth']; ?>
            </a>
            <div class="dropdown-menu">
              
                <a class="dropdown-item" href="manage_cscm_persons.php" <?php if($_SESSION['auth'] == "Student"){?> hidden <?php }else{ echo""; } ?>>Manage User</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="logout.php">Logout</a>
            </div>
        </div>
        <button id="homePage" class="menu mx-3 font-th" onclick="location.href='main.php?id=<?php echo $_SESSION['login_id']; ?>'">หน้าแรก </button>
        <button id="subjectPage" class="menu mx-3 font-th" href="#">หน้ารายวิชา </button>
        <button id="studentPage" class="menu mx-3 font-th" onclick="location.href='students.php'">หน้านศ.ในคณะ </button>
        <button id="activityPage" class="menu mx-3 font-th" href="#">หน้ากิจกรรม</button>
        <button id="teacherPage" class="menu mx-3 font-th" href="#">หน้าดูอาจารย์</button>
    </div>

</nav>


<style>
    .font-en {
        font-family: ARIBLK;
    }

    .font-th {
        font-family: 'Kanit';
    }

    @font-face {
        font-family: ARIBLK;
        src: url(ariblk.ttf);

    }

    nav {
        background-color: #fcfcfc;
        border-bottom: 5px solid #463DBC;
    }

    .menu {
        height: 45px;
        width: 110px;
        border: none;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        color: #463DBC;
        background-color: #fcfcfc;
    }

    button.menu:hover {
        height: 45px;
        width: 110px;
        border: none;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        color: #fcfcfc;
        background-color: #463DBC;
    }

    button.menu:disabled {
        height: 45px;
        width: 110px;
        border: none;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        color: #fcfcfc;
        background-color: #463DBC;
    }
</style>


<script>
    function ajaxCall() {

        $.ajax({
            url: 'refresh.php',
            method: 'POST',
            data: {

            },
            dataType: 'json',
            success: function(data) {

                $('#login').text(data.login_return);

            }
        });

    }
    $(document).ready(function() {
        ajaxCall();
    });
    setInterval(function() {
        ajaxCall();
    }, 6000);
</script>

</html>