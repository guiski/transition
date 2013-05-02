<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
	<script type="text/javascript">
	jQuery(function(){
		// Percorrer todos os Objetos do JSON
		// http://es.softuses.com/83594

		/*
			@param type -> error, accept ...
		*/
		function putMessage (type) {

		}

		// Bind para remover as mensagens de erro
		$('#contato > input').bind('focus',function(){
			obj = $(this);
			nex = obj.next();

			if (nex.hasClass('error')) {
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
						//console.log( Object.keys(result).length );
						console.log('have error');
						console.log(result);
						$.each(result, function(c,v) {
							// c -> Class/ input name***
							// v -> Objects/Values << c

							if (typeof(v)=='object') {
								$.each(v, function(key,value) {
									// Each para percorrer todos os inputs passados

									if (key=='message') {
										var inputObj = $('input[name='+c+']');

										// So mostra a msg, se ela nao existir
										if ($('.error-'+c).length<=0) {
											inputObj.after('<span class="error error-'+c+'">'+value+'</span>');
										}
									} // endif required

								});
							} // endif object
						
						}); // endeach result

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