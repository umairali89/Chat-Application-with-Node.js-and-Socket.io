<html>
<head>
	<title>Chat Room with socket.io and node.js</title>
	<style>
		#chat{
			height:500px;
		}
		#contentWrap{
			display: none;
		}
		#chatWrap{
			float: left;
			border: 1px #000 solid;
		}
		.error{
			color: red;
		}
		.whisper{
			color: gray;
			font-style: italic;
		}
	</style>
</head>
<body>
	<div id="nickWrap">
		<p>Enter a username:</p>
		<p id="nickError"></p>
		<form id="setNick">
			<input size="35" id="nickname"></input>
			<input type="submit"></input>
		</form>
	</div>

	<div id="contentWrap">
		<div id="chatWrap">
			<div id="chat"></div>
			<form id="send-message">
				<input size="35" id="message"></input>
				<input type="submit"></input>
			</form>
		</div>
		<div id="users"></div>
	</div>
	
	<script src="http://code.jquery.com/jquery-latest.min.js"></script>
	<script src="/socket.io/socket.io.js"></script>
	<script>
		jQuery(function($){
			var socket = io.connect();
			var $nickForm = $('#setNick');
			var $nickError = $('#nickError');
			var $nickBox = $('#nickname');
			var $users = $('#users');
			var $messageForm = $('#send-message');
			var $messageBox = $('#message');
			var $chat = $('#chat');
			
			$nickForm.submit(function(e){
				e.preventDefault();
				socket.emit('new user', $nickBox.val(), function(data){
					if(data){
						$('#nickWrap').hide();
						$('#contentWrap').show();
						//debug
						  alert("nickformsubmit");
					} else{
						$nickError.html('That username is already taken!  Try again.');
					}
				});
				$nickBox.val('');
			});
			
			socket.on('usernames', function(data){
				var html = '';
				for(i=0; i < data.length; i++){
					html += data[i] + '<br/>'
				}
				$users.html(html);
			});
			
			$messageForm.submit(function(e){
				e.preventDefault();
				socket.emit('send message', $messageBox.val(), function(data){
					$chat.append('<span class="error">' + data + "</span><br/>");
				});
				$messageBox.val('');
				//debug
				alert("messageForm");
			});
			
			socket.on('new message', function(data){
				$chat.append('<span class="msg"><b>' + data.nick + ': </b>' + data.msg + "</span><br/>");
			});
			
			socket.on('whisper', function(data){
				$chat.append('<span class="whisper"><b>' + data.nick + ': </b>' + data.msg + "</span><br/>");
			});
		});
	</script>
</body>
</html>