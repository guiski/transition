<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>*-*</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
	<script type="text/javascript">
	jQuery(function($){

		function getHeight() {
			return $(window).innerHeight();
		}

		function verticalAlign() {
			$('.start > .item').each(function(){
				var obj = $(this),
					text = obj.text();
				
				if (!obj.hasClass('vertical')) {
					
					obj.addClass('vertical');
						var new_text = '';
					
					// Apos cada letra, insere uma quebra de linha
					for (i=0; i<text.length; i++) {
						new_text = new_text + '<br>' + text[i];
					}
					obj.html('<span>'+new_text+'</span>');
				} else {
					// Remove a classe vertical & coloca o texto normal
					obj.removeClass('vertical');
					$('.start > .item > span').fadeOut(500,function(){
						obj.text( text );
					});
				}
			});
		}


		$(window).bind('resize',function(){
			$('.item').css('height',getHeight());
		});


		/*
			Se for HOME, muda os textos para vertical
		*/
		verticalAlign();


		$('.item').css('height',getHeight());
		$('.header, .content, .footer').hide();
		$('.home').hide();

		$('.item').click(function(){
			$('.header, .content, .footer').show();

			$('.header, .content, .footer').css('background-color',$(this).css('background-color'));

			// remove o texto da vertical
			verticalAlign();

			$('.item').animate({height:'135px'},800,'swing', function(){});
		})
	})
	</script>
</head>
<body>
	<!-- <div class="redu">REDU</div> -->

<div class="container_12">

	<div class="grid_12 start">
		<div class="item">This is a 1</div>
		<div class="item">Esta tudo Zica</div>
		<div class="item">Contato</div>
		<div class="item">Comprar</div>
	</div>
	
	<div class="grid_12 header">
		<div class="menu">
			<div class="item"></div>
			<div class="item"></div>
			<div class="item"></div>
			<div class="item"></div>
		</div>
	</div>
	<!-- e# header -->
  
	<div class="grid_12 content">
	CONTEUDO MUDA AKI KKK<br>
	CONTEUDO MUDA AKI KKK<br>
	CONTEUDO MUDA AKI KKK<br>
	CONTEUDO MUDA AKI KKK<br>
	CONTEUDO MUDA AKI KKK<br>
	CONTEUDO MUDA AKI KKK<br>
	CONTEUDO MUDA AKI KKK<br>
	CONTEUDO MUDA AKI KKK<br>
	</div>
	<!-- e# content -->

	<div class="grid_12 footer">

	</div>
	<!-- e# footer -->

</div>
<!-- e# container_12 -->
</body>
</html>