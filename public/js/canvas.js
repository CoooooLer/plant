// canvas 验证码
var arr = "asdfghjklqwertyuiopzxcvbnm1234567890QWERTYUIOPASDFGHJKLZXCVBNM";
var canvas = document.getElementById("canvas");
var canvasr = document.getElementById("canvas-r");
var valiarr = "";
canvas === null ? "" : toclick(canvas);
canvasr === null ? "" : toclick(canvasr);
var can = canvas === null ? canvasr : canvas;
var vericodesDom = getdom("vericodes");

function getdom(res) {
    return document.getElementsByClassName(res)[0];
}

validate(can);
function validate(can) {
    valiarr = "";
    var context = can.getContext("2d");
    var index = -1;
    for(var i=0;i<=3;i++){
        var inx = random();
        while(inx === index){
            inx = random();
        }
        index = inx;
        valiarr += arr.charAt(index);
    }
    context.clearRect(0,0,500,500);
    context.beginPath();
    var gradient=context.createLinearGradient(0,0,can.width,0);
    gradient.addColorStop("0","magenta");
    gradient.addColorStop("0.5","blue");
    gradient.addColorStop("1.0","red");
    context.fillStyle=gradient;
    context.font="40px Arial";
    context.fillText(valiarr,20,40);
    valiarr = valiarr.toLowerCase();
    if(vericodesDom){
        vericodesDom.value = valiarr;
    }
}

function random() {
    var index = Math.round(Math.random()*61);
    return index;
}
function toclick(dom) {
    // console.log("aaaaa",dom);
    dom.addEventListener("click",()=> {
        validate(can);
    },false);
}

// 注册验证


var btnr = getdom("btn-r");
var allS = document.getElementsByClassName("all");
var all = Array.prototype.slice.call(allS);
var password = getdom("password");
var erruname = getdom("errusername");
var errpassword = getdom("errpassword");
var errpwds = getdom("errpwds");
var erremail = getdom("erruseremail");
var errvalidate = getdom("errvalidate");
var errall = document.getElementsByClassName("errall");

all.forEach(function (e, i) {
    e.addEventListener("blur",function tofunc() {
        var usernametext = e.value;
        var flag = true;
        var uname = usernametext;
        uname.split("").forEach(function (e, i, res) {
            if(e === " "){
                flag = false;
            }
        });
        if(usernametext === "" || flag === false){
            // console.log("asfd",e);
            if(e.className.indexOf("username") !== -1){
                erruname.innerHTML = "用户名不能为空！也不能有空格！";
            }else if(e.className.indexOf("password") !== -1){
                errpassword.innerHTML = "密码不能为空！也不能有空格！";
            }else if(e.className.indexOf("pwds") !== -1){
                errpwds.innerHTML = "确认密码不能为空！也不能有空格！";
            }else if(e.className.indexOf("useremail") !== -1){
                erremail.innerHTML = "邮箱不能为空！也不能有空格！";
            }else if(e.className.indexOf("validate") !== -1){
                errvalidate.innerHTML = "验证码不能为空！也不能有空格！";
            }
        }else {
            errall.innerHTML = "";
            errpwds.innerHTML = "";
           if(e.className.indexOf("useremail") !== -1){
               if(usernametext.indexOf("@") === -1 || usernametext.indexOf(".") === -1){
                   erremail.innerHTML = "邮箱格式不符合规范！";
               }else {
                   erremail.innerHTML = "";
               }
           }
           if(e.className.indexOf("validate") !== -1){
               var valitext = usernametext.toLowerCase();
               if(valitext !== valiarr){
                   errvalidate.innerHTML = "验证码错误！";
               }else{
                   errvalidate.innerHTML = "";
               }
           }
           if(e.className.indexOf("username") !== -1){
               var myReg = /[~!@#$%^&*()/\|,.<>?"'();:_+-={}]/;
               if(myReg.test(usernametext)){
                   erruname.innerHTML = "不能包含特殊字符";
               }else {
                   erruname.innerHTML = "";
               }
               if(usernametext.length > 8 || usernametext.length <2){
                   erruname.innerHTML = "用户名长度在2位到8位之间";
               }else {
                   erruname.innerHTML = "";
               }
           }
           if(e.className.indexOf("password") !== -1){
               if(usernametext.length > 16 || usernametext.length <6){
                   errpassword.innerHTML = "密码长度在6位到16位之间";
               }else {
                   errpassword.innerHTML = "";
               }
           }
           if(e.className.indexOf("pwds") !== -1){
               var pass = password.value;
               if(usernametext !== pass){
                   errpwds.innerHTML = "两次密码不一致！";
               }else {
                   errpwds.innerHTML = "";
               }
           }
        }
    },false)
});
//注册按钮
if(btnr){
    btnr.addEventListener("click",function (e) {
        var fg = true;
        for(var i = 0; i < all.length; i++){
            if(allS[i].value === ""){
                fg = false;
            }
        }
        if(!fg){
            // alert("还有选项未填！");
        }
    },false)
}


// 登录验证马
var errlogin = getdom("errlogin");
var validlogin = getdom("validlogin");
validlogin.addEventListener("blur",function (e) {
    var errvalid = validlogin.value.toLowerCase();
    if(errvalid !== valiarr){
        errlogin.innerHTML = "验证码错误！"
    }else {
        errlogin.innerHTML = "";
    }
},false)

/*登录按钮*/

// var loginbtnDom = getdom("loginbtn");
// //
// loginbtnDom.addEventListener("click",(ev)=>{
//     console.log(getdom("validlogin").value);
//     console.log(getdom("vericodes").value);

//     var uname = getdom("suname").value;
//     var pwd = getdom("spwd").value;
//     var xml = new XMLHttpRequest();
//     var formdata = new FormData();
//     formdata.append("username",uname);
//     formdata.append("password",pwd);
//     xml.open("POST","",true);
//     xml.send(formdata);
// },false)













