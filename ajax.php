<?php

## Include DB Connection
include 'config.php';
$table = 'posts';

## Data layer
$draw = $_POST['draw'];
$row = $_POST['start'];
$rowperpage = $_POST['length']; // rows display per page

$columnIndex = $_POST['order'][0]['column']; // Column Index
$columnName = $_POST['columns'][$columnIndex]['data'];
$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc

$searchValue = mysqli_real_escape_string($con, $_POST['search']['value']); // Search value

## Search Query
$searchQuery = "";

if(!empty($searchValue)) {
    $searchQuery = " and (author_id like %{$searchValue}% or title like %{$searchValue}%) ";
}

## Number of records without filter
$sel = mysqli_query($con, "SELECT count(*) as allcount FROM {$table} ");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

## Number of records with filter
$sel = mysqli_query($con, "SELECT count(*) as allcount FROM {$table} WHERE 1 {$searchQuery}");
$records = mysqli_fetch_assoc($sel);
$totalRecordsFiltered = $records['allcount'];

## Fetch Records
$query = mysqli_query($con, "SELECT * FROM {$table} WHERE 1 {$searchQuery} ORDER BY {$columnName} {$columnSortOrder} LIMIT {$row},{$rowperpage}");
$data = array();

while($result = mysqli_fetch_assoc($query)){
    $data[] = array(
        "id"=>$result['id'],
        "author_id"=>$result['author_id'],
        "title"=>$result['title'],
        "content"=>$result['content'],
        "description"=>$result['description'],
        "date"=>$result['date']
    );
}

## Response Body
$response = array(
    "draw"=>intval($draw),
    "iTotalRecords"=>$totalRecords,
    "iTotalDisplayRecords"=>$totalRecordsFiltered,
    "aaData"=>$data
);

echo json_encode($response);
