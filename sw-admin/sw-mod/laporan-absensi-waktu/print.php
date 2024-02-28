<?php error_reporting(0);
    require_once'../../../sw-library/sw-config.php'; 
    require_once'../../../sw-library/sw-function.php';
if(empty($_SESSION['SESSION_USER']) && empty($_SESSION['SESSION_ID'])){
    //Kondisi tidak login
   header('location:../login/');
}

else{
  //kondisi login
switch (@$_GET['action']){
case 'excel':

if (empty($_GET['print'])) {
  header("Content-type: application/vnd-ms-excel");
  header("Content-Disposition: attachment; filename=Data-Absensi-$date.xls");
}
else {
echo'<script>
     window.onafterprint = window.close;
      window.print();
    </script>';  
}
    
echo'<!DOCTYPE html>
<html>
<head>
    <title>Cetak Data Absensi Harian</title>
    <style>
        body{font-family:Arial,Helvetica,sans-serif}.container_box{position:relative}.container_box .row h3{line-height:25px;font-size:20px;margin:0px 0 10px;text-transform:uppercase}.container_box .text-center{text-align:center}.container_box .content_box{position:relative}.container_box .content_box .des_info{margin:20px 0;text-align:right}.container_box h3{font-size:30px}table.customTable{width:100%;background-color:#fff;border-collapse:collapse;border-width:1px;border-color:#b3b3b3;border-style:solid;color:#000}table.customTable td,table.customTable th{border-width:1px;border-color:#b3b3b3;border-style:solid;padding:5px;text-align:left}table.customTable thead{background-color:#f6f3f8}.text-center{text-align:center}
        .label {display: inline;padding: .2em .6em .3em;font-size: 75%;font-weight: 700;line-height: 1;color: #fff;text-align: center;white-space: nowrap; vertical-align: baseline;border-radius: .25em;}
        .label-success{background-color: #00a65a !important;}.label-warning {background-color: #f0ad4e;}.label-info {background-color: #5bc0de;}.label-danger{background-color: #dd4b39 !important;}
        p{line-height:20px;padding:0px;margin: 5px;}.pull-right{float:right}
        span.text-red{color:#dd4b39!important}

    
    </style>

</head>
<body>';
      if(isset($_GET['month']) OR isset($_GET['year'])){
          $bulan   = date ($_GET['month']);
          $tahun = $_GET['year'];
      } 

      else{
          $bulan  = date ("m");
          $tahun  = date("Y");
      }
      $hari       = date("d");
      $jumlahhari = date("t",mktime(0,0,0,$bulan,$hari,$tahun));
      $s          = date ("w", mktime (0,0,0,$bulan,1,$tahun));

      $id   = htmlentities($_GET['name']);
      if($id == NULL){
         $filter_employess ='';
      } 

      else{
          $filter_employess = "WHERE id='$id'";
      }
      echo'
      <section class="container_box">
      <div class="row">';
      if(isset($_GET['month']) OR isset($_GET['year'])){
        echo'<h3 class="text-center">LAPORAN DETAIL HARIAN<br>BULAN '.ambilbulan($_GET['month']).' - '.$_GET['year'].'</h3>';}
        else{
        echo'<h3 class="text-center">LAPORAN DETAIL HARIAN<br>BULAN '.ambilbulan($month).' - '.$year.'</h3>';
        }
        echo'
        <div class="content_box">
        <table class="customTable"
          <thead>
            <tr>
              <th rowspan="2" width="40" class="text-center" style="vertical-align: middle;">No</th>
              <th rowspan="2" style="vertical-align: middle;">Nama Pegawai</th>
              <th class="text-center" colspan="'.$jumlahhari.'">'.ambilbulan($bulan).'</th>
              <th class="text-center" colspan="1">Keterangan</th>
            </tr>
            <tr>';
            $sum=0;$libur=0;
            for ($d=1;$d<=$jumlahhari;$d++) {
                    $warna      = '';
                    $background = '';
                    $status_hadir     = 'Tidak Hadir';
                    $date_month_year = ''.$tahun.'-'.$bulan.'-'.$d.'';
                    $hari_libur     = date('D',strtotime($date_month_year));
                /** Menentukan Hari Libur Umum */
                $query_sabtu ="SELECT shift_name FROM shift WHERE shift_name='Sabtu' AND active='N'";
                $result_sabtu= $connection->query($query_sabtu);
                if($result_sabtu->num_rows >0 ){
                  $sabtu = 'Sat';
                }else{
                  $sabtu ='1';
                }
            
                $query_minggu ="SELECT shift_id FROM shift WHERE shift_name='Minggu' AND active='N'";
                $result_minggu = $connection->query($query_minggu);
                if($result_minggu->num_rows >0 ){
                  $minggu = 'Sun';
                }else{
                  $minggu ='2';
                }

              if($hari_libur == $sabtu OR $hari_libur == $minggu){
                    $warna='color:white';
                    $background ='background:#FF0000';
                    $sum++;
                    $status_hadir ='Libur';
                }else{
                    $query_holiday="SELECT holiday_date,description FROM holiday WHERE holiday_date='$date_month_year'";
                    $result_holiday = $connection->query($query_holiday);
                      if($result_holiday->num_rows > 0){
                        $data_holiday = $result_holiday->fetch_assoc();
                        $warna='color:white';
                        $background ='background:#FF0000';
                        $libur++;
                        $status_hadir = $data_holiday['description'];
                      }
                }

              echo'
              <th width="50" class="text-center" style="'.$warna.'; '.$background.'">'.$d.'</th>';
            }
            echo'
            <th width="50" class="text-center">TOTAL JAM</th>
            </tr>
          </thead>
          <tbody>';
          $query ="SELECT id,employees_name FROM employees $filter_employess ORDER BY id ASC";
          $result = $connection->query($query);$no=0;
          while ($row = $result->fetch_assoc()){$no++;
            echo'
            <tr>
              <td  class="text-center">'.$no.'</td>
              <td  width="150">'.$row['employees_name'].'</td>';
               for ($d=1;$d<=$jumlahhari;$d++) {
                $date_month_year = ''.$tahun.'-'.$bulan.'-'.$d.'';
                 if(isset($_GET['month']) OR isset($_GET['year'])){
                    $month = $_GET['month'];
                    $year  = $_GET['year'];
                    $filter ="presence_date='$date_month_year' AND MONTH(presence_date)='$month' AND year(presence_date)='$year'";
                  } 
                  else{
                    $filter ="presence_date='$date_month_year' AND MONTH(presence_date) ='$month'";
                  }

                $query_absen ="SELECT presence_id,presence_date,time_in,time_out,kehadiran FROM presence WHERE $filter AND employees_id='$row[id]' ORDER BY presence_id DESC";
                $result_absen = $connection->query($query_absen);
                if($result_absen->num_rows > 0) {
                  $row_absen = $result_absen->fetch_assoc();
                  if($row_absen['kehadiran'] =='Hadir'){
                    $durasi_kerja_start = strtotime(''.$row_absen['presence_date'].' '.$row_absen['time_in'].'');
                    $durasi_kerja_end   = strtotime(''.$row_absen['presence_date'].' '.$row_absen['time_out'].'');
                    $diff  				= $durasi_kerja_end - $durasi_kerja_start;
                    $durasi_jam   		= floor($diff / (60 * 60));
                    $durasi_menit 		= $diff - ($durasi_jam * (60 * 60) );
                    $durasi_detik 		= $diff % 60;
                    $durasi_kerja 		= ''.$durasi_jam.':'.floor($durasi_menit/60 ).'';

                    echo'
                    <td class="text-center">'.$durasi_kerja.'</td>';
                  }else{
                    echo'
                    <td class="text-center">
                      <span class="label label-warning">'.$row_absen['kehadiran'].'</label>
                    </td>';
                  }
                }else{
                  echo'
                  <td class="text-center"><span class="text-red"><b>x</b></span></td>';
                }
              }

              if(!empty($_POST['month']) AND !empty($_POST['year'])){
                $month = $_POST['month'];
                $year  = $_POST['year'];
                $filter ="MONTH(presence_date)='$month' AND year(presence_date)='$year' AND employees_id='$row[id]'";
              } 
              else{
                $filter ="MONTH(presence_date)='$month' AND year(presence_date)='$year' AND employees_id='$row[id]'";
              }
              
              $total =0;
              $query_hadir="SELECT presence_date,time_in,time_out FROM presence WHERE $filter AND kehadiran='Hadir'";
              $result_hadir = $connection->query($query_hadir);
              while($data_absensi = $result_hadir->fetch_assoc()){
                $durasi_kerja_start = strtotime(''.$data_absensi['presence_date'].' '.$data_absensi['time_in'].'');
                $durasi_kerja_end   = strtotime(''.$data_absensi['presence_date'].' '.$data_absensi['time_out'].'');
                $diff  				= $durasi_kerja_end - $durasi_kerja_start;
                $durasi_jam   		= floor($diff / (60 * 60));
                $total += $durasi_jam;
              }
            echo'
            <td width="50" class="text-center">'.$total.'</td>
            </tr>';
          }
        echo'
          </tbody>
        </table>
          

        <table class="table" style="padding:10px;margin-top:50px;">
            <tr>
                <td width="300">'.tgl_indo($date).'<br>Disetujui<br>Kepala Sekolah<br><br><br><br><br><b>'.$site_director.'</b></td>
            </tr>
        </table>

       </div>
      </div>
    </section>
</body>
</html>';
break;
}
}?>