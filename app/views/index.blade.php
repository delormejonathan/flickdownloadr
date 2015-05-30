@extends('global')

@section('content')
@if(! Flickering::isAuthentified())
<h3>Comment utiliser ce service ?</h3>
<div class="row destacados">
	<div class="col-md-4">
		<div>
			<img src="{{ asset('img/flickr.png') }}" alt="Flickr logo" class="img-circle img-thumbnail">
			<h2>Connectez-vous à Flickr</h2>
			<p>Afin de lister vos albums et de les partager à vos proches, ce service a besoin de votre autorisation.</p>
		</div>
	</div>

	<div class="col-md-4">
		<div>
			<img src="{{ asset('img/album.png') }}" alt="Texto Alternativo" class="img-circle img-thumbnail">
			<h2>Choisissez votre album</h2>
			<p>Il est possible de partager un album privé ou public avec une durée limitée dans le temps.</p>
		</div>
	</div>

	<div class="col-md-4">
		<div>
			<img src="{{ asset('img/link.png') }}" alt="Texto Alternativo" class="img-circle img-thumbnail">
			<h2>Partager votre lien</h2>
			<p>Votre lien de partage permettra de télécharger votre album entier ou seulement certaines photographies.</p>
		</div>
	</div>
</div>
<hr>
<h3>F . A . Q</h3><br />
<p><strong>Pourquoi une connexion au service Flickr est obligatoire ?</strong></p>
<p>Car l'accès à vos albums privés est protégé et il est donc obligatoire d'avoir un accord explicite de l'utilisateur pour y accéder.</p>
<p><strong>Quelles sont les données stockés par ce service ?</strong></p>
<p>Jusqu'à la génération d'un lien de partage, aucune donnée n'est stockée sur le service. Lorsque que vous partagez un album, le service conserve les titres, liens de chaque photo de l'album, votre avatar, votre nom/prénom afin de pouvoir les afficher sur la page de partage. <strong>Une fois la date d'expiration atteinte ou un partage révoqué par vous-même, toutes les données sont supprimées définitivement.</strong></p>
<p><strong>Comment révoquer un partage ?</strong></p>
<p>Lorsque que vous êtes connecté, en dessous de la liste des albums il est possible de révoquer des partages existants avant la date d'expiration.</p>
<br />

@else
<div id="albums">
	<p class="loading">
		<i class="fa fa-refresh fa-spin"></i>
	</p>
</div>
@endif

@stop