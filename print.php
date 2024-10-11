<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>

</head>

<style type="text/css">
  @media print {
    .pagebreak { page-break-before: always; } /* page-break-after works, as well */
  }
</style>
<?php

    $student_array = explode("\n",$_POST['student']);
    $absent_array = explode("\n",$_POST['absen']);

    $nilai_array = [];

    for ($i=1; $i < 100; $i++) { 
      if (isset($_POST['nilai'.$i])) {
          if ($_POST['nilai'.$i] != null) {
            $nilai_array[$i] = explode("\n",$_POST['nilai'.$i]);
          }
      }
    }
      // echo "total subject = ".count($nilai_array);
    ?>


<style type="text/css">
  table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
    font-size: 12px;
    padding:5px;
  }

  .borderless{
    border: 0px solid black !important;
    font-size: 15px;
  }

  h3{
    margin: 0px;
    padding: 0px;
  }

</style>
<body style="width:90%; padding-left:4%">

  <?php for ($x=0; $x < count($student_array); $x++) { 
    $student_absence = explode("\t",$absent_array[$x]);
    
    ?>
    <!-- --------------- start lampiran -->
    <div class="row">
     <img src="logo.png" style="max-width: 100%;">
     
   </div>

   <table class="borderless" style="width:100%; border: 0px !important">

    <tr class="borderless">
      <td class="borderless" style="width:20%">Student Name</td>
      <td class="borderless" style="width:50%">: <?php echo $student_array[$x] ?></td>
      <td class="borderless" style="width:30%">Semester 1 AY 2024/2025</td>


    </tr>
    <tr class="borderless">
      <td class="borderless">Class</td>
      <td class="borderless">: <?php echo $_POST['kelas']; ?></td>
      <td class="borderless">Term : 1</td>

      
    </tr>
  </table>
  <br>


  <table style="width:100%">

   <tr>
     <td colspan="8" style="text-align: center;"><h2 style="margin:0px">TERM 1 - PROGRESS REPORT</h2></td>
   </tr>
   <tr>
     <td colspan="2" rowspan="3" style="text-align: center;"><h2>Subject</h2></td>
    
     <td colspan="6" style="text-align:center">TERM 1 (JULY  -  SEPTEMBER)</td>
   
 
   </tr>
   <tr>
     <td colspan="4" style="text-align: center;">Chapter Test</td>
     <td colspan="2" style="text-align: center;"> Project</td>
   
   </tr>
    <tr>
    
     <td style="text-align: center;">1</td>
     <td style="text-align: center;">Remedial</td>
     <td style="text-align: center;">2</td>
     <td style="text-align: center;">Remedial</td>
     <td style="text-align: center;">Individual Project</td>
     <td style="text-align: center;">Group Project</td>
     
   </tr>

  <?php for ($subject=0; $subject < count($nilai_array); $subject++) { 
    $exploded_nilai = explode("\t",$nilai_array[$subject+1][$x]);
    ?>



    <tr>
     <td width="10%"><?php echo $subject+1; ?></td>
     <td width="30%"><?php echo $_POST['subject'.$subject+1] ?></td>
     <td width="10%"><?php echo $exploded_nilai[0];?></td>
     <td width="10%"><?php echo $exploded_nilai[1];?></td>
     <td width="10%"><?php echo $exploded_nilai[2];?></td>
     <td width="10%"><?php echo $exploded_nilai[3];?></td>
     <td width="10%"><?php echo $exploded_nilai[4];?></td>
     <td width="10%"><?php echo $exploded_nilai[5];?></td>
     
   </tr>

    <?php 
  } ?>


<!-- -------------------------------------------------- -->
 </table>
<br>
 <table style="width: 100%;" class="borderless">
     <tr>
       <td colspan="3"><h3>Attendance</h3></td>
       
       
       <td class="borderless"></td>
       
       <td colspan="2" rowspan="">Teacher</td>
       <td colspan="2" rowspan="">Parent</td>
     </tr>
     <tr>
       <td width="40%" colspan="2">Sickness Absence</td>
       <td width="10%" class=""><?php echo (float)$student_absence[0]/$_POST['pertemuan']*100; ?> %</td>
       <td width="10%" class="borderless"></td>
       <td width="10%" colspan="2" rowspan="3"></td>
       <td width="10%" colspan="2" class="" rowspan="3"></td>
       
     </tr>
      <tr>
       <td width="40%" colspan="2">Authorized Absence</td>
       
       <td width="10%"><?php echo (float)$student_absence[1]/$_POST['pertemuan']*100; ?> %</td>
       <td width="10%" class="borderless"></td>
       
       
     </tr>
      <tr>
       <td width="40%" colspan="2">Unauthorized Absence</td>
       
       
       
       <td width="10%"><?php echo (float)$student_absence[2]/$_POST['pertemuan']*100; ?> %</td>
       <td width="10%" class="borderless"></td>
     </tr>
     <tr>
      <td width="10%" class="borderless"></td>
      <td width="30%" class="borderless"></td>
      <td width="10%" class="borderless"></td>
      <td width="10%" class="borderless"></td>
      <td width="10%" class="borderless"></td>
      <td width="10%" class="borderless"></td>
      <td width="10%" class="borderless"></td>
      <td width="10%" class="borderless"></td>
     </tr>
     

 </table>

 <table style="width:100%; margin-top: 10px;" class="borderless">
   <tr>
     <td style="text-align:center" class="borderless">Malang, <?php echo date("d-M-Y"); ?></td>
   </tr>
   <tr>
     <td style="text-align:center" class="borderless">Principal<br><br><br><br></td>
   </tr>
   <tr>
     <td style="text-align:center" class="borderless">Rurik Herawati, M.Pd.</td>
   </tr>
 </table>



 <div class="pagebreak"> </div>
 <!-- --------------- end lampiran -->
 <?php
} ?>

</body>
</html>