function update(){
	$.getJSON('get', function(data){
		var i, html = '<hr>', line, uid = $('#user_id').val(), role = $('#role').val();
		for (i = 0; i < data.length; i++) {
			line = data[i]['Data'];
			html += '<b>' + h(data[i]['User']['username']) + '</b> ' + a(h(line['message'])) + ' (' + h(line['created']) + ') ';
			if (line['user_id'] === uid || role === 'admin')
				html += '<a href="javascript:d(' + line['id'] + ')">delete</a>';
			html += '<hr>';
		}
		$('#main').html(html);
	});
}

//HTMLエスケープ
function h(text){
	return text.replace(/&/g,'&amp;').replace(/"/g,'&quot;').replace(/'/g,'&#039;').replace(/</g,'&lt;').replace(/>/g,'&gt;');
}

//URLにaタグをつける
function a(text){
	return text.replace(/((http|https|ftp):\/\/[\w?=&.\/-;#~%-]+(?![\w\s?&.\/;#~%"=-]*>))/g,'<a href="$1" target="_blank">$1</a>');
}

function d(id) {
	if (window.confirm('Are you sure you want to delete # ' + id + '?'))
		$.post('delete/' + id, update);
}

function submit() {
	$.post('post', {message: $('#message').val()}, update);
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
