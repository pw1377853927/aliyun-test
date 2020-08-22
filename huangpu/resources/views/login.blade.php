<!DOCTYPE html>
<html>
<head>
<title>黄埔管理后台</title>
<style type="text/css">
    html{
            background-color: white;
        }
        .top{
            background: rgb(57,117,222);
            width: 100%;
        }
        
        .banner{
            padding: 10px 25%;
            margin: 0 auto;
        }
        *{
            margin: 0;
            padding: 0;
        }
        .mid{
            padding: 20px 25%;
            height: 700px
        }
        input{
            border: 1px solid #b5b5b5;
            padding: 10px 10px;
            border-radius: 5px;
            margin-right: 20px;
        }

</style>
</head>
<body>
    <div class="top">
        <div class="banner">
            <p style="width: 100%;text-align: center;color: white;font-size: 24px">黄埔管理后台</p>
        </div>
    </div>
    
    <div class="mid">
      <div style="margin-top: 200px">
          <div style="width: 250px;margin: 30px auto;position: relative;">
              <p style="color: #b5b5b5;font-size: 14px;padding-left: 5px;position: absolute;left: 0px;top: -23px">账号</p>
              <input id="username" style=" width: 100%;" type="" name="">
          </div>
          <div style="width: 250px;margin: 30px auto;position: relative;">
              <p style="color: #b5b5b5;font-size: 14px;padding-left: 5px;position: absolute;left: 0px;top: -23px">密码</p>
              <input id="password" style=" width: 100%" type="password" name="">
          </div>

          <div style="text-align: center;margin-top:40px;" id="btn">
                <span style="padding: 6px 20px;background-color: #3c76e1;color:white;border-radius: 5px;">登录</span>
          </div>
      </div>
    </div>
    <div style="margin-top:100px;width: 100%;text-align: center;">
        <p class="ziti">Copyright © 2006-2020 Liepin campus. All Rights Reserved.</p>
        <p class="ziti">猎聘校园 版权所有</p>
    </div>
</body>
<script src="https://libs.baidu.com/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript">
    var success_url = "{{url('index')}}";
    var post_url = "{{url('do_login')}}";
	$('#btn').on('click', function(){
        data = {
            username:$('#username').val(),
            password:$('#password').val()
        };
		$.ajax({
            type:'post',
            // url: 'http://106.14.20.148/login',
            url: post_url,
            data: JSON.stringify(data),
            withCredentials : true,
            contentType: "application/json;charset=utf-8",
            dataType:'json',
            success: function(res){
                if(res.code == 0){
                    alert('登陆成功！');
                	window.location.href=success_url
                }
            }
        });
	});

</script>
</html>