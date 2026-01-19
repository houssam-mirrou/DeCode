@extends('layout')

@section('title', 'Classes Management - Decode')

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
                    class="flex items-center px-3 py-2.5 bg-indigo-600 text-white rounded-lg transition-colors shadow-lg shadow-indigo-500/20">
                    <i data-lucide="school" class="w-5 h-5 mr-3"></i>
                    Classes
                </a>

                <a href="/admin/competences"
                    class="flex items-center px-3 py-2.5 hover:bg-slate-800 hover:text-white rounded-lg transition-colors group">
                    <i data-lucide="award" class="w-5 h-5 mr-3 text-slate-400 group-hover:text-white transition-colors"></i>
                    Competencies
                </a>

                <a href="/admin/sprints"
                    class="flex items-center px-3 py-2.5 hover:bg-slate-800 hover:text-white rounded-lg transition-colors group">
                    <i data-lucide="zap" class="w-5 h-5 mr-3 text-slate-400 group-hover:text-white transition-colors"></i>
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
                    <h2 class="text-xl font-bold text-slate-800">Class Management</h2>
                    <p class="text-xs text-slate-500">Create classes and assign teachers</p>
                </div>

                <button onclick="openCreateModal()"
                    class="flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 shadow-sm transition-colors">
                    <i data-lucide="plus" class="w-4 h-4"></i>
                    New Class
                </button>
            </header>

            <main class="flex-1 overflow-y-auto p-8 bg-slate-50">

                @php
                    $teachersByClass = [];
                    if (isset($class_with_teachers) && is_array($class_with_teachers)) {
                        foreach ($class_with_teachers as $entry) {
                            // Check if entry has valid data
                            if (isset($entry['class']) && isset($entry['teacher'])) {
                                $cId = $entry['class']->get_id(); // Assuming Getter
                                $teachersByClass[$cId][] = $entry['teacher'];
                            }
                        }
                    }
                @endphp

                <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr
                                class="bg-slate-50/50 text-xs font-semibold text-slate-500 uppercase tracking-wider border-b border-slate-100">
                                <th class="px-6 py-4">Class Name</th>
                                <th class="px-6 py-4">School Year</th>
                                <th class="px-6 py-4">Assigned Teachers</th>
                                <th class="px-6 py-4 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($classes ?? [] as $c)

                                @php
                                    $currentClassId = $c->get_id();
                                    $assignedTeachers = $teachersByClass[$currentClassId] ?? [];
                                @endphp

                                <tr class="hover:bg-slate-50 transition-colors group">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="h-8 w-8 rounded bg-indigo-50 border border-indigo-100 flex items-center justify-center text-indigo-600">
                                                <i data-lucide="book-open" class="w-4 h-4"></i>
                                            </div>
                                            <span class="font-medium text-slate-900">{{ $c->get_name() }}</span>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 text-sm text-slate-500">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-700 border border-slate-200">
                                            {{ $c->get_school_year() }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4">
                                        <div class="flex flex-col gap-2 items-start">
                                            @if (count($assignedTeachers) > 0)
                                                @foreach ($assignedTeachers as $t)
                                                    <div
                                                        class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-medium bg-indigo-50 text-indigo-700 border border-indigo-100 group/badge">
                                                        <i data-lucide="user" class="w-3 h-3"></i>
                                                        <span>{{ $t->get_first_name() }} {{ $t->get_last_name() }}</span>

                                                        <button type="button"
                                                            onclick="openRemoveTeacherModal({{ $currentClassId }}, {{ $t->get_id() }}, '{{ $t->get_first_name() }} {{ $t->get_last_name() }}')"
                                                            class="ml-1 text-indigo-400 hover:text-red-500 opacity-0 group-hover/badge:opacity-100 transition-opacity focus:outline-none"
                                                            title="Remove Teacher">
                                                            <i data-lucide="x" class="w-3 h-3"></i>
                                                        </button>
                                                    </div>
                                                @endforeach
                                            @else
                                                <span
                                                    class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-50 text-amber-700 border border-amber-100">
                                                    <i data-lucide="alert-circle" class="w-3 h-3"></i>
                                                    No Teacher
                                                </span>
                                            @endif
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 text-right">
                                        <div
                                            class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                            @if (count($assignedTeachers) == 0)
                                                <button
                                                    onclick="openTeachersModal({{ $c->get_id() }}, '{{ $c->get_name() }}')"
                                                    class="flex items-center gap-1 px-3 py-1.5 text-xs font-medium text-indigo-600 bg-indigo-50 hover:bg-indigo-100 rounded-md transition-colors"
                                                    title="Manage Teachers">
                                                    <i data-lucide="user-plus" class="w-3 h-3"></i> Assign
                                                </button>
                                            @endif
                                            <button onclick="openEditModal(this)" data-id="{{ $c->get_id() }}"
                                                data-name="{{ $c->get_name() }}" data-year="{{ $c->get_school_year() }}"
                                                class="p-2 text-slate-400 hover:text-indigo-600 hover:bg-slate-100 rounded-lg transition-colors">
                                                <i data-lucide="pencil" class="w-4 h-4"></i>
                                            </button>
                                            <button onclick="openDeleteModal({{ $c->get_id() }})"
                                                class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-12 text-center text-slate-400">
                                        <p>No classes found.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </main>
        </div>
    </div>

    <div id="createModal" class="fixed inset-0 z-50 hidden" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">
        <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm transition-opacity" onclick="closeCreateModal()"></div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                <div
                    class="relative transform overflow-hidden rounded-xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-md">
                    <form action="/admin/class/create" method="POST">
                        <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                            <h3 class="text-lg font-bold text-slate-900 mb-4">Create New Class</h3>
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-slate-700">Class Name</label>
                                    <input type="text" name="name" required placeholder="e.g. DevFullStack 2026"
                                        class="mt-1 block w-full rounded-md border border-slate-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-700">School Year</label>
                                    <input type="text" name="school_year" required placeholder="e.g. 2025-2026"
                                        class="mt-1 block w-full rounded-md border border-slate-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                </div>
                            </div>
                        </div>
                        <div class="bg-slate-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                            <button type="submit"
                                class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 sm:ml-3 sm:w-auto">Create
                                Class</button>
                            <button type="button" onclick="closeCreateModal()"
                                class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 hover:bg-slate-50 sm:mt-0 sm:w-auto">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="editModal" class="fixed inset-0 z-50 hidden" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">
        <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm transition-opacity" onclick="closeEditModal()"></div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                <div
                    class="relative transform overflow-hidden rounded-xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-md">
                    <form action="/admin/class/update" method="POST">
                        <input type="hidden" name="id" id="edit_id">
                        <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                            <h3 class="text-lg font-bold text-slate-900 mb-4">Edit Class Details</h3>
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-slate-700">Class Name</label>
                                    <input type="text" name="name" id="edit_name" required
                                        class="mt-1 block w-full rounded-md border border-slate-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-700">School Year</label>
                                    <input type="text" name="school_year" id="edit_year" required
                                        class="mt-1 block w-full rounded-md border border-slate-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                </div>
                            </div>
                        </div>
                        <div class="bg-slate-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                            <button type="submit"
                                class="inline-flex w-full justify-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 sm:ml-3 sm:w-auto">Update</button>
                            <button type="button" onclick="closeEditModal()"
                                class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 hover:bg-slate-50 sm:mt-0 sm:w-auto">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="teachersModal" class="fixed inset-0 z-50 hidden" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">
        <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm transition-opacity" onclick="closeTeachersModal()">
        </div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                <div
                    class="relative transform overflow-hidden rounded-xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">

                    <form action="/admin/class/assign-teachers" method="POST">
                        <input type="hidden" name="class_id" id="teacher_class_id">

                        <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                            <div class="sm:flex sm:items-start">
                                <div
                                    class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-indigo-100 sm:mx-0 sm:h-10 sm:w-10">
                                    <i data-lucide="users" class="w-6 h-6 text-indigo-600"></i>
                                </div>
                                <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left w-full">
                                    <h3 class="text-base font-semibold leading-6 text-slate-900">Assign Teachers</h3>
                                    <p class="text-sm text-slate-500 mb-4">Select teachers for <span
                                            id="teacher_class_name" class="font-bold"></span></p>

                                    <div
                                        class="mt-4 max-h-48 overflow-y-auto border border-slate-200 rounded-md divide-y divide-slate-100">
                                        @if (isset($teachers) && count($teachers) > 0)
                                            @foreach ($teachers as $t)
                                                <div class="relative flex items-start py-3 px-3 hover:bg-slate-50">
                                                    <div class="min-w-0 flex-1 text-sm">
                                                        <label for="teacher_{{ $t->get_id() }}"
                                                            class="font-medium text-slate-700 select-none cursor-pointer block">
                                                            {{ $t->get_first_name() }} {{ $t->get_last_name() }}
                                                        </label>
                                                    </div>
                                                    <div class="ml-3 flex h-5 items-center">
                                                        <input id="teacher_{{ $t->get_id() }}" name="teachers[]"
                                                            value="{{ $t->get_id() }}" type="checkbox"
                                                            class="h-4 w-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-600">
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="p-4 text-center text-sm text-slate-500">
                                                No teachers found in the system.
                                            </div>
                                        @endif
                                    </div>
                                    <p class="text-xs text-slate-400 mt-2">Checked teachers will be assigned to this class.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-slate-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                            <button type="submit"
                                class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 sm:ml-3 sm:w-auto">Save
                                Assignments</button>
                            <button type="button" onclick="closeTeachersModal()"
                                class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 hover:bg-slate-50 sm:mt-0 sm:w-auto">Cancel</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <div id="deleteModal" class="fixed inset-0 z-50 hidden" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">
        <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm transition-opacity" onclick="closeDeleteModal()"></div>
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
                                <h3 class="text-base font-semibold leading-6 text-slate-900">Delete Class</h3>
                                <div class="mt-2">
                                    <p class="text-sm text-slate-500">Are you sure you want to delete this class? This will
                                        likely remove all associated sprints and detach students. This action cannot be
                                        undone.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-slate-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                        <form action="/admin/class/delete" method="POST" class="inline-flex w-full sm:w-auto">
                            <input type="hidden" name="id" id="delete_id_input">
                            <button type="submit"
                                class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3">Delete
                                Class</button>
                        </form>
                        <button type="button" onclick="closeDeleteModal()"
                            class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 hover:bg-slate-50 sm:mt-0 sm:w-auto">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="removeTeacherModal" class="fixed inset-0 z-50 hidden" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">
        <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm transition-opacity"
            onclick="closeRemoveTeacherModal()"></div>

        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                <div
                    class="relative transform overflow-hidden rounded-xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-md">

                    <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div
                                class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-amber-100 sm:mx-0 sm:h-10 sm:w-10">
                                <i data-lucide="user-minus" class="w-6 h-6 text-amber-600"></i>
                            </div>

                            <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left w-full">
                                <h3 class="text-base font-semibold leading-6 text-slate-900">Remove Teacher</h3>
                                <div class="mt-2">
                                    <p class="text-sm text-slate-500">
                                        Are you sure you want to remove <span id="remove_teacher_name"
                                            class="font-bold text-slate-700"></span> from this class?
                                    </p>
                                    <p class="text-xs text-slate-400 mt-2">They will lose access to this class's briefs and
                                        evaluations.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-slate-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                        <form action="/admin/class/remove-teacher" method="POST" class="inline-flex w-full sm:w-auto">
                            <input type="hidden" name="class_id" id="remove_class_id">
                            <input type="hidden" name="teacher_id" id="remove_teacher_id">

                            <button type="submit"
                                class="inline-flex w-full justify-center rounded-md bg-amber-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-amber-500 sm:ml-3">
                                Confirm Removal
                            </button>
                        </form>
                        <button type="button" onclick="closeRemoveTeacherModal()"
                            class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 hover:bg-slate-50 sm:mt-0 sm:w-auto">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        lucide.createIcons();

        function openRemoveTeacherModal(classId, teacherId, teacherName) {
            // 1. Set the hidden input values so the form knows what to delete
            document.getElementById('remove_class_id').value = classId;
            document.getElementById('remove_teacher_id').value = teacherId;

            // 2. Update the text to show who we are removing
            document.getElementById('remove_teacher_name').innerText = teacherName;

            // 3. Show the modal
            document.getElementById('removeTeacherModal').classList.remove('hidden');
        }

        function closeRemoveTeacherModal() {
            document.getElementById('removeTeacherModal').classList.add('hidden');
        }
        // Create Modal
        function openCreateModal() {
            document.getElementById('createModal').classList.remove('hidden');
        }

        function closeCreateModal() {
            document.getElementById('createModal').classList.add('hidden');
        }

        // Edit Modal
        function openEditModal(button) {
            document.getElementById('edit_id').value = button.getAttribute('data-id');
            document.getElementById('edit_name').value = button.getAttribute('data-name');
            document.getElementById('edit_year').value = button.getAttribute('data-year');
            document.getElementById('editModal').classList.remove('hidden');
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }

        // Teachers Modal
        function openTeachersModal(id, name) {
            document.getElementById('teacher_class_id').value = id;
            document.getElementById('teacher_class_name').innerText = name;
            // Note: To check the boxes of *already assigned* teachers, you would ideally
            // need to pass that data via AJAX or data-attributes. For now, this just lists all teachers.
            document.getElementById('teachersModal').classList.remove('hidden');
        }

        function closeTeachersModal() {
            document.getElementById('teachersModal').classList.add('hidden');
        }

        // Delete Modal
        function openDeleteModal(id) {
            document.getElementById('delete_id_input').value = id;
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }
    </script>
@endsection
