<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Antivirus;
use App\Models\LogEntry;
use Illuminate\Support\Facades\File;

class ProcessLogFiles extends Command
{
    protected $signature = 'logs:process';
    protected $description = 'Process new log files and store data';

    public function handle()
    {
        $logFolders = ['antivirus'];  // Define log types

        foreach ($logFolders as $folder) {
            $folderPath = storage_path("app/logs/{$folder}");

            if (!File::exists($folderPath)) {
                $this->info("Folder {$folder} does not exist.");
                continue;
            }

            $files = File::files($folderPath);

            foreach ($files as $file) {
                $filePath = $file->getPathname();
                $logType = $folder;  // Set the log type (folder name)

                // Read CSV data
                $csvData = array_map('str_getcsv', file($filePath));

                foreach ($csvData as $row) {
                    if (count($row) < 3) continue; // Ensure at least 3 columns exist

                    Antivirus::create([
                        'log_type'  => $logType,
                        'timestamp' => $row[0],
                        'severity'  => $row[1],
                        'message'   => $row[2],
                    ]);
                }

                // Move processed file to archive folder
                File::move($filePath, storage_path("app/processed/" . $file->getFilename()));
                $this->info("Processed: " . $file->getFilename());
            }
        }
    }
}

