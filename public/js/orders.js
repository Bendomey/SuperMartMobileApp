$(document).on('ready',function(){
	$('.acceptOrderBtn').click(function(){
		let id = $(this).data('order');
		$('#acceptOrderBtn').attr('href',`order/accept_order/${id}`);
		//for  modal
		$(this).attr({
			'data-toggle':'modal',
			'data-target':'#acceptOrder'
		})
	});

	$('.rejectOrderBtn').click(function(){
		let id = $(this).data('orderid');
		$('#acceptOrderBtn').attr('href',`order/reject_order/${id}`);
		//for  modal
		$(this).attr({
			'data-toggle':'modal',
			'data-target':'#rejectOrder'
		})
	});
})