<?php
include 'header.php';
include 'connectdb.php';
?>

<body onload="onLoadSelectPage()">

    <div class="row m-5">
        <div class="col-sm-4">
            <h4 class="font-th">นักศึกษาในคณะ</h4>
            <select id="search_year" class="custom-select m-2 font-th" name="search_year">
                <option value="" selected></option>
                <option value="1">นักศึกษาปริญาตรีชั้นปีที่ 1</option>
                <option value="2">นักศึกษาปริญาตรีชั้นปีที่ 2</option>
                <option value="3">นักศึกษาปริญาตรีชั้นปีที่ 3</option>
                <option value="4">นักศึกษาปริญาตรีชั้นปีที่ 4</option>
            </select>
            <br>
            <select id="search_major" class="custom-select m-2 font-th" name="search_major">
                <option value="" selected></option>
                <option value="301">สาขาวิทยาการคอมพิวเตอร์</option>
                <option value="302">สาขาคอมพิวเตอร์มัลติมีเดีย</option>
            </select>
        </div>
        <div class="col-sm-8 ">
            <table id="student_data" class="table table-bordered table-striped nowrap font-th">
                <thead>
                    <tr>
                        <th width="20%">ลำดับ</th>
                        <th width="30%">รหัสนักศึกษา</th>
                        <th width="50%">ชื่อ-นามสกุล</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</body>
<style>
    .search {
        box-shadow: 5px 3px 5px 2px rgba(0, 0, 0, 0.14);
        width: 30%;
    }

    .search-input {
        border: none;
    }

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
</style>
<script>
    function onLoadSelectPage() {
        document.getElementById('homePage').disabled = false;
        document.getElementById('subjectPage').disabled = false;
        document.getElementById('studentPage').disabled = true;
        document.getElementById('activityPage').disabled = false;
        document.getElementById('teacherPage').disabled = false;
    }
</script>

<script type="text/javascript" language="javascript">
    $(document).ready(function() {
        var dataTable = $('#student_data').DataTable({
            "processing": true,
            "serverSide": true,
            "deferRender": true,
            "mark": true,
            "pageLength": 500,
            "order": [],
            "ajax": {
                url: "students_fetch.php",
                type: "POST",
                data: function(data) {
                    //   Read values
                    var major = $('#search_major').val();
                    var year = $('#search_year').val();



                    var time = new Date();
                    //   Append to data
                    data.searchByMajor = major;
                    data.searchByYear = year;


                }
            },

        });
        $("#clear").click(function() {

            $('#search_major').val('');
            $('#search_year').val('');

            dataTable.search('').draw();
            dataTable.order.neutral().draw();
            dataTable.draw();

        });

        $('#search_major').keyup(function() {
            dataTable.draw();
        });

        $('#search_year').keyup(function() {
            dataTable.draw();
        });

        $(document).on('click', '.update', function() {
            let student_id = $(this).attr("id");
            location.href = 'main.php?id=' + student_id;
        });

    });
</script>

<?php include "footer.php"; ?>