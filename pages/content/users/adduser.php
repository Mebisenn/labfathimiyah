<?php

  $ds = DIRECTORY_SEPARATOR;
  $base_dir = realpath(dirname(__FILE__)  . $ds . '..' . $ds . '..'  . $ds . '..') . $ds;
  require_once("{$base_dir}pages{$ds}core{$ds}header.php");

?>
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>General Tables</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Tables</li>
          <li class="breadcrumb-item active">General</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title"></h5>
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Form Add User</h5>

                  <!-- Custom Styled Validation -->
                  <form action="prosesdatauser.php" method="POST" class="row g-3 needs-validation" novalidate>
                    <div class="col-md-4">
                      <label for="validationCustom02" class="form-label">Nama Lengkap</label>
                      <input type="text" name="nama" class="form-control" id="validationCustom02" required>
                      <div class="valid-feedback">
                        Looks good!
                      </div>
                    </div>
                    <div class="col-md-4">
                      <label for="validationCustom04" class="form-label">Role</label>
                      <select class="form-select" name="role" id="validationCustom04" required>
                        <option selected disabled value="">Pilih...</option>
                        <option>super admin</option>
                        <option>admin</option>
                      </select>
                      <div class="invalid-feedback">
                        Please select a valid state.
                      </div>
                    </div>
                    <div class="col-md-3">
                      <label for="validationCustomEmail" class="form-label">Email</label>
                      <div class="input-group has-validation">
                        <input type="text" name="email" class="form-control" id="validationCustomEmail" aria-describedby="inputGroupPrepend" required>
                        <div class="invalid-feedback">
                          Please choose a Email.
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <label for="validationCustomjabatan" class="form-label">Jabatan</label>
                      <div class="input-group has-validation">
                        <input type="text" name="jabatan" class="form-control" id="validationCustomjabatan" aria-describedby="inputGroupPrepend" required>
                        <div class="invalid-feedback">
                          Please choose a jabatan.
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <label for="validationCustomno_hp" class="form-label">NO. HP</label>
                      <div class="input-group has-validation">
                        <input type="text" name="no_hp" class="form-control" id="validationCustomno_hp" aria-describedby="inputGroupPrepend" required>
                        <div class="invalid-feedback">
                          Please choose a no hp.
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <label for="validationCustomno_hp" class="form-label">Alamat</label>
                      <div class="input-group has-validation">
                        <input type="text" name="alamat" class="form-control" id="validationCustomno_hp" aria-describedby="inputGroupPrepend" required>
                        <div class="invalid-feedback">
                          Please choose a no hp.
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <label for="validationCustom05" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" id="validationCustom05" required>
                      <div class="invalid-feedback">
                        Please provide a valid zip.
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                        <label class="form-check-label" for="invalidCheck">
                          Agree to terms and conditions
                        </label>
                        <div class="invalid-feedback">
                          You must agree before submitting.
                        </div>
                      </div>
                    </div>
                    <div class="col-12">
                      <button class="btn btn-primary" name="save" type="submit">Submit form</button>
                    </div>
                  </form><!-- End Custom Styled Validation -->

                </div>
              </div>

            </div>
          </div>

        </div>
      </div>
    </section>


  </main><!-- End #main -->

  <?php
  require_once("{$base_dir}pages{$ds}core{$ds}footer.php");
?> 