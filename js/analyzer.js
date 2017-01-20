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
	
	$('.table td').click(function() {
		var $this = $(this),
			key = $this.html(),
			key_time = new Date(),
			date_key = key_time.getDate() + "-" + (key_time.getMonth() + 1) + "-" + key_time.getFullYear(),
			time_key = key_time.getHours() + ":" + key_time.getMinutes() + ":" + key_time.getSeconds(),
			request = $.ajax({
				url: "robot.php",
				type: "POST",
				data: {
					date_load : date_load,
					time_load : time_load,
					date_key : date_key,
					time_key : time_key,
					key : key
					},	//Данные уходят
				dataType: "json"
			}),
			response = $.ajax({
			  url: "robot.php",
			  cache: false
			}).done(function( html ) {
			  $keyboardtarget.append(html);
			});

		request.done(function(msg) {
		  alert( msg );
		});

		request.fail(function(jqXHR, textStatus) {
		  alert( "Request failed: " + textStatus );
		});


		$keyboardtarget.html(response);
	})
});