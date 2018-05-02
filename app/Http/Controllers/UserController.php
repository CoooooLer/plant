<?php
/**
 * Created by PhpStorm.
 * User: CoooooL
 * Date: 2018/4/9
 * Time: 13:53
 */

namespace App\Http\Controllers;



use App\model\Comment;
use App\model\Post;
use App\model\reply;
use App\model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

date_default_timezone_set('PRC');

class UserController extends Controller
{
    /*z主要处理用户的信息*/
    private $validate = [
        'verifyCode'      =>  '/^[A-Za-z0-9]{4}$/u',                                    //4个字符的英文字符串
        'username'      =>  '/^[\x{4e00}-\x{9fa5}A-Za-z0-9_]{3,20}$/u',                //3-20位的中文、英文、数字、下划线
        'password'      =>  '/^[A-Za-z0-9]{6,20}$/u',                              //6-20位的英文、数字
        'email'         =>  '/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/u',    //邮箱匹配
        'phone'         =>  '/^1[34578]\d{9}$/u',                                   //电话号码匹配
    ];


//  用户注册验证
    public function register(Request $request)
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $r_password = $_POST['password_confirmation'];
        $phone = $_POST['phone'];
        $verifyCode = $_POST['verifyCode'];
        $verifyCode = strtolower($verifyCode);
        $r_verifyCode = $_POST['verifyCode_confirmation'];
//        dd($username,$password,$r_password,$phone,$verifyCode);

        if($username & $password & $verifyCode)
        {
            $user = User::where('username','=',$username)->first();
            if($user)
            {
                return response()->json(['warning' => '用户名已存在']);
            }
            if(!preg_match($this->validate['username'],$username))
            {
//                $request->session()->flash('warning','用户名不合法');
                return response()->json(['warning','用户名不合法']);
            }
            if(!preg_match($this->validate['password'],$password) && !preg_match($this->validate['password'],$r_password))
            {
                return response()->json(['warning','密码不合法']);
            }
            if(!preg_match($this->validate['phone'],$phone))
            {
                return response()->json(['warning','手机号码不合法']);
            }
            if(!preg_match($this->validate['verifyCode'],$verifyCode))
            {
                return response()->json(['warning','验证码不合法']);
            }

            if($password === $r_password)
            {
                if($verifyCode === $r_verifyCode)
                {
//                            dd($username,$password,$r_password,$phone,$verifyCode);
                    $password = bcrypt($password);
                    $user = User::create([
                        'username' => $username,
                        'password' =>$password,
                        'phone' => $phone,
                    ]);
                    if ($user)
                    {
                        return response()->json(['success' => '注册成功，欢迎登陆']);
                    }
                    else
                    {
                        return response()->json(['danger' => '注册失败' ]);
                    }
                }
                else
                {
                    return response()->json(['warning' => '验证码错误']);
                }
            }
            else
            {
                return response()->json(['warning' => '两次密码不一致']);
            }
        }
        else
        {
            return response()->json(['warning' => '用户名、密码、验证码不能为空']);
//            $request->session()->flash('warning','用户名、密码、验证码不能为空');
//            return redirect()->back();
        }

    }


    /*用户登录验证*/
    public function login(Request $request)
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $verifyCode = $_POST['verifyCode'];
        $verifyCode = strtolower($verifyCode);
        $r_verifyCode = $_POST['verifyCode_confirmation'];
        $remember = $request->remember;
//        dd($username,$password,$verifyCode,$remember);
        if($username & $password & $verifyCode)
        {
            $user = User::where('username','=',$username)->first();
            if($user)
            {
                if(Hash::check($password,$user->password))
                {
                    if($verifyCode === $r_verifyCode)
                    {
                        if($remember){
                            return response()->json(['success' => '登陆成功'])->withCookie('username',$username,10080);
                        }
                        return response()->json(['success' => '登陆成功'])->withCookie('username',$username);
                    }
                    else
                    {
                        return response()->json(['warning' => '验证码错误']);
                    }
                }
                else
                {
                    return response()->json(['warning' => '密码错误']);
                }
            }
            else
            {
                return response()->json(['warning' => '此用户名错误']);
            }
        }
        else
        {
            return response()->json(['warning' => '用户名、密码、验证码不能为空']);
        }

    }

    /*用户退出*/
    public function logOut()
    {
        return redirect()->route('home')->cookie('username','',-1);
    }

    /*用户编辑信息*/
    public function editPerson()
    {
        $username = $_GET['username'];
        $user = User::where('username','=',$username)->first();
        return view('user.editPerson',['user' => $user]);
    }

    /*保存用户编辑信息*/
    public function editPersonInfo()
    {
        $password = $_POST['password'];
        $r_password = $_POST['password_confirmation'];
        $phone = $_POST['phone'];
        $id = $_POST['id'];
        if($password & $r_password & $phone)
        {
            if(!preg_match($this->validate['password'],$password) & !preg_match($this->validate['password'],$r_password))
            {
                return response()->json(['warning' => '密码格式不正确']);
            }
            if(!preg_match($this->validate['phone'],$phone))
            {
                return response()->json(['warning' => '电话号码格式不正确']);
            }
            if($password === $r_password)
            {
                $user = User::find($id);
                $user->password = bcrypt($password);
                $user->phone = $phone;
                $bool = $user->save();
                if($bool)
                {
                    return response()->json(['success' => '保存成功']);
                }
                else
                {
                    return response()->json(['warning' => '保存失败']);
                }
            }
            else
            {
                return response()->json(['warning' => '两次密码不一致']);
            }
        }
        else
        {
            return response()->json(['warning' => '密码、电话不能为空']);
        }
    }

    /*主页面*/
    public function home()
    {
        $posts = Post::where('type','=','yanghu')->orWhere('type','=','jianjie')->orderBy('created_at','desc')->paginate(10);
        return view('home',['posts' => $posts]);
    }

    /*多肉简介页面的发表帖子*/
    public function jianjie(Request $request)
    {
        $username = $_COOKIE['username'];
        $type = $request->type;
        $title = $request->title;
        $content = $_POST['content'];
        $img = $request->file('img');
        $imgName = null;
        $imgPath = null;
        $imgUrl = null;
//        dd($title,$img);
        if(empty($title))
        {
            $request->session()->flash('warning','标题不能为空');
            return redirect()->back();
        }
        if(empty($content))
        {
            $request->session()->flash('warning','内容不能为空');
            return redirect()->back();
        }

        if(empty($img))
        {
            $post = Post::create([
                'title' => $title,
                'content' => $content,
                'type' => $type,
                'username' => $username,
            ]);

            if($post)
            {
                $request->session()->flash('success','发表成功,请刷新查看内容');
                return redirect()->back();
            }
            else
            {
                $request->session()->flash('warning','发表失败');
                return redirect()->back();
            }
        }
        else
        {

            if($img->isValid())
            {
                $imgName = $img->getClientOriginalName();
                $ext = $img->getClientOriginalExtension();
                $imgArr = ['jpg','jpeg','png','bmp','webp'];
                if(in_array($ext,$imgArr))
                {
                    $imgPath = $img->store('/public/'.$type);
                    $imgUrl = asset('storage/'.substr($imgPath,7));
                    $post = Post::create([
                        'title' => $title,
                        'content' => $content,
                        'img_name' => $imgName,
                        'img_local_path' => $imgPath,
                        'img_url' => $imgUrl,
                        'type' => $type,
                        'username' => $username,
                    ]);
                    if($post)
                    {
                        $request->session()->flash('success','发表成功');
                        return redirect()->back();
                    }
                    else
                    {
                        $request->session()->flash('warning','发表失败');
                        return redirect()->back();
                    }
                }
                else
                {
                    $request->session()->flash('warning','图片格式不正确');
                    return redirect()->back();
                }

            }
            else
            {
                $request->session()->flash('warning','图片无效');
            }

        }



    }

    /*多肉简介页面的内容*/
    public function jianjiepage()
    {
        $posts = Post::where('type','=','jianjie')->orderBy('created_at','desc')->paginate(10);
//        dd($posts);
        return view('user.jianjie',['posts' => $posts]);
    }

    /*种植养护页面发表帖子*/
    public function yanghu(Request $request)
    {
        $username = $_COOKIE['username'];
        $type = $request->type;
        $title = $request->title;
        $content = $_POST['content'];
        $img = $request->file('img');
        $imgName = null;
        $imgPath = null;
        $imgUrl = null;
//        dd($title,$img);
        if(empty($title))
        {
            $request->session()->flash('warning','标题不能为空');
            return redirect()->back();
        }
        if(empty($content))
        {
            $request->session()->flash('warning','内容不能为空');
            return redirect()->back();
        }
        if(empty($img))
        {
            $post = Post::create([
                'title' => $title,
                'content' => $content,
                'type' => $type,
                'username' => $username,
            ]);

            if($post)
            {
                $request->session()->flash('success','发表成功');
                return redirect()->back();
            }
            else
            {
                $request->session()->flash('warning','发表失败');
                return redirect()->back();
            }
        }
        else
        {

            if($img->isValid())
            {
                $imgName = $img->getClientOriginalName();
                $ext = $img->getClientOriginalExtension();
                $imgArr = ['jpg','jpeg','png','bmp','webp'];
                if(in_array($ext,$imgArr))
                {
                    $imgPath = $img->store('/public/'.$type);
                    $imgUrl = asset('storage/'.substr($imgPath,7));
                    $post = Post::create([
                        'title' => $title,
                        'content' => $content,
                        'img_name' => $imgName,
                        'img_local_path' => $imgPath,
                        'img_url' => $imgUrl,
                        'type' => $type,
                        'username' => $username,
                    ]);
                    if($post)
                    {
                        $request->session()->flash('success','发表成功');
                        return redirect()->back();
                    }
                    else
                    {
                        $request->session()->flash('warning','发表失败');
                        return redirect()->back();
                    }
                }
                else
                {
                    $request->session()->flash('warning','图片格式不正确');
                    return redirect()->back();
                }

            }
            else
            {
                $request->session()->flash('warning','图片无效');
            }

        }



    }

    /*种植养护页面的内容*/
    public function yanghupage()
    {
        $posts = Post::where('type','=','yanghu')->orderBy('created_at','desc')->paginate(10);
//        dd($posts);
        return view('user.yanghu',['posts' => $posts]);
    }

    /*萌图欣赏页面*/
    public function mengtu()
    {
        $posts = Post::where('type','=','yanghu')->orWhere('type','=','jianjie')->orderBy('created_at','desc')->get();
        return view('user.mengtu',['posts' => $posts]);
    }

    /*种植日志页面的发表日志*/
    public function rizhi(Request $request)
    {
        $username = $_COOKIE['username'];
        $type = $request->type;
        $title = $request->title;
        $content = $_POST['content'];
//        dd($title,$img);
        if(empty($title))
        {
            $request->session()->flash('warning','标题不能为空');
            return redirect()->back();
        }
        if(empty($content))
        {
            $request->session()->flash('warning','内容不能为空');
            return redirect()->back();
        }
        $post = Post::create([
            'title' => $title,
            'content' => $content,
            'type' => $type,
            'username' => $username,
        ]);

        if ($post) {
            $request->session()->flash('success', '发表成功');
            return redirect()->back();
        } else {
            $request->session()->flash('warning', '发表失败');
            return redirect()->back();
        }



    }

    /*种植日志页面的内容*/
    public function rizhipage()
    {
        $posts = Post::where('type','=','rizhi')->orderBy('created_at','desc')->paginate(10);
//        dd($posts);
        return view('user.rizhi',['posts' => $posts]);
    }

    /*详情页*/
    public function single(Request $request)
    {
//        $id = $_GET['id'];
        $id = $request->id;
//        dd($id);
        $post = Post::find($id);
        $comments = Comment::where('pId','=',$id)->orderBy('created_at','desc')->get();
        $replys = Reply::where('pId','=',$id)->orderBy('created_at','desc')->get();
//        dd($replys);
        return view('user.single',[
            'post' => $post,
            'comments' => $comments,
            'replys' => $replys,
        ]);

    }

    /*个人中心*/
    public function personal()
    {
        $username = $_COOKIE['username'];
        $posts = Post::where('username','=',$username)->get();
        return view('user.personal',['posts' => $posts]);
    }

    /*删除文章*/
    public function dropPost(Request $request)
    {
        $id = $request->id;
//        if(empty($id))
//        {
//            $request->session()->flash('warning','已删除');
//
//        }
        $post = Post::find($id);
        $imgPath = $post->img_local_path;
        $bool = $post->delete();
        Storage::delete($imgPath);
        if($bool)
        {
//            $request->session()->flash('success','删除成功');
            return 'success';
        }
        else
        {
//            $request->session()->flash('warning','删除失败');
            return 'fail';

        }

    }

    /*搜索*/
    public function homeSearch(Request $request)
    {
        $keyword = $request->keyword;
        $posts = Post::where('title','like','%'.$keyword.'%')->get();
//        dd($posts);
        if(!empty($posts))
        {
            return $posts;
        }
        else
        {
            return null;
        }
    }

    /*留言*/
    public function liuyan(Request $request)
    {
        $username = $_COOKIE['username'];
        $pId = $_POST['pId'];
        $content = $_POST['content'];
//        dd($username,$pId,$content);
        if(empty($content))
        {
           $request->session()->flash('warning','内容不能为空');
           return redirect()->back();
        }
        else
        {
            $comment = Comment::create([
                'pId' => $pId,
                'username' => $username,
                'content' => $content,
            ]);
            if($comment)
            {
                $request->session()->flash('success','留言成功');
                return redirect()->back();
            }
        }
    }

    /*删除留言*/
    public function dropComment(Request $request)
    {
        $id = $_GET['id'];
        $comment = Comment::where('id','=',$id)->first();
        $count = Reply::where('cId','=',$id)->count();
        for($i=0;$i<$count;$i++)
        {
            $reply = Reply::where('cId','=',$id)->first();
            $reply->delete();
        }

//        dd($id,$comment);
        $bool = $comment->delete();
        if($bool)
        {
            $request->session()->flash('success','删除成功');
            return redirect()->back();
        }
        else
        {
            $request->session()->flash('warning','删除失败');
            return redirect()->back();
        }
    }

    /*回复留言*/
    public function reply(Request $request)
    {
        $username = $_COOKIE['username'];
        $pId = $_POST['pId'];
        $cId = $_POST['cId'];
        $content = $_POST['content'];
//        dd($username,$cId,$content);
        if (empty($content))
        {
            $request->session()->flash('warning','回复内容不能为空');
            return redirect()->back();
        }
        else
        {
            $reply = Reply::create([
                'pId' => $pId,
                'cId' => $cId,
                'username' => $username,
                'content' => $content,
            ]);
        }
        if($reply)
        {
            $request->session()->flash('success','回复成功');
            return redirect()->back();
        }
        else
        {
            $request->session()->flash('warning','回复失败');
            return redirect()->back();
        }
    }

}