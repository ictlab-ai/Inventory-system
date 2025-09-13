<!DOCTYPE html>

<html lang="ru">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width,user-scalable=no,initial-scale=1,maximum-scale=1,minimum-scale=1">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="shortcut icon" href="./qrcode.png" type="image/x-icon">
  
  <link rel="stylesheet" type="text/css" href="../../css/admin.css">
  <script src="js/QRCreator.js" defer></script>
  <script src="js/app.js" defer></script>
  <title>Генератор QR-кода</title>
</head>

<body>

  <div id="side">
		<ul id="nav">
			<li><a href="../a_admin.php">ГЛАВНАЯ</a></li>
			<li><a href="../goods.php">Имущество</a></li>
			<li><a href="../users.php">ПОЛЬЗОВАТЕЛИ</a></li>
			<li><a href="../files.php">Файлы</a></li>
			<li><a href="../logout.php">ВЫйти</a></li>
		</ul>
	</div>

	<div id="content">
	
  <div id="app">
    <div class="section-header">
      <header>
        <div class="header-logo h1">
          <span class="lang-head-1">ГЕНЕРАТОР</span><span class="lang-head-2">QR</span><span
            class="lang-head-3">КОДА</span>
        </div>
        <div class="btn-symbol" id="generate-qrcode">генерировать</div>
        <div class="header-lang">
          <select class="switch h4">
            <option value="rus">РУС</option>
            <option value="eng">ENG</option>
          </select>
        </div>
      </header>
      <div class="error-message h3"></div>
    </div>

    <div class="section-main">
      <div class="main params">

        <div class="lang-main-text h2">Текст для кодирования</div>
        <textarea id="qr-text" class="h3"></textarea>
		
		<div id="dis">  
        <div class="lang-main-params h2">Параметры генерации QR-кода</div>
        <div class="main-params h4 access-main-params">
          <div id="qr-mode" class="row-box">
            <span class="col-0 lang-param-mode">метод кодирования</span>
            <div class="col-1 switch h4 lang-vs1">авто</div>
            <select class="col-2 switch h4 hide">
              <option value="1" class="lang-m1">цифровой</option>
              <option value="2" class="lang-m2">буквенно-цифровой</option>
              <option value="4" class="lang-m4">двоичный (UTF8)</option>
            </select>
            <span class="col-3 h4 hide"></span>
          </div>
          <div id="qr-eccl" class="row-box">
            <span class="col-0 lang-param-eccl">уровень коррекции ошибок</span>
            <div class="col-1 switch h4 lang-vs1">авто</div>
            <select class="col-2 switch h4 hide">
              <option value="1">L ( 7%)</option>
              <option value="0">M (15%)</option>
              <option value="3">Q (25%)</option>
              <option value="2" select="select">H (30%)</option>
            </select>
            <span class="col-3 h4 hide"></span>
          </div>
          <div id="qr-version" class="row-box">
            <span class="col-0 lang-param-version">версия ( 1 - 40 )</span>
            <div class="col-1 switch h4 lang-vs1">авто</div>
            <input class="col-2 switch h4 hide" value="1" placeholder="1"></input>
            <span class="col-3 h4 hide"></span>
          </div>
          <div id="qr-mask" class="row-box">
            <span class="col-0 lang-param-mask">шаблон маски ( 0 - 7 )</span>
            <div class="col-1 switch h4 lang-vs1">авто</div>
            <input class="col-2 switch h4 hide" value="0" placeholder="0"></input>
            <span class="col-3 h4 hide"></span>
          </div>
          <div id="qr-modsize" class="row-box">
            <span class="col-0 lang-param-modsize">размер модуля ( n x n )</span>
            <div class="col-1 switch h4 lang-vs1">авто</div>
            <input class="col-2 switch h4 hide" value="1" placeholder="1"></input>
            <span class="col-3 h4 hide"></span>
          </div>
          <div id="qr-margin" class="row-box">
            <span class="col-0 lang-param-margin">размер свободной зоны в модулях</span>
            <div class="col-1 switch h4 lang-vs1">авто</div>
            <input class="col-2 switch h4 hide" value="0" placeholder="0"></input>
            <span class="col-3 h4 hide"></span>
          </div>
        </div>
      </div>
	</div>

      <div class="main qrcode">
        <div id="qrcode-output" class="empty"></div>
        <div id="qrcode-save-as" class="access-save-as h4">
          <div class="save-as btn-symbol h-btn" data-image="png">Сохранить как PNG</div>
          <!--<div class="save-as btn-symbol h-btn" data-image="svg">SVG</div>
          <div class="save-as btn-symbol h-btn" data-image="html">HTML</div>
          <div class="save-as-title lang-save-as-title">Сохранить</div>-->
        </div>
      </div>
    </div>
  </div>
</div>
</body>

</html>
