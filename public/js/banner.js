
    //Dom对象获取
    /*
    * $$(".hhj-hidden-bottom")[0]
    * $$("#hhj-hidden-bottom")
    * $$("div")[0]
    *
    * */
    "use strict";
    const buguize="!@$%^&(*)~`?/><\\,|";
    var $$ = function (...x) {
        //检测异常字符
        for(let s of x.toString()){
            if(buguize.indexOf(s) !== -1){
                error();
                return;
            }
        }
        //把数组a转换成字符串，并去掉最前面和最后面的空字符
        let a=x.toString();
        a=a.replace(/(^\s+)|(\s+$)/g,"");
        //获取DOM
        if(a[0]==="#"){
            let m=a.replace("#","");
            return document.getElementById(m);
        }else if(a[0]==="."){
            let m=a.replace(".","");
            return document.getElementsByClassName(m);
        }else {
            return document.getElementsByTagName(a);
        }
    };
    var error = function () {
        alert("参数异常！");
    };


//Dom对象赋值
    /*
    * 需要传入的参数
    * 参数1：
    *{
    * home:domone
    * two:dontwo
    * }  //要赋值的dom对象  可以传入多个对象，每个对象的属性值单独放在一个对象中
    * 参数2：
    *{
    * //domone的第一个属性
    * style:value  //要赋值的属性和值
    * //domone的第二个属性
    *
    * }
    * 参数3：
    * {
    * //domtwo的第一个属性值
    * style:value  //要赋值的属性和值
    * }
    *
    *
    * 例：set({home:domone,two:domtwo},{color:"red",fontSize:"16px"},{color:"blue",fontSize:"20px"});
    *
    *
    * */
    var set=function (dm,...sv) {
        let index=-1;
        for(let k in dm){
            index++;
            for(let key in sv[index]){
                dm[k].style[key]=sv[index][key];
            }
        }
    }

//随机数
    var randomto=function(a=1,b=0) {
        return Math.round(Math.random()*a+b);
    }

//banner  轮播图
    let banner_index = 0;
    let banner_first = 0;
    let bannerTimer = setInterval(lunbo, 2000);
    let hb = $$(".right-banner");
    let ho = $$(".dian-o");
    let hd = $$(".banner-background")[0];

//自动播放
    function lunbo() {
        toright();
    }

// 点击小圆点或左右切换按钮
    $$(".yesbanner-right")[0].addEventListener("click", dian, false);

    function dian(e) {
        yuanjie();
        //小圆点
        if (new RegExp(/dian-o/ig).test(e.target.className)) {
            let index = e.target.getAttribute("data-index");
            let images = $$(".right-banner")[index].getAttribute("data-image");
            let url = "url('" + images + "')";
            if (index === banner_first) return;
            if (index > banner_index){
                setTimeout(() => {
                    set({one: hb[banner_first]}, {transition: "none", left: "100%"});
                    let num = banner_first;
                    setTimeout(() => set({one: hb[num]}, {transition: "all .8s ease"}), 100);
                    banner_first = index;
                    banner_index = index;
                }, 800);
                set({one: hb[banner_first], two: ho[banner_first], there: hb[index], four: e.target, five: hd},
                    {left: "-100%"}, {backgroundColor: "#424242"}, {left: "0"}, {backgroundColor: "#FFF"}, {backgroundImage: url});
            }else {
                set({one: hb[index]}, {transition: "none", left: "-100%"});
                setTimeout(()=>{
                    setTimeout(() => {
                        set({one: hb[banner_first]}, {transition: "none", left: "100%"});
                        let num = banner_first;
                        setTimeout(() => set({one: hb[num]}, {transition: "all .8s ease"}), 100);
                        banner_first = index;
                        banner_index = index;
                    }, 800);
                    set({one: hb[banner_first], two: ho[banner_first], there: hb[index], four: e.target, five: hd},
                        {left: "100%"}, {backgroundColor: "#424242"}, {left: "0", transition: "all .8s ease"}, {backgroundColor: "#FFF"}, {backgroundImage: url});
                },100)
            }

        }
        //左按钮
        if (new RegExp(/leftt/ig).test(e.target.className)) {
            banner_index = --banner_index < 0 ? 5 : banner_index;
            let images = $$(".right-banner")[banner_index].getAttribute("data-image");
            let url = "url('" + images + "')";
            set({one: hb[banner_index]}, {transition: "none", left: "-100%"});
            setTimeout(() => {
                set({
                        one: hb[banner_index],
                        two: ho[banner_index],
                        there: hb[banner_first],
                        four: ho[banner_first],
                        five: hd
                    },
                    {
                        left: "0",
                        transition: "all .8s ease"
                    }, {backgroundColor: "#fff"}, {left: "100%"}, {backgroundColor: "#424242"}, {backgroundImage: url});
                banner_first = banner_index;
            }, 100);
        }
        //右按钮
        if (new RegExp(/rightt/ig).test(e.target.className)) {
            toright();
        }
    }

    function toright() {
        banner_index = ++banner_index > 5 ? 0 : banner_index;
        let images = $$(".right-banner")[banner_index].getAttribute("data-image");
        let url = "url('" + images + "')";
        set({one: hb[banner_first], two: ho[banner_first]}, {left: "-100%"}, {backgroundColor: "#424242"});
        setTimeout(() => {
            set({one: hb[banner_first]}, {transition: "none", left: "100%"});
            let num = banner_first;
            setTimeout(() => $$(".right-banner")[num].style.transition = "all .8s ease", 100);
            banner_first = banner_index;
        }, 800);
        set({
            one: hb[banner_index],
            two: ho[banner_index],
            five: hd
        }, {left: "0"}, {backgroundColor: "#FFF"}, {backgroundImage: url});
    }

//banner 轮播定时器节流
    $$(".yesbanner")[0].addEventListener("mouseenter", () => clearInterval(bannerTimer), false);
    $$(".yesbanner")[0].addEventListener("mouseleave", () => bannerTimer = setInterval(lunbo, 2000), false);

//banner 小圆点点击事件节流
    function yuanjie() {
        $$(".yesbanner-right")[0].removeEventListener("click", dian, false);
        setTimeout(() => $$(".yesbanner-right")[0].addEventListener("click", dian, false), 800);
    }

