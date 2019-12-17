<!DOCTYPE html>
<html>
<head>
 	<link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon">
	<meta charset="utf-8">
	
	<?php
		$category=$_GET["category"];
		switch ($category) {
			case 'iifoimo':
				echo "<title>Новости ИИФОиМО</title>";
				break;
			case 'fitr':
				echo "<title>Новости ФИТР</title>";
				break;
			case 'fes':
				echo "<title>Новости ФЭС</title>";
				break;
			case 'psf':
				echo "<title>Новости ПСФ</title>";
				break;
			case 'sports':
				echo "<title>Новости спорта БНТУ</title>";
				break;
			
			default:
				# code...
				break;
		}
		?>

	
	<link rel="stylesheet" href="/css/style11.css">

	<?php require_once "functions/functions.php";
		$news = getNews(4,$id,1);
	?>

	<?php $url='http://www.bntu.by/index.php?option=com_ninjarsssyndicator&feed_id=1&format=raw';
		$xml = xml_parser_create();     //создаёт XML-разборщик
		xml_parser_set_option($xml, XML_OPTION_SKIP_WHITE, 1);  //устанавливает опции XML-разборщика
		xml_parse_into_struct($xml, file_get_contents($url), $element, $index); //разбирает XML-данные в структуру массива, все передается в массив $index
		xml_parser_free($xml);  //освобождает XML-разборщик

	
	?>

</head>
<body>
	<!--Шапка-->
	<header>
		<div ><a href="http://news/index.php" id="logo">BNTU News</a></div>
		<nav class="menu">
			<ul>
				<?php
				if ($category=="iifoimo"){
					echo "<li><a href=\"http://news/index.php\">Главная</a></li>
					<li class=\"active\"><a href=\"category.php?category=iifoimo\">ИИФОиМО</a></li>
					<li><a href=\"category.php?category=fitr\">ФИТР</a></li>
					<li><a href=\"category.php?category=fes\">ФЭС</a></li>
					<li><a href=\"category.php?category=psf\">ПСФ</a></li>
					<li><a href=\"category.php?category=sports\">Спорт БНТУ</a></li>";
				} else if($category=="fitr"){
					echo "<li><a href=\"http://news/index.php\">Главная</a></li>
					<li><a href=\"category.php?category=iifoimo\">ИИФОиМО</a></li>
					<li class=\"active\"><a href=\"category.php?category=fitr\">ФИТР</a></li>
					<li><a href=\"category.php?category=fes\">ФЭС</a></li>
					<li><a href=\"category.php?category=psf\">ПСФ</a></li>
					<li><a href=\"category.php?category=sports\">Спорт БНТУ</a></li>";
				}else if($category=="fes"){
					echo "<li><a href=\"http://news/index.php\">Главная</a></li>
					<li><a href=\"category.php?category=iifoimo\">ИИФОиМО</a></li>
					<li><a href=\"category.php?category=fitr\">ФИТР</a></li>
					<li class=\"active\"><a href=\"category.php?category=fes\">ФЭС</a></li>
					<li><a href=\"category.php?category=psf\">ПСФ</a></li>
					<li><a href=\"category.php?category=sports\">Спорт БНТУ</a></li>";
				}else if($category=="psf"){
					echo "<li><a href=\"http://news/index.php\">Главная</a></li>
					<li><a href=\"category.php?category=iifoimo\">ИИФОиМО</a></li>
					<li><a href=\"category.php?category=fitr\">ФИТР</a></li>
					<li><a href=\"category.php?category=fes\">ФЭС</a></li>
					<li class=\"active\"><a href=\"category.php?category=psf\">ПСФ</a></li>
					<li><a href=\"category.php?category=sports\">Спорт БНТУ</a></li>";
				}else if($category=="sports"){
					echo "<li><a href=\"http://news/index.php\">Главная</a></li>
					<li><a href=\"category.php?category=iifoimo\">ИИФОиМО</a></li>
					<li><a href=\"category.php?category=fitr\">ФИТР</a></li>
					<li><a href=\"category.php?category=fes\">ФЭС</a></li>
					<li><a href=\"category.php?category=psf\">ПСФ</a></li>
					<li  class=\"active\"><a href=\"category.php?category=sports\">Спорт БНТУ</a></li>";
				}
				
				?>


			</ul>
		</nav>
	</header>

	<!--Основная часть-->
	<div class="main_content">
		<?php
		switch ($category) {
			case 'iifoimo':
				echo "<h4>Новости ИИФОиМО</h4>";
				break;
			case 'fitr':
				echo "<h4>Новости ФИТР</h4>";
				break;
			case 'fes':
				echo "<h4>Новости ФЭС</h4>";
				break;
			case 'psf':
				echo "<h4>>Новости ПСФ</h4>";
				break;
			case 'sports':
				echo "<h4>Новости спорта БНТУ</h4>";
				break;
			
			default:
				# code...
				break;
		}
		?>
		<div class="all_articles">
			<?php
			if ($category=="iifoimo"){
				for ($i = 1; $i<50;$i++){
		 		$link=substr(Parse($element[$index["LINK"][$i]]["value"],"news/",".html"),5);
		 		$desc=$element[$index["DESCRIPTION"][$i]]["value"];
				$img=Parse($desc,'src="http://','.jpg"').".jpg";
				$category=substr(Parse($link,"-","-news"),1);
		 		if($category=="iifoimo"){
				 		if ($img!="0.jpg"){
				 			$img=substr($img,5);
						echo "<div class=\"article\" style=\"background-image: url(".$img.")\">
							  	<div class=\"text_article\">";
						}
						else{
							echo "<div class=\"article\" style=\"background-image: url(img/background.jpg)\">
							  	<div class=\"text_article\">";
						}

					  		if ($category=="iifoimo"){
					  		  echo "<a href=\"category.php?category=iifoimo\" class=\"category\">ИИФОиМО</a>";
					  		}else if($category=="fitr"){
					  			echo "<a href=\"category.php?category=fitr\" class=\"category\">ФИТР</a>";
					  		}else if($category=="sports"){
					  			echo "<a href=\"category.php?category=sports\" class=\"category\">Спорт БНТУ</a>";
					  		}else if($category=="fes"){
					  			echo "<a href=\"category.php?category=fes\" class=\"category\">ФЭС</a>";
					  		}else if($category=="psf"){
					  			echo "<a href=\"category.php?category=psf\" class=\"category\">ПСФ</a>";
					  		}


					  		echo "
					  		<a href=\"article.php?id=".$i."\"><p class=\"main_title\">".$title=$element[$index["TITLE"][$i]]["value"]."</p></a>

					  		<div class=\"readcount\">
					  			<a href=\"article.php?id=".$i."\" class=\"read\" >Читать статью</a>
					  			<!--<div class=\"main_count\">
								<img class=\"main_count_icon\" src=\"img/count.svg\">
								<div>".$news[$i]["count"]."</div>
								</div>-->
							</div>

					  	</div>
					  </div>"; }}
			}else if($category=="fitr"){
				for ($i = 1; $i<50;$i++){
		 		$link=substr(Parse($element[$index["LINK"][$i]]["value"],"news/",".html"),5);
		 		$desc=$element[$index["DESCRIPTION"][$i]]["value"];
				$img=Parse($desc,'src="http://','.jpg"').".jpg";
				$category=substr(Parse($link,"-","-news"),1);
		 		if($category=="fitr"){
				 		if ($img!="0.jpg"){
				 			$img=substr($img,5);
						echo "<div class=\"article\" style=\"background-image: url(".$img.")\">
							  	<div class=\"text_article\">";
						}
						else{
							echo "<div class=\"article\" style=\"background-image: url(img/background.jpg)\">
							  	<div class=\"text_article\">";
						}

					  		if ($category=="iifoimo"){
					  		  echo "<a href=\"category.php?category=iifoimo\" class=\"category\">ИИФОиМО</a>";
					  		}else if($category=="fitr"){
					  			echo "<a href=\"category.php?category=fitr\" class=\"category\">ФИТР</a>";
					  		}else if($category=="sports"){
					  			echo "<a href=\"category.php?category=sports\" class=\"category\">Спорт БНТУ</a>";
					  		}else if($category=="fes"){
					  			echo "<a href=\"category.php?category=fes\" class=\"category\">ФЭС</a>";
					  		}else if($category=="psf"){
					  			echo "<a href=\"category.php?category=psf\" class=\"category\">ПСФ</a>";
					  		}


					  		echo "
					  		<a href=\"article.php?id=".$i."\"><p class=\"main_title\">".$title=$element[$index["TITLE"][$i]]["value"]."</p></a>

					  		<div class=\"readcount\">
					  			<a href=\"article.php?id=".$i."\" class=\"read\" >Читать статью</a>
					  			<!--<div class=\"main_count\">
								<img class=\"main_count_icon\" src=\"img/count.svg\">
								<div>".$news[$i]["count"]."</div>
								</div>-->
							</div>

					  	</div>
					  </div>"; }}
			}else if($category=="fes"){
				for ($i = 1; $i<50;$i++){
		 		$link=substr(Parse($element[$index["LINK"][$i]]["value"],"news/",".html"),5);
		 		$desc=$element[$index["DESCRIPTION"][$i]]["value"];
				$img=Parse($desc,'src="http://','.jpg"').".jpg";
				$category=substr(Parse($link,"-","-news"),1);
		 		if($category=="fes"){
				 		if ($img!="0.jpg"){
				 			$img=substr($img,5);
						echo "<div class=\"article\" style=\"background-image: url(".$img.")\">
							  	<div class=\"text_article\">";
						}
						else{
							echo "<div class=\"article\" style=\"background-image: url(img/background.jpg)\">
							  	<div class=\"text_article\">";
						}

					  		if ($category=="iifoimo"){
					  		  echo "<a href=\"category.php?category=iifoimo\" class=\"category\">ИИФОиМО</a>";
					  		}else if($category=="fitr"){
					  			echo "<a href=\"category.php?category=fitr\" class=\"category\">ФИТР</a>";
					  		}else if($category=="sports"){
					  			echo "<a href=\"category.php?category=sports\" class=\"category\">Спорт БНТУ</a>";
					  		}else if($category=="fes"){
					  			echo "<a href=\"category.php?category=fes\" class=\"category\">ФЭС</a>";
					  		}else if($category=="psf"){
					  			echo "<a href=\"category.php?category=psf\" class=\"category\">ПСФ</a>";
					  		}


					  		echo "
					  		<a href=\"article.php?id=".$i."\"><p class=\"main_title\">".$title=$element[$index["TITLE"][$i]]["value"]."</p></a>

					  		<div class=\"readcount\">
					  			<a href=\"article.php?id=".$i."\" class=\"read\" >Читать статью</a>
					  			<!--<div class=\"main_count\">
								<img class=\"main_count_icon\" src=\"img/count.svg\">
								<div>".$news[$i]["count"]."</div>
								</div>-->
							</div>

					  	</div>
					  </div>"; }}
			}else if($category=="psf"){
				for ($i = 1; $i<50;$i++){
		 		$link=substr(Parse($element[$index["LINK"][$i]]["value"],"news/",".html"),5);
		 		$desc=$element[$index["DESCRIPTION"][$i]]["value"];
				$img=Parse($desc,'src="http://','.jpg"').".jpg";
				$category=substr(Parse($link,"-","-news"),1);
		 		if($category=="psf"){
				 		if ($img!="0.jpg"){
				 			$img=substr($img,5);
						echo "<div class=\"article\" style=\"background-image: url(".$img.")\">
							  	<div class=\"text_article\">";
						}
						else{
							echo "<div class=\"article\" style=\"background-image: url(img/background.jpg)\">
							  	<div class=\"text_article\">";
						}

					  		if ($category=="iifoimo"){
					  		  echo "<a href=\"category.php?category=iifoimo\" class=\"category\">ИИФОиМО</a>";
					  		}else if($category=="fitr"){
					  			echo "<a href=\"category.php?category=fitr\" class=\"category\">ФИТР</a>";
					  		}else if($category=="sports"){
					  			echo "<a href=\"category.php?category=sports\" class=\"category\">Спорт БНТУ</a>";
					  		}else if($category=="fes"){
					  			echo "<a href=\"category.php?category=fes\" class=\"category\">ФЭС</a>";
					  		}else if($category=="psf"){
					  			echo "<a href=\"category.php?category=psf\" class=\"category\">ПСФ</a>";
					  		}


					  		echo "
					  		<a href=\"article.php?id=".$i."\"><p class=\"main_title\">".$title=$element[$index["TITLE"][$i]]["value"]."</p></a>

					  		<div class=\"readcount\">
					  			<a href=\"article.php?id=".$i."\" class=\"read\" >Читать статью</a>
					  			<!--<div class=\"main_count\">
								<img class=\"main_count_icon\" src=\"img/count.svg\">
								<div>".$news[$i]["count"]."</div>
								</div>-->
							</div>

					  	</div>
					  </div>"; }}
			}else if($category=="sports"){
				for ($i = 1; $i<50;$i++){
		 		$link=substr(Parse($element[$index["LINK"][$i]]["value"],"news/",".html"),5);
		 		$desc=$element[$index["DESCRIPTION"][$i]]["value"];
				$img=Parse($desc,'src="http://','.jpg"').".jpg";
				$category=substr(Parse($link,"-","-news"),1);
		 		if($category=="sports"){
				 		if ($img!="0.jpg"){
				 			$img=substr($img,5);
						echo "<div class=\"article\" style=\"background-image: url(".$img.")\">
							  	<div class=\"text_article\">";
						}
						else{
							echo "<div class=\"article\" style=\"background-image: url(img/background.jpg)\">
							  	<div class=\"text_article\">";
						}

					  		if ($category=="iifoimo"){
					  		  echo "<a href=\"category.php?category=iifoimo\" class=\"category\">ИИФОиМО</a>";
					  		}else if($category=="fitr"){
					  			echo "<a href=\"category.php?category=fitr\" class=\"category\">ФИТР</a>";
					  		}else if($category=="sports"){
					  			echo "<a href=\"category.php?category=sports\" class=\"category\">Спорт БНТУ</a>";
					  		}else if($category=="fes"){
					  			echo "<a href=\"category.php?category=fes\" class=\"category\">ФЭС</a>";
					  		}else if($category=="psf"){
					  			echo "<a href=\"category.php?category=psf\" class=\"category\">ПСФ</a>";
					  		}


					  		echo "
					  		<a href=\"article.php?id=".$i."\"><p class=\"main_title\">".$title=$element[$index["TITLE"][$i]]["value"]."</p></a>

					  		<div class=\"readcount\">
					  			<a href=\"article.php?id=".$i."\" class=\"read\" >Читать статью</a>
					  			<!--<div class=\"main_count\">
								<img class=\"main_count_icon\" src=\"img/count.svg\">
								<div>".$news[$i]["count"]."</div>
								</div>-->
							</div>

					  	</div>
					  </div>"; }}
			}
			?>
		</div>


	<!--Футер-->
	<footer>
			<div id="rights">
					Все права защищены &copy; <?=date ('Y')?>
			</div>
	</footer>
</body>
</html>