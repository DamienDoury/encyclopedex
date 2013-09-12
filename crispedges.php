<!DOCTYPE HTML> 
<html lang="en">
	<head> 
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
		<title>HTML Canvas Image Zoom</title> 
		<style type="text/css" media="screen"> 
			body { margin:2em 4em; background:#ddd; text-align:center }
		
			canvas { display: inline-block; vertical-align:top }
	    	#portraitt { width: 288px; height: 288px; }
		</style>
		
	</head>

	<body> 
		<canvas id="portraitt"></canvas>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
		<script type="text/javascript">
		$(document).ready(function(){
			var canvas = $("#portraitt").get(0);
			var ctxt = canvas.getContext('2d');
			var zoom = 3;
			var img_height = 96;
			var img_width = 96;

			img = new Image();
			img.src = "/images/pkmn/fixe/214.png";			
			img.onload = function()
			{
				var virtual_ctxt = document.createElement('canvas').getContext('2d');
				virtual_ctxt.drawImage(img, 0, 0);
				var imgData = virtual_ctxt.getImageData(0, 0, img_width, img_height).data;

				canvas.width  = img_width  * zoom;
				canvas.height = img_height * zoom;
				
				for(var x = 0; x < img_width; x++)
				{
					for(var y = 0; y < img_height; y++)
					{
						var i = (y * img_width + x) * 4;
						var r = imgData[i+0];
						var g = imgData[i+1];
						var b = imgData[i+2];
						var a = imgData[i+3];
						ctxt.fillStyle = "rgba(" + r + "," + g + "," + b + "," + (a / 255) + ")";
						ctxt.fillRect(x * zoom, y * zoom, zoom, zoom);
					}
				}
			};


		});
		</script>
	</body>
</html>