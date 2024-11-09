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
        width: 650px;
        height: 70px;
        /* border-collapse:collapse; 使邊框合併 */
        margin:auto;
        /* background: rgb(<?rand(50,250);?>,<?rand(50,250);?>,<?rand(50,250);?>); */
    }

    th {
    font-size: 20px; /* 調整星期標題的字體大小 */
    padding: 15px 0; /* 調整星期標題的內邊距 */
    }

    td{
        width: 90px;
        height: 50px;
        padding: 10px 10px; /* 單元格內的邊距 */
        text-align:center; /* 文字居中 */
        border:1px solid #999; /* 邊框顏色 */
        border-radius: 20%;  /* 使日期框變圓形 */
        font-size: 18px;  /* 調整日期框字體大小 */
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

    .today-button {
    text-align: 150px  ; /* 設定容器的樣式，使按鈕居中顯示 */
    }

    /* 設定按鈕的樣式 */
    .today-link {
    padding: 5px 10px; /* 按鈕的內邊距，上下5px，左右10px */
    background-color: lightblue; /* 按鈕的背景顏色 */
    color: white; /* 按鈕的文字顏色 */
    text-decoration: none; /* 取消超鏈接的下劃線 */
    border-radius: 5px; /* 按鈕的圓角效果 */
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
                <a href="calendar.php?year=<?=$prevYearMonth;?>&month=<?=$month;?>">前年<<</a>
                <a href="calendar.php?year=<?=$prevYear;?>&month=<?=$prevMonth;?>">上個月<</a>
    </td>
    <td>
        <?php echo "{$year}年 {$month}月";?>
    </td>
    <td style='text-align:right'>
        <a href="calendar.php?year=<?=$nextYear;?>&month=<?=$nextMonth;?>">>下個月</a>
        <!-- <a href="calendar.php?year=<?=$year+1;?>">明年</a> -->
        <a href="calendar.php?year=<?=$nextYearMonth;?>&month=<?=$month;?>">>>後年</a>
    </td>
</tr>
</table>
</div>

<!-- 「今天」按鈕 -->
<!-- 設定按鈕的連結，點擊後導向當前月份的日曆頁面 -->
<div class="today-button">
    <a href="calendar.php?year=<?php echo date('Y'); ?>&month=<?php echo date('m'); ?>" class="today-link">
        今天
    </a>
</div>

<table>
<tr>
    <!-- <td></td> -->
    <th>日</th>
    <th>一</th>
    <th>二</th>
    <th>三</th>
    <th>四</th>
    <th>五</th>
    <th>六</th>
</tr>

<?php

 // 計算當月的第一天
$firstDay="{$year}-{$month}-1"; 
/* $firstDay=date("Y-m-1"); */
$firstDayTime=strtotime($firstDay); // 將第一天轉換成時間戳
$firstDayWeek=date("w",$firstDayTime); // 獲取第一天是星期幾

// 逐行顯示每一天
for($i=0;$i<6;$i++){
    echo "<tr>"; 
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
        $isHoliday=($w==0 || $w==6)?'holiday':''; // 假日（星期六和星期天）
        
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