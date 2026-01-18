@extends('layout')

@section('title', 'Page Not Found - Decode')

@section('content')
<div class="min-h-screen flex flex-col items-center justify-center bg-slate-50 p-4">
    
    <div class="text-center max-w-lg w-full">
        <h1 class="text-9xl font-black text-indigo-100 select-none">
            404
        </h1>
        
        <div class="bg-slate-900 rounded-lg shadow-xl overflow-hidden -mt-12 relative z-10 mx-auto max-w-md border border-slate-700">
            <div class="bg-slate-800 px-4 py-2 flex items-center gap-2 border-b border-slate-700">
                <div class="w-3 h-3 rounded-full bg-red-500"></div>
                <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
                <div class="w-3 h-3 rounded-full bg-green-500"></div>
                <span class="ml-2 text-xs text-slate-400 font-mono">console.log</span>
            </div>
            
            <div class="p-6 font-mono text-left">
                <p class="text-green-400 text-sm">$ locate page_content</p>
                <p class="text-red-400 text-sm mt-2">Error: 404 Not Found</p>
                <p class="text-slate-400 text-sm mt-1">The requested URL was not found on this server.</p>
                <p class="text-slate-500 text-xs mt-4 animate-pulse">_</p>
            </div>
        </div>

        <h2 class="mt-8 text-2xl font-bold text-slate-800">You've ventured into the void.</h2>
        <p class="mt-2 text-slate-500">
            The page you are looking for doesn't exist or has been moved.
        </p>

        <div class="mt-8 flex gap-4 justify-center">
            <button onclick="history.back()" class="px-6 py-2.5 border border-slate-300 text-slate-700 font-medium rounded-lg hover:bg-slate-100 transition-colors">
                Go Back
            </button>
            
            <a href="/" class="px-6 py-2.5 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 transition-colors shadow-sm shadow-indigo-200">
                Return Home
            </a>
        </div>
    </div>

</div>
@endsection