<x-filament-widgets::widget>
    <x-filament::section>
        <div class="bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold mb-2">
                        Selamat Datang, {{ $user_name }}! 👋
                    </h2>
                    <p class="text-blue-100 mb-4">
                        {{ $current_time }}
                    </p>
                    <p class="text-blue-100">
                        Kelola sistem pakar diagnosis penyakit jagung dengan mudah melalui dashboard admin ini.
                    </p>
                </div>
                <div class="hidden md:block">
                    <div class="bg-white/10 rounded-full p-4">
                        <svg class="h-16 w-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
            
            <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-white/10 rounded-lg p-4">
                    <div class="flex items-center">
                        <svg class="h-8 w-8 text-white mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                        <div>
                            <p class="text-sm text-blue-100">Quick Actions</p>
                            <p class="font-semibold">Kelola Data Master</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white/10 rounded-lg p-4">
                    <div class="flex items-center">
                        <svg class="h-8 w-8 text-white mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        <div>
                            <p class="text-sm text-blue-100">Analytics</p>
                            <p class="font-semibold">Monitor Diagnosis</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white/10 rounded-lg p-4">
                    <div class="flex items-center">
                        <svg class="h-8 w-8 text-white mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                        </svg>
                        <div>
                            <p class="text-sm text-blue-100">Users</p>
                            <p class="font-semibold">Kelola Pengguna</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
