// jQuery short-hand for $(document).ready(function() {});
$(function () {

	// selecting user to chat with from the EP Applicants page 
	// when user is selected, get user data from localStorage
	if(localStorage.getItem("user_id")){
		chat_section(1);
		var receiver_id = localStorage.getItem("user_id");
		//alert(receiver_id);
		$('#receiver_id').val(receiver_id);
		$('#receiver_name').html(localStorage.getItem("user_fname") + " " + localStorage.getItem("user_lname"));
		get_chat_history(receiver_id);
		// after getting the data from the EP Applicants page, localStorage is emptied
		localStorage.clear();
	}
	
	$('.chat_table').DataTable({
		"lengthMenu": [3, 5, 10],
	});
	  
	// selecting user to chat with from the datatable in the Chat Room page
	$('.chat_table tbody').on('click', 'td', function () {
		chat_section(1);
		var receiver_id = $(this).attr('id');
		//alert(receiver_id);
		$('#receiver_id').val(receiver_id);
		$('#receiver_name').html($(this).attr('title'));
		get_chat_history(receiver_id); 
	});

	// Allows user to send message by tapping the 'Enter' key
	$('#message').keypress(function (event) {
		var keycode = (event.keyCode ? event.keyCode : event.which);
		// keycode '13' refers to the 'Enter' key on the keyboard
		if (keycode == '13') {
			send_text($(this).val());
		}
	});

	$('.btn_send').click(function () {
		send_text($('#message').val());
	});

	$('.upload_attachment').change(function () {
		display_message('<div class="spiner"><i class="fa fa-circle-o-notch fa-spin"></i></div>');
		scroll_down();

		var file_data = $('.upload_attachment').prop('files')[0];
		var receiver_id = $('#receiver_id').val();
		var form_data = new FormData();
		form_data.append('attachmentfile', file_data);
		form_data.append('type', 'Attachment');
		form_data.append('receiver_id', receiver_id);

		$.ajax({
			url: 'Chat/send_text_message',
			dataType: 'json',
			cache: false,
			contentType: false,
			processData: false,
			data: form_data,
			type: 'post',
			success: function (response) {
				$('.upload_attachment').val('');
				get_chat_history(receiver_id);
			},
			error: function (jqXHR, status, err) {
				// alert('Local error callback');
			}
		});
	});

	// $('.clear_chat').click(function () { 
	// 	var receiver_id = $('#receiver_id').val();
	// 	//alert(receiver_id);
	// 	$.ajax({
	// 		//dataType : "json",
	// 		url: 'Chat/clear_chat?receiver_id=' + receiver_id,
	// 		success: function (data) {
	// 			get_chat_history(receiver_id);
	// 		},
	// 		error: function (jqXHR, status, err) {
	// 			// alert('Local error callback');
	// 		}
	// 	});
	// });

});	// end of jquery


function chat_section (status) {
	if (status == 0) {
		$('#chat_section :input').attr('disabled', true);
	} else {
		$('#chat_section :input').removeAttr('disabled');
	}
}

chat_section(0);

function scroll_down() {
	var elmnt = document.getElementById("content");
	var h = elmnt.scrollHeight;
	$('#content').animate({ scrollTop: h }, 1500);
}

window.onload = scroll_down();

function display_message(message) {
	var sender_name = $('#sender_name').val();
	var sender_pic = $('#sender_pic').val();

	var str = '<div class="direct-chat-msg right">';
	str += '<div class="direct-chat-info clearfix">';
	str += '<span class="direct-chat-name pull-right">' + sender_name;
	str += '</span><span class="direct-chat-timestamp pull-left"></span>'; //30 Apr 3:00 PM
	str += '</div><img class="direct-chat-img" src="' + sender_pic + '" alt="">';
	str += '<div class="direct-chat-text">' + message;
	str += '</div></div>';
	$('#dump_content').append(str);
}

function send_text(message) {
	//alert(message);
	var text_message = message.trim();
	if (text_message != '') {
		display_message(text_message);
		var receiver_id = $('#receiver_id').val();
		$.ajax({
			dataType: "json",
			type: 'post',
			data: { text_message: text_message, receiver_id: receiver_id },

			url: 'Chat/send_text_message',

			success: function (data) {
				get_chat_history(receiver_id)
			},
			error: function (jqXHR, status, err) {
				//alert('Local error callback');
			}
		});

		scroll_down();
		$('#message').val('');
		$('#message').focus();
	} 
    else {
		$('#message').focus();
	}
}

function get_chat_history(receiver_id) {
	$.ajax({
		//dataType : "json",
		url: 'Chat/get_chat_history?receiver_id=' + receiver_id,
		success: function (data) {
			$('#dump_content').html(data);
			scroll_down(); //comment this out if you want the chat to remain on the top and not scroll down.
		},
		error: function (jqXHR, status, err) {
			//alert('Local error callback');
		}
	});
}

setInterval(function () {
	var receiver_id = $('#receiver_id').val();
	if (receiver_id != '') { get_chat_history(receiver_id); }
}, 8000);