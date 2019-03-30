
// for image preview
function previewImage(event){
    var reader = new FileReader();
    var imageField = document.querySelector('.profileImg');

    reader.onload = function () {
        if (reader.readyState == 2){
            imageField.src = reader.result;
        }
    }

    reader.readAsDataURL(event.target.files[0]);
}


$(document).ready(() => {
	$('.editForPersonalInfo').click(()=>{
		$('.personalInfo').removeAttr('readonly');
		$('.editForPersonalInfo').hide()
		$('.saveForPersonalInfo').removeClass('d-none')
	})
})