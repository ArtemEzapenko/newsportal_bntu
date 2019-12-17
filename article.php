<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon">
	<link rel="stylesheet" href="/css/style11.css">
	<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<?php require_once "functions/functions.php";
		$news = getNews(1, $_GET["id"],1);
		
		connectDB();
		$data="UPDATE `news` SET `count`=count+1 WHERE `id`=".$_GET["id"]."";
		mysqli_query($mysqli,$data);
		?>


	<?php $url='http://www.bntu.by/index.php?option=com_ninjarsssyndicator&feed_id=1&format=raw';
		$xml = xml_parser_create();     //создаёт XML-разборщик
		xml_parser_set_option($xml, XML_OPTION_SKIP_WHITE, 1);  //устанавливает опции XML-разборщика
		xml_parse_into_struct($xml, file_get_contents($url), $element, $index); //разбирает XML-данные в структуру массива, все передается в массив $index
		xml_parser_free($xml);  //освобождает XML-разборщик

		$i=$_GET["id"];
		$title=$element[$index["TITLE"][$i]]["value"]; // получаем заголовок
		echo "<title>".$title."</title>";
		$link=$element[$index["LINK"][$i]]["value"]; // получаем ссылку на новость
		$desc=$element[$index["DESCRIPTION"][$i]]["value"];
		$img=Parse($desc,'src="http://','.jpg"').".jpg";
		$time=$element[$index["PUBDATE"][$i-1]]["value"];
				$category=substr(Parse($link,"-","-news"),1);

	?>


	<script type="text/javascript" src="https://vk.com/js/api/openapi.js?162"></script>
</head>
<body>
	<!--Шапка-->
	<header>
		<div ><a href="http://news/index.php" id="logo">BNTU News</a></div>
		<nav class="menu">
			<ul>
				<ul>
				<?php
				echo "<li><a href=\"http://news/index.php\">Главная</a></li>
				<li><a href=\"category.php?category=iifoimo\">ИИФОиМО</a></li>
				<li><a href=\"category.php?category=fitr\">ФИТР</a></li>
				<li><a href=\"category.php?category=fes\">ФЭС</a></li>
				<li><a href=\"category.php?category=psf\">ПСФ</a></li>
				<li><a href=\"category.php?category=sports\">Спорт БНТУ</a></li>";
				?>
			</ul>
		</nav>
	</header>

	<!--Основная часть-->
	<div class="main_content">
	<?php
		$desc=$element[$index["DESCRIPTION"][$i]]["value"];
		$img=Parse($desc,'src="http://','.jpg"').".jpg";
		if ($img!="0.jpg"){
			$img=substr($img,5);
			echo "<div class=\"post\">
			<div class=\"photo\" style=\"background-image:  url(".$img.")\">
				<div class=\"post_head\">";
		}else{
			echo "<div class=\"post\">
			<div class=\"photo\" style=\"background-image: url(img/background.jpg)\">
				<div class=\"post_head\">";
		}

		if ($category=="iifoimo"){
					  		  echo "<a href=\"category.php?category=iifoimo\" class=\"post_category\">ИИФОиМО</a>";
					  		}else if($category=="fitr"){
					  			echo "<a href=\"category.php?category=fitr\" class=\"post_category\">ФИТР</a>";
					  		}else if($category=="sports"){
					  			echo "<a href=\"category.php?category=sports\" class=\"post_category\">Спорт БНТУ</a>";
					  		}else if($category=="fes"){
					  			echo "<a href=\"category.php?category=fes\" class=\"post_category\">ФЭС</a>";
					  		}else if($category=="psf"){
					  			echo "<a href=\"category.php?category=psf\" class=\"post_category\">ПСФ</a>";
					  		}
		
		echo "
		<div class=\"info\">
			<div class=\"post_title\">".$title=$element[$index["TITLE"][$i]]["value"]."</div>
				</div>
					<div class=\"time\">
						<img class=\"time_icon\" src=\"img/time.svg\">
						<div>".$time."</div>
					</div>
			</div>
		</div>
			<div class=\"post_text\">
				".strip_tags($desc, '<img>,<a>')."
				<div class=\"post_share\">
					<span>Поделиться</span>
					<script src=\"https://yastatic.net/es5-shims/0.0.2/es5-shims.min.js\"></script>
					<script src=\"https://yastatic.net/share2/share.js\"></script>
					<div class=\"ya-share2\" data-services=\"vkontakte,facebook,odnoklassniki,twitter\"></div>
				</div>
			</div>
		</div>";
	?>
	</div>

	<!--Поключение комментариев Вконтакте-->
	<script type="text/javascript">
  		VK.init({apiId: 7165928, onlyWidgets: true});
	</script>
	<div id="vk_comments"></div>
	<script type="text/javascript">
		VK.Widgets.Comments("vk_comments", {limit: 10, width: "800",  attach: "*"});
	</script>
</body>
</html>