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

    	document.onkeydown = handle;

    	function handle(e) {
            getData(e.keyCode);
        }

		var analyzer = $('.table td').click(function() {
			var $this = $(this),
			key = $(this).attr('id');
			getData(key);
		});
		
		function go2(){$("#keyboardtarget").load("index.html #keyboardtarget");};
		
		function on2() {timeoutId = setTimeout(go2, 3000)};
		
		function getData (key) {
			request = $.ajax({
				url: "robot.php",
				type: "POST",
				data: {
					'date_load' : date_load,
					'time_load' : time_load,
					'key' : key
				},
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
				on2();
				});
		}
});

