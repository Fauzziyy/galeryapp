@extends('template.master')

@section('content')
    <div class="container mt-5" style="font-family: 'Poppins', sans-serif;">
        <div class="text-center">
            <h3 style="font-family: 'Poppins', sans-serif; font-weight: 600;">WELCOME TO GALERY </h3>
        </div>
        @if (Auth::check() == true)
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahFoto">
                Tambah Foto
            </button>
            <!-- Modal -->
            <div class="modal fade" id="tambahFoto" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Foto</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('foto.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Foto</label>
                                    <input class="form-control" type="file" id="formFile" name="foto">
                                </div>
                                <div class="mb-3">
                                    <label for="">Judul</label>
                                    <input type="text" class="form-control" name="judul">
                                </div>
                                <div class="mb-3">
                                    <label for="">Deskripsi</label>
                                    <textarea name="deskripsi" class="form-control" id="" cols="30" rows="10"></textarea>
                                </div>
                                <label for="Status"></label>
                                <select name="status" id="" class="form-control">
                                    <option value="1">Publish</option>
                                    <option value="0">Draft</option>
                                </select>
                                <label for="">Album Foto</label>
                                <select name="album_id" id="" class="form-control">
                                    @foreach ($album as $item)
                                        <option value="{{ $item->id }}">{{ $item->album }}</option>
                                    @endforeach
                                </select>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahAlbumFoto">
                Tambah Album Foto
            </button>
            <!-- Modal -->
            <div class="modal fade" id="tambahAlbumFoto" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Foto</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('album.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Album</label>
                                    <input class="form-control" type="text" name="album">
                                </div>
                                <div class="mb-3">
                                    <label for="">Deskripsi</label>
                                    <input type="text" class="form-control" name="deskripsi">
                                </div>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <img src="..." id="foto" style="width:300px; height:250px;" class="img-fluid"
                                    alt="...">
                            </div>
                            <div class="col">
                                <label for="">Dibuat Oleh : </label>
                                <label for="" class="form-label" id="name">author</label>
                                <hr>
                                <label for="" class="form-label" id="judul">Caption</label>
                                <hr>
                                <label for="" class="form-label" id="deskripsi">Deskripsi</label>
                                <hr>
                                @if (Auth::check() == true)
                                    <label for="">Komentar</label>
                                    <div class="input-group">
                                        <input type="hidden" name="id" id="idFoto">
                                        <textarea name="komentar" id="isiKomentar" class="form-control" id="" cols="30" rows="2"></textarea>
                                        <button class="btn btn-primary" type="button" id="btnKomentar">Kirim</button>
                                    </div>
                                    <hr>
                                    <div id="komentarAll">
                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-start ">
            @if ($fotos->isEmpty())
                <div class="alert alert-danger">Tidak Ada Foto</div>
            @endif
            @foreach ($fotos as $item)
                <div class="col-auto">
                    <div class="card mt-2" style="width: 18rem;">
                        <img src="{{ asset('storage/images/' . $item->foto) }}"
                            style="text-align: center; width: 285px; height: 200px;" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->judul }}</h5>
                            <p class="short-text">{{ Str::limit($item->deskripsi, 25, '....') }}</p>
                            <p class="full-text d-none">{{ $item->deskripsi }}</p>
                            <a href="javascript:void(0)" class="btn btn-link read-more">More</a>

                            <hr>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary show" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal" data-judul="{{ $item->judul }}"
                                    data-deskripsi="{{ $item->deskripsi }}" data-foto="{{ $item->foto }}"
                                    data-nama="{{ $item->user->nama_lengkap }}" data-id="{{ $item->id }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24">
                                        <path fill="#fff"
                                            d="M12 9a3 3 0 0 0-3 3a3 3 0 0 0 3 3a3 3 0 0 0 3-3a3 3 0 0 0-3-3m0 8a5 5 0 0 1-5-5a5 5 0 0 1 5-5a5 5 0 0 1 5 5a5 5 0 0 1-5 5m0-12.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5" />
                                    </svg>
                                </button>
                                @if (Auth::check() == true)
                                    @if ($item->likes->contains('users_id', Auth::id()) == false)
                                        {{-- button like --}}
                                        <button type="button" class="btn btn-outline-dark like"
                                            data-id="{{ $item->id }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 48 48">
                                                <path fill="none" stroke="#000" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="4"
                                                    d="M15 8C8.925 8 4 12.925 4 19c0 11 13 21 20 23.326C31 40 44 30 44 19c0-6.075-4.925-11-11-11c-3.72 0-7.01 1.847-9 4.674A10.99 10.99 0 0 0 15 8" />
                                            </svg>
                                            <label for="" class="likeLabel" data-id="{{ $item->id }}">{{ $item->likes->count() }}</label>
                                        </button>
                                    @else
                                        {{-- button unlike --}}
                                        <button type="button" class="btn btn-outline-dark unlike"
                                            data-id="{{ $item->id }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 48 48">
                                                <path fill="#f44336"
                                                    d="M34 9c-4.2 0-7.9 2.1-10 5.4C21.9 11.1 18.2 9 14 9C7.4 9 2 14.4 2 21c0 11.9 22 24 22 24s22-12 22-24c0-6.6-5.4-12-12-12" />
                                            </svg>
                                            <label for="" class="likeLabel" data-id="{{ $item->id }}">{{ $item->likes->count() }}</label>
                                        </button>
                                    @endif
                                @endif

                                <button type="button" class="btn btn-warning">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24">
                                        <mask id="lineMdChatFilled0">
                                            <g fill="none" stroke="#fff" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="2">
                                                <path fill="#fff" fill-opacity="0" stroke-dasharray="72"
                                                    stroke-dashoffset="72"
                                                    d="M3 19.5v-15.5c0 -0.55 0.45 -1 1 -1h16c0.55 0 1 0.45 1 1v12c0 0.55 -0.45 1 -1 1h-14.5Z">
                                                    <animate fill="freeze" attributeName="fill-opacity" begin="0.7s"
                                                        dur="0.5s" values="0;1" />
                                                    <animate fill="freeze" attributeName="stroke-dashoffset"
                                                        dur="0.6s" values="72;0" />
                                                </path>
                                                <path stroke="#000" stroke-dasharray="10" stroke-dashoffset="10"
                                                    d="M8 7h8">
                                                    <animate fill="freeze" attributeName="stroke-dashoffset"
                                                        begin="1.2s" dur="0.2s" values="10;0" />
                                                </path>
                                                <path stroke="#000" stroke-dasharray="10" stroke-dashoffset="10"
                                                    d="M8 10h8">
                                                    <animate fill="freeze" attributeName="stroke-dashoffset"
                                                        begin="1.5s" dur="0.2s" values="10;0" />
                                                </path>
                                                <path stroke="#000" stroke-dasharray="6" stroke-dashoffset="6"
                                                    d="M8 13h4">
                                                    <animate fill="freeze" attributeName="stroke-dashoffset"
                                                        begin="1.8s" dur="0.2s" values="6;0" />
                                                </path>
                                            </g>
                                        </mask>
                                        <rect width="24" height="24" fill="#2e2e2e"
                                            mask="url(#lineMdChatFilled0)" />
                                    </svg>
                                    <label for="" class="komentarLabel" data-id="{{ $item->id }}">{{ $item->komentar->count() }}</label>
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('.show').on('click', function() {
                var id = $(this).data('id');
                var judul = $(this).data('judul');
                var deskripsi = $(this).data('deskripsi');
                var author = $(this).data('nama');
                var foto = $(this).data('foto');
                $('#idFoto').val(id);
                $('#exampleModalLabel').text(judul);
                $('#foto').attr('src', "{{ asset('storage/images/') }}/" + foto);
                $('#name').text(author);
                let wrapText = deskripsi.match(/.{1,25}/g).join("<br>");
                $('#deskripsi').html(wrapText);
                $('#judul').text(judul);

                $.ajax({
                    url: "{{ route('Detailkomentar', ':id') }}".replace(':id', id),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "PUT",
                    data: {
                        id: id,
                    },
                    success: function(data) {

                        var html =
                            '<div style="max-height: 300px; overflow-y: auto; border: 1px solid #ccc; padding: 10px;">';
                        html += '<ul style="list-style-type: none; padding: 0;">';

                        for (var i = 0; i < data.data.length; i++) {
                            html +=
                                '<li style="margin-bottom: 10px; padding-bottom: 5px; border-bottom: 1px solid #ddd;">';
                            html += '<strong>' + data.data[i].user.nama_lengkap +
                                ':</strong><br>';
                            html += '<span>' + data.data[i].komentar + '</span>';
                            html += '</li>';
                        }

                        html += '</ul>';
                        html += '</div>';


                        //console.log(data.length);
                        $('#komentarAll').html(html);
                    }
                });
            });
            $('.like').on('click', function() {
                var id = $(this).data('id');
                $.ajax({
                    url: "{{ route('like') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: "POST",
                    data: {
                        id: id,
                    },
                    success: function() {
                        location.reload();
                    }
                });
            });
            $('.unlike').on('click', function() {
                var id = $(this).data('id');
                $.ajax({
                    url: "{{ route('unlike') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: "POST",
                    data: {
                        id: id,
                    },
                    success: function() {
                        location.reload();
                    }
                });
            });
            $('#btnKomentar').on('click', function() {
                var id = $('#idFoto').val();
                var komentar = $('#isiKomentar').val();
                $.ajax({
                    url: "{{ route('komentar') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: "POST",
                    data: {
                        id: id,
                        komentar: komentar,
                    },
                    success: function() {
                        location.reload();
                    }
                });
            });
            $(".read-more").click(function() {
                let cardText = $(this).prevAll(".short-text");
                let moreText = $(this).prevAll(".full-text");
                if (moreText.hasClass("d-none")) {
                    moreText.removeClass("d-none");
                    cardText.addClass("d-none");
                    $(this).text("Less");
                } else {
                    moreText.addClass("d-none");
                    cardText.removeClass("d-none");
                    $(this).text("More");
                }
            });
        });
    </script>

<script>
    function updateLikedanKomentar() {
        $(".likeLabel").each(function() {
            var id = $(this).data('id');
            var label = $(this);
            // alert(label);
            $.ajax({
                url: "{{ route('getUpdate') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: "POST",
                data: {
                    id: id,
                },
                success: function(response) {
                   label.text(response.likes);
                }
            });
        });
        $(".komentarLabel").each(function() {
            var id = $(this).data('id');
            var label = $(this);
            $.ajax({
                url: "{{ route('getUpdate') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: "POST",
                data: {
                    id: id,
                },
                success: function(response) {
                   label.text(response.komentar);
                }
            });
        });
    }
    
    setInterval(updateLikedanKomentar, 1000);
</script>
@endsection