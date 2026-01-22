@extends('layout')

@section('title', 'All Submissions')

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
            <header class="h-16 bg-white border-b border-slate-200 flex items-center px-8">
                <h1 class="text-xl font-bold text-slate-800">Student Submissions Dashboard</h1>
            </header>

            <main class="flex-1 overflow-y-auto p-8">
                <div class="max-w-6xl mx-auto space-y-12">

                    @forelse($sprints as $sprintDTO)
                        <div class="space-y-6 mb-12">
                            <div class="flex items-center justify-between border-l-4 border-indigo-500 pl-4 py-1">
                                <div>
                                    <h2 class="text-2xl font-bold text-slate-800 tracking-tight">
                                        {{ $sprintDTO->sprint->get_name() }}
                                    </h2>
                                    <p class="text-sm text-slate-500 mt-1">
                                        {{ date('F j', strtotime($sprintDTO->sprint->get_start_date())) }}
                                        —
                                        {{ date('F j, Y', strtotime($sprintDTO->sprint->get_end_date())) }}
                                    </p>
                                </div>
                                <div class="hidden sm:block">
                                    <span
                                        class="px-4 py-1.5 bg-indigo-50 text-indigo-700 rounded-full text-xs font-bold border border-indigo-100 shadow-sm">
                                        {{ count($sprintDTO->briefs) }} Projects
                                    </span>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 gap-8">
                                @foreach ($sprintDTO->briefs as $briefDTO)
                                    <div
                                        class="bg-white border border-slate-200 rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300 overflow-hidden">

                                        <div
                                            class="px-6 py-5 bg-white border-b border-slate-100 flex justify-between items-start sm:items-center flex-col sm:flex-row gap-4">
                                            <div class="flex items-center gap-3">
                                                <div class="p-2 bg-slate-100 rounded-lg text-slate-500">
                                                    <i data-lucide="folder-git-2" class="w-5 h-5"></i>
                                                </div>
                                                <div>
                                                    <h3 class="font-bold text-slate-800 text-lg">
                                                        {{ $briefDTO->brief->get_title() }}
                                                    </h3>
                                                    <p class="text-xs text-slate-500 flex items-center gap-1 mt-0.5">
                                                        <i data-lucide="clock" class="w-3 h-3"></i>
                                                        Due:
                                                        {{ date('M d, Y', strtotime($briefDTO->brief->get_date_remise())) }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="flex items-center gap-2 text-xs font-medium text-slate-500">
                                                <span>{{ count($briefDTO->students) }} Students assigned</span>
                                            </div>
                                        </div>

                                        <div class="overflow-x-auto">
                                            <table class="w-full text-left text-sm text-slate-600">
                                                <thead
                                                    class="bg-slate-50/50 text-xs uppercase font-bold text-slate-500 border-b border-slate-100">
                                                    <tr>
                                                        <th class="px-6 py-4">Student</th>
                                                        <th class="px-6 py-4">Status</th>
                                                        <th class="px-6 py-4">Repository</th>
                                                        <th class="px-6 py-4 text-right">Action</th>
                                                    </tr>
                                                </thead>

                                                <tbody class="divide-y divide-slate-100">
                                                    @foreach ($briefDTO->students as $studentDTO)
                                                        <tr class="hover:bg-slate-50/80 transition-colors group">

                                                            <td class="px-6 py-4">
                                                                <div class="flex items-center gap-3">
                                                                    <div
                                                                        class="h-9 w-9 rounded-full bg-indigo-100 border border-indigo-200 text-indigo-700 flex items-center justify-center text-xs font-bold shrink-0">
                                                                        {{ substr($studentDTO->student->get_first_name(), 0, 1) }}{{ substr($studentDTO->student->get_last_name(), 0, 1) }}
                                                                    </div>
                                                                    <div>
                                                                        <div class="font-semibold text-slate-800">
                                                                            {{ $studentDTO->student->get_first_name() }}
                                                                            {{ $studentDTO->student->get_last_name() }}
                                                                        </div>
                                                                        <div class="text-xs text-slate-400">
                                                                            {{ $studentDTO->student->get_email() }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>

                                                            <td class="px-6 py-4">
                                                                @if ($studentDTO->review_status)
                                                                    <span
                                                                        class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-100">
                                                                        <i data-lucide="check-circle-2"
                                                                            class="w-3.5 h-3.5"></i>
                                                                        Validated
                                                                    </span>
                                                                @elseif ($studentDTO->livrable)
                                                                    <span
                                                                        class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-amber-50 text-amber-700 border border-amber-100">
                                                                        <i data-lucide="loader-2" class="w-3.5 h-3.5"></i>
                                                                        Pending
                                                                    </span>
                                                                @else
                                                                    <span
                                                                        class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-500 border border-slate-200">
                                                                        <i data-lucide="x-circle" class="w-3.5 h-3.5"></i>
                                                                        Missing
                                                                    </span>
                                                                @endif
                                                            </td>

                                                            <td class="px-6 py-4">
                                                                @if ($studentDTO->livrable)
                                                                    <div class="flex flex-col">
                                                                        <a href="{{ $studentDTO->livrable->get_url() }}"
                                                                            target="_blank"
                                                                            class="text-indigo-600 hover:text-indigo-800 hover:underline flex items-center gap-1.5 font-medium transition-colors w-fit">
                                                                            <i data-lucide="github" class="w-4 h-4"></i>
                                                                            View Code
                                                                        </a>
                                                                        <span class="text-[10px] text-slate-400 mt-1">
                                                                            {{ date('M d, H:i', strtotime($studentDTO->livrable->get_date_submitted())) }}
                                                                        </span>
                                                                    </div>
                                                                @else
                                                                    <span
                                                                        class="text-slate-400 text-xs italic flex items-center gap-1">
                                                                        <i data-lucide="minus" class="w-3 h-3"></i> No
                                                                        submission
                                                                    </span>
                                                                @endif
                                                            </td>

                                                            <td class="px-6 py-4 text-right">
                                                                @if ($studentDTO->livrable)
                                                                    <a href="/teacher/evaluate/{{ $briefDTO->brief->get_id() }}/student/{{ $studentDTO->student->get_id() }}"
                                                                        class="inline-flex items-center justify-center px-4 py-2 bg-white border border-indigo-200 text-indigo-700 text-xs font-bold rounded-lg hover:bg-indigo-50 hover:border-indigo-300 transition-all shadow-sm">
                                                                        <i data-lucide="pen-tool" class="w-3 h-3 mr-2"></i>
                                                                        Evaluate
                                                                    </a>
                                                                @else
                                                                    <button disabled
                                                                        class="inline-flex items-center justify-center px-4 py-2 bg-slate-50 border border-slate-200 text-slate-300 text-xs font-bold rounded-lg cursor-not-allowed">
                                                                        Evaluate
                                                                    </button>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @empty
                        <div
                            class="flex flex-col items-center justify-center py-20 bg-white border border-slate-200 rounded-xl shadow-sm border-dashed">
                            <div class="p-4 bg-slate-50 rounded-full mb-4">
                                <i data-lucide="layers" class="w-8 h-8 text-slate-400"></i>
                            </div>
                            <h3 class="text-lg font-bold text-slate-800">No Projects Found</h3>
                            <p class="text-slate-500 text-sm mt-1">There are no sprints or briefs assigned to this class
                                yet.</p>
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
