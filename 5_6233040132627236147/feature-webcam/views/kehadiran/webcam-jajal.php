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

	<div id="my_camera"></div>
	<input type=button value="Take Snapshot" onClick="take_snapshot()">
	
    <div id="results" ></div>
	
	<!-- Webcam.min.js -->
	<script type="text/javascript" src="<?= base_url(). 'assets/plugins/webcamjs/webcam.min.js' ?>"></script>

	<!-- Configure a few settings and attach camera -->
	<script language="JavaScript">
	 // Configure a few settings and attach camera
    Webcam.set({
      width: 320,
      height: 240,
      image_format: 'jpeg',
      jpeg_quality: 90
    });
    Webcam.attach( '#my_camera' );
    
    // preload shutter audio clip
		const pathShutter = navigator.userAgent.match(/Firefox/) ? 'shutter.ogg' : 'shutter.mp3';
		var shutter = new Audio();
		shutter.src = "<?= base_url('assets/plugins/webcamjs/'); ?>" + pathShutter;
    
    function take_snapshot() {
        // play sound effect
        shutter.play();
    
        // take snapshot and get image data
        Webcam.snap( function(data_uri) {
            // display results in page
            document.getElementById('results').innerHTML = 
            '<img src="'+data_uri+'"/>';
        } );
    }
	</script>
	
</body>
</html>
