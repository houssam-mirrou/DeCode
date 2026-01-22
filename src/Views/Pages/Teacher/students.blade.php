@extends('layout')

@section('title', 'My Students')

@section('content')
    <div class="flex h-screen bg-slate-50 overflow-hidden">
        @include('Partials.teacher_sidebar')

        <div class="flex-1 flex flex-col h-screen overflow-hidden">

            <header class="h-16 bg-white border-b border-slate-200 flex items-center justify-between px-8 shrink-0">
                <div>
                    <h1 class="text-xl font-bold text-slate-800">Class Roster</h1>
                    <p class="text-xs text-slate-500">Managing <span
                            class="font-bold text-indigo-600">{{ count($students) }}</span> students</p>
                </div>

                <button
                    class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold rounded-lg flex items-center gap-2 transition-colors">
                    <i data-lucide="user-plus" class="w-4 h-4"></i> Add Student
                </button>
            </header>

            <main class="flex-1 overflow-y-auto p-8">
                <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                    @forelse($students as $student)
                        <div
                            class="bg-white border border-slate-200 rounded-xl p-6 shadow-sm hover:shadow-md transition-all group">

                            <div class="flex items-start justify-between mb-4">
                                <div class="flex gap-4">
                                    <div
                                        class="w-12 h-12 rounded-full bg-indigo-50 border border-indigo-100 flex items-center justify-center text-indigo-600 font-bold text-lg">
                                        {{ $student->getInitials() }}
                                    </div>

                                    <div>
                                        <h3 class="font-bold text-slate-800 group-hover:text-indigo-600 transition-colors">
                                            {{ $student->firstName }} {{ $student->lastName }}
                                        </h3>
                                        <p class="text-xs text-slate-400 flex items-center gap-1">
                                            <i data-lucide="mail" class="w-3 h-3"></i> {{ $student->email }}
                                        </p>
                                    </div>
                                </div>

                                <button class="text-slate-300 hover:text-slate-600">
                                    <i data-lucide="more-vertical" class="w-5 h-5"></i>
                                </button>
                            </div>

                            <hr class="border-slate-50 mb-4">

                            <div class="space-y-3">
                                <div class="flex justify-between items-end">
                                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Progress</span>
                                    <span class="text-sm font-bold text-slate-700">
                                        {{ $student->validatedBriefs }} <span
                                            class="text-slate-400 text-xs font-medium">validated</span>
                                    </span>
                                </div>

                                {{-- Calculate percentage (capped at 100%) --}}
                                @php $percent = min(100, ($student->validatedBriefs / max(1, $student->totalBriefs)) * 100); @endphp

                                <div class="w-full bg-slate-100 rounded-full h-2 overflow-hidden">
                                    <div class="bg-indigo-500 h-2 rounded-full transition-all duration-500"
                                        style="width: {{ $percent }}%"></div>
                                </div>
                            </div>

                            <div class="mt-6 flex gap-2">
                                <button
                                    class="flex-1 px-3 py-2 bg-slate-50 hover:bg-white border border-slate-200 hover:border-indigo-200 text-slate-600 hover:text-indigo-600 text-xs font-bold rounded-lg transition-all">
                                    View Profile
                                </button>
                                <button
                                    class="flex-1 px-3 py-2 bg-slate-50 hover:bg-white border border-slate-200 hover:border-emerald-200 text-slate-600 hover:text-emerald-600 text-xs font-bold rounded-lg transition-all">
                                    Statistics
                                </button>
                            </div>

                        </div>
                    @empty
                        <div
                            class="col-span-full py-12 text-center border-2 border-dashed border-slate-200 rounded-xl bg-slate-50">
                            <div class="inline-flex p-3 bg-slate-100 rounded-full text-slate-400 mb-3">
                                <i data-lucide="users" class="w-6 h-6"></i>
                            </div>
                            <h3 class="text-slate-600 font-bold">No students found</h3>
                            <p class="text-slate-400 text-sm">This class doesn't have any students enrolled yet.</p>
                        </div>
                    @endforelse

                </div>
            </main>
        </div>
    </div>
    <script>
        lucide.createIcons();
    </script>
@endsection
