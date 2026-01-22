@extends('layout')

@section('title', 'My Evaluations')

@section('content')
    <div class="flex h-screen bg-slate-50 overflow-hidden">

        <aside class="w-64 bg-white border-r border-slate-200 hidden md:flex flex-col z-20">
            <div class="h-16 flex items-center px-6 border-b border-slate-100">
                <h1 class="text-xl font-bold text-indigo-600 tracking-wider">DECODE <span
                        class="text-xs text-slate-400 font-normal ml-1">STUDENT</span></h1>
            </div>

            <nav class="flex-1 px-3 py-6 space-y-1">
                <a href="/student/dashboard"
                    class="flex items-center px-3 py-2.5 text-slate-600 hover:bg-slate-50 hover:text-slate-900 rounded-lg transition-colors">
                    <i data-lucide="layout-dashboard" class="w-5 h-5 mr-3 text-slate-400"></i> Dashboard
                </a>

                <a href="/student/briefs"
                    class="flex items-center px-3 py-2.5 text-slate-600 hover:bg-slate-50 hover:text-slate-900 rounded-lg transition-colors">
                    <i data-lucide="folder-git-2" class="w-5 h-5 mr-3 text-slate-400"></i> My Projects
                </a>

                <a href="/student/evaluations"
                    class="flex items-center px-3 py-2.5 text-slate-600 hover:bg-slate-50 hover:text-slate-900 rounded-lg transition-colors">
                    <i data-lucide="clipboard-check" class="w-5 h-5 mr-3 text-slate-400"></i> My Evaluations
                </a>
            </nav>
            <div class="p-4 border-t border-slate-100">
                <div class="flex items-center gap-3">
                    <div
                        class="w-9 h-9 rounded-full bg-emerald-100 border border-emerald-200 flex items-center justify-center text-emerald-700 font-bold text-sm">
                        {{ substr($current_user->get_first_name() ?? 'S', 0, 1) . substr($current_user->get_last_name() ?? 'S', 0, 1) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-slate-700 truncate">
                            {{ $current_user->get_first_name() . ' ' . $current_user->get_last_name() ?? 'Student' }}</p>
                        <p class="text-xs text-slate-400 truncate">Web Development</p>
                    </div>
                    <form action="/logout" method="POST">
                        <button type="submit" class="text-slate-400 hover:text-red-500 transition-colors p-1"
                            title="Logout">
                            <i data-lucide="log-out" class="w-4 h-4"></i>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <div class="flex-1 flex flex-col h-screen overflow-hidden">

            <header class="h-16 bg-white border-b border-slate-200 flex items-center px-8 shrink-0">
                <h1 class="text-xl font-bold text-slate-800">My Evaluations</h1>
            </header>

            <main class="flex-1 overflow-y-auto p-8">
                <div class="max-w-5xl mx-auto space-y-6">

                    @forelse($evaluations as $eval)
                        <div
                            class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden hover:shadow-md transition-shadow">

                            <div
                                class="px-6 py-4 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                                <div>
                                    <h2 class="text-lg font-bold text-slate-800">{{ $eval->briefTitle }}</h2>
                                    <p class="text-xs text-slate-500">Graded on
                                        {{ date('M d, Y', strtotime($eval->gradedDate)) }}</p>
                                </div>

                                <span
                                    class="px-3 py-1 rounded-full text-xs font-bold border uppercase tracking-wide {{ $eval->getStatusColor() }}">
                                    {{ $eval->status }}
                                </span>
                            </div>

                            <div class="p-6 grid grid-cols-1 md:grid-cols-3 gap-8">

                                <div class="md:col-span-1">
                                    <h3 class="text-xs font-bold text-slate-400 uppercase mb-2">Teacher's Feedback</h3>
                                    <div class="bg-indigo-50/50 rounded-lg p-4 border border-indigo-100">
                                        <p class="text-sm text-slate-600 italic leading-relaxed">
                                            "{{ $eval->teacherComment ?? 'No comment provided.' }}"
                                        </p>
                                    </div>
                                </div>

                                <div class="md:col-span-2">
                                    <h3 class="text-xs font-bold text-slate-400 uppercase mb-3">Competency Levels</h3>

                                    @if (count($eval->skills) > 0)
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                            @foreach ($eval->skills as $skill)
                                                <div
                                                    class="flex items-center justify-between p-3 border border-slate-100 rounded-lg bg-slate-50">
                                                    <span class="text-sm font-bold text-slate-700 truncate mr-2"
                                                        title="{{ $skill['name'] }}">
                                                        {{ $skill['name'] }}
                                                    </span>

                                                    @php
                                                        $lvlColor = match ($skill['level']) {
                                                            'TRANSPOSER'
                                                                => 'text-purple-600 bg-purple-50 border-purple-100',
                                                            'S_ADAPTER'
                                                                => 'text-indigo-600 bg-indigo-50 border-indigo-100',
                                                            'IMITER' => 'text-slate-500 bg-slate-100 border-slate-200',
                                                            default => 'text-gray-500',
                                                        };
                                                        // Clean text (S_ADAPTER -> Adapter)
                                                        $lvlText = ucfirst(
                                                            strtolower(str_replace(['S_', '_'], '', $skill['level'])),
                                                        );
                                                    @endphp

                                                    <span
                                                        class="px-2 py-1 text-[10px] font-bold border rounded {{ $lvlColor }}">
                                                        {{ $lvlText }}
                                                    </span>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <p class="text-sm text-slate-400 italic">No specific skills graded for this project.
                                        </p>
                                    @endif
                                </div>

                            </div>
                        </div>
                    @empty
                        <div class="text-center py-20 border-2 border-dashed border-slate-200 rounded-xl bg-slate-50">
                            <div class="inline-flex p-4 bg-white rounded-full shadow-sm mb-4">
                                <i data-lucide="clipboard-list" class="w-8 h-8 text-slate-300"></i>
                            </div>
                            <h3 class="text-slate-600 font-bold">No Evaluations Yet</h3>
                            <p class="text-slate-400 text-sm mt-1">Once your teacher grades your projects, they will appear
                                here.</p>
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
