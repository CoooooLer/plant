<?php
/**
 * Created by PhpStorm.
 * User: CoooooL
 * Date: 2018/3/23
 * Time: 8:47
 */

namespace App\Http\Controllers;

use App\model\Screen;
use App\model\Seat;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;


class HomeController extends Controller
{
    /*主要处理影片相关的信息*/
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
        return view('home', ['movies' => $response], ['usa' => $usa]);
    }

    public function movieInfo(Request $request)
    {
        //影片ID  获取影片信息
        $id = $request->id;
        setcookie('movieId',$id);
//        cookie('movieId',$id);
//        Cookie::queue('movieId',$id);
        $url = 'http://api.douban.com/v2/movie/subject/' . $id;
        $results = $this->getApi($url);
        return view('user.movieInfo', ['results' => $results]);
    }

    public function cinemas()
    {
        //获取本地电影院信息
        $url = 'http://m.maoyan.com/cinemas.json';
//        $url = 'http://m.maoyan.com/showtime/wrap.json?cinemaid=7887&movieid=26575103';
        $cinemas = $this->getApi($url);
        return view('user.cinemas', ['cinemas' => $cinemas]);
    }

    public function cinema(Request $request)
    {
        //影片ID  获取影片信息
//        dd($request);
        $id = $_COOKIE['movieId'];
        $url = 'http://api.douban.com/v2/movie/subject/' . $id;
        $results = $this->getApi($url);
        //获取影院信息
        $url = 'http://m.maoyan.com/cinemas.json';
        $cinemas = $this->getApi($url);
        return view('user.cinema', ['results' => $results], ['cinemas' => $cinemas]);
    }

    public function showScreen(Request $request)
    {
        //根据影片ID 影院ID  获取影院放映室信息
//        $movieId = $_GET['movieId'];
        $movieId = $_COOKIE['movieId'];
        $cinemaId = $_GET['cinemaId'];
        setcookie('cinemaId',$cinemaId);
        $price = $_GET['price'];
//        dd($movieId,$cinemaId,$price);
        $url = 'http://m.maoyan.com/showtime/wrap.json?cinemaid='.$cinemaId.'&movieId='.$movieId;
        $cinema = $this->getApi($url);

        $url ='http://api.douban.com/v2/movie/subject/' . $movieId;
        $movie = $this->getApi($url);
        $screens = Screen::all();
//        dd($cinema);

        return view('user.showScreen',['cinema' => $cinema],['screens' => $screens]);
    }

    public function selectSeat()
    {
        $sId = $_GET['sId'];
        $movieId = $_COOKIE['movieId'];
        $cinemaId = $_COOKIE['cinemaId'];
//        dd($sId,$movieId,$cinemaId);
        $screen = Screen::find($sId);
        $url ='http://api.douban.com/v2/movie/subject/' . $movieId;
        $movie = $this->getApi($url);

        $url = 'http://m.maoyan.com/cinemas.json';
        $cinema = $this->getApi($url);

        $seats = Seat::where('sId','=',$sId)->get();
        $row = Seat::where('sId','=',$sId)
            ->max('row')
            ;


//        dd($seats);
        return view('user.selectSeat',
            [
                'movie' => $movie,
                'cinema' => $cinema,
                'seats' => $seats,
                'row' => $row,
                'screen' => $screen,
            ]);

    }








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