<nav class="navbar navbar-expand-lg sticky-top" id="navbar">
  <a class="navbar-brand" href="<?= base_url(); ?>">
    <img src="<?= base_url('assets/images/favicon.png'); ?>" width="30" height="30" class="d-inline-block align-top" alt="">
    <span class="font-italic">Catalogue</span>
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item" id="home-link">
        <a class="nav-link" href="<?= base_url('/home'); ?>">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item" id="catalogue-link">
        <a class="nav-link" href="<?= base_url('/catalogue'); ?>">Catalogue</a>
      </li>
    </ul>
  </div>
</nav>