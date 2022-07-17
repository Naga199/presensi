<!doctype html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>How to capture picture from webcam with Webcam.js</title>

</head>
<body>

	<!-- CSS -->
    <style>
    #my_camera{
        width: 320px;
        height: 240px;
        border: 1px solid black;
    }
	</style>

	<!-- -->
	<div id="my_camera"></div>
	<!--<input type=button value="Configure" onClick="configure()">-->
	<input type='button' value="Take Snapshot" onClick="take_snapshot()">
	
    <div id="results"  ></div>
	<input type='button' id="btnSave" value="Save Presensi" onClick="saveSnap()" style="display:none">
	
	<!-- Script -->
	<script type="text/javascript" src="<?= base_url(). 'assets/plugins/webcamjs/webcam.min.js' ?>"></script>
	<script type="text/javascript" src="<?= base_url(). 'assets/plugins/jQuery/jquery-2.2.3.min.js' ?>"></script>

	<!-- Code to handle taking the snapshot and displaying it locally -->
	<script language="JavaScript">
		configure();
		// Configure a few settings and attach camera
		function configure(){
			// Webcam.set({
			// 	width: 320,
			// 	height: 240,
			// 	image_format: 'jpeg',
			// 	jpeg_quality: 90,
			// 	force_flash: true
			// });
			Webcam.set({
				width: 500,
				height: 400,
				image_format: "jpeg",
				jpeg_quality: 90,
				force_flash: false,
				flip_horiz: true,
				fps: 45
			});

			Webcam.set("constraints", {
				optional: [{ minWidth: 600 }]
			});
			Webcam.attach( '#my_camera' );
		}
		// A button for taking snaps
		

		// preload shutter audio clip
		const pathShutter = navigator.userAgent.match(/Firefox/) ? 'shutter.ogg' : 'shutter.mp3';
		var shutter = new Audio();
		shutter.src = "<?= base_url('assets/plugins/webcamjs/'); ?>" + pathShutter;
		shutter.autoplay = false;

		function take_snapshot() {
			// play sound effect
			shutter.play();
			document.getElementById('btnSave').removeAttribute('style');
			// take snapshot and get image data
			Webcam.snap( function(data_uri) {
				// display results in page
				document.getElementById('results').innerHTML = 
					'<img id="imageprev" src="'+data_uri+'"/>';
			} );

			Webcam.reset();
			configure();
		}

		function saveSnap(){
			// Get base64 value from <img id='imageprev'> source
			var base64image =  document.getElementById("imageprev").src;

			 Webcam.upload( base64image, "<?= base_url('/Auth/upload') ?>", function(code, text) {
				 alert('Save successfully');
				 //console.log(code, text);
				 
				$.ajax({
				  url: "<?= base_url('/auth/addPresence') ?>",
				  data: {id_guru: "<?= $_GET['id_guru'] ?>", tipe: "<?= $_GET['tipe'] ?>", image: text ? text : null},
				  success: function(results) {
					 console.log(results);
					 document.location = "<?= base_url('/kehadiran') ?>";
				  },
				  //dataType: dataType
				});
            });

		}
	</script>
	
</body>
</html>
