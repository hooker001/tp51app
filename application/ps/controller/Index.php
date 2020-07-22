<?php

namespace app\ps\controller;

class Index
{
    public function home()
    {
        echo 'home';
    }

    public function info()
    {
        return jsonErr('route not found');
    }
}
