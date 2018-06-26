


<!DOCTYPE html>
<html>

<head>
  <title>Check Server Blocked</title>
  <meta name="viewport" content="width=device-width" charset="utf-8" />
  <link rel="stylesheet" href="//cdn.bootcss.com/mdui/0.4.0/css/mdui.min.css">
  <script src="//cdn.bootcss.com/mdui/0.4.0/js/mdui.min.js"></script>
  <style>
	a:link {color:black;}
	a:visited {color:black;}
	a:hover {color:black;}
	a:active {color:black;}
  </style>
</head>

<body>
<div class="mdui-appbar">
  <div class="mdui-toolbar mdui-color-indigo">
    <p class="mdui-typo-title">Check Server Blocked</p>
    <div class="mdui-toolbar-spacer"></div>
    <a href="/check" class="mdui-btn mdui-btn-icon"><font color="white"><i class="mdui-icon material-icons">refresh</i></font></a>
  </div>
</div>
  <div class="mdui-container">

<div>
  <div class="mdui-container-fluid">
    <br/>
      <div class="mdui-row">
        <div class="mdui-col-xs-12">
<?php
date_default_timezone_set('Asia/Shanghai');
$file_path = "./json/stats.json";
if(file_exists($file_path)){
$fp = fopen($file_path,"r");
$str = fread($fp,filesize($file_path));//指定读取大小，这里把整个文件内容读取出来
$str = str_replace("\r\n","<br />",$str);
$nodes=json_decode($str,true);
$count=count($nodes["servers"]);
}
?>		
          <div class="mdui-card">
            <div class="mdui-card-primary">
              <div class="mdui-card-primary-title">节点监测</div>
              <div class="mdui-card-primary-subtitle">测试结果可能受测试服务器网络影响，仅供参考。<br>最后更新于 : <?php echo date("Y-m-d H:i:s",$nodes["updated"]); ?></div>
            </div>
            <div class="mdui-card-content">
<?php
$x=0;
for ($i=1;$i<=$count;$i++) {
if ($nodes["servers"][$i-1]["status"]=="true") {
$x=$x+1;
}
}
echo "节点情况：总 ".$count."，正常 ".$x."，掉线/被墙 ".($count-$x);

?>
          
            </div>
		  </div>
		  
		  <br/>
		  
		  <div class="mdui-table-fluid">
		  <table class="mdui-table mdui-table-hoverable">
			<thead>
			  <tr>
			<th>状态</th>	
				<th>节点</th>
				<th>位置</th>
			
				<th>延迟</th>
			  </tr>
			</thead>
			<tbody>
			  <tr>
<?php

for ($i=1;$i<=$count;$i++) {
if ($nodes["servers"][$i-1]["status"]=="true") {

//$class="<button class='mdui-btn mdui-color-green mdui-ripple'><font style='color:white'>正常</font></button>";
$class="<button class='mdui-btn mdui-color-white mdui-ripple mdui-btn-dense mdui-btn-icon '><b><i class='mdui-icon material-icons' style='color:black'>wifi</i></b></button>";

}
else {
//$class="<i class='mdui-icon material-icons mdui-text-color-white'><b>close</b></i>";
$class="<button class='mdui-btn mdui-color-red mdui-ripple mdui-btn-dense mdui-btn-icon '><b><i class='mdui-icon material-icons' style='color:white'>close</i></b></button>";


}
//echo $nodes["servers"][$i-1]["name"]." ".$nodes["servers"][$i-1]["location"]." ".$nodes["servers"][$i-1]["time"]." ".$status."\r\n";
if ($nodes["servers"][$i-1]["PING_DELAY"]=="/")
{
	$delay="<b><font color='red'>/</font></b>";
}

elseif($nodes["servers"][$i-1]["PING_DELAY"]<100)
{
$delay="<b><font color='green'>".$nodes["servers"][$i-1]["PING_DELAY"]."</font></b>";
}
elseif($nodes["servers"][$i-1]["PING_DELAY"]>200 && $nodes["servers"][$i-1]["PING_DELAY"]<300)
{
$delay="<b><font color='red'>".$nodes["servers"][$i-1]["PING_DELAY"]."</font></b>";
}
elseif($nodes["servers"][$i-1]["PING_DELAY"]>=300)
{
$delay="<b><font color=#8B008B>".$nodes["servers"][$i-1]["PING_DELAY"]."</font></b>";
}

else {
$delay="<b><font color=#EE7942>".$nodes["servers"][$i-1]["PING_DELAY"]."</font></b>";
}
echo "<b><tr><td>".$class."</td><td><b>".$nodes["servers"][$i-1]["name"]."</b></td><td><b>".$nodes["servers"][$i-1]["location"]."</b></td><td>".$delay."</td></tr></b>";
}





?>


			</tbody>
		  </table>
		  </div>
		</div>
	  </div>
	<br/>
	<p style="text-align:center">© 2017~2018 myweb All Rights 

Reserved.</p>
  </div>
</div>
</div>
</body>
</html>

