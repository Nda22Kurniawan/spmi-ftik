@extends('template.HomeView',['title'=> $p ? $p->name : ''])
@section('content')

<main id="main">

    <!-- ======= About Us Section ======= -->
    <section>
        <div class="container">

            <div class="section-title">
                <h2>{{ $p ? $p->name : 'Default Title' }}</h2>
            </div>

            <div class="row">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Element</th>
                                <th width="150px">Berkas</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No.</th>
                                <th>Element</th>
                                <th width="150px">Berkas</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach ($e as $i)
                            <tr>
                                <td>{{ $no }}</td>
                                <td>
                                    <b>{{ $i->l1->name ?? '' }}</b><br>
                                    @if($i->l2_id != 0)
                                    {{ $i->l2->name ?? '' }}<br>
                                    @endif
                                    @if($i->l3_id != 0)
                                    {{ $i->l3->name ?? '' }}<br>
                                    @endif
                                    @if($i->l4_id != 0)
                                    {{ $i->l4->name ?? '' }}<br>
                                    @endif
                                    {!! $i->indikator->dec ?? '' !!}
                                </td>
                                <td>
                                    <div class="dropdown open">
                                        <button class="btn btn-primary dropdown-toggle" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Berkas
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="triggerId">
                                            <a class="dropdown-item" href="{{ url('tabel/berkas/' . $i->id) }}">Lihat
                                                Berkas ({{ $i->count_berkas }})</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php $no++; ?>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </section>
    <!-- End About Us Section -->

</main>
<!-- End #main -->
@endsection