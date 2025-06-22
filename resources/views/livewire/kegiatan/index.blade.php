<div>
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-bold text-gray-800">Manajemen Kegiatan</h2>
        <button wire:click="create()" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Tambah Kegiatan</button>
    </div>

    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('message') }}</span>
        </div>
    @endif

    @if($isModalOpen)
        @include('livewire.kegiatan.form-modal')
    @endif

    <div class="bg-white p-6 rounded-lg shadow">
         <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-3 px-4 text-left">Nama Kegiatan</th>
                        <th class="py-3 px-4 text-left">Penyelenggara</th>
                        <th class="py-3 px-4 text-left">Tgl Pelaksanaan</th>
                        <th class="py-3 px-4 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kegiatan_list as $kegiatan)
                    <tr class="border-b">
                        <td class="py-3 px-4">{{ $kegiatan->nama }}</td>
                        <td class="py-3 px-4">{{ $kegiatan->organisasi->nama_organisasi }}</td>
                        <td class="py-3 px-4">{{ \Carbon\Carbon::parse($kegiatan->tgl_pelaksanaan)->format('d M Y') }}</td>
                        <td class="py-3 px-4">
                            <a href="{{ route('kegiatan.panitia', $kegiatan->id) }}" class="text-green-500 hover:text-green-700 mr-2">Atur Panitia</a>
                            <button wire:click="edit({{ $kegiatan->id }})" class="text-indigo-600 hover:text-indigo-900 mr-2">Edit</button>
                            <button wire:click="delete({{ $kegiatan->id }})" wire:confirm="Yakin ingin menghapus data ini?" class="text-red-600 hover:text-red-900">Hapus</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
         </div>
         <div class="mt-4">{{ $kegiatan_list->links() }}</div>
    </div>
</div>