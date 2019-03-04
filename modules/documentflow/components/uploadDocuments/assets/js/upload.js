// ************************ Drag and drop ***************** //
var dropArea = document.getElementById("drop-area")
var fileElem = document.getElementById('fileElem');
var gallery = document.getElementById('gallery');

// Prevent default drag behaviors
;['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
	dropArea.addEventListener(eventName, preventDefaults, false)
	document.body.addEventListener(eventName, preventDefaults, false)
})

// Highlight drop area when item is dragged over it
;['dragenter', 'dragover'].forEach(eventName => {
	dropArea.addEventListener(eventName, highlight, false)
})

;['dragleave', 'drop'].forEach(eventName => {
	dropArea.addEventListener(eventName, unhighlight, false)
})

dropArea.addEventListener('DOMNodeInserted',function () {
	$('.uploadIcon').css('display','none');
	if($('#gallery').children().length > 1) {
		$('#gallery').children().first().remove();
	}
});

// Handle dropped files
dropArea.addEventListener('drop', handleDrop, false)

function preventDefaults (e) {
	e.preventDefault()
	e.stopPropagation()
}

function highlight(e) {
	dropArea.classList.add('highlight');
}

function unhighlight(e) {
	dropArea.classList.remove('active');
}

function handleDrop(e) {
	var dt = e.dataTransfer;
	var files = dt.files;
	handleFiles(files);
}

function handleFiles(files) {
	files = [...files];
	files.forEach(previewFile);
}

function previewFile(file) {
	var reader = new FileReader();
	reader.onloadend = function() {
		var re = /\..+$/;
		var ext = file.name.match(re);

		dropArea.style.height = '40px';
		let div = document.createElement('div');
		div.innerText = ext.input;
		div.id = ext[0];
		div.style.paddingTop = '12px';
		gallery.appendChild(div);
	}
	reader.readAsDataURL(file);
}

function readURL(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();
		reader.onload = function (e) {
			$('#image_upload_preview').attr('src', e.target.result);
		}
		reader.readAsDataURL(input.files[0]);
	}
}

function dataURLtoFile(dataurl, filename) {
	var arr = dataurl.split(','), mime = arr[0].match(/:(.*?);/)[1],
		bstr = atob(arr[1]), n = bstr.length, u8arr = new Uint8Array(n);
	while(n--){
		u8arr[n] = bstr.charCodeAt(n);
	}
	return new File([u8arr], filename, {type:mime});
}




