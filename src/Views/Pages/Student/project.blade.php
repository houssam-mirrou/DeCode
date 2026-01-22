@extends('layout')

@section('title', 'All Projects - Student')

@section('content')
    <div class="flex h-screen bg-slate-50 overflow-hidden">

        <aside class="w-64 bg-white border-r border-slate-200 hidden md:flex flex-col z-20">
            <div class="h-16 flex items-center px-6 border-b border-slate-100">
                <h1 class="text-xl font-bold text-indigo-600 tracking-wider">DECODE <span class="text-xs text-slate-400 font-normal ml-1">STUDENT</span></h1>
            </div>
            <nav class="flex-1 px-3 py-6 space-y-1">
                <a href="/student/dashboard" class="flex items-center px-3 py-2.5 text-slate-600 hover:bg-slate-50 hover:text-slate-900 rounded-lg transition-colors">
                    <i data-lucide="layout-dashboard" class="w-5 h-5 mr-3 text-slate-400"></i> Dashboard
                </a>
                <a href="/student/briefs" class="flex items-center px-3 py-2.5 bg-indigo-50 text-indigo-700 font-medium rounded-lg transition-colors">
                    <i data-lucide="folder-git-2" class="w-5 h-5 mr-3 text-indigo-600"></i> My Projects
                </a>
            </nav>
            <div class="p-4 border-t border-slate-100">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-full bg-indigo-100 border border-indigo-200 flex items-center justify-center text-indigo-700 font-bold text-sm">S</div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-slate-700 truncate">Student</p>
                    </div>
                </div>
            </div>
        </aside>

        <div class="flex-1 flex flex-col h-screen overflow-hidden relative">

            <header class="h-16 bg-white border-b border-slate-200 flex items-center justify-between px-8 z-10">
                <div>
                    <h2 class="text-lg font-bold text-slate-800">My Projects</h2>
                    <p class="text-xs text-slate-500">Archive of all sprints and assignments</p>
                </div>
                
                <div class="flex bg-slate-100 p-1 rounded-lg">
                    <button class="px-3 py-1 text-xs font-bold bg-white text-indigo-600 shadow-sm rounded-md">All</button>
                    <button class="px-3 py-1 text-xs font-medium text-slate-500 hover:text-slate-700">Active</button>
                    <button class="px-3 py-1 text-xs font-medium text-slate-500 hover:text-slate-700">Completed</button>
                </div>
            </header>

            <main class="flex-1 overflow-y-auto p-8 bg-slate-50">
                <div class="max-w-6xl mx-auto space-y-8">

                    @forelse($sprints ?? [] as $sprintGroup)
                        @php 
                            $sprint = $sprintGroup['sprint']; 
                            $briefs = $sprintGroup['briefs'];
                        @endphp
                        
                        <div>
                            <div class="flex items-center gap-3 mb-4">
                                <h3 class="text-lg font-bold text-slate-800">{{ $sprint->get_name() }}</h3>
                                <div class="h-px flex-1 bg-slate-200"></div>
                                <span class="text-xs font-mono text-slate-400">{{ $sprint->get_start_date() }} — {{ $sprint->get_end_date() }}</span>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                @forelse($briefs as $briefGroup)
                                    @php
                                        $brief = $briefGroup['brief'];
                                        
                                        // Status Logic
                                        $status = 'todo';
                                        if ($brief->get_review_status()) $status = 'done';
                                        elseif ($brief->get_repo_link()) $status = 'submitted';
                                        
                                        // Status Colors
                                        $badgeClass = match($status) {
                                            'done' => 'bg-emerald-100 text-emerald-700 border-emerald-200',
                                            'submitted' => 'bg-amber-100 text-amber-700 border-amber-200',
                                            default => 'bg-slate-100 text-slate-600 border-slate-200'
                                        };
                                        
                                        $badgeLabel = match($status) {
                                            'done' => 'Validated',
                                            'submitted' => 'Under Review',
                                            default => 'In Progress'
                                        };
                                    @endphp

                                    <a href="/student/brief/{{ $brief->get_id() }}" class="group block bg-white rounded-xl border border-slate-200 shadow-sm hover:shadow-md hover:border-indigo-200 transition-all flex flex-col h-full">
                                        <div class="p-6 flex-1">
                                            <div class="flex items-start justify-between mb-4">
                                                <div class="w-10 h-10 rounded-lg bg-indigo-50 flex items-center justify-center text-indigo-600 group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                                                    <i data-lucide="file-code" class="w-5 h-5"></i>
                                                </div>
                                                <span class="px-2 py-1 rounded text-[10px] font-bold uppercase tracking-wider border {{ $badgeClass }}">
                                                    {{ $badgeLabel }}
                                                </span>
                                            </div>
                                            
                                            <h4 class="font-bold text-slate-800 mb-2 group-hover:text-indigo-600 transition-colors">{{ $brief->get_title() }}</h4>
                                            <p class="text-sm text-slate-500 line-clamp-3">{{ $brief->get_description() }}</p>
                                        </div>
                                        
                                        <div class="px-6 py-4 border-t border-slate-50 bg-slate-50/50 rounded-b-xl flex items-center justify-between">
                                            <div class="flex items-center gap-2 text-xs text-slate-400">
                                                <i data-lucide="clock" class="w-3 h-3"></i>
                                                <span>Deadline: {{ date('M d', strtotime($brief->get_date_remise())) }}</span>
                                            </div>
                                            <span class="text-xs font-bold text-indigo-600 opacity-0 group-hover:opacity-100 transition-opacity flex items-center gap-1">
                                                View Details <i data-lucide="arrow-right" class="w-3 h-3"></i>
                                            </span>
                                        </div>
                                    </a>
                                @empty
                                    <div class="col-span-full py-8 text-center text-slate-400 text-sm border-2 border-dashed border-slate-100 rounded-xl">
                                        No projects assigned in this sprint yet.
                                    </div>
                                @endforelse
                            </div>
                        </div>

                    @empty
                        <div class="text-center py-20">
                            <div class="bg-slate-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i data-lucide="coffee" class="w-8 h-8 text-slate-400"></i>
                            </div>
                            <h3 class="text-lg font-medium text-slate-900">No Projects Found</h3>
                            <p class="text-slate-500 mt-1">Check back later when sprints are assigned.</p>
                        </div>
                    @endforelse

                </div>
            </main>
        </div>
    </div>
    <script>lucide.createIcons();</script>
@endsection