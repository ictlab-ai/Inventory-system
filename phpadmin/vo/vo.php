<!DOCTYPE html>
<html>
<head>
	<title>Аналитика</title>
	<link rel="stylesheet" type="text/css" href="../../css/admin.css">
    <script type="text/javascript" src="" charset="UTF-8"></script>
    <script src="js/copy.js"></script>
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>-->
    
    <meta charset="UTF-8">
    <script asyn src="https://charts.livegap.com/js/webfont.js"></script>
    <script src="js/chart.min.js"></script>
    
    <script>
        function DrawTheChart(ChartData,ChartOptions,ChartId,ChartType){
        eval('var myLine = new Chart(document.getElementById(ChartId).getContext("2d")).'+ChartType+'(ChartData,ChartOptions);document.getElementById(ChartId).getContext("2d").stroke();')
        }
    </script>

<script src="https://code.jquery.com/jquery-1.12.4.min.js"
  integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
  crossorigin="anonymous"></script>

</head>
<body onload="reload();">

	<div id="side">
		<ul id="nav">
			<li><a href="../a_admin.php">ГЛАВНАЯ</a></li>
			<li><a href="../goods.php">Имущество</a></li>
			<li><a href="#">Аналитика</a></li>
			<li><a href="../users.php">ПОЛЬЗОВАТЕЛИ</a></li>
			<li><a href="../files.php">Файлы</a></li>
			<li><a href="../qrgen/index.php">QR генератор</a></li>
			<li><a href="../logout.php">ВЫйти</a></li>
		</ul>
	</div>
	
	
	<div id="content">
		<?php
			
			include '../connect.php';
			session_start();
			$name = $_SESSION['nameus'];
		
			if (empty($_SESSION['nameus'])) {
				echo 'Доступ запрещен!';
				die;
			}


		?>

<div class="first">

</div>
<br>
<div class="second">
	
	<?php echo "<td>";
			/*форма для проверки не прошедших инвентаризацию*/

				echo "<form method='POST' action = '../check/check.php'>";
						echo "<input name='check' id='sub' type='submit' value='ПРОВЕРКА'>";
				echo "</form><br>";

			echo "</td>";
	
	?>
	
	<table cellpadding="2" cellspacing="0" border="1" style=" table-layout:fixed; width: 100%; background-color: #fbfbfb;">
        <tr><textarea hidden placeholder="Заголовок диаграммы" id="ta"></textarea></tr>
		
<tr>
	<th style="font-size:10px;">Легенда диаграммы</th>
	
	<?php /*вывод имени пользователей для просмотра*/
	
			$takename = mysqli_query($connection,"SELECT * FROM `usersinfo`;");
			
				$i = 1;
			while ($data = mysqli_fetch_assoc($takename)) {
				
				echo "<th><textarea disabled wrap='true' style='resize:none;width:95%;height:20px;font-size:6px;' id='edit".$i."'>".$data['fullname']."</textarea></th>";
				$i = $i + 1;
			}
	
	?>
</tr>
	
    <!--You can add here something new-->

</tr>

<tr>
	<th width="90px"><textarea wrap="true" style="resize:none;width: 95%;height: 20px;font-size:10px;" id="c1">Прошли инвентаризацию</textarea></th>
	
	
	<?php /*подсчет количества основных средств для заполнения таблицы*/
	
			$takename1 = mysqli_query($connection,"SELECT * FROM `usersinfo`;");
			
				$j = 1;
			while ($data1 = mysqli_fetch_assoc($takename1)) {
				$m = $data1['login'];
				//echo $m;
				$x = mysqli_query($connection, "SELECT COUNT(*) AS count_x FROM `equipment` WHERE `login` = '$m' AND `inventnumcheck` = `inventnum`;");
				$count_x = mysqli_fetch_assoc($x);
				$number_of_records_x = $count_x['count_x'];
    	echo "<th><textarea disabled wrap='true' style='resize:none;width:95%;height:20px;' id='ta".$j."'>$number_of_records_x</textarea></th>";
				$j = $j + 1;

			}
	
	?>
	
</tr>

<tr>
	
	<th width="90px"><textarea wrap="true" style="resize:none;width: 95%;height: 20px;font-size:10px;" id="c2">Не прошли инвентаризацию</textarea></th>
	
	
	<?php /*подсчет количества основных средств для заполнения таблицы*/
	
			$takename2 = mysqli_query($connection,"SELECT * FROM `usersinfo`;");
			
				$k = 1;
			while ($data2 = mysqli_fetch_assoc($takename2)) {
				$m = $data2['login'];
				//echo $m;
				$y = mysqli_query($connection, "SELECT COUNT(*) AS count_y FROM `equipment` WHERE `login` = '$m' AND `inventnumcheck` = '';");
				$count_y = mysqli_fetch_assoc($y);
				$number_of_records_y = $count_y['count_y'];			
		echo "<th><textarea disabled wrap='true' style='resize:none;width:95%;height:20px;' id='ya".$k."'>$number_of_records_y</textarea></th>";
				$k = $k + 1;

			}
	
	?>
	
</tr>

<!--You can add here something new-->

<tr></table>
</div>

	<br>

		<canvas  id="ch" width="800px" height="600px" style="background-color:rgba(255,255,255);" ></canvas>
<br><br><br>
<input type="button" value="Сохранить диаграмму" onclick="makePage()">
	
	<br><br><br>
																
<script>													
	function reload() {
		function MoreChartOptions(){} 
		
		/*легенда диаграммы*/
		
		var ChartData = {labels : [document.getElementById('edit1').value,
      document.getElementById('edit2').value,document.getElementById('edit3').value,document.getElementById('edit4').value,document.getElementById('edit5').value,document.getElementById('edit6').value,document.getElementById('edit7').value,document.getElementById('edit8').value,document.getElementById('edit9').value,document.getElementById('edit10').value,document.getElementById('edit11').value,document.getElementById('edit12').value,document.getElementById('edit13').value,document.getElementById('edit14').value,document.getElementById('edit15').value,document.getElementById('edit16').value,document.getElementById('edit17').value,document.getElementById('edit18').value,document.getElementById('edit19').value,document.getElementById('edit20').value,document.getElementById('edit21').value,],datasets : [

/*Block's for output data to diagram*/

      {fillColor :"rgba(255,165,0,1)",strokeColor : "rgba(255,165,0,0.5)",pointColor : "rgba(255,165,0,1)",markerShape :"circle",pointStrokeColor : "rgba(255,255,255,1.00)",data : [

      document.getElementById('ta1').value,
      document.getElementById('ta2').value,
      document.getElementById('ta3').value,
      document.getElementById('ta4').value,
      document.getElementById('ta5').value,
      document.getElementById('ta6').value,
	  document.getElementById('ta7').value,
      document.getElementById('ta8').value,
      document.getElementById('ta9').value,
	  document.getElementById('ta10').value,
      document.getElementById('ta11').value,
	  document.getElementById('ta12').value,
	  document.getElementById('ta13').value,
	  document.getElementById('ta14').value,
	  document.getElementById('ta15').value,
	  document.getElementById('ta16').value,
  	  document.getElementById('ta17').value,
	  document.getElementById('ta18').value,
	  document.getElementById('ta19').value,
	  document.getElementById('ta20').value,
	  document.getElementById('ta21').value,


      ],title:document.getElementById('c1').value},
		  
{fillColor :"rgba(0,0,0,1)",strokeColor : "rgba(0,0,0,0.5)",pointColor : "rgba(0,0,0,1)",markerShape :"circle",pointStrokeColor : "rgba(0,0,0,1.00)",data : [

      document.getElementById('ya1').value,
      document.getElementById('ya2').value,
      document.getElementById('ya3').value,
      document.getElementById('ya4').value,
      document.getElementById('ya5').value,
      document.getElementById('ya6').value,
	  document.getElementById('ya7').value,
      document.getElementById('ya8').value,
      document.getElementById('ya9').value,
	  document.getElementById('ya10').value,
      document.getElementById('ya11').value,
	  document.getElementById('ya12').value,
	  document.getElementById('ya13').value,
	  document.getElementById('ya14').value,
	  document.getElementById('ya15').value,
	  document.getElementById('ya16').value,
  	  document.getElementById('ya17').value,
	  document.getElementById('ya18').value,
	  document.getElementById('ya19').value,
	  document.getElementById('ya20').value,
	  document.getElementById('ya21').value,


      ],title:document.getElementById('c2').value},

      ] /*You can add here something new*/ };
   
      ChartOptions= {decimalSeparator:".",thousandSeparator:",",spaceLeft:12,spaceRight:12,spaceTop:12,spaceBottom:12,scaleLabel:"<%=value+''%>",yAxisMinimumInterval:1,scaleShowLabels:true,scaleShowLine:true,scaleLineStyle:"solid",scaleLineWidth:1,scaleLineColor:"rgba(0,0,0,0.6)",scaleOverlay :false,scaleOverride :false,scaleSteps:10,scaleStepWidth:10,scaleStartValue:0,inGraphDataShow:true,inGraphDataTmpl:'<%=v3%>',inGraphDataFontFamily:"'Open Sans'",inGraphDataFontStyle:"normal bold",inGraphDataFontColor:"rgba(255,255,255,1)",inGraphDataFontSize:12,inGraphDataPaddingX:0,inGraphDataPaddingY:-5,inGraphDataAlign:"center",inGraphDataVAlign:"top",inGraphDataXPosition:2,inGraphDataYPosition:3,inGraphDataAnglePosition:2,inGraphDataRadiusPosition:2,inGraphDataRotate:0,inGraphDataPaddingAngle:0,inGraphDataPaddingRadius:0, inGraphDataBorders:false,inGraphDataBordersXSpace:1,inGraphDataBordersYSpace:1,inGraphDataBordersWidth:1,inGraphDataBordersStyle:"solid",inGraphDataBordersColor:"rgba(0,0,0,1)",legend:true,maxLegendCols:7,legendBlockSize:15,legendFillColor:'rgba(255,255,255,0.00)',legendColorIndicatorStrokeWidth:1,legendPosX:-2,legendPosY:4,legendXPadding:0,legendYPadding:0,legendBorders:false,legendBordersWidth:1,legendBordersStyle:"solid",legendBordersColors:"rgba(102,102,102,1)",legendBordersSpaceBefore:5,legendBordersSpaceLeft:5,legendBordersSpaceRight:5,legendBordersSpaceAfter:5,legendSpaceBeforeText:5,legendSpaceLeftText:5,legendSpaceRightText:5,legendSpaceAfterText:5,legendSpaceBetweenBoxAndText:5,legendSpaceBetweenTextHorizontal:5,legendSpaceBetweenTextVertical:5,legendFontFamily:"'Open Sans'",legendFontStyle:"normal normal",legendFontColor:"rgba(0,0,0,1)",legendFontSize:15,showYAxisMin:false,rotateLabels:"smart",xAxisBottom:true,yAxisLeft:true,yAxisRight:false,graphTitleSpaceBefore:5,graphTitleSpaceAfter:5, graphTitleBorders:false,graphTitleBordersXSpace:1,graphTitleBordersYSpace:1,graphTitleBordersWidth:1,graphTitleBordersStyle:"solid",graphTitleBordersColor:"rgba(0,0,0,1)",graphTitle : document.getElementById('ta').value,graphTitleFontFamily:"'Open Sans'",graphTitleFontStyle:"normal normal",graphTitleFontColor:"rgba(0,0,0,1)",graphTitleFontSize:14,graphSubTitleSpaceBefore:5,graphSubTitleSpaceAfter:5, graphSubTitleBorders:false,graphSubTitleBordersXSpace:1,graphSubTitleBordersYSpace:1,graphSubTitleBordersWidth:1,graphSubTitleBordersStyle:"solid",graphSubTitleBordersColor:"rgba(0,0,0,1)",graphSubTitle : "",graphSubTitleFontFamily:"'Open Sans'",graphSubTitleFontStyle:"normal normal",graphSubTitleFontColor:"rgba(102,102,102,1)",graphSubTitleFontSize:16,scaleFontFamily:"'Open Sans'",scaleFontStyle:"normal normal",scaleFontColor:"rgba(0,0,0,1)",scaleFontSize:12,pointLabelFontFamily:"'Open Sans'",pointLabelFontStyle:"normal normal",pointLabelFontColor:"rgba(102,102,102,1)",pointLabelFontSize:12,angleShowLineOut:true,angleLineStyle:"solid",angleLineWidth:1,angleLineColor:"rgba(0,0,0,0.1)",percentageInnerCutout:50,scaleShowGridLines:true,scaleGridLineStyle:"solid",scaleGridLineWidth:1,scaleGridLineColor:"rgba(0,0,0,0.1)",scaleXGridLinesStep:1,scaleYGridLinesStep:3,segmentShowStroke:true,segmentStrokeStyle:"solid",segmentStrokeWidth:2,segmentStrokeColor:"rgba(255,255,255,1.00)",datasetStroke:true,datasetFill : true,datasetStrokeStyle:"solid",datasetStrokeWidth:2,bezierCurve:true,bezierCurveTension :0.4,pointDotStrokeStyle:"solid",pointDotStrokeWidth : 1,pointDotRadius : 3,pointDot : true,scaleTickSizeBottom:5,scaleTickSizeTop:5,scaleTickSizeLeft:5,scaleTickSizeRight:5,graphMin:0,barShowStroke : false,barBorderRadius:0,barStrokeStyle:"solid",barStrokeWidth:12,barValueSpacing:4,barDatasetSpacing:0,scaleShowLabelBackdrop :true,scaleBackdropColor:'rgba(255,255,255,0.75)',scaleBackdropPaddingX :2,scaleBackdropPaddingY :2,animation : true,onAnimationComplete : function(){MoreChartOptions()}};
 DrawTheChart(ChartData,ChartOptions,"ch","StackedBar");
	}
		
	function makePage() {

		  		/*****************************chart***************/
		
/*генерируем отчет*/
var win1; // Объявляем переменную для нового окна.
var canvas = document.getElementById('ch'); //получаем изображение
var dataURL = canvas.toDataURL(); //преобразуем в base64
var image = new Image(); //создаем новый объект для изображения
		
image.src = dataURL; //получаем строку в base64
		
alert("Сейчас откроется новое окно."); // Предупреждаем пугливого пользователя.

win1 = window.open("", "", "resizable=1, width=700, height=399, location=0, status=0, toolbar=0");

// Присваиваем переменной win1 новое пустое окно размерами 300х150

win1.document.open (); // Открываем его.

		
win1.document.writeln('<html><head>'); 
win1.document.writeln('<script type="text/javascript" src="js/jspdf.min.js"><\/script>'); 

var funk = 'function getPDF() {  doCanvas(); } function doCanvas() {	html2canvas(document.querySelector("#export")).then(canvas => { doPDF(canvas); }); } function doPDF(canvas) { var text = "gw.pdf"; var doc = new jsPDF({ format: "a4", }); doc.addImage(canvas.toDataURL(), "PNG", 10, 10);  doc.save(text); }';

win1.document.writeln('<script>'+funk+'<\/script>');
		
win1.document.writeln('<script type="text/javascript" src="js/html2canvas.js"><\/script>');

// копируем изображение в новое динамическое окно
win1.document.writeln('</head><body><center>');
//win1.document.writeln('<input type="submit" value="Экспорт" onclick="getPDF();">');
win1.document.writeln('<input type="submit" value="Печать документа" onclick="print();">');
win1.document.writeln('<div id="export">');
win1.document.writeln('<img src="'+image.src+'" alt ="Diagram" width="500px"> <br> <br>'); 
win1.document.writeln('<h2></h2><center>');
win1.document.writeln('<table id="gw" style = "table-layout: fixed;width:100%" cellpadding="0" cellspacing="0" border="1" style="text-align:center;" >');

win1.document.writeln ('<tr><td>&nbsp;</td><td style="word-wrap:break-word; font-size:10px;">'+document.getElementById('edit1').value+'</td><td style="word-wrap:break-word;font-size:10px;">'+document.getElementById('edit2').value+'</td><td style="word-wrap:break-word;font-size:10px;">'+document.getElementById('edit3').value+'</td><td style="word-wrap:break-word;font-size:10px;">'+document.getElementById('edit4').value+'</td><td style="word-wrap:break-word;font-size:10px;">'+document.getElementById('edit5').value+'</td><td style="word-wrap:break-word;font-size:10px;">'+document.getElementById('edit6').value+'</td><td style="word-wrap:break-word;font-size:10px;">'+document.getElementById('edit7').value+'</td><td style="word-wrap:break-word;font-size:10px;">'+document.getElementById('edit8').value+'</td><td style="word-wrap:break-word;font-size:10px;">'+document.getElementById('edit9').value+'</td><td style="word-wrap:break-word;font-size:10px;">'+document.getElementById('edit10').value+'</td><td style="word-wrap:break-word;font-size:10px;">'+document.getElementById('edit11').value+'</td><td style="word-wrap:break-word;font-size:10px;">'+document.getElementById('edit12').value+'</td><td style="word-wrap:break-word;font-size:10px;">'+document.getElementById('edit13').value+'</td><td style="word-wrap:break-word;font-size:10px;">'+document.getElementById('edit14').value+'</td><td style="word-wrap:break-word;font-size:10px;">'+document.getElementById('edit15').value+'</td><td style="word-wrap:break-word;font-size:10px;">'+document.getElementById('edit16').value+'</td><td style="word-wrap:break-word;font-size:10px;">'+document.getElementById('edit17').value+'</td><td style="word-wrap:break-word;font-size:10px;">'+document.getElementById('edit18').value+'</td><td style="word-wrap:break-word;font-size:10px;">'+document.getElementById('edit19').value+'</td><td style="word-wrap:break-word;font-size:10px;">'+document.getElementById('edit20').value+'</td><td style="word-wrap:break-word;font-size:10px;">'+document.getElementById('edit21').value+'</td></tr>');

/*You can add here something new*/
		
win1.document.writeln
	('<tr><td style="font-size:4px;">'+document.getElementById('c1').value+'</td><td>'+parseFloat(document.getElementById('ta1').value)+'</td><td>'+parseFloat(document.getElementById('ta2').value)+'</td><td>'+parseFloat(document.getElementById('ta3').value)+'</td><td>'+parseFloat(document.getElementById('ta4').value)+'</td><td>'+parseFloat(document.getElementById('ta5').value)+'</td><td>'+parseFloat(document.getElementById('ta6').value)+'</td><td>'+parseFloat(document.getElementById('ta7').value)+'</td><td>'+parseFloat(document.getElementById('ta8').value)+'</td><td>'+parseFloat(document.getElementById('ta9').value)+'</td><td>'+parseFloat(document.getElementById('ta10').value)+'</td><td>'+parseFloat(document.getElementById('ta11').value)+'</td><td>'+parseFloat(document.getElementById('ta12').value)+'</td><td>'+parseFloat(document.getElementById('ta13').value)+'</td><td>'+parseFloat(document.getElementById('ta14').value)+'</td><td>'+parseFloat(document.getElementById('ta15').value)+'</td><td>'+parseFloat(document.getElementById('ta16').value)+'</td><td>'+parseFloat(document.getElementById('ta17').value)+'</td><td>'+parseFloat(document.getElementById('ta18').value)+'</td><td>'+parseFloat(document.getElementById('ta19').value)+'</td><td>'+parseFloat(document.getElementById('ta20').value)+'</td><td>'+parseFloat(document.getElementById('ta21').value)+'</td></tr>');

win1.document.writeln
    ('<tr><td style="font-size:4px;">'+document.getElementById('c1').value+'</td><td>'+parseFloat(document.getElementById('ya1').value)+'</td><td>'+parseFloat(document.getElementById('ya2').value)+'</td><td>'+parseFloat(document.getElementById('ya3').value)+'</td><td>'+parseFloat(document.getElementById('ya4').value)+'</td><td>'+parseFloat(document.getElementById('ya5').value)+'</td><td>'+parseFloat(document.getElementById('ya6').value)+'</td><td>'+parseFloat(document.getElementById('ya7').value)+'</td><td>'+parseFloat(document.getElementById('ya8').value)+'</td><td>'+parseFloat(document.getElementById('ya9').value)+'</td><td>'+parseFloat(document.getElementById('ya10').value)+'</td><td>'+parseFloat(document.getElementById('ya11').value)+'</td><td>'+parseFloat(document.getElementById('ya12').value)+'</td><td>'+parseFloat(document.getElementById('ya13').value)+'</td><td>'+parseFloat(document.getElementById('ya14').value)+'</td><td>'+parseFloat(document.getElementById('ya15').value)+'</td><td>'+parseFloat(document.getElementById('ya16').value)+'</td><td>'+parseFloat(document.getElementById('ya17').value)+'</td><td>'+parseFloat(document.getElementById('ya18').value)+'</td><td>'+parseFloat(document.getElementById('ya19').value)+'</td><td>'+parseFloat(document.getElementById('ya20').value)+'</td><td>'+parseFloat(document.getElementById('ya21').value)+'</td></tr>');



    /*You can add here something new*/

win1.document.writeln
	('</table><br><br></div></body></html>');

// Заполняем только что созданный документ.
window.focus(); // Переводим фокус.
}
		
</script></div><br><br><br>
	
	</div>
</body>
</html>