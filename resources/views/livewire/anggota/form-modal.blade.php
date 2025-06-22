<div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white rounded-lg shadow-xl p-8 w-full max-w-md">
        <h3 class="text-2xl font-bold mb-4">{{ $selectedId ? 'Edit' : 'Tambah' }} Anggota</h3>
        <form wire:submit.prevent="store">
            <div class="mb-4">
                <label for="nim" class="block text-gray-700">NIM</label>
                <input type="text" wire:model="nim" id="nim" class="w-full mt-1 px-4 py-2 border rounded-lg">
                @error('nim') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label for="nama" class="block text-gray-700">Nama Lengkap</label>
                <input type="text" wire:model="nama" id="nama" class="w-full mt-1 px-4 py-2 border rounded-lg">
                @error('nama') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label for="organisasi_id" class="block text-gray-700">Organisasi</label>
                <select wire:model="organisasi_id" id="organisasi_id" class="w-full mt-1 px-4 py-2 border rounded-lg">
                    <option value="">-- Pilih Organisasi --</option>
                    @foreach($list_organisasi as $organisasi)
                        <option value="{{ $organisasi->id }}">{{ $organisasi->nama_organisasi }}</option>
                    @endforeach
                </select>
                @error('organisasi_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="flex justify-end space-x-4 mt-6">
                <button type="button" wire:click="closeModal()" class="px-4 py-2 bg-gray-300 rounded-lg">Batal</button>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg">{{ $selectedId ? 'Update' : 'Simpan' }}</button>
            </div>
        </form>
    </div>
</div>