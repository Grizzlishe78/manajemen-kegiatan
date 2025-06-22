<div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" x-data @click.self="$wire.closeModal()">
    <div class="bg-white rounded-lg shadow-xl p-8 w-full max-w-md">
        <h3 class="text-2xl font-bold mb-4">{{ $selectedId ? 'Edit' : 'Tambah' }} Organisasi</h3>
        <form wire:submit.prevent="store">
            <div class="mb-4">
                <label for="nama_organisasi" class="block text-gray-700 text-sm font-bold mb-2">Nama Organisasi</label>
                <input type="text" wire:model="nama_organisasi" id="nama_organisasi" placeholder="cth: BEM Fakultas Teknik"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('nama_organisasi') <span class="text-red-500 text-xs italic">{{ $message }}</span> @enderror
            </div>
            
            <div class="mb-6">
                <label for="jenis" class="block text-gray-700 text-sm font-bold mb-2">Jenis</label>
                <input type="text" wire:model="jenis" id="jenis" placeholder="cth: Organisasi Mahasiswa"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('jenis') <span class="text-red-500 text-xs italic">{{ $message }}</span> @enderror
            </div>
            
            <div class="flex items-center justify-end space-x-4">
                <button type="button" wire:click="closeModal()" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Batal
                </button>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    {{ $selectedId ? 'Update' : 'Simpan' }}
                </button>
            </div>
        </form>
    </div>
</div>