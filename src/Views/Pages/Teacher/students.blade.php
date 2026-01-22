@extends('layout')

@section('title', 'My Students')

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
                    class="flex items-center px-3 py-2.5 text-slate-600 hover:bg-slate-50 hover:text-slate-900 rounded-lg transition-colors">
                    <i data-lucide="file-code" class="w-5 h-5 mr-3 text-slate-400"></i> My Briefs
                </a>
                <a href="/teacher/evaluations"
                    class="flex items-center px-3 py-2.5 text-slate-600 hover:bg-slate-50 hover:text-slate-900 rounded-lg transition-colors">
                    <i data-lucide="check-circle" class="w-5 h-5 mr-3 text-slate-400"></i> Evaluations
                </a>
                <a href="/teacher/students"
                    class="flex items-center px-3 py-2.5 text-indigo-600 bg-indigo-50 font-medium rounded-lg transition-colors">
                    <i data-lucide="users" class="w-5 h-5 mr-3 text-indigo-600"></i>
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

        <div class="flex-1 flex flex-col h-screen overflow-hidden">

            <header class="h-16 bg-white border-b border-slate-200 flex items-center justify-between px-8 shrink-0">
                <div>
                    <h1 class="text-xl font-bold text-slate-800">Class Roster</h1>
                    <p class="text-xs text-slate-500">Managing <span
                            class="font-bold text-indigo-600">{{ count($students) }}</span> students</p>
                </div>

                <button onclick="openModal()"
                    class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold rounded-lg flex items-center gap-2 transition-colors">
                    <i data-lucide="user-plus" class="w-4 h-4"></i> Add Student
                </button>
            </header>

            <main class="flex-1 overflow-y-auto p-8">
                <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                    @forelse($students as $student)
                        <div
                            class="bg-white border border-slate-200 rounded-xl p-6 shadow-sm hover:shadow-md transition-all group">

                            <div class="flex items-start justify-between mb-4">
                                <div class="flex gap-4">
                                    <div
                                        class="w-12 h-12 rounded-full bg-indigo-50 border border-indigo-100 flex items-center justify-center text-indigo-600 font-bold text-lg">
                                        {{ $student->getInitials() }}
                                    </div>

                                    <div>
                                        <h3 class="font-bold text-slate-800 group-hover:text-indigo-600 transition-colors">
                                            {{ $student->firstName }} {{ $student->lastName }}
                                        </h3>
                                        <p class="text-xs text-slate-400 flex items-center gap-1">
                                            <i data-lucide="mail" class="w-3 h-3"></i> {{ $student->email }}
                                        </p>
                                    </div>
                                </div>

                                <button class="text-slate-300 hover:text-slate-600">
                                    <i data-lucide="more-vertical" class="w-5 h-5"></i>
                                </button>
                            </div>

                            <hr class="border-slate-50 mb-4">

                            <div class="space-y-3">
                                <div class="flex justify-between items-end">
                                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Progress</span>
                                    <span class="text-sm font-bold text-slate-700">
                                        {{ $student->validatedBriefs }} <span
                                            class="text-slate-400 text-xs font-medium">validated</span>
                                    </span>
                                </div>

                                {{-- Calculate percentage (capped at 100%) --}}
                                @php $percent = min(100, ($student->validatedBriefs / max(1, $student->totalBriefs)) * 100); @endphp

                                <div class="w-full bg-slate-100 rounded-full h-2 overflow-hidden">
                                    <div class="bg-indigo-500 h-2 rounded-full transition-all duration-500"
                                        style="width: {{ $percent }}%"></div>
                                </div>
                            </div>

                            <div class="mt-6 flex gap-2">
                                <button
                                    class="flex-1 px-3 py-2 bg-slate-50 hover:bg-white border border-slate-200 hover:border-indigo-200 text-slate-600 hover:text-indigo-600 text-xs font-bold rounded-lg transition-all">
                                    View Profile
                                </button>
                                <button
                                    class="flex-1 px-3 py-2 bg-slate-50 hover:bg-white border border-slate-200 hover:border-emerald-200 text-slate-600 hover:text-emerald-600 text-xs font-bold rounded-lg transition-all">
                                    Statistics
                                </button>
                            </div>

                        </div>
                    @empty
                        <div
                            class="col-span-full py-12 text-center border-2 border-dashed border-slate-200 rounded-xl bg-slate-50">
                            <div class="inline-flex p-3 bg-slate-100 rounded-full text-slate-400 mb-3">
                                <i data-lucide="users" class="w-6 h-6"></i>
                            </div>
                            <h3 class="text-slate-600 font-bold">No students found</h3>
                            <p class="text-slate-400 text-sm">This class doesn't have any students enrolled yet.</p>
                        </div>
                    @endforelse

                </div>
            </main>
        </div>
    </div>
    <div id="addStudentModal" class="fixed inset-0 z-50 hidden" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">
        <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm transition-opacity"></div>

        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">

                <div
                    class="relative transform overflow-hidden rounded-xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">

                    <button onclick="closeModal()" class="absolute top-4 right-4 text-slate-400 hover:text-slate-600">
                        <i data-lucide="x" class="w-5 h-5"></i>
                    </button>

                    <div class="px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                        <h3 class="text-lg font-bold leading-6 text-slate-800" id="modal-title">Add New Students</h3>
                        <p class="text-sm text-slate-500 mt-1">Add a single student or import a class list.</p>

                        <div class="mt-4 border-b border-slate-200">
                            <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                                <button onclick="switchTab('manual')" id="tab-manual"
                                    class="border-indigo-500 text-indigo-600 whitespace-nowrap border-b-2 py-2 px-1 text-sm font-bold">
                                    Manual Entry
                                </button>
                                <button onclick="switchTab('import')" id="tab-import"
                                    class="border-transparent text-slate-500 hover:border-slate-300 hover:text-slate-700 whitespace-nowrap border-b-2 py-2 px-1 text-sm font-medium">
                                    Import CSV
                                </button>
                            </nav>
                        </div>

                        <form id="form-manual" action="/teacher/students/add" method="POST" class="mt-4 space-y-4">
                            <input type="hidden" name="type" value="manual">

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 mb-1">First Name</label>
                                    <input type="text" name="first_name" required
                                        class="w-full rounded-lg border-slate-300 text-sm focus:ring-indigo-500 focus:border-indigo-500">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 mb-1">Last Name</label>
                                    <input type="text" name="last_name" required
                                        class="w-full rounded-lg border-slate-300 text-sm focus:ring-indigo-500 focus:border-indigo-500">
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1">Email Address</label>
                                <input type="email" name="email" required
                                    class="w-full rounded-lg border-slate-300 text-sm focus:ring-indigo-500 focus:border-indigo-500">
                            </div>

                            <div class="bg-indigo-50 p-3 rounded-lg text-xs text-indigo-700 border border-indigo-100">
                                <i data-lucide="info" class="w-3 h-3 inline mr-1"></i> Default password will be
                                <strong>Student123!</strong>
                            </div>

                            <div class="mt-5 sm:mt-6 flex justify-end">
                                <button type="submit"
                                    class="inline-flex justify-center rounded-lg bg-indigo-600 px-4 py-2 text-sm font-bold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                    Add Student
                                </button>
                            </div>
                        </form>

                        <form id="form-import" action="/teacher/students/add" method="POST"
                            enctype="multipart/form-data" class="mt-4 space-y-4 hidden">
                            <input type="hidden" name="type" value="import">

                            <div
                                class="flex justify-center rounded-lg border border-dashed border-slate-300 px-6 py-10 hover:bg-slate-50 transition-colors">
                                <div class="text-center">
                                    <i data-lucide="sheet" class="mx-auto h-12 w-12 text-slate-300"></i>
                                    <div class="mt-4 flex text-sm leading-6 text-slate-600 justify-center">
                                        <label for="file-upload"
                                            class="relative cursor-pointer rounded-md bg-white font-bold text-indigo-600 focus-within:outline-none hover:text-indigo-500">
                                            <span>Upload CSV or Excel</span>
                                            <input id="file-upload" name="import_file" type="file"
                                                accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"
                                                class="sr-only" onchange="showFileName(this)">
                                        </label>
                                        <p class="pl-1">or drag and drop</p>
                                    </div>
                                    <p class="text-xs text-slate-500">.csv, .xlsx, .xls up to 5MB</p>
                                    <p id="file-name" class="text-sm font-bold text-slate-800 mt-2"></p>
                                </div>
                            </div>

                            <div class="text-xs text-slate-500">
                                <p class="font-bold mb-1">Required Format (Headers ignored):</p>
                                <div class="flex gap-2">
                                    <span class="bg-slate-100 px-2 py-1 rounded border">First Name</span>
                                    <span class="bg-slate-100 px-2 py-1 rounded border">Last Name</span>
                                    <span class="bg-slate-100 px-2 py-1 rounded border">Email</span>
                                </div>
                            </div>

                            <div class="mt-5 sm:mt-6 flex justify-end gap-2">
                                <a href="/assets/template_students.xlsx" download
                                    class="inline-flex justify-center rounded-lg bg-white px-4 py-2 text-sm font-bold text-slate-700 shadow-sm ring-1 ring-inset ring-slate-300 hover:bg-slate-50">
                                    Template
                                </a>
                                <button type="submit"
                                    class="inline-flex justify-center rounded-lg bg-indigo-600 px-4 py-2 text-sm font-bold text-white shadow-sm hover:bg-indigo-500">
                                    Import Students
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        lucide.createIcons();

        function openModal() {
            document.getElementById('addStudentModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('addStudentModal').classList.add('hidden');
        }

        function switchTab(tab) {
            // Toggle Buttons
            const btnManual = document.getElementById('tab-manual');
            const btnImport = document.getElementById('tab-import');

            // Toggle Forms
            const formManual = document.getElementById('form-manual');
            const formImport = document.getElementById('form-import');

            if (tab === 'manual') {
                btnManual.classList.replace('border-transparent', 'border-indigo-500');
                btnManual.classList.replace('text-slate-500', 'text-indigo-600');

                btnImport.classList.replace('border-indigo-500', 'border-transparent');
                btnImport.classList.replace('text-indigo-600', 'text-slate-500');

                formManual.classList.remove('hidden');
                formImport.classList.add('hidden');
            } else {
                btnImport.classList.replace('border-transparent', 'border-indigo-500');
                btnImport.classList.replace('text-slate-500', 'text-indigo-600');

                btnManual.classList.replace('border-indigo-500', 'border-transparent');
                btnManual.classList.replace('text-indigo-600', 'text-slate-500');

                formImport.classList.remove('hidden');
                formManual.classList.add('hidden');
            }
        }

        function showFileName(input) {
            const name = input.files[0]?.name;
            document.getElementById('file-name').innerText = name || '';
        }
    </script>
@endsection
