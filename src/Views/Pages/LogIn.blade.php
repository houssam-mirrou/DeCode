@extends('layout')

@section('title', 'Sign In - Decode')

@section('content')

    <div class="min-h-screen w-full flex items-center justify-center p-6 bg-slate-50 relative overflow-hidden">
        
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none z-0">
            <div class="absolute -top-[10%] -left-[10%] w-[40%] h-[40%] rounded-full bg-indigo-100/50 blur-3xl"></div>
            <div class="absolute top-[20%] -right-[10%] w-[30%] h-[30%] rounded-full bg-purple-100/50 blur-3xl"></div>
        </div>

        <div class="w-full max-w-md bg-white/80 backdrop-blur-xl rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-white z-10 relative">
            
            <div class="p-8 sm:p-10">
                <div class="text-center mb-10">
                    <div class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-indigo-600 text-white shadow-lg shadow-indigo-200 mb-4">
                        <i data-lucide="code-2" class="w-6 h-6"></i>
                    </div>
                    <h1 class="text-2xl font-bold text-slate-800 tracking-tight">Welcome back</h1>
                    <p class="text-sm text-slate-500 mt-2">Enter your credentials to access your dashboard</p>
                </div>

                <form action="/login" method="POST" class="space-y-6">
                    
                    <div class="space-y-1.5">
                        <label for="email" class="block text-xs font-bold text-slate-600 uppercase tracking-wide ml-1">Email</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i data-lucide="mail" class="h-5 w-5 {{ isset($errors['email']) ? 'text-red-400' : 'text-slate-400 group-focus-within:text-indigo-500' }} transition-colors"></i>
                            </div>
                            <input type="email" name="email" id="email" required
                                class="block w-full pl-10 pr-3 py-2.5 bg-slate-50 border {{ isset($errors['email']) ? 'border-red-300 focus:ring-red-200 focus:border-red-500' : 'border-slate-200 focus:border-indigo-500 focus:ring-indigo-200' }} rounded-xl text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-4 transition-all duration-200 sm:text-sm"
                                placeholder="name@company.com">
                        </div>
                        @if (isset($errors['email']))
                            <p class="flex items-center gap-1.5 mt-1 text-xs font-medium text-red-500 animate-pulse">
                                <i data-lucide="alert-circle" class="w-3.5 h-3.5"></i>
                                {{ $errors['email'] }}
                            </p>
                        @endif
                    </div>

                    <div class="space-y-1.5">
                        <div class="flex items-center justify-between ml-1">
                            <label for="password" class="block text-xs font-bold text-slate-600 uppercase tracking-wide">Password</label>
                            <a href="#" class="text-xs font-medium text-indigo-600 hover:text-indigo-500 transition-colors">Forgot password?</a>
                        </div>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i data-lucide="lock" class="h-5 w-5 {{ isset($errors['password']) ? 'text-red-400' : 'text-slate-400 group-focus-within:text-indigo-500' }} transition-colors"></i>
                            </div>
                            <input type="password" name="password" id="password" required
                                class="block w-full pl-10 pr-3 py-2.5 bg-slate-50 border {{ (!isset($errors['email']) && isset($errors['password'])) ? 'border-red-300 focus:ring-red-200 focus:border-red-500' : 'border-slate-200 focus:border-indigo-500 focus:ring-indigo-200' }} rounded-xl text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-4 transition-all duration-200 sm:text-sm"
                                placeholder="••••••••">
                        </div>
                        @if (!isset($errors['email']) && isset($errors['password']))
                            <p class="flex items-center gap-1.5 mt-1 text-xs font-medium text-red-500 animate-pulse">
                                <i data-lucide="alert-circle" class="w-3.5 h-3.5"></i>
                                {{ $errors['password'] }}
                            </p>
                        @endif
                    </div>

                    <button type="submit"
                        class="w-full flex justify-center items-center gap-2 py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-bold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200 transform hover:-translate-y-0.5">
                        Sign In
                        <i data-lucide="arrow-right" class="w-4 h-4"></i>
                    </button>
                </form>
            </div>

            <div class="px-8 py-4 bg-slate-50/50 border-t border-slate-100 rounded-b-2xl flex items-center justify-center">
                <p class="text-xs text-slate-500">
                    Don't have an account? <a href="#" class="font-bold text-indigo-600 hover:text-indigo-500 transition-colors">Contact Admin</a>
                </p>
            </div>
        </div>

        <div class="absolute bottom-6 text-center text-[10px] text-slate-400">
            &copy; 2026 Decode Learning Platform. All rights reserved.
        </div>
    </div>

    <script>
        lucide.createIcons();
    </script>
@endsection