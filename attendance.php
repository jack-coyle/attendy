<html>
<head>
<title>Attendance Listing</title>
</head>
<body>
<table>
<tr>
<th>Date</th>
<th>Name</th>
<th>SID</th>
</tr>
<?php
$attendance = json_decode(file_get_contents("./attendance.php"), true);
$days = array();
foreach ($attendance as $key => $value) {
    foreach ($value as $record) {
    echo "<tr><td>"+$key+'</td><td>'+$record['name']+'</td><td>'+$record['sid']+'</td></tr>';
    }
}
?>
</table>
</body>
</html>
