<?php

namespace Phobrv\Brvmedia\Console\Commands;

use FFMpeg;
use FFMpeg\Format\Video\X264;
use Illuminate\Console\Command;
use ProtoneMedia\LaravelFFMpeg\Exporters\HLSExporter;

class ProcessVideoUpload extends Command {
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'video:hls';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Converting video by HLS';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return int
	 */
	public function handle() {

		$encryptionKey = HLSExporter::generateEncryptionKey();
		$lowBitrate = (new X264)->setKiloBitrate(250);
		$midBitrate = (new X264)->setKiloBitrate(500);
		$highBitrate = (new X264)->setKiloBitrate(1000);
		FFMpeg::fromDisk('uploads')
			->open('small.mp4')
			->exportForHLS()
			->withRotatingEncryptionKey(function ($filename, $contents) {
				\Storage::disk('secrets')->put($filename, $contents);
			})
			->addFormat($lowBitrate)
			->addFormat($midBitrate)
			->addFormat($highBitrate)
			->onProgress(function ($progress) {
				$this->info("Progress: {$progress}");
			})
			->toDisk('public')
			->save('videos/small.m3u8');
	}
}
