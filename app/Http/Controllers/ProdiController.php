<?php

namespace App\Http\Controllers;

use App\Element;
use App\Jenjang;
use App\L1;
use App\Prodi;
use App\Target;
use Illuminate\Http\Request;

class ProdiController extends Controller
{
    public function index(Request $request)
    {
        $kode = basename($request->path());
        $prodi = Prodi::where('kode', $kode)->first();

        // Filter elemen yang tidak memiliki l4_id atau l4_id = 0
        $element = Element::where('prodi_id', $prodi->id)->where('l4_id', 0);
        $rendah = Element::where('prodi_id', $prodi->id)->where('score_hitung', '<', 0.5)->get();

        $target = [
            "l1" => Target::where("prodi_id", '=', $prodi->id)->where("l1_id", 1)->first(),
            "l2" => Target::where("prodi_id", '=', $prodi->id)->where("l1_id", 2)->first(),
            "l3" => Target::where("prodi_id", '=', $prodi->id)->where("l1_id", 3)->first(),
            "l4" => Target::where("prodi_id", '=', $prodi->id)->where("l1_id", 4)->first(),
            "l5" => Target::where("prodi_id", '=', $prodi->id)->where("l1_id", 5)->first(),
            "l6" => Target::where("prodi_id", '=', $prodi->id)->where("l1_id", 6)->first(),
            "l7" => Target::where("prodi_id", '=', $prodi->id)->where("l1_id", 7)->first(),
            "l8" => Target::where("prodi_id", '=', $prodi->id)->where("l1_id", 8)->first(),
            "l9" => Target::where("prodi_id", '=', $prodi->id)->where("l1_id", 9)->first(),
            "l10" => Target::where("prodi_id", '=', $prodi->id)->where("l1_id", 10)->first(),
            "l11" => Target::where("prodi_id", '=', $prodi->id)->where("l1_id", 11)->first(),
            "l12" => Target::where("prodi_id", '=', $prodi->id)->where("l1_id", 12)->first(),
            "l13" => Target::where("prodi_id", '=', $prodi->id)->where("l1_id", 13)->first(),
        ];

        $pencapaian = [
            "l1" => Element::where('prodi_id', $prodi->id)
                ->where('l1_id', 1)
                ->where('l4_id', 0)
                ->average('score_berkas'),
            "l2" => Element::where('prodi_id', $prodi->id)
                ->where('l1_id', 2)
                ->where('l4_id', 0)
                ->average('score_berkas'),
            "l3" => Element::where('prodi_id', $prodi->id)
                ->where('l1_id', 3)
                ->where('l4_id', 0)
                ->average('score_berkas'),
            "l4" => number_format(
                Element::where('prodi_id', $prodi->id)
                    ->where('l1_id', 4)
                    ->where('l4_id', 0)
                    ->average('score_berkas'),
                2
            ),
            "l5" => Element::where('prodi_id', $prodi->id)
                ->where('l1_id', 5)
                ->where('l4_id', 0)
                ->average('score_berkas'),
            "l6" => Element::where('prodi_id', $prodi->id)
                ->where('l1_id', 6)
                ->where('l4_id', 0)
                ->average('score_berkas'),
            "l7" => Element::where('prodi_id', $prodi->id)
                ->where('l1_id', 7)
                ->where('l4_id', 0)
                ->average('score_berkas'),
            "l8" => Element::where('prodi_id', $prodi->id)
                ->where('l1_id', 8)
                ->where('l4_id', 0)
                ->average('score_berkas'),
            "l9" => Element::where('prodi_id', $prodi->id)
                ->where('l1_id', 9)
                ->where('l4_id', 0)
                ->average('score_berkas'),
            "l10" => Element::where('prodi_id', $prodi->id)
                ->where('l1_id', 10)
                ->where('l4_id', 0)
                ->average('score_berkas'),
            "l11" => Element::where('prodi_id', $prodi->id)
                ->where('l1_id', 11)
                ->where('l4_id', 0)
                ->average('score_berkas'),
            "l12" => Element::where('prodi_id', $prodi->id)
                ->where('l1_id', 12)
                ->where('l4_id', 0)
                ->average('score_berkas'),
            "l13" => Element::where('prodi_id', $prodi->id)
                ->where('l1_id', 13)
                ->where('l4_id', 0)
                ->average('score_berkas'),
        ];

        $pencapaian2 = [
            "l1" => Element::where('prodi_id', $prodi->id)
                ->where('l1_id', 1)
                ->where('l4_id', 0)
                ->sum('score_hitung'),
            "l2" => Element::where('prodi_id', $prodi->id)
                ->where('l1_id', 2)
                ->where('l4_id', 0)
                ->sum('score_hitung'),
            "l3" => Element::where('prodi_id', $prodi->id)
                ->where('l1_id', 3)
                ->where('l4_id', 0)
                ->sum('score_hitung'),
            "l4" => number_format(
                Element::where('prodi_id', $prodi->id)
                    ->where('l1_id', 4)
                    ->where('l4_id', 0)
                    ->sum('score_hitung'),
                2
            ),
            "l5" => Element::where('prodi_id', $prodi->id)
                ->where('l1_id', 5)
                ->where('l4_id', 0)
                ->sum('score_hitung'),
            "l6" => Element::where('prodi_id', $prodi->id)
                ->where('l1_id', 6)
                ->where('l4_id', 0)
                ->sum('score_hitung'),
            "l7" => Element::where('prodi_id', $prodi->id)
                ->where('l1_id', 7)
                ->where('l4_id', 0)
                ->sum('score_hitung'),
            "l8" => Element::where('prodi_id', $prodi->id)
                ->where('l1_id', 8)
                ->where('l4_id', 0)
                ->sum('score_hitung'),
            "l9" => Element::where('prodi_id', $prodi->id)
                ->where('l1_id', 9)
                ->where('l4_id', 0)
                ->sum('score_hitung'),
            "l10" => Element::where('prodi_id', $prodi->id)
                ->where('l1_id', 10)
                ->where('l4_id', 0)
                ->sum('score_hitung'),
            "l11" => Element::where('prodi_id', $prodi->id)
                ->where('l1_id', 11)
                ->where('l4_id', 0)
                ->sum('score_hitung'),
            "l12" => Element::where('prodi_id', $prodi->id)
                ->where('l1_id', 12)
                ->where('l4_id', 0)
                ->sum('score_hitung'),
            "l13" => Element::where('prodi_id', $prodi->id)
                ->where('l1_id', 13)
                ->where('l4_id', 0)
                ->sum('score_hitung'),
        ];

        return view('penilaian.index', [
            'p' => $prodi,
            'e' => $element->get(),
            'count_element' => $element->count(),
            'count_berkas' => $element->sum("count_berkas"),
            'score_hitung' => number_format($element->sum("score_hitung") / 4, 2),
            'alert' => $rendah,
            'terakreditas' => $element->where('status_akreditasi', "Y")->get(),
            'unggul' => $element->where('status_unggul', "Y")->get(),
            'baik' => $element->where('status_baik', "Y")->get(),
            'target' => $target,
            'pencapaian' => $pencapaian,
            'pencapaian2' => $pencapaian2,
        ]);
    }
}
