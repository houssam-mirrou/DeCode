@extends('layout')

@section('title', 'Evaluate: ' . $dto->fullName)

@section('content')
    <div class="flex h-screen bg-slate-50 overflow-hidden">
        <aside class="w-64 bg-white border-r border-slate-200 hidden md:flex flex-col z-20">
            <div class="h-16 flex items-center px-6 border-b border-slate-100">
                <h1 class="text-xl font-bold text-indigo-600 tracking-wider">DECODE <span
                        class="text-xs text-slate-400 font-normal ml-1">TEACHER</span></h1>
            </div>
            <nav class="flex-1 px-3 py-6 space-y-1">
                <a href="/"
                    class="flex items-center px-3 py-2.5 text-slate-600 hover:bg-slate-50 hover:text-slate-900 rounded-lg transition-colors">
                    <i data-lucide="layout-dashboard" class="w-5 h-5 mr-3 text-slate-400"></i> Dashboard
                </a>
                <a href="/teacher/briefs"
                    class="flex items-center px-3 py-2.5 text-slate-600 hover:bg-slate-50 hover:text-slate-900 rounded-lg transition-colors">
                    <i data-lucide="file-code" class="w-5 h-5 mr-3 text-slate-400"></i> My Briefs
                </a>
                <a href="/teacher/evaluations"
                    class="flex items-center px-3 py-2.5 text-indigo-600 bg-indigo-50 font-medium rounded-lg transition-colors">
                    <i data-lucide="check-circle" class="w-5 h-5 mr-3 text-indigo-600"></i> Evaluations
                </a>
                <a href="/teacher/students"
                    class="flex items-center px-3 py-2.5 text-slate-600 hover:bg-slate-50 hover:text-slate-900 rounded-lg transition-colors">
                    <i data-lucide="users" class="w-5 h-5 mr-3 text-slate-400"></i>
                    Students & Progress
                </a>
            </nav>
            <div class="p-4 border-t border-slate-100">
                <div class="flex items-center gap-3">
                    <div
                        class="w-9 h-9 rounded-full bg-indigo-100 border border-indigo-200 flex items-center justify-center text-indigo-700 font-bold text-sm">
                        TC</div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-slate-700 truncate">Teacher</p>
                        <p class="text-xs text-slate-400 truncate">Logged In</p>
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

            <header class="h-16 bg-white border-b border-slate-200 flex items-center justify-between px-8">
                <div class="flex items-center gap-4">
                    <a href="/teacher/briefs" class="text-slate-400 hover:text-slate-600">
                        <i data-lucide="arrow-left" class="w-5 h-5"></i>
                    </a>
                    <div>
                        <h2 class="text-lg font-bold text-slate-800">{{ $dto->fullName }}</h2>
                        <p class="text-xs text-slate-500">Project: {{ $dto->briefTitle }}</p>
                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-y-auto p-6">
                <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-8">

                    <div class="space-y-6">
                        <div class="bg-white border border-slate-200 rounded-xl p-6 shadow-sm">
                            <h3
                                class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-4 flex items-center gap-2">
                                <i data-lucide="github" class="w-4 h-4"></i> Repository
                            </h3>
                            @if ($dto->repoLink)
                                <div class="bg-slate-50 border border-slate-200 rounded-lg p-4">
                                    <a href="{{ $dto->repoLink }}" target="_blank"
                                        class="text-indigo-600 font-bold hover:underline flex items-center gap-2 break-all">
                                        {{ $dto->repoLink }} <i data-lucide="external-link" class="w-3 h-3"></i>
                                    </a>
                                    <div class="mt-2 text-xs text-slate-400">
                                        Submitted: {{ date('M d, H:i', strtotime($dto->dateSubmitted)) }}
                                    </div>
                                    @if ($dto->studentComment)
                                        <div class="mt-3 pt-3 border-t border-slate-200 text-sm italic text-slate-600">
                                            "{{ $dto->studentComment }}"
                                        </div>
                                    @endif
                                </div>
                            @else
                                <div
                                    class="p-4 bg-red-50 text-red-600 text-sm font-bold rounded-lg flex items-center gap-2">
                                    <i data-lucide="alert-circle" class="w-4 h-4"></i> No submission found.
                                </div>
                            @endif
                        </div>

                        <div class="bg-white border border-slate-200 rounded-xl p-6 shadow-sm">
                            <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-4">Brief Context</h3>
                            <div class="prose prose-sm text-slate-600 max-w-none">
                                {!! nl2br($dto->briefDescription) !!}
                            </div>
                        </div>
                    </div>

                    <div class="bg-white border border-slate-200 rounded-xl shadow-sm h-fit">
                        <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50">
                            <h3 class="font-bold text-slate-800 flex items-center gap-2">
                                <i data-lucide="pen-tool" class="w-4 h-4 text-indigo-600"></i> Grading Form
                            </h3>
                        </div>

                        <form action="/teacher/evaluate/submit" method="POST" class="p-6 space-y-8">
                            <input type="hidden" name="student_id" value="{{ $dto->studentId }}">
                            <input type="hidden" name="brief_id" value="{{ $dto->briefId }}">
                            <input type="hidden" name="evaluation_id" value="{{ $dto->evaluationId }}">

                            <div class="space-y-6">
                                @foreach ($dto->competences as $comp)
                                    <div class="bg-slate-50 border border-slate-200 rounded-lg p-4">
                                        <div class="flex justify-between items-center mb-3">
                                            <div class="flex items-center gap-2">
                                                <span
                                                    class="px-2 py-0.5 bg-white border border-slate-200 rounded text-xs font-bold text-slate-600">
                                                    {{ $comp->code }}
                                                </span>
                                                <span class="text-sm font-bold text-slate-700">{{ $comp->libelle }}</span>
                                            </div>
                                            <span class="text-[10px] uppercase font-bold text-slate-400">
                                                Target: {{ $comp->targetLevel }}
                                            </span>
                                        </div>

                                        <div class="grid grid-cols-3 gap-3">
                                            @foreach (['IMITER', 'S_ADAPTER', 'TRANSPOSER'] as $level)
                                                <label class="cursor-pointer relative">
                                                    <input type="radio" name="competences[{{ $comp->id }}]"
                                                        value="{{ $level }}" class="peer sr-only"
                                                        {{ $comp->acquiredLevel === $level ? 'checked' : '' }} required>

                                                    <div
                                                        class="text-center py-2 rounded border border-slate-200 bg-white text-xs font-bold text-slate-500 hover:border-indigo-300 peer-checked:bg-indigo-600 peer-checked:text-white peer-checked:border-indigo-600 transition-all">
                                                        {{ str_replace('_', ' ', ucfirst(strtolower($level))) }}
                                                    </div>
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="pt-6 border-t border-slate-100 space-y-4">
                                <div>
                                    <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Teacher's
                                        Comment</label>
                                    <textarea name="comment" rows="3"
                                        class="w-full rounded-lg border-slate-300 text-sm focus:ring-indigo-500 focus:border-indigo-500"
                                        placeholder="Add feedback...">{{ $dto->teacherComment }}</textarea>
                                </div>

                                <div>
                                    <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Final
                                        Validation</label>
                                    <div class="flex gap-4">
                                        <label class="flex items-center gap-2 cursor-pointer">
                                            <input type="radio" name="review" value="bad"
                                                class="text-red-600 focus:ring-red-500"
                                                {{ $dto->reviewStatus === 'bad' ? 'checked' : '' }} required>
                                            <span class="text-sm font-bold text-slate-700">Bad</span>
                                        </label>
                                        <label class="flex items-center gap-2 cursor-pointer">
                                            <input type="radio" name="review" value="good"
                                                class="text-emerald-600 focus:ring-emerald-500"
                                                {{ $dto->reviewStatus === 'good' ? 'checked' : '' }}>
                                            <span class="text-sm font-bold text-slate-700">Good</span>
                                        </label>
                                        <label class="flex items-center gap-2 cursor-pointer">
                                            <input type="radio" name="review" value="excellent"
                                                class="text-indigo-600 focus:ring-indigo-500"
                                                {{ $dto->reviewStatus === 'excellent' ? 'checked' : '' }}>
                                            <span class="text-sm font-bold text-slate-700">Excellent</span>
                                        </label>
                                    </div>
                                    <div class="pt-6 border-t border-slate-100">
                                        <label class="block text-xs font-bold text-slate-500 uppercase mb-3">
                                            Overall Sprint Level
                                        </label>

                                        <div class="grid grid-cols-3 gap-3">
                                            @foreach (['IMITER', 'S_ADAPTER', 'TRANSPOSER'] as $lvl)
                                                <label class="cursor-pointer relative">
                                                    <input type="radio" name="level" value="{{ $lvl }}"
                                                        class="peer sr-only" {{-- Check if DTO has this level, or default to empty --}}
                                                        {{ ($dto->evaluationLevel ?? '') == $lvl ? 'checked' : '' }}
                                                        required>

                                                    <div
                                                        class="text-center py-3 rounded-lg border border-slate-200 bg-white text-sm font-bold text-slate-500 hover:border-indigo-300 peer-checked:bg-indigo-600 peer-checked:text-white peer-checked:border-indigo-600 peer-checked:shadow-md transition-all">
                                                        {{ ucfirst(strtolower(str_replace('S_', '', $lvl))) }}
                                                    </div>
                                                </label>
                                            @endforeach
                                        </div>
                                        <p class="text-[10px] text-slate-400 mt-2">
                                            * Select the global complexity level achieved in this sprint.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="pt-4 border-t border-slate-100 flex justify-end">
                                <button type="submit"
                                    class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-lg shadow-sm shadow-indigo-200 flex items-center gap-2 transition-all">
                                    <i data-lucide="save" class="w-4 h-4"></i> Save Evaluation
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script>
        lucide.createIcons();
    </script>
@endsection
