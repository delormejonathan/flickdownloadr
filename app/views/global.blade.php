<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Download and share albums from Flickr">
	<meta name="author" content="Jonathan DELORME">

	<title>FlickDownloadr : Download and share albums from Flickr</title>

	<!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('css/app.css') }}">

</head>

<body>
	<div class="container">
		<div class="page-header">
			<div class="row">
				<div class="col-lg-6">
					<h1><a href="{{ action('HomeController@index') }}">FlickDownloadr</a></h1>
					<p class="lead">Partager et télécharger facilement vos albums Flickr.</p>
				</div>
				<div class="col-lg-6" style="text-align:right"><br /><br /><br />
					@if (! Flickering::isAuthentified())
					<a href="{{ action('FlickrController@auth') }}" class="btn btn-primary"><span class="fa fa-flickr"></span> Connexion au service Flickr</a>
					@else
					<a href="{{ action('FlickrController@disconnect') }}" class="btn btn-default"><span class="fa fa-flickr"></span> Déconnexion du service Flickr</a>
					@endif
				</div>
			</div>
		</div>
		@include('alert')
		@yield('content')
	</div>

	<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
	<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
