<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Products;


class AddProduct extends Command {
    protected $signature = 'add:product {file}';

    protected $description = 'Read a JSON file for product details and add it to the database';

    public function __construct() {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        return 0;
    }
}
