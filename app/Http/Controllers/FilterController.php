<?php
use App\Models\Kecamatan;
use App\Models\Desa;
use App\Models\Lembaga;
use App\Models\Santri;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    public function getKecamatan()
    {
        return response()->json(Kecamatan::all());
    }

    public function getDesa($kecamatan)
    {
        return response()->json(Desa::where('kecamatan_id', $kecamatan)->get());
    }

    public function getLembaga($desa)
    {
        return response()->json(Lembaga::where('desa_id', $desa)->get());
    }

    public function filterData(Request $request)
    {
        $query = Santri::query();
        
        if ($request->has('kecamatan')) {
            $query->whereHas('lembaga.desa', function ($q) use ($request) {
                $q->where('kecamatan_id', $request->kecamatan);
            });
        }

        if ($request->has('desa')) {
            $query->whereHas('lembaga', function ($q) use ($request) {
                $q->where('desa_id', $request->desa);
            });
        }

        if ($request->has('lembaga')) {
            $query->where('lembaga_id', $request->lembaga);
        }

        return response()->json($query->get());
    }
}
