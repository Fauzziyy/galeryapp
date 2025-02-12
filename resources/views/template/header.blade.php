<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Bootstrap demo</title> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <a class="navbar-brand" href="#">Galery Fauzi</a>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    @if (Auth::check()== true)
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Album</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Like</a>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Beranda</a>
                    </li>
                    @endif
                   
                </ul>
                  <!-- Modal -->
                  <div class="modal fade" id="registrasi" data-bs-backdrop="static" data-bs-keyboard="false"
                  tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h1 class="modal-title fs-5" id="staticBackdropLabel">Registrasi</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal"
                                  aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                              <form action="{{ route ('users.store') }}" method="post">
                                  @csrf
                                  <div class="mb-3">
                                      <label for="exampleInputEmail1" class="form-label">Username</label>
                                      <input type="text" name="name" class="form-control">
                                  </div>
                                  
                                  <div class="mb-3">
                                      <label for="exampleInputEmail1" class="form-label">Email address</label>
                                      <input type="email" name="email" class="form-control">
                                  </div>
                                  
                                  <div class="mb-3">
                                      <label for="exampleInputPassword1" class="form-label">Password</label>
                                      <input type="password" name="password" class="form-control">
                                  <div class="mb-3">
                                      <label for="">Nama Lengkap</label>
                                      <input type="text" class="form-control" name="nama_lengkap">
                                  </div>
                                  <div class="mb-3">
                                      <label for="">Alamat</label>
                                      <textarea name="alamat" class="form-control" id="" cols="30" rows="10"></textarea>
                                  </div>
                                  </div>
                          </div>
                          <div class="modal-footer">
                              <button type="button" class="btn btn-secondary"
                                  data-bs-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-primary">Daftar</button>
                          </div>
                      </form>
                      </div>
                  </div>
              </div>
                <!-- Modal -->
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route ('users.login')}}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                                    <input type="email" name="email" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control">
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Login</button>
                            <!-- Button trigger modal -->
                        </form>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#registrasi">
                                Registrasi
                            </button>

                        </div>
                    </div>
                </div>
            </div>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success me-2" type="submit">Search</button>
                    @if (Auth::check()==true)
                    <input type="text" value="{{ Auth::user()->name }}" readonly class="form-control me-2">
                    <a class="btn btn-danger" href="{{ route('users.logout')}}">Logout</a>
                        
                    @else
                     <!-- Button trigger modal -->
                     <button type="button" class="btn btn-primary ml-2 me-2" data-bs-toggle="modal"
                     data-bs-target="#staticBackdrop">
                     Login
                 </button>
                 <button type="button" class="btn btn-success" data-bs-toggle="modal"
                 data-bs-target="#registrasi">
                 Registrasi
             </button>
                    @endif
                   
                  
                </form>
            </div>
        </div>
    </nav>

    @if ($errors->any())
    <div class="alert-container mt-1">
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif

@if (session('success'))
    <div class="container mt-1">
        <div class="alert alert-success" role="alert">{{ session('success') }}</div>
    </div>
@endif