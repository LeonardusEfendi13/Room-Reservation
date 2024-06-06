<style>
  .captcha {
    margin-top: 1%;
    margin-bottom: 1%;
    margin-left: auto;
    margin-right: auto;
    font-family: Copperplate, Papyrus, fantasy;
    background-color: grey;
    width: fit-content;
    padding: 0.2em;
    border: 2px solid black;
    letter-spacing: 1px;
    font-size: 25px;
    font-weight: bold;
    color:yellow;
    border-radius: 15px;
  }
</style>

<div class="container">

  <!-- Outer Row -->
  <div class="row justify-content-center">

    <div class="col-lg-7">

      <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
          <!-- Nested Row within Card Body -->
          <div class="row">
            <div class="col-lg">
              <div class="p-5">
                <div class="text-center">
                  <h1 class="h4 text-gray-900 mb-4">Management Login</h1>
                </div>
                <?= $this->session->flashdata('pesan'); ?>
                <form class="user" method="post" action="<?= base_url('managelogin'); ?>">
                  <div class="form-group">
                    <input type="text" class="form-control form-control-user" value="<?= set_value('email'); ?>" id="email" placeholder="Masukkan Alamat Email" name="email">
                    <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                  </div>
                  <div class="form-group">
                    <input type="password" class="form-control form-control-user" id="password" placeholder="Password" name="password">
                    <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                  </div>
                  <div class="form-group">
                    <div class="captcha">
                      <?php echo $captcha; ?>
                    </div>
                    <input type="text" class="form-control form-control-user" id="code" placeholder=" Enter Captcha" name="code">
                    <?= form_error('code', '<small class="text-danger pl-3">', '</small>'); ?>
                  </div>

                  <button type="submit" class="btn btn-primary btn-user btn-block"> Masuk </button>
                </form>
                <hr>
                <div class="text-center"> <a class="small" href="<?= base_url('autentifikasi'); ?>">Login Sebagai Admin!</a> </div>
                <div class="text-center"> <a class="small" href="<?= base_url('home'); ?>">Login Sebagai Member!</a> </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>

  </div>

</div>