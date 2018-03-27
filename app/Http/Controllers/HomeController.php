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
        //正在热映影片信息
        $url = 'http://api.douban.com/v2/movie/in_theaters';
        $response = $this->getApi($url);
        //影片排行信息
        $url = 'http://api.douban.com/v2/movie/us_box';
        $usa = $this->getApi($url);
//        dd($usa);
        return view('home', ['movies' => $response], ['usa' => $usa]);
    }

    public function movieInfo(Request $request)
    {
        //影片ID  获取影片信息
        $id = $request->id;
        $url = 'http://api.douban.com/v2/movie/subject/' . $id;
        $results = $this->getApi($url);
//        dd($results);
        return view('user.movieInfo', ['results' => $results]);
    }

    public function cinemas()
    {
        //获取本地电影院信息
        $url = 'http://m.maoyan.com/cinemas.json';
//        $url = 'http://m.maoyan.com/showtime/wrap.json?cinemaid=7887&movieid=26575103';
        $cinemas = $this->getApi($url);
//        dd($cinemas);
        return view('user.cinemas', ['cinemas' => $cinemas]);
    }

    public function cinema(Request $request)
    {
        //影片ID  获取影片信息
        $id = $request->id;
        $url = 'http://api.douban.com/v2/movie/subject/' . $id;
        $results = $this->getApi($url);
//        dd($results);
        //获取影院信息
//        $url = 'http://m.maoyan.com/cinemas.json';
//        $cinemas = $this->getApi($url);
//        return view('user.cinema', ['results' => $results], ['cinemas' => $cinemas]);
        return view('user.cinema', ['results' => $results]);
    }

    public function showScreen(Request $request)
    {
        $movieId = $request->movieId;
        $cinemaId = $request->cinemaId;
        $price = $request->price;
//        dd($movieId,$cinemaId,$price);
//        $url = 'http://m.maoyan.com/showtime/wrap.json?cinemaid='.$cinemaId.'&movieid='.$movieId;
//        $cinema = $this->getApi($url);
//        dd($cinema);
        return view('user.show');
    }

//    public function show()
//    {
//        $movieId = $_GET['movieId'];
//        dd($movieId);
//        $url = 'http://m.maoyan.com/cinemas.json';
//        $cinema = $this->getApi($url);
//        return $cinema;
//    }



    //调用影片API、影院API
    public function getApi($url)
    {
        $client = new Client();
        $response = $client->request('GET', $url,
            ['verify' => false,
                'headers' =>
                    [
                        'User-Agent' => 'testing/1.0',
                        'Accept' => 'application/json',
                        'X-Foo' => ['Bar', 'Baz']
                    ]
            ]);
        $response = $response->getBody();
        $response = json_decode($response, true);
        return $response;
    }

}