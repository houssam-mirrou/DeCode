@extends('layout')

@section('title', 'Admin Dashboard - Decode')

@section('content')
    <div class="flex h-screen bg-slate-50 overflow-hidden font-sans">

        <aside
            class="w-72 bg-slate-900 text-slate-300 flex flex-col hidden md:flex border-r border-slate-800 shadow-xl z-20">
            <div class="h-20 flex items-center px-8 border-b border-slate-800/50 bg-slate-900">
                <div class="flex items-center gap-3">
                    <div class="bg-indigo-600 p-2 rounded-lg">
                        <i data-lucide="command" class="w-5 h-5 text-white"></i>
                    </div>
                    <h1 class="text-xl font-bold text-white tracking-wide">DECODE <span
                            class="text-xs text-indigo-400 font-medium ml-1">ADMIN</span></h1>
                </div>
            </div>

            <nav class="flex-1 px-4 py-8 space-y-2 overflow-y-auto custom-scrollbar">

                <a href="/"
                    class="flex items-center px-4 py-3 bg-indigo-600/10 text-indigo-400 border-l-4 border-indigo-500 rounded-r-lg transition-all">
                    <i data-lucide="layout-dashboard" class="w-5 h-5 mr-3"></i>
                    <span class="font-bold tracking-wide text-sm">Dashboard</span>
                </a>

                <div class="pt-6 pb-3 px-4 text-[10px] font-bold text-slate-500 uppercase tracking-widest">
                    Pedagogical Management
                </div>

                <a href="/admin/classes"
                    class="flex items-center px-4 py-3 hover:bg-slate-800/50 hover:text-white rounded-lg transition-all group">
                    <i data-lucide="school"
                        class="w-5 h-5 mr-3 text-slate-500 group-hover:text-indigo-400 transition-colors"></i>
                    <span class="font-medium text-sm">Classes</span>
                </a>

                <a href="/admin/competences"
                    class="flex items-center px-4 py-3 hover:bg-slate-800/50 hover:text-white rounded-lg transition-all group">
                    <i data-lucide="award"
                        class="w-5 h-5 mr-3 text-slate-500 group-hover:text-amber-400 transition-colors"></i>
                    <span class="font-medium text-sm">Competencies</span>
                </a>

                <a href="/admin/sprints"
                    class="flex items-center px-4 py-3 hover:bg-slate-800/50 hover:text-white rounded-lg transition-all group">
                    <i data-lucide="zap"
                        class="w-5 h-5 mr-3 text-slate-500 group-hover:text-yellow-400 transition-colors"></i>
                    <span class="font-medium text-sm">Sprints & Briefs</span>
                </a>

                <div class="pt-6 pb-3 px-4 text-[10px] font-bold text-slate-500 uppercase tracking-widest">
                    System & Users
                </div>

                <a href="/admin/users"
                    class="flex items-center px-4 py-3 hover:bg-slate-800/50 hover:text-white rounded-lg transition-all group">
                    <i data-lucide="users"
                        class="w-5 h-5 mr-3 text-slate-500 group-hover:text-emerald-400 transition-colors"></i>
                    <span class="font-medium text-sm">Users & Roles</span>
                </a>
            </nav>

            <div class="p-6 border-t border-slate-800/50 bg-slate-900/50">
                <div class="flex items-center gap-4 p-3 rounded-xl bg-slate-800/50 border border-slate-700/50">
                    <div
                        class="w-10 h-10 rounded-full bg-gradient-to-tr from-indigo-500 to-purple-600 flex items-center justify-center text-white font-bold text-sm shadow-lg ring-2 ring-slate-700">
                        SA
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-bold text-white truncate">Super Admin</p>
                        <p class="text-[10px] text-slate-400 truncate uppercase tracking-wider font-semibold">System Manager
                        </p>
                    </div>
                    <form action="/logout" method="POST">
                        <button type="submit"
                            class="text-slate-400 hover:text-red-400 p-2 rounded-lg hover:bg-slate-700/50 transition-colors"
                            title="Logout">
                            <i data-lucide="log-out" class="w-4 h-4"></i>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <div class="flex-1 flex flex-col h-screen overflow-hidden relative">

            <header
                class="h-20 bg-white/80 backdrop-blur-md border-b border-slate-200/60 flex items-center justify-between px-8 z-10 sticky top-0">
                <div class="flex items-center gap-4">
                    <div>
                        <h2 class="text-xl font-bold text-slate-800 tracking-tight">System Overview</h2>
                        <p class="text-xs text-slate-500 mt-0.5">Welcome back to the command center</p>
                    </div>
                    <div class="h-8 w-px bg-slate-200 mx-2"></div>
                    <span
                        class="px-3 py-1 bg-indigo-50 text-indigo-700 text-xs font-bold rounded-full border border-indigo-100 flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-indigo-600 animate-pulse"></span>
                        Academic Year 2025-2026
                    </span>
                </div>

                <div class="flex items-center gap-3">
                    <button
                        class="flex items-center gap-2 px-4 py-2 bg-white border border-slate-200 text-slate-600 text-sm font-bold rounded-lg hover:bg-slate-50 hover:text-slate-900 hover:border-slate-300 transition-all shadow-sm">
                        <i data-lucide="user-plus" class="w-4 h-4 text-slate-400"></i>
                        Add User
                    </button>
                    <button
                        class="flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white text-sm font-bold rounded-lg hover:bg-indigo-700 shadow-md shadow-indigo-200 transition-all transform hover:-translate-y-0.5">
                        <i data-lucide="plus" class="w-4 h-4"></i>
                        New Class
                    </button>
                </div>
            </header>

            <main class="flex-1 overflow-y-auto p-8 bg-slate-50 scroll-smooth">

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

                    <div
                        class="bg-white p-6 rounded-2xl border border-slate-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:shadow-lg transition-all duration-300 group">
                        <div class="flex justify-between items-start mb-6">
                            <div class="p-3 bg-blue-50 rounded-xl text-blue-600 group-hover:scale-110 transition-transform">
                                <i data-lucide="school" class="w-6 h-6"></i>
                            </div>
                            <span
                                class="text-[10px] font-bold text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-full border border-emerald-100 flex items-center gap-1">
                                <i data-lucide="trending-up" class="w-3 h-3"></i> +16%
                            </span>
                        </div>
                        <div class="text-4xl font-extrabold text-slate-800 tracking-tight mb-1">12</div>
                        <div class="text-sm text-slate-500 font-medium">Active Classes</div>
                    </div>

                    <div
                        class="bg-white p-6 rounded-2xl border border-slate-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:shadow-lg transition-all duration-300 group">
                        <div class="flex justify-between items-start mb-6">
                            <div
                                class="p-3 bg-indigo-50 rounded-xl text-indigo-600 group-hover:scale-110 transition-transform">
                                <i data-lucide="graduation-cap" class="w-6 h-6"></i>
                            </div>
                            <span
                                class="text-[10px] font-bold text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-full border border-emerald-100 flex items-center gap-1">
                                <i data-lucide="trending-up" class="w-3 h-3"></i> +5%
                            </span>
                        </div>
                        <div class="text-4xl font-extrabold text-slate-800 tracking-tight mb-1">340</div>
                        <div class="text-sm text-slate-500 font-medium">Total Learners</div>
                    </div>

                    <div
                        class="bg-white p-6 rounded-2xl border border-slate-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:shadow-lg transition-all duration-300 group">
                        <div class="flex justify-between items-start mb-6">
                            <div
                                class="p-3 bg-purple-50 rounded-xl text-purple-600 group-hover:scale-110 transition-transform">
                                <i data-lucide="presentation" class="w-6 h-6"></i>
                            </div>
                            <span
                                class="text-[10px] font-bold text-slate-600 bg-slate-100 px-2.5 py-1 rounded-full border border-slate-200">
                                Stable
                            </span>
                        </div>
                        <div class="text-4xl font-extrabold text-slate-800 tracking-tight mb-1">24</div>
                        <div class="text-sm text-slate-500 font-medium">Active Teachers</div>
                    </div>

                    <div
                        class="bg-white p-6 rounded-2xl border border-slate-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:shadow-lg transition-all duration-300 group">
                        <div class="flex justify-between items-start mb-6">
                            <div
                                class="p-3 bg-amber-50 rounded-xl text-amber-600 group-hover:scale-110 transition-transform">
                                <i data-lucide="target" class="w-6 h-6"></i>
                            </div>
                            <span
                                class="text-[10px] font-bold text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-full border border-emerald-100">
                                All Active
                            </span>
                        </div>
                        <div class="text-4xl font-extrabold text-slate-800 tracking-tight mb-1">18</div>
                        <div class="text-sm text-slate-500 font-medium">Competencies (C1-C18)</div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="px-8 py-6 border-b border-slate-100 flex justify-between items-center bg-white">
                        <div>
                            <h3 class="font-bold text-slate-800 text-lg">Class Progression</h3>
                            <p class="text-sm text-slate-500 mt-1">Real-time monitoring of sprints and assignments</p>
                        </div>
                        <a href="/admin/classes"
                            class="text-indigo-600 text-sm font-bold hover:text-indigo-800 flex items-center gap-1.5 transition-colors px-3 py-1.5 hover:bg-indigo-50 rounded-lg">
                            View All Classes <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr
                                    class="bg-slate-50/80 text-xs font-bold text-slate-500 uppercase tracking-wider border-b border-slate-100">
                                    <th class="px-8 py-4">Class Name</th>
                                    <th class="px-8 py-4">Assigned Teachers</th>
                                    <th class="px-8 py-4">Current Status</th>
                                    <th class="px-8 py-4 text-center">Cohort Size</th>
                                    <th class="px-8 py-4 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50">

                                <tr class="hover:bg-slate-50 transition-colors group">
                                    <td class="px-8 py-5">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="w-10 h-10 rounded-lg bg-indigo-50 flex items-center justify-center text-indigo-600">
                                                <i data-lucide="code-2" class="w-5 h-5"></i>
                                            </div>
                                            <div>
                                                <div class="font-bold text-slate-800">DevFullStack-2025</div>
                                                <div class="text-xs text-slate-500 font-medium mt-0.5">Year 1 • Section A
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-8 py-5">
                                        <div class="flex -space-x-3 hover:space-x-1 transition-all">
                                            <div class="w-9 h-9 rounded-full bg-white border-2 border-slate-100 flex items-center justify-center text-xs font-bold text-slate-600 shadow-sm ring-2 ring-white"
                                                title="Mr. Anderson">MA</div>
                                            <div class="w-9 h-9 rounded-full bg-indigo-100 border-2 border-white flex items-center justify-center text-xs font-bold text-indigo-600 shadow-sm ring-2 ring-white"
                                                title="Sarah Connor">SC</div>
                                        </div>
                                    </td>
                                    <td class="px-8 py-5">
                                        <div class="w-full max-w-[180px]">
                                            <div class="flex justify-between items-center mb-1.5">
                                                <span class="text-xs font-bold text-slate-700">Sprint 3: Database</span>
                                                <span class="text-[10px] font-bold text-emerald-600">Active</span>
                                            </div>
                                            <div class="w-full bg-slate-100 rounded-full h-1.5">
                                                <div class="bg-indigo-500 h-1.5 rounded-full" style="width: 75%"></div>
                                            </div>
                                            <div class="text-[10px] text-slate-400 mt-1.5 flex items-center gap-1">
                                                <i data-lucide="clock" class="w-3 h-3"></i> Ends in 4 days
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-8 py-5 text-center">
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-700 border border-slate-200">
                                            24 Students
                                        </span>
                                    </td>
                                    <td class="px-8 py-5 text-right">
                                        <button
                                            class="text-slate-400 hover:text-indigo-600 p-2 rounded-lg hover:bg-indigo-50 transition-colors">
                                            <i data-lucide="more-horizontal" class="w-5 h-5"></i>
                                        </button>
                                    </td>
                                </tr>

                                <tr class="hover:bg-slate-50 transition-colors group">
                                    <td class="px-8 py-5">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="w-10 h-10 rounded-lg bg-purple-50 flex items-center justify-center text-purple-600">
                                                <i data-lucide="database" class="w-5 h-5"></i>
                                            </div>
                                            <div>
                                                <div class="font-bold text-slate-800">Data-Engineer-Alpha</div>
                                                <div class="text-xs text-slate-500 font-medium mt-0.5">Year 2 • Section B
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-8 py-5">
                                        <div class="flex -space-x-3">
                                            <div
                                                class="w-9 h-9 rounded-full bg-purple-100 border-2 border-white flex items-center justify-center text-xs font-bold text-purple-600 shadow-sm ring-2 ring-white">
                                                JD</div>
                                        </div>
                                    </td>
                                    <td class="px-8 py-5">
                                        <div class="w-full max-w-[180px]">
                                            <div class="flex justify-between items-center mb-1.5">
                                                <span class="text-xs font-bold text-slate-700">Sprint 1: Python</span>
                                                <span class="text-[10px] font-bold text-amber-600">Ending Soon</span>
                                            </div>
                                            <div class="w-full bg-slate-100 rounded-full h-1.5">
                                                <div class="bg-amber-500 h-1.5 rounded-full" style="width: 90%"></div>
                                            </div>
                                            <div class="text-[10px] text-slate-400 mt-1.5 flex items-center gap-1">
                                                <i data-lucide="clock" class="w-3 h-3"></i> Ends tomorrow
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-8 py-5 text-center">
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-700 border border-slate-200">
                                            18 Students
                                        </span>
                                    </td>
                                    <td class="px-8 py-5 text-right">
                                        <button
                                            class="text-slate-400 hover:text-indigo-600 p-2 rounded-lg hover:bg-indigo-50 transition-colors">
                                            <i data-lucide="more-horizontal" class="w-5 h-5"></i>
                                        </button>
                                    </td>
                                </tr>

                                <tr class="hover:bg-slate-50 transition-colors group">
                                    <td class="px-8 py-5">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="w-10 h-10 rounded-lg bg-orange-50 flex items-center justify-center text-orange-600">
                                                <i data-lucide="server" class="w-5 h-5"></i>
                                            </div>
                                            <div>
                                                <div class="font-bold text-slate-800">DevOps-2025</div>
                                                <div class="text-xs text-slate-500 font-medium mt-0.5">Year 1 • Section C
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-8 py-5">
                                        <span
                                            class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-red-50 text-red-600 text-xs font-bold border border-red-100">
                                            <i data-lucide="alert-circle" class="w-3 h-3"></i> Unassigned
                                        </span>
                                    </td>
                                    <td class="px-8 py-5">
                                        <div class="flex items-center gap-2">
                                            <div class="w-2 h-2 rounded-full bg-slate-300"></div>
                                            <span class="text-sm font-medium text-slate-400">Not Started</span>
                                        </div>
                                    </td>
                                    <td class="px-8 py-5 text-center">
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-700 border border-slate-200">
                                            30 Students
                                        </span>
                                    </td>
                                    <td class="px-8 py-5 text-right">
                                        <button
                                            class="text-slate-400 hover:text-indigo-600 p-2 rounded-lg hover:bg-indigo-50 transition-colors">
                                            <i data-lucide="more-horizontal" class="w-5 h-5"></i>
                                        </button>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                    <div class="bg-slate-50/50 px-8 py-5 border-t border-slate-200 flex items-center justify-between">
                        <span class="text-xs font-medium text-slate-500">Showing <span
                                class="font-bold text-slate-800">3</span> of <span
                                class="font-bold text-slate-800">12</span> classes</span>
                        <div class="flex gap-3">
                            <button
                                class="px-4 py-2 text-xs font-bold text-slate-500 bg-white border border-slate-200 rounded-lg hover:bg-slate-50 hover:text-indigo-600 disabled:opacity-50 transition-colors shadow-sm">Previous</button>
                            <button
                                class="px-4 py-2 text-xs font-bold text-indigo-600 bg-white border border-indigo-200 rounded-lg hover:bg-indigo-50 hover:border-indigo-300 transition-colors shadow-sm">Next</button>
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
