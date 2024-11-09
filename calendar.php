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
        margin:auto;
        /* background: rgb(<?rand(50,250);?>,<?rand(50,250);?>,<?rand(50,250);?>); */
    }
    td{
        padding: 5px 10px; /* 單元格內的邊距 */
        text-align:center; /* 文字居中 */
        border:1px solid #999; /* 邊框顏色 */
        width: 65px;
    }
    .holiday{
        background: pink; /* 假日的背景顏色 */
        color: red; /* 假日的文字顏色 */
    }
    .grey-text{
        color: #999; /* 非當月日期的文字顏色 */
    }
    .today{
        background: blue; /* 今天的背景顏色 */
        color: white; /* 今天的文字顏色 */
        font-weight:bolder; /* 加粗字體 */
    }
    .nav{
        width: 686px;
        margin:auto;
    }
    .nav table td{
        border:0px;
        padding:0;
    }
</style>

</table>


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

// 計算前一個月和前一年的月份
if($month-1<1){
    $prevMonth=12;
    $prevYear=$year-1;
}else{
    $prevMonth=$month-1;
    $prevYear=$year;
}

// 計算下一個月和後一年的月份
if($month+1>12){
    $nextMonth=1;
    $nextYear=$year+1;
}else{
    $nextMonth=$month+1;
    $nextYear=$year;
}

// 計算前一年與後一年
$prevYearMonth = $year - 1;
$nextYearMonth = $year + 1;

$spDate=[
'2024-11-07'=>"立冬",
'2024-06-10' => "端午節",
'2024-09-17' => "中秋節",
'2025-05-31' => "端午節",
'2025-10-06' => "中秋節",
'2026-06-19' => "端午節",
'2026-09-25' => "中秋節",
'2024-11-22'=>"小雪"
];

$holidays = [
'01-01' => "元旦",
'02-10' => "農曆新年",
'04-04' => "兒童節",
'04-05' => "清明節",
'05-01' => "勞動節",
'10-10' => "國慶日",
];

?>
<div class='nav'>
    <table style="width:100%">
        <tr>
            <td style='text-align:left'>
                <!-- <a href="calendar.php?year=<?=$year-2;?>">前年</a> -->
                <a href="calendar.php?year=<?=$prevYearMonth;?>&month=<?=$month;?>">前一年</a>
                <a href="calendar.php?year=<?=$prevYear;?>&month=<?=$prevMonth;?>">上一個月</a>
    </td>
    <td>
        <?php echo "{$year}年 {$month}月";?>
    </td>
    <td style='text-align:right'>
        <a href="calendar.php?year=<?=$nextYear;?>&month=<?=$nextMonth;?>">下一個月</a>
        <!-- <a href="calendar.php?year=<?=$year+1;?>">明年</a> -->
        <a href="calendar.php?year=<?=$nextYearMonth;?>&month=<?=$month;?>">後一年</a>
    </td>
</tr>
</table>
</div>
<table>
<tr>
    <!-- <td></td> -->
    <td>日</td>
    <td>一</td>
    <td>二</td>
    <td>三</td>
    <td>四</td>
    <td>五</td>
    <td>六</td>
</tr>

<?php

$firstDay="{$year}-{$month}-1"; // 當月的第一天
/* $firstDay=date("Y-m-1"); */
$firstDayTime=strtotime($firstDay); // 將第一天轉換成時間戳
$firstDayWeek=date("w",$firstDayTime); // 獲取第一天是星期幾

for($i=0;$i<6;$i++){
    echo "<tr>"; // 開始一行
    // echo "<td>";
    // echo $i+1; //顯示週數
    // echo "</td>";
    for($j=0;$j<7;$j++){
        //echo "<td class='holiday'>";
        // 計算這個格子中的日期
        $cell=$i*7+$j -$firstDayWeek;
        $theDayTime=strtotime("$cell days".$firstDay);

        //所需樣式css判斷（假日、非當月等）
        $theMonth=(date("m",$theDayTime)==date("m",$firstDayTime))?'':'grey-text';
        $isToday=(date("Y-m-d",$theDayTime)==date("Y-m-d"))?'today':'';
        $w=date("w",$theDayTime);
        $isHoliday=($w==0 || $w==6)?'holiday':'';
        
        //顯示日期
        echo "<td class='$isHoliday $theMonth $isToday'>";
        echo date("d",$theDayTime); 

        //如果有特定日期程式撰寫
        if(isset($spDate[date("Y-m-d",$theDayTime)])){
            echo "<br>{$spDate[date("Y-m-d",$theDayTime)]}";
        }

        //國定假日程式撰寫(如果想要改成不同顏色，要再上面新增CSS判斷)
        //目前是農曆的節日要再另外設計
        if(isset($holidays[date("m-d",$theDayTime)])){
            echo "<br>{$holidays[date("m-d",$theDayTime)]}";
        }


        echo "</td>";
        
    }
    echo "</tr>"; // 結束一行
}

?>

</table>


</html>