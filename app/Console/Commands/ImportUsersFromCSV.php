<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ImportUsersFromCSV extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import users from CSV file.';

    /**
     * Execute the console command.
     *
     */
    public function handle(): void
    {
        $this->importFromCSV('HTML.csv');
        $this->newLine();
        $this->importFromCSV('Python.csv');
        $this->newLine();
        $this->info('Success!');
    }

    private function importFromCSV(string $filename): void
    {
        $fileString = Storage::get($filename);
        $fileStrings = collect(array_map('str_getcsv', explode("\n", $fileString)));
        $header = collect($fileStrings->first());

        $this->withProgressBar($fileStrings->skip(1), function($row) use($header) {
            if (count($header) === count($row)) {
                $data = collect($header->combine($row));

                User::query()->updateOrCreate([
                    'full_name' => $data->get('full_name'),
                ], $this->getUpdateArray($data));
            }
        });
    }

    private function getUpdateArray(Collection $collection): array
    {
        $updateArray = [];

        if ($collection->has('email')) {
            $updateArray['email'] = $collection->get('email');
        }

        if ($collection->has('total_x')) {
            $updateArray['total_x'] = $collection->get('total_x');
        }

        if ($collection->has('total_y')) {
            $updateArray['total_y'] = $collection->get('total_y');
        }

        $updateArray['password'] = Hash::make('password');

        return $updateArray;
    }
}
