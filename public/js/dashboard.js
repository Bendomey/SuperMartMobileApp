
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
	$('.deleteProductButton').click(function(){
		let data = $(this).data('product');
		$('#ConfirmDeleteButtonForProduct').attr('href',`product/delete_phase/${data}`);
		//for modal
		$(this).attr({
			'data-toggle':'modal',
			'data-target':'#confirmDeleteForProduct'
		})
	})


// for removing store
	$('#removeStore').click(function(){
		let id = $(this).data('id');
		$('#ConfirmDeleteStoreButton').attr('href',`/stores/${id}/delete_store`);
		//for modal
		$(this).attr({
			'data-toggle':'modal',
			'data-target':'#confirmDeleteStore'
		});	
	});

});


