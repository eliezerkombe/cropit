<?php 
	$dataid = $_GET['dataid'];
?>
   <style>
   	   #upload-picture-wrapper{
		   width:500px;
		   height:500px;
		   }
	   .upload-profile-photo-header{
		   background:rgba(178,0,2,0.10);
		   height:30px;
		   font-size:20px;
		   padding-top:5px;
		   text-align:center;
		   font-weight:bold;
		   }
      .image-editor{
		  width:300px;
		  margin:30px 102px;
		  }
      .cropit-image-preview-container{
		  margin:0px 20px;
		  }
      .cropit-image-preview {
        background-color: #f8f8f8;
        background-size: cover;
        border: 5px solid #bec4d2;
        border-radius: 100%;
        margin-top: 7px;
        width: 250px;
        height: 250px;
        cursor: move;
      }

      .cropit-image-background {
        opacity: .2;
        cursor: auto;
      }

      .image-size-label {
		 font-weight:bold;
		 margin:20px 0 0 115px; 
      }

      .cropit-image-zoom-input {
        /* Use relative position to prevent from being covered by image background */
        position: relative;
        z-index: 10;
        display: block;
		 margin:10px 0 0 90px;
      }

      .export {
        margin-top: 10px;
      }
	  .cropit-image-input{
		 display:none;  
	  }
	  .upload{
		  cursor:pointer;
		  border:3px solid rgba(41,60,107,0.70); 
		  -webkit-border-radius: 4px; 
		  -moz-border-radius: 4px;
		  border-radius: 4px;
		  font-size:12px;
		  font-family:arial, helvetica, sans-serif;
		  padding: 10px 10px 10px 10px; 
		  text-decoration:none; 
		  display:inline-block;
		  font-weight:bold; 
		  color: rgba(41,60,107,0.70);
		  background-color: white; 
		  margin:0px 30px 0px 40px;
		  }
	  .upload:hover{
 		  border:3px solid rgba(41,60,107,0.70);
		  color:rgba(41,60,107,0.70);
		  }
	  .export{
		  cursor:pointer;
		  border:3px solid #293c6b; 
		 -webkit-border-radius: 4px; 
		 -moz-border-radius: 4px;
		 border-radius: 4px;
		 font-size:12px;
		 font-family:arial, helvetica, sans-serif; 
		 padding: 10px 10px 10px 10px; 
		 text-decoration:none; 
		 display:inline-block;
		 font-weight:bold; 
		 color: #293c6b;
		 background-color: white; 
		  }
		  .export:hover{
		  border:3px solid #293c6b;
		  color:#293c6b;
		  } 	  
    </style>
    <div id="upload-picture-wrapper">
    <div class="upload-profile-photo-header">Upload Profile Photo</div>
    <div class="image-editor">
      <!-- .cropit-image-preview-container is needed for background image to work -->
      <div class="cropit-image-preview-container">
        <div class="cropit-image-preview"></div>
      </div>
      <div class="image-size-label">
        Resize image
      </div>
      <input type="range" class="cropit-image-zoom-input">
      <button class="upload">Upload Image</button>
      <input type="file" class="cropit-image-input">
      <button class="export">Update</button>
      <div class="photo-upload-error"></div>
    </div>
    </div>
    <script>
	var dataid = '<?php echo $dataid ?>';
      $(function() {
		$('.image-editor').cropit({
          exportZoom: 1.25,
          imageBackground: true,
          imageBackgroundBorderWidth: 20,
          imageState: {
            //src: 'http://lorempixel.com/500/400/'
            src: dataid
          }
        });

        $('.export').click(function() {
          		var imageData = $('.image-editor').cropit('export');
          		//window.open(imageData);
				  $.post('model/profile-photo-script.php',{profilephoto:imageData}, function(data){
						if(data=='success'){
							location.reload();
							}else{
								$('.photo-upload-error').html(data);
								}
					  });
			});
      });
	  $('.upload').on('click',function(){
		  $('.cropit-image-input').click();
		  });
    </script>