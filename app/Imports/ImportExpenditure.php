<?php

namespace App\Imports;

use App\Models\Expenditure;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ImportExpenditure implements ToModel, WithChunkReading, ShouldQueue, WithStartRow, WithMultipleSheets
{
    /**
     * Get the ID of user owner file
     */
    private $user;

    public function __construct($user) 
    {
        $this->user = $user;
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if(isset($row[0])){ //validate has content
            if(isset($row[2])){
                $value = $row[2];
                $date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToTimestamp($value);
                $newdate = date("Y-m-d H:i:s" , $date);
            }else{
                $newdate = date("Y-m-d H:i:s");
            }
            if(isset($row[1])){
                $amount = $row[1];
            }else{
                $amount = '0';
            }
            
            return new Expenditure([
                'user_id' => $this->user,
                'category_id' => '1',
                'expense' => $row[0],
                'amount' => $amount,
                'date' => $newdate,
            ]);
        }
    }
    /**
     * Number of rows to broken file
     */
    public function chunkSize(): int
    {
        return 1000;
    }
    /**
     * Remove header
     */
    public function startRow(): int
    {
       return 2;
    }
    /**
     * Import only the first sheet
     */
    public function sheets(): array
    {
        return [
            0 => $this,
        ];
    }

}
