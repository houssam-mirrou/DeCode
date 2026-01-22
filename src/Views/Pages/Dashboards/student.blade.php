@extends('layout')

@section('title', 'My Dashboard - Student')

@section('content')
    <div class="flex h-screen bg-slate-50 overflow-hidden">

        <aside class="w-64 bg-white border-r border-slate-200 hidden md:flex flex-col z-20">
            <div class="h-16 flex items-center px-6 border-b border-slate-100">
                <h1 class="text-xl font-bold text-indigo-600 tracking-wider">DECODE <span
                        class="text-xs text-slate-400 font-normal ml-1">STUDENT</span></h1>
            </div>

            <nav class="flex-1 px-3 py-6 space-y-1">
                <a href="/student/dashboard"
                    class="flex items-center px-3 py-2.5 bg-indigo-50 text-indigo-700 font-medium rounded-lg transition-colors">
                    <i data-lucide="layout-dashboard" class="w-5 h-5 mr-3 text-indigo-600"></i> Dashboard
                </a>
                <a href="/student/briefs"
                    class="flex items-center px-3 py-2.5 text-slate-600 hover:bg-slate-50 hover:text-slate-900 rounded-lg transition-colors">
                    <i data-lucide="folder-git-2" class="w-5 h-5 mr-3 text-slate-400"></i> My Projects
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

        <div class="flex-1 flex flex-col h-screen overflow-hidden relative z-0">

            <header class="h-16 bg-white border-b border-slate-200 flex items-center justify-between px-8 z-10">
                <div>
                    <h2 class="text-lg font-bold text-slate-800">Overview</h2>
                    <p class="text-xs text-slate-500">Track your active sprints and briefs</p>
                </div>
            </header>

            <main class="flex-1 overflow-y-auto p-8 bg-slate-50">
                <div class="max-w-6xl mx-auto space-y-8">

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full bg-blue-50 flex items-center justify-center text-blue-600">
                                <i data-lucide="zap" class="w-6 h-6"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-slate-500">Active Briefs</p>
                                <p class="text-2xl font-bold text-slate-800">{{ $active_briefs_count ?? 0 }}</p>
                            </div>
                        </div>
                        <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm flex items-center gap-4">
                            <div
                                class="w-12 h-12 rounded-full bg-emerald-50 flex items-center justify-center text-emerald-600">
                                <i data-lucide="check-circle-2" class="w-6 h-6"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-slate-500">Completed</p>
                                <p class="text-2xl font-bold text-slate-800">{{ $completed_briefs_count ?? 0 }}</p>
                            </div>
                        </div>
                        <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm flex items-center gap-4">
                            <div
                                class="w-12 h-12 rounded-full bg-indigo-50 flex items-center justify-center text-indigo-600">
                                <i data-lucide="calendar" class="w-6 h-6"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-slate-500">Current Sprint</p>
                                <p class="text-lg font-bold text-slate-800 truncate">{{ $current_sprint_name ?? 'N/A' }}</p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-lg font-bold text-slate-800 mb-4">Your Curriculum</h3>

                        @forelse($sprints ?? [] as $sprintGroup)
                            @php
                                // Unpacking structure: ['sprint' => Object, 'briefs' => [id => ['brief' => Obj, 'competences' => []]]]
                                $sprint = $sprintGroup['sprint'];
                                $briefsList = $sprintGroup['briefs'];
                            @endphp

                            <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden mb-6">
                                <div
                                    class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-8 h-8 rounded bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold text-xs">
                                            S{{ $loop->iteration }}</div>
                                        <h3 class="font-bold text-slate-800">{{ $sprint->get_name() }}</h3>
                                    </div>
                                    <span
                                        class="text-xs text-slate-500 font-medium bg-white px-2 py-1 rounded border border-slate-200">
                                        Ends: {{ date('M d, Y', strtotime($sprint->get_end_date())) }}
                                    </span>
                                </div>

                                <div class="divide-y divide-slate-100">
                                    @forelse($briefsList as $briefGroup)
                                        @php
                                            $brief = $briefGroup['brief'];
                                            $briefCompetences = $briefGroup['competences'];

                                            // LOGIC BASED ON YOUR SCHEMA:
                                            // 1. Is it evaluated? (Check for 'review' column existence implies evaluation exists)
                                            $is_validated =
                                                property_exists($brief, 'review_status') &&
                                                !empty($brief->get_review_status());

                                            // 2. Is it submitted? (Check for 'repo_link' from livrable table)
                                            $is_submitted = $brief->get_repo_link();
                                            
                                            // Determine Visual Status
                                            $status = 'todo';
                                            if ($is_validated) {
                                                $status = 'done';
                                            } elseif ($is_submitted) {
                                                $status = 'submitted';
                                            }
                                        @endphp

                                        <div
                                            class="p-5 hover:bg-slate-50 transition-all flex flex-col sm:flex-row sm:items-center justify-between gap-4 group">

                                            <div class="flex items-start gap-4">
                                                <div
                                                    class="mt-1 w-10 h-10 rounded-full flex-shrink-0 flex items-center justify-center 
                                                    {{ $status == 'done' ? 'bg-emerald-100 text-emerald-600' : 'bg-slate-100 text-slate-500' }}">
                                                    <i data-lucide="{{ $status == 'done' ? 'check' : 'file-code' }}"
                                                        class="w-5 h-5"></i>
                                                </div>
                                                <div>
                                                    <div class="flex items-center gap-3">
                                                        <h4 class="text-base font-bold text-slate-800">
                                                            {{ $brief->get_title() }}</h4>

                                                        @if ($status == 'submitted')
                                                            <span
                                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800 border border-amber-200">
                                                                Pending Review
                                                            </span>
                                                        @elseif($status == 'done')
                                                            <span
                                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800 border border-emerald-200">
                                                                Validated ({{ ucfirst($brief->review_status ?? 'Good') }})
                                                            </span>
                                                        @else
                                                            <span
                                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800 border border-indigo-200">
                                                                In Progress
                                                            </span>
                                                        @endif

                                                        <span
                                                            class="text-[10px] uppercase font-bold text-slate-400 border border-slate-200 px-1.5 rounded">
                                                            {{ $brief->type ?? 'Individual' }}
                                                        </span>
                                                    </div>

                                                    <p class="text-sm text-slate-500 mt-1 line-clamp-2 max-w-xl">
                                                        {{ $brief->get_description() }}</p>

                                                    <div class="flex flex-wrap gap-2 mt-3">
                                                        @foreach ($briefCompetences as $comp)
                                                            <span
                                                                class="inline-flex items-center px-2 py-1 rounded text-[10px] font-medium bg-slate-100 text-slate-600 border border-slate-200"
                                                                title="{{ $comp->get_libelle() }}">
                                                                {{ $comp->get_code() }}
                                                            </span>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="flex items-center gap-3">
                                                @if ($status == 'submitted' || $status == 'done')
                                                    {{-- Show Link if submitted (from livrable table) --}}
                                                    <a href="{{ $brief->get_repo_link() }}" target="_blank"
                                                        class="text-sm font-medium text-slate-500 hover:text-indigo-600 hover:underline flex items-center gap-1">
                                                        <i data-lucide="github" class="w-4 h-4"></i> View Submission
                                                    </a>
                                                @else
                                                    {{-- Show Submit Button if NOT submitted --}}
                                                    <button
                                                        onclick="openSubmitModal({{ $brief->get_id() }}, '{{ addslashes($brief->get_title()) }}')"
                                                        class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-lg shadow-sm shadow-indigo-200 transition-all flex items-center gap-2">
                                                        <i data-lucide="send" class="w-4 h-4"></i> Submit Work
                                                    </button>
                                                @endif
                                            </div>

                                        </div>
                                    @empty
                                        <div class="p-8 text-center text-slate-400 italic">No briefs assigned to you in this
                                            sprint.</div>
                                    @endforelse
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-20 bg-white rounded-xl border border-slate-200 border-dashed">
                                <div
                                    class="bg-slate-50 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i data-lucide="coffee" class="w-8 h-8 text-slate-400"></i>
                                </div>
                                <h3 class="text-lg font-medium text-slate-900">All caught up!</h3>
                                <p class="text-slate-500 mt-1">No active sprints assigned to your class.</p>
                            </div>
                        @endforelse
                    </div>

                </div>
            </main>
        </div>
    </div>

    <div id="submitModal" class="fixed inset-0 z-50 hidden" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" onclick="closeSubmitModal()"></div>

        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6 pointer-events-none">
            <div
                class="pointer-events-auto relative w-full max-w-md bg-white rounded-xl shadow-2xl ring-1 ring-slate-900/5">

                <form action="/student/brief/submit" method="POST">
                    <input type="hidden" name="brief_id" id="submit_brief_id">

                    <div class="p-6 pb-0">
                        <div class="flex items-center gap-4">
                            <div
                                class="flex h-12 w-12 items-center justify-center rounded-full bg-indigo-50 text-indigo-600">
                                <i data-lucide="github" class="h-6 w-6"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-slate-900">Submit Project</h3>
                                <p class="text-xs text-slate-500" id="submit_brief_title">Brief Title</p>
                            </div>
                        </div>
                    </div>

                    <div class="p-6 space-y-4">

                        <div>
                            <label class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-500">
                                GitHub Repository URL <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i data-lucide="link" class="h-4 w-4 text-slate-400"></i>
                                </div>
                                <input type="url" name="repo_link" required
                                    placeholder="https://github.com/username/repo"
                                    class="pl-10 w-full rounded-lg border-slate-300 py-2.5 text-sm font-medium shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20">
                            </div>
                        </div>

                        <div>
                            <label class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-500">
                                Comments
                            </label>
                            <div class="relative">
                                <textarea name="comment" rows="3" maxlength="255" placeholder="Add any notes about your submission..."
                                    class="w-full rounded-lg border-slate-300 p-3 text-sm font-medium shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 placeholder:text-slate-400"></textarea>

                                <div class="absolute top-3 right-3 pointer-events-none">
                                    <i data-lucide="message-square" class="h-4 w-4 text-slate-300"></i>
                                </div>
                            </div>
                            <p class="mt-2 text-xs text-slate-400">Max 255 characters.</p>
                        </div>

                    </div>

                    <div
                        class="flex flex-col-reverse gap-3 bg-slate-50 px-6 py-4 rounded-b-xl sm:flex-row sm:justify-end border-t border-slate-100">
                        <button type="button" onclick="closeSubmitModal()"
                            class="w-full sm:w-auto inline-flex justify-center rounded-lg border border-slate-300 bg-white px-4 py-2 text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50">
                            Cancel
                        </button>
                        <button type="submit"
                            class="w-full sm:w-auto inline-flex justify-center rounded-lg bg-indigo-600 px-6 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500">
                            Submit Project
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        lucide.createIcons();

        function openSubmitModal(briefId, briefTitle) {
            document.getElementById('submit_brief_id').value = briefId;
            document.getElementById('submit_brief_title').textContent = briefTitle;
            document.getElementById('submitModal').classList.remove('hidden');
        }

        function closeSubmitModal() {
            document.getElementById('submitModal').classList.add('hidden');
        }
    </script>
@endsection
