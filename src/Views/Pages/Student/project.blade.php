@extends('layout')

@section('title', $brief->get_title() . ' - Project Details')

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
                    class="flex items-center px-3 py-2.5 bg-indigo-50 text-indigo-700 font-medium rounded-lg transition-colors">
                    <i data-lucide="folder-git-2" class="w-5 h-5 mr-3 text-indigo-600"></i> My Projects
                </a>
            </nav>
            <div class="p-4 border-t border-slate-100">
                <div class="flex items-center gap-3">
                    <div
                        class="w-9 h-9 rounded-full bg-indigo-100 border border-indigo-200 flex items-center justify-center text-indigo-700 font-bold text-sm">
                        S</div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-slate-700 truncate">Student</p>
                    </div>
                </div>
            </div>
        </aside>

        <div class="flex-1 flex flex-col h-screen overflow-hidden relative">

            <header class="h-16 bg-white border-b border-slate-200 flex items-center justify-between px-8">
                <div class="flex items-center gap-4">
                    <a href="/student/dashboard"
                        class="p-2 -ml-2 text-slate-400 hover:text-slate-700 hover:bg-slate-100 rounded-lg transition-colors">
                        <i data-lucide="arrow-left" class="w-5 h-5"></i>
                    </a>
                    <div class="h-6 w-px bg-slate-200"></div>
                    <div>
                        <h2 class="text-lg font-bold text-slate-800">{{ $brief->get_title() }}</h2>
                        <div class="flex items-center gap-2 text-xs text-slate-500">
                            <span class="font-medium text-indigo-600">{{ $sprint->get_name() }}</span>
                            <span>•</span>
                            <span>Deadline: {{ date('M d, H:i', strtotime($brief->get_date_remise())) }}</span>
                        </div>
                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-y-auto p-8">
                <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-3 gap-8">

                    <div class="lg:col-span-2 space-y-6">

                        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-8">
                            <h3 class="text-lg font-bold text-slate-800 mb-4 flex items-center gap-2">
                                <i data-lucide="file-text" class="w-5 h-5 text-indigo-500"></i> Project Context
                            </h3>
                            <div class="prose prose-slate max-w-none text-slate-600 leading-relaxed">
                                {!! nl2br(e($brief->get_description())) !!}
                            </div>
                        </div>

                        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50">
                                <h3 class="font-bold text-slate-800">Target Competencies</h3>
                            </div>
                            <div class="divide-y divide-slate-100">
                                @forelse($competences as $comp)
                                    <div class="p-4 flex items-start gap-4 hover:bg-slate-50 transition-colors">
                                        <div
                                            class="w-10 h-10 rounded-lg bg-indigo-50 border border-indigo-100 flex-shrink-0 flex items-center justify-center text-indigo-700 font-bold text-sm">
                                            {{ $comp->get_code() }}
                                        </div>
                                        <div>
                                            <h4 class="text-sm font-bold text-slate-800">{{ $comp->get_libelle() }}</h4>
                                            <p class="text-xs text-slate-500 mt-0.5">
                                                {{ $comp->description ?? 'No description available' }}</p>
                                            <div
                                                class="mt-2 inline-flex items-center px-2 py-1 rounded text-[10px] font-mono bg-slate-100 text-slate-600 border border-slate-200">
                                                Target Level: <strong
                                                    class="ml-1 text-indigo-600">{{ $comp->level ?? 'N/A' }}</strong>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="p-6 text-center text-slate-400 italic">No specific competencies listed.
                                    </div>
                                @endforelse
                            </div>
                        </div>

                    </div>

                    <div class="space-y-6">

                        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6">
                            <h3 class="text-sm font-bold text-slate-400 uppercase tracking-wider mb-4">Current Status</h3>

                            @php
                                $status = 'todo';
                                if ($brief->review_status) {
                                    $status = 'done';
                                } elseif ($brief->get_repo_link()) {
                                    $status = 'submitted';
                                }
                            @endphp

                            @if ($status == 'done')
                                <div class="text-center py-4">
                                    <div
                                        class="w-16 h-16 bg-emerald-100 rounded-full flex items-center justify-center mx-auto mb-3 text-emerald-600">
                                        <i data-lucide="check-check" class="w-8 h-8"></i>
                                    </div>
                                    <h4 class="text-xl font-bold text-emerald-700">Evaluated</h4>
                                    <p class="text-sm text-emerald-600/80 mt-1 font-medium capitalize">
                                        {{ $brief->review_status }}</p>

                                    @if ($brief->get_repo_link())
                                        <div class="mt-6 pt-6 border-t border-slate-100">
                                            <p class="text-xs text-slate-400 mb-2">Teacher's Feedback</p>
                                            <p class="text-sm text-slate-600 italic">"Good work on the structure."</p>
                                        </div>
                                    @endif
                                </div>
                            @elseif($status == 'submitted')
                                <div class="text-center py-4">
                                    <div
                                        class="w-16 h-16 bg-amber-100 rounded-full flex items-center justify-center mx-auto mb-3 text-amber-600">
                                        <i data-lucide="clock" class="w-8 h-8"></i>
                                    </div>
                                    <h4 class="text-xl font-bold text-slate-800">Pending Review</h4>
                                    <p class="text-sm text-slate-500 mt-1">You submitted this on
                                        {{ date('M d', strtotime($brief->livrable->get_date_submitted() ?? 'now')) }}</p>

                                    <div class="mt-6 pt-6 border-t border-slate-100 text-left">
                                        <label class="text-xs font-bold text-slate-400 uppercase block mb-2">Your
                                            Repository</label>
                                        <a href="{{ $brief->get_repo_link() }}" target="_blank"
                                            class="flex items-center gap-2 p-3 rounded-lg bg-slate-50 border border-slate-200 text-indigo-600 hover:border-indigo-300 hover:shadow-sm transition-all group">
                                            <i data-lucide="github"
                                                class="w-4 h-4 text-slate-400 group-hover:text-indigo-600"></i>
                                            <span class="text-sm font-medium truncate">{{ $brief->get_repo_link() }}</span>
                                            <i data-lucide="external-link" class="w-3 h-3 ml-auto opacity-50"></i>
                                        </a>
                                        @if ($brief->livrable->get_comment())
                                            <div class="mt-3">
                                                <label class="text-xs font-bold text-slate-400 uppercase block mb-1">Your
                                                    Comment</label>
                                                <p
                                                    class="text-sm text-slate-600 bg-slate-50 p-2 rounded border border-slate-100">
                                                    {{ $brief->livrable->get_comment() }}</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @else
                                <div class="text-center py-4">
                                    <div
                                        class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-3 text-slate-400">
                                        <i data-lucide="code-2" class="w-8 h-8"></i>
                                    </div>
                                    <h4 class="text-xl font-bold text-slate-800">Ready to Submit?</h4>
                                    <p class="text-sm text-slate-500 mt-1">Paste your GitHub link below when you are done.
                                    </p>

                                    <form action="/student/brief/submit" method="POST" class="mt-6 text-left">
                                        <input type="hidden" name="brief_id" value="{{ $brief->get_id() }}">

                                        <div class="space-y-4">
                                            <div>
                                                <label class="block text-xs font-bold uppercase text-slate-500 mb-1">Repo
                                                    URL <span class="text-red-500">*</span></label>
                                                <div class="relative">
                                                    <i data-lucide="link"
                                                        class="absolute left-3 top-3 w-4 h-4 text-slate-400"></i>
                                                    <input type="url" name="repo_link" required
                                                        placeholder="https://github.com/..."
                                                        class="w-full pl-9 pr-3 py-2.5 rounded-lg border-slate-300 text-sm focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500">
                                                </div>
                                            </div>

                                            <div>
                                                <label
                                                    class="block text-xs font-bold uppercase text-slate-500 mb-1">Comments</label>
                                                <textarea name="comment" rows="2" placeholder="Any notes..."
                                                    class="w-full px-3 py-2 rounded-lg border-slate-300 text-sm focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500"></textarea>
                                            </div>

                                            <button type="submit"
                                                class="w-full py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-sm rounded-lg shadow-sm shadow-indigo-200 transition-all flex items-center justify-center gap-2">
                                                <i data-lucide="send" class="w-4 h-4"></i> Submit Project
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            @endif
                        </div>

                        <div class="bg-indigo-900 rounded-xl shadow-lg p-6 text-white overflow-hidden relative">
                            <div class="absolute -right-6 -top-6 w-24 h-24 bg-indigo-800 rounded-full blur-2xl opacity-50">
                            </div>
                            <h4 class="font-bold mb-2 relative z-10">Need Help?</h4>
                            <p class="text-sm text-indigo-200 mb-4 relative z-10">Don't forget to check the resources
                                shared by your teacher in the class channel.</p>
                            <button
                                class="text-xs font-bold bg-indigo-800 hover:bg-indigo-700 px-3 py-2 rounded transition-colors relative z-10">Contact
                                Teacher</button>
                        </div>

                    </div>
                </div>
            </main>
        </div>
    </div>
    <script>
        lucide.createIcons();
    </script>
@endsection
