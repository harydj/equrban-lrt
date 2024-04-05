<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl position-sticky blur shadow-blur mt-4 left-auto top-1 z-index-sticky" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page"><?= $Menu ?></li>
          </ol>
          <h6 class="font-weight-bolder mb-0"><?= $Menu ?></h6>
        </nav>
        <script>
          // Function to hide flash message after 5 seconds
          setTimeout(function(){
              document.getElementById('flashMessage').style.display = 'none';
          }, 5000); // 5000 milliseconds = 5 seconds
       </script>
        <?php if (isset($errors['id_penabung'])) : ?>
            <div class="alert alert-danger"><?= $errors['id_penabung'] ?></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('success')) : ?>
          <div id="flashMessage" class="badge bg-gradient-success" role="alert">
            <span class="alert-icon"><i class="ni ni-like-2"></i></span>
            <span class="alert-text"><strong>Berhasil! </strong><?= session()->getFlashdata('success') ?></span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>        
        <?php endif; ?>
        <?php if (session()->getFlashdata('edit_success')) : ?>
          <div id="flashMessage" class="badge bg-gradient-success" role="alert">
            <span class="alert-icon"><i class="ni ni-like-2"></i></span>
            <span class="alert-text"><strong>Berhasil! </strong><?= session()->getFlashdata('edit_success') ?></span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>        
        <?php endif; ?>
        <?php if (session()->getFlashdata('failed')) : ?>
          <div id="flashMessage" class="badge bg-gradient-danger" role="alert">
            <span class="alert-icon"><i class="ni ni-like-2"></i></span>
            <span class="alert-text"><strong>Gagal! </strong><?= session()->getFlashdata('failed') ?></span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>        
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')) : ?>
          <div id="flashMessage" class="badge bg-gradient-warning" role="alert">
            <span class="alert-icon"><i class="ni ni-like-2"></i></span>
            <span class="alert-text"><?= session()->getFlashdata('error') ?></span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>        
        <?php endif; ?>
        <!-- <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group">
              <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
              <input type="text" class="form-control" placeholder="Type here...">
            </div>
          </div>
        </div> -->
      </div>
    </nav>

<style>
    .btn-link i {
        font-size: 1.5rem; /* Adjust the font-size to make the icon larger */
    }
</style>