<?php

class FlickrController extends Controller {

	public function auth()
	{
		Flickering::handshake();
		return Flickering::getOpauth();
	}
	public function authcallback()
	{
		Flickering::handshake();
		if (Request::getMethod() == 'POST') {
			Flickering::getOpauthCallback();
			while(Flickering::isAuthentified())
				return Redirect::to('/');
		}
		else {
			Flickering::getOpauth();

			while(Flickering::isAuthentified())
				return Redirect::to('/');
		}
	}
	public function disconnect()
	{
		Session::flush();

		return Redirect::to('/')->withMessage('Déconnexion réussie !');
	}

	public function albums()
	{
		Flickering::handshake();

		$request = Flickering::callMethod('photosets.getList')->getResponse('photoset');
		$request = $request['photosets']['photoset'];

		foreach ($request as $album) {
			$photos = Flickering::callMethod('photosets.getPhotos', array('photoset_id' => $album['id'], 'extras' => 'original_format'))->getResults('');
			$photos = $photos['photo'];
			$photo = $photos[0];
			foreach ($photos as $entry) {
				if ($entry['isprimary'])
					$photo = $entry;
			}

			$album['primary_url'] = 'https://farm' . $photo['farm'] . '.staticflickr.com/' . $photo['server'] . '/' . $photo['id'] . '_' . $photo['secret'] . '.jpg';
			$albums[] = $album;
		}

		$shares = Share::where('uid', Flickering::getUser()->getUid())->get();

		return View::make('flickr.albums', array('albums' => $albums, 'shares' => $shares));
	}

	public function share($album_id)
	{
		Flickering::handshake();

		$album = Flickering::callMethod('photosets.getInfo', array('photoset_id' => $album_id))->getResults();

		if (Request::isMethod('post')) {
			$user = Flickering::getUser()->getInformations();
			$share = new Share;
			$share->uid = Flickering::getUser()->getUid();
			$share->avatar = $user['image'];
			$share->name = $user['name'];
			$share->title = $album['title']['_content'];
			$share->hash = substr(sha1(uniqid() . time()), 0, 10);

			$expiration = Input::get('expiration');
			switch ($expiration) {
				case 0:
				$share->expiration = Carbon::now()->addDay(1);
				break;
				case 1:
				$share->expiration = Carbon::now()->addWeek(1);
				break;
				case 2:
				$share->expiration = Carbon::now()->addDay(2);
				break;
				case 3:
				$share->expiration = Carbon::now()->addMonth(1);
				break;
				default:
				$share->expiration = Carbon::now()->addWeek(1);
				break;
			}

			$share->save();

			$photos = Flickering::callMethod('photosets.getPhotos', array('photoset_id' => $album_id, 'extras' => 'original_format'))->getResults('photo');
			foreach ($photos as $entry) {
				$photo = new Photo;
				$photo->pid = $entry['id'];
				$photo->farm = $entry['farm'];
				$photo->server = $entry['server'];
				$photo->secret = $entry['secret'];
				$photo->originalsecret = $entry['originalsecret'];
				$photo->title = $entry['title'];
				$photo->share_id = $share->id;
				$photo->save();
			}

			return View::make('flickr.share', array('album' => $album, 'share' => $share));
		}

		return View::make('flickr.share', array('album' => $album));
	}
	public function access($hash)
	{
		$share = Share::where('hash', $hash)->first();
		$share->views++;
		$share->save();

		return View::make('flickr.access', array('share' => $share));
	}
	public function revoke($id)
	{
		$share = Share::find($id);

		if (Flickering::getUser()->getUid() != $share->uid) {
			return Redirect::back()->withError('Vous n\'êtes pas autorisé à supprimer ce partage.');
		}
		else {
			Share::destroy($id);
			Photo::where('share_id', $id)->delete();
		}

		return Redirect::back()->withMessage('Le partage a été révoqué et n\'est plus accessible.');
	}
}
