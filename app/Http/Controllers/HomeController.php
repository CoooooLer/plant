<?php
/**
 * Created by PhpStorm.
 * User: CoooooL
 * Date: 2018/3/23
 * Time: 8:47
 */

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
//        $client = new Client();
//        $response = $client->request('GET', 'http://api.douban.com/v2/movie/in_theaters',
//            ['verify' => false
//            ]);
//        $response = $response->getBody();
//        $response = json_decode($response, true);
//        $response = substr($response,13);
//        $response = substr($response,0,-2);
//        die($response);  //断点打印
//        $response = $response->getBody()->getContents();
//        dd($response);
//        $getData = new getApi();
        $url = 'http://api.douban.com/v2/movie/in_theaters';
        $response = $this->getApi($url);
        $url = 'http://api.douban.com/v2/movie/us_box';
        $usa = $this->getApi($url);
//        dd($usa);
        return view('home',['movies' => $response],['usa' => $usa ]);
    }

    public function movieInfo(Request $request)
    {
        $id = $request->id;
        $url = 'http://api.douban.com/v2/movie/subject/'.$id;
        $results = $this->getApi($url);
//        dd($results);
        return view('user.movieInfo',['results' => $results]);
    }

    public function cinema(Request $request)
    {
        $id = $request->id;

        $url = 'http://api.douban.com/v2/movie/subject/'.$id;
        $results = $this->getApi($url);
//        dd($results);
        return view('user.cinema',['results' => $results]);
    }


    public function getApi($url)
    {
        $client = new Client();
        $response = $client->request('GET',$url,
            ['verify' => false,
            'headers' =>
                [
                'User-Agent' => 'testing/1.0',
                'Accept'     => 'application/json',
                'X-Foo'      => ['Bar', 'Baz']
                ]
            ]);
        $response = $response->getBody();
        $response = json_decode($response,true);
        return $response;
    }

}