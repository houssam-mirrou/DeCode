@extends('layout')

@section('title', 'Teacher Dashboard - Decode')

@section('content')
<div class="flex h-screen bg-slate-50 overflow-hidden">

    <aside class="w-64 bg-white border-r border-slate-200 hidden md:flex flex-col">
        <div class="h-16 flex items-center px-6 border-b border-slate-100">
            <h1 class="text-xl font-bold text-indigo-600 tracking-wider">DECODE <span class="text-xs text-slate-400 font-normal ml-1">TEACHER</span></h1>
        </div>

        <nav class="flex-1 px-3 py-6 space-y-1">
            <a href="/teacher/dashboard" class="flex items-center px-3 py-2.5 bg-indigo-50 text-indigo-700 rounded-lg transition-colors font-medium">
                <i data-lucide="layout-dashboard" class="w-5 h-5 mr-3 text-indigo-600"></i>
                Dashboard
            </a>
            
            <a href="/teacher/briefs" class="flex items-center px-3 py-2.5 text-slate-600 hover:bg-slate-50 hover:text-slate-900 rounded-lg transition-colors">
                <i data-lucide="file-code" class="w-5 h-5 mr-3 text-slate-400"></i>
                My Briefs
            </a>

            <a href="/teacher/evaluations" class="flex items-center px-3 py-2.5 text-slate-600 hover:bg-slate-50 hover:text-slate-900 rounded-lg transition-colors">
                <i data-lucide="check-circle" class="w-5 h-5 mr-3 text-slate-400"></i>
                Evaluations
                <span class="ml-auto bg-orange-100 text-orange-600 py-0.5 px-2 rounded-full text-xs font-bold">5</span>
            </a>

            <a href="/teacher/students" class="flex items-center px-3 py-2.5 text-slate-600 hover:bg-slate-50 hover:text-slate-900 rounded-lg transition-colors">
                <i data-lucide="users" class="w-5 h-5 mr-3 text-slate-400"></i>
                Students & Progress
            </a>
        </nav>

        <div class="p-4 border-t border-slate-100">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-full bg-indigo-100 border border-indigo-200 flex items-center justify-center text-indigo-700 font-bold text-sm">
                    TC
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-slate-700 truncate">Prof. Cohen</p>
                    <p class="text-xs text-slate-400 truncate">Lead Trainer</p>
                </div>
                <form action="/logout" method="POST">
                    <button type="submit" class="text-slate-400 hover:text-red-500 transition-colors p-1">
                        <i data-lucide="log-out" class="w-4 h-4"></i>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <div class="flex-1 flex flex-col h-screen overflow-hidden">
        
        <header class="h-16 bg-white border-b border-slate-200 flex items-center justify-between px-8 z-10">
            <div class="flex flex-col justify-center">
                <h2 class="text-lg font-bold text-slate-800">Class Overview</h2>
                <p class="text-xs text-slate-500">DevFullStack-2025 • Sprint 3</p>
            </div>
            
            <div class="flex items-center gap-4">
                <button class="flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 shadow-sm transition-colors">
                    <i data-lucide="pen-tool" class="w-4 h-4"></i>
                    New Evaluation
                </button>
            </div>
        </header>

        <main class="flex-1 overflow-y-auto p-8 bg-slate-50">
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                
                <div class="bg-white p-6 rounded-xl border-l-4 border-orange-500 shadow-sm">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-xs font-bold text-orange-500 uppercase tracking-wide">Pending Reviews</p>
                            <h3 class="text-3xl font-bold text-slate-800 mt-2">5</h3>
                            <p class="text-sm text-slate-400 mt-1">Students waiting for feedback</p>
                        </div>
                        <div class="p-2 bg-orange-50 rounded-lg text-orange-500">
                            <i data-lucide="clock" class="w-6 h-6"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl border-l-4 border-indigo-500 shadow-sm">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-xs font-bold text-indigo-500 uppercase tracking-wide">Current Brief</p>
                            <h3 class="text-lg font-bold text-slate-800 mt-2 truncate max-w-[150px]">PHP Session Handling</h3>
                            <p class="text-sm text-slate-400 mt-1">Due in 2 days</p>
                        </div>
                        <div class="p-2 bg-indigo-50 rounded-lg text-indigo-500">
                            <i data-lucide="zap" class="w-6 h-6"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl border-l-4 border-emerald-500 shadow-sm">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-xs font-bold text-emerald-500 uppercase tracking-wide">Class Average</p>
                            <h3 class="text-3xl font-bold text-slate-800 mt-2">82%</h3>
                            <p class="text-sm text-slate-400 mt-1">Competency validation rate</p>
                        </div>
                        <div class="p-2 bg-emerald-50 rounded-lg text-emerald-500">
                            <i data-lucide="bar-chart-2" class="w-6 h-6"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <div class="lg:col-span-2 bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center">
                        <h3 class="font-bold text-slate-800">Submitted Deliverables</h3>
                        <a href="#" class="text-sm text-indigo-600 hover:underline">View all</a>
                    </div>
                    
                    <div class="divide-y divide-slate-100">
                        <div class="p-4 hover:bg-slate-50 transition-colors flex items-center justify-between group">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-full bg-slate-200 flex items-center justify-center text-slate-600 font-bold text-xs">
                                    HS
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-slate-900">Houssam S.</p>
                                    <p class="text-xs text-slate-500">Brief: Laravel basics • Submitted 2h ago</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                <a href="#" class="text-slate-400 hover:text-indigo-600 text-xs font-medium flex items-center gap-1 group-hover:underline">
                                    <i data-lucide="external-link" class="w-3 h-3"></i> Repository
                                </a>
                                <button class="px-3 py-1.5 bg-indigo-600 text-white text-xs font-medium rounded hover:bg-indigo-700 transition-colors">
                                    Evaluate
                                </button>
                            </div>
                        </div>

                        <div class="p-4 hover:bg-slate-50 transition-colors flex items-center justify-between group">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-full bg-slate-200 flex items-center justify-center text-slate-600 font-bold text-xs">
                                    JD
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-slate-900">John Doe</p>
                                    <p class="text-xs text-slate-500">Brief: PHP Native • Submitted 5h ago</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                <a href="#" class="text-slate-400 hover:text-indigo-600 text-xs font-medium flex items-center gap-1 group-hover:underline">
                                    <i data-lucide="external-link" class="w-3 h-3"></i> Repository
                                </a>
                                <button class="px-3 py-1.5 bg-indigo-600 text-white text-xs font-medium rounded hover:bg-indigo-700 transition-colors">
                                    Evaluate
                                </button>
                            </div>
                        </div>

                        <div class="p-4 hover:bg-slate-50 transition-colors flex items-center justify-between group">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-full bg-slate-200 flex items-center justify-center text-slate-600 font-bold text-xs">
                                    AL
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-slate-900">Ada Lovelace</p>
                                    <p class="text-xs text-slate-500">Brief: Algorithm logic • Submitted 1d ago</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                <a href="#" class="text-slate-400 hover:text-indigo-600 text-xs font-medium flex items-center gap-1 group-hover:underline">
                                    <i data-lucide="external-link" class="w-3 h-3"></i> Repository
                                </a>
                                <button class="px-3 py-1.5 bg-indigo-600 text-white text-xs font-medium rounded hover:bg-indigo-700 transition-colors">
                                    Evaluate
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6">
                    <h3 class="font-bold text-slate-800 mb-4">Sprint Goals</h3>
                    
                    <div class="space-y-4">
                        <div>
                            <div class="flex justify-between text-xs mb-1">
                                <span class="font-medium text-slate-600">C1. Maquetter une application</span>
                                <span class="text-slate-400">85% Class mastery</span>
                            </div>
                            <div class="w-full bg-slate-100 rounded-full h-2">
                                <div class="bg-indigo-500 h-2 rounded-full" style="width: 85%"></div>
                            </div>
                        </div>

                        <div>
                            <div class="flex justify-between text-xs mb-1">
                                <span class="font-medium text-slate-600">C2. Base de données SQL</span>
                                <span class="text-slate-400">60% Class mastery</span>
                            </div>
                            <div class="w-full bg-slate-100 rounded-full h-2">
                                <div class="bg-yellow-500 h-2 rounded-full" style="width: 60%"></div>
                            </div>
                        </div>

                        <div>
                            <div class="flex justify-between text-xs mb-1">
                                <span class="font-medium text-slate-600">C3. Backend PHP</span>
                                <span class="text-slate-400">40% Class mastery</span>
                            </div>
                            <div class="w-full bg-slate-100 rounded-full h-2">
                                <div class="bg-orange-500 h-2 rounded-full" style="width: 40%"></div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 pt-6 border-t border-slate-100">
                        <button class="w-full py-2 border border-slate-300 rounded-lg text-sm text-slate-600 font-medium hover:bg-slate-50 transition-colors">
                            View Full Competency Matrix
                        </button>
                    </div>
                </div>

            </div>
        </main>
    </div>
</div>

@endsection