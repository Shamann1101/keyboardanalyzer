// JavaScript Document
$(function() {
	var $keyboardtarget = $('#keyboardtarget'),
	today = new Date(),
	date_load = today.getDate() + "-" + (today.getMonth() + 1) + "-" + today.getFullYear(),
	time_load = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
	
		$( document ).ready(function() {
			var today = new Date(),
			date_load = today.getDate() + "-" + (today.getMonth() + 1) + "-" + today.getFullYear(),
			time_load = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
			});
		key = $(document).keydown(function (event) {
			var keycode = (event.keyCode ? event.keyCode : event.which);
/*			$$('keyboardtarget',keycode);*/
			return keycode;
		});

		analyzer = $('.table td').click(function(key) {
			var $this = $(this),
/*			key = $this.html(),*/
			key = $(this).attr('id'),
			key_time = new Date(),
/*			date_key = key_time.getDate() + "-" + (key_time.getMonth() + 1) + "-" + key_time.getFullYear(),
			time_key = key_time.getHours() + ":" + key_time.getMinutes() + ":" + key_time.getSeconds(),*/
			request = $.ajax({
				url: "robot.php",
				type: "POST",
				data: {
					'date_load' : date_load,
					'time_load' : time_load,
/*					'date_key' : date_key,
					'time_key' : time_key,*/
					'key' : key
				},	//Данные уходят
				success: function() {
					console.log('success', arguments);
				},
				error: function() {
					console.log('error', arguments);
				},
				complete: function() {
					console.log('complete', arguments);
				}
			}).done(function(data) {
				console.log('done', arguments);
				$$('keyboardtarget',data);
				});
		/*	$keyboardtarget.html(key);*/
		})
});
