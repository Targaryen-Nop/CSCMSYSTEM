<?php
include 'header.php';
include 'connectdb.php';
$sql = "SELECT * FROM cscm_users WHERE user_id = $_GET[id]";
$query = mysqli_query($connection, $sql);
$row = mysqli_fetch_array($query);
?>

<body onload="onLoadSelectPage()">


    <?php switch (@$_GET['page']) {
        case 'saveEdit': {
                $sql_check_name = "SELECT user_image AS USERIMAGE FROM cscm_users WHERE user_id ='" . $_GET['id'] . "'";
                $query_check_name = mysqli_query($connection, $sql_check_name);
                $row_check_name = mysqli_fetch_array($query_check_name);

                $sql_num = "SELECT SUBSTRING(user_image,8,11) AS SUBSTRINGNUM FROM cscm_users WHERE user_id ='" . $_GET['id'] . "'";
                $query_check_num = mysqli_query($connection, $sql_num);
                $row_num = mysqli_fetch_array($query_check_num);

                $sql_check = "SELECT SUBSTRING(user_image,1,6) AS SUBSTRING FROM cscm_users WHERE user_id ='" . $_GET['id'] . "'";
                $query_check = mysqli_query($connection, $sql_check);
                $row_check = mysqli_fetch_array($query_check);

                $check = explode(".", $row_check_name['USERIMAGE']);


                //Check Number of Doc_number
                if ($row_check['SUBSTRING'] == substr($check[0], 0, 6)) {
                    $number = intval($row_num['SUBSTRINGNUM']);
                    ++$number;
                    strval($number);
                    if (strlen($number) == 1) {
                        $row_number = "000" . $number;
                        $imageName = $_GET['id'] . "-" . $row_number;
                    } else if (strlen($number) == 2) {
                        $row_number = "00" . $number;
                        $imageName = $_GET['id'] . "-" . $row_number;
                    } else if (strlen($number) == 3) {
                        $row_number = "0" . $number;
                        $imageName = $_GET['id'] . "-" . $row_number;
                    } else if (strlen($number) == 4) {
                        $row_number = $number;
                        $imageName = $_GET['id'] . "-" . $row_number;
                    }
                } else {
                    $imageName = $_GET['id'] . "-0001";
                }


                $path = "./upload/";
                if (isset($_FILES["image"])) {
                    $filename           = $_FILES["image"]["name"];
                    $file_basename      = substr($filename, 0, strripos($filename, '.')); // get file name
                    $file_ext1          = substr($filename, strripos($filename, '.')); // get file extension
                    $filesize           = $_FILES["image"]["size"];
                    $allowed_file_types = array('.png', '.jpg', '.gif', '.svg');
                    if (in_array($file_ext1, $allowed_file_types)) {
                        $newfilename = $imageName . $file_ext1;
                        if (file_exists($path . $newfilename)) {
                            // file already exists error
                            echo "You have already uploaded this file.", "<br>";
                            unlink($path . $newfilename); //delete file
                            move_uploaded_file($_FILES["image"]["tmp_name"], $path . $newfilename);
                            echo "File uploaded replace.";
                        } else {
                            move_uploaded_file($_FILES["image"]["tmp_name"], $path . $newfilename);
                            echo "<p align='center' style='color:green;'>File uploaded successfully.</p>";
                        }
                    } else if (empty($file_basename)) {
                        // file selection error
                        echo "No file to be uploaded.";
                    } else {
                        // file type error
                        echo "Only file type : " . $allowed_file_types . " can be uploaded";
                        unlink($_FILES["insert_draw"]["tmp_name"]);
                    }
                }

                if ($newfilename == null) {
                    $newfilename = $row_check_name['USERIMAGE'];
                }

                $sql_update = "UPDATE cscm_users set
            user_rname='" . $_POST["user_rname"] . "',
            user_rnameth='" . $_POST["user_rnameth"] . "',
            user_lname='" . $_POST["user_lname"] . "',
            user_lnameth='" . $_POST["user_lnameth"] . "',
            user_blood='" . $_POST["user_blood"] . "',
            user_phone='" . $_POST["user_phone"] . "',
            user_email='" . $_POST["user_email"] . "',
            major_id ='" . $_POST["major_id"] . "',
            user_year='" . $_POST["user_year"] . "',
            user_image='" . $newfilename . "'";

                $sql_update .= " where user_id='$_GET[id]'";

                $dbquery = mysqli_query($connection, $sql_update);
                if ($dbquery != null) {
                    echo "<meta http-equiv='refresh' content='0; url=main.php?id=$_GET[id]'>";
                } else {
                    echo "Not insert ";
                }
                break;
            }
        case 'edit': {
                $sql_num = "SELECT SUBSTRING(user_image,8,11) AS SUBSTRINGNUM FROM cscm_users WHERE user_id ='" . $_GET['id'] . "'";
                $query_check_num = mysqli_query($connection, $sql_num);
                $row_num = mysqli_fetch_array($query_check_num);

                $sql_check = "SELECT SUBSTRING(user_image,1,6) AS SUBSTRING FROM cscm_users WHERE user_id ='" . $_GET['id'] . "'";
                $query_check = mysqli_query($connection, $sql_check);
                $row_check = mysqli_fetch_array($query_check);

                $sql_check_name = "SELECT user_image AS USERIMAGE FROM cscm_users WHERE user_id ='" . $_GET['id'] . "'";
                $query_check_name = mysqli_query($connection, $sql_check_name);
                $row_check_name = mysqli_fetch_array($query_check_name);

                $check = explode(".", $row_check_name['USERIMAGE']);
    ?>
                <div class="center menu-card">
                    <div class="row">
                        <div class="col-sm-3 menu-card">
                            <i class="fas fa-bars fa-2x"></i>
                            <div class="mt-5">
                                <div class="row">
                                    <i class="fas fa-user fa-2x col-sm-4"></i>
                                    <div class="font-th col-sm-8 menu_member"><a> ข้อมูลส่วนตัว</a></div>
                                </div>
                                <div class="row mt-4">
                                    <i class="fas fa-user-edit fa-2x col-sm-4"></i>
                                    <div class="font-th col-sm-8 menu_member"><a> แก้ไขข้อมูล</a></div>
                                </div>
                                <div class="row mt-4">
                                    <i class="fas fa-scroll fa-2x col-sm-4"></i>
                                    <div class="font-th col-sm-8 menu_member"><a> ผลการเรียน</a></div>
                                </div>
                                <div class="row mt-4">
                                    <i class="fas fa-cog fa-2x col-sm-4"></i>
                                    <div class="font-th col-sm-8 menu_member"><a> การตั้งค่า</a></div>
                                </div>


                            </div>
                        </div>
                        <div class="col-sm-9">
                            <form action="?page=saveEdit&id=<?php echo $_GET['id']; ?>" method="post" enctype="multipart/form-data">
                                <div class="row mx-2 my-3 align-items-center">
                                    <div class="col-sm-3">
                                        <img src="./upload/<?php if ($row['user_image'] != NULL) {
                                                                echo $row['user_image'];
                                                            } else {
                                                                echo "camera.jpg";
                                                            } ?>" width="150px" height="150px" style="border-radius: 150px; background-color:#463DBC">
                                    </div>
                                    <div class="col-sm-6">
                                        <h3 class="font-en"><?php echo $row['user_rname'] . " " . $row['user_lname'] ?></h3>
                                        <h5 class="font-th"><?php echo $row['user_rnameth'] . " " . $row['user_lnameth'] ?></h5>
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="file" class="font-th" name="image">
                                        <button type="submit" name="submit" class="font-th button-link mt-2">บันทึกข้อมูล</button>
                                    </div>
                                </div>
                                <div class="row mx-4">
                                    <div class="col-sm-5">
                                        <h6 class="font-th">ชื่อจริง</h6>
                                        <input class="student font-th" name="user_rnameth" value="<?php echo $row['user_rnameth'] ?>">
                                        <h6 class="font-en">Name</h6>
                                        <input class="student font-en" name="user_rname" value="<?php echo $row['user_rname'] ?>">
                                        <h6 class="font-en">Email</h6>
                                        <input class="student font-th" name="user_email" value="<?php echo $row['user_email'] ?>">
                                        <h6 class="font-th">กลุ่มเลือด</h6>
                                        <input class="student font-en" name="user_blood" value="<?php echo $row['user_blood'] ?>">
                                        <h6 class="font-th">สาขา</h6>
                                        <input class="student font-th" name="major_id" value="<?php echo $row['major_id'] ?>">

                                    </div>
                                    <div class="col-sm-5">
                                        <h6 class="font-th">นามสกุล</h6>
                                        <input class="student font-th" name="user_lnameth" value="<?php echo $row['user_lnameth'] ?>">
                                        <h6 class="font-en">Last Name</h6>
                                        <input class="student font-en" name="user_lname" value="<?php echo $row['user_lname'] ?>">
                                        <h6 class="font-th">เบอร์โทรศัพท์</h6>
                                        <input class="student font-th" name="user_phone" value="<?php echo $row['user_phone'] ?>">
                                        <h6 class="font-th">อยู่ระดับชั้นปีที่</h6>
                                        <input class="student font-th" name="user_year" value="<?php echo $row['user_year'] ?>">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php break;
            }
        default: { ?>
                <div class="center menu-card">
                    <div class="row">
                        <div class="col-sm-3 menu-card">
                            <i class="fas fa-bars fa-2x"></i>
                            <div class="mt-5">
                                <div class="row">
                                    <i class="fas fa-user fa-2x col-sm-4"></i>
                                    <div class="font-th col-sm-8 menu_member"><a> ข้อมูลส่วนตัว</a></div>
                                </div>
                                <div class="row mt-4">
                                    <i class="fas fa-user-edit fa-2x col-sm-4"></i>
                                    <div class="font-th col-sm-8 menu_member"><a> แก้ไขข้อมูล</a></div>
                                </div>
                                <div class="row mt-4">
                                    <i class="fas fa-scroll fa-2x col-sm-4"></i>
                                    <div class="font-th col-sm-8 menu_member"><a> ผลการเรียน</a></div>
                                </div>
                                <div class="row mt-4">
                                    <i class="fas fa-cog fa-2x col-sm-4"></i>
                                    <div class="font-th col-sm-8 menu_member"><a> การตั้งค่า</a></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-9">
                            <div class="row mx-2 my-3 align-items-center">
                                <div class="col-sm-3">
                                    <img src="./upload/<?php if ($row['user_image'] != NULL) {
                                                            echo $row['user_image'];
                                                        } else {
                                                            echo "camera.jpg";
                                                        } ?>" width="150px" height="150px" style="border-radius: 150px; background-color:#463DBC">
                                </div>
                                <div class="col-sm-6">
                                    <h3 class="font-en"><?php echo $row['user_rname'] . " " . $row['user_lname'] ?></h3>
                                    <h5 class="font-th"><?php echo $row['user_rnameth'] . " " . $row['user_lnameth'] ?></h5>
                                </div>
                                <div class="col-sm-3">
                                    <button onclick="location.href='?page=edit&id=<?php echo $_GET['id'] ?>'" class="font-th button-link">แก้ไขข้อมูล</button>
                                </div>
                            </div>
                            <div class="row mx-4">
                                <div class="col-sm-5">
                                    <h6 class="font-th">ชื่อจริง</h6>
                                    <input readonly class="student font-th" value="<?php echo $row['user_rnameth'] ?>">
                                    <h6 class="font-en">Name</h6>
                                    <input readonly class="student font-th" value="<?php echo $row['user_rname'] ?>">
                                    <h6 class="font-en">Email</h6>
                                    <input readonly class="student font-th" value="<?php echo $row['user_email'] ?>">
                                    <h6 class="font-th">กลุ่มเลือด</h6>
                                    <input readonly class="student font-th" value="<?php echo $row['user_blood'] ?>">
                                    <h6 class="font-th">สาขา</h6>
                                    <input readonly class="student font-th" value="<?php echo $row['major_id'] ?>">

                                </div>
                                <div class="col-sm-5">
                                    <h6 class="font-th">นามสกุล</h6>
                                    <input readonly class="student font-th" value="<?php echo $row['user_lnameth'] ?>">
                                    <h6 class="font-en">Last Name</h6>
                                    <input readonly class="student font-th" value="<?php echo $row['user_lname'] ?>">
                                    <h6 class="font-th">เบอร์โทรศัพท์</h6>
                                    <input readonly class="student font-th" value="<?php echo $row['user_phone'] ?>">
                                    <h6 class="font-th">อยู่ระดับชั้นปีที่</h6>
                                    <input readonly class="student font-th" value="<?php echo $row['user_year'] ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
    <?php } ?>

</body>
<style>
    .menu_member:hover {
        text-decoration: none;
        background-color: #463DBC;
        color: white;

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

    h6 {
        font-size: 13px;
        color: #666666;
    }

    input.student {
        text-align: center;
        margin-bottom: 20px;
        height: 45px;
        width: 250px;
        border-radius: 5px;
        border: none;
        background-color: #c0c0c0;
    }

    .button-link {
        border: none;
        border-radius: 20px;
        height: 40px;
        width: 150px;
        background-color: #463DBC;
        color: white;
    }

    .button-link:hover {
        background-color: #7c75d2;
    }

    i {
        color: #463DBC;
    }

    .menu-card {
        height: 100%;
        border-right: 5px solid #c0c0c0;
    }

    .center {
        box-shadow: 0px 2px 30px 3px rgba(102, 102, 102, 0.37);
        border-radius: 30px;
        width: 90%;
        height: 100%;
        padding: 30px;
        position: absolute;
        top: 70%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: white;
    }

    .card {
        align-items: center;
        background-color: white;
        width: 60%;
        height: 100%;
    }

    body {
        background-color: #FFE665;
    }
</style>
<script>
    function onLoadSelectPage(){
        document.getElementById('homePage').disabled = true;
        document.getElementById('subjectPage').disabled = false;
        document.getElementById('studentPage').disabled = false;
        document.getElementById('activityPage').disabled = false;
        document.getElementById('teacherPage').disabled = false;
    }
</script>
<?php include "footer.php"; ?>