<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
		<title>Monoslideshow Example page</title>
		<script type="text/javascript" src="swfobject.js"></script>
		<style type="text/css">
			body{margin:0px 0px 0px 0px}
		</style>
	</head>
	<body>
		<div id="monoSlideshow">
			<p><strong>Please install Flash and turn on Javascript.</strong></p>
		</div>
		<script type="text/javascript">
			// <![CDATA[
			var so = new SWFObject("monoslideshow.swf", "SOmonoSlideshow", "500", "333", "7", "#ffffff");
			so.addVariable("dataFile", "slideshowxml.php?cd=<?=$_GET["cd"]?>");
			so.write("monoSlideshow");
			// ]]>
		</script>
	</body>
</html>