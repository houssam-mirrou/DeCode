@extends('layout')

@section('title', 'Sign In - Decode')

@section('content')

    <div class="flex-1 flex items-center justify-center p-6">

        <div class="w-full max-w-md bg-white rounded-xl shadow-lg border border-slate-100 p-8">

            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-indigo-600">Decode</h1>
                <p class="text-sm text-slate-500 mt-2">Welcome back! Please access your account.</p>
            </div>

            <form action="/login" method="POST" class="space-y-5">
                <div>
                    <label for="email" class="block text-sm font-medium text-slate-700 mb-1">Email Address</label>
                    <input type="email" name="email" id="email" required
                        class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all"
                        placeholder="student@decode.com">
                    @if (isset($errors['email']))
                        <p class="flex items-center gap-1 mt-2 text-sm text-red-600">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                                <path fill-rule="evenodd"
                                    d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12ZM12 8.25a.75.75 0 0 1 .75.75v3.75a.75.75 0 0 1-1.5 0V9a.75.75 0 0 1 .75-.75Zm0 8.25a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ $errors['email'] }}
                        </p>
                    @endif
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-slate-700 mb-1">Password</label>
                    <input type="password" name="password" id="password" required
                        class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all"
                        placeholder="••••••••">
                    @if (!isset($errors['email']) && isset($errors['password']))
                        <p class="flex items-center gap-1 mt-2 text-sm text-red-600">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                                <path fill-rule="evenodd"
                                    d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12ZM12 8.25a.75.75 0 0 1 .75.75v3.75a.75.75 0 0 1-1.5 0V9a.75.75 0 0 1 .75-.75Zm0 8.25a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ $errors['password'] }}
                        </p>
                    @endif
                </div>

                <button type="submit"
                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2.5 rounded-lg transition-colors shadow-sm">
                    Sign In
                </button>
            </form>

            <div class="mt-6 text-center text-xs text-slate-400">
                &copy; 2026 Decode. All rights reserved.
            </div>
        </div>
    </div>
@endsection
