<?php
namespace App\Http\Services;

class JsonToListService
{
    public function jsonToList($json)
    {
        $data = json_decode($json, true);
        $list = '<ul>';
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $list .= '<li><strong>' . $key . '</strong>';
                $list .= $this->jsonToList(json_encode($value));
                $list .= '</li>';
            } else {
                $list .= '<li>' . $key . ': ' . $value . '</li>';
            }
        }
        $list .= '</ul>';
        return $list;
    }
}

?>
