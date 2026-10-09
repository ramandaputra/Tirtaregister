@extends('layouts.admin')

@section('content')
<div class="max-w-6xl mx-auto space-y-6 lg:space-y-8">
                
                <!-- Welcome Banner -->
                <div class="bg-primary text-white rounded-2xl p-6 shadow-sm flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                    <div>
                        <h1 class="text-xl lg:text-2xl font-bold">Log Aktivitas Pengguna</h1>
                        <p class="text-white/80 text-sm mt-1">Pantau seluruh aktivitas login, penambahan, perubahan, dan penghapusan data oleh pengguna.</p>
                    </div>
                </div>

                <!-- Table Content -->
                <div class="bg-white rounded-2xl border border-surface-border shadow-sm overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-center text-sm whitespace-nowrap">
                            <thead class="bg-gray-50 border-b border-surface-border text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                <tr>
                                    <th class="px-6 py-4">Tanggal</th>
                                    <th class="px-6 py-4">Waktu</th>
                                    <th class="px-6 py-4">Pengguna</th>
                                    <th class="px-6 py-4">Aksi</th>
                                    <th class="px-6 py-4 w-full text-left">Deskripsi</th>
                                    <th class="px-6 py-4">IP Address</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-surface-border">
                                @forelse($logs as $log)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4 text-gray-500">
                                            {{ $log->created_at->format('d M Y') }}
                                        </td>
                                        <td class="px-6 py-4 text-gray-500 font-medium">
                                            {{ $log->created_at->format('H:i:s') }} WIB
                                        </td>
                                        <td class="px-6 py-4 font-medium text-gray-900">
                                            {{ $log->user ? $log->user->name : 'Sistem / Guest' }}
                                        </td>
                                        <td class="px-6 py-4">
                                            @if($log->action == 'Login')
                                                <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-semibold bg-blue-100 text-blue-800">{{ $log->action }}</span>
                                            @elseif($log->action == 'Create')
                                                <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-semibold bg-green-100 text-green-800">{{ $log->action }}</span>
                                            @elseif($log->action == 'Update')
                                                <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-semibold bg-yellow-100 text-yellow-800">{{ $log->action }}</span>
                                            @elseif($log->action == 'Delete')
                                                <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-semibold bg-red-100 text-red-800">{{ $log->action }}</span>
                                            @else
                                                <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-semibold bg-gray-100 text-gray-800">{{ $log->action }}</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-gray-600 whitespace-normal text-left">
                                            {{ $log->description }}
                                        </td>
                                        <td class="px-6 py-4 text-gray-500 font-mono text-xs">
                                            {{ $log->ip_address }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                            Belum ada log aktivitas yang tercatat.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    @if($logs->hasPages())
                        <div class="px-6 py-4 border-t border-surface-border bg-gray-50">
                            <div class="[&>nav]:flex [&>nav]:items-center [&>nav]:justify-between [&>nav]:gap-4">
                                {{ $logs->links() }}
                            </div>
                        </div>
                    @endif
                </div>

            </div>
@endsection
