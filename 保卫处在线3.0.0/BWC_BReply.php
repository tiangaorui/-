<?php
//连接数据库部分
header("content-type:text/html;charset=utf-8");
include "CONNECT.php";
$database="bwconline";
$db = new MySQLi($host,$user,$password,$database);
!mysqli_connect_error() or die("连接失败！！");
$db->query("set names utf8");
session_start();
$shownum=$_SESSION['shownum'];
$show=$_GET['show'];
$number = $shownum + $show-1;
$_SESSION['number']=$number;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>信息回复</title>
    <!-- for-mobile-apps -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
        function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!-- //for-mobile-apps -->
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
    <!-- js -->
    <script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
    <!-- //js -->
    <!-- font-awesome icons -->
    <link rel="stylesheet" href="css/font-awesome.min.css" />
    <!-- //font-awesome icons -->
    <link href="http://fonts.googleapis.com/css?family=Comfortaa" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
    <script type="text/javascript">

        function setImagePreview() {

            var docObj=document.getElementById("doc");

            var imgObjPreview=document.getElementById("preview");

            if(docObj.files && docObj.files[0]){


                imgObjPreview.style.display = 'block';

                imgObjPreview.style.width = '250px';

                imgObjPreview.style.height = '120px';

                //imgObjPreview.src = docObj.files[0].getAsDataURL();



                //火狐7以上版本不能用上面的getAsDataURL()方式获取，需要一下方式

                imgObjPreview.src = window.URL.createObjectURL(docObj.files[0]);

            }else{

                //IE下，使用滤镜

                docObj.select();

                var imgSrc = document.selection.createRange().text;

                var localImagId = document.getElementById("localImag");

                //必须设置初始大小

                localImagId.style.width = "250px";

                localImagId.style.height = "120px";

                //图片异常的捕捉，防止用户修改后缀来伪造图片

                try{

                    localImagId.style.filter="progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale)";

                    localImagId.filters.item("DXImageTransform.Microsoft.AlphaImageLoader").src = imgSrc;

                }catch(e){

                    alert("您上传的图片格式不正确，请重新选择!");

                    return false;

                }

                imgObjPreview.style.display = 'none';

                document.selection.empty();

            }

            return true;

        }

    </script>

</head>
<body>
<div class="header w3layouts">
    <div class="container">
        <nav class="navbar navbar-default">
            <div class="navbar-header navbar-left">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <h1><a style="font-family: STFangsong" class="navbar-brand" href="主界面.html">保卫处在线</a></h1>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
                <nav class="cl-effect-13" id="cl-effect-13">
                    <ul class="nav navbar-nav">
                        <li class="active" class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">保安你好！ <b class="caret"></b></a>
                            <ul class="dropdown-menu agile_short_dropdown">
                                <li><a href="保安登录.html">退出</a></li>
                            </ul>
                        </li>
                    </ul>

                </nav>
            </div>
        </nav>
    </div>
</div>
<!-- banner -->
<div class="w3-banner1">
</div>
<!-- //banner -->
<!-- packages -->
<div class="contact">
    <div class="container">
        <div class="container">
            <div class="well" style="min-height: 100px;overflow: hidden">
                <?php
                $sql = "SELECT * from bwconline limit $number,1";
                $info = $db->query($sql);
                $row=mysqli_fetch_assoc($info);
                ?>
                <strong><p id="time">时间:<?php echo $row['time'];?></p></strong>
                <strong><p id="name">姓名：<?php echo $row['name'];?></p></strong>
                <strong><p id="name">手机号：<?php echo $row['phone'];?></p></strong>
                <div id="content" style="width: 800px; float: left">求助内容：<?php echo $row['text'];?></div>
		<div id="image" style="width: 280px; float: right"><img src="<?php echo $row['location']?>" width="270px" onclick="javascript:window.open(this.src)" style="cursor: pointer">这里是图片</div>
            </div>
        </div>
        <div class="w3_contact_grids">
            <form action="BWC_Reply.php" method="post" id="mainform1" enctype="multipart/form-data">
                <script type="text/javascript">
                    <!--
                    function show_selected_item_val($item){5
                        document.getElementById("show_content").innerHTML= $item.value;
                    }
                    //-->
                </script>
                <div id="localImag" style="float:right;width:130px;text-align:center; margin:0 auto margin-left:auto; margin-right:auto;">
                    <img id="preview" style="width:90px; height:120px;" runat="server" />
                </div>
                <span class="input input--jiro">
						<input class="input__field input__field--jiro" type="text" id="input-20" name="BName" placeholder="你的名字" required="">
						<label class="input__label input__label--jiro" for="input-20">
							<span class="input__label-content input__label-content--jiro">保安姓名</span>
						</label>
					</span>
                <p align="right"><input type="file" value="选择图片" accept="image/*" name="doc" id="doc" onchange="javascript:setImagePreview();"></p>
                <span class="input input--jiro">
						<input class="input__field input__field--jiro" type="text" id="input-22" name="BPhone_Number" placeholder="你的联系方式" required="">
						<label class="input__label input__label--jiro" for="input-22">
							<span class="input__label-content input__label-content--jiro">联系方式</span>
						</label>
					</span>
                <textarea name="BMessage" placeholder="在这里输入你的回复内容..." required=""></textarea>
                <br /><br />
                <input type="submit" name="submit" value="发送">
            </form>
        </div>
    </div>
</div>

<script src="js/classie.js"></script>
<script>

    (function() {
        // trim polyfill : https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/Trim
        if (!String.prototype.trim) {
            (function() {
                // Make sure we trim BOM and NBSP
                var rtrim = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g;
                String.prototype.trim = function() {
                    return this.replace(rtrim, '');
                };
            })();
        }

        [].slice.call( document.querySelectorAll( 'input.input__field' ) ).forEach( function( inputEl ) {
            // in case the input is already filled..
            if( inputEl.value.trim() !== '' ) {
                classie.add( inputEl.parentNode, 'input--filled' );
            }

            // events:
            inputEl.addEventListener( 'focus', onInputFocus );
            inputEl.addEventListener( 'blur', onInputBlur );
        } );

        function onInputFocus( ev ) {
            classie.add( ev.target.parentNode, 'input--filled' );
        }

        function onInputBlur( ev ) {
            if( ev.target.value.trim() === '' ) {
                classie.remove( ev.target.parentNode, 'input--filled' );
            }
        }
    })();
</script>


<!-- //packages -->
<!-- footer -->
<div class="agileinfo_footer_bottom">
    <div class="container">
        <div class="col-md-4 agileinfo_footer_bottom_grid">
            <h3>联系我们</h3>
            <ul>
                <li><span class="glyphicon glyphicon-home" aria-hidden="true"></span> 上海交通大学保卫处</li>
                <li><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span><a href="">邮箱</a></li>
                <li><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span> 54749110</li>
            </ul>

        </div>

        <div class="col-md-4 agileinfo_footer_bottom_grid">
            <h3>相关网站</h3>
            <p><a href="http://electsys.sjtu.edu.cn/edu/">教学信息服务网</a></p>
        </div>
        <div class="col-md-4 agileinfo_footer_bottom_grid">
            <h3>校园风景</h3>
            <div class="flickr-grids">
                <div class="flickr-grid agileits_w3layouts_flickr">
                    <a href="#"><img src="images/2.jpg" alt=" " class="img-responsive"></a>
                </div>
                <div class="flickr-grid  agileits_w3layouts_flickr">
                    <a href="#"><img src="images/3.jpg" alt=" " class="img-responsive"></a>
                </div>
                <div class="flickr-grid  agileits_w3layouts_flickr">
                    <a href="#"><img src="images/4.jpg" alt=" " class="img-responsive"></a>
                </div>
                <div class="clearfix"> </div>

                <div class="flickr-grid  agileits_w3layouts_flickr">
                    <a href="#"><img src="images/5.jpg" alt=" " class="img-responsive"></a>
                </div>
                <div class="flickr-grid  agileits_w3layouts_flickr">
                    <a href="#"><img src="images/6.jpg" alt=" " class="img-responsive"></a>
                </div>
                <div class="flickr-grid  agileits_w3layouts_flickr">
                    <a href="#"><img src="images/7.jpg" alt=" " class="img-responsive"></a>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
        <div class="clearfix"> </div>
    </div>
</div>


<!-- //footer -->
<!-- for bootstrap working -->
<script src="js/bootstrap.js"></script>
<!-- //for bootstrap working -->
</body>
</html>