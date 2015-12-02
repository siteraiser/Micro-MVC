<!DOCTYPE html>
<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name=viewport content="width=device-width, initial-scale=1">
<?php /*<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" /> */ ?>

<?php echo (isset($meta) ? $meta : '');?>

<?php echo(isset($title) ? "<title>$title</title>" : '')?>

<?php echo(isset($description) ? "<meta name=\"description\" content=\"$description\"> ": '');?>					

<?php echo(isset($keywords) ? "<meta name=\"keywords\" content=\"$keywords\"> ": '');?>						


<?php if($this->path!='home'){ 
?>
min-height:800px;
<?php
}
?>

<?php if($this->path=='home'){ 
?>
@media screen and (max-width: 400px) {
.div1{ min-width:375px;}
}
<?php
}
?>


</style>

<body>


<nav>
	<ul>
		<li <?php $length=strlen($url=$this->base_url.'pages/page1'); echo(substr($this->base_url.$this->path,0,$length) == $url ? 'class="active"' : '');?>><a href="<?php echo $url;?>">Page1</a></li>				
		<li <?php $length=strlen($url=$this->base_url.'pages/page2'); echo(substr($this->base_url.$this->path,0,$length) == $url ? 'class="active"' : '');?>><a href="<?php echo $url;?>">Page2</a></li>
	</ul>	
</nav>
<main>