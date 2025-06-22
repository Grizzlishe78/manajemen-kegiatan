<div>
    <h2 class="text-3xl font-bold mb-6 text-gray-800">Dashboard</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-gray-500 text-sm font-medium">Total Kegiatan</h3>
            <p class="text-3xl font-bold text-gray-800 mt-2">{{ $total_kegiatan }}</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-gray-500 text-sm font-medium">Total Anggota</h3>
            <p class="text-3xl font-bold text-gray-800 mt-2">{{ $total_anggota }}</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-gray-500 text-sm font-medium">Organisasi Terdaftar</h3>
            <p class="text-3xl font-bold text-gray-800 mt-2">{{ $list_organisasi->count() }}</p>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="text-xl font-bold text-gray-800 mb-4">Laporan Kegiatan</h3>

        <div class="flex space-x-4 mb-4">
            <input wire:model.live.debounce.300ms="search" type="text" placeholder="Cari nama kegiatan atau lokasi..." class="w-full md:w-1/2 px-4 py-2 border rounded-lg">
            <select wire:model.live="filterOrganisasi" class="px-4 py-2 border rounded-lg">
                <option value="">Semua Organisasi</option>
                @foreach($list_organisasi as $org)
                    <option value="{{ $org->id }}">{{ $org->nama_organisasi }}</option>
                @endforeach
            </select>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600">Nama Kegiatan</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600">Penyelenggara</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600">Lokasi</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600">Tgl Pelaksanaan</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600">Jumlah Panitia</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kegiatan_list as $kegiatan)
                        <tr class="border-b">
                            <td class="py-3 px-4">{{ $kegiatan->nama }}</td>
                            <td class="py-3 px-4">{{ $kegiatan->organisasi->nama_organisasi }}</td>
                            <td class="py-3 px-4">{{ $kegiatan->nama_lokasi }}</td>
                            <td class="py-3 px-4">{{ \Carbon\Carbon::parse($kegiatan->tgl_pelaksanaan)->format('d M Y') }}</td>
                            <td class="py-3 px-4 text-center">
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded">
                                    {{ $kegiatan->panitia_count }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4">Tidak ada data kegiatan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $kegiatan_list->links() }}
        </div>
    </div>
</div>