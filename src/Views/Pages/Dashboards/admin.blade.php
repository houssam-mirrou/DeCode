@extends('layout')

@section('title', 'Admin Dashboard - Decode')

@section('content')
<div class="flex h-screen bg-slate-50 overflow-hidden">

    <aside class="w-64 bg-slate-900 text-slate-300 flex flex-col hidden md:flex border-r border-slate-800">
        <div class="h-16 flex items-center px-6 border-b border-slate-800">
            <h1 class="text-xl font-bold text-indigo-500 tracking-wider">DECODE <span class="text-xs text-slate-500 font-normal">ADMIN</span></h1>
        </div>

        <nav class="flex-1 px-3 py-6 space-y-1">
            
            <a href="/" class="flex items-center px-3 py-2.5 bg-indigo-600 text-white rounded-lg transition-colors shadow-lg shadow-indigo-500/20">
                <i data-lucide="layout-dashboard" class="w-5 h-5 mr-3"></i>
                <span class="font-medium">Dashboard</span>
            </a>
            
            <div class="pt-4 pb-2 px-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">
                Pedagogical Structure
            </div>

            <a href="/admin/classes" class="flex items-center px-3 py-2.5 hover:bg-slate-800 hover:text-white rounded-lg transition-colors group">
                <i data-lucide="school" class="w-5 h-5 mr-3 text-slate-400 group-hover:text-white transition-colors"></i>
                Classes
            </a>

            <a href="/admin/competences" class="flex items-center px-3 py-2.5 hover:bg-slate-800 hover:text-white rounded-lg transition-colors group">
                <i data-lucide="award" class="w-5 h-5 mr-3 text-slate-400 group-hover:text-white transition-colors"></i>
                Competencies
            </a>

            <a href="/admin/sprints" class="flex items-center px-3 py-2.5 hover:bg-slate-800 hover:text-white rounded-lg transition-colors group">
                <i data-lucide="zap" class="w-5 h-5 mr-3 text-slate-400 group-hover:text-white transition-colors"></i>
                Sprints & Briefs
            </a>

            <div class="pt-4 pb-2 px-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">
                User Management
            </div>

            <a href="/admin/users" class="flex items-center px-3 py-2.5 hover:bg-slate-800 hover:text-white rounded-lg transition-colors group">
                <i data-lucide="users" class="w-5 h-5 mr-3 text-slate-400 group-hover:text-white transition-colors"></i>
                Users & Roles
            </a>
        </nav>

        <div class="p-4 border-t border-slate-800">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-full bg-gradient-to-tr from-indigo-500 to-purple-500 flex items-center justify-center text-white font-bold text-sm shadow-md">
                    AD
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-white truncate">Super Admin</p>
                    <p class="text-xs text-slate-500 truncate">System Manager</p>
                </div>
                <form action="/logout" method="POST">
                    <button type="submit" class="text-slate-400 hover:text-white p-1 rounded-md hover:bg-slate-800 transition-colors">
                        <i data-lucide="log-out" class="w-4 h-4"></i>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <div class="flex-1 flex flex-col h-screen overflow-hidden">
        
        <header class="h-16 bg-white border-b border-slate-200 flex items-center justify-between px-8 z-10">
            <div class="flex items-center gap-4">
                <h2 class="text-xl font-bold text-slate-800">System Overview</h2>
                <span class="px-3 py-1 bg-slate-100 text-slate-500 text-xs rounded-full border border-slate-200">Academic Year 2025-2026</span>
            </div>
            
            <div class="flex items-center gap-3">
                <button class="flex items-center gap-2 px-4 py-2 bg-white border border-slate-300 text-slate-700 text-sm font-medium rounded-lg hover:bg-slate-50 transition-colors">
                    <i data-lucide="user-plus" class="w-4 h-4"></i>
                    Add User
                </button>
                <button class="flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 shadow-sm shadow-indigo-200 transition-colors">
                    <i data-lucide="plus" class="w-4 h-4"></i>
                    New Class
                </button>
            </div>
        </header>

        <main class="flex-1 overflow-y-auto p-8 bg-slate-50">
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                
                <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex justify-between items-start mb-4">
                        <div class="p-2 bg-blue-50 rounded-lg text-blue-600">
                            <i data-lucide="school" class="w-6 h-6"></i>
                        </div>
                        <span class="text-xs font-medium text-emerald-600 bg-emerald-50 px-2 py-1 rounded-full">+2 this month</span>
                    </div>
                    <div class="text-3xl font-bold text-slate-800">12</div>
                    <div class="text-sm text-slate-500 font-medium">Active Classes</div>
                </div>

                <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex justify-between items-start mb-4">
                        <div class="p-2 bg-indigo-50 rounded-lg text-indigo-600">
                            <i data-lucide="graduation-cap" class="w-6 h-6"></i>
                        </div>
                    </div>
                    <div class="text-3xl font-bold text-slate-800">340</div>
                    <div class="text-sm text-slate-500 font-medium">Total Learners</div>
                </div>

                <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex justify-between items-start mb-4">
                        <div class="p-2 bg-purple-50 rounded-lg text-purple-600">
                            <i data-lucide="presentation" class="w-6 h-6"></i>
                        </div>
                    </div>
                    <div class="text-3xl font-bold text-slate-800">24</div>
                    <div class="text-sm text-slate-500 font-medium">Active Teachers</div>
                </div>

                <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex justify-between items-start mb-4">
                        <div class="p-2 bg-amber-50 rounded-lg text-amber-600">
                            <i data-lucide="target" class="w-6 h-6"></i>
                        </div>
                    </div>
                    <div class="text-3xl font-bold text-slate-800">18</div>
                    <div class="text-sm text-slate-500 font-medium">Competencies (C1-C18)</div>
                </div>
            </div>

            <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center bg-white">
                    <div>
                        <h3 class="font-bold text-slate-800 text-lg">Class Progression</h3>
                        <p class="text-sm text-slate-500">Monitor sprints and assignments</p>
                    </div>
                    <a href="/admin/classes" class="text-indigo-600 text-sm font-medium hover:text-indigo-800 flex items-center gap-1 transition-colors">
                        View All Classes <i data-lucide="arrow-right" class="w-4 h-4"></i>
                    </a>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50/50 text-xs font-semibold text-slate-500 uppercase tracking-wider border-b border-slate-100">
                                <th class="px-6 py-4">Class Name</th>
                                <th class="px-6 py-4">Assigned Teachers</th>
                                <th class="px-6 py-4">Current Sprint</th>
                                <th class="px-6 py-4 text-center">Students</th>
                                <th class="px-6 py-4 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            
                            <tr class="hover:bg-slate-50 transition-colors group">
                                <td class="px-6 py-4">
                                    <div class="font-semibold text-slate-900">DevFullStack-2025</div>
                                    <div class="text-xs text-slate-500">Year 1</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex -space-x-2">
                                        <div class="w-8 h-8 rounded-full bg-slate-200 border-2 border-white flex items-center justify-center text-xs font-bold text-slate-600" title="Mr. Anderson">MA</div>
                                        <div class="w-8 h-8 rounded-full bg-indigo-100 border-2 border-white flex items-center justify-center text-xs font-bold text-indigo-600" title="Sarah Connor">SC</div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <span class="w-2 h-2 rounded-full bg-green-500"></span>
                                        <span class="text-sm font-medium text-slate-700">Sprint 3: Database & SQL</span>
                                    </div>
                                    <div class="text-xs text-slate-400 mt-1 pl-4">Ends in 4 days</div>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-800">
                                        24
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <button class="text-slate-400 hover:text-indigo-600 p-2 rounded-full hover:bg-indigo-50 transition-colors">
                                        <i data-lucide="settings-2" class="w-4 h-4"></i>
                                    </button>
                                </td>
                            </tr>

                            <tr class="hover:bg-slate-50 transition-colors group">
                                <td class="px-6 py-4">
                                    <div class="font-semibold text-slate-900">Data-Engineer-Alpha</div>
                                    <div class="text-xs text-slate-500">Year 2</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex -space-x-2">
                                        <div class="w-8 h-8 rounded-full bg-purple-100 border-2 border-white flex items-center justify-center text-xs font-bold text-purple-600">JD</div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                                        <span class="text-sm font-medium text-slate-700">Sprint 1: Python Basics</span>
                                    </div>
                                    <div class="text-xs text-slate-400 mt-1 pl-4">Ends tomorrow</div>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-800">
                                        18
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <button class="text-slate-400 hover:text-indigo-600 p-2 rounded-full hover:bg-indigo-50 transition-colors">
                                        <i data-lucide="settings-2" class="w-4 h-4"></i>
                                    </button>
                                </td>
                            </tr>

                            <tr class="hover:bg-slate-50 transition-colors group">
                                <td class="px-6 py-4">
                                    <div class="font-semibold text-slate-900">DevOps-2025</div>
                                    <div class="text-xs text-slate-500">Year 1</div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-xs text-red-400 italic flex items-center gap-1">
                                        <i data-lucide="alert-circle" class="w-3 h-3"></i> No teacher
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <span class="w-2 h-2 rounded-full bg-slate-300"></span>
                                        <span class="text-sm font-medium text-slate-500">Not Started</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-800">
                                        30
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <button class="text-slate-400 hover:text-indigo-600 p-2 rounded-full hover:bg-indigo-50 transition-colors">
                                        <i data-lucide="settings-2" class="w-4 h-4"></i>
                                    </button>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
                
                <div class="bg-slate-50 px-6 py-4 border-t border-slate-200 flex items-center justify-between">
                    <span class="text-xs text-slate-500">Showing 3 of 12 classes</span>
                    <div class="flex gap-2">
                        <button class="px-3 py-1 text-xs font-medium text-slate-600 bg-white border border-slate-300 rounded hover:bg-slate-50 disabled:opacity-50">Previous</button>
                        <button class="px-3 py-1 text-xs font-medium text-slate-600 bg-white border border-slate-300 rounded hover:bg-slate-50">Next</button>
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