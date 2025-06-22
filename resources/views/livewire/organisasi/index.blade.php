<div>
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-bold text-gray-800">Manajemen Organisasi</h2>
        <button wire:click="create()" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Tambah Organisasi</button>
    </div>

    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('message') }}</span>
        </div>
    @endif

    @if($isModalOpen)
        @include('livewire.organisasi.form-modal')
    @endif

    <div class="bg-white p-6 rounded-lg shadow">
         <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600">Nama Organisasi</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600">Jenis</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($organisasi_list as $org)
                    <tr class="border-b">
                        <td class="py-3 px-4">{{ $org->nama_organisasi }}</td>
                        <td class="py-3 px-4">{{ $org->jenis }}</td>
                        <td class="py-3 px-4">
                            <button wire:click="edit({{ $org->id }})" class="text-indigo-600 hover:text-indigo-900 mr-2">Edit</button>
                            <button wire:click="delete({{ $org->id }})" wire:confirm="Yakin ingin menghapus data ini?" class="text-red-600 hover:text-red-900">Hapus</button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center py-4 text-gray-500">Belum ada data organisasi. Silakan tambahkan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
         </div>
         <div class="mt-4">
            {{ $organisasi_list->links() }}
         </div>
    </div>
</div>