<?php

namespace App\Livewire\Organisasi;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Organisasi;

class Index extends Component
{
    use WithPagination;

    public $nama_organisasi, $jenis;
    public $selectedId;
    public $isModalOpen = false;

    public function render()
    {
        return view('livewire.organisasi.index', [
            'organisasi_list' => Organisasi::latest()->paginate(5)
        ])->title('Manajemen Organisasi');
    }

    public function openModal() { $this->isModalOpen = true; }
    public function closeModal() { $this->isModalOpen = false; $this->resetForm(); }

    private function resetForm()
    {
        $this->nama_organisasi = '';
        $this->jenis = '';
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
            'nama_organisasi' => 'required|string|max:255',
            'jenis' => 'required|string|max:100',
        ]);

        Organisasi::updateOrCreate(['id' => $this->selectedId], [
            'nama_organisasi' => $this->nama_organisasi,
            'jenis' => $this->jenis,
        ]);

        session()->flash('message', $this->selectedId ? 'Organisasi berhasil diperbarui.' : 'Organisasi berhasil dibuat.');
        $this->closeModal();
    }

    public function edit($id)
    {
        $organisasi = Organisasi::findOrFail($id);
        $this->selectedId = $id;
        $this->nama_organisasi = $organisasi->nama_organisasi;
        $this->jenis = $organisasi->jenis;
        $this->openModal();
    }

    public function delete($id)
    {
        Organisasi::find($id)->delete();
        session()->flash('message', 'Organisasi berhasil dihapus.');
    }
}