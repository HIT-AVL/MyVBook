<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charxset=utf-8" />
<title>好友列表显示</title>
</head>
<body>
<?php if( is_array( $friends['users'] ) ): ?>
<?php foreach( $friends['users'] as $item ): ?>
<div style="padding:10px;margin:5px;border:1px solid #ccc">
	<?php echo $item['screen_name'];echo ' ';echo $item['id'];?>
</div>
<?php endforeach; ?>
<?php endif; ?>
</body>
</html>