@extends('template.BaseView')
@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Cari Berkas</h4>
                    <form action="{{ url('/berkas/hasil') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Jenjang</label>
                            <select class="form-control" name="jenjang_id" id="jen" required>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Prodi</label>
                            <select class="form-control" name="prodi_id" id="pro" required>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Level 1</label>
                            <select class="form-control" name="l1_id[]" id="l1" multiple="multiple">
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Level 2</label>
                            <select class="form-control" name="l2_id[]" id="l2" multiple="multiple">
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Level 3</label>
                            <select class="form-control" name="l3_id[]" id="l3" multiple="multiple">
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Level 4</label>
                            <select class="form-control" name="l4_id[]" id="l4" multiple="multiple">
                            </select>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary btn-sm" type="submit">Cari Document</button>
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
            // Initialize Select2
            $('#jen, #pro, #l1, #l2, #l3, #l4').select2();

            // Set up AJAX headers for CSRF token
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Load Jenjang options
            $.ajax({
                type: 'POST',
                url: '{{ route('getJen') }}',
                cache: false,
                success: function(response) {
                    $("#jen").html(response);
                }
            });

            // Event listener for Jenjang change
            $("#jen").change(function() {
                var jenjang_id = $(this).val();
                $.ajax({
                    type: 'POST',
                    url: '{{ route('getPro') }}',
                    data: { jenjang_id: jenjang_id },
                    cache: false,
                    success: function(response) {
                        $("#pro").html(response);
                    }
                });
            });

            // Event listener for Prodi change
            $("#pro").change(function() {
                var jenjang_id = $("#jen").val();
                $.ajax({
                    type: 'POST',
                    url: '{{ route('l1') }}',
                    data: { jenjang_id: jenjang_id },
                    cache: false,
                    success: function(response) {
                        $("#l1").html(response);
                    }
                });
            });

            // Event listener for Level 1 change
            $("#l1").change(function() {
                var l1_id = $(this).val();
                $.ajax({
                    type: 'POST',
                    url: '{{ route('l2') }}',
                    data: { l1_id: l1_id },
                    cache: false,
                    success: function(response) {
                        $("#l2").html(response);
                    }
                });
            });

            // Event listener for Level 2 change
            $("#l2").change(function() {
                var l2_id = $(this).val();
                $.ajax({
                    type: 'POST',
                    url: '{{ route('l3') }}',
                    data: { l2_id: l2_id },
                    cache: false,
                    success: function(response) {
                        $("#l3").html(response);
                    }
                });
            });

            // Event listener for Level 3 change
            $("#l3").change(function() {
                var l3_id = $(this).val();
                $.ajax({
                    type: 'POST',
                    url: '{{ route('l4') }}',
                    data: { l3_id: l3_id },
                    cache: false,
                    success: function(response) {
                        $("#l4").html(response);
                    }
                });
            });
        });
    </script>
@endsection
