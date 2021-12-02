
<!DOCTYPE html>
<html lang='en' class=''>

<head>

  <meta charset='UTF-8'>
  <title>CodePen Demo</title>

  <meta name="robots" content="noindex">

  <link rel="shortcut icon" type="image/x-icon" href="https://cpwebassets.codepen.io/assets/favicon/favicon-aec34940fbc1a6e787974dcd360f2c6b63348d4b1f4e06c77743096d55480f33.ico">
  <link rel="mask-icon" href="https://cpwebassets.codepen.io/assets/favicon/logo-pin-8f3771b1072e3c38bd662872f6b673a722f4b3ca2421637d5596661b4e2132cc.svg" color="#111">
  <link rel="canonical" href="https://codepen.io/ben-buli/pen/XWeroEY?editors=1010">

  
  

  <style class="INLINE_PEN_STYLESHEET_ID">
    html, body { height: 100%; margin: 0; background: #2294b3; overflow: hidden; }

.container { padding-top: 62.5%; position: absolute; width: 100%; bottom: 0; left: 0; }
.container.active { cursor: ew-resize; }

img,
.mound-group,
.houses-group,
.flbottom-group,
.blbottom-group,
.brleg,
.frleg,
.blleg,
.flleg { position: absolute; transform-style: preserve-3d; }

.castle-container { position: absolute; left: 100%; bottom: 0%; }
.castle { position: absolute; top: 0; left: 0; width: 600px; height: 750px; perspective: 1000px; transform-origin: 50% 70%; transform: translate(-50%, -70%) rotateZ(9deg); }
.brleg { left: 400px; top: 625px; transform-origin: 10px -10px; transform: rotateZ(0deg); }
.brfoot { left: -18px; top: 82px; transform-origin: 56% 44%; transform: rotateZ(0deg); }
.brbottom {  }
.frleg { left: 240px; top: 653px; transform-origin: 8px -10px; transform: rotateZ(0deg); }
.frfoot { left: -18px; top: 51px; transform-origin: 56% 44%; transform: rotateZ(0deg); }
.frbottom {  }
.chimney3 { left: 400px; top: 30px; transform-origin: 45% 120%; transform: rotateZ(0deg); }
.houses-group { left: 305px; top: 130px; transform-origin: -50px 300px; transform: rotateZ(1deg); }
.point6 { left: 84px; top: 19px; transform-origin: 40% 120%; transform: rotateZ(0deg); }
.point5 { left: 70px; top: -23px; transform-origin: -40% 200%; transform: rotateZ(0deg); }
.point4 { left: 40px; top: -17px; transform-origin: 0% 100%; transform: rotateZ(0deg); }
.houses {  }
.treehouse { left: 220px; top: 10px; transform-origin: 50% 150%; transform: rotateZ(0deg); }
.chimney2 { left: 430px; top: 120px; transform-origin: 0% 90%; transform: rotateZ(0deg); }
.chimney1 { left: 420px; top: 90px; transform-origin: -10% 90%; transform: rotateZ(0deg); }
.wing { left: 420px; top: 370px; transform-origin: 0% 50%; transform: rotateZ(0deg); }
.antenna { left: -100px; top: 90px; transform-origin: 100% 65%; transform: rotateZ(0deg); }
.mound-group { left: 115px; top: 110px; transform-origin: 110px 220px; transform: rotateZ(0deg); }
.point3 { left: 125px; top: -13px; transform-origin: 50% 400%; transform: rotateZ(0deg); }
.point2 { left: 50px; top: -22px; transform-origin: 120% 200%; transform: rotateZ(0deg); }
.point1 { left: 4px; top: 55px; transform-origin: 150% 150%; transform: rotateZ(0deg); }
.mound {  }
.wind { left: 400px; top: 260px; transform-origin: 0% 90%; transform: rotateZ(0deg); }
.cannon { left: 30px; top: 460px; transform-origin: 100% 60%; transform: rotateZ(0deg); }
.main { left: 80px; top: 230px; transform-origin: 50% 50%; transform: rotateZ(0deg); }
.blleg { left: 410px; top: 615px; transform-origin: 10px 15px; transform: rotateZ(0deg); }
.blbottom-group { left: 0px; top: 60px; transform-origin: 10px 0px; transform: rotateZ(0deg); }
.blfoot { left: -19px; top: 68px; transform-origin: 56% 44%; transform: rotateZ(0deg); }
.blbottom {  }
.bltop {  }
.blcover { left: 360px; top: 573px; }
.knob { left: 214px; top: 524px; transform-origin: 30% 63%; transform: rotateZ(0deg); }
.tele { left: 90px; top: 430px; transform-origin: 90% 50%; transform: rotateZ(0deg); }
.telecover { left: 161px; top: 399px; }
.flleg { left: 250px; top: 615px; transform-origin: 10px 15px; transform: rotateZ(0deg); }
.flbottom-group { left: 0px; top: 60px; transform-origin: 10px 0px; transform: rotateZ(0deg); }
.flfoot { left: -19px; top: 68px; transform-origin: 56% 44%; transform: rotateZ(0deg); }
.flbottom {  }
.fltop {  }
.flcover { left: 244px; top: 567px; }

.foreground { position: absolute; bottom: 0; left: 0; width: 100%; }
.background { position: absolute; bottom: 25.5%; left: 0; width: 100%; }

.cloud-bg { bottom: 17%; width: 80%; right: 100%;}
.cloud-bg2 { bottom: 17%; width: 80%; right: 100%; }

.cloud-shadow1 { bottom: 43%; right: 100%; width: 80%; transform: rotate(5deg); }
.cloud1 { bottom: 30%; right: 100%; width: 80%; }
.cloud-shadow2 { bottom: 12%; left: 36%; width: 80%; transform: rotate(5deg); }
.cloud-shadow3 { bottom: 31%; left: -30%; width: 80%; transform: rotate(5deg); }
.cloud2 { bottom: 46%; left: -29%; width: 80%; }
.cloud3 { bottom: 38%; left: 17%; width: 80%; }
.cloud4 { bottom: 18%; left: -18%; width: 80%; }
.cloud5 { bottom: 8%; left: 40%; width: 80%; }

.control-toggle { position: absolute; top: 0; left: 0; padding: 10px 20px; background: rgba(255,255,255,1); font-family: sans-serif; text-transform: uppercase; font-size: 10px; letter-spacing: 0.05em; opacity: 0.1; cursor: pointer; }
.control-toggle:hover { opacity: 1.0;}

.load-gate { position: absolute; top: 0; right: 0; bottom: 0; left: 0; background: #fff; font-family: sans-serif; text-transform: uppercase; font-size: 10px; letter-spacing: 0.2em; padding: 20px; }








  </style>

  
<script src="https://cpwebassets.codepen.io/assets/editor/iframe/iframeConsoleRunner-d8236034cc3508e70b0763f2575a8bb5850f9aea541206ce56704c013047d712.js"></script>
<script src="https://cpwebassets.codepen.io/assets/editor/iframe/iframeRefreshCSS-4793b73c6332f7f14a9b6bba5d5e62748e9d1bd0b5c52d7af6376f3d1c625d7e.js"></script>
<script src="https://cpwebassets.codepen.io/assets/editor/iframe/iframeRuntimeErrors-4f205f2c14e769b448bcf477de2938c681660d5038bc464e3700256713ebe261.js"></script>
</head>

<body>
  <audio src="http://cinemont.com/tutorials/howls/in_the_rain.mp3" autoplay loop></audio>
<div class="container">
    <img class="background" src="http://cinemont.com/tutorials/howls/background.jpg">

    <img class="cloud-bg" src="http://cinemont.com/tutorials/howls/cloud-bg.png">
    <img class="cloud-bg2" src="http://cinemont.com/tutorials/howls/cloud-bg.png">

    <div class="castle-container">
        <div class="castle">
            <div class="brleg">
                <img class="brfoot" src="http://cinemont.com/tutorials/howls/brfoot.png" />
                <img class="brbottom" src="http://cinemont.com/tutorials/howls/brbottom.png" />
            </div>
            <div class="frleg">
                <img class="frfoot" src="http://cinemont.com/tutorials/howls/frfoot.png" />
                <img class="frbottom" src="http://cinemont.com/tutorials/howls/frbottom.png" />
            </div>
            <img class="chimney3" src="http://cinemont.com/tutorials/howls/chimney3.png" />
            <img class="treehouse" src="http://cinemont.com/tutorials/howls/treehouse.png" />
            <div class="houses-group">
                <img class="point6" src="http://cinemont.com/tutorials/howls/point6.png" />
                <img class="point5" src="http://cinemont.com/tutorials/howls/point5.png" />
                <img class="point4" src="http://cinemont.com/tutorials/howls/point4.png" />
                <img class="houses" src="http://cinemont.com/tutorials/howls/houses.png" />
            </div>
            <img class="chimney2" src="http://cinemont.com/tutorials/howls/chimney2.png" />
            <img class="chimney1" src="http://cinemont.com/tutorials/howls/chimney1.png" />
            <img class="wing" src="http://cinemont.com/tutorials/howls/wing.png" />
            <div class="mound-group">
                <img class="antenna" src="http://cinemont.com/tutorials/howls/antenna.png" />
                <img class="point3" src="http://cinemont.com/tutorials/howls/point3.png" />
                <img class="point2" src="http://cinemont.com/tutorials/howls/point2.png" />
                <img class="point1" src="http://cinemont.com/tutorials/howls/point1.png" />
                <img class="mound" src="http://cinemont.com/tutorials/howls/mound.png" />
            </div>
            <img class="wind" src="http://cinemont.com/tutorials/howls/wind.png" />
            <img class="cannon" src="http://cinemont.com/tutorials/howls/cannon.png" />
            <img class="main" src="http://cinemont.com/tutorials/howls/main.png" />
            <div class="blleg">
                <div class="blbottom-group">
                    <img class="blfoot" src="http://cinemont.com/tutorials/howls/flfoot.png" />
                    <img class="blbottom" src="http://cinemont.com/tutorials/howls/flbottom.png" />
                </div>
                <img class="bltop" src="http://cinemont.com/tutorials/howls/fltop.png" />
            </div>
            <img class="blcover" src="http://cinemont.com/tutorials/howls/blcover.png" />
            <img class="knob" src="http://cinemont.com/tutorials/howls/knob.png" />
            <img class="tele" src="http://cinemont.com/tutorials/howls/tele.png" />
            <img class="telecover" src="http://cinemont.com/tutorials/howls/telecover.png" />
            <div class="flleg">
                <div class="flbottom-group">
                    <img class="flfoot" src="http://cinemont.com/tutorials/howls/flfoot.png" />
                    <img class="flbottom" src="http://cinemont.com/tutorials/howls/flbottom.png" />
                </div>
                <img class="fltop" src="http://cinemont.com/tutorials/howls/fltop.png" />
            </div>
            <img class="flcover" src="http://cinemont.com/tutorials/howls/flcover.png" />
        </div>
    </div>
    
    <img class="foreground" src="http://cinemont.com/tutorials/howls/foreground.png">
    
    <div class="clouds">
        <img class="cloud-shadow1" src="http://cinemont.com/tutorials/howls/cloud_shadow-1.png">
        <img class="cloud-shadow2" src="http://cinemont.com/tutorials/howls/cloud_shadow-1.png">
        <img class="cloud-shadow3" src="http://cinemont.com/tutorials/howls/cloud_shadow-1.png">
        <img class="cloud1" src="http://cinemont.com/tutorials/howls/cloud-1.png">
        <img class="cloud2" src="http://cinemont.com/tutorials/howls/cloud-1.png">
        <img class="cloud3" src="http://cinemont.com/tutorials/howls/cloud-2.png">
        <img class="cloud4" src="http://cinemont.com/tutorials/howls/cloud-1.png">
        <img class="cloud5" src="http://cinemont.com/tutorials/howls/cloud-2.png">
    </div>
    
</div>
<div class="control-toggle">Toggle mouse controls</div>
<div class="load-gate">Loading...</div>
  
<script src="https://cpwebassets.codepen.io/assets/common/stopExecutionOnTimeout-1b93190375e9ccc259df3a57c1abc0e64599724ae30d7ea4c6877eb615f89387.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.14.2/TweenMax.min.js"></script>
  <script  src="https://cdpn.io/cp/internal/boomboom/pen.js?key=pen.js-09db38f5-3ed7-bfd0-1395-383b1aa51798" crossorigin></script>
</body>

</html>