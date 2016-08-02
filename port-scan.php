<?php
require_once 'lib/functions.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Port Scan</title>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<div class="container">
	<div class="row">
		<div class="col-md-8">
			<h2 class="text-center">Port Scan</h2>
			<form id="port-scan" method="POST" action="ajax/port-scan-ajax.php">
				<div class="form-group">
					<div class="col-md-8 col-md-offset-2">
						<label for="ipaddress">IP Address</label>
						<input type="text" name="ipaddress" class="form-control" id="ipaddress" placeholder="198.168.0.1" value="<?php echo get_client_ip(); ?>">
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-4 col-md-offset-2">
						<label for="port-start">Port Start</label>
						<input type="text" name="port-start" class="form-control" id="port-start" placeholder="0">
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-4">
						<label for="port-end">Port End</label>
						<input type="text" name="port-end" class="form-control" id="port-end" placeholder="65535">
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-8 col-md-offset-2">
						<button type="submit" class="btn btn-primary btn-block">Scan</button>
					</div>
				</div>
			</form>
		</div>
		<div class="col-md-4">
			<h4 style="margin-top:30px" class="text-center">Results will be displayed here</h4>
			<div class="results">
				
			</div>
		</div>
	</div>
</div>
<script src="http://code.jquery.com/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('form#port-scan').submit(function(e) {
			e.preventDefault();
			var url = $(this).attr('action');
			var data = $(this).serialize();
			$.post(url, data).done(function(msg) {
				$('.results').html(msg);
			});
		});
	});
</script>
</body>
</html>