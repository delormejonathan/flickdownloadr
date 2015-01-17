@extends('global')

@section('content')
@if (! isset($share))
<h3>Partager l'album &laquo; {{ $album->get('title._content') }} &raquo;</h3><br />
<div class="row">
	<div class="col-lg-3">
		<form action="" method="POST">
			<div class="form-group">
				<label>Expiration du lien</label>
				<select name="expiration" class="form-control">
					<option value="0">1 jour</option>
					<option value="1" selected>1 semaine</option>
					<option value="2">2 semaines</option>
					<option value="3">1 mois</option>
				</select>
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-success"><span class="fa fa-floppy-o"></span> Générer un lien</button>
			</div>
		</form>
	</div>
</div>
@else
<h3>Le partage est maintenant disponible !</h3><br />
<input class="form-control" value="{{ action('FlickrController@access', array($share->hash)) }}"><br />
<a href="{{ action('HomeController@index') }}" class="btn btn-default"><span class="fa fa-arrow-left"></span> Revenir à l'accueil</a>
@endif
@stop