<?php
session_start();
include 'db_io.php';

function get_total_all_records()
{

  include 'db_io.php';
  $statement1 = $connection->prepare("SELECT * FROM cscm_users");
  $statement1->execute();

  return $statement1->rowCount();
}

$query   = '';
$output  = array();


$query .= "SELECT * FROM cscm_users WHERE 1 AND user_auth ='Student'";



if ($_POST["search"]["value"] != "") {
  $query .= 'AND(user_id LIKE "%' . $_POST["search"]["value"] . '%"';
  $query .= 'OR user_rname LIKE "%' . $_POST["search"]["value"] . '%"';
  $query .= 'OR user_lname LIKE "%' . $_POST["search"]["value"] . '%"';
  $query .= 'OR user_rnameth LIKE "%' . $_POST["search"]["value"] . '%"';
  $query .= 'OR user_year LIKE "%' . $_POST["search"]["value"] . '%"';
  $query .= 'OR user_lnameth LIKE "%' . $_POST["search"]["value"] . '%")';
}

## Custom Field value
$searchByMajor   = $_POST["searchByMajor"];
$searchByYear = $_POST['searchByYear'];


if ($searchByMajor != '') {
  $query .= ' AND ( major_id LIKE "%' . $searchByMajor . '%" ) ';
}

if ($searchByYear != '') {
  $query .= ' AND ( user_year LIKE "%' . $searchByYear . '%" )';
}



$statement = $connection->prepare($query);
$statement->execute();
$result        = $statement->fetchAll();
$data          = array();
$filtered_rows = $statement->rowCount();

foreach ($result as $row) {


  $sub_array = array();

  if ($_SESSION['auth'] == "Teacher") {

    $sub_array[] = '<button type="button" name="update" id="' . $row["user_id"] . '" class="btn btn-success btn-sm update" onclick="location.href=main.php">Edit</button>';
  } else {

    $sub_array[] = '<button type="button" name="noupdate" id="' . $row["user_id"] . '" class="btn btn-secondary btn-sm noupdate"></button>';
  }

  $sub_array[] = $row["user_id"];
  $sub_array[] = $row["user_rnameth"] . " " . $row["user_lnameth"];

  $data[] = $sub_array;
}
$output = array(
  "recordsTotal"    => $filtered_rows,
  "recordsFiltered" => get_total_all_records(),
  "data"            => $data,
);
echo json_encode($output);
