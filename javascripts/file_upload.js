$(function() {

	var dropbox = $('#dropbox');
	var message = $('.message', dropbox);

	dropbox.filedrop({
		// The name of the $_FILES entry:
		paramname:'pic',

		maxfiles:5,
		maxfilesize:2, // in mb
		url:'post_file.php',

		uploadFinished:function(i, file, response) {
			if(response && response.status && response.status == 'Success') {
				dropbox.find('.progress').width('100%');
				addUploadLink(file);
				//TODO: update progress bar to indicate success, fade and remove after timeout
				alert('Upload of "' + file.name + '" complete');
			} else {
				//TODO: set error indicator on progress bar, attach response.status
			}
		},

		error:function(err, file) {
			//TODO: place errors in a status window rather than using alerts
			switch(err) {
				case 'BrowserNotSupported':
					showMessage('Your browser does not support HTML5 file uploads!');
					break;
				case 'TooManyFiles':
					alert('Too many files! Please select 5 at most!');
					break;
				case 'FileTooLarge':
					alert(file.name + ' is too large! Please upload files up to 2mb.');
					break;
				default:
					alert(err);
					break;
			}
		},

		uploadStarted:function(i, file, len) {
			dropbox.find('.progress').width('0%').show();
		},

		progressUpdated:function(i, file, progress) {
			dropbox.find('.progress').width(progress + '%');
		}

	});

	function addUploadLink(file) {
		//TODO: use some kind of pop-in animation
		$('#uploads').prepend('<li><a href="uploads/' + file.name + '">' + file.name + '</a></li>');
	}

	function showMessage(msg) {
		message.html(msg);
	}

});