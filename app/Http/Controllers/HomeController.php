<?php
/**
 * Created by PhpStorm.
 * User: CoooooL
 * Date: 2018/3/23
 * Time: 8:47
 */

namespace App\Http\Controllers;

use GuzzleHttp\Client;

class HomeController extends Controller
{
    public function home()
    {
        $client = new Client();
        $response = $client->request('GET', 'https://movie.douban.com/j/search_subjects?type=move&tag=%E7%83%AD%E9%97%A8&page_limit=24&page_start=0',
            ['verify' => false
            ]);
        $response = $response->getBody();
        $response = json_decode($response, true);
//        $response = substr($response,13);
//        $response = substr($response,0,-2);
//        die($response);  //断点打印
//        $response = $response->getBody()->getContents();
//        dd($response);
        return view('home',['movies' => $response]);
    }
}