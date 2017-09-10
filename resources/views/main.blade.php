<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Queue service</title>
	<meta name="description" content="">
	<style type="text/css">
	    @php
		echo preg_replace("/\n+/ui", "", file_get_contents(asset('css/Raleway.css')));
		echo preg_replace("/\n+/ui", "", file_get_contents(asset('css/app.css')));
		echo preg_replace("/\n+/ui", "", file_get_contents(asset('css/style.css')));
	    @endphp
	</style>
	<script type="text/javascript">
	    @php
		echo preg_replace("/\n+/ui", "", file_get_contents(asset('js/app.js')));
	    @endphp
	</script>
	<script type="text/javascript">
	    @php
		echo preg_replace("/\n+/ui", "", file_get_contents(asset('js/bootstrap.js')));
	    @endphp
	</script>
    </head>
    <body>
	@include("layouts/analitics")

	<div class="wrapper container-fluid">

	@include("layouts/header")

	@include("layouts/menu", [
	    "links" => [
		"active", "", "", ""
	    ]
	])

	    <div class="row">
		<div class="col-md-12">
		    <div class="page-header">
			<h1>Queue service <small>dashboard</small></h1>
		    </div>
		</div>
	    </div>
	</div>

	@include("layouts/footer")

    </body>
</html>