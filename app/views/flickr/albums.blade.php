<h3>Choisir l'album à partager</h3>
<div class="row">
	@foreach ($albums as $album)
	<div class="col-xs-6 col-md-3">
		<div class="thumbnail">
			<div class="caption">
				<h4>{{ $album['title']['_content'] }}</h4>
				<p>{{ $album['description']['_content'] }}</p>
				<p>
					<a href="{{ action('FlickrController@share', array($album['id'])) }}" class="label label-success" rel="tooltip" title="Zoom">Partager cet album</a>
					<a href="https://www.flickr.com/photos/{{ Flickering::getUser()->getUid() }}/sets/{{ $album['id'] }}" target="_blank" class="label label-default" rel="tooltip">Voir sur Flickr</a>
				</p>
			</div>
			<img src="{{ $album['primary_url'] }}" alt="...">
		</div>
	</div>
	@endforeach
</div>

@if (count($shares))
<h3>Partages actifs</h3>
<table class="table">
	<tr>
		<th>Nom de l'album</th>
		<th>Lien</th>
		<th>Expiration</th>
		<th>Vue(s)</th>
		<th>Actions</th>
	</tr>
	@foreach ($shares as $share)
	<tr>
		<td>{{ $share->title }}</td>
		<td><a href="{{ action('FlickrController@access', array($share->hash)) }}" target="_blank">{{ action('FlickrController@access', array($share->hash)) }}</a></td>
		<td>{{ $share->expiration->format('d/m/Y') }}</td>
		<td>{{ $share->views }}</td>
		<td><a href="{{ action('FlickrController@revoke', array($share->id)) }}" class="btn btn-danger btn-xs"><span class="fa fa-trash-o"></span></a></td>
	</tr>
	@endforeach
</table>
@endif