<?php

namespace App\Livewire\Kegiatan;

use Livewire\Component;
use App\Models\Kegiatan;
use App\Models\Anggota;

class AturPanitia extends Component
{
    public Kegiatan $kegiatan;
    public $panitia_list;

    public $anggota_id, $jabatan;

    public function mount(Kegiatan $kegiatan)
    {
        $this->kegiatan = $kegiatan;
        $this->loadPanitia();
    }

    public function loadPanitia()
    {
        $this->panitia_list = $this->kegiatan->panitia()->get();
    }

    public function render()
    {
        $anggota_tersedia = Anggota::where('organisasi_id', $this->kegiatan->organisasi_id)
                                ->whereNotIn('id', $this->panitia_list->pluck('id'))
                                ->get();

        return view('livewire.kegiatan.atur-panitia', [
            'anggota_tersedia' => $anggota_tersedia
        ])->title('Atur Panitia: ' . $this->kegiatan->nama);
    }

    public function tambahPanitia()
    {
        $this->validate([
            'anggota_id' => 'required|exists:anggota,id',
            'jabatan' => 'required|string|max:100'
        ]);

        $this->kegiatan->panitia()->attach($this->anggota_id, ['jabatan' => $this->jabatan]);

        session()->flash('message', 'Panitia berhasil ditambahkan.');
        $this->reset(['anggota_id', 'jabatan']);
        $this->loadPanitia();
    }

    public function hapusPanitia($anggotaId)
    {
        $this->kegiatan->panitia()->detach($anggotaId);
        session()->flash('message', 'Panitia berhasil dihapus.');
        $this->loadPanitia(); 
    }
}