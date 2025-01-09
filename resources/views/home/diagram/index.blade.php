@extends('template.HomeView',['title'=>"Diagram Pencapaian"])
@section('content')


<main id="main">


    <!-- ======= About Us Section ======= -->
    <section>
        <div class="container">

            <div class="section-title">
                <h2>Diagram Pencapaian</h2>
                <p>Berikut ini adalah diagram pencapaian nilai asessmen setiap Program Studi di FTIK
                </p>
            </div>

            <div class="row">
                <div class="col">
                    <div class="card">
                        <canvas id="barChart" width="300" height="300"></canvas>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- End About Us Section -->


</main>
<!-- End #main -->
@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
<script>
    const diagram = {
        type: 'bar',
        data: {
            labels: ['Teknik Informatika', 'Sistem Informasi', 'Ilmu Komunikasi', 'Pariwisata'],
            labelsLink: ['http://localhost:8000/diagram/TI',
                'http://localhost:8000/diagram/SI', 'http://localhost:8000/diagram/IK',
                'http://localhost:8000/diagram/PW'
            ],
            datasets: [{
                label: 'Nilai Assesmen Tercapai',
                data: [<?= $ass['TI'] ?>, <?= $ass['SI'] ?>, <?= $ass['IK'] ?>, <?= $ass['PW'] ?>,

                ],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 205, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(201, 203, 207, 0.2)'
                ],
                borderColor: [
                    'rgb(255, 99, 132)',
                    'rgb(255, 159, 64)',
                    'rgb(255, 205, 86)',
                    'rgb(75, 192, 192)',
                    'rgb(54, 162, 235)',
                    'rgb(153, 102, 255)',
                    'rgb(201, 203, 207)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
        }

    }
    const ctx = document.getElementById('barChart');
    const myChart = new Chart(ctx, diagram);

    // const diagram2 = {
    //     type: 'radar',
    //     data: {
    //         labels: [
    //             'A. Kondisi Eksternal',
    //             'B. Profil Unit Pengelola Program Studi',
    //             'C.1. Visi, Misi, Tujuan dan Strategi',
    //             'C.2. Tata Pamong, Tata Kelola dan Kerjasama',
    //             'C.3. Mahasiswa',
    //             'C.4. Sumber Daya Manusia',
    //             'C.5. Keuangan, Sarana dan Prasarana',
    //             'C.6. Pendidikan',
    //             'C.7. Penelitian',
    //             'C.8. Pengabdian kepada Masyarakat',
    //             'C.9. Luaran dan Capaian Tridharma',
    //             'D. Suplemen Program Studi',
    //             'E. Rencana Pengembangan'
    //         ],
    //         datasets: [{
    //             label: 'Nilai Asesmen Tercapai - Chart 2',
    //             data: [3.0, 2.8, 2.6, 3.0, 3.2, 3.4, 3.6, 3.8, 4.0, 3.6, 3.4, 3.2, 3.0],
    //             backgroundColor: 'rgba(255, 99, 132, 0.2)',
    //             borderColor: 'rgba(255, 99, 132, 1)',
    //             borderWidth: 1,
    //             pointBackgroundColor: 'rgba(255, 99, 132, 1)'
    //         }]
    //     },
    //     options: {
    //         responsive: true,
    //         scales: {
    //             r: {
    //                 angleLines: {
    //                     display: false
    //                 },
    //                 suggestedMin: 0,
    //                 suggestedMax: 5
    //             }
    //         }
    //     }
    // };

    // const ctx2 = document.getElementById('radarChart2').getContext('2d');
    // new Chart(ctx2, diagram2);


    function clickableScale(canvas, click) {

        const height = myChart.scales.x.height
        const top = myChart.scales.x.top
        const bottom = myChart.scales.x.bottom
        const left = myChart.scales.x.left
        const right = myChart.scales.x.maxWidth / myChart.scales.x.ticks.length
        const DIFF = right + left

        // console.log(right);
        let resetCoordinates = canvas.getBoundingClientRect()

        const x = click.clientX - resetCoordinates.left;
        const y = click.clientY - resetCoordinates.top;
        // console.log(x);


        for (let i = 0; i < myChart.scales.x.ticks.length; i++) {

            if (x >= left + (right * i) && x <= DIFF + (right * i) && y >= top && y <= bottom) {
                // console.log(i);
                window.open(myChart.config.data.labelsLink[i])
            }
        }
    }

    ctx.addEventListener('click', (e) => {
        clickableScale(ctx, e)
        myChart.resize();
        myChart.update();
    })
</script>

@endsection