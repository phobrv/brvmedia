<?php
namespace Phobrv\Brvmedia\Controllers;

use App\Http\Controllers\Controller;
use FFMpeg;
use FFMpeg\Format\Video\X264;
use ProtoneMedia\LaravelFFMpeg\Exporters\HLSExporter;

class BrvmediaController extends Controller {
	public function index() {

		$encryptionKey = HLSExporter::generateEncryptionKey();
		dd($encryptionKey);

		$lowBitrate = (new X264)->setKiloBitrate(250);
		$midBitrate = (new X264)->setKiloBitrate(500);
		$highBitrate = (new X264)->setKiloBitrate(1000);

		dd(\Storage::disk('public')->url('videos/1trieulike.m3u8'));

		FFMpeg::fromDisk('public')
			->open('videos/1trieulike.mp4')
			->exportForHLS()
			->withEncryptionKey('1234')
			->setSegmentLength(10) // optional
			->setKeyFrameInterval(48) // optional
			->addFormat($lowBitrate)
			->addFormat($midBitrate)
			->addFormat($highBitrate)
			->save('videos/1trieulike.m3u8');
	}
}