<div>
    <h2 class="text-3xl font-bold text-gray-800">Atur Panitia</h2>
    <p class="text-lg text-gray-600 mb-6">Kegiatan: {{ $kegiatan->nama }}</p>

    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">{{ session('message') }}</div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="md:col-span-1">
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-xl font-bold mb-4">Tambah Panitia Baru</h3>
                <form wire:submit.prevent="tambahPanitia">
                    <div class="mb-4">
                        <label for="anggota_id">Pilih Anggota</label>
                        <select wire:model="anggota_id" id="anggota_id" class="w-full mt-1 border rounded-lg">
                            <option value="">-- Pilih Anggota --</option>
                            @foreach($anggota_tersedia as $anggota)
                            <option value="{{ $anggota->id }}">{{ $anggota->nim }} - {{ $anggota->nama }}</option>
                            @endforeach
                        </select>
                        @error('anggota_id') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-4">
                         <label for="jabatan">Jabatan</label>
                         <input type="text" wire:model="jabatan" id="jabatan" class="w-full mt-1 border rounded-lg">
                         @error('jabatan') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg">Tambahkan</button>
                </form>
            </div>
        </div>

        <div class="md:col-span-2">
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-xl font-bold mb-4">Daftar Panitia</h3>
                <table class="min-w-full">
                    <tbody>
                        @forelse($panitia_list as $panitia)
                        <tr>
                            <td class="py-2">{{ $panitia->nama }} ({{ $panitia->nim }})</td>
                            <td class="py-2">{{ $panitia->pivot->jabatan }}</td>
                            <td class="py-2">
                                <button wire:click="hapusPanitia({{ $panitia->id }})" class="text-red-500">Hapus</button>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="3" class="text-center py-4">Belum ada panitia.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>