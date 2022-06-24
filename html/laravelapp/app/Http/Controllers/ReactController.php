<?php

namespace App\Http\Controllers;

class ReactController extends Controller
{
    protected function createItem($id, $firstname, $lastname, $age)
    {
        return [
            'id' => $id,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'age' => $age,
        ];
    }

    public function chapter9()
    {
        $fnCreate = fn ($a, $b, $c, $d) => $this->createItem($a, $b, $c, $d);

        $data[] = $fnCreate(1, '勉', '主田', 24);
        $data[] = $fnCreate(2, '未来', '先岡', 28);
        $data[] = $fnCreate(3, '一郎', '後藤', 23);

        return $this->responseJson($data);
    }
}
