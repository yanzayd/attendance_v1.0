<script type="text/javascript">
  function preview_image(event){
    var reader = new FileReader();
    reader.onload = function(){
      var output = document.getElementById("input_Imagees");
      output.src =reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
  }
</script>
<div class="main-container">
  <div class="pd-ltr-20 xs-pd-20-10">
    <div class="min-height-200px">
      <div class="main-content">

          <div class="page-content">
              <div class="container">

                  <div class="row">
                      <div class="col-xl-4">
                          <div class="card overflow-hidden">
                              <div class="bg-soft-primary">
                                  <div class="row">
                                      <div class="col-7">
                                          <div class="p-3">
                                              <h6 class="">My profile</h6>
                                          </div>
                                      </div>
                                      <div class="col-5 align-self-end">
                                          <img src="<?=DN?>/assets/vendors/images/profile-img.png" alt="" class="img-fluid">
                                      </div>
                                  </div>
                              </div>
                              <div class="card-body pt-0">
                                  <div class="row">
                                      <div class="col-sm-4">
                                          <div class="avatar-md profile-user-wid mb-4">
                                              <img src="<?=DN?>/data/profile/<?=$session_user_data->profile ?>" alt="" class="img-thumbnail rounded-circle" id="input_Imagees">
                                          </div>
                                          <small class="font-size-10 text-truncate"><?=$UserTypeTable->find($session_user_data->user_type_id, 'name') ?></small>

                                      </div>

                                      <div class="col-sm-8">
                                          <div class="pt-4">

                                              <div class="row">
                                                  <div class="col-12">
                                                      <h5 class="font-size-15"><?= $session_user_data->firstname.' '.$session_user_data->lastname ?></h5>
                                                  </div>

                                              </div>

                                          </div>
                                      </div>

                                        <div class="col-sm-12">
                                        <label class="btn btn-primary btn-upload col-md-12 col-sm-12 col-xs-12 btn-sm" style="background: #2A3F54;" for="inputImage" title="Upload image file">

                                            <input disabled type="file" class="sr-only" id="inputImage" name="photoprofile" onchange="preview_image(event)" accept="images/*" title="Edit Profile">
                                            <span class="docs-tooltip" data-toggle="tooltip" title="Import image with Blob URLs">
                                              <i class="fa fa-edit m-right-xs"></i>Change Profile
                                            </span>
                                        </label>
                                      </div>

                                  </div>
                              </div>
                          </div>
                          <!-- end card -->

                          <div class="card">
                              <div class="card-body">
                                  <h4 class="card-title mb-4">Detailed Information</h4>
                                  <div class="table-responsive">
                                      <table class="table table-nowrap mb-0">
                                          <tbody>
                                              <tr>
                                                  <th scope="row">Names: </th>
                                                  <td><?= $session_user_data->surname.' '.$session_user_data->firstname.' '.$session_user_data->lastname ?></td>
                                              </tr>
                                              <tr>
                                                  <th scope="row">E-mail :</th>
                                                  <td><?= $session_user_data->email ?></td>
                                              </tr>
                                              <tr>
                                                  <th scope="row">Telephone :</th>
                                                  <td><?= $session_user_data->telephone ?></td>
                                              </tr>

                                              <tr>
                                                  <th scope="row">Adress :</th>
                                                  <td><?= $session_user_data->address ?></td>
                                              </tr>
                                          </tbody>
                                      </table>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="col-xl-8">
                        <div class="card">
                            <div class="card-body">

                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs nav-tabs-custom" role="tablist">
                                  <li class="nav-item">
                                      <a class="nav-link" data-toggle="tab" href="#profile_info" role="tab">
                                          My Information
                                      </a>
                                  </li>

                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane active" id="profile_info" role="tabpanel">
                                      <br>
                                      <form method="post" id="simpleForm">
                                          <div class="form-group row mb-2">
                                              <div class="col-sm-12">
                                                <input disabled type="text" class="form-control" id="firstname" name="firstname" placeholder="Nom" value="<?= $session_user_data->firstname ?>">
                                              </div>
                                          </div>
                                          <div class="form-group row mb-2">
                                              <div class="col-sm-12">
                                                <input disabled type="text" class="form-control" id="lastname" name="lastname" placeholder="Postnom" value="<?= $session_user_data->lastname ?>">
                                              </div>
                                          </div>
                                          <div class="form-group row mb-2">
                                              <div class="col-sm-12">
                                                <input disabled type="text" class="form-control" id="surname" name="surname" placeholder="Prenom" value="<?= $session_user_data->surname ?>">
                                              </div>
                                          </div>
                                          <div class="form-group row mb-2">
                                              <div class="col-sm-12">
                                                <input disabled type="text" class="form-control" id="email" name="email" placeholder="Adresse E-mail" value="<?= $session_user_data->email ?>">
                                              </div>
                                          </div>
                                          <div class="form-group row mb-2">
                                              <div class="col-sm-12">
                                                <input disabled type="text" class="form-control" id="telephone" name="telephone" placeholder="+243999999999" value="<?= $session_user_data->telephone ?>">
                                              </div>
                                          </div>
                                          <div class="form-group row mb-2">
                                              <div class="col-sm-12">
                                                <input disabled type="text" class="form-control" id="address" name="address" placeholder="Adresse" value="<?= $session_user_data->address ?>">
                                              </div>
                                          </div>
                                      </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                      </div>
                  </div>
                  <!-- end row -->

              </div> <!-- container-fluid -->
          </div>
    </div>
  </div>
</div>
