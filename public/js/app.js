$(document).ready(function() {
	if ($('#albums').length) {
		$.get('flickr/albums', function(data){
			$('#albums').html(data);
		})
	}

	$("[rel='tooltip']").tooltip();

	$('.container').on('mouseenter', '.thumbnail', function(){
		var that = this;
		timer = setTimeout(function(){
			$(that).find('.caption-fixed').slideUp(250);
			$(that).find('.caption').slideDown(300);
		},150);
	});
	$('.container').on('mouseleave', '.thumbnail', function(){
		clearTimeout(timer);
		$(this).find('.caption').slideUp(250);
	});

	var download_length = $('.download').length;
	var download_count = 0;


	$('#download').click(function() {
		if (! download_count) {
			$(this).find('span').remove();
			$(this).prepend('<span class="fa fa-spinner fa-spin"></span>');
		}
		if (download_count < download_length) {
			$('.download:eq(' + download_count + ')').each(function() {
				var photo = $(this);
				setTimeout(function() {
					download(photo.attr('data-src-original'));
					photo.prev().show();
					download_count++;
					$('#download').trigger('click');
				}, 15000);
			});
		}
		else {
			$(this).find('span').remove();
			$(this).prepend('<span class="fa fa-check"></span>');
			$(this).removeClass('btn-primary');
			$(this).addClass('btn-success');
		}
	});

	var download = function($link) {
		var iframe = $('<iframe style="visibility: collapse;"></iframe>');
		$('body').append(iframe);
		var content = iframe[0].contentDocument;
		var form = '<form action="' + $link + '" method="GET"></form>';
		content.write(form);
		$('form', content).submit();
		setTimeout((function(iframe) {
			return function() { 
				iframe.remove(); 
			}
		})(iframe), 16000);
	} 
});