<?php

Route::middleware(['web', 'auth', 'auth:sanctum', 'lang', 'verified'])->namespace('Phobrv\Brvmedia\Controllers')->group(function () {
	Route::middleware(['can:post_manage'])->prefix('admin')->group(function () {
		Route::get('/meida', 'BrvmediaController@index')->name('brvmedia.index');
	});
	Route::get('/video/secret/{key}', function ($key) {
		return \Storage::disk('secrets')->download($key);
	})->name('video.key');
});

Route::get('/video/{playlist}', function ($playlist) {
	return FFMpeg::dynamicHLSPlaylist()
		->fromDisk('public')
		->open("videos/{$playlist}")
		->setKeyUrlResolver(function ($key) {
			return route('video.key', ['key' => $key]);
		})
		->setMediaUrlResolver(function ($mediaFilename) {
			return Storage::disk('public')->url("videos/{$mediaFilename}");
		})
		->setPlaylistUrlResolver(function ($playlistFilename) {
			return route('video.playlist', ['playlist' => $playlistFilename]);
		});
})->name('video.playlist');
