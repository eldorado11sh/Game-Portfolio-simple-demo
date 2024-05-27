$('.btn-drop').click(function () {
	$(this).toggleClass('active')
	$('.' + $(this).attr('data-class')).toggleClass('active')
})

$('.buttonDrop').click(function () {
	$(this).toggleClass('active')
	$('.' + $(this).attr('data-class')).slideToggle(400)
})

$('#pk-tab').click(function () {
	$('.sub-tab').removeClass('show active')
	$('.sub-tab-button').removeClass('active')
	$('#pk-content-1').addClass('show active')
	$('#pk-tab-1').addClass('active')
})

$('#pvp-tab').click(function () {
	$('.sub-tab').removeClass('show active')
	$('.sub-tab-button').removeClass('active')
	$('#pvp-content-1').addClass('show active')
	$('#pvp-tab-1').addClass('active')
})
