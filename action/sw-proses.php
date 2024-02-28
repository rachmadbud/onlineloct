<?php
    require_once'../sw-library/sw-config.php'; 
    require_once'../sw-library/sw-function.php';
    require_once'../sw-mod/out/sw-cookies.php';
    include('../sw-library/PHPMailer/PHPMailerAutoload.php');

    $ip_login  = $_SERVER['REMOTE_ADDR'];
    $time_login = date('Y-m-d H:i:s');
    $iB = getBrowser();
    $browser = $iB['name'].'-'.$iB['version'];
    $allowed_ext = array("png", "jpg", "jpeg");
    //$created_cookies = rand(19999,9999).rand(888888,111111).date('ymdhisss');
    $salt = '$%DEf0&TTd#%dSuTyr47542"_-^@#&*!=QxR094{a911}+';
    $expired_cookie = time()+60*60*24*7;
    $max_size = 3000000; //2MB
    function resizeImage($resourceType,$image_width,$image_height){
      $resizeWidth =350;
      $resizeHeight = ($image_height/$image_width)*$resizeWidth;
      $imageLayer = imagecreatetruecolor($resizeWidth,$resizeHeight);
      imagecopyresampled($imageLayer,$resourceType,0,0,0,0,$resizeWidth,$resizeHeight, $image_width,$image_height);
      return $imageLayer;
    }

switch (@$_GET['action']){
case 'login':
  $error = array();
  if (empty($_POST['email'])) { 
        $error[] = 'Email tidak boleh kosong';
    } else { 
      $email = htmlentities(htmlspecialchars($_POST['email']));
      $created_cookies =  md5($email);
  }

  if (empty($_POST['password'])) { 
        $error[] = 'Password tidak boleh kosong';
    } else {
      $password = htmlentities(hash('sha256',$salt.$_POST['password']));

  }

if (empty($error)){
    $update_user = mysqli_query($connection,"UPDATE employees SET created_login='$time_login',  created_cookies='$created_cookies' WHERE employees_password='$password'");

    $query_login ="SELECT id,employees_email,employees_name,created_cookies FROM employees WHERE employees_email='$email' AND employees_password='$password'";
    $result_login       = $connection->query($query_login);


  if($result_login->num_rows > 0){
    $row                = $result_login->fetch_assoc();

    $COOKIES_MEMBER         =  epm_encode($row['id']);
    $COOKIES_COOKIES        =  $row['created_cookies'];
      setcookie('COOKIES_MEMBER', $COOKIES_MEMBER, $expired_cookie, '/');
      setcookie('COOKIES_COOKIES', $COOKIES_COOKIES, $expired_cookie, '/');
      echo'success';
  }
  else {
    echo'Email dan password yang Anda masukkan salah!';
    }
  }

  else{       
  	echo'Bidang inputan tidak boleh ada yang kosong!';
  }



/* ------------- REGISTRASI ---------------*/
break;
case 'registrasi':

$error = array();
  if (empty($_POST['employees_code'])) {
      $error[] = 'NIP tidak boleh kosong';
    } else {
      $employees_code= anti_injection($_POST['employees_code']);
  }

  if (empty($_POST['employees_name'])) {
      $error[] = 'Nama tidak boleh kosong';
    } else {
      $employees_name= anti_injection($_POST['employees_name']);
  }

  if (empty($_POST['employees_email'])) {
      $error[] = 'Email tidak boleh kosong';
    } else {
      $employees_email= anti_injection($_POST['employees_email']);
      $created_cookies = md5($employees_email);
  }


  if (empty($_POST['employees_password'])) {
      $error[] = 'Password tidak boleh kosong';
    } else {
      $employees_password= mysqli_real_escape_string($connection,hash('sha256',$salt.$_POST['employees_password']));
      $password_send = mysqli_real_escape_string($connection,$_POST['employees_password']);
  }


  if (empty($_POST['position_id'])) {
      $error[] = 'Posisi/Jabatan tidak boleh kosong';
    } else {
      $position_id = anti_injection($_POST['position_id']);
  }


  if (empty($_POST['building_id'])) {
      $error[] = 'Lokasi tidak boleh kosong';
    } else {
      $building_id = anti_injection($_POST['building_id']);
  }

  if (empty($error)) {
if (filter_var($employees_email, FILTER_VALIDATE_EMAIL)) {
  $query="SELECT employees_email from employees where employees_email='$employees_email'";
  $result= $connection->query($query) or die($connection->error.__LINE__);
  if(!$result ->num_rows >0){

    // Konfigurasi SMTP
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->Host = $gmail_host;
        $mail->Username = $gmail_username; // Email Pengirim
        $mail->Password = $gmail_password; // Isikan dengan Password email pengirim
        $mail->Port = $gmail_port;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'ssl';
        //$mail->SMTPDebug = 2; // Aktifkan untuk melakukan debugging

        $mail->setFrom($gmail_username, $site_name);  //Email Pengirim
        $mail->addAddress($employees_email, $employees_name); // Email Penerima

        $mail->isHTML(true); // Aktifkan jika isi emailnya berupa html
       // Subjek email
        $mail->Subject = 'Registrasi| '.$site_name.'';

        $mailContent = '<h1>'.$site_name.'</h1><br>
        <h3>Hallo, '.$employees_name.'</h3><br>
        <p>Pendaftaran Akun di '.$site_name.' berhasil dengan detail akun sebagai berikut:</p><br>
        <p>Email : '.$employees_email.' <br>
        Password : '.$password_send.'<br>
        IP : '.$ip.'<br>
        Browser : '.$browser.'</p>
        <br><br>
        <p>
        Hormat Kami,<br>'.$site_name.'<br>Email otomatis, Mohon tidak membalas email ini</p>';
        
        $mail->Body = $mailContent;

    $add ="INSERT INTO employees (employees_code,
              employees_email,
              employees_password,
              employees_name,
              position_id,
              shift_id,
              building_id,
              photo,
              created_login,
              created_cookies) values('$employees_code',
              '$employees_email',
              '$employees_password',
              '$employees_name',
              '$position_id',
              '0',
              '$building_id',
              '',
              '$date',
              '$created_cookies')";
    if($connection->query($add) === false) { 
        die($connection->error.__LINE__); 
        echo'Data tidak berhasil disimpan!';
    } else{
        echo'success';
    }
    }else{
        echo'Sepertinya Email "'.$employees_email.'" sudah terdaftar!';
      }
    }else {
      echo'Email yang anda masukkan salah!';
    }
  }else{           
      foreach ($error as $key => $values) {            
      echo"$values\n";
    }
  }


/* ------------- FORGOT ---------------*/
break;
case 'forgot':

  $pass="1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ";
  $panjang_pass='8';$len=strlen($pass); 
  $start=$len-$panjang; $xx=rand('0',$start); 
  $yy=str_shuffle($pass);

$error = array();

  if (empty($_POST['employees_email'])) {
      $error[] = 'Email tidak boleh kosong';
    } else {
      $employees_email= mysqli_real_escape_string($connection, $_POST['employees_email']);
  }


  $passwordbaru = substr($yy, $xx, $panjang_pass);
  $employees_password = mysqli_real_escape_string($connection,hash('sha256',$salt.$passwordbaru));

  if (empty($error)) {
   

if (filter_var($employees_email, FILTER_VALIDATE_EMAIL)) {
  $query="SELECT id,employees_email,employees_name from employees where employees_email='$employees_email'";
  $result= $connection->query($query) or die($connection->error.__LINE__);
  if($result ->num_rows >0){
    $row = $result->fetch_assoc();

    // Konfigurasi SMTP
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->Host = $gmail_host;
        $mail->Username = $gmail_username; // Email Pengirim
        $mail->Password = $gmail_password; // Isikan dengan Password email pengirim
        $mail->Port = $gmail_port;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'ssl';
        //$mail->SMTPDebug = 2; // Aktifkan untuk melakukan debugging

        $mail->setFrom($gmail_username, $site_name);  //Email Pengirim
        $mail->addAddress($row['employees_email'], $row['employees_name']); // Email Penerima

        $mail->isHTML(true); // Aktifkan jika isi emailnya berupa html
       // Subjek email
        $mail->Subject = 'Resset password Baru | '.$site_name.'';

        $mailContent = '<h1>'.$site_name.'</h1><br>
            <h3>Halo, '.$row['employees_name'].'</h3><br>
            <p>Kamu baru saja mengirim permintaan reset password akun '.$site_name.'.<br>
            <b>Password Baru Anda : '.$passwordbaru.'</b><br><br><br>Harap simpan baik-baik akun Anda.<br><br>
            Hormat Kami,<br>'.$site_name.'<br>Email otomatis, Mohon tidak membalas email ini</p>';
        
        $mail->Body = $mailContent;

    $update ="UPDATE employees SET employees_password='$employees_password' WHERE id='$row[id]'";
    if($connection->query($update) === false) { 
        die($connection->error.__LINE__); 
        echo'Penyetelan password baru gagal, silahkan nanti coba kembali!';
    } else{
        echo'success';
                if($mail->send()){
                  //echo 'Pesan telah terkirim';
                }else{
                  echo 'Mailer Error: ' . $mail->ErrorInfo;
                }
    }}
    else   {
       echo'Untuk Email "'.$employees_email.'" belum terdaftar, silahkan cek kembali!';
    }}

    else {
     echo'Email yang Anda masukkan salah!';
    }}

    else{           
       foreach ($error as $key => $values) {            
        echo"$values\n";
      }
    }



// ------------- Absen -------------*/
break;
case 'absent':

$error = array();
if (empty($_POST['latitude'])) {
      $error[] = 'Silahkan Izinkan Lokasi Anda saat ini!';
    } else {
      $latitude= strip_tags($_POST['latitude']);
}

if (empty($_POST['radius'])) {
      $error[] = 'Jarak Lokasi tidak ditemukan!';
    } else {
      $radius = strip_tags($_POST['radius']);
}

if (empty($_POST['img'])){
  $error[]    = 'Foto belum di unggah.!';
} else {
    $img = $_POST['img'];
    $img = str_replace('data:image/jpeg;base64,', '', $img);
    $img = str_replace(' ', '+', $img);
    $fetch_imgParts = explode(";base64,", $img);
    $image_type_aux = explode("image/", $fetch_imgParts[0]);
    $image_type = $image_type_aux[1];
    $image_base64 = base64_decode($fetch_imgParts[1]);

    $im = imagecreatefromstring($image_base64);
    $source_width = imagesx($im);
    $source_height = imagesy($im);
    $ratio =  $source_height / $source_width;

    $new_width = 250; // assign new width to new resized image
    $new_height = $ratio * 250;
    	
}

/*$watermark = ''.$time.' - '.tanggal_ind($date).'';
$foto   = 'absen-outttt-'.time().'.jpg';
$filename = '../sw-content/absent/'.$foto.''; // output file name
addTextWatermark($im, $watermark, $filename);*/

if (empty($error)){
    $watermark = ''.$time.' - '.tanggal_ind($date).'';
    
    // Cek User yang sudah login -----------------------------------------------
    $query_pegawai="SELECT employees.id,employees.employees_name,building.radius FROM employees
    INNER JOIN building ON employees.building_id=building.building_id AND employees.id='$row_user[id]'";
    $result_pegawai = $connection->query($query_pegawai);
    if($result_pegawai->num_rows > 0){
      $data_pegawai = $result_pegawai->fetch_assoc();

      $query_shift ="SELECT * FROM shift WHERE shift_name='$hari_ini' AND active='Y'";
      $result_shift = $connection->query($query_shift);
      if($result_shift->num_rows > 0) {
        $data_shift = $result_shift->fetch_assoc();
        $time_out     = strtotime(''.$data_shift['time_out'].' - 60 minute');
        $time_out     = date('H:i:s', $time_out);

        if($data_shift['time_in'] > $time){
          $status_in ='Tepat Waktu';
        }else{
          $status_in ='Telat';
        }

        if($data_shift['time_out'] > $time){
          $status_out ='Pulang Cepat';
        }else{
          $status_out ='';
        }

      /* Cek Radius Absensi */
        if($data_pegawai['radius'] > $radius){
        // Cek data Absen Berdasarkan tanggal sekarang
          $query  ="SELECT employees_id,time_in,time_out FROM presence WHERE employees_id='$row_user[id]' AND presence_date='$date'";
            $result = $connection->query($query);
              if($result->num_rows > 0){
                $row = $result->fetch_assoc();

              // Update Absensi Pulang
              if($time_out < $time){
                  if($row['time_out']=='00:00:00'){
                //Update Jam Pulang
                      /* -------- Upload Foto pulang -------*/
                      $foto   = 'absen-out-'.$row_user['id'].'-'.time().'.jpg';
                      $filename = '../sw-content/absent/'.$foto.''; // output file name
                      /* -------- Upload Foto pulang -------*/
                        $update ="UPDATE presence SET time_out='$time',
                        picture_out='$foto',
                        latitude_longtitude_out='$latitude',
                        status_out='$status_out' WHERE employees_id='$row_user[id]' AND presence_date='$date'";

                        if($connection->query($update) === false) { 
                            die($connection->error.__LINE__); 
                            echo'Sepetinya sitem kami sedang error!';
                        } else{
                            //Jam Pulang
                            echo'success/Selamat "'.$row_user['employees_name'].'" berhasil Absen Pulang pada Tanggal '.tanggal_ind($date).' dan Jam : '.$time.', Hati-hati dijalan saat pulang "'.$row_u['employees_name'].'"!';
                            addTextWatermark($im, $watermark, $filename);	
                              
                        }
                    }
                    else{
                      echo'Sebelumnya "'.$row_user['employees_name'].'" sudah pernah Absen Pulang pada Tanggal '.tanggal_ind($date).' dan Jam '.$row['time_out'].'.!';
                    }
                  }else{
                  echo'Absen pulang belum diperbolehkan "'.$row_user['employees_name'].'", Absen pulang aktif 60 menit sebelum jam pulang.!';
                }


        // Else Absen Mmasuk
        }else{
                /* -------- Upload Foto Masuk -------*/
                $foto   = 'absen-in-'.$row_user['id'].'-'.time().'.jpg';
                $filename = '../sw-content/absent/'.$foto.''; // output file name

                /* -------- Upload Foto Masuk -------*/
                $add ="INSERT INTO presence (employees_id,
                      presence_date,
                      shift_id,
                      jam_masuk,
                      jam_pulang,
                      time_in,
                      time_out,
                      picture_in,
                      picture_out,
                      kehadiran,
                      latitude_longtitude_in,
                      latitude_longtitude_out,
                      status_in,
                      status_out,
                      information) values('$row_user[id]',
                      '$date',
                      '$data_shift[shift_id]',
                      '$data_shift[time_in]',
                      '$data_shift[time_out]',
                      '$time',
                      '00:00:00',
                      '$foto',
                      '', /*picture out kosong*/
                      'Hadir', /*hadir*/
                      '$latitude',
                      '',
                      '$status_in',
                      '', /* Status Out */
                      '')";
                    
            if($connection->query($add) === false) { 
                die($connection->error.__LINE__); 
                echo'Sepertinya Sistem Kami sedang error!';
            } else{
                echo'success/Selamat Anda berhasil Absen Masuk pada Tanggal '.tanggal_ind($date).' dan Jam : '.$time.', Semangat bekerja "'.$row_user['employees_name'].'" !';
                addTextWatermark($im, $watermark, $filename);	
                
            }
          }
      }else{
        echo'Posisi Anda saat ini di radius '.$radius.'M, tidak ditempat atau Jauh dari Radius..!';
      }

      }else{
        echo'Jam kerja tidak ditemukan, Silahkan hub Admin!';
      }
    
    }else{
        // Jika user tidak ditemukan
        echo'Pegawai tidak ditemukan!';
      }
    }else{
      foreach ($error as $key => $values) {            
        echo"$values\n";
      }
}		

// ----------- UPDATE PROFILE -------------------//
break;
case 'profile':
  $error = array();
  if (empty($_POST['employees_code'])) {
      $error[] = 'NIP tidak boleh kosong';
    } else {
      $employees_code= mysqli_real_escape_string($connection, $_POST['employees_code']);
  }

  if (empty($_POST['employees_name'])) {
      $error[] = 'Nama tidak boleh kosong';
    } else {
      $employees_name= mysqli_real_escape_string($connection, $_POST['employees_name']);
  }

  if (empty($_POST['position_id'])) {
      $error[] = 'Posisi tidak boleh kosong';
    } else {
      $position_id = mysqli_real_escape_string($connection, $_POST['position_id']);
  }


  if (empty($_POST['building_id'])) {
      $error[] = 'Lokasi tidak boleh kosong';
    } else {
      $building_id = mysqli_real_escape_string($connection, $_POST['building_id']);
  }


  if (empty($error)) { 
    $update="UPDATE employees SET employees_code='$employees_code',
            employees_name='$employees_name',
            position_id='$position_id',
            building_id='$building_id' WHERE id='$row_user[id]'"; 
    if($connection->query($update) === false) { 
        die($connection->error.__LINE__); 
        echo'Data tidak berhasil disimpan!';
    } else{
        echo'success';
    }}
    else{           
       foreach ($error as $key => $values) {            
        echo"$values\n";
      }
  }
break;


// ----------- UPDATE PASSWORD -------------------//
case 'update-password':
 $error = array();
  if (empty($_POST['employees_email'])) {
      $error[] = 'tidak boleh kosong';
    } else {
      $employees_email= mysqli_real_escape_string($connection,$_POST['employees_email']);
  }

  if (empty($_POST['employees_password'])) {
      $error[] = 'tidak boleh kosong';
    } else {
      $employees_password= mysqli_real_escape_string($connection,$_POST['employees_password']);
      $password_baru =mysqli_real_escape_string($connection,hash('sha256',$salt.$employees_password));
  }

  if (empty($error)) { 
    $update="UPDATE employees SET employees_password='$password_baru' WHERE id='$row_user[id]'"; 
    if($connection->query($update) === false) { 
        die($connection->error.__LINE__); 
        echo'Data tidak berhasil disimpan!';
    } else{
        echo'success';
    }}
    else{           
        foreach ($error as $key => $values) {            
          echo"$values\n";
        }
    }
break;

/* -------- UPDATE PHOTO ----------------*/
case 'update-photo':
  $file_name   = $_FILES['file'] ['name'];
  $size        = $_FILES['file'] ['size'];
  $error       = $_FILES['file'] ['error'];
  $tmpName     = $_FILES['file']['tmp_name'];
  $filepath      = '../sw-content/karyawan/';
  $valid       = array('jpg','gif','jpeg'); 
  if(strlen($file_name)){   
       // Perintah untuk mengecek format gambar
        $extension = getExtension($file_name);
        $extension = strtolower($extension);
      if(in_array($extension,$valid)){ 
         if($size < 5000000){   
           // Perintah pengganti nama files
           $photo_new   =''.$row_user['id'].'-'.strip_tags(md5($file_name)).'-'.seo_title($time).'.'.$extension.'';
           $pathFile    = $filepath.$photo_new;

            $query = "SELECT photo FROM employees WHERE id='$row_user[id]'"; 
                $result = $connection->query($query);
                $rows= $result->fetch_assoc();
                $photo = $rows['photo'];
                if(file_exists("../sw-content/$photo")){
                  unlink( "../sw-content/karyawan/$photo");
                 }
           $update ="UPDATE employees SET photo='$photo_new' WHERE id=$row_user[id]";
            if($connection->query($update) === false) { 
               echo'Pengaturan tidak dapat disimpan, coba ulangi beberapa saat lagi.!';
               die($connection->error.__LINE__); 
            } else   {
              echo'success';
               move_uploaded_file($tmpName, $pathFile);
            }
          }
         else{ // Jika Gambar melebihi size 
              echo'File terlalu besar maksimal files 5MB.!';  
           }         
       }
       else{
          echo 'File yang di unggah tidak sesuai dengan format, File harus jpg, jpeg, gif, png.!';
        }
     }   



/* -------  LOAD DATA HISTORY ----------*/
break;
case 'history':
  if(isset($_POST['from']) OR isset($_POST['to'])){
      $from = date('Y-m-d', strtotime($_POST['from']));
      $to   = date('Y-m-d', strtotime($_POST['to']));
      $filter ="presence_date BETWEEN '$from' AND '$to'";
  }else{
      $filter ="MONTH(presence_date) ='$month'";
  }

echo'<table class="table rounded" id="swdatatable">
    <thead>
        <tr>
            <th scope="col" class="align-middle text-center" width="10">No</th>
            <th scope="col" class="align-middle">Tanggal</th>
            <th scope="col" class="align-middle">Absen Masuk</th>
            <th scope="col" class="align-middle">Absen Pulang</th>
            <th scope="col" class="align-middle hidden-sm">Status</th>
            <th scope="col" class="align-middle">Aksi</th>
        </tr>
    </thead>
    <tbody>';
    $no = 0;
    $query_absen ="SELECT presence_id,presence_date,shift_id,jam_masuk,jam_pulang,time_in,time_out,picture_in,picture_out,kehadiran,status_in,status_out,information FROM presence WHERE employees_id='$row_user[id]' AND $filter ORDER BY presence_id DESC";
    $result_absen = $connection->query($query_absen);
    if($result_absen->num_rows > 0){
        while ($row_absen = $result_absen->fetch_assoc()) {$no++;
          if($row_absen['status_in']=='Telat'){
            $status=' <span class="badge badge-danger">'.$row_absen['status_in'].'</span>';
          }
          elseif ($row_absen['status_in']='Tepat Waktu') {
            $status='<span class="badge badge-success">'.$row_absen['status_in'].'</span>';
          }
          else{
            $status='<span class="badge badge-danger">'.$row_absen['status_in'].'</span>';
          }
  
          
          if($row_absen['time_out']=='00:00:00'){
            $status_pulang='Belum Absen';
          }else{
            if($row_absen['status_out']=='Pulang Cepat'){
              $status_pulang='<span class="badge badge-danger">'.$row_absen['status_pulang'].'</span>';
            }
            else{
              $status_pulang='';
            }
          }
  
          echo'
          <tr>
              <td class="text-center">'.$no.'</td>
              <td scope="row">'.tgl_ind($row_absen['presence_date']).'<br>'.$row_absen['jam_masuk'].' - '.$row_absen['jam_pulang'].'</td>
              
              <td>';
              if($row_absen['kehadiran']=='Hadir'){
                echo'
                <a class="image-link" href="./sw-content/absent/'.$row_absen['picture_in'].'">
                <span class="badge badge-success">'.$row_absen['time_in'].'</span></a>'.$status.'';
              }else{
                echo'<span class="badge badge-info">'.$row_absen['kehadiran'].'<span>';
                }
          echo'</td>
  
              <td>';
              if($row_absen['kehadiran']=='Hadir'){
                echo'
              <a class="image-link" href="./sw-content/absent/'.$row_absen['picture_out'].'">
              <span class="badge badge-success">'.$row_absen['time_out'].'</span></a> '.$status_pulang.'';
              }else{
                echo'<span class="badge badge-info">'.$row_absen['kehadiran'].'<span>';
              }
              echo'</td>
  
              <td class="hidden-sm">'.$row_absen['kehadiran'].'</td>
              <td class="text-center">
                <button type="button" class="btn btn-success btn-sm modal-update" data-id="'.$row_absen['presence_id'].'" data-masuk="'.$row_absen['time_in'].'" data-pulang="'.$row_absen['time_out'].'" data-date="'.tgl_indo($row_absen['presence_date']).'" data-information="'.$row_absen['information'].'" data-toggle="modal" data-target="#modal-show"><i class="fas fa-pencil-alt"></i></button>
              </td>
          </tr>';
    }}
    echo'
    </tbody>
</table>
<hr>';
      $query_hadir="SELECT presence_id FROM presence WHERE employees_id='$row_user[id]' AND $filter AND kehadiran='Hadir'";
      $hadir= $connection->query($query_hadir);

      $query_sakit="SELECT presence_id FROM presence WHERE employees_id='$row_user[id]' AND $filter AND kehadiran='Sakit' ORDER BY presence_id";
      $sakit = $connection->query($query_sakit);

      $query_izin="SELECT presence_id FROM presence WHERE employees_id='$row_user[id]' AND $filter AND kehadiran='Izin' ORDER BY presence_id";
      $izin = $connection->query($query_izin);

      $query_telat ="SELECT presence_id FROM presence WHERE employees_id='$row_user[id]' AND $filter AND status_in='Telat'";
      $telat = $connection->query($query_telat);
echo'
<div class="container">
<div class="row">
  <div class="col-md-3">
    <p>Hadir : <span class="badge badge-success">'.$hadir->num_rows.'</span></p>
  </div>

  <div class="col-md-3">
    <p>Terlambat : <span class="label badge badge-danger">'.$telat->num_rows.'</span></p>
  </div>
  

  <div class="col-md-3">
    <p>Sakit : <span class="badge badge-warning">'.$sakit->num_rows.'</span></p>
  </div>

  <div class="col-md-3">
    <p>Izin : <span class="badge badge-info">'.$izin->num_rows.'</span></p>
  </div>
</div>
</div>';?>

<script>
  $('#swdatatable').dataTable({
    "iDisplayLength":35,
    "aLengthMenu": [[35, 40, 50, -1], [35, 40, 50, "All"]]
  });
  $('.image-link').magnificPopup({type:'image'});
</script>
<?php


// ----------- UPDATE HISTORY -------------------//
break;
case 'update-history':
  $error = array();
  if (empty($_POST['presence_id'])) {
      $error[] = 'tidak boleh kosong';
    } else {
      $presence_id = mysqli_real_escape_string($connection, $_POST['presence_id']);
  }

  if (empty($_POST['kehadiran'])) {
      $error[] = 'tidak boleh kosong';
    } else {
      $kehadiran= mysqli_real_escape_string($connection, $_POST['kehadiran']);
  }

  $information = mysqli_real_escape_string($connection, $_POST['information']);
 
  if (empty($error)) { 
    $update="UPDATE presence SET kehadiran='$kehadiran',
                    information='$information'
                    WHERE presence_id='$presence_id' AND employees_id='$row_user[id]'"; 
    if($connection->query($update) === false) { 
        die($connection->error.__LINE__); 
        echo'Data tidak berhasil disimpan!';
    } else{
        echo'success';
    }}
    else{           
        echo'Bidang inputan tidak boleh ada yang kosong..!';
  }

// ----------- UPDATE HISTORY -------------------//
break;
case 'cuty':
if(isset($_POST['from']) OR isset($_POST['to'])){
      $from = date('Y-m-d', strtotime($_POST['from']));
      $to   = date('Y-m-d', strtotime($_POST['to']));

      $filter ="cuty_start BETWEEN '$from' AND '$to'";
  } 
  else{
      $filter ="MONTH(cuty_start) ='$month'";
}

$query_cuty ="SELECT employees.employees_name,cuty.* FROM employees,cuty WHERE employees.id=cuty.employees_id  AND $filter  AND cuty.employees_id='$row_user[id]' ORDER BY cuty.cuty_id DESC";
    $result_cuty = $connection->query($query_cuty);
    if($result_cuty->num_rows > 0){
      while ($row_cuty = $result_cuty->fetch_assoc()) {
        if($row_cuty['cuty_status']=='1'){
          $status = '<span class="badge badge-success">Disetujui</span>';
        }elseif($row_cuty['cuty_status']=='2'){
          $status = '<span class="badge badge-danger">Tidak disetujui</span>';
        }else{
          $status = '<span class="badge badge-secondary">Menunggu</span>';
        }
      echo'
      <div class="item">
          <div class="detail">
              <div>
                  <strong>'.$row_cuty['employees_name'].' '.$status.'</strong>
                  <p><ion-icon name="calendar-outline"></ion-icon> '.tanggal_ind($row_cuty['cuty_start']).' - '.tanggal_ind($row_cuty['cuty_end']).'<br><ion-icon name="calendar-outline"></ion-icon> Mulai kerja: '.tanggal_ind($row_cuty['date_work']).'<br>
                    <ion-icon name="chatbubble-outline"></ion-icon> '.$row_cuty['cuty_description'].'</p>
              </div>
          </div>
          <div class="right">';
            if($row_cuty['cuty_status']=='3'){
              echo'
             <button type="button" class="btn btn-success btn-sm btn-update-cuty" data-id="'.$row_cuty['cuty_id'].'" data-start="'.tanggal_ind($row_cuty['cuty_start']).'" data-end="'.tanggal_ind($row_cuty['cuty_end']).'" data-work="'.tanggal_ind($row_cuty['date_work']).'" data-total="'.$row_cuty['cuty_total'].'" data-description="'.$row_cuty['cuty_description'].'"><i class="fas fa-pencil-alt" aria-hidden="true"></i></button>';
           }
             else{
              echo'<button type="button" class="btn btn-success btn-sm access-failed"><i class="fas fa-pencil-alt" aria-hidden="true"></i></button>';
             }
            echo'
          </div>
      </div>';
      }
    }else{
      echo'';
    }


// -------------- ADD CUTY ----------------------//
break;
case 'add-cuty':
$error = array();

  if (empty($_POST['cuty_start'])) {
      $error[] = 'tidak boleh kosong';
    } else {
      $cuty_start= date('Y-m-d',strtotime($_POST['cuty_start']));
  }

  if (empty($_POST['cuty_end'])) {
      $error[] = 'tidak boleh kosong';
    } else {
      $cuty_end= date('Y-m-d',strtotime($_POST['cuty_end']));
  }

  if (empty($_POST['date_work'])) {
      $error[] = 'tidak boleh kosong';
    } else {
      $date_work= date('Y-m-d',strtotime($_POST['date_work']));
  }

  if (empty($_POST['cuty_total'])) {
      $error[] = 'tidak boleh kosong';
    } else {
      $cuty_total = anti_injection($_POST['cuty_total']);
  }

  if (empty($_POST['cuty_description'])) {
      $error[] = 'tidak boleh kosong';
    } else {
      $cuty_description  = anti_injection($_POST['cuty_description']);
  }


if (empty($error)) {
  $query="SELECT cuty_id from cuty where MONTH(cuty_start) ='$month' AND employees_id='$row_user[id]'";
  $result= $connection->query($query) or die($connection->error.__LINE__);
  if(!$result ->num_rows >0){
    $add ="INSERT INTO cuty (employees_id,
              cuty_start,
              cuty_end,
              date_work,
              cuty_total,
              cuty_description,
              cuty_status) values('$row_user[id]',
              '$cuty_start',
              '$cuty_end',
              '$date_work',
              '$cuty_total',
              '$cuty_description',
              '3')";
    if($connection->query($add) === false) { 
        die($connection->error.__LINE__); 
        echo'Data tidak berhasil disimpan!';
    } else{
        echo'success';
    }}
    else   {
      echo'Sepertinya "'.$row_user['employees_name'].'" sudah mengajukan cuti di BULAN ini!';
    }}

    else{           
        echo'Bidang inputan masih ada yang kosong..!';
    }


// -------------- UPDATE CUTY ----------------------//
break;
case 'update-cuty':
$error = array();
  if (empty($_POST['cuty_id'])) {
      $error[] = 'tidak boleh kosong';
    } else {
      $cuty_id = anti_injection($_POST['cuty_id']);
  }

  if (empty($_POST['cuty_start'])) {
      $error[] = 'tidak boleh kosong';
    } else {
      $cuty_start= date('Y-m-d',strtotime($_POST['cuty_start']));
  }

  if (empty($_POST['cuty_end'])) {
      $error[] = 'tidak boleh kosong';
    } else {
      $cuty_end= date('Y-m-d',strtotime($_POST['cuty_end']));
  }

  if (empty($_POST['date_work'])) {
      $error[] = 'tidak boleh kosong';
    } else {
      $date_work= date('Y-m-d',strtotime($_POST['date_work']));
  }

  if (empty($_POST['cuty_total'])) {
      $error[] = 'tidak boleh kosong';
    } else {
      $cuty_total = anti_injection($_POST['cuty_total']);
  }

  if (empty($_POST['cuty_description'])) {
      $error[] = 'tidak boleh kosong';
    } else {
      $cuty_description  = anti_injection($_POST['cuty_description']);
  }


if (empty($error)) {
    $update="UPDATE cuty SET cuty_start='$cuty_start',
            cuty_end='$cuty_end',
            date_work='$date_work',
            cuty_total='$cuty_total',
            cuty_description='$cuty_description' WHERE cuty_id='$cuty_id'"; 
    if($connection->query($update) === false) { 
        die($connection->error.__LINE__); 
        echo'Data tidak berhasil disimpan!';
    } else{
        echo'success';
    }}
    else{           
        echo'Bidang inputan masih ada yang kosong..!';
    }





// -------------- IZIN --------------------------//
break;
case 'izin':
    if(isset($_POST['from']) OR isset($_POST['to'])){
          $from = date('Y-m-d', strtotime($_POST['from']));
          $to   = date('Y-m-d', strtotime($_POST['to']));

          $filter ="date BETWEEN '$from' AND '$to' AND permission_date BETWEEN '$from' AND '$to'";
      } 
      else{
          $filter ="MONTH(date) ='$month'";
    }
    $query_permission="SELECT * FROM permission WHERE $filter AND employees_id='$row_user[id]' ORDER BY permission.permission_id DESC";
    $result_permission = $connection->query($query_permission);
    if($result_permission->num_rows > 0){
      while ($row_permission = $result_permission->fetch_assoc()){
        if($row_permission['status']=='1'){
          $status = '<span class="badge badge-success">Disetujui</span>';
        }elseif($row_permission['status']=='2'){
          $status = '<span class="badge badge-danger">Tidak disetujui</span>';
        }else{
          $status = '<span class="badge badge-secondary">Menunggu</span>';
        }
      echo'
      <div class="item">
          <div class="detail">
              <div>
                  <span class="badge badge-success">'.$row_permission['permission_name'].'  - '.tanggal_ind($row_permission['date']).'</span>
                  <a href="./sw-content/izin/'.$row_permission['files'].'" target="_blank"><span class="badge badge-info">Berkas</span></a> '.$status.'
                  <p class="mt-1">
                    <ion-icon name="calendar-outline"></ion-icon> Mulai : '.tanggal_ind($row_permission['permission_date']).'<br>
                    <ion-icon name="calendar-outline"></ion-icon> Selesai : '.tanggal_ind($row_permission['permission_date_finish']).'<br>
                    <ion-icon name="chatbubble-outline"></ion-icon> Status : '.$row_permission['type'].'<br>
                    <ion-icon name="chatbubble-outline"></ion-icon> '.strip_tags($row_permission['permission_description']).'</p>
              </div>
          </div>
          <div class="right">
             <button type="button" class="btn btn-danger btn-sm delete-izin" data-id="'.epm_encode($row_permission['permission_id']).'"><ion-icon name="trash-outline"></ion-icon></button>';
            echo'
          </div>
      </div>';?>
      <script type="text/javascript">
        //$('.image-link').magnificPopup({type:'image'});
      </script>
    <?PHP
      }
    }else{
      echo'';
    }


// -------------- ADD IZIN ----------------------//
break;
case 'add-izin':
  $max_size = 10000000; // 8MB
  $allowed_ext  = array('jpg', 'jpeg', 'doc', 'docx', 'docm', 'pdf');
  $error = array();
  if (empty($_POST['permission_name'])) {
      $error[] = 'Nama tidak boleh kosong';
    } else {
      $permission_name = anti_injection($_POST['permission_name']);
  }

  if (empty($_POST['permission_date'])) {
      $error[] = 'Tanggal Mulai Sakit tidak boleh kosong';
    } else {
       $permission_date = date('Y-m-d',strtotime($_POST['permission_date']));
  }

  if (empty($_POST['permission_date_finish'])) {
      $error[] = 'Tanggal Selesai Sakit tidak boleh kosong';
    } else {
       $permission_date_finish = date('Y-m-d',strtotime($_POST['permission_date_finish']));
  }


  if (empty($_POST['permission_description'])) {
        $error[] = 'Keterangan tidak boleh kosong';
    } else {
      $permission_description = anti_injection($_POST['permission_description']);
  }

  if (empty($_POST['type'])) {
        $error[] = 'Tipe tidak boleh kosong';
    } else {
        $type = anti_injection($_POST['type']);
  }

if (empty($error)) {
  $query="SELECT files from permission WHERE permission_date BETWEEN '$permission_date' AND '$permission_date_finish' AND employees_id='$row_user[id]'";
  $result= $connection->query($query);
    if(!$result->num_rows > 0){
        
        $file_name    = $_FILES['files']['name'];
        $file_ext     = pathinfo($_FILES['files']['name'], PATHINFO_EXTENSION);
        $file_size    = $_FILES['files']['size'];
        $file_tmp     = $_FILES['files']['tmp_name'];
       
          // Upload Files
          if(in_array($file_ext, $allowed_ext) === true){
              if ($file_size <= $max_size) {
              $files =''.$date.'-'.$row_user['id'].'-'.seo_title($file_name).'.'.$file_ext.'';
              $lokasi = '../sw-content/izin/'.$files.'';
                $add ="INSERT INTO permission (employees_id,
                          permission_name,
                          permission_date,
                          permission_date_finish,
                          permission_description,
                          files,
                          type,
                          date,
                          status) values('$row_user[id]',
                          '$permission_name',
                          '$permission_date',
                          '$permission_date_finish',
                          '$permission_description',
                          '$files',
                          '$type',
                          '$date',
                          '3')";

          if($connection->query($add) === false) { 
              die($connection->error.__LINE__); 
              echo'Data tidak berhasil disimpan!';
          } else{
              echo'success';
              move_uploaded_file($file_tmp, $lokasi);
             
            }
          }
          else{
              echo'File yang di unggah terlalu besar Maksimal Size 8MB..!';
          }}
          else{
            echo'File yang di unggah tidak sesuai dengan format, Berkas harus berformat jpg, jpeg, doc, docx, docm, pdf.!';

          }
       

      }else{
          echo'Sebelumnya data sudah ada pada tanggal '.tgl_indo($permission_date).' sampai '.tgl_indo($permission_date_finish).'';
    }
  }
  else{           
      foreach ($error as $key => $values) {            
        echo $values;
      }
  }


// -------------- DELETE IZIN --------------------- //
break;
case 'delete-izin':
  $id       = mysqli_real_escape_string($connection,epm_decode($_POST['id']));
  $query_delete  ="SELECT files,permission_date,permission_date_finish from permission WHERE employees_id='$row_user[id]' AND permission_id='$id'";
  $result_delete = $connection->query($query_delete);
  if($result_delete->num_rows > 0){
     $row = $result_delete->fetch_assoc();
      $images_delete = strip_tags($row['files']);
      $directory='../sw-content/izin/'.$images_delete.'';
      if(file_exists("../sw-content/izin/$images_delete")){
          unlink ($directory);
      }

    $deleted  = "DELETE FROM permission WHERE employees_id='$row_user[id]' AND permission_id='$id'";
    if($connection->query($deleted) === true) {
      echo'success';
    } else { 
      //tidak berhasil
      echo'Data tidak berhasil dihapus.!';
      die($connection->error.__LINE__);
    }

  }

// -------------- LOAD DATA HOME ----------------------//
break;
case 'load-home-counter':
  if(isset($_POST['month_filter'])){
      $month_filter = strip_tags($_POST['month_filter']);
      $filter ="MONTH(presence_date) ='$month_filter' AND year(presence_date) = '$year'"; 
    } 
    else{
      $filter ="MONTH(presence_date) ='$month' AND year(presence_date) = '$year'";
  }


  $query_hadir="SELECT presence_id FROM presence WHERE employees_id='$row_user[id]' AND $filter AND kehadiran='Hadir'";
  $hadir= $connection->query($query_hadir);

  $query_sakit="SELECT presence_id FROM presence WHERE employees_id='$row_user[id]' AND $filter AND kehadiran='Sakit'";
  $sakit = $connection->query($query_sakit);

  $query_izin="SELECT presence_id FROM presence WHERE employees_id='$row_user[id]' AND $filter AND kehadiran='Izin'";
  $izin = $connection->query($query_izin);

  $query_cuti="SELECT presence_id FROM presence WHERE employees_id='$row_user[id]' AND $filter AND kehadiran='Cuti'";
  $cuti = $connection->query($query_cuti);

  echo'
  <!-- item -->
  <div class="col-6 col-md-3 mb-2">
      <a href="javascript:void(0)" class="item">
          <div class="detail">
              <div class="icon-block text-primary">
                  <ion-icon name="log-in"></ion-icon>
              </div>
              <div>
                  <strong>Hadir</strong>
                  <p>'.$hadir->num_rows.' Hari</p>
              </div>
          </div>
      </a>
  </div>
  <!-- * item -->
  <!-- item -->
  <div class="col-6 col-md-3 mb-2">
      <a href="javascript:void(0)" class="item">
          <div class="detail">
              <div class="icon-block text-success">
                  <ion-icon name="person"></ion-icon>
              </div>
              <div>
                  <strong>Izin</strong>
                  <p>'.$izin->num_rows.' Hari</p>
              </div>
          </div>
      </a>
  </div>
  <!-- * item -->

  <!-- item -->
  <div class="col-6 col-md-3">
      <a href="javascript:void(0)" class="item">
          <div class="detail">
              <div class="icon-block text-secondary">
                 <ion-icon name="sad"></ion-icon>
              </div>
              <div>
                  <strong>Sakit</strong>
                  <p>'.$sakit->num_rows.' Hari</p>
              </div>
          </div>
      </a>
  </div>
  <!-- * item -->
  <!-- item -->
  <div class="col-6 col-md-3">
      <a href="javascript:void(0)" class="item">
          <div class="detail">
              <div class="icon-block text-danger">
                <ion-icon name="alarm"></ion-icon>
              </div>
              <div>
                  <strong>Cuti</strong>
                  <p>'.$cuti->num_rows.' hari</p>
              </div>
          </div>
      </a>
  </div>
  <!-- * item -->';
    

break;
}?>