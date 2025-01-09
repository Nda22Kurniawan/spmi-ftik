@extends('template.BaseView')
@section('content')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{ $element->l1->name }}</h4>
                <p class="card-text">{{ $element->l2->name }}</p>
                <p class="card-text">{{ $element->l3->name }}</p>
                <p class="card-text" id="level4-text">{{ $element->l4->name }}</p>
            </div>
        </div>
        <hr>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Unggah Berkas</h4>
                @if (session()->has('pesan'))
                {!! session()->get('pesan') !!}
                @endif
                <form action="/element/store-berkas" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Name Berkas</label>
                        <input type="text" name="element_id" value="{{ $element->id }}" hidden>
                        <input type="text" name="file_name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="file_link">Tautan Berkas</label>
                        <input type="url" class="form-control" name="file_link" id="file_link" placeholder="Masukkan tautan Google Drive" required>
                        <small id="helpId" class="text-muted">Masukkan tautan berkas dari Google Drive</small>
                    </div>
                    <hr>
                    <div class="form-group">
                        @if ($score->count() >= 1)
                        <label>Score</label>
                        @foreach ($score as $i)
                        <div class='form-check'>
                            <input class='form-check-input' type='radio' name='score' value='{{ $i->value }}' required>
                            <label class='form-check-label'>{!! $i->name !!}</label>
                        </div>
                        @endforeach
                        @else
                        <div class="form-group">
                            @if ($indikator)
                            {!! $indikator->dec !!}
                            @else
                            <p id="indikator-text">Tidak terdapat indikator penilaian.</p>
                            @endif
                            <hr>
                            <label>Score Input Manual</label>
                            <input type="text" class="form-control" name="score" required>
                            <small id="helpId" class="text-muted">Masukan nilai dengan menambahkan titik 3.50</small>
                        </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea name="dec" id="dec" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <button class="btn-primary btn-sm" type="submit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function() {
        CKEDITOR.replace('dec');
        
        function updateIndikator() {
            var level4Text = $('#level4-text').text();
            $('#indikator-text').text(level4Text);
        }

        updateIndikator();

        $('#level4-text').on('input', function() {
            updateIndikator();
        });
    });
</script>
@endsection
