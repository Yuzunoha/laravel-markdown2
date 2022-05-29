<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GoController extends Controller
{
    public function index(Request $request)
    {
        $file = $request->file("file");
        $size = filesize($file);
        $data = [
            'file' => $file,
            'size' => $size,
            '$request->all()' => $request->all(),
        ];
        return $this->responseJson($data);
    }

    public function test(Request $request)
    {
        // docker run --rm -v /home/yuzunoha/git/github/laravel-markdown2/html/laravelapp/storage/app/codegym:/app jitesoft/phpunit phpunit tests/DiceTest.php
        $s = 'sudo docker run --rm';
        $s .= ' -v ${HOST_REPOSITORY_ROOTDIR}/html/laravelapp/storage/app/codegym:/app';
        $s .= ' jitesoft/phpunit phpunit tests/DiceTest.php';

        exec($s, $output);

        $r = '';
        foreach ($output as $l) {
            $r .= $l . PHP_EOL;
        }
        return $r;
    }
}
