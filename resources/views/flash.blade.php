@if (session()->has('flash_notification.message'))
	<script>
		swal({
			title: "MECSC.org",  
			text: "{{ session('flash_notification.message') }}",  
			type: "{{ session('flash_notification.level') == 'danger' ? 'error' : session('flash_notification.level') }}", 
			 showConfirmButton: true,
			 confirmButtonText: 'Okay'
		});
	</script>
@endif

@if (session()->has('flash_notification.overlay'))
	<script>
		swal({
			title: "MECSC.org",  
			text: "{{ session('flash_notification.message') }}",  
			type: "{{ session('flash_notification.level') }}", 
			confirmButtonText: 'Okay'
		});
	</script>
@endif