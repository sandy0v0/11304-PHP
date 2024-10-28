<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>萬年曆</title>
</head>
<body>
    <h1>萬年曆</h1>    
</body>

<style>
    table {
        border-collapse:collapse; /* 使邊框合併 */
    }
    td{
        padding: 5px 10px; /* 單元格內的邊距 */
        text-align:center; /* 文字居中 */
        border:1px solid #999; /* 邊框顏色 */
    }
    .holiday{
        background: pink; /* 假日的背景顏色 */
        color: #999; /* 假日的文字顏色 */
    }
    .grey-text{
        color: #999; /* 非當月日期的文字顏色 */
    }
    .today{
        background: blue; /* 今天的背景顏色 */
        color: white; /* 今天的文字顏色 */
        font-weight:bolder; /* 加粗字體 */
    }

</style>

</table>


<ul>
    <li>有上一個月下一個月的按鈕</li>
    <li>萬年曆都在同一個頁面同一個檔案</li>
    <li>有前年和來年的按鈕</li>
</ul>

<ul>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
</ul>
<?php

if(isset($_GET['month'])){
    $month=$_GET['month']; // 如果有指定月份，使用它
}else{
    $month=date("m"); // 否則使用當前月份
}

if (isset($_GET['year'])) {
    $year = $_GET['year'];
} else {
    $year = date("Y");
}

if($month-1<1){
    $prevMonth=12;
    $prevYear=$year-1;
}else{
    $prevMonth=$month-1;
    $prevYear=$year;
}


if($month+1>12){
    $nextMonth=1;
    $nextYear=$year+1;
}else{
    $nextMonth=$month+1;
    $nextYear=$year;
}


?>

<a href="calendar.php?year=<?=$year-2;?>">前年</a>
<a href="calendar.php?year=<?=$prevYear;?>&month=<?=$prevMonth;?>">上一個月</a>
<a href="calendar.php?year=<?=$nextYear;?>&month=<?=$nextMonth;?>">下一個月</a>
<a href="calendar.php?year=<?=$year+1;?>">明年</a>
<h3><?php echo "{$year}年 {$month}月";?></h3>

<table>
<tr>
    <td></td>
    <td>日</td>
    <td>一</td>
    <td>二</td>
    <td>三</td>
    <td>四</td>
    <td>五</td>
    <td>六</td>
</tr>

<?php

$firstDay="2024-{$month}-1"; // 當月的第一天
/* $firstDay=date("Y-m-1"); */
$firstDayTime=strtotime($firstDay); // 將第一天轉換成時間戳
$firstDayWeek=date("w",$firstDayTime); // 獲取第一天是星期幾

for($i=0;$i<6;$i++){
    echo "<tr>"; // 開始一行
    echo "<td>";
    echo $i+1;
    echo "</td>";
    for($j=0;$j<7;$j++){
        //echo "<td class='holiday'>";
        // 計算這個格子中的日期
        $cell=$i*7+$j -$firstDayWeek;
        $theDayTime=strtotime("$cell days".$firstDay);

        //所需樣式css判斷
        $theMonth=(date("m",$theDayTime)==date("m",$firstDayTime))?'':'grey-text';
        $isToday=(date("Y-m-d",$theDayTime)==date("Y-m-d"))?'today':'';
        $w=date("w",$theDayTime);
        $isHoliday=($w==0 || $w==6)?'holiday':'';
        
        echo "<td class='$isHoliday $theMonth $isToday'>";
        echo date("d",$theDayTime); //顯示日期
        echo "</td>";
        
    }
    echo "</tr>"; // 結束一行
}

?>

</table>


</html>