@extends('layouts.main')

@section('content')
    <section class="bg-white dark:bg-gray-800 rounded-3xl">
        <div class="grid max-w-screen-xl gap-8 px-4 py-8 mx-auto lg:py-16 lg:grid-cols-2 lg:gap-16">
            <div class="flex flex-col justify-center">
                <h1 class="mb-4 text-3xl font-extrabold text-gray-900 dark:text-white md:text-5xl lg:text-6xl">
                    <span class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">Flowbite</span>

                </h1>
                <p class="mb-8 text-lg font-normal text-gray-500 lg:text-xl dark:text-gray-400">Here at Flowbite we focus on
                    markets where technology, innovation, and capital can unlock long-term value and drive economic growth.
                </p>
                <div class="flex flex-col space-y-4 sm:flex-row sm:space-y-0 sm:space-x-4">
                    <a href="#"
                        class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
                        Get started
                        <svg class="w-3.5 h-3.5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 5h12m0 0L9 1m4 4L9 9" />
                        </svg>
                    </a>
                    <a href="#"
                        class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center text-gray-900 border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 dark:text-white dark:border-gray-700 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                        Learn more
                    </a>
                </div>
            </div>
            <div>
                <iframe class="w-full h-64 mx-auto rounded-lg shadow-xl lg:max-w-xl sm:h-96"
                    src="https://www.youtube.com/embed/KaLxCiilHns" title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen></iframe>
            </div>
        </div>
    </section>

    <hr class="my-6 border-2 border-gray-200 rounded-full dark:border-gray-700">

    <p class="mb-3 text-gray-500 dark:text-gray-600">Track work across the enterprise through an open, collaborative
        platform. Link issues across Jira and ingest data from other software development tools, so your IT support and
        operations teams have richer contextual information to rapidly respond to requests, incidents, and changes.</p>
    <div class="grid grid-cols-1 md:gap-6 md:grid-cols-2">
        <p class="mb-3 text-gray-500 dark:text-gray-600">Track work across the enterprise through an open, collaborative
            platform. Link issues across Jira and ingest data from other software development tools, so your IT support and
            operations teams have richer contextual information to rapidly respond to requests, incidents, and changes.</p>
        <blockquote class="mb-3">
            <p class="text-xl italic font-semibold text-gray-900 dark:text-slate-900">" Flowbite is just awesome. It
                contains
                tons of predesigned components and pages starting from login screen to complex dashboard. Perfect choice for
                your next SaaS application. "</p>
        </blockquote>
    </div>
    <p class="mb-3 text-gray-500 dark:text-gray-600">Deliver great service experiences fast - without the complexity of
        traditional ITSM solutions.Accelerate critical development work, eliminate toil, and deploy changes with ease, with
        a complete audit trail for every change.</p>
@endsection
