<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<style>
	.vmessage { font-style: italic;	}
	.vmessage-empty { color: red; }
	.vmessage-exist { color: blue; }
	</style>
	<script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
	<script type="text/javascript">
	jQuery(function(){
		// Percorrer todos os Objetos do JSON
		// http://es.softuses.com/83594

		/*
			@param result -> object
			@param type -> pode ser vazia ou nao, como default e nula
							ela serve para customizar uma mensagem, sem 
							ter q alterar no .php a classe que deseja exibir
		*/
		function putMessage (result, type) {
			$.each(result, function(c,v) {
				// c -> Class/ input name***
				// v -> Objects/Values << c

				var cssClass 		= v.class,
				valueMessage 	= v.message,
				inputObj 		= $('input[name='+c+']');

				if( type != '' && type != null && type != 'undefined' ) {
					cssClass = type;
				}

				console.log(cssClass);

				// So mostra a msg, se ela nao existir
				if ($('.'+cssClass+'-'+c).length<=0) {
					/*
						.vmessage -> classe de controle de mensagens
						.vmessage-* -> classe com o estilo de cada mensagem
						.ESTILO-INPUT -> controle do erro de cada input
					*/
					inputObj.after('<span class="vmessage vmessage-'+cssClass+' '+cssClass+'-'+c+'">'+valueMessage+'</span>');
				}
						
			}); // endeach result
		}

		// Bind para remover as mensagens de erro
		$('#contato > input').bind('focus',function(){
			obj = $(this);
			nex = obj.next();

			if (nex.hasClass('vmessage')) {
				nex.remove();
			}
		});


		$('#contato').submit(function(){
			event.preventDefault();

			var obj = $(this);
			var inputs = obj.find('input, select, button, textarea');
			var values = obj.serialize();

			// Desativa enquanto esta em processo
			//inputs.prop('disabled', true);

			$.ajax({
				url: 'validate.php?i=contato',
				type: 'POST',
				data: values,
				beforeSend: function(){},
				success: function(result) {
					//inputs.prop('disabled', false);

					var result = $.parseJSON(result);
					if (result.error === true) {
						putMessage(result);
					} else {
						console.log(result);
					}
				},
				error: function(){},
				complete: function(){}
			});

		});

	})
	</script>
</head>
<body>

	<form id="contato" action="#lapis" method="POST">
		<input type="text" name="nome" placeholder="Nome"><br>
		<input type="text" name="email" placeholder="E-mail"><br>
		<input type="text" name="telefone" placeholder="Telefone"><br>
		<input type="submit" class="enviar" name="enviar" value="Enviar">
	</form>
	
</body>
</html>