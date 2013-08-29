<?php
$numero = (isset($_GET["n"]) ? $_GET["n"] : "25");
?>
<!DOCTYPE HTML>
<html>
	<head>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
		<style>
			img
			{
				position: absolute;
				top: 0;
				left: 0;
				height: 192px;
				width: auto;

				/* June 2013 */
				image-rendering: optimizeQuality;             /* Legal fallback                 */
				image-rendering: -moz-crisp-edges;          /* Firefox                        */
				image-rendering: -o-crisp-edges;            /* Opera                          */
				image-rendering: -webkit-optimize-contrast; /* Chrome (and eventually Safari) */
				image-rendering: optimize-contrast;         /* CSS3 Proposed                  */
				-ms-interpolation-mode: nearest-neighbor;   /* IE8+                           */
			}

			#f
			{
				animation: fade_f 1.5s infinite alternate;
				animation-timing-function: linear;

				-webkit-animation: fade_f 1.5s infinite alternate;
				-webkit-animation-timing-function: linear;
			}

			#m
			{
				animation: fade_m 1.5s infinite alternate;
				animation-timing-function: linear;

				-webkit-animation: fade_m 1.5s infinite alternate;
				-webkit-animation-timing-function: linear;
			}

			@keyframes fade_f
			{
				0%   {opacity: 0;}
				40%  {opacity: 0;}
				50%  {opacity: 1;}
				100% {opacity: 1;}
			}

			@-webkit-keyframes fade_f /* Safari and Chrome */
			{
				0%   {opacity: 0;}
				40%  {opacity: 0;}
				50%  {opacity: 1;}
				100% {opacity: 1;}
			}

			@keyframes fade_m
			{
				0%   {opacity: 1;}
				50%  {opacity: 1;}
				60%  {opacity: 0;}
				100% {opacity: 0;}
			}

			@-webkit-keyframes fade_m /* Safari and Chrome */
			{
				0%   {opacity: 1;}
				50%  {opacity: 1;}
				60%  {opacity: 0;}
				100% {opacity: 0;}
			}
		</style>

		<script>
			var img = new Image();

			// original image at
			// 
			// encoded via http://www.scalora.org/projects/uriencoder/
			img.src = $("#m").src();//'http://upload.wikimedia.org/wikipedia/commons/9/95/The_Gunk.png';

			img.onload = function() {

		    console.log(new Date().valueOf());

		    var scale = 2;

		    var src_canvas = document.createElement('canvas');
		    src_canvas.width = this.width;
		    src_canvas.height = this.height;

		    var src_ctx = src_canvas.getContext('2d');
		    src_ctx.drawImage(this, 0, 0);
		    var src_data = src_ctx.getImageData(0, 0, this.width, this.height).data;

		    var sw = this.width * scale;
		    var sh = this.height * scale;

		    var dst_canvas = document.getElementById('canvas');
		    dst_canvas.width = sw;
		    dst_canvas.height = sh;
		    var dst_ctx = dst_canvas.getContext('2d');

		    var dst_imgdata = dst_ctx.createImageData(sw, sh);
		    var dst_data = dst_imgdata.data;

		    var src_p = 0;
		    var dst_p = 0;
		    for (var y = 0; y < this.height; ++y) {
		        for (var i = 0; i < scale; ++i) {
		            for (var x = 0; x < this.width; ++x) {
		                var src_p = 4 * (y * this.width + x);
		                for (var j = 0; j < scale; ++j) {
		                    var tmp = src_p;
		                    dst_data[dst_p++] = src_data[tmp++];
		                    dst_data[dst_p++] = src_data[tmp++];
		                    dst_data[dst_p++] = src_data[tmp++];
		                    dst_data[dst_p++] = src_data[tmp++];
		                }
		            }
		        }
		    }

		    dst_ctx.putImageData(dst_imgdata, 0, 0);

		    console.log(new Date().valueOf());

		};
		</script>
	</head>

	<body>
		<center>
			<div>
				<img id="f" src="http://www.pokebip.com/pokemon/pokedex/images/bw_front_f/<?php echo $numero; ?>.png" />
				<img id="m" src="http://www.pokebip.com/pokemon/pokedex/images/bw_front_m/<?php echo $numero; ?>.png" />
			</div>
		</center>
		<canvas id="canvas" />
	</body>
</html>