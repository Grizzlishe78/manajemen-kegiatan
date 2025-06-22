<div>
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-bold text-gray-800">Manajemen Anggota</h2>
        <button wire:click="create()" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Tambah Anggota</button>
    </div>

    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('message') }}</span>
        </div>
    @endif

    @if($isModalOpen)
        @include('livewire.anggota.form-modal')
    @endif

    <div class="bg-white p-6 rounded-lg shadow">
         <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-3 px-4 text-left">NIM</th>
                        <th class="py-3 px-4 text-left">Nama</th>
                        <th class="py-3 px-4 text-left">Organisasi</th>
                        <th class="py-3 px-4 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($anggota_list as $anggota)
                    <tr class="border-b">
                        <td class="py-3 px-4">{{ $anggota->nim }}</td>
                        <td class="py-3 px-4">{{ $anggota->nama }}</td>
                        <td class="py-3 px-4">{{ $anggota->organisasi->nama_organisasi }}</td>
                        <td class="py-3 px-4">
                            <button wire:click="edit({{ $anggota->id }})" class="text-indigo-600 hover:text-indigo-900 mr-2">Edit</button>
                            <button wire:click="delete({{ $anggota->id }})" wire:confirm="Yakin ingin menghapus data ini?" class="text-red-600 hover:text-red-900">Hapus</button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-4">Belum ada data anggota.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
         </div>
         <div class="mt-4">{{ $anggota_list->links() }}</div>
    </div>
</div>