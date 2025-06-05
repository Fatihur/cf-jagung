<x-filament-widgets::widget>
    <x-filament::section>
        <x-slot name="heading">
            <div class="flex items-center gap-2">
                <x-heroicon-o-clock class="h-5 w-5" />
                Aktivitas Terbaru
            </div>
        </x-slot>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Recent Diagnoses -->
            <div>
                <h4 class="text-sm font-semibold text-gray-900 dark:text-gray-100 mb-3 flex items-center">
                    <x-heroicon-o-document-text class="h-4 w-4 mr-2 text-green-600" />
                    Diagnosis Terbaru
                    <span class="ml-2 bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">
                        {{ $total_today }} hari ini
                    </span>
                </h4>
                
                @if($recent_diagnoses->count() > 0)
                    <div class="space-y-3">
                        @foreach($recent_diagnoses as $diagnosis)
                            <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-800 rounded-lg">
                                <div class="flex items-center space-x-3">
                                    <div class="flex-shrink-0">
                                        <div class="h-8 w-8 bg-green-100 rounded-full flex items-center justify-center">
                                            <x-heroicon-o-user class="h-4 w-4 text-green-600" />
                                        </div>
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <p class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                            {{ $diagnosis->user->name ?? 'Guest' }}
                                        </p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">
                                            {{ $diagnosis->created_at->diffForHumans() }}
                                        </p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-xs text-gray-500 dark:text-gray-400">
                                        {{ is_array($diagnosis->selected_symptoms) ? count($diagnosis->selected_symptoms) : 0 }} gejala
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-6">
                        <x-heroicon-o-document-text class="h-12 w-12 text-gray-400 mx-auto mb-2" />
                        <p class="text-sm text-gray-500 dark:text-gray-400">Belum ada diagnosis</p>
                    </div>
                @endif
            </div>

            <!-- Recent Users -->
            <div>
                <h4 class="text-sm font-semibold text-gray-900 dark:text-gray-100 mb-3 flex items-center">
                    <x-heroicon-o-users class="h-4 w-4 mr-2 text-blue-600" />
                    Pengguna Terbaru
                </h4>
                
                @if($recent_users->count() > 0)
                    <div class="space-y-3">
                        @foreach($recent_users as $user)
                            <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-800 rounded-lg">
                                <div class="flex items-center space-x-3">
                                    <div class="flex-shrink-0">
                                        <div class="h-8 w-8 bg-blue-100 rounded-full flex items-center justify-center">
                                            <span class="text-blue-600 font-medium text-sm">
                                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <p class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                            {{ $user->name }}
                                        </p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">
                                            {{ $user->email }}
                                        </p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                        {{ $user->role === 'admin' ? 'bg-purple-100 text-purple-800' : 'bg-gray-100 text-gray-800' }}">
                                        {{ $user->role === 'admin' ? 'Admin' : 'User' }}
                                    </span>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                        {{ $user->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-6">
                        <x-heroicon-o-users class="h-12 w-12 text-gray-400 mx-auto mb-2" />
                        <p class="text-sm text-gray-500 dark:text-gray-400">Belum ada pengguna baru</p>
                    </div>
                @endif
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
