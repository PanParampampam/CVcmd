Mousetrap.bind ('enter', function (){
	window.location.href = "cv.php";
});

 function showMyImage(fileInput) {
		var files = fileInput.files;
		for (var i = 0; i < files.length; i++) {           
			var file = files[i];
			var imageType = /image.*/;     
			if (!file.type.match(imageType)) {
				continue;
			}           
			var img=document.getElementById("Foto");            
			img.file = file;    
			var reader = new FileReader();
			reader.onload = (function(aImg) { 
				return function(e) { 
					aImg.src = e.target.result; 
				}; 
			})(img);
			reader.readAsDataURL(file);
		}    
	}