<?php
include 'header.php';
include 'connectdb.php';
?>
<div class="container-fluid">

    <div align="center" class="mt-5" style="font-size: 25px;color:#1c29b5;">เพิ่มผู้ใช้งาน</div>

    <?php switch (@$_GET['page']) {

        case 'delete': {
                $sql     = "delete from cscm_users where user_id='$_GET[id]'";
                $dbquery = mysqli_query($connection, $sql);
                echo "<meta http-equiv='refresh' content='0; url=manage_cscm_persons.php'>";
                break;
            }

        case 'saveedit': {


                $sql = "UPDATE cscm_users set
          user_name='" . $_POST["user_name"] . "',
          user_password= AES_ENCRYPT('" . $_POST["user_password"] . "','ACL4064'),
          user_rname='" . $_POST["user_rname"] . "',
          user_lname='" . $_POST["user_lname"] . "',
          user_rnameth='" . $_POST["user_rnameth"] . "',
          user_lnameth='" . $_POST["user_lnameth"] . "',
          user_DoB='" . $_POST["user_DoB"] . "',
          user_address ='" . $_POST["user_address"] . "' ,
          user_blood='" . $_POST["user_blood"] . "',
          user_gender='" . $_POST["user_gender"] . "',
          user_phone='" . $_POST["user_phone"] . "',
          user_email='" . $_POST["user_email"] . "',
          major_id ='" . $_POST["major_id"] . "',
          user_auth='" . $_POST["user_auth"] . "'";

                $sql .= " where user_id='$_GET[id]'";

                $dbquery = mysqli_query($connection, $sql);
                echo "<meta http-equiv='refresh' content='0; url=manage_cscm_persons.php'>";
                break;
            }

        case 'edit': {

                $sql    = "SELECT * FROM cscm_users WHERE user_id ='$_GET[id]'";
                $query  = mysqli_query($connection, $sql);
                $result = mysqli_fetch_array($query);

                $sql_aes    = "select AES_DECRYPT('" . $result['user_password'] . "','ACL4064') AS PASS";
                $query_aes  = mysqli_query($connection, $sql_aes);
                $result_aes = mysqli_fetch_array($query_aes);

    ?>
                <form action="?page=saveedit&id=<?php echo $_GET['id']; ?>" method="post" id="demo-form2" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <label class="control-label">Username :</label>
                            <div>
                                <input type="text" class="form-control" name="user_name" value="<?php echo $result['user_name']; ?>">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">

                            <label class="control-label">Sur Name :</label>
                            <div>
                                <input type="text" class="form-control" value="<?php echo $result['user_rname']; ?>" name="user_rname">
                            </div>

                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <label class="control-label">Last Name:</label>
                            <div>
                                <input type="text" class="form-control" value="<?php echo $result['user_lname']; ?>" name="user_lname">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <label class="control-label">Address:</label>
                            <div><input type="text" class="form-control" name="user_address"></div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">

                            <label class="control-label">Sur Name TH:</label>
                            <div>
                                <input type="text" class="form-control" value="<?php echo $result['user_rnameth']; ?>" name="user_rnameth">
                            </div>

                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <label class="control-label">Last Name TH:</label>
                            <div>
                                <input type="text" class="form-control" value="<?php echo $result['user_lnameth']; ?>" name="user_lnameth">
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <label class="control-label">Date Of Birth :</label>
                            <div>
                                <input type="date" class="form-control" name="user_DoB">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <label class="control-label">Gender :</label>
                            <select class="custom-select" name="user_gender">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <label class="control-label">Blood :</label>
                            <div>
                                <input type="text" class="form-control" name="user_blood" value="<?php echo $result['user_blood']; ?>">
                            </div>
                        </div>
                    </div>


                    <div class="row">

                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <label class="control-label">Phone : </label>
                            <div>
                                <input type="text" class="form-control" value="<?php echo $result['user_phone']; ?>" name="user_phone">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <label class="control-label">Email : </label>
                            <div>
                                <input type="text" class="form-control" value="<?php echo $result['user_email']; ?>" name="user_email">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <label class="control-label">Auth :</label>
                            <select class="form-control" name="user_auth">
                                <option <?php if($result['user_auth'] =="Student") {?> selected <?php } ?>>Student</option>
                                <option <?php if($result['user_auth'] =="Teacher") {?> selected <?php } ?>>Teacher</option>
                            </select>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <label class="control-label">User Name : </label>
                            <div>
                                <input type="text" class="form-control" value="<?php echo $result['user_name']; ?>" name="user_customer">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <label class="control-label">Password :</label>
                            <div>
                                <input type="text" class="form-control" name="user_password" value="<?php echo $result_aes['PASS']; ?>">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <label class="control-label">Major:</label>
                            <?php
                            $sql_major = "SELECT * FROM cscm_majors";
                            $query_major = mysqli_query($connection, $sql_major);

                            ?>
                            <select class="custom-select" name="major_id">
                                <?php while ($row_major = mysqli_fetch_array($query_major)) { ?>
                                    <option value="<?php echo $row_major['major_id']; ?>"><?php echo $row_major['major_id']; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                    </div>


                    <div class="row mt-4">
                        <div class="col-md-12 col-sm-12 col-xs-12 my-auto text-center">
                            <button type="submit" name="manage_cscm_persons.php" class="btn btn-success">Submit</button>&nbsp;
                            <button type="reset" class="btn btn-primary">Clear</button>&nbsp;
                            <button type="button" class="btn btn-warning" onclick="history.back();">Cancel</button>
                        </div>
                    </div>

                </form>

            <?php break;
            }

        case 'add': {

                $sql     = "INSERT INTO `cscm_users` 
                (`user_id`, 
                `user_name`, 
                `user_password`, 
                `user_rname`, 
                `user_rnameth`, 
                `user_lname`, 
                `user_lnameth`, 
                `user_DoB`, 
                `user_address`, 
                `user_blood`, 
                `user_gender`, 
                `user_phone`, 
                `user_email`, 
                `major_id`, 
                `user_auth`) 
                VALUES 
                ('" . $_POST['user_name'] . "', 
                '" . $_POST['user_name'] . "', 
                '" . $_POST['user_password'] . "', 
                '" . $_POST['user_rname'] . "',
                '" . $_POST['user_rnameth'] . "',
                '" . $_POST['user_lname'] . "', 
                '" . $_POST['user_lnameth'] . "',
                '" . $_POST['user_DoB'] . "', 
                '" . $_POST['user_address'] . "', 
                '" . $_POST['user_blood'] . "', 
                '" . $_POST['user_gender'] . "', 
                '" . $_POST['user_phone'] . "', 
                '" . $_POST['user_email'] . "',
                '" . $_POST['major_id'] . "', 
                '" . $_POST['user_auth'] . "');";
                $dbquery = mysqli_query($connection, $sql);
                if ($dbquery != Null) {
                    echo "";
                    echo "<meta http-equiv='refresh' content='0; url=manage_cscm_persons.php'>";
                } else {
                    echo "NOT INSERT";
                }

                break;
            }

        case 'new': { ?>

                <form action="?page=add" method="post" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <label class="control-label">Sur Name :</label>
                            <div>
                                <input type="text" class="form-control" name="user_rname">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <label class="control-label">Last Name :</label>
                            <div>
                                <input type="text" class="form-control" name="user_lname">
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <label class="control-label">Auth:</label>
                            <select class="custom-select" name="user_auth">
                                <option value="Student">Student</option>
                                <option value="Teacher">Teacher</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4">
                            <label class="control-label">Sur Name TH:</label>
                            <div>
                                <input type="text" class="form-control" name="user_rnameth">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <label class="control-label">Last Name TH:</label>
                            <div>
                                <input type="text" class="form-control" name="user_lnameth">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <label class="control-label">Date Of Birth :</label>
                            <div>
                                <input type="date" class="form-control" name="user_DoB">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <label class="control-label">Gender :</label>
                            <select class="custom-select" name="user_gender">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <label class="control-label">Blood :</label>
                            <div>
                                <input type="text" class="form-control" name="user_blood">
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <label class="control-label">Mobile:</label>
                            <div><input type="text" class="form-control" name="user_phone"></div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <label class="control-label">Address:</label>
                            <div><input type="text" class="form-control" name="user_address"></div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <label class="control-label">Email:</label>
                            <div><input type="text" class="form-control" name="user_email"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <label class="control-label">Username:</label>
                            <div><input type="text" class="form-control" name="user_name"></div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <label class="control-label">Password:</label>
                            <div><input type="text" class="form-control" name="user_password"></div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <label class="control-label">Major:</label>
                            <?php
                            $sql_major = "SELECT * FROM cscm_majors";
                            $query_major = mysqli_query($connection, $sql_major);

                            ?>
                            <select class="custom-select" name="major_id">
                                <?php while ($row_major = mysqli_fetch_array($query_major)) { ?>
                                    <option value="<?php echo $row_major['major_id']; ?>"><?php echo $row_major['major_id']; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4"></div>
                        <div class="col-lg-4 col-md-4 col-sm-4"></div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12 col-sm-12 col-xs-12 my-auto text-center">
                            <button type="submit" name="submit" class="btn btn-success">Submit</button>&nbsp;
                            <button type="reset" class="btn btn-primary">Clear</button>&nbsp;
                            <button type="button" class="btn btn-warning" onclick="history.back();">Cancel</button>
                        </div>
                    </div>
                </form>
            <?php break;
            }

        case 'detail': {

                $sql    = "select * from cscm_users where user_id='$_GET[id]'";
                $query  = mysqli_query($connection, $sql);
                $result = mysqli_fetch_array($query);


            ?>
                <table class="table table-striped table-bordered nowrap" cellspacing="0" width="100%">
                    <tr>

                        <th width="40%">Sur Name :</th>
                        <th width="40%">Last Name :</th>
                        <th width="40%">Password :</th>
                    </tr>
                    <tr>

                        <td><?php echo $result['user_rname']; ?></td>
                        <td><?php echo $result['user_lname']; ?></td>
                        <td><?php echo $result['user_password']; ?></td>
                    </tr>


                    <tr>

                        <th width="40%">Phone :</th>
                        <th width="40%">Email :</th>
                        <th width="20%">User Name :</th>
                    </tr>
                    <tr>

                        <td><?php echo $result['user_phone']; ?></td>
                        <td><?php echo $result['user_email']; ?></td>
                        <td><?php echo $result['user_name']; ?></td>
                    </tr>

                    <tr>
                        <th width="20%">Username</th>
                        <th width="40%">Password</th>
                        <th width="40%">Auth</th>
                    </tr>
                    <tr>
                        <td><?php echo $result['user_name']; ?></td>
                        <td><?php echo $result['user_password']; ?></td>
                        <td><?php echo $result['user_auth']; ?></td>
                    </tr>




                </table>

                <div class="row mt-4">
                    <div class="col-md-12 col-sm-12 col-xs-12 my-auto text-center">
                        <button type="button" class="btn btn-success" onclick="javascript:location.href='?page=edit&id=<?php echo $result['user_id']; ?>'">Edit</button>&nbsp;
                        <button type="button" class="btn btn-warning" onclick="history.back();">Back</button>
                        <a href="?page=delete&id=<?php echo $result['user_id']; ?>" onClick="javascript:return confirm('CONFIRM DELETE');"><i class="fas fa-trash" style="font-size:30px;color:red;vertical-align: middle;"></i></a>
                    </div>
                </div>

            <?php break;
            }

        default: {
            ?>

                <div class="row mt-2">
                    <div class="col-lg-3 text-left">
                        <div><button type="button" class="btn btn-success btn-block" onclick="javascript:location.href='?page=new'">Add</button></div>
                    </div>
                    <div class="col-lg-6"></div>

                </div>

                <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>User Nname</th>
                            <th>Sur Name </th>
                            <th>Last Name </th>
                            <th>Auth</th>
                            <th>Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql_users   = "select * from cscm_users order by user_id asc";
                        $query_users = mysqli_query($connection, $sql_users);
                        $n           = 0;
                        while ($result_users = mysqli_fetch_array($query_users)) {
                            $n++;
                        ?>
                            <tr href="?page=detail&id=<?php echo $result_users['user_id']; ?>">
                                <td onclick="location.href = 'manage_cscm_persons.php?page=detail&id=<?php echo $result_users['user_id']; ?>'"><?php echo $n; ?></td>
                                <td onclick="location.href = 'manage_cscm_persons.php?page=detail&id=<?php echo $result_users['user_id']; ?>'"><?php echo $result_users['user_name']; ?></td>
                                <td onclick="location.href = 'manage_cscm_persons.php?page=detail&id=<?php echo $result_users['user_id']; ?>'"><?php echo $result_users['user_rname']; ?></td>
                                <td onclick="location.href = 'manage_cscm_persons.php?page=detail&id=<?php echo $result_users['user_id']; ?>'"><?php echo $result_users['user_lname']; ?></td>
                                <td onclick="location.href = 'manage_cscm_persons.php?page=detail&id=<?php echo $result_users['user_id']; ?>'"><?php echo $result_users['user_auth']; ?></td>
                                <td onclick="location.href = 'manage_cscm_persons.php?page=detail&id=<?php echo $result_users['user_id']; ?>'"><?php echo $result_users['user_address']; ?></td>
                            </tr>
                        <?php } ?>

                    </tbody>
                </table>

    <?php }
    } ?>

</div>

<script>
    function OnchangeAuth() {
        let check = document.getElementById('user_auth').value;
        if (check == 'Master') {
            document.getElementById('user_customer').hidden = true;
            document.getElementById('user_customer_input').hidden = true;
        } else if (check == 'Engineer') {
            document.getElementById('user_customer').hidden = true;
            document.getElementById('user_customer_input').hidden = true;
        } else if (check == 'Customer') {
            document.getElementById('user_customer').hidden = false;
            document.getElementById('user_customer_input').hidden = false;
        }

    }
</script>
<?php include "footer.php"; ?>