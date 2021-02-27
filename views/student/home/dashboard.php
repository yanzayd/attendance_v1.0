<?php
$ClassesTable  = new \Classes();
$StudentTable  = new \Student();
$TeacherTable  = new \Teacher();

#Get the Total Number of Class
$ClassesTable->select("ORDER BY id ASC");
$Total_Classes = $ClassesTable->count();
#Get the Total Number of Student
$StudentTable->select("ORDER BY id ASC");
$Total_Student = $StudentTable->count();
#Get the Total Number of Student
$TeacherTable->select("ORDER BY id ASC");
$Total_Teacher = $TeacherTable->count();
?>
<div class="main-container">
  <div class="pd-ltr-20">
    <div class="row">
      <div class="col-xl-4 mb-30">
        <div class="card-box height-80-p widget-style1">
          <div class="d-flex flex-wrap align-items-center">
            <div class="progress-data h1">
              <div class="micon dw dw-board">
              </div>
            </div>
            <div class="widget-data">
              <div class="h2 mb-0"><?=$Total_Classes?></div>
              <div class=" h4 weight-600 font-14">Class</div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-4 mb-30">
        <div class="card-box height-80-p widget-style1">
          <div class="d-flex flex-wrap align-items-center">
            <div class="progress-data h1">
              <div class="micon dw dw-user1">
              </div>
            </div>
            <div class="widget-data">
              <div class="h2 mb-0"><?=$Total_Student?></div>
              <div class=" h4 weight-600 font-14">Student</div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-4 mb-30">
        <div class="card-box height-80-p widget-style1">
          <div class="d-flex flex-wrap align-items-center">
            <div class="progress-data h1">
              <div class="micon dw dw-user2">
              </div>
            </div>
            <div class="widget-data">
              <div class="h2 mb-0"><?=$Total_Teacher?></div>
              <div class=" h4 weight-600 font-14">Teacher</div>
            </div>
          </div>
        </div>
      </div>
        </div>
    <div class="row">
      <div class="col-xl-8 mb-30">
        <div class="card-box height-70-p pd-20">
          <h2 class="h5 mb-20">Activity</h2>
          <div id="chart5"></div>
        </div>
      </div>
      <div class="col-xl-4 mb-30">
        <div class="card-box height-80-p pd-20">
          <h2 class="h4 mb-20">Attendance Progress</h2>
          <div id="chart6"></div>
        </div>
      </div>
    </div>
  </div>
</div>
