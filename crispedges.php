<!DOCTYPE HTML> 
<html lang="en">
	<head> 
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
		<title>HTML Canvas Image Zoom</title> 
		<style type="text/css" media="screen"> 
			body { margin:2em 4em; background:#ddd; text-align:center }
			img { vertical-align:top }
			input { width:2em; text-align:right }
			p.output { display:inline-block; text-align:center; margin:1em }
			p.output img, p.output canvas { display:block; margin:0.2em auto }
			canvas { display:inline; vertical-align:top }
			#byline { font-style:italic; font-size:smaller; color:#666 }
	    input[type="range"] { width:10em }
	    #i3 {
	     image-rendering:optimizeSpeed;
	     image-rendering:-moz-crisp-edges;
	     image-rendering:-o-crisp-edges;
	     image-rendering:optimize-contrast;
	     image-rendering:-webkit-optimize-contrast;
	     -ms-interpolation-mode: nearest-neighbor;
	   }
	    
		</style> 
	</head>

	<body> 
		<p>Original 16x16 Image <img id="i1" src="chrome.png"> zoom factor <input id="zoom" type="range" min="1" max="32" value="12" size="2">&times;</p>
		<p class="output"><img id="i2" src="chrome.png"> Zoomed by the Browser</p>
		<p class="output"><canvas id="c1"></canvas> Zoomed by <code>drawImage()</code></p>
		<p class="output"><canvas id="c2"></canvas> Zoomed by Code</p>
		<p class="output"><img id="i3" src="chrome.png"> Zoomed by the Browser/CSS</p>
		<p id="byline">Showing how to zoom up a bitmap with crisp edges using HTML Canvas. Written to support <a href="http://stackoverflow.com/questions/4875850/how-to-create-a-pixelized-svg-image-from-a-bitmap/4879849">this Stack Overflow answer</a>.</p>
		<script type="text/javascript">
		window.onload = function(){
			var img1 = document.getElementById('i1');
			var img2 = document.getElementById('i2');
			var img3 = document.getElementById('i3');
			var z    = document.getElementById('zoom');
			var c1   = document.getElementById('c1');
			var c2   = document.getElementById('c2');
			var ctx1 = c1.getContext('2d');
			var ctx2 = c2.getContext('2d');
			var zoom = 1;

			var offtx = document.createElement('canvas').getContext('2d');
			offtx.drawImage(img1,0,0);
			var imgData = offtx.getImageData(0,0,img1.width,img1.height).data;
			z.onkeyup = z.onchange = z.oninput = z.onmouseup = function(){
				var newZoom = z.value*1;
				if (isNaN(newZoom) || newZoom == zoom) return;
				zoom = newZoom;
				c1.width  = c2.width  = img2.width  = img3.width  = img1.width  * zoom;
				c1.height = c2.height = img2.height = img3.height = img1.height * zoom;

				ctx1.clearRect(0,0,c1.width,c1.height);
				ctx1.drawImage(img1,0,0,c1.width,c1.height);

				ctx2.clearRect(0,0,c2.width,c2.height);
				for (var x=0;x<img1.width;++x){
					for (var y=0;y<img1.height;++y){
						var i = (y*img1.width + x)*4;
						var r = imgData[i  ];
						var g = imgData[i+1];
						var b = imgData[i+2];
						var a = imgData[i+3];
						ctx2.fillStyle = "rgba("+r+","+g+","+b+","+(a/255)+")";
						ctx2.fillRect(x*zoom,y*zoom,zoom,zoom);
					}
				}
			};
			z.onkeyup();
		};
		</script>
	</body>
</html>