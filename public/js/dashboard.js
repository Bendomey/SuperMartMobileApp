
$(document).ready(function(){
	//for categories
	$('.deleteCatButton').click(function() {
		let data = $(this).data('category');
		$('#ConfirmDeleteButton').attr('href',`/view_categories/delete_phase/${data.id}`);
		//for modal
		$(this).attr({
			'data-toggle':'modal',
			'data-target':'#confirmDelete'
		})
	})

	$('.updateCatButton').click(function(){
		let data = $(this).data('categories');
		$('.categoryID').val(data.id);
		$('.inputCategoryName').val(data.category_name);
		$(this).attr({
			'data-toggle':'modal',
			'data-target':'#updateCategory'
		})	
	})


	//for products
	$('.deletePoductButton').click(function(){
		let data = $(this).data('product');
		$('#ConfirmDeleteButtonForProduct').attr('href',`product/delete_phase/${data}`);
		//for modal
		$(this).attr({
			'data-toggle':'modal',
			'data-target':'#confirmDeleteForProduct'
		})
	})


	//for featured
	$('.featureButton').click(function(){
		let data = $(this).data('product')
		// alert(data)
		$.ajax({
			type: 'Get',
			url: `/feature/${data}`,
			dataType:'jSON',
			success: (data) => {
				console.log(data);
				$(this).attr('hidden',true);
				$('.unFeatureButton').removeAttr('hidden');
			},
			error: (err) =>{
				alert('error');
			}
		})
	})

	//for unfeatured
	$('.unFeatureButton').click(function(){
		let data = $(this).data('product')
		// alert(data)
		$.ajax({
			type: 'Get',
			url: `/unfeature/${data}`,
			dataType:'jSON',
			success: (data) => {
				console.log(data);
				$(this).attr('hidden',true);
				$('.featureButton').removeAttr('hidden');
			},
			error: (err) =>{
				alert('error');
			}
		})
	})

		//for promo
	$('.promoteButton').click(function(){
		let data = $(this).data('product')
		// alert(data)
		$.ajax({
			type: 'Get',
			url: `/promote/${data}`,
			dataType:'jSON',
			success: (data) => {
				console.log(data);
				$(this).attr('hidden',true);
				$('.unPromoteButton').removeAttr('hidden');
			},
			error: (err) =>{
				alert('error');
			}
		})
	})

	//for unpromo
	$('.unPromoteButton').click(function(){
		let data = $(this).data('product')
		// alert(data)
		$.ajax({
			type: 'Get',
			url: `/unPromote/${data}`,
			dataType:'jSON',
			success: (data) => {
				console.log(data);
				$(this).attr('hidden',true);
				$('.promoteButton').removeAttr('hidden');
			},
			error: (err) =>{
				alert('error');
			}
		})
	})

		//for recommended
	$('.recommendButton').click(function(){
		let data = $(this).data('product')
		// alert(data)
		$.ajax({
			type: 'Get',
			url: `/recommended/${data}`,
			dataType:'jSON',
			success: (data) => {
				console.log(data);
				$(this).attr('hidden',true);
				$('.unRecommendButton').removeAttr('hidden');
			},
			error: (err) =>{
				alert('error');
			}
		})
	})

	//for unrecommended
	$('.unRecommendButton').click(function(){
		let data = $(this).data('product')
		// alert(data)
		$.ajax({
			type: 'Get',
			url: `/unRecommended/${data}`,
			dataType:'jSON',
			success: (data) => {
				console.log(data);
				$(this).attr('hidden',true);
				$('.recommendButton').removeAttr('hidden');
			},
			error: (err) =>{
				alert('error');
			}
		})
	})

	// //for search
	// $('.search_criteria').on('keypress',function(){
	// 	let data = $(this).val()		
	// 	$.ajax({
	// 		type:'GET',
	// 		url:'/search_product/' + data,
	// 		dataType:'json',
	// 		success:(data) => {
	// 			console.log(data);
	// 		},
	// 		error:(err) => {
	// 			console.log("error");
	// 		}
	// 	})
	// })

})