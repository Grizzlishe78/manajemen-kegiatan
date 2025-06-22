<?php

namespace App\Livewire\Laporan;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use App\Models\Kegiatan;
use App\Models\Organisasi;
use App\Models\Anggota;

class Index extends Component
{
    use WithPagination;

    #[Url(except: '')]
    public $filterOrganisasi = '';

   
    #[Url(except: '')]
    public $search = '';

    public function render()
    {
        $kegiatan = Kegiatan::with('organisasi')
            ->withCount('panitia')
            ->when($this->filterOrganisasi, fn($query) => $query->where('organisasi_id', $this->filterOrganisasi))
            
            ->when($this->search, function ($query) {
                $query->where('nama', 'like', '%'.$this->search.'%')
                      ->orWhere('nama_lokasi', 'like', '%'.$this->search.'%');
            })
            ->latest('tgl_pelaksanaan')
            ->paginate(10);

        return view('livewire.laporan.index', [
            'kegiatan_list' => $kegiatan,
            'total_kegiatan' => Kegiatan::count(),
            'total_anggota' => Anggota::count(),
            'list_organisasi' => Organisasi::all(),
        ])->title('Laporan & Dashboard');
    }
}