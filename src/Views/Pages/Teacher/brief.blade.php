@extends('layout')

@section('title', 'My Briefs - Decode')

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
                    class="flex items-center px-3 py-2.5 bg-indigo-50 text-indigo-700 font-medium rounded-lg transition-colors">
                    <i data-lucide="file-code" class="w-5 h-5 mr-3 text-indigo-600"></i> My Briefs
                </a>
                <a href="/teacher/evaluations"
                    class="flex items-center px-3 py-2.5 text-slate-600 hover:bg-slate-50 hover:text-slate-900 rounded-lg transition-colors">
                    <i data-lucide="check-circle" class="w-5 h-5 mr-3 text-slate-400"></i> Evaluations
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

        <div class="flex-1 flex flex-col h-screen overflow-hidden relative z-0">

            <header class="h-16 bg-white border-b border-slate-200 flex items-center justify-between px-8 z-10">
                <div>
                    <h2 class="text-lg font-bold text-slate-800">Briefs & Curriculum</h2>
                    <p class="text-xs text-slate-500">Manage sprints and assign projects</p>
                </div>
                <button onclick="openBriefModal()"
                    class="flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition-colors shadow-sm shadow-indigo-200">
                    <i data-lucide="plus" class="w-4 h-4"></i> Create Brief
                </button>
            </header>

            <main class="flex-1 overflow-y-auto p-8 bg-slate-50">
                <div class="max-w-6xl mx-auto space-y-8">

                    {{-- LOOP THROUGH SPRINTS (Using the new nested structure) --}}
                    @forelse($sprints ?? [] as $sprintGroup)
                        @php
                            $sprint = $sprintGroup['sprint'];
                            $briefsList = $sprintGroup['briefs'];
                        @endphp

                        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                            <div
                                class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="w-10 h-10 rounded-lg bg-white border border-slate-200 shadow-sm flex items-center justify-center text-indigo-600 font-bold text-sm">
                                        S{{ $loop->iteration }}
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-slate-800">{{ $sprint->get_name() }}</h3>
                                        <div class="flex items-center gap-2 text-xs text-slate-500">
                                            <i data-lucide="calendar" class="w-3 h-3"></i>
                                            <span>{{ $sprint->get_start_date() }} — {{ $sprint->get_end_date() }}</span>
                                        </div>
                                    </div>
                                </div>
                                <button onclick="openBriefModal({{ $sprint->get_id() }})"
                                    class="text-xs font-medium text-indigo-600 bg-indigo-50 px-3 py-1.5 rounded-md hover:bg-indigo-100 transition-colors">
                                    + Add Brief
                                </button>
                            </div>

                            <div class="divide-y divide-slate-100">
                                @forelse($briefsList as $briefGroup)
                                    @php
                                        $brief = $briefGroup['brief'];
                                        $briefCompetences = $briefGroup['competences'];
                                    @endphp

                                    <div
                                        class="p-4 hover:bg-slate-50 transition-colors flex items-center justify-between group">
                                        <div class="flex items-center gap-4">
                                            <div
                                                class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 group-hover:bg-white group-hover:shadow-sm transition-all">
                                                <i data-lucide="file-code" class="w-5 h-5"></i>
                                            </div>
                                            <div>
                                                <h4
                                                    class="text-sm font-bold text-slate-800 group-hover:text-indigo-600 transition-colors">
                                                    {{ $brief->get_title() }}
                                                </h4>
                                                <div class="flex items-center gap-3 mt-1.5">
                                                    <span
                                                        class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider bg-green-100 text-green-700">Assigned</span>
                                                    <div class="flex gap-1">
                                                        @foreach ($briefCompetences as $comp)
                                                            <span
                                                                class="px-1.5 py-0.5 rounded border border-slate-200 text-[10px] text-slate-500 font-mono bg-white"
                                                                title="{{ $comp->get_libelle() }}">
                                                                {{ $comp->get_code() }}
                                                                {{-- Try different ways to get level depending on your Mapper --}}
                                                                <span
                                                                    class="text-indigo-600 font-bold">L{{ $comp->get_level() }}</span>
                                                            </span>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div
                                            class="flex items-center gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                            @if (method_exists($brief, 'is_assigned') && !$brief->is_assigned())
                                                <button
                                                    class="px-3 py-1.5 mr-2 text-xs font-medium bg-indigo-600 text-white rounded shadow-sm hover:bg-indigo-500 transition-colors">
                                                    Assign Now
                                                </button>
                                            @endif
                                            <button onclick="openEditBriefModal(this)" data-id="{{ $brief->get_id() }}"
                                                data-title="{{ $brief->get_title() }}"
                                                data-description="{{ $brief->get_description() }}"
                                                data-date="{{ $brief->get_date_remise() }}"
                                                data-type="{{ $brief->get_type() }}" data-sprint="{{ $sprint->get_id() }}"
                                                {{-- NEW: Pass competencies as a JSON string --}}
                                                data-competences="{{ json_encode(
                                                    array_map(function ($c) {
                                                        return ['id' => $c->get_id(), 'level' => method_exists($c, 'get_level') ? $c->get_level() : $c->level];
                                                    }, $briefCompetences),
                                                ) }}"
                                                class="p-2 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-all">
                                                <i data-lucide="pencil" class="w-4 h-4"></i>
                                            </button>

                                            <button
                                                onclick="openDeleteBriefModal({{ $brief->get_id() }}, '{{ addslashes($brief->get_title()) }}')"
                                                class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all">
                                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                                            </button>
                                        </div>
                                    </div>
                                @empty
                                    <div class="py-8 flex flex-col items-center justify-center text-slate-400">
                                        <i data-lucide="clipboard" class="w-8 h-8 mb-2 opacity-20"></i>
                                        <p class="text-sm italic">No briefs in this sprint yet.</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-20">
                            <div class="bg-slate-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i data-lucide="layers" class="w-8 h-8 text-slate-400"></i>
                            </div>
                            <h3 class="text-lg font-medium text-slate-900">No Sprints Found</h3>
                            <p class="text-slate-500 mt-1">Wait for an admin to define the pedagogical structure.</p>
                        </div>
                    @endforelse

                </div>
            </main>
        </div>
    </div>

    <div id="briefModal" class="fixed inset-0 z-50 hidden" role="dialog" aria-modal="true">

        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" onclick="closeBriefModal()"></div>

        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6 pointer-events-none">

            <div
                class="pointer-events-auto relative w-full max-w-2xl max-h-[90vh] flex flex-col bg-white rounded-xl shadow-2xl ring-1 ring-slate-900/5">

                <form action="/teacher/brief/create" method="POST" class="flex flex-col h-full min-h-0">

                    <div
                        class="flex-none flex items-center justify-between border-b border-slate-100 px-6 py-4 bg-white rounded-t-xl">
                        <div class="flex items-center gap-3">
                            <div
                                class="flex h-10 w-10 items-center justify-center rounded-full bg-indigo-50 text-indigo-600 ring-4 ring-indigo-50/50">
                                <i data-lucide="file-plus" class="h-5 w-5"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-slate-900 leading-none">Create New Brief</h3>
                                <p class="text-xs font-medium text-slate-500 mt-1">Define scope, timeline & skills</p>
                            </div>
                        </div>
                        <button type="button" onclick="closeBriefModal()"
                            class="rounded-full p-2 text-slate-400 hover:bg-slate-100 hover:text-slate-600 transition-colors">
                            <i data-lucide="x" class="h-5 w-5"></i>
                        </button>
                    </div>

                    <div class="flex-1 overflow-y-auto p-6 bg-slate-50/50 min-h-0">

                        <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                            <div class="col-span-2">
                                <label class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-500">
                                    Brief Title <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="title" required
                                    placeholder="e.g. MVC Framework Implementation"
                                    class="w-full rounded-lg border-slate-300 px-3 py-2.5 text-sm font-medium shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none">
                            </div>

                            <div>
                                <label class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-500">
                                    Target Sprint <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <select name="sprint_id" id="modal_sprint_select" required
                                        class="w-full appearance-none rounded-lg border-slate-300 bg-white px-3 py-2.5 text-sm font-medium shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none">
                                        <option disabled selected>-- Select Sprint --</option>
                                        @foreach ($sprints ?? [] as $sprintGroup)
                                            @php $s = $sprintGroup['sprint']; @endphp
                                            <option value="{{ $s->get_id() }}">{{ $s->get_name() }}</option>
                                        @endforeach
                                    </select>
                                    <i data-lucide="chevron-down"
                                        class="absolute right-3 top-1/2 -translate-y-1/2 h-4 w-4 text-slate-400 pointer-events-none"></i>
                                </div>
                            </div>

                            <div>
                                <label class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-500">
                                    Project Type <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <select name="type" required
                                        class="w-full appearance-none rounded-lg border-slate-300 bg-white px-3 py-2.5 text-sm font-medium shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none">
                                        <option value="individuel" selected>Individual Project</option>
                                        <option value="collectif">Group Project</option>
                                    </select>
                                    <i data-lucide="chevron-down"
                                        class="absolute right-3 top-1/2 -translate-y-1/2 h-4 w-4 text-slate-400 pointer-events-none"></i>
                                </div>
                            </div>

                            <div class="col-span-2">
                                <label class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-500">
                                    Deadline <span class="text-red-500">*</span>
                                </label>
                                <input type="datetime-local" name="date_remise" required
                                    class="w-full rounded-lg border-slate-300 px-3 py-2.5 text-sm font-medium shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none">
                            </div>

                            <div class="col-span-2">
                                <label class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-500">
                                    Description <span class="text-red-500">*</span>
                                </label>
                                <textarea name="description" rows="3" required placeholder="Enter brief requirements..."
                                    class="w-full rounded-lg border-slate-300 px-3 py-2.5 text-sm font-medium shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 focus:outline-none"></textarea>
                            </div>
                        </div>

                        <div class="relative my-8">
                            <div class="absolute inset-0 flex items-center" aria-hidden="true">
                                <div class="w-full border-t border-slate-200"></div>
                            </div>
                            <div class="relative flex justify-start">
                                <span
                                    class="bg-slate-50 pr-3 text-sm font-bold text-slate-800 uppercase tracking-wider">Competencies</span>
                            </div>
                        </div>

                        <div class="space-y-3 pb-10">
                            @forelse ($competences ?? [] as $comp)
                                <div
                                    class="group relative rounded-lg border border-slate-200 bg-white p-4 shadow-sm transition-all hover:border-indigo-300 hover:shadow-md has-[:checked]:border-indigo-500 has-[:checked]:bg-indigo-50/20 has-[:checked]:ring-1 has-[:checked]:ring-indigo-500">

                                    <div class="flex items-start gap-3">
                                        <div class="flex h-6 items-center">
                                            <input type="checkbox" id="comp_{{ $comp->get_id() }}"
                                                name="competences[{{ $comp->get_id() }}][checked]"
                                                class="h-5 w-5 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500 cursor-pointer"
                                                onchange="toggleLevelSelect({{ $comp->get_id() }})">
                                        </div>
                                        <div class="flex-1">
                                            <label for="comp_{{ $comp->get_id() }}" class="cursor-pointer select-none">
                                                <span
                                                    class="block text-sm font-bold text-slate-900">{{ $comp->get_code() }}</span>
                                                <span
                                                    class="block text-sm text-slate-500 group-hover:text-slate-700">{{ $comp->get_libelle() }}</span>
                                            </label>

                                            <div id="level_select_{{ $comp->get_id() }}"
                                                class="hidden mt-4 pl-1 animate-in slide-in-from-top-2 duration-200 fade-in">
                                                <div class="flex flex-wrap gap-2">

                                                    <label class="cursor-pointer group/lvl">
                                                        <input type="radio"
                                                            name="competences[{{ $comp->get_id() }}][level]"
                                                            value="1" class="peer sr-only">
                                                        <div
                                                            class="rounded-md border border-slate-200 bg-white px-3 py-1.5 text-xs font-bold text-slate-500 shadow-sm transition-all hover:border-emerald-500 peer-checked:border-emerald-500 peer-checked:bg-emerald-500 peer-checked:text-white peer-checked:shadow-md">
                                                            Level 1 <span class="font-normal opacity-70 ml-1">-
                                                                Imitation</span>
                                                        </div>
                                                    </label>

                                                    <label class="cursor-pointer group/lvl">
                                                        <input type="radio"
                                                            name="competences[{{ $comp->get_id() }}][level]"
                                                            value="2" class="peer sr-only" checked>
                                                        <div
                                                            class="rounded-md border border-slate-200 bg-white px-3 py-1.5 text-xs font-bold text-slate-500 shadow-sm transition-all hover:border-indigo-600 peer-checked:border-indigo-600 peer-checked:bg-indigo-600 peer-checked:text-white peer-checked:shadow-md">
                                                            Level 2 <span class="font-normal opacity-70 ml-1">-
                                                                Adaptation</span>
                                                        </div>
                                                    </label>

                                                    <label class="cursor-pointer group/lvl">
                                                        <input type="radio"
                                                            name="competences[{{ $comp->get_id() }}][level]"
                                                            value="3" class="peer sr-only">
                                                        <div
                                                            class="rounded-md border border-slate-200 bg-white px-3 py-1.5 text-xs font-bold text-slate-500 shadow-sm transition-all hover:border-purple-600 peer-checked:border-purple-600 peer-checked:bg-purple-600 peer-checked:text-white peer-checked:shadow-md">
                                                            Level 3 <span class="font-normal opacity-70 ml-1">-
                                                                Transposition</span>
                                                        </div>
                                                    </label>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div
                                    class="flex flex-col items-center justify-center rounded-lg border-2 border-dashed border-slate-200 py-8 text-center bg-slate-50">
                                    <i data-lucide="alert-circle" class="h-8 w-8 text-slate-300 mb-2"></i>
                                    <p class="text-sm font-medium text-slate-500">No competencies available.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <div
                        class="flex-none border-t border-slate-100 bg-white px-6 py-4 flex flex-col-reverse sm:flex-row sm:justify-end gap-3 rounded-b-xl z-20">
                        <button type="button" onclick="closeBriefModal()"
                            class="w-full sm:w-auto inline-flex justify-center rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-colors">
                            Cancel
                        </button>
                        <button type="submit"
                            class="w-full sm:w-auto inline-flex justify-center rounded-lg bg-indigo-600 px-6 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-colors">
                            Publish Brief
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <div id="editBriefModal" class="fixed inset-0 z-50 hidden" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" onclick="closeEditBriefModal()">
        </div>

        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6 pointer-events-none">
            <div
                class="pointer-events-auto relative w-full max-w-2xl max-h-[90vh] flex flex-col bg-white rounded-xl shadow-2xl ring-1 ring-slate-900/5">

                <form action="/teacher/brief/update" method="POST" class="flex flex-col h-full min-h-0">
                    <input type="hidden" name="id" id="edit_brief_id">

                    <div
                        class="flex-none flex items-center justify-between border-b border-slate-100 px-6 py-4 bg-white rounded-t-xl">
                        <div class="flex items-center gap-3">
                            <div
                                class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-50 text-blue-600 ring-4 ring-blue-50/50">
                                <i data-lucide="pencil" class="h-5 w-5"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-slate-900 leading-none">Edit Brief</h3>
                                <p class="text-xs font-medium text-slate-500 mt-1">Update details & competencies</p>
                            </div>
                        </div>
                        <button type="button" onclick="closeEditBriefModal()"
                            class="rounded-full p-2 text-slate-400 hover:bg-slate-100 hover:text-slate-600">
                            <i data-lucide="x" class="h-5 w-5"></i>
                        </button>
                    </div>

                    <div class="flex-1 overflow-y-auto p-6 bg-slate-50/50 min-h-0">
                        <div class="grid grid-cols-1 gap-5 md:grid-cols-2 mb-6">

                            <div class="col-span-2">
                                <label class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-500">Brief
                                    Title</label>
                                <input type="text" name="title" id="edit_title" required
                                    class="w-full rounded-lg border-slate-300 px-3 py-2.5 text-sm font-medium shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20">
                            </div>

                            <div>
                                <label
                                    class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-500">Sprint</label>
                                <div class="relative">
                                    <select name="sprint_id" id="edit_sprint_id" required
                                        class="w-full appearance-none rounded-lg border-slate-300 bg-white px-3 py-2.5 text-sm font-medium shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20">
                                        @foreach ($sprints ?? [] as $sprintGroup)
                                            @php $s = $sprintGroup['sprint']; @endphp
                                            <option value="{{ $s->get_id() }}">{{ $s->get_name() }}</option>
                                        @endforeach
                                    </select>
                                    <i data-lucide="chevron-down"
                                        class="absolute right-3 top-1/2 -translate-y-1/2 h-4 w-4 text-slate-400 pointer-events-none"></i>
                                </div>
                            </div>

                            <div>
                                <label
                                    class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-500">Type</label>
                                <div class="relative">
                                    <select name="type" id="edit_type" required
                                        class="w-full appearance-none rounded-lg border-slate-300 bg-white px-3 py-2.5 text-sm font-medium shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20">
                                        <option value="individuel">Individual Project</option>
                                        <option value="collectif">Group Project</option>
                                    </select>
                                    <i data-lucide="chevron-down"
                                        class="absolute right-3 top-1/2 -translate-y-1/2 h-4 w-4 text-slate-400 pointer-events-none"></i>
                                </div>
                            </div>

                            <div class="col-span-2">
                                <label
                                    class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-500">Deadline</label>
                                <input type="datetime-local" name="date_remise" id="edit_date_remise" required
                                    class="w-full rounded-lg border-slate-300 px-3 py-2.5 text-sm font-medium shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20">
                            </div>

                            <div class="col-span-2">
                                <label
                                    class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-500">Description</label>
                                <textarea name="description" id="edit_description" rows="3" required
                                    class="w-full rounded-lg border-slate-300 px-3 py-2.5 text-sm font-medium shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20"></textarea>
                            </div>
                        </div>

                        <div class="relative my-8">
                            <div class="absolute inset-0 flex items-center" aria-hidden="true">
                                <div class="w-full border-t border-slate-200"></div>
                            </div>
                            <div class="relative flex justify-start">
                                <span
                                    class="bg-slate-50 pr-3 text-sm font-bold text-slate-800 uppercase tracking-wider">Update
                                    Competencies</span>
                            </div>
                        </div>

                        <div class="space-y-3 pb-10">
                            @forelse ($competences ?? [] as $comp)
                                <div
                                    class="group relative rounded-lg border border-slate-200 bg-white p-4 shadow-sm transition-all hover:border-blue-300 hover:shadow-md has-[:checked]:border-blue-500 has-[:checked]:bg-blue-50/20">
                                    <div class="flex items-start gap-3">
                                        <div class="flex h-6 items-center">
                                            <input type="checkbox" id="edit_comp_{{ $comp->get_id() }}"
                                                name="competences[{{ $comp->get_id() }}][checked]"
                                                class="h-5 w-5 rounded border-slate-300 text-blue-600 focus:ring-blue-500 cursor-pointer"
                                                onchange="toggleEditLevelSelect({{ $comp->get_id() }})">
                                        </div>
                                        <div class="flex-1">
                                            <label for="edit_comp_{{ $comp->get_id() }}"
                                                class="cursor-pointer select-none">
                                                <span
                                                    class="block text-sm font-bold text-slate-900">{{ $comp->get_code() }}</span>
                                                <span
                                                    class="block text-sm text-slate-500 group-hover:text-slate-700">{{ $comp->get_libelle() }}</span>
                                            </label>

                                            <div id="edit_level_select_{{ $comp->get_id() }}" class="hidden mt-4 pl-1">
                                                <div class="flex flex-wrap gap-2">
                                                    @foreach ([1 => 'Imitation', 2 => 'Adaptation', 3 => 'Transposition'] as $val => $label)
                                                        <label class="cursor-pointer">
                                                            <input type="radio"
                                                                id="edit_lvl_{{ $comp->get_id() }}_{{ $val }}"
                                                                name="competences[{{ $comp->get_id() }}][level]"
                                                                value="{{ $val }}" class="peer sr-only"
                                                                {{ $val === 2 ? 'checked' : '' }}>
                                                            <div
                                                                class="rounded-md border border-slate-200 bg-white px-3 py-1.5 text-xs font-bold text-slate-500 shadow-sm transition-all hover:border-blue-600 peer-checked:border-blue-600 peer-checked:bg-blue-600 peer-checked:text-white">
                                                                Level {{ $val }} <span
                                                                    class="font-normal opacity-70 ml-1">-
                                                                    {{ $label }}</span>
                                                            </div>
                                                        </label>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p class="text-sm text-slate-500 text-center">No competencies found.</p>
                            @endforelse
                        </div>
                    </div>

                    <div
                        class="flex-none border-t border-slate-100 bg-white px-6 py-4 flex flex-col-reverse sm:flex-row sm:justify-end gap-3 rounded-b-xl">
                        <button type="button" onclick="closeEditBriefModal()"
                            class="w-full sm:w-auto inline-flex justify-center rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50">Cancel</button>
                        <button type="submit"
                            class="w-full sm:w-auto inline-flex justify-center rounded-lg bg-blue-600 px-6 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-500">Update
                            Brief</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="deleteBriefModal" class="fixed inset-0 z-50 hidden" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" onclick="closeDeleteBriefModal()">
        </div>

        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6 pointer-events-none">
            <div
                class="pointer-events-auto relative w-full max-w-md bg-white rounded-xl shadow-2xl ring-1 ring-slate-900/5">
                <div class="p-6">
                    <div class="flex items-center justify-center w-12 h-12 mx-auto bg-red-100 rounded-full">
                        <i data-lucide="alert-triangle" class="w-6 h-6 text-red-600"></i>
                    </div>
                    <div class="mt-4 text-center">
                        <h3 class="text-lg font-bold text-slate-900">Delete Brief?</h3>
                        <p class="mt-2 text-sm text-slate-500">
                            Are you sure you want to delete <span id="delete_brief_title"
                                class="font-bold text-slate-800">this brief</span>? This action cannot be undone.
                        </p>
                    </div>
                </div>
                <div class="flex flex-col-reverse gap-3 px-6 pb-6 sm:flex-row sm:justify-center">
                    <button type="button" onclick="closeDeleteBriefModal()"
                        class="w-full sm:w-auto inline-flex justify-center rounded-lg border border-slate-300 bg-white px-4 py-2 text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50">Cancel</button>

                    <form action="/teacher/brief/delete" method="POST" class="w-full sm:w-auto">
                        <input type="hidden" name="id" id="delete_brief_id">
                        <button type="submit"
                            class="w-full inline-flex justify-center rounded-lg bg-red-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500">Yes,
                            Delete It</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        lucide.createIcons();

        function openBriefModal(sprintId = null) {
            if (sprintId) {
                const select = document.getElementById('modal_sprint_select');
                if (select) select.value = sprintId;
            }
            document.getElementById('briefModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeBriefModal() {
            document.getElementById('briefModal').classList.add('hidden');
            document.body.style.overflow = '';
        }

        function toggleLevelSelect(id) {
            const checkbox = document.getElementById('comp_' + id);
            const selector = document.getElementById('level_select_' + id);

            if (checkbox.checked) {
                selector.classList.remove('hidden');
            } else {
                selector.classList.add('hidden');
            }
        }

        function openDeleteBriefModal(id, title) {
            document.getElementById('delete_brief_id').value = id;
            document.getElementById('delete_brief_title').textContent = title;
            document.getElementById('deleteBriefModal').classList.remove('hidden');
        }

        function closeDeleteBriefModal() {
            document.getElementById('deleteBriefModal').classList.add('hidden');
        }

        // --- TOGGLE FOR EDIT MODAL ---
        function toggleEditLevelSelect(id) {
            const checkbox = document.getElementById('edit_comp_' + id);
            const selector = document.getElementById('edit_level_select_' + id);
            if (checkbox.checked) {
                selector.classList.remove('hidden');
            } else {
                selector.classList.add('hidden');
            }
        }

        // --- OPEN EDIT MODAL ---
        function openEditBriefModal(button) {
            // 1. Basic Fields
            document.getElementById('edit_brief_id').value = button.dataset.id;
            document.getElementById('edit_title').value = button.dataset.title;
            document.getElementById('edit_description').value = button.dataset.description;
            document.getElementById('edit_date_remise').value = button.dataset.date;
            document.getElementById('edit_type').value = button.dataset.type;
            document.getElementById('edit_sprint_id').value = button.dataset.sprint;

            // 2. Reset all checkboxes first
            const allCheckboxes = document.querySelectorAll('[id^="edit_comp_"]');
            allCheckboxes.forEach(cb => {
                cb.checked = false;
                // Hide level selector
                const compId = cb.id.replace('edit_comp_', '');
                document.getElementById('edit_level_select_' + compId).classList.add('hidden');
            });

            // 3. Pre-fill Competencies
            const competences = JSON.parse(button.dataset.competences);

            competences.forEach(comp => {
                // Find checkbox for this competence ID
                const checkbox = document.getElementById('edit_comp_' + comp.id);
                if (checkbox) {
                    checkbox.checked = true;

                    // Show level selector
                    const levelSelector = document.getElementById('edit_level_select_' + comp.id);
                    levelSelector.classList.remove('hidden');

                    // Select the correct radio button for Level
                    // Map string levels (IMITER) to numbers (1,2,3) if necessary, 
                    // or ensure your Controller returns numbers.
                    let levelVal = 1;
                    if (comp.level == 'IMITER' || comp.level == 1) levelVal = 1;
                    if (comp.level == 'S_ADAPTER' || comp.level == 2) levelVal = 2;
                    if (comp.level == 'TRANSPOSER' || comp.level == 3) levelVal = 3;

                    const radio = document.getElementById(`edit_lvl_${comp.id}_${levelVal}`);
                    if (radio) radio.checked = true;
                }
            });

            document.getElementById('editBriefModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeEditBriefModal() {
            document.getElementById('editBriefModal').classList.add('hidden');
            document.body.style.overflow = '';
        }
    </script>
@endsection
