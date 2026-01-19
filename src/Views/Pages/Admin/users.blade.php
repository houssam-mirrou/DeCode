@extends('layout')

@section('title', 'Users & Roles - Decode')

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
                    <i data-lucide="layout-dashboard" class="w-5 h-5 mr-3  text-slate-400 group-hover:text-white transition-colors"></i>
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
                    class="flex items-center px-3 py-2.5 hover:bg-slate-800 hover:text-white rounded-lg transition-colors group">
                    <i data-lucide="zap" class="w-5 h-5 mr-3 text-slate-400 group-hover:text-white transition-colors"></i>
                    Sprints & Briefs
                </a>

                <div class="pt-4 pb-2 px-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">
                    User Management
                </div>

                <a href="/admin/users"
                    class="flex items-center px-3 py-2.5 bg-indigo-600 text-white rounded-lg transition-colors shadow-lg shadow-indigo-500/20">
                    <i data-lucide="users" class="w-5 h-5 mr-3"></i>
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
                    <h2 class="text-xl font-bold text-slate-800">User Management</h2>
                    <p class="text-xs text-slate-500">Manage access, roles, and assignments</p>
                </div>

                <button onclick="openCreateModal()"
                    class="flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 shadow-sm transition-colors">
                    <i data-lucide="user-plus" class="w-4 h-4"></i>
                    Add User
                </button>
            </header>

            <main class="flex-1 overflow-y-auto p-8 bg-slate-50">

                <div class="flex space-x-1 bg-slate-200/50 p-1 rounded-lg w-fit mb-6">
                    <a href="/admin/users"
                        class="px-4 py-2 text-sm font-medium rounded-md bg-white text-slate-800 shadow-sm">All</a>
                    <a href="/admin/users?role=teacher"
                        class="px-4 py-2 text-sm font-medium rounded-md text-slate-500 hover:text-slate-700 hover:bg-white/50 transition-all">Teachers</a>
                    <a href="/admin/users?role=student"
                        class="px-4 py-2 text-sm font-medium rounded-md text-slate-500 hover:text-slate-700 hover:bg-white/50 transition-all">Students</a>
                    <a href="/admin/users?role=admin"
                        class="px-4 py-2 text-sm font-medium rounded-md text-slate-500 hover:text-slate-700 hover:bg-white/50 transition-all">Admins</a>
                </div>

                <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr
                                class="bg-slate-50/50 text-xs font-semibold text-slate-500 uppercase tracking-wider border-b border-slate-100">
                                <th class="px-6 py-4">User</th>
                                <th class="px-6 py-4">Role</th>
                                <th class="px-6 py-4">Status / Class</th>
                                <th class="px-6 py-4">Email</th>
                                <th class="px-6 py-4 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            {{-- @forelse($users as $u)
                                <tr class="hover:bg-slate-50 transition-colors group">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div
                                                class="h-9 w-9 rounded-full bg-slate-200 flex items-center justify-center text-xs font-bold text-slate-600 uppercase mr-3">
                                                {{ substr($u->get_first_name(), 0, 1) . substr($u->get_last_name(), 0, 1) }}
                                            </div>
                                            <div>
                                                <div class="text-sm font-medium text-slate-900">{{ $u->get_first_name() }}
                                                    {{ $u->get_last_name() }}</div>
                                                <div class="text-xs text-slate-400">Created:
                                                    {{ substr($u->get_created_date(), 0, 10) }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if ($u->get_role() === 'admin')
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                                Admin
                                            </span>
                                        @elseif($u->get_role() === 'teacher')
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                Teacher
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
                                                Student
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        @if ($u->get_role() === 'student' && $u->get_class_id())
                                            <span class="text-xs font-medium text-slate-600 bg-slate-100 px-2 py-1 rounded">
                                                Class #{{ $u->get_class_id() }}
                                            </span>
                                        @else
                                            <span class="text-xs text-slate-400">-</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-sm text-slate-500">
                                        {{ $u->get_email() }}
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div
                                            class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                            <button onclick="openEditModal(this)" data-id="{{ $u->get_id() }}"
                                                data-fname="{{ $u->get_first_name() }}"
                                                data-lname="{{ $u->get_last_name() }}" data-email="{{ $u->get_email() }}"
                                                data-role="{{ $u->get_role() }}" data-class="{{ $u->get_class_id() }}"
                                                class="p-2 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors"
                                                title="Edit User">
                                                <i data-lucide="pencil" class="w-4 h-4"></i>
                                            </button>
                                            <button onclick="openDeleteModal({{ $u->get_id() }})"
                                                class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors"
                                                title="Delete User">
                                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center text-slate-400">
                                        No users found matching this criteria.
                                    </td>
                                </tr>
                            @endforelse --}}
                        </tbody>
                    </table>
                </div>

                <div class="flex items-center justify-between mt-6">
                    {{-- <p class="text-sm text-slate-500">Showing <span class="font-medium">{{ count($users) }}</span> users --}}
                    </p>
                    <div class="flex gap-2">
                        <button
                            class="px-4 py-2 border border-slate-300 rounded-lg text-sm font-medium text-slate-700 bg-white hover:bg-slate-50 disabled:opacity-50"
                            disabled>Previous</button>
                        <button
                            class="px-4 py-2 border border-slate-300 rounded-lg text-sm font-medium text-slate-700 bg-white hover:bg-slate-50">Next</button>
                    </div>
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
                    class="relative transform overflow-hidden rounded-xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                    <form action="/admin/user/create" method="POST">
                        <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                            <h3 class="text-lg font-bold text-slate-900 mb-4">Add New User</h3>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-slate-700">First Name</label>
                                    <input type="text" name="first_name" required
                                        class="mt-1 block w-full rounded-md border border-slate-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-700">Last Name</label>
                                    <input type="text" name="last_name" required
                                        class="mt-1 block w-full rounded-md border border-slate-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                </div>
                            </div>

                            <div class="mt-4">
                                <label class="block text-sm font-medium text-slate-700">Email Address</label>
                                <input type="email" name="email" required
                                    class="mt-1 block w-full rounded-md border border-slate-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>

                            <div class="mt-4">
                                <label class="block text-sm font-medium text-slate-700">Password</label>
                                <input type="password" name="password" required
                                    class="mt-1 block w-full rounded-md border border-slate-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>

                            <div class="mt-4">
                                <label class="block text-sm font-medium text-slate-700">Role</label>
                                <select name="role" id="create_role_select" onchange="toggleClassSelect('create')"
                                    class="mt-1 block w-full rounded-md border border-slate-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm bg-white">
                                    <option value="student">Student</option>
                                    <option value="teacher">Teacher</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>

                            <div id="create_class_container" class="mt-4">
                                <label class="block text-sm font-medium text-slate-700">Assign Class</label>
                                <select name="class_id"
                                    class="mt-1 block w-full rounded-md border border-slate-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm bg-white">
                                    {{-- <option value="">-- Select Class --</option>
                                    @if (isset($classes))
                                        @foreach ($classes as $class)
                                            <option value="{{ $class['id'] }}">{{ $class['name'] }}</option>
                                        @endforeach
                                    @endif --}}
                                </select>
                            </div>

                        </div>
                        <div class="bg-slate-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                            <button type="submit"
                                class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 sm:ml-3 sm:w-auto">Create
                                User</button>
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
                    class="relative transform overflow-hidden rounded-xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                    <form action="/admin/user/update" method="POST">
                        <input type="hidden" name="id" id="edit_id">

                        <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                            <h3 class="text-lg font-bold text-slate-900 mb-4">Edit User</h3>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-slate-700">First Name</label>
                                    <input type="text" name="first_name" id="edit_fname" required
                                        class="mt-1 block w-full rounded-md border border-slate-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-700">Last Name</label>
                                    <input type="text" name="last_name" id="edit_lname" required
                                        class="mt-1 block w-full rounded-md border border-slate-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                </div>
                            </div>

                            <div class="mt-4">
                                <label class="block text-sm font-medium text-slate-700">Email Address</label>
                                <input type="email" name="email" id="edit_email" required
                                    class="mt-1 block w-full rounded-md border border-slate-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>

                            <div class="mt-4">
                                <label class="block text-sm font-medium text-slate-700">Role</label>
                                <select name="role" id="edit_role_select" onchange="toggleClassSelect('edit')"
                                    class="mt-1 block w-full rounded-md border border-slate-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm bg-white">
                                    <option value="student">Student</option>
                                    <option value="teacher">Teacher</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>

                            <div id="edit_class_container" class="mt-4">
                                <label class="block text-sm font-medium text-slate-700">Assign Class</label>
                                <select name="class_id" id="edit_class_select"
                                    class="mt-1 block w-full rounded-md border border-slate-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm bg-white">
                                    <option value="">-- No Class --</option>
                                    {{-- @if (isset($classes))
                                        @foreach ($classes as $class)
                                            <option value="{{ $class['id'] }}">{{ $class['name'] }}</option>
                                        @endforeach
                                    @endif --}}
                                </select>
                            </div>

                            <div class="mt-4 bg-yellow-50 p-3 rounded-md border border-yellow-100">
                                <p class="text-xs text-yellow-700">Leave password blank to keep current password.</p>
                                <input type="password" name="password" placeholder="New Password (Optional)"
                                    class="mt-1 block w-full rounded-md border border-slate-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm bg-white">
                            </div>

                        </div>
                        <div class="bg-slate-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                            <button type="submit"
                                class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 sm:ml-3 sm:w-auto">Update
                                User</button>
                            <button type="button" onclick="closeEditModal()"
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
                                <h3 class="text-base font-semibold leading-6 text-slate-900">Delete User Account</h3>
                                <div class="mt-2">
                                    <p class="text-sm text-slate-500">Are you sure you want to delete this user? This
                                        action will remove all their data, evaluations, and submissions. This cannot be
                                        undone.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-slate-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                        <form action="/admin/user/delete" method="POST" class="inline-flex w-full sm:w-auto">
                            <input type="hidden" name="id" id="delete_id_input">
                            <button type="submit"
                                class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3">Delete
                                Account</button>
                        </form>
                        <button type="button" onclick="closeDeleteModal()"
                            class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 hover:bg-slate-50 sm:mt-0 sm:w-auto">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        lucide.createIcons();

        // Toggle Class Dropdown based on Role
        function toggleClassSelect(mode) {
            const roleSelect = document.getElementById(mode + '_role_select');
            const classContainer = document.getElementById(mode + '_class_container');

            if (roleSelect.value === 'student') {
                classContainer.classList.remove('hidden');
            } else {
                classContainer.classList.add('hidden');
            }
        }

        // --- Create Modal ---
        function openCreateModal() {
            document.getElementById('createModal').classList.remove('hidden');
            toggleClassSelect('create'); // Initialize state
        }

        function closeCreateModal() {
            document.getElementById('createModal').classList.add('hidden');
        }

        // --- Edit Modal ---
        function openEditModal(button) {
            // Get data
            const id = button.getAttribute('data-id');
            const fname = button.getAttribute('data-fname');
            const lname = button.getAttribute('data-lname');
            const email = button.getAttribute('data-email');
            const role = button.getAttribute('data-role');
            const classId = button.getAttribute('data-class');

            // Populate fields
            document.getElementById('edit_id').value = id;
            document.getElementById('edit_fname').value = fname;
            document.getElementById('edit_lname').value = lname;
            document.getElementById('edit_email').value = email;
            document.getElementById('edit_role_select').value = role;

            // Handle class select
            const classSelect = document.getElementById('edit_class_select');
            if (classId) {
                classSelect.value = classId;
            } else {
                classSelect.value = "";
            }

            toggleClassSelect('edit'); // Refresh visibility based on role
            document.getElementById('editModal').classList.remove('hidden');
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }

        // --- Delete Modal ---
        function openDeleteModal(id) {
            document.getElementById('delete_id_input').value = id;
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }
    </script>
@endsection
