<?php

namespace App\Livewire\Kegiatan;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Kegiatan;
use App\Models\Organisasi;

class Index extends Component
{
    use WithPagination;

    public $nama, $tgl_pelaksanaan, $organisasi_id, $nama_lokasi;
    public $selectedId;
    public $isModalOpen = false;

    public function render()
    {
        return view('livewire.kegiatan.index', [
            'kegiatan_list' => Kegiatan::with('organisasi')->latest()->paginate(5),
            'list_organisasi' => Organisasi::all(),
        ])->title('Manajemen Kegiatan');
    }

    public function openModal() { $this->isModalOpen = true; }
    public function closeModal() { $this->isModalOpen = false; $this->resetForm(); }

    private function resetForm()
    {
        $this->nama = '';
        $this->tgl_pelaksanaan = '';
        $this->organisasi_id = '';
        $this->nama_lokasi = ''; 
        $this->selectedId = null;
    }

    public function create()
    {
        $this->resetForm();
        $this->openModal();
    }

    public function store()
    {
        $this->validate([
            'nama' => 'required|string|max:255',
            'tgl_pelaksanaan' => 'required|date',
            'organisasi_id' => 'required|exists:organisasi,id',
            'nama_lokasi' => 'required|string|max:255', 
        ]);

        Kegiatan::updateOrCreate(['id' => $this->selectedId], [
            'nama' => $this->nama,
            'tgl_pelaksanaan' => $this->tgl_pelaksanaan,
            'organisasi_id' => $this->organisasi_id,
            'nama_lokasi' => $this->nama_lokasi, 
        ]);

        session()->flash('message', $this->selectedId ? 'Kegiatan berhasil diperbarui.' : 'Kegiatan berhasil dibuat.');
        $this->closeModal();
    }

    public function edit($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        $this->selectedId = $id;
        $this->nama = $kegiatan->nama;
        $this->tgl_pelaksanaan = $kegiatan->tgl_pelaksanaan;
        $this->organisasi_id = $kegiatan->organisasi_id;
        $this->nama_lokasi = $kegiatan->nama_lokasi; // <-- Mengambil data nama_lokasi
        $this->openModal();
    }

    public function delete($id)
    {
        Kegiatan::find($id)->delete();
        session()->flash('message', 'Kegiatan berhasil dihapus.');
    }
}