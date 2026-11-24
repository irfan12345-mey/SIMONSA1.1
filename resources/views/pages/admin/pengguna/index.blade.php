<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Kelola Pengguna') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if (session('success'))
                <div class="mb-4 bg-green-100 text-green-700 p-3 rounded">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="mb-4 bg-red-100 text-red-700 p-3 rounded">{{ session('error') }}</div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Daftar Akun Pengguna</h3>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th class="px-6 py-3">Nama</th>
                                <th class="px-6 py-3">Username</th>
                                <th class="px-6 py-3">Role</th>
                                <th class="px-6 py-3">Status Akun</th>
                                <th class="px-6 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($penggunas as $user)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-4">{{ $user->nama }}</td>
                                    <td class="px-6 py-4">{{ $user->username }}</td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-1 rounded text-xs font-bold uppercase
                                            @if($user->role === 'admin') bg-red-100 text-red-700 
                                            @elseif($user->role === 'pemilik') bg-blue-100 text-blue-700 
                                            @else bg-green-100 text-green-700 @endif">
                                            {{ $user->role }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-1 rounded text-xs font-bold uppercase {{ $user->status_akun === 'aktif' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700' }}">
                                            {{ $user->status_akun }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <!-- Toggle Status Form -->
                                        <form action="{{ route('admin.pengguna.toggle-status', $user->id_pengguna) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            @if($user->id_pengguna !== auth()->user()->id_pengguna)
                                                <button type="submit" class="text-sm font-medium {{ $user->status_akun === 'aktif' ? 'text-red-500 hover:text-red-700' : 'text-green-500 hover:text-green-700' }}">
                                                    {{ $user->status_akun === 'aktif' ? 'Nonaktifkan' : 'Aktifkan' }}
                                                </button>
                                            @else
                                                <span class="text-xs text-gray-400">(Akun Anda)</span>
                                            @endif
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center">Belum ada data pengguna.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>