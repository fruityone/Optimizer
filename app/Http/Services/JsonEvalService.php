<?php
namespace App\Http\Services;

class JsonEvalService
{

    /**
     * @param $instructions
     * @param $data
     * @return false|string
     */
    function updateJsonInstructions($instructions, $data)
    {
//      $data->data[0]->sd=1; example
        $instructionArray = explode(';', $instructions);
        foreach ($instructionArray as $instruction) {
            eval($instruction . ';');
        }
        return json_encode($data);
    }
}

?>
