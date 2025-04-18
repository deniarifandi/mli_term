
<?php

include('connect.php');;

$sql = "SELECT * from classes where id = ".$_GET['kelas'];
$class_result = $conn->query($sql);

$sql2 = "SELECT * from students where class_id = ".$_GET['kelas'];
$students_result = $conn->query($sql2);

$sql3 = "SELECT * from subjects where class_id = ".$_GET['kelas'];
$subjects_result = $conn->query($sql3);

if ($class_result->num_rows > 0) {

    $row = $class_result->fetch_assoc();
    $class_name = $row['class_name'];
    $homeroom = $row['homeroom'];
    $pertemuan = $row['pertemuan'];
    $absen = $row['absen'];

} else {
    echo "No data found.";
}

if ($students_result->num_rows > 0) {

   $row = $students_result->fetch_assoc();

   $students = $row['student_name'];

} else {
    echo "No data found.";
}

if ($subjects_result->num_rows > 0) {
  
  // $subjects;
  while ($row = $subjects_result->fetch_assoc()) {
    $subjects[] = $row["subject_name"];
    $nilais[] = $row['nilai'];
  }

  // print_r($subjects);

   // $subjects = $row['subject_name'];

   // echo $subjects;

} else {
    echo "No data found.";
}


?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bootstrap demo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
  <div class="container"> 
    <h1>Converter Term Ma bro!</h1>
    <br><br>
    <form action="updateData.php" method="POST" target="_blank">
      <div class="row">
        <div class="col-md-12">
          <h2>Class</h2>
          
          <input type="hidden" style="width:100%" rows="10" name="kelasid" value="<?= $_GET['kelas'] ?>" class="form-control"></input>

          <input type="text" style="width:100%" rows="10" name="kelas" value="<?= $class_name ?>" class="form-control"></input>
        </div>
        <div class="col-md-12">
          <h2>Homeroom Teacher Name</h2>
          <input type="text" style="width:100%" rows="10" name="homeroom" value="<?= $homeroom ?>" class="form-control"></input>
        </div>
        <div class="col-md-12" style="margin-top:25px">
          <h2>Student (1 line per student)</h2>
          <textarea style="width:100%" rows="10" name="student" class="form-control"><?= $students ?></textarea>
        </div>

        <div class="col-md-3" style="margin-top:25px">
          <h2>Total Pertemuan</h2>
          <input type="text" style="width:100%" rows="10" name="pertemuan" value="<?= $pertemuan ?>" class="form-control"></input>
        </div>
         <div class="col-md-12" style="margin-top: 25px;">
          <h2>Absence (direct copy from template)</h2>
          <textarea style="width:100%" rows="10" name="absen" class="form-control"><?= $absen ?></textarea>
        </div>
      </div>
      <br>

      <div class="row">
        <div class="col-md-12">
        </div>
      </div>

      <?php for ($i=0; $i < count($subjects); $i++) { ?>
     
      <div id="content_subject<?php echo $i; ?>">
         <h3 style="color: red;">Subject ke <?php echo $i+1; ?></h3>
         <hr>
         <!-- Start Input 1 -->
         <div class="row">

          <div class="col-md-12">
           <h2>Nama Subject</h2>
           <input type="text" name="subject<?php echo $i; ?>" value="<?php echo $subjects[$i]; ?>" class="form-control">
          </div>
           <br>
           <br>

           <div class="col-md-12" style="display:none">
            <h2>Objective (1 line per objective)</h2>
            <textarea style="width:100%" rows="10" name="objective<?php echo $i; ?>" class="form-control"></textarea>
           </div>

          </div>
          <div class="col-md-12">
            <h2>Nilai (direct copy)</h2>
            <textarea style="width:100%" rows="10" name="nilai<?php echo $i; ?>" class="form-control"><?php echo $nilais[$i]; ?></textarea>
          </div>
          <br>
          <br><br><br><br>
      </div>
      <!-- End Input 1 -->

      <?php } ?>

       <a class="btn btn-warning" type="button" id="addsubject" style="font-size: 30px; width:100%;  float: right;" onclick="addSubject()">Add subject</a>
       <br>
       <br><br><br><br><br>
  <input class="btn btn-success" type="submit" id="submit_button" style="font-size: 30px; float: right;">
  <br>
  <br>
  <br>
  <br>
  <br><br>
</div>



</form>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>


<script type="text/javascript">
  
  var index = 0;

  function addSubject(){
    document.getElementById("content_subject"+index).style.display = "";
    index++;
    }

</script>