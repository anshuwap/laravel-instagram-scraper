<?php
namespace App\Utilities;

use Maatwebsite\Excel\Excel;

class ExcelHandler
{


    public static function getDataFromExcel($file , $type)
    {
        $accountData = [];

        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::CreateReader(ucfirst($type));

        $spreadsheet = $reader->load($file);

        $excelData = $spreadsheet->getActiveSheet()->toArray();

        foreach ($excelData as $data){

            if (is_null($data[0]))
                continue;

            $accountData[] =  array_slice($data, 0,2);
            
        }
        
        return $accountData;
    }

}