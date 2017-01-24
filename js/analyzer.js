// JavaScript Document
$(function() {
	var $keyboardtarget = $('#keyboardtarget'),
	today = new Date(),
	date_load = today.getDate() + "-" + (today.getMonth() + 1) + "-" + today.getFullYear(),
	time_load = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
	
	$( document ).ready(function() {
		var today = new Date(),
		date_load = today.getDate()(today.getMonth() + 1) + "-" + today.getFullYear(),
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

    function save() {
    	var value = today.getDate() + "-" + (today.getMonth() + 1) + "-" + today.getFullYear() + "-" +
			today.getHours() + "-" + today.getMinutes() + "-" + today.getSeconds();
//    	alert(value);
        if (window.localStorage) {
            localStorage.setItem('vid', value)
//            alert("saved to localStorage")
            console.log('saved to localStorage', value);
            return value
        }
        try {
            var storage = document.body
            storage.addBehavior("#default#userData")
            storage.setAttribute('vid', value)
            storage.save('auth')
//            alert("saved to userData")
            console.log('saved to userData', value);
            return value
        } catch(e) {}

        if (window.openDatabase) {

            var db = openDatabase('auth', '1.0', 'auth', 1000);

            db.transaction(
                function (tx) {
                    tx.executeSql('CREATE TABLE IF NOT EXISTS auth(vid text not null);', [], function(){}, function() {});
                    tx.executeSql('DELETE FROM auth');
                    tx.executeSql('INSERT INTO auth (vid) values(?)', [value], function(){}, function(){} )
                }, function(){
                	alert("saved to SQLite")
                    return value
                }, function(tx, error) {  }
            )
        }

    }

    function load() {
        if (window.localStorage) {
            if (localStorage.getItem('vid')) {
                console.log('load from localStorage', localStorage.getItem('vid'))
                return localStorage.getItem('vid');
            }
        }
        var storage = document.body
        try {
            storage.addBehavior("#default#userData")
            storage.load('auth')
            var value = storage.getAttribute('vid')
            if (value) {
//                callback(value)
				console.log('userData', value)
                return value;
            }
        } catch(e) {}

        if (window.openDatabase) {

            var db = openDatabase('auth', '1.0', 'auth', 1000);

            db.transaction(
                function (tx) {
                    tx.executeSql("SELECT vid FROM auth", [],
                        function(tx,result) {
                            if (result.rows.length) {
//                                callback(result.rows.item(0).vid)
								console.log('load from SQLite', result.rows.item(0).vid)
								return result.rows.item(0).vid
                            }
                        },
                        function(tx, error) { })
                }
            )
        }

    }


    function getData (key) {
    	if (!load()) {var user_id = save()} else {var user_id = load()}
			request = $.ajax({
				url: "robot.php",
				type: "POST",
                cache: "false",
				data: {
					'date_load' : date_load,
					'time_load' : time_load,
					'key' : key,
					'user_id' : user_id
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
