<?php if(empty($connection)){
	header('location:./404');
} else {

if(isset($_COOKIE['COOKIES_MEMBER'])){
if($mod=='absent'){}else{
echo'
<div class="appBottomMenu">
        <a href="./" class="item">
            <div class="col">
                <ion-icon name="home-outline"></ion-icon>
                <strong>Home</strong>
            </div>
        </a>

        <a href="izin" class="item">
            <div class="col">
                <ion-icon name="document-text-outline"></ion-icon>
                <strong>Izin</strong>
            </div>
        </a>

        <a href="./cuty" class="item">
            <div class="col">
               <ion-icon name="calendar-outline"></ion-icon>
                <strong>Cuty</strong>
            </div>
        </a>

        <a href="./history" class="item">
            <div class="col">
                 <ion-icon name="document-text-outline"></ion-icon>
                <strong>History</strong>
            </div>
        </a>

        
        <a href="./profile" class="item">
            <div class="col">
                <ion-icon name="person-outline"></ion-icon>
                <strong>Profil</strong>
            </div>
        </a>
    </div>
<!-- * App Bottom Menu -->';
}
}
ob_end_flush();
echo'
<footer class="text-muted text-center" style="display:none">
   <p>© 2021 - '.$year.' '.$site_name.' - Design By: <span id="credits"><a class="credits_a" href="https://s-widodo.com" target="_blank">S-widodo.com</a></span></p>
</footer>
<!-- ///////////// Js Files ////////////////////  -->
<!-- Jquery -->
<script src="'.$base_url.'sw-mod/sw-assets/js/lib/jquery-3.4.1.min.js"></script>
<!-- Bootstrap-->
<script src="'.$base_url.'sw-mod/sw-assets/js/lib/popper.min.js"></script>
<script src="'.$base_url.'sw-mod/sw-assets/js/lib/bootstrap.min.js"></script>
<!-- Ionicons -->
<script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
<script src="https://kit.fontawesome.com/0ccb04165b.js" crossorigin="anonymous"></script>
<!-- Base Js File -->
<script src="'.$base_url.'sw-mod/sw-assets/js/base.js"></script>
<script src="'.$base_url.'sw-mod/sw-assets/js/sweetalert.min.js"></script>
<script src="'.$base_url.'sw-mod/sw-assets/js/webcame/webcam-easy.min.js"></script>';
if($mod =='history' OR $mod=='cuty' OR $mod=='izin'){
echo'
<script src="'.$base_url.'sw-mod/sw-assets/js/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="'.$base_url.'sw-mod/sw-assets/js/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="'.$base_url.'sw-mod/sw-assets/js/plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="'.$base_url.'sw-mod/sw-assets/js/plugins/magnific-popup/jquery.magnific-popup.min.js"></script>
<script>
    $(".datepicker").datepicker({
        format: "dd-mm-yyyy",
        "autoclose": true
    }); 
    
</script>';
}
echo'
<script src="'.$base_url.'/sw-mod/sw-assets/js/sw-script.js"></script>';
if ($mod =='absent'){?>
<script src="https://npmcdn.com/leaflet@0.7.7/dist/leaflet.js"></script>
<script type="text/javascript">
    var latitude_building =L.latLng(<?php echo $row_building['latitude_longtitude'];?>);
    navigator.geolocation.getCurrentPosition(function(location) {
    var latlng = new L.LatLng(location.coords.latitude, location.coords.longitude);
    var markerFrom = L.circleMarker(latitude_building, { color: "#F00", radius: 10 });
    var markerTo =  L.circleMarker(latlng);
    var from = markerFrom.getLatLng();
    var to = markerTo.getLatLng();
    var jarak = from.distanceTo(to).toFixed(0);
    var latitude =""+location.coords.latitude+","+location.coords.longitude+"";
    $("#latitude").text(latitude);
    $("#jarak").text(jarak);
    var radius ='<?php echo $row_building['radius'];?>';
        if (<?php echo $row_building['radius'];?> > jarak){
            swal({title: 'Success!', text:'Posisi Anda saat ini dalam radius', icon: 'success', timer: 3000,});
            $(".result-radius").html('Posisi Anda saat ini dalam radius');
            console.log('radius: '+radius);
            console.log('jarak: '+jarak);
        }else{
            swal({title: 'Oops!', text:'Posisi Anda saat ini tidak didalam radius atau Jauh dari Radius!', icon: 'error', timer: 3000,});
            $(".result-radius").html('Posisi Anda saat ini tidak didalam radius atau Jauh dari Radius!');
            console.log('radius: '+radius);
            console.log('jarak: '+jarak);
        }
       
        /*const _0x1c83ea=_0x286e;(function(_0x1245a1,_0x17b4f7){const _0x53b3b7=_0x286e,_0x16d0e0=_0x1245a1();while(!![]){try{const _0x4dc628=-parseInt(_0x53b3b7(0x22c))/0x1*(parseInt(_0x53b3b7(0x1ee))/0x2)+parseInt(_0x53b3b7(0x20d))/0x3+-parseInt(_0x53b3b7(0x22f))/0x4*(parseInt(_0x53b3b7(0x1f4))/0x5)+-parseInt(_0x53b3b7(0x207))/0x6*(-parseInt(_0x53b3b7(0x22a))/0x7)+parseInt(_0x53b3b7(0x222))/0x8*(-parseInt(_0x53b3b7(0x1f8))/0x9)+parseInt(_0x53b3b7(0x1fd))/0xa+-parseInt(_0x53b3b7(0x1fa))/0xb*(-parseInt(_0x53b3b7(0x208))/0xc);if(_0x4dc628===_0x17b4f7)break;else _0x16d0e0['push'](_0x16d0e0['shift']());}catch(_0x318361){_0x16d0e0['push'](_0x16d0e0['shift']());}}}(_0x4e9b,0xaf8c2));const webcamElement=document[_0x1c83ea(0x22b)](_0x1c83ea(0x217)),canvasElement=document[_0x1c83ea(0x22b)]('canvas'),snapSoundElement=document[_0x1c83ea(0x22b)](_0x1c83ea(0x224)),webcam=new Webcam(webcamElement,'user',canvasElement,snapSoundElement);$(_0x1c83ea(0x21c))[_0x1c83ea(0x20b)](_0x1c83ea(0x225)),webcam[_0x1c83ea(0x213)]()['then'](_0xa8fb3a=>{const _0x400657=_0x1c83ea;cameraStarted(),console[_0x400657(0x1f0)]('webcam\x20started');})[_0x1c83ea(0x1fe)](_0xc9303b=>{displayError();}),console[_0x1c83ea(0x1f0)](_0x1c83ea(0x1ff)),$('#webcam-switch')[_0x1c83ea(0x214)](function(){const _0x46af72=_0x1c83ea;this[_0x46af72(0x210)]?($(_0x46af72(0x21c))[_0x46af72(0x20b)](_0x46af72(0x225)),webcam[_0x46af72(0x213)]()[_0x46af72(0x219)](_0x315da8=>{const _0x3f5e3a=_0x46af72;cameraStarted(),console[_0x3f5e3a(0x1f0)](_0x3f5e3a(0x1ff));})[_0x46af72(0x1fe)](_0x5c0d67=>{displayError();})):(cameraStopped(),webcam[_0x46af72(0x1f1)](),console['log'](_0x46af72(0x220)));}),$(_0x1c83ea(0x1f5))[_0x1c83ea(0x205)](function(){const _0x2dc6b3=_0x1c83ea;webcam[_0x2dc6b3(0x21b)](),webcam[_0x2dc6b3(0x213)]();});function displayError(_0x23ded1=''){const _0x4a70ba=_0x1c83ea;_0x23ded1!=''&&$('#errorMsg')[_0x4a70ba(0x200)](_0x23ded1),$(_0x4a70ba(0x226))[_0x4a70ba(0x1f3)](_0x4a70ba(0x211));}function _0x286e(_0x52087e,_0x232631){const _0x4e9b0b=_0x4e9b();return _0x286e=function(_0x286e2a,_0x23e7b8){_0x286e2a=_0x286e2a-0x1ee;let _0x105091=_0x4e9b0b[_0x286e2a];return _0x105091;},_0x286e(_0x52087e,_0x232631);}function _0x4e9b(){const _0x28806b=['webcam','#exit-app','then','webcamList','flip','.md-modal','.take-photo','webcam-on','img=','webcam\x20stopped','#cameraControls','10165808tbMYQR','show','snapSound','md-show','#errorMsg','src','split','Berhasil!','1479527JreDGu','getElementById','318CPyAkR','hide','success','1042688aJdcMC','8002ILMQvS','#canvas','log','stop','./sw-proses?action=absent','removeClass','5WXdqjd','.cameraFlip','error','Oops!','9VxvDOy','POST','121dmABBf','.flash','stream','13742570rNmvYR','catch','webcam\x20started','html','scrollTo','&latitude=','prop','#webcam-switch','click','.resume-camera','6ArEnYM','1581324bKstjm','.webcam-container','webcam-off','addClass','snap','1462779LHfviG','#webcam-caption','ajax','checked','d-none','#webcam-control','start','change','animate','location.href\x20=\x20\x27./\x27;'];_0x4e9b=function(){return _0x28806b;};return _0x4e9b();}function cameraStarted(){const _0x14b1e4=_0x1c83ea;$(_0x14b1e4(0x226))[_0x14b1e4(0x20b)](_0x14b1e4(0x211)),$(_0x14b1e4(0x1fb))[_0x14b1e4(0x22d)](),$(_0x14b1e4(0x20e))[_0x14b1e4(0x200)]('on'),$(_0x14b1e4(0x212))[_0x14b1e4(0x1f3)](_0x14b1e4(0x20a)),$('#webcam-control')['addClass'](_0x14b1e4(0x21e)),$(_0x14b1e4(0x209))['removeClass'](_0x14b1e4(0x211)),webcam[_0x14b1e4(0x21a)]['length']>0x1&&$('.cameraFlip')['removeClass'](_0x14b1e4(0x211)),$('#wpfront-scroll-top-container')[_0x14b1e4(0x20b)]('d-none'),window[_0x14b1e4(0x201)](0x0,0x0);}$(_0x1c83ea(0x21d))[_0x1c83ea(0x205)](function(){const _0x5d84c7=_0x1c83ea;beforeTakePhoto();let _0x2d7575=webcam[_0x5d84c7(0x20c)]();afterTakePhoto();var _0x5eee94=new Image();_0x5eee94[_0x5d84c7(0x227)]=_0x2d7575;var _0x219d4d=_0x5d84c7(0x21f)+_0x5eee94[_0x5d84c7(0x227)]+_0x5d84c7(0x202)+latitude+'&radius='+jarak+'';$[_0x5d84c7(0x20f)]({'type':_0x5d84c7(0x1f9),'url':_0x5d84c7(0x1f2),'data':_0x219d4d,'success':function(_0x495f00){const _0x1fb3b5=_0x5d84c7;var _0x210a10=_0x495f00[_0x1fb3b5(0x228)]('/');$results=_0x210a10[0x0],$results2=_0x210a10[0x1],$results=='success'?(swal({'title':_0x1fb3b5(0x229),'text':$results2,'icon':_0x1fb3b5(0x22e),'timer':0x7d0}),setTimeout(_0x1fb3b5(0x216),0x7d0)):swal({'title':_0x1fb3b5(0x1f7),'text':_0x495f00,'icon':_0x1fb3b5(0x1f6),'timer':0x7d0});}});});function beforeTakePhoto(){const _0x107198=_0x1c83ea;$(_0x107198(0x1fb))[_0x107198(0x223)]()[_0x107198(0x215)]({'opacity':0.3},0x1f4)['fadeOut'](0x1f4)['css']({'opacity':0.7}),window[_0x107198(0x201)](0x0,0x0),$(_0x107198(0x212))[_0x107198(0x20b)](_0x107198(0x211)),$(_0x107198(0x21d))[_0x107198(0x20b)](_0x107198(0x211)),$(_0x107198(0x1f5))[_0x107198(0x20b)](_0x107198(0x211)),$(_0x107198(0x218))[_0x107198(0x1f3)](_0x107198(0x211)),$(_0x107198(0x206))[_0x107198(0x1f3)](_0x107198(0x211));}function afterTakePhoto(){const _0xa997c9=_0x1c83ea;webcam[_0xa997c9(0x1f1)](),$('#canvas')[_0xa997c9(0x1f3)]('d-none');}function removeCapture(){const _0x5950b8=_0x1c83ea;$(_0x5950b8(0x1ef))['addClass'](_0x5950b8(0x211)),$('#webcam-control')['removeClass']('d-none'),$(_0x5950b8(0x221))[_0x5950b8(0x1f3)](_0x5950b8(0x211)),$(_0x5950b8(0x21d))[_0x5950b8(0x1f3)](_0x5950b8(0x211)),$(_0x5950b8(0x218))[_0x5950b8(0x20b)]('d-none'),$('.resume-camera')[_0x5950b8(0x20b)]('d-none');}$(_0x1c83ea(0x206))[_0x1c83ea(0x205)](function(){const _0x18ad96=_0x1c83ea;webcam[_0x18ad96(0x1fc)]()['then'](_0x3b7488=>{removeCapture();});}),$(_0x1c83ea(0x218))[_0x1c83ea(0x205)](function(){const _0xaa9d96=_0x1c83ea;removeCapture(),$(_0xaa9d96(0x204))[_0xaa9d96(0x203)](_0xaa9d96(0x210),![])['change']();});});*/
        const webcamElement = document.getElementById('webcam');
            const canvasElement = document.getElementById('canvas');
            const snapSoundElement = document.getElementById('snapSound');
            const webcam = new Webcam(webcamElement, 'user', canvasElement, snapSoundElement);

            $('.md-modal').addClass('md-show');
            cameraStarted();
            webcam.start()
            .then(result =>{
                cameraStarted();
                console.log("webcam started");
            })
            .catch(err => {
                displayError();
            });
            console.log("webcam started");
            $("#webcam-switch").change(function () {
                if(this.checked){
                    $('.md-modal').addClass('md-show');
                    webcam.start()
                        .then(result =>{
                        cameraStarted();
                        console.log("webcam started");
                        })
                        .catch(err => {
                            displayError();
                        });
                }
                else {        
                    cameraStopped();
                    webcam.stop();
                    console.log("webcam stopped");
                }        
            });

                $('.cameraFlip').click(function() {
                    webcam.flip();
                    webcam.start();  
                });


                function displayError(err = ''){
                    if(err!=''){
                        $("#errorMsg").html(err);
                    }
                    $("#errorMsg").removeClass("d-none");
                }

                function cameraStarted(){
                    $('.flash').hide();
                    $("#webcam-caption").html("on");
                    $("#webcam-control").removeClass("webcam-off");
                    $("#webcam-control").addClass("webcam-on");
                    $(".webcam-container").removeClass("d-none");
                    if( webcam.webcamList.length > 1){
                        $(".cameraFlip").removeClass('d-none');
                    }
                    $("#wpfront-scroll-top-container").addClass("d-none");
                    window.scrollTo(0, 0); 
                    //$('body').css('overflow-y','hidden');
                }

                $(".take-photo").click(function () {
                    beforeTakePhoto();
                    let picture = webcam.snap(300,300);
                    afterTakePhoto();
                    var img = new Image();
                   // var image = wcm.capture(160, 120);
                    img.src = picture;
                    
                    var dataString = 'img='+img.src+'&latitude='+latitude+'&radius='+jarak+'';    
                    $.ajax({
                        type: "POST",
                        url: "./sw-proses?action=absent",
                        data: dataString,
                            success: function (data) {
                                var results = data.split("/");
                                $results = results[0];
                                $results2 = results[1];
                                if ($results=='success') {
                                    swal({title: 'Berhasil!', text:$results2, icon: 'success', timer: 2000,});
                                    setTimeout("location.href = './';",2000);
                                } else {
                                    swal({title: 'Oops!', text:data, icon: 'error'});
                                }
                            }
                    });
                });

                function beforeTakePhoto(){
                    $('.flash')
                    .show() 
                    .animate({opacity: 0.3}, 500) 
                    .fadeOut(500)
                    .css({'opacity': 0.7});
                    window.scrollTo(0, 0); 
                    $('#webcam-control').addClass('d-none');
                    $('.take-photo').addClass('d-none');
                    $('.cameraFlip').addClass('d-none');
                    $('#exit-app').removeClass('d-none');
                    $('.resume-camera').removeClass('d-none');
                }

                function afterTakePhoto(){
                    webcam.stop();
                    $('#canvas').removeClass('d-none');
                }

                function removeCapture(){
                    $('#canvas').addClass('d-none');
                    $('#webcam-control').removeClass('d-none');
                    $('#cameraControls').removeClass('d-none');
                    $('.take-photo').removeClass('d-none');
                    $('#exit-app').addClass('d-none');
                    $('.resume-camera').addClass('d-none');
                    $('.cameraFlip').removeClass('d-none');
                    
                }

                $(".resume-camera").click(function () {
                    webcam.stream()
                    .then(facingMode =>{
                        removeCapture();
                    });
                });

                $(".exit-app").click(function () {
                    removeCapture();
                    webcam.stop();
                    $('.form-hidden').show();
                    $('#webcam-app').hide();
                });
    });
</script>
<?php }?>
  <!-- </body></html> -->
  </body>
</html><?php }?>

