<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
//// add
use Illuminate\Support\Facades\App;
use Aws\S3\Exception\S3Exception;
////

class S3Test extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'S3_test';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Test upload, move, delete';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle()
	{
		$bucket = 'runtrip';
		$commonKey = 'dev/test/';
		$uploadFile = '/Users/someno/Desktop/upload_test.png';
		$fileName = 'hoge.png';
		$s3 = App::make('aws')->createClient('s3');

		// upload
		try {
			$s3->putObject([
					'Bucket' => $bucket,
					'Key' => $commonKey.$fileName,
					'SourceFile' => $uploadFile,
			]);
		} catch (S3Exception $e) {
			echo 'ERROR: '.$e->getMessage();
		}

		// move
		try {
			$s3->copyObject([
					'Bucket' => $bucket,
					'Key' => $commonKey.'hoge2.png',                  // To
					'CopySource' => $bucket."/".$commonKey.$fileName, // From
			]);
		} catch (S3Exception $e) {
			echo 'ERROR: '.$e->getMessage();
		}
		try {
			$s3->deleteObject([
					'Bucket' => $bucket,
					'Key' => $commonKey.$fileName,
			]);
		} catch (S3Exception $e) {
			echo 'ERROR: '.$e->getMessage();
		}

		// delete
		try {
			$s3->deleteObject([
					'Bucket' => $bucket,
					'Key' => $commonKey.'hoge2.png',
			]);
		} catch (S3Exception $e) {
			echo 'ERROR: '.$e->getMessage();
		}        

	}
}
