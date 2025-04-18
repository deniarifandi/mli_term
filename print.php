<?php 

include('connect.php');;

// Get class and student details
$kelas = $_GET['kelas'];

$sql = "SELECT * FROM students  JOIN classes ON students.class_id = classes.id WHERE class_id = $kelas";
$students_result = $conn->query($sql);

//echo json_encode($students_result->fetch_assoc());

$student_array = [];
if ($students_result->num_rows > 0) {
    // Fetch the text block
    $row = $students_result->fetch_assoc();
    $fullText = $row['student_name'];
    $absen = $row['absen'];
    $class = $row['class_name'];
    $pertemuan = $row['pertemuan'];
    $homeroom = $row['homeroom'];

    // Explode the text block by newlines into an array
    $lines = explode("\n", $fullText);
    $absenLines = explode("\n", $absen);

    // Output each line
    $indexAbsen = 0;

    foreach ($lines as $line) {

        // echo $line ." , ". $absenLines[$indexAbsen++]. "<br>";
    }
} else {
    echo "No data 1 found.";
}

$sql2 = "SELECT * FROM subjects WHERE class_id = $kelas";
$subjects_result = $conn->query($sql2);

$objective_array = [];
$nilai_explode_stu = [];

if ($subjects_result->num_rows > 0) {

    //print_r($subjects_result->fetch_assoc());

    while( $row = $subjects_result->fetch_assoc()){
        $list_subjects_array[] = $row;
    }


    // print_r($nilai_explode_stu);

    // for ($i=0; $i < count($list_subjects_array); $i++) { 
      // print_r($list_subjects_array[0]);

    //   echo "<br>";
    //   echo "<br>";
    // }

    // print_r($nilai_explode_stu[0]);
    
    

} else {
    echo "No data 2 found.";
}

$conn->close();
?>

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

    // $student_array = explode("\n",$_POST['student']);
    // $absent_array = explode("\n",$_POST['absen']);
    
    // echo $

    $nilai_array = [];

    

    for ($i=0; $i < count($list_subjects_array); $i++) { 
      // echo $list_subjects_array[$i]['subject_name']." - ".$list_subjects_array[$i]['nilai'];
      // echo "<br>";
      $nilai_array[$i] = explode("\n", $list_subjects_array[$i]['nilai']);


      // if (isset($_POST['nilai'.$i])) {
      //     if ($_POST['nilai'.$i] != null) {
      //       $nilai_array[$i] = explode("\n",$_POST['nilai'.$i]);
      //     }
      // }
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

    <?php for ($x=0; $x < count($lines); $x++) { 
     $student_absence = explode("\t",$absenLines[$x]);
      // echo $student_absence[0]."<br>";
      // echo $student_absence[1]."<br>"; 
      // echo $student_absence[2]."<br>";
      $counter = 0;
    ?>
    <!-- --------------- start lampiran -->
    <div class="row">
     <img src="logo.png" style="max-width: 100%;">
     
   </div>

   <br>
<br>
   <table class="borderless" style="width:100%; border: 0px !important">

    <tr class="borderless">
      <td class="borderless" style="width:20%">Student's Name</td>
      <td class="borderless" style="width:50%">: <?php echo $lines[$x] ?></td>
      <td class="borderless" style="width:30%">Semester 2 AY 2024/2025</td>


    </tr>
    <tr class="borderless">
      <td class="borderless">Class</td>
      <td class="borderless">: <?php echo $class ?></td>
      <td class="borderless">Term : 3</td>

      
    </tr>
  </table>
  <br>
<br>
<br>


  <table style="width:100%">

   <tr>
     <td colspan="8" style="text-align: center;"><h2 style="margin:0px">TERM 3 - PROGRESS REPORT</h2></td>
   </tr>
   <tr>
     <td colspan="2" rowspan="3" style="text-align: center;"><h2>Subject</h2></td>
    
     <td colspan="6" style="text-align:center">TERM 3 (JANUARY  -  MARCH)</td>
   
 
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
    $exploded_nilai = $nilai_array;
    
    // print_r($exploded_nilai[$subject][$x]);
    // echo $exploded_nilai[$subject][$x]."<br>";
    $explodedSubject = explode("\t", $exploded_nilai[$subject][$x]);

    $checkNilai = 0;

     for ($d=0; $d < count($exploded_nilai); $d++) { 
          $checkNilai += (float)$exploded_nilai[$d];
        }

    ?>



    <tr <?php if($checkNilai == 0){ 
        ?> style="display: none;" 
        <?php } else{ $counter++;}?>>
     <td width="5%" style="text-align:center"><?php echo $counter; ?></td>
     <td width="35%"><?php echo $list_subjects_array[$subject]['subject_name']; ?></td>
     <td width="10%" style="text-align: center; <?php if ($explodedSubject[0] >= 0 && $explodedSubject[0] < 75) { ?> color:red <?php } ?>"><?php echo $explodedSubject[0];?></td>
     <td width="10%" style="text-align: center; <?php if ($explodedSubject[1] >= 0 && $explodedSubject[1] < 75) { ?> color:red <?php } ?>"><?php echo $explodedSubject[1];?></td>
     <td width="10%" style="text-align: center; <?php if ($explodedSubject[2] >= 0 && $explodedSubject[2] < 75) { ?> color:red <?php } ?>"><?php echo $explodedSubject[2];?></td>
     <td width="10%" style="text-align: center; <?php if ($explodedSubject[3] >= 0 && $explodedSubject[3] < 75) { ?> color:red <?php } ?>"><?php echo $explodedSubject[3];?></td>
     <td width="10%" style="text-align: center; <?php if ($explodedSubject[4] >= 0 && $explodedSubject[4] < 75) { ?> color:red <?php } ?>"><?php echo $explodedSubject[4];?></td>
     <td width="10%" style="text-align: center; <?php if ($explodedSubject[5] >= 0 && $explodedSubject[5] < 75) { ?> color:red <?php } ?>"><?php echo $explodedSubject[5];?></td>
     
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
       
       <td colspan="2" rowspan=""  style="text-align: center;">Teacher</td>
       <td colspan="2" rowspan=""  style="text-align: center;">Parent</td>
     </tr>
     <tr>
       <td width="40%" colspan="2">Sickness Absence</td>
       <td width="10%"  style="text-align: center;" class=""><?php echo round((float)$student_absence[0]/$pertemuan*100); ?> %</td>
       <td width="10%" class="borderless"></td>
       <td width="10%" colspan="2" rowspan="3" style="text-align:center; vertical-align: bottom; font-size: 10px;"><?php echo $homeroom; ?></td>
       <td width="10%" colspan="2" class="" rowspan="3"></td>
       
     </tr>
      <tr>
       <td width="40%" colspan="2">Authorized Absence</td>
       
       <td width="10%"  style="text-align: center;"><?php echo round((float)$student_absence[1]/$pertemuan*100) ?> %</td>
       <td width="10%" class="borderless"></td>
       
       
     </tr>
      <tr>
       <td width="40%" colspan="2">Unauthorized Absence</td>
       
       
       
       <td width="10%"  style="text-align: center;"><?php echo round((float)$student_absence[2]/$pertemuan*100); ?> %</td>
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
 <br>
<br><br><br>

 <table style="width:100%; margin-top: 10px;" class="borderless">
   <tr>
     <td style="text-align:center" class="borderless">Malang, 17 April 2025</td>
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