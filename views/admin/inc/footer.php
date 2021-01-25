<div class="main-container">
  <div class="pd-ltr-20">
    <div class="footer-wrap pd-20 mb-20 card-box">
      © <script>document.write(new Date().getFullYear())</script> ATTENDANCE MIS By <a href="https://www.attendance.co" target="_blank"> Bedel nyz Indusries </a>
    </div>
  </div>
</div>

<!-- js -->
<script src="<?=DN?>/assets/vendors/scripts/core.js"></script>
<script src="<?=DN?>/assets/vendors/scripts/script.min.js"></script>
<script src="<?=DN?>/assets/vendors/scripts/process.js"></script>
<script src="<?=DN?>/assets/vendors/scripts/layout-settings.js"></script>
<script src="<?=DN?>/assets/src/plugins/datatables/js/jquery.dataTables.min.js"></script>
<script src="<?=DN?>/assets/src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
<script src="<?=DN?>/assets/src/plugins/datatables/js/dataTables.responsive.min.js"></script>
<script src="<?=DN?>/assets/src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
<!-- buttons for Export datatable -->
<!--  -->

<!-- <script src="<?=DN?>/assets/src/plugins/datatables/js/vfs_fonts.js"></script> -->
<!-- Datatable Setting js -->
<script src="<?=DN?>/assets/vendors/scripts/datatable-setting.js"></script></body>

<!-- js -->
<script src="<?=DN?>/assets/src/plugins/apexcharts/apexcharts.min.js"></script>
<script src="<?=DN?>/assets/src/plugins/datatables/js/jquery.dataTables.min.js"></script>
<script src="<?=DN?>/assets/src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
<script src="<?=DN?>/assets/src/plugins/datatables/js/dataTables.responsive.min.js"></script>
<script src="<?=DN?>/assets/src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
<script src="<?=DN?>/assets/vendors/scripts/dashboard.js"></script>
<script src="<?=DN?>/views/<?=$main_.$sub_.'scripts/script.js' ?>"></script>
<!-- Sweet Alerts js -->
<script src="<?=DN?>/assets/libs/sweetalert2/sweetalert2.min.js"></script>

<!-- Sweet alert init js-->
<script src="<?=DN?>/assets/js/pages/sweet-alerts.init.js"></script>

<?php
if(Session::exists('success')):
 ?>
   <script>
      Swal.fire({title:"Notification Success!",text:"<?=Session::get('success') ?>",type:"success",showCancelButton:!0,confirmButtonColor:"#556ee6",cancelButtonColor:"#f46a6a"});
   </script>
<?php
elseif(Session::exists('error')):
 ?>
   <script>
      Swal.fire({title:"Notification Error!",text:"<?=Session::get('error') ?>",type:"error",showCancelButton:!0,confirmButtonColor:"#556ee6",cancelButtonColor:"#f46a6a"});
   </script>
<?php
endif;
Session::delete('success');
Session::delete('error');
?>
</body>
</html>
