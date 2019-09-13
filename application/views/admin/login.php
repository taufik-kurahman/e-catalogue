<div class="login-box">
  <div class="login-logo">
    <img src="<?= base_url('assets/admin/dist/img/logo.png'); ?>" alt="Web Logo" class="img-fluid" width="100">
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>
      <?= $this->session->flashdata('response'); ?>
      <form action="<?= base_url('admin/login'); ?>" method="post">
        <div class="form-group has-feedback">
          <input type="email" class="form-control" placeholder="Email" name="email" value="<?= set_value('email'); ?>">
          <?= form_error('email', '<small class="text-danger">', '</small>'); ?>
        </div>
        <div class="form-group has-feedback">
          <input type="password" class="form-control" placeholder="Password" name="password">
          <?= form_error('password', '<small class="text-danger">', '</small>'); ?>
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-outline-danger btn-block btn-flat">Sign In</button>
        </div>
      </form>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<script>
  $('#body').addClass('login-page');
</script>