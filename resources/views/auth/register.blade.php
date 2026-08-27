<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>WargaKita - Daftar Warga</title>
  <link href="{{ asset('https://startbootstrap.github.io/startbootstrap-sb-admin-2/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="{{ asset('https://startbootstrap.github.io/startbootstrap-sb-admin-2/css/sb-admin-2.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/wargakita.css') }}" rel="stylesheet">
</head>
<body class="bg-wk-gradient">
  <div class="container">
    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <div class="row">
          <div class="col-lg-5 d-none d-lg-flex bg-wk-side">
            <i class="fas fa-people-roof"></i>
          </div>
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-1">Daftar Akun Warga</h1>
                <p class="small text-gray-500 mb-4">Data akan diverifikasi oleh pengurus RT setelah pendaftaran</p>
              </div>
              <form action="{{ route('register.save') }}" method="POST" class="user">
                @csrf
                <div class="form-group row">
                  <div class="col-sm-6">
                    <input name="name" type="text" class="form-control form-control-user @error('name')is-invalid @enderror" placeholder="Nama Lengkap" value="{{ old('name') }}">
                    @error('name')<span class="invalid-feedback">{{ $message }}</span>@enderror
                  </div>
                  <div class="col-sm-6">
                    <input name="nik" type="text" class="form-control form-control-user @error('nik')is-invalid @enderror" placeholder="NIK" value="{{ old('nik') }}">
                    @error('nik')<span class="invalid-feedback">{{ $message }}</span>@enderror
                  </div>
                </div>
                <div class="form-group">
                  <input name="email" type="email" class="form-control form-control-user @error('email')is-invalid @enderror" placeholder="Alamat Email" value="{{ old('email') }}">
                  @error('email')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>
                <div class="form-group row">
                  <div class="col-sm-6">
                    <input name="no_hp" type="text" class="form-control form-control-user @error('no_hp')is-invalid @enderror" placeholder="No. HP" value="{{ old('no_hp') }}">
                    @error('no_hp')<span class="invalid-feedback">{{ $message }}</span>@enderror
                  </div>
                  <div class="col-sm-6">
                    <select name="jenis_kelamin" class="form-control form-control-user @error('jenis_kelamin')is-invalid @enderror">
                      <option value="" disabled selected>Jenis Kelamin</option>
                      <option value="Laki-laki" {{ old('jenis_kelamin')=='Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                      <option value="Perempuan" {{ old('jenis_kelamin')=='Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    @error('jenis_kelamin')<span class="invalid-feedback">{{ $message }}</span>@enderror
                  </div>
                </div>
                <div class="form-group">
                  <textarea name="alamat" class="form-control @error('alamat')is-invalid @enderror" rows="2" placeholder="Alamat lengkap / nomor rumah">{{ old('alamat') }}</textarea>
                  @error('alamat')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input name="password" type="password" class="form-control form-control-user @error('password')is-invalid @enderror" placeholder="Password">
                    @error('password')<span class="invalid-feedback">{{ $message }}</span>@enderror
                  </div>
                  <div class="col-sm-6">
                    <input name="password_confirmation" type="password" class="form-control form-control-user" placeholder="Ulangi Password">
                  </div>
                </div>
                <button type="submit" class="btn btn-primary btn-user btn-block">Daftar</button>
              </form>
              <hr>
              <div class="text-center">
                <a class="small" href="{{ route('login') }}">Sudah punya akun? Login</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="{{ asset('https://startbootstrap.github.io/startbootstrap-sb-admin-2/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('https://startbootstrap.github.io/startbootstrap-sb-admin-2/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('https://startbootstrap.github.io/startbootstrap-sb-admin-2/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
  <script src="{{ asset('https://startbootstrap.github.io/startbootstrap-sb-admin-2/js/sb-admin-2.min.js') }}"></script>
</body>
</html>
