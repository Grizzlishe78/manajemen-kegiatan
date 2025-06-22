<?php

namespace App\Livewire\Anggota;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Anggota;
use App\Models\Organisasi;

class Index extends Component
{
    use WithPagination;

    public $nama, $nim, $organisasi_id;
    public $selectedId;
    public $isModalOpen = false;

    public function render()
    {
        return view('livewire.anggota.index', [
            'anggota_list' => Anggota::with('organisasi')->latest()->paginate(5),
            'list_organisasi' => Organisasi::all(),
        ])->title('Manajemen Anggota');
    }

    public function openModal() { $this->isModalOpen = true; }
    public function closeModal() { $this->isModalOpen = false; $this->resetForm(); }

    private function resetForm()
    {
        $this->nama = '';
        $this->nim = '';
        $this->organisasi_id = '';
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
            'nim' => 'required|string|unique:anggota,nim,' . $this->selectedId,
            'organisasi_id' => 'required|exists:organisasi,id',
        ]);

        Anggota::updateOrCreate(['id' => $this->selectedId], [
            'nama' => $this->nama,
            'nim' => $this->nim,
            'organisasi_id' => $this->organisasi_id,
        ]);

        session()->flash('message', $this->selectedId ? 'Anggota berhasil diperbarui.' : 'Anggota berhasil dibuat.');
        $this->closeModal();
    }

    public function edit($id)
    {
        $anggota = Anggota::findOrFail($id);
        $this->selectedId = $id;
        $this->nama = $anggota->nama;
        $this->nim = $anggota->nim;
        $this->organisasi_id = $anggota->organisasi_id;
        $this->openModal();
    }

    public function delete($id)
    {
        Anggota::find($id)->delete();
        session()->flash('message', 'Anggota berhasil dihapus.');
    }
}