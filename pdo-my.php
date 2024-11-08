<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>資料庫連線</title>
    <style>
        table {
            width: 80%;
            border-collapse: collapse;
            margin: auto;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f4f4f4;
        }

    </style>


</head>
<body>
<h1>資料庫連線</h1>
<?php


$dsn="mysql:host=localhost;charset=utf8;dbname=school";
$pdo=new PDO($dsn,'root','');

$sql="select * from classes";

$rows=$pdo->query($sql)->fetchall(PDO::FETCH_ASSOC);

foreach($rows as $row){
    echo $row['id']."-".$row['name']."-".$row['tutor']."<br>";
}


// echo "<pre>";
// print_r($rows);
// echo "</pre>";


?>
<br>

<?php

$dsn = "mysql:host=localhost;charset=utf8;dbname=school";
$pdo = new PDO($dsn, 'root', '');

$sql = "SELECT * FROM classes";

$rows = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

if (count($rows) > 0) {
    // 顯示資料表格
    echo "<table>";
    echo "<thead><tr><th>ID</th><th>Class Name</th><th>Tutor</th></tr></thead>";
    echo "<tbody>";
    
    foreach ($rows as $row) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['id']) . "</td>";
        echo "<td>" ."<a href=classes_detail.php?id=".$row['code'].">".htmlspecialchars($row['name']) ;
        echo "</td>";
        echo "<td>" . htmlspecialchars($row['tutor']) . "</td>";
        echo "</tr>";
    }
    
    echo "</tbody>";
    echo "</table>";

    echo "<pre>";
    print_r($rows);
    echo "</pre>";



} else {
    echo "<p>No data found</p>";
}

?>
    
</body>
</html>