<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class ImportCsvFiles extends Command
{
    protected $signature = 'import:csv';
    protected $description = 'Import CSV files from a specific folder into dynamically created tables';
    

    public function handle()
    {
        $directory = 'C:\\Users\\HP\\OneDrive\\Desktop\\csv file';
        $historyDirectory = $directory . '\\History'; // Destination folder for processed files

        // Ensure the History folder exists
        if (!File::exists($historyDirectory)) {
            File::makeDirectory($historyDirectory, 0777, true, true);
        }

        $files = File::files($directory);
        $timestampFolder = null; // Variable to store folder name for this run

        foreach ($files as $file) {
            // Get the filename without extension and capitalize it (e.g., Antivirus)
            $tableName = ucfirst(pathinfo($file->getFilename(), PATHINFO_FILENAME));

            $this->info("Processing file: {$file->getFilename()} into table: {$tableName}");

            // Create table if it does not exist
            $this->createTableIfNotExists($tableName, $file);

            $handle = fopen($file->getRealPath(), 'r');
            $fileTimestamp = null; // Store timestamp from the file

            if ($handle !== false) {
                $header = fgetcsv($handle); // Get header row to map columns

                while (($data = fgetcsv($handle, 1000, ',')) !== false) {
                    $rowData = [];

                    foreach ($header as $index => $column) {
                        $formattedColumn = str_replace('.', '_', strtolower($column)); // Replace dots with underscores
                        $rowData[$formattedColumn] = $data[$index] ?? null;
                    }

                    // Time parsing block
                    if (isset($rowData['time'])) {
                        try {
                            // Try multiple formats
                            $carbonDate = Carbon::createFromFormat('Y-m-d H:i:s', $rowData['time']) // e.g., 2025-02-15 14:45:00
                                            ?: Carbon::createFromFormat('d/m/Y H:i:s', $rowData['time']) // e.g., 15/02/2025 14:45:00
                                            ?: Carbon::createFromFormat('M d Y H:i:s', $rowData['time']); // e.g., Feb 15 2025 14:45:00

                            // If parsing was successful, set the timestamp folder
                            if ($carbonDate) {
                                // Folder name format like: 12-20-30PM_2-Jan-2014
                                $fileTimestamp = $carbonDate->format('h-i-sA_d-M-Y'); // Standard format like 12-20-30PM_2-Jan-2014
                                $rowData['time'] = $carbonDate->toDateTimeString();
                            }
                        } catch (\Exception $e) {
                            $rowData['time'] = null; // If parsing fails, leave time as null
                        }
                    }

                      // Add timestamps
                      $rowData['created_at'] = now();
                      $rowData['updated_at'] = now();
                    // Insert data into the table
                    DB::table($tableName)->insert($rowData);
                }
                fclose($handle);
            }

            // If no folder has been set for this run, use the current time for folder creation
            if (!$timestampFolder) {
                // Use Bangladesh timezone (Asia/Dhaka)
                $timestampFolder = $historyDirectory . '\\' . Carbon::now('Asia/Dhaka')->format('h-i-sA_d-M-Y');
                if (!File::exists($timestampFolder)) {
                    File::makeDirectory($timestampFolder, 0777, true, true);
                }
            }

            // Move the processed CSV file into the timestamped folder
            if ($timestampFolder) {
                $newFilePath = $timestampFolder . '\\' . $file->getFilename();
                File::move($file->getRealPath(), $newFilePath);
                $this->info("File moved to: {$newFilePath}");
            }
        }
    }

    /**
     * Create table dynamically if it does not exist.
     */
    private function createTableIfNotExists($tableName, $file)
    {
        $handle = fopen($file->getRealPath(), 'r');
        $columns = fgetcsv($handle); // Get the first row (column headers)
        fclose($handle);

        if (!Schema::hasTable($tableName)) {
            Schema::create($tableName, function ($table) use ($columns) {
                $table->id();
                foreach ($columns as $column) {
                    $formattedColumn = str_replace('.', '_', strtolower($column));
                    $table->string($formattedColumn)->nullable();
                }
                $table->timestamps();
            });
            $this->info("Table {$tableName} created successfully.");
        }
    }
}
