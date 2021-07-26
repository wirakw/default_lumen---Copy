<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

    <title>Dompet Aman - Media Portal</title>
    <style>
      html {
        position: relative;
        min-height: 80%;
      }

      .footer {
        position: absolute;
        bottom: 0;
        width: 100%;
        /* Set the fixed height of the footer here */
        height: 60px;
        /*line-height: 60px;*/
        background-color: #fff;
      }

      .nav-link {
        font-size: 1em;
      }

      main > .container {
        padding: 60px 15px 0;
      }

      .footer > .container {
        padding-right: 15px;
        padding-left: 15px;
      }

      code {
        font-size: 80%;
      }

      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      @media (min-width: 1200px) {
        .container, .container-lg, .container-md, .container-sm, .container-xl {
            max-width: 1380px;
        }
      }

      .bg-dark {
        background-color: #4d4d4d !important;
      }

      .main {
        margin-top: 73px;
        margin-bottom: 70px;
      }

      .navbar-dark .navbar-nav .nav-link {
        color: rgba(255,255,255,1);
      }

      .navbar-dark .navbar-nav .nav-link:focus, .navbar-dark .navbar-nav .nav-link:hover {
        color: rgb(232 98 41);
      }

      .bg-dark {
        background-color: #4D4D4D !important;
      }

      .dropdown-menu {
        min-width: 10rem;
        left: -100px;
        background-color: #666666;
      }

      .dropdown-toggle::after {
        display: inline-block;
        margin-left: .0px; 
        vertical-align: .255em;
        content: "";
        border-top: .3em solid;
        border-right: .3em solid transparent;
        border-bottom: 0;
        border-left: .3em solid transparent;
      }

      .img-profile-header {
        width: 30px;
        height: 30px;
        background-position:center center;
        background-repeat: no-repeat;
      }

      .dropdown-item {
        color: #fff;
      }

      .dropdown-item:focus, .dropdown-item:hover {
       color: #fff;
       background-color: #4d4d4d;
      }

      hr {
        background-color: #fff;
        /*margin-right: 45px;
        margin-left: 26px;*/
        margin-top: 0.5rem;
        margin-bottom: 0.5rem;
        border: 0;
        border-top: 1px solid rgba(0,0,0,.1);
      }

      .btn-warning {
        color: #fff;
        background-color: #F26300 !important;
        border-color: #fff;
      }

      .btn-warning:hover {
        color: #212529;
      }

    </style>
  </head>
  <body class="d-flex flex-column h-100">
    <header>
    <!-- Fixed navbar -->
      <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a href="http://dompetaman.com/home" class="navbar-brand">
          <img src="https://stagingpembayaran.dompetaman.com/assets/image/logo-white.png" alt="Logo Dompet Aman">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item ml-5 mr-3 font-weight-bold">
              <a class="nav-link text-white" href="http://dompetaman.com/about">About</a>
            </li>
            <li class="nav-item ml-5 font-weight-bold mr-3">
              <a class="nav-link text-white" href="http://dompetaman.com/category/news">News</a>
            </li>
            <li class="nav-item ml-5 font-weight-bold mr-3">
              <a class="nav-link text-white" href="https://stagingpembayaran.dompetaman.com/">Marketplace</a>
            </li>
            <!-- <li class="nav-item ml-5 font-weight-bold mr-3 d-md-none d-lg-block d-xl-none d-sm-none d-md-block">
              <a class="nav-link text-warning" href="http://dompetaman.com/midas">MIDAS</a>
            </li> -->
            <li class="nav-item ml-5 font-weight-bold mr-3 d-md-none d-lg-block d-xl-none d-sm-none d-md-block">
              <a class="nav-link text-success" href="http://dompetaman.com/bpjs">
                BPJS
              </a>
            </li>
          </ul>
          <div class="mt-2 mt-md-0 d-none d-sm-block">
            <ul class="navbar-nav">
              <!-- <li class="nav-item font-weight-bold mr-4">
                <a href="http://dompetaman.com/midas" class="nav-link text-warning">
                  MIDAS
                </a>
              </li> -->
              <li class="nav-item font-weight-bold mr-4">
                <a href="http://dompetaman.com/bpjs" class="nav-link text-success">
                  <img src="https://stagingpembayaran.dompetaman.com/assets/image/icon-bpjs.png" class="mr-1" alt=""> BPJS Kesehatan
                </a>
              </li>
              <li class="nav-item dropdown font-weight-bold mr-5">
                 <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-user-circle" style="font-size: 18pt;"></i>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item"  style="width: 185px;" href="https://stagingpembayaran.dompetaman.com/login">Login Member <i class="fa fa-arrow-right mt-1 float-right"></i></a><hr>
                  <a class="dropdown-item"  style="width: 185px;" href="https://staging-merchant.dompetaman.com/Login">Login Merchant <i class="fa fa-arrow-right mt-1 float-right"></i></a><hr>
                  <a class="dropdown-item"  style="width: 185px;" href="https://staging-merchant.dompetaman.com/Login">Login Admin <i class="fa fa-arrow-right mt-1 float-right"></i></a><hr>
                  <a class="dropdown-item"  style="width: 185px;" href="https://stagingpembayaran.dompetaman.com/registrasi">Sign Up <i class="fa fa-arrow-right float-right mt-1"></i></a>
              <small class="dropdown-item" style="font-size: 7pt;">Dompet aman membantu <br>Anda meraih aspirasi hidup</small>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>

    <div class="container" style="margin-top: 140px">
      <div class="row justify-content-md-center">
        <div class="col-md-6">
          <div class="card shadow p-2 mb-4 bg-white rounded">
            <div class="card-body">
            <form id="form" method="POST">
                <input type="hidden" name="token" id="token" value="{{ request()->get('token') }}">
              </form>
                <!-- ini harusnya jadi ajax response-->
              <div id="message" class="mb-3 text-center"></div> 
            </div>
          </div>
        </div>
      </div>
    </div>

    <footer class="footer mt-auto">
      <div class="ml-4 mr-4">
        <div class="row">
          <div class="col-md-9">
            <img src="https://stagingpembayaran.dompetaman.com/assets/image/logo-hitam.png" style="max-width: 200px;" class="rounded d-none d-sm-block" alt="...">
          </div>
          <div class="col-md-3">
            <table class="table table-borderless">
              <tr>
                <td>
                  <a href="https://www.facebook.com/Dompet-Aman-106261581164311/" class="text-decoration-none"><img src="https://stagingpembayaran.dompetaman.com/assets/image/fb.png" class="rounded" alt="..." style="max-width: 30px;"></a>
                </td>
                <td>
                  <a href="https://www.instagram.com/dompetaman/" class="text-decoration-none"><img src="https://stagingpembayaran.dompetaman.com/assets/image/ig.png" class="rounded" alt="..." style="max-width: 30px;"></a>
                </td>
                <td>
                  <a href="https://twitter.com/AmanDompet" class="text-decoration-none"><img src="https://staging-merchant.dompetaman.com/assets/img/twiter.png" class="rounded" alt="..." style="max-width: 30px;"></a>
                </td>
                <td>
                  <a href="https://www.linkedin.com/in/dompet-aman-294b261b7" class="text-decoration-none"><img src="https://stagingpembayaran.dompetaman.com/assets/image/linkin.png" class="rounded" alt="..." style="max-width: 30px;"></a>
                </td>
                <!-- <td>
                  <img src="assets/img/up.png" class="rounded" alt="..." style="max-width: 30px;">
                </td> -->
              </tr>
            </table>
          </div>
        </div>
        <hr style="border: 0.25px solid #909090">
        <div class="row">
          <div class="col-md-4">
            <p class="text-secondary">2020 <a class="text-warning text-decoration-none" href="http://dompetaman.com/home">Dompet Aman</a> | All rights reserved.</p>
            <small class="text-secondary">cs@dompetaman.com | 021 2922 0855</small>
            <p class="text-secondary mt-3">
              Dompet Aman adalah merek milik PT Amanah Medivest Gemilang. <br>
              Terdaftar pada Direktorat Jendral Kekayaan Intelektual Republik Indonesia
            </p>
          </div>
          <div class="col-md-2 col-sm-6 col-6">
            <ul class="text-secondary list-unstyled">
              <li><a href="http://dompetaman.com/about" class="text-secondary">Financial</a></li>
              <li><a href="http://dompetaman.com/about" class="text-secondary">Health</a></li>
              <li><a href="http://dompetaman.com/about" class="text-secondary">Lifestyle</a></li>
              <li><a href="http://dompetaman.com/about" class="text-secondary">Social</a></li>
            </ul>
          </div>
          <div class="col-md-2 col-sm-6 col-6">
            <ul class="text-secondary list-unstyled">
              <li><a href="http://dompetaman.com/home" class="text-secondary">Beranda</a></li>
              <li><a href="http://dompetaman.com/about" class="text-secondary">Mengenai</a></li>
              <li><a href="http://dompetaman.com/category/news" class="text-secondary">Berita</a></li>
              <!-- <li><a href="#" class="text-secondary">Marketplace</a></li> -->
            </ul>
          </div>
          <div class="col-md-2 col-sm-6 col-6">
            <ul class="text-secondary list-unstyled">
              <li><a href="http://dompetaman.com/dompet-aman/" class="text-secondary">Pusat Bantuan</a></li>
              <li><a href="http://dompetaman.com/contact" class="text-secondary">Kontak</a></li>
              <li><a href="http://dompetaman.com/syarat-dan-ketentuan/" class="text-secondary">Syarat & Ketentuan</a></li>
              <li><a href="http://dompetaman.com/kebijakan-privasi/" class="text-secondary">Kebijakan Privasi</a></li>
            </ul>
          </div>
        </div>
        <hr style="border : 1px solid #F26300">
      </div>
    </footer>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function(){
            var values = {
            'token': document.getElementById('token').value,
            };
            $.ajax({ 
                type: "POST",
                url: $('#form').attr('action'),
                data: values,
                context: document.body,
                success: function(data){
                    $('#message').html(data).fadeIn('slow');
                }});
            });
    </script>
  </body>
</html>