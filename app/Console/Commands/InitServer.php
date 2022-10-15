<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class InitServer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'init:server {port}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Ejecuta DB:wipe, migrate --seeds y serve.';

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
     * @return int
     */
    public function handle()
    {
        $port = $this->argument('port');
        if ($this->confirm('Se eliminará la base de datos y se volvera a crear, corriendo los seeder, está seguro?')) {
            shell_exec('php artisan db:wipe');
            $this->line('DB wipe terminado');
            shell_exec('php artisan migrate --seed');
            $this->line('Migrate y seeders terminado');
            $this->line("Server levantado en puerto {$port}");
            shell_exec("php artisan serve --port={$port}");
        }
    }
}