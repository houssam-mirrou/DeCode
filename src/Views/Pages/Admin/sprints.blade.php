@extends('layout')

@section('title', 'Sprints & Briefs - Decode')

@section('content')
    <div class="flex h-screen bg-slate-50 overflow-hidden">

        <aside class="w-64 bg-slate-900 text-slate-300 flex flex-col hidden md:flex border-r border-slate-800">
            <div class="h-16 flex items-center px-6 border-b border-slate-800">
                <h1 class="text-xl font-bold text-indigo-500 tracking-wider">DECODE <span
                        class="text-xs text-slate-500 font-normal">ADMIN</span></h1>
            </div>

            <nav class="flex-1 px-3 py-6 space-y-1">

                <a href="/"
                    class="flex items-center px-3 py-2.5 hover:bg-slate-800 hover:text-white rounded-lg transition-colors group">
                    <i data-lucide="layout-dashboard"
                        class="w-5 h-5 mr-3  text-slate-400 group-hover:text-white transition-colors"></i>
                    <span class="font-medium">Dashboard</span>
                </a>

                <div class="pt-4 pb-2 px-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">
                    Pedagogical Structure
                </div>

                <a href="/admin/classes"
                    class="flex items-center px-3 py-2.5 hover:bg-slate-800 hover:text-white rounded-lg transition-colors group">
                    <i data-lucide="school"
                        class="w-5 h-5 mr-3 text-slate-400 group-hover:text-white transition-colors"></i>
                    Classes
                </a>

                <a href="/admin/competences"
                    class="flex items-center px-3 py-2.5 hover:bg-slate-800 hover:text-white rounded-lg transition-colors group">
                    <i data-lucide="award" class="w-5 h-5 mr-3 text-slate-400 group-hover:text-white transition-colors"></i>
                    Competencies
                </a>

                <a href="/admin/sprints"
                    class="flex items-center px-3 py-2.5 bg-indigo-600 text-white rounded-lg transition-colors shadow-lg shadow-indigo-500/20">
                    <i data-lucide="zap" class="w-5 h-5 mr-3"></i>
                    Sprints & Briefs
                </a>

                <div class="pt-4 pb-2 px-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">
                    User Management
                </div>

                <a href="/admin/users"
                    class="flex items-center px-3 py-2.5 hover:bg-slate-800 hover:text-white rounded-lg transition-colors group">
                    <i data-lucide="users" class="w-5 h-5 mr-3 text-slate-400 group-hover:text-white transition-colors"></i>
                    Users & Roles
                </a>
            </nav>

            <div class="p-4 border-t border-slate-800">
                <div class="flex items-center gap-3">
                    <div
                        class="w-9 h-9 rounded-full bg-gradient-to-tr from-indigo-500 to-purple-500 flex items-center justify-center text-white font-bold text-sm shadow-md">
                        AD
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-white truncate">Super Admin</p>
                        <p class="text-xs text-slate-500 truncate">System Manager</p>
                    </div>
                    <form action="/logout" method="POST">
                        <button type="submit"
                            class="text-slate-400 hover:text-white p-1 rounded-md hover:bg-slate-800 transition-colors">
                            <i data-lucide="log-out" class="w-4 h-4"></i>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <div class="flex-1 flex flex-col h-screen overflow-hidden">

            <header class="h-16 bg-white border-b border-slate-200 flex items-center justify-between px-8 z-10">
                <div>
                    <h2 class="text-xl font-bold text-slate-800">Sprints & Briefs</h2>
                    <p class="text-xs text-slate-500">Manage timelines and project assignments</p>
                </div>

                <button onclick="openCreateSprintModal()"
                    class="flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 shadow-sm transition-colors">
                    <i data-lucide="plus" class="w-4 h-4"></i>
                    New Sprint
                </button>
            </header>

            <main class="flex-1 overflow-y-auto p-8 bg-slate-50">

                <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6">

                    @forelse($sprints ?? [] as $sprint)
                        <div
                            class="bg-white rounded-xl border border-slate-200 shadow-sm flex flex-col h-full group hover:border-indigo-300 transition-colors">

                            <div
                                class="p-5 border-b border-slate-100 flex justify-between items-start bg-slate-50/50 rounded-t-xl">
                                <div>
                                    <h3 class="font-bold text-slate-800 text-lg">{{ $sprint->get_name() }}</h3>
                                    <div class="flex items-center gap-2 mt-1 text-xs text-slate-500">
                                        <i data-lucide="calendar" class="w-3 h-3"></i>
                                        <span>{{ $sprint->get_start_date() }} — {{ $sprint->get_end_date() }}</span>
                                    </div>
                                </div>
                                <div class="flex items-center gap-1">
                                    <button onclick="openEditSprintModal(this)" data-id="{{ $sprint->get_id() }}"
                                        data-name="{{ $sprint->get_name() }}" data-start="{{ $sprint->get_start_date() }}"
                                        data-end="{{ $sprint->get_end_date() }}"
                                        data-class_id="{{ $sprint->get_class_id() }}"
                                        class="p-1.5 text-slate-400 hover:text-indigo-600 rounded hover:bg-indigo-50 transition-colors">
                                        <i data-lucide="pencil" class="w-4 h-4"></i>
                                    </button>
                                    <button onclick="openDeleteSprintModal({{ $sprint->get_id() }})"
                                        class="p-1.5 text-slate-400 hover:text-red-600 rounded hover:bg-red-50 transition-colors">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="flex-1 p-5">
                                <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-3">Briefs</h4>

                                <div class="space-y-3">
                                    @if (method_exists($sprint, 'get_briefs') && !empty($sprint->get_briefs()))
                                        @foreach ($sprint->get_briefs() as $brief)
                                            <div
                                                class="flex items-center justify-between p-3 bg-white border border-slate-100 rounded-lg shadow-sm hover:shadow-md transition-shadow group/brief">
                                                <div class="flex items-center gap-3 overflow-hidden">
                                                    <div
                                                        class="w-8 h-8 rounded bg-indigo-50 flex items-center justify-center text-indigo-600 shrink-0">
                                                        <i data-lucide="file-code" class="w-4 h-4"></i>
                                                    </div>
                                                    <div class="min-w-0">
                                                        <p class="text-sm font-medium text-slate-800 truncate">
                                                            {{ $brief->get_title() }}</p>
                                                        <a href="{{ $brief->get_link() }}" target="_blank"
                                                            class="text-xs text-indigo-500 hover:underline flex items-center gap-1">
                                                            View Brief <i data-lucide="external-link" class="w-3 h-3"></i>
                                                        </a>
                                                    </div>
                                                </div>

                                                <form action="/admin/brief/delete" method="POST"
                                                    onsubmit="return confirm('Delete this brief?');"
                                                    class="opacity-0 group-hover/brief:opacity-100 transition-opacity">
                                                    <input type="hidden" name="id" value="{{ $brief->get_id() }}">
                                                    <button type="submit"
                                                        class="p-1 text-slate-300 hover:text-red-500 transition-colors">
                                                        <i data-lucide="x" class="w-4 h-4"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="text-center py-4 border-2 border-dashed border-slate-100 rounded-lg">
                                            <p class="text-xs text-slate-400">No briefs assigned yet.</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full flex flex-col items-center justify-center py-20 text-slate-400">
                            <div class="bg-slate-100 p-4 rounded-full mb-4">
                                <i data-lucide="zap-off" class="w-8 h-8"></i>
                            </div>
                            <h3 class="text-lg font-medium text-slate-600">No Sprints Found</h3>
                            <p class="text-sm">Create a sprint to start organizing your curriculum.</p>
                        </div>
                    @endforelse

                </div>
            </main>
        </div>
    </div>

    <div id="createSprintModal" class="fixed inset-0 z-50 hidden" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">
        <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm transition-opacity" onclick="closeCreateSprintModal()">
        </div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                <div
                    class="relative transform overflow-hidden rounded-xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-md">
                    <form action="/admin/sprint/create" method="POST">
                        <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                            <h3 class="text-lg font-bold text-slate-900 mb-4">New Sprint</h3>
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-slate-700">Sprint Name</label>
                                    <input type="text" name="name" required
                                        placeholder="e.g. Sprint 1: Frontend Basics"
                                        class="mt-1 block w-full rounded-md border border-slate-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700">Start Date</label>
                                        <input type="date" name="start_date" required
                                            class="mt-1 block w-full rounded-md border border-slate-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700">End Date</label>
                                        <input type="date" name="end_date" required
                                            class="mt-1 block w-full rounded-md border border-slate-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    </div>
                                </div>
                                <div id="create_class_container" class="mt-4">
                                    <label class="block text-sm font-medium text-slate-700">Assign Class</label>
                                    <select name="class_id"
                                        class="mt-1 block w-full rounded-md border border-slate-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm bg-white">
                                        <option value="">-- Select Class --</option>
                                        @if (isset($classes))
                                            @foreach ($classes as $class)
                                                <option value="{{ $class->get_id() }}">{{ $class->get_name() }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="bg-slate-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                            <button type="submit"
                                class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 sm:ml-3 sm:w-auto">Create
                                Sprint</button>
                            <button type="button" onclick="closeCreateSprintModal()"
                                class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 hover:bg-slate-50 sm:mt-0 sm:w-auto">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="addBriefModal" class="fixed inset-0 z-50 hidden" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">
        <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm transition-opacity" onclick="closeAddBriefModal()">
        </div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                <div
                    class="relative transform overflow-hidden rounded-xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-md">
                    <form action="/admin/brief/create" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="sprint_id" id="brief_sprint_id">

                        <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                            <div class="flex items-center gap-3 mb-4">
                                <div
                                    class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600">
                                    <i data-lucide="file-plus" class="w-5 h-5"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-slate-900">Add Brief</h3>
                                    <p class="text-xs text-slate-500">Adding to <span id="brief_sprint_name"
                                            class="font-bold"></span></p>
                                </div>
                            </div>

                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-slate-700">Brief Title</label>
                                    <input type="text" name="title" required placeholder="e.g. YouCode Clone"
                                        class="mt-1 block w-full rounded-md border border-slate-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-700">Repository / PDF Link</label>
                                    <input type="url" name="link" required placeholder="https://..."
                                        class="mt-1 block w-full rounded-md border border-slate-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                </div>
                            </div>
                        </div>
                        <div class="bg-slate-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                            <button type="submit"
                                class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 sm:ml-3 sm:w-auto">Add
                                Brief</button>
                            <button type="button" onclick="closeAddBriefModal()"
                                class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 hover:bg-slate-50 sm:mt-0 sm:w-auto">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="editSprintModal" class="fixed inset-0 z-50 hidden" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">
        <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm transition-opacity" onclick="closeEditSprintModal()">
        </div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                <div
                    class="relative transform overflow-hidden rounded-xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-md">
                    <form action="/admin/sprint/update" method="POST">
                        <input type="hidden" name="id" id="edit_sprint_id">

                        <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                            <h3 class="text-lg font-bold text-slate-900 mb-4">Edit Sprint</h3>
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-slate-700">Sprint Name</label>
                                    <input type="text" name="name" id="edit_sprint_name" required
                                        class="mt-1 block w-full rounded-md border border-slate-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700">Start Date</label>
                                        <input type="date" name="start_date" id="edit_sprint_start" required
                                            class="mt-1 block w-full rounded-md border border-slate-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700">End Date</label>
                                        <input type="date" name="end_date" id="edit_sprint_end" required
                                            class="mt-1 block w-full rounded-md border border-slate-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    </div>
                                </div>
                                <select name="class_id"
                                    class="mt-1 block w-full rounded-md border border-slate-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm bg-white">
                                    <option value="">-- Select Class --</option>
                                    @if (isset($classes))
                                        @foreach ($classes as $class)
                                            <option value="{{ $class->get_id() }}">{{ $class->get_name() }}</option>
                                        @endforeach
                                    @endif
                                </select>

                            </div>
                        </div>
                        <div class="bg-slate-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                            <button type="submit"
                                class="inline-flex w-full justify-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 sm:ml-3 sm:w-auto">Update
                                Sprint</button>
                            <button type="button" onclick="closeEditSprintModal()"
                                class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 hover:bg-slate-50 sm:mt-0 sm:w-auto">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="deleteSprintModal" class="fixed inset-0 z-50 hidden" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">
        <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm transition-opacity" onclick="closeDeleteSprintModal()">
        </div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                <div
                    class="relative transform overflow-hidden rounded-xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                    <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div
                                class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                <i data-lucide="alert-triangle" class="w-6 h-6 text-red-600"></i>
                            </div>
                            <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                                <h3 class="text-base font-semibold leading-6 text-slate-900">Delete Sprint</h3>
                                <div class="mt-2">
                                    <p class="text-sm text-slate-500">Are you sure you want to delete this sprint? All
                                        associated briefs and student submissions will be permanently removed.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-slate-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                        <form action="/admin/sprint/delete" method="POST" class="inline-flex w-full sm:w-auto">
                            <input type="hidden" name="id" id="delete_sprint_id_input">
                            <button type="submit"
                                class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3">Delete
                                Sprint</button>
                        </form>
                        <button type="button" onclick="closeDeleteSprintModal()"
                            class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 hover:bg-slate-50 sm:mt-0 sm:w-auto">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        lucide.createIcons();

        // Create Sprint
        function openCreateSprintModal() {
            document.getElementById('createSprintModal').classList.remove('hidden');
        }

        function closeCreateSprintModal() {
            document.getElementById('createSprintModal').classList.add('hidden');
        }

        // Add Brief (Needs Sprint ID to link it)
        function openAddBriefModal(sprintId, sprintName) {
            document.getElementById('brief_sprint_id').value = sprintId;
            document.getElementById('brief_sprint_name').innerText = sprintName;
            document.getElementById('addBriefModal').classList.remove('hidden');
        }

        function closeAddBriefModal() {
            document.getElementById('addBriefModal').classList.add('hidden');
        }

        // Edit Sprint
        function openEditSprintModal(button) {
            document.getElementById('edit_sprint_id').value = button.getAttribute('data-id');
            document.getElementById('edit_sprint_name').value = button.getAttribute('data-name');
            document.getElementById('edit_sprint_start').value = button.getAttribute('data-start');
            document.getElementById('edit_sprint_end').value = button.getAttribute('data-end');
            document.getElementById('editSprintModal').classList.remove('hidden');
        }

        function closeEditSprintModal() {
            document.getElementById('editSprintModal').classList.add('hidden');
        }

        // Delete Sprint
        function openDeleteSprintModal(id) {
            document.getElementById('delete_sprint_id_input').value = id;
            document.getElementById('deleteSprintModal').classList.remove('hidden');
        }

        function closeDeleteSprintModal() {
            document.getElementById('deleteSprintModal').classList.add('hidden');
        }
    </script>
@endsection
