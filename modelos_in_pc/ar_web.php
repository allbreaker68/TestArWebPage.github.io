<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="ar_web.css">
<!-- Import the component -->
<meta charset="UFT-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>
<script nomodule src="https://unpkg.com/@google/model-viewer/dist/model-viewer-legacy.js"></script>


<!--<center>AR Test Page</center>-->
</head>
  <body>
    <?php 
      Include("select.php")

      


      

    ?>
    

    <script language="JavaScript" Type="text/javascript">
      <!--  
      window.addEventListener('contextmenu', function (e) {
  
      e.preventDefault();
      }, false);
      //-->
    </script>
   	<section>
      <model-viewer controls controlsList="nodownload" src="<?php echo $modeloglb; ?> " ios-src="<?php echo $modelousdz; ?>" magic-leap ar  camera-controls autoplay> </model-viewer> 
    </section>
  </body>
</html>