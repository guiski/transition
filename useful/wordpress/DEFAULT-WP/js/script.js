/*
*	LazyLoad
**********************************
*/
{
	// Faz com que todas as imagens sejam do lazyload
	$('img').each(function(){
		var obj = $(this);
		if (!obj.hasClass('lazy')) {
			obj.attr('data-original', obj.attr('src'));
			obj.attr('src', '<?php echo LAZY_IMG; ?>');
			obj.addClass('lazy');
		}
	});
	// Ativa o lazyload
	$("img.lazy").lazyload({ 
		effect : "fadeIn"
	});
}
/*
*	Link Ativo no menu
**********************************
*/
{
	$('.menu-header a').each(function(){
		var obj = $(this);

		if (obj.attr('data-style')!='home' && obj.attr('data-style')=='<?php global $post; echo $post->post_name; ?>'){
			obj.attr("class","ativo");
		}
		<?php if (is_home() || is_front_page()): ?>
		$('.menu-header a[data-style=home]').attr("class","ativo");
		<?php endif; ?>
	});
}
/*
*	Slider (similar ao carousel/nextgen/...)
**********************************
*/
{
	$('.slider').slidesjs({
		width: 610,
		height: 200,
		pagination: { active: false }
	});
}
