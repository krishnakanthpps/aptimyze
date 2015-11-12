<?php

namespace App\Console\Commands;

use App\Test;
use Illuminate\Console\Command;

class Clean extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clean';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description.';

    /**
     * Create a new command instance.
     *
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @todo add case for handling program which have just completed or never started
     * @todo call tests for only 1 day to avoid running loop for already deleted files
     * @return mixed
     */
    public function handle()
    {
        $tests=Test::where('user_id', null)->where('test_started',1)->where('test_running',0)->lists('random_string');
        foreach($tests as $test) {
            $log = storage_path("test/log/$test.log");
            $script = storage_path("test/script/$test.jmx");
            $json = public_path("resultJson/$test.json");
            unlink($log);
            unlink($script);
            unlink($json);
        }
    }
}
