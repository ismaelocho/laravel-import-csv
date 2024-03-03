<?php

namespace App\Imports;

use App\Models\Expenditure;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Events\AfterImport;
use App\Jobs\SendEmailJob;

class ImportExpenditure implements ToModel, WithChunkReading, ShouldQueue, WithStartRow, WithMultipleSheets, WithEvents
{
    /**
     * Get the ID of user owner file
     */

    use Importable, RegistersEventListeners;

    private $user, $userName, $userEmail;
    public $rows = 1;

    public function __construct($user, $userName, $userEmail) 
    {
        $this->user = $user;
        $this->userName = $userName;
        $this->userEmail = $userEmail;
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        ++$this->rows;
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


    public function afterImport(AfterImport $event)
    {
        // Need to access $finaldata here and send mail to user
        $totalrows = $this->rows;
        $data['text'] = 'Completed process: '.date('Y-m-d H:i:s a');
        $data['email'] = $this->userEmail;
        $data['name'] = $this->userName;
        dispatch(new SendEmailJob($data));
        Log::info('after import excel file');
    }

}
