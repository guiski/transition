/*
*	Javascript / jQuery Collection
*/

/*********************************
	Forms
*********************************/

{
	// Mask
	{
		// Para telefones (ja com digito adicional em SP)
		// Precisa do plguin 'meioMask'
		$('.fone').setMask({ mask: '(99) 9999-9999' });
		$('.fone').keyup(function () {
			var o = $(this),
			value = o.val();
			if (value[1] == '1' && value[2] == '1' && value[5] == '9') {
				o.setMask({
					mask: '(99) 99999-9999'
				});
			} else {
				o.setMask({
					mask: '(99) 9999-9999'
				});
			}
		});
	}

	// Validacao
	{
		// Precisa do plugin 'validate'
		$(".formulario").validate({
			errorContainer: $(".formulario div.errors"),
			errorPlacement: function(error, element) {
				if (element.attr('name')=='email') {
					$(".formulario div.errors").html('Preencha o Email corretamente.');
				} else {
					$(".formulario div.errors").html('Preencha todos os campos obrigatórios.');
				}
				shake();
			},
			rules: {
				email: {
					required: true,
					email: true
				}
			}
		});
	}

	// Placeholder
	{
		/* [CSS]
			.placeholder {
				color: #464533;
			}
		*/
		$('[placeholder]').focus(function() {
			var input = $(this);
			if (input.val() == input.attr('placeholder')) {
				input.val('');
				input.removeClass('placeholder');
			}
			}).blur(function() {
				var input = $(this);
				if (input.val() == '' || input.val() == input.attr('placeholder')) {
					input.addClass('placeholder');
					input.val(input.attr('placeholder'));
				}
			}).blur().parents('form').submit(function() {
				$(this).find('[placeholder]').each(function() {
				var input = $(this);
				if (input.val() == input.attr('placeholder')) {
					input.val('');
				}
			})
		});
	}
}


/*********************************
	Others
*********************************/
{
	// Scroll
	{
		$('.scrollup').click(function(){
			$("html, body").animate({ scrollTop: 0 }, 600);
			return false;
		});
	}

	// Overlayer
	{
		/* [CSS]
			.portfolio .posts > li {
				position: 				relative;
				z-index: 				5090;
			}
			.portfolio .posts > li > .overlayer {
				position: 				absolute;
				top: 					0;
				left: 					0;
				display: 				none;
				cursor: 				pointer;
				z-index: 				5090;
			}

		*/
		$('.posts>li').hover(function () {
				jQuery(this).children('.overlayer').fadeIn();
			}, function () {
				jQuery(this).children('.overlayer').fadeOut();
			}).click(function () {
			/*$.fancybox({
			'href': $(this).children('a').attr('href')
			})*/
		});
	}
}