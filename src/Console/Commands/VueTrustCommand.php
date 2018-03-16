<?php namespace Bantenprov\VueTrust\Console\Commands;

use Illuminate\Console\Command;

/**
 * The VueTrustCommand class.
 *
 * @package Bantenprov\VueTrust
 * @author  bantenprov <developer.bantenprov@gmail.com>
 */
class VueTrustCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bantenprov:vue-trust';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Demo command for Bantenprov\VueTrust package';

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
        //$name = $this->anticipate('What is your name?', ['Taylor', 'Dayle']);
        // $name = $this->choice('What is your name?', ['Taylor', 'Dayle'], 0);
        // $this->info($name);
    }
}
