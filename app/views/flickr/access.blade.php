@extends('global')

@section('content')
<div class="access">
	<div class="media">
		<a class="media-left" href="#">
			<img src="{{ $share->avatar }}" alt="...">
		</a>
		<div class="media-body">
			<h4 class="media-heading">{{ $share->name }} a partagé l'album &laquo; {{ $share->title }} &raquo; avec vous !</h4>
			<p>Ce lien expire le {{ $share->expiration->format('d-m-Y') }}</p>
		</div>
	</div>

	<br /><br />
	<select name="" id="speed" class="form-control">
		<option value="0">Choisir sa vitesse de téléchargement</option>
		<option value="15000">ADSL bas débit</option>
		<option value="7000">ADSL haut débit</option>
		<option value="3000">Fibre optique</option>
	</select>
	<button id="download" disabled class="btn btn-primary"><span class="fa fa-download"></span> Télécharger l'intégralité de l'album</button>
	<br /><br />

	<div class="row">
		@foreach ($share->photos as $photo)
		<div class="col-xs-6 col-md-3">
			<div class="thumbnail">
				<div class="caption">
					<h4>{{ $photo->title }}</h4>
					<p>
						<a href="{{ 'https://farm' . $photo->farm . '.staticflickr.com/' . $photo->server. '/' . $photo->pid . '_' . $photo->originalsecret . '_o.jpg' }}" class="label label-success" target="_blank">Voir en grand</a>
						<a href="{{ 'https://farm' . $photo->farm . '.staticflickr.com/' . $photo->server. '/' . $photo->pid . '_' . $photo->originalsecret . '_o_d.jpg' }}" target="_blank" class="label label-default">Télécharger</a>
					</p>
				</div>
				<div class="caption-fixed">
					<span class="fa fa-check"></span>
				</div>
				<img class="download" data-src-original="{{ 'https://farm' . $photo->farm . '.staticflickr.com/' . $photo->server. '/' . $photo->pid . '_' . $photo->originalsecret . '_o_d.jpg' }}" src="{{ 'https://farm' . $photo->farm . '.staticflickr.com/' . $photo->server. '/' . $photo->pid . '_' . $photo->secret . '_m.jpg' }}" alt="">
			</div>
		</div>
		@endforeach
	</div>
</div>
@stop