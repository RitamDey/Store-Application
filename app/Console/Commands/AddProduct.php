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

    public function handle() {
        $file = $this->argument("file");
        $exists = file_exists($file);
        if ($exists === false) {
            $this->error("$file doesn't exists");
            return -1;
        }
        $contents = file_get_contents($file);
        $this->info("Read the file");
        $json = json_decode($contents);

        foreach ($json as $key => $value) {
            if ((property_exists($value, "name") === false)||(property_exists($value, "price") === false)) {
                $this->error("Record misses important data");
                continue;
            }
            if (property_exists($value, "url") === false)
                $value->url = "http://www.flyermakerpro.com/_mobile/images/placeholder_logo.jpg";
            if (property_exists($value, "description") === false)
                $value->description = null;

            $record = Products::create([
                "name" => $value->name,
                "description" => $value->description,
                "url" => $value->url,
                "price" => $value->price
            ]);

            $this->info($record->toJson());
        }

        return 0;
    }
}
