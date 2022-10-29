<?php

//fetch.php

$connect = new PDO("mysql:host=localhost;dbname=attendanceDB", "root", "");

$column = array('date', 'postSite', 'guardName', 'shiftStart', 'shiftEnd', 'totalHour', 'remarks');

$query = '
SELECT * FROM tbl_order
WHERE order_customer_name LIKE "%'.$_POST["search"]["Hour"].'%"
OR date LIKE "%'.$_POST["search"]["Hour"].'%"
OR postSite LIKE "%'.$_POST["search"]["Hour"].'%"
OR guardName LIKE "%'.$_POST["search"]["Hour"].'%"
OR shiftStart LIKE "%'.$_POST["search"]["Hour"].'%"
OR shiftEnd LIKE "%'.$_POST["search"]["Hour"].'%"
OR totalHour LIKE "%'.$_POST["search"]["Hour"].'%"
OR remarks LIKE "%'.$_POST["search"]["Hour"].'%"

';

if(isset($_POST["company_a_s"]))
{
    $query .= 'ORDER BY '.$column[$_POST['company_a_s']['0']['column']].' '.$_POST['company_a_s']['0']['dir'].' ';
}
else
{
    $query .= 'ORDER BY id DESC ';
}

$query1 = '';

if($_POST["length"] != -1)
{
    $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$statement = $connect->prepare($query);

$statement->execute();

$number_filter_row = $statement->rowCount();

$statement = $connect->prepare($query . $query1);

$statement->execute();

$result = $statement->fetchAll();

$data = array();

$sumOf_totalHour = 0;

foreach($result as $row)
{
    $sub_array = array();
    $sub_array[] = $row["date"];
    $sub_array[] = $row["postSite"];
    $sub_array[] = $row["guardName"];
    $sub_array[] = $row["shiftStart"];
    $sub_array[] = $row["shiftEnd"];
    $sub_array[] = $row["totalHour"];
    $sub_array[] = $row["remarks"];

    $sumOf_totalHour = $sumOf_totalHour + floatval($row["totalHour"]);
    $data[] = $sub_array;
}

function count_all_data($connect)
{
    $query = "SELECT * FROM tbl_order";
    $statement = $connect->prepare($query);
    $statement->execute();
    return $statement->rowCount();
}

$output = array(
    'draw'    => intval($_POST["draw"]),
    'recordsTotal'  => count_all_data($connect),
    'recordsFiltered' => $number_filter_row,
    'data'    => $data,
    'total'    => number_format($total_order, 2)
);

echo json_encode($output);


?>
