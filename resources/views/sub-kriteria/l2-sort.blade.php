@extends('template.BaseView')
@section('content')
    <div class="row">
        <div class="col">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Sub Kriteria C1.x</h6>
                </div>
                <div class="card-body">
                    @if (session()->has('pesan'))
                        {!! session()->get('pesan') !!}
                    @endif
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Jenjang Pendidikan</th>
                                    <th width="150px">Aksi</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Jenjang Pendidikan</th>
                                    <th width="150px">Aksi</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($c as $i)
                                    <tr>
                                        <td>{{ $i->name }}</td>
                                        <td>{{ $i->jenjang->kode }}</td>
                                        <td width="150px">
                                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                                                data-target="#modelEdit{{ $i->id }}">
                                                Edit
                                            </button>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#modelHapus{{ $i->id }}">
                                                Hapus
                                            </button>
                                        </td>
                                    </tr>

                                    {{-- EDIT DATA --}}
                                    <div class="modal fade" id="modelEdit{{ $i->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="modelTitleId{{ $i->id }}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <form action="/sub-kriteria/l2/put/{{ $i->id }}" method="POST">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Kriteria</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="form-group">
                                                            <label>Jenjang Pendidikan</label>
                                                            <select class="form-control" name="jenjang_id" id="jnu{{ $i->id }}" required>
                                                                {{-- Options will be loaded via AJAX --}}
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Level 1</label>
                                                            <input type="text" name="rollbackUrl"
                                                                value="{{ request()->url() }}" hidden>
                                                            <select class="form-control" name="l1_id" id="l1u{{ $i->id }}" required>
                                                                {{-- Options will be loaded via AJAX --}}
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Nama Level 2</label>
                                                            <input name="id" value="{{ $i->id }}" hidden>
                                                            <input type="text" name="name" class="form-control"
                                                                placeholder="C1.x - Nama" aria-describedby="helpId"
                                                                value="{{ $i->name }}" required>
                                                            <small id="helpId" class="text-muted">Isi dengan format C1.x
                                                                - Nama</small>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    {{-- HAPUS DATA --}}
                                    <div class="modal fade" id="modelHapus{{ $i->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="modelTitleId{{ $i->id }}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <form action="/sub-kriteria/l2/hapus/{{ $i->id }}" method="post">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Hapus Kriteria</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        @csrf
                                                        @method('delete')
                                                        Apa kamu yakin akan menghapus data <b>{{ $i->name }}</b>
                                                        penghapusan data bersifat permanen,
                                                        dan mungkin akan mengakibatkan kerusakan pada sistem yang
                                                        menggunakan data berelasi.
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-danger">Tetap Hapus
                                                            !!!</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-2">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Aksi</h4>
                    <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal"
                        data-target="#modelTambah">
                        Tambah Kriteria
                    </button>
                </div>
            </div>
            <hr>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Jenjang Pendidikan</h5>
                    <ul>
                        @foreach ($j as $i)
                            <li><a href="{{ url('/sub-kriteria/l2/' . $i->kode) }}">{{ $i->kode }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modelTambah" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="/sub-kriteria/l2/post" method="post">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Sub Kriteria</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label>Jenjang</label>
                            <select class="form-control" name="jenjang_id" id="jn" required>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Level 1</label>
                            <input type="text" name="rollbackUrl" value="{{ request()->url() }}" hidden>
                            <select class="form-control" name="l1_id" id="l1" required>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Nama Level 2</label>
                            <input type="text" name="name" class="form-control" placeholder="C1.x - Nama"
                                aria-describedby="helpId" required>
                            <small id="helpId" class="text-muted">Isi dengan format C1.x - Nama</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        // Setup AJAX with CSRF token
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Initial AJAX call to populate jenjang options
        $.ajax({
            type: 'POST',
            url: '{{ route('jn') }}',
            cache: false,
            success: function(msg) {
                $("#jn").html(msg);
                $("select[id^='jnu']").html(msg);
            }
        });

        // Event listener for change on jenjang select in tambah modal
        $("#jn").change(function() {
            var jenjang_id = $("#jn").val();
            $.ajax({
                type: 'POST',
                url: '{{ route('l1n') }}',
                data: { jenjang_id: jenjang_id },
                cache: false,
                success: function(msg) {
                    $("#l1").html(msg);
                }
            });
        });

        // Event listener for change on jenjang select in edit modals
        $('select[id^="jnu"]').each(function() {
            $(this).change(function() {
                var jenjang_id = $(this).val();
                var l1_id = $(this).attr('id').replace('jnu', 'l1u');
                $.ajax({
                    type: 'POST',
                    url: '{{ route('l1n') }}',
                    data: { jenjang_id: jenjang_id },
                    cache: false,
                    success: function(msg) {
                        $('#' + l1_id).html(msg);
                    }
                });
            });
        });
    });
</script>
@endsection
