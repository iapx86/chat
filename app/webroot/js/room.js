function update(){
	$.getJSON('get', function(data){
		var i, html, user_id = $('#user_id').val(), role = $('#role').val();
		for(html = '<hr>', i = 0; i < data.length; i++){
			html += '<b>' + h(data[i]['User']['username']) + '</b> ' + h(data[i]['Data']['message']);
			html += ' (' + h(data[i]['Data']['created']) + ') ';
			if (data[i]['Data']['user_id'] === user_id || role === 'admin')
				html += '<a href="javascript:d(' + data[i]['Data']['id'] + ')">delete</a>';
			html += '<hr>';
		}
		$('#main').html(html);
	});
}

//HTMLエスケープ
function h(text){
	return text.replace(/&/g,'&amp;').replace(/"/g,'&quot;').replace(/'/g,'&#039;').replace(/</g,'&lt;').replace(/>/g,'&gt;');
}

function d(id) {
	if (window.confirm('Are you sure you want to delete # ' + id + '?'))
		$.post('delete/' + id, update);
}

function submit() {
	var data = {user_id: $('#user_id').val(), message: $('#message').val()};
	$.post('post', data, update);
	$('#message').val('');
}

$(function(){
	//1秒ごとに読み込み
	setInterval(update, 1000);

	//キーを押したときの動作
	$('#message').keypress(function (event) {
		switch(event.which) {
		case 13: // Enterキー
			submit();
			break;
		}
	});
});
