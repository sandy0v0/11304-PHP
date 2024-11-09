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
    body {
    text-align: center ; /* 設定容器的樣式，使按鈕居中顯示 */
    background-image: url('/images/background.PNG'); /* 設定背景圖片 */
    background-size: cover; /* 使圖片覆蓋整個背景 */
    background-position: center; /* 圖片置中 */
    background-repeat: no-repeat; /* 不重複顯示背景圖片 */
    background-attachment: fixed; /* 固定背景圖不隨捲動 */
    }

    /* 設定背景上文字的顏色和樣式，以確保在背景圖上清晰可見 */
    h1 {
        color: lightcoral;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); /* 添加陰影提高可讀性 */
    }

    table {
        width: 700px;
        height: 80px;
        /* border-collapse:collapse; 使邊框合併 */
        margin:auto;        
        /* background: rgb(<?rand(50,250);?>,<?rand(50,250);?>,<?rand(50,250);?>); */
        background-color: rgba(255, 255, 255, 0.9); /* 增加日曆的白色半透明背景 */
        border-radius: 8px;
    }

    th {
    font-size: 18px; /* 調整星期標題的字體大小 */
    padding: 15px 0; /* 調整星期標題的內邊距 */
    }

    td {
        width: 100px;
        height: 50px;
        padding: 10px 10px; /* 單元格內的邊距 */
        text-align:center; /* 文字居中 */
        border:2px solid #999; /* 邊框顏色 */
        border-radius: 25%;  /* 使日期框變圓形 */
        font-size: 22px;  /* 調整日期框字體大小 */
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
        width: 700px;
        margin:auto;
        background-color: rgba(255, 255, 255, 0.8); /* 加入白色半透明背景以強調選單 */
        border-radius: 8px;
        padding: 10px;
    }

    .nav td{
        font-size: 30px;
        border:10px;
        padding:10px 10px;
        text-decoration: none;

    }

    .today-button {
    text-align: center ; /* 設定容器的樣式，使按鈕居中顯示 */
    }

    /* 設定按鈕的樣式 */
    .today-link {
    padding: 10px 245px 10px; /* 按鈕的內邊距 */
    background-color: lightblue; /* 按鈕的背景顏色 */
    color: white; /* 按鈕的文字顏色 */
    text-decoration: none; /* 取消超鏈接的下劃線 */
    border-radius: 20px; /* 按鈕的圓角效果 */
    }

    /* 設定按鈕的樣式 */
    .today-link1 {
    padding: 10px 45px 10px; /* 按鈕的內邊距 */
    /* background-color: lightblue;  */
    background: rgba(255, 150, 113, 0.5);
    color: white; /* 按鈕的文字顏色 */
    text-decoration: none; /* 取消超鏈接的下劃線 */
    border-radius: 20px; /* 按鈕的圓角效果 */
    }

    .sp-date {
    font-size: 12px; /* 特定日期的文字大小 */
    color: #FFA500; /* 特定日期的文字顏色（橙色） */
    font-weight: bold; /* 使文字加粗 */
    }

    .holiday-text {
    padding: bottom;
    font-size: 14px; /* 國定假日的文字大小 */
    color: #FF4500; /* 國定假日的文字顏色（橘紅色） */
    font-style: italic; /* 讓文字傾斜 */
    }

    /* 調整 << 和 >> 的樣式 */
    .nextYear {
        color: #fff;
        background: rgba(255, 199, 95, 0.8);
        border-radius: 50%; /* 設置為圓框 */
        font-size: 24px; /* 調整大小 */
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: auto;
        text-decoration: none;
        font-weight: bold;
    }

    /* 移除底線效果 */
    .nextYear a {
        color: white;
        text-decoration: none;
    }

    /* 調整月份的字體大小 */
    .month {
        color: white;
        font-size: 30px;
        background-color: lightblue;
        /* background: rgba(255, 150, 113, 0.5); */
        border-radius: 20px;
        padding: 10px 20px;
        font-weight: bold;
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
                <a href="calendar.php?year=<?=$prevYearMonth;?>&month=<?=$month;?>"><<</a>
                <br>
                <a href="calendar.php?year=<?=$prevYear;?>&month=<?=$prevMonth;?>"><</a>
            </td>
            <td>
                <?php echo "{$year}年 <br> {$month}月";?>
            </td>
            <td style='text-align:right'>
                <a href="calendar.php?year=<?=$nextYearMonth;?>&month=<?=$month;?>">>></a>
                <br>
                <a href="calendar.php?year=<?=$nextYear;?>&month=<?=$nextMonth;?>">></a>
                <!-- <a href="calendar.php?year=<?=$year+1;?>">明年</a> -->      
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
    <th>SUN &nbsp; 日</th>
    <th>MON &nbsp; 一</th>
    <th>TUE &nbsp; 二</th>
    <th>WED &nbsp; 三</th>
    <th>THU &nbsp; 四</th>
    <th>FRI &nbsp; 五</th>
    <th>SAT &nbsp; 六</th>
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
            echo "<br><span class='sp-date'>{$spDate[date("Y-m-d",$theDayTime)]}</span>";
        }

        //國定假日程式撰寫(如果想要改成不同顏色，要再上面新增CSS判斷)
        //目前是農曆的節日要再另外設計
        if(isset($holidays[date("m-d",$theDayTime)])){
            echo "<br><span class='holiday-text'>{$holidays[date("m-d",$theDayTime)]}</span>";
        }


        echo "</td>";
        
    }
    echo "</tr>"; // 結束一行
}

?>

</table>

<br>
<br>
<br>
<br>
<br>
<br>




<div class='nav'>
    <table style="width:100%">
        <tr>
            <td class="month" rowspan="2" style="font-size: 36px;">
                <?php echo " {$month}月";?>
            </td>      
            <td class="nextYear">
                <a href="calendar.php?year=<?=$prevYearMonth;?>&month=<?=$month;?>">◄◄</a>                              
            </td>
            <td style="font-size: 36px; color: #999; font-weight: bold;">
                <?php echo "{$year}年" ;?>
            </td>
            <td class="nextYear">
                <a href="calendar.php?year=<?=$nextYearMonth;?>&month=<?=$month;?>">►►</a>    
            </td>
        </tr>

        <tr>
        <td style='text-align:left'>
            <a href="calendar.php?year=<?=$prevYear;?>&month=<?=$prevMonth;?>"><</a>
        </td>
        <td class="today-button">
            <a href="calendar.php?year=<?php echo date('Y'); ?>&month=<?php echo date('m'); ?>" class="today-link1">
            今天
            </a>        
        </td>
        <td style='text-align:right'>
            <a href="calendar.php?year=<?=$nextYear;?>&month=<?=$nextMonth;?>">></a>
        </td>
    </tr>

    </table>
</div>

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

<table>
<tr>
    <!-- <td></td> -->
    <th>SUN &nbsp; 日</th>
    <th>MON &nbsp; 一</th>
    <th>TUE &nbsp; 二</th>
    <th>WED &nbsp; 三</th>
    <th>THU &nbsp; 四</th>
    <th>FRI &nbsp; 五</th>
    <th>SAT &nbsp; 六</th>
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
            echo "<br><span class='sp-date'>{$spDate[date("Y-m-d",$theDayTime)]}</span>";
        }

        //國定假日程式撰寫(如果想要改成不同顏色，要再上面新增CSS判斷)
        //目前是農曆的節日要再另外設計
        if(isset($holidays[date("m-d",$theDayTime)])){
            echo "<br><span class='holiday-text'>{$holidays[date("m-d",$theDayTime)]}</span>";
        }


        echo "</td>";
        
    }
    echo "</tr>"; // 結束一行
}

?>

</table>


</html>