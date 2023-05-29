@extends('layouts.marketing')

@section('page')

    <main class="max-w-3xl px-4 mx-auto">

        <h2 class="text-4xl font-black tracking-tight text-gray-800 sm:text-6xl">
            The {{ config('app.name') }} Blog
        </h2>

        <p class="pb-6 my-6 text-sm text-gray-700 border-b sm:my-10 sm:text-lg sm:pb-10">
            This blog is where we share official updates about the app, and our community. If you'd like to contribute a post to the blog, please <a href="#" class="font-medium text-gray-900 underline">contact us</a>. Or if you'd like to suggest a topic for us to write about, please <a href="#" class="font-medium text-gray-900 underline">send us a note</a>. Lastly, if you'd just to hang out with us and chat, please <a href="https://discord.gg/B7MRQ5kDFn" target="_blank" class="font-medium text-gray-900 underline">join our Discord</a>.
        </p> 

        <section>

            <article class="flex flex-col items-start justify-between">
                
                <div class="flex items-center text-xs gap-x-4">
                    
                    <time datetime="2020-03-16" class="text-gray-500">Mar 16, 2020</time>
                    
                    <a href="#" class="relative z-10 rounded-full bg-gray-50 px-3 py-1.5 font-medium text-gray-600 hover:bg-gray-100">
                        Marketing
                    </a>

                </div>

                <div class="relative group">
                    
                    <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                        <a href="#">
                            <span class="absolute inset-0"></span>
                            Boost your conversion rate
                        </a>
                    </h3>
                    
                    <p class="mt-5 text-sm leading-6 text-gray-600 line-clamp-3">
                        Illo sint voluptas. Error voluptates culpa eligendi. Hic vel totam vitae illo. Non aliquid explicabo necessitatibus unde. Sed exercitationem placeat consectetur nulla deserunt vel iusto corrupti dicta laboris incididunt.
                    </p>

                </div>

                <div class="relative flex items-center mt-8 gap-x-4">
                    <img src="https://images.unsplash.com/photo-1519244703995-f4e0f30006d5?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="" class="w-10 h-10 rounded-full bg-gray-50">
                    
                    <div class="text-sm leading-6">
                        
                        <p class="font-semibold text-gray-900">
                            <a href="#">
                            <span class="absolute inset-0"></span>
                            Michael Foster
                            </a>
                        </p>
                        
                        <p class="text-gray-600">Co-Founder / CTO</p>

                    </div>
                </div>

            </article>

        </section>
    </main>      
    
@endsection