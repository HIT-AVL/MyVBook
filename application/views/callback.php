<html>
<?php if ($flag == TRUE) { ?>
授权完成,<a href="weibolist">进入你的微博列表页面</a><br />
<a href = "getfriends">查看好友列表</a><br />
<a href = "convertopdf">转pdf</a><br />
<?php
} else {
?>
授权失败。
<?php
}
?>
</html>
