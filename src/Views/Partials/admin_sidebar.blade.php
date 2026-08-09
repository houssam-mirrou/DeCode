@php
    $currentPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
    $activeLink = 'flex items-center px-4 py-3 bg-indigo-600/10 text-indigo-400 border-l-4 border-indigo-500 rounded-r-lg transition-all group';
    $inactiveLink = 'flex items-center px-4 py-3 hover:bg-slate-800/50 hover:text-white rounded-lg transition-all group';
    $activeIcon = 'w-5 h-5 mr-3 text-indigo-400 transition-colors';
    $inactiveIcon = 'w-5 h-5 mr-3 text-slate-500 group-hover:text-indigo-400 transition-colors';
    $activeText = 'font-bold tracking-wide text-sm';
    $inactiveText = 'font-medium text-sm';

    $isDashboard = $currentPath === '/admin/dashboard';
    $isClasses = $currentPath === '/admin/classes';
    $isCompetences = $currentPath === '/admin/competences';
    $isSprints = $currentPath === '/admin/sprints';
    $isUsers = $currentPath === '/admin/users';
@endphp

<aside class="w-72 bg-slate-900 text-slate-300 flex flex-col hidden md:flex border-r border-slate-800 shadow-xl z-20">
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
        <a href="/admin/dashboard" class="{{ $isDashboard ? $activeLink : $inactiveLink }}">
            <i data-lucide="layout-dashboard" class="{{ $isDashboard ? $activeIcon : $inactiveIcon }}"></i>
            <span class="{{ $isDashboard ? $activeText : $inactiveText }}">Dashboard</span>
        </a>

        <div class="pt-6 pb-3 px-4 text-[10px] font-bold text-slate-500 uppercase tracking-widest">
            Pedagogical Management
        </div>

        <a href="/admin/classes" class="{{ $isClasses ? $activeLink : $inactiveLink }}">
            <i data-lucide="school" class="{{ $isClasses ? $activeIcon : $inactiveIcon }}"></i>
            <span class="{{ $isClasses ? $activeText : $inactiveText }}">Classes</span>
        </a>

        <a href="/admin/competences" class="{{ $isCompetences ? $activeLink : $inactiveLink }}">
            <i data-lucide="award" class="{{ $isCompetences ? $activeIcon : $inactiveIcon }}"></i>
            <span class="{{ $isCompetences ? $activeText : $inactiveText }}">Competencies</span>
        </a>

        <a href="/admin/sprints" class="{{ $isSprints ? $activeLink : $inactiveLink }}">
            <i data-lucide="zap" class="{{ $isSprints ? $activeIcon : $inactiveIcon }}"></i>
            <span class="{{ $isSprints ? $activeText : $inactiveText }}">Sprints & Briefs</span>
        </a>

        <div class="pt-6 pb-3 px-4 text-[10px] font-bold text-slate-500 uppercase tracking-widest">
            System & Users
        </div>

        <a href="/admin/users" class="{{ $isUsers ? $activeLink : $inactiveLink }}">
            <i data-lucide="users" class="{{ $isUsers ? $activeIcon : $inactiveIcon }}"></i>
            <span class="{{ $isUsers ? $activeText : $inactiveText }}">Users & Roles</span>
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
                <p class="text-[10px] text-slate-400 truncate uppercase tracking-wider font-semibold">System Manager</p>
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
