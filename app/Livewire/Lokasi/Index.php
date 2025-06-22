<?php

namespace App\Livewire\Lokasi;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Lokasi;

class Index extends Component
{
    use WithPagination;

    public $nama_lokasi, $alamat;
    public $selectedId;
    public $isModalOpen = false;

    public function render()
    {
        return view('livewire.lokasi.index', [
            'lokasi_list' => Lokasi::latest()->paginate(5)
        ])->title('Manajemen Lokasi');
    }

    public function openModal() { $this->isModalOpen = true; }
    public function closeModal() { $this->isModalOpen = false; $this->resetForm(); }

    private function resetForm()
    {
        $this->nama_lokasi = '';
        $this->alamat = '';
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
            'nama_lokasi' => 'required|string|max:255',
            'alamat' => 'required|string',
        ]);

        Lokasi::updateOrCreate(['id' => $this->selectedId], [
            'nama_lokasi' => $this->nama_lokasi,
            'alamat' => $this->alamat,
        ]);

        session()->flash('message', $this->selectedId ? 'Lokasi berhasil diperbarui.' : 'Lokasi berhasil dibuat.');
        $this->closeModal();
    }

    public function edit($id)
    {
        $lokasi = Lokasi::findOrFail($id);
        $this->selectedId = $id;
        $this->nama_lokasi = $lokasi->nama_lokasi;
        $this->alamat = $lokasi->alamat;
        $this->openModal();
    }

    public function delete($id)
    {
        Lokasi::find($id)->delete();
        session()->flash('message', 'Lokasi berhasil dihapus.');
    }
}