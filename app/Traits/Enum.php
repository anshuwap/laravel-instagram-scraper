<?php
namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait Enum
{

    public function getEnumFields(string $table, string $column)
    {
        $enomTypes = [];

        $dataFromDatabase = DB::select(DB::raw("SHOW COLUMNS FROM {$table} WHERE FIELD = '{$column}'"))[0]->Type;
        
        preg_match('/enum\((.*)\)$/' ,$dataFromDatabase , $matches);

        $enoms = explode(',' , $matches[1]);

        foreach ($enoms as $value) {

            $enomTypes[] = trim($value , "'");
        }

        return $enomTypes;
    }

}