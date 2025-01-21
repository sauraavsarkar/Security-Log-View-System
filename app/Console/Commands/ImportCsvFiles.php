<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\LogEntry;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class ImportCsvFiles extends Command
{
    protected $signature = 'import:csv';
    protected $description = 'Import CSV files from a specific folder into the database';

    public function handle()
    {
        $directory = 'C:\\Users\\HP\\OneDrive\\Desktop\\csv file';
        $files = File::files($directory);

        foreach ($files as $file) {
            // Get the filename without extension and capitalize it (e.g., Antivirus)
            $csvType = ucfirst(pathinfo($file->getFilename(), PATHINFO_FILENAME));
        
            $handle = fopen($file->getRealPath(), 'r');
        
            if ($handle !== false) {
                fgetcsv($handle); // Skip header row
                while (($data = fgetcsv($handle, 1000, ',')) !== false) {
                    try {
                        $time = Carbon::createFromFormat('d-m-Y\TH:i:sA+P', $data[0])->toDateTimeString();
                    } catch (\Exception $e) {
                        $time = null;  // Use null or a default timestamp
                    }
                    
                    LogEntry::create([
                        'log_type'    => $csvType,  // Capitalized filename without extension
                        'time'        => $time,
                        'ip_src'      => $data[1],
                        'username'    => $data[2],
                        'msg'         => $data[3],
                        'device_type' => $data[4],
                        'host_dst'    => $data[5],
                        'event_desc'  => $data[6],
                        'event_type'  => $data[7],
                    ]);
                }
                fclose($handle);
                // File::delete($file); // Delete file after processing
            }
        }

        $this->info('CSV files imported successfully.');
    }
}
