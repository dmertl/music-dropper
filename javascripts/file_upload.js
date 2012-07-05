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
			console.log('uploadFinished');
			console.log(i);
			console.log(file);
			console.log(response);

//			$.data(file).addClass('done');
			// response is the JSON object that post_file.php returns
		},

		error:function(err, file) {
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
					break;
			}
		},

		// Called before each upload is started
		beforeEach:function(file) {
//			if(!file.type.match(/^image\//)) {
//				alert('Only images are allowed!');
//
//				// Returning false will cause the
//				// file to be rejected
//				return false;
//			}
		},

		uploadStarted:function(i, file, len) {
			console.log('uploadStarted');
			console.log(i);
			console.log(file);
			console.log(len);
		},

		progressUpdated:function(i, file, progress) {
			console.log('progressUpdated');
			console.log(i);
			console.log(file);
			console.log(progress);
			console.log(dropbox);
			dropbox.find('.progress').width(progress + '%');
			//$.data(file).find('.progress').width(progress);
		}

	});

	function showMessage(msg) {
		message.html(msg);
	}

});