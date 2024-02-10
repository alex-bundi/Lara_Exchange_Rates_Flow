@extends('layouts.app')

@section('body__content')
    {{-- Authentication --}}
    <section>
        <div class="">
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

        </div>
    </section>

    <section>
        {{-- Background Image & Main Container  --}}
        <div class="flex justify-center min-h-screen bg-gradient-to-tr from-lightPink to-lightBlue">
            {{-- Flex Item 1 --}}
            <div class="bg-white m-0 p-2 rounded-md h-1/2">

                {{-- Header --}}
                <div class="flex flex-row space-x-1">
                    {{-- Icon --}}
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="rgb(0, 164, 234)" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="font-sans font-bold text-headerBlue">
                            Convert
                        </h1>
                    </div>
                </div>

                {{-- Currency Converter Form --}}
                <div>
                    <form action="">
                        <div class="flex flex-col space-x-2 md:flex-row">

                            {{-- Amount --}}
                            <div class="flex flex-col space-y-2">
                                <label 
                                    class="font-sans font-semibold"
                                    for="amount">
                                    Amount
                                </label>
                                <input
                                    class="bg-gray-100 border-2 border-gray-200 rounded-md w-40 py-1.5 px-2 font-sans 
                                        text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500
                                        md:w-64"
                                    type="text" 
                                    name="amount" 
                                    id="">
                            </div>

                            {{-- From --}}
                            <div class="flex flex-col space-y-2">
                                <label 
                                    class="font-sans font-semibold"
                                    for="amount">
                                    From
                                </label>
                                <input
                                    class="bg-gray-100 border-2 border-gray-200 rounded-md w-40 py-1.5 px-2 font-sans 
                                        text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500
                                        md:w-64"
                                    type="text" 
                                    name="amount" 
                                    id="">
                            </div>

                            {{-- To --}}
                            <div class="flex flex-col space-y-2">
                                <label 
                                    class="font-sans font-semibold"
                                    for="to">
                                    To
                                </label>
                                <input
                                    class="bg-gray-100 border-2 border-gray-200 rounded-md w-40 py-1.5 px-2 font-sans 
                                        text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500
                                        md:w-64"
                                    type="text" 
                                    name="amount" 
                                    id="">
                            </div>
                        </div>
                        
                    
                    </form>
                
                </div>
            </div>

        </div>
    </section>
       
@stop
@php
    $excludeNav = true;
@endphp