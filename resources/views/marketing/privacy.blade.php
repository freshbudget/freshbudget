@extends('layouts.marketing')

@section('page')

    <main class="max-w-3xl px-4 mx-auto">

        <h2 class="text-4xl font-black tracking-tight text-gray-800 sm:text-6xl ">
            {{ config('app.name') }} Privacy Policy
        </h2>

        <p class="my-10 text-lg text-gray-700">
            Last updated on {{ (new Illuminate\Support\Carbon)->createFromTimestamp(filemtime(resource_path('views/marketing/terms.blade.php')))->format('F j, Y') }}.
        </p>

    </main>

    <section class="max-w-3xl px-4 mx-auto mt-20">
        
        <div class="prose prose-lg prose-green">

            <p>Your privacy is important to us. It is Fresh Budget's policy to respect your privacy regarding any information we may collect from you across our website, https://www.freshbudget.com, and other sites we own and operate.</p>

            <h3>Information we collect</h3>

            <p>We only collect information about you if we have a reason to do so. For example, we collect information to provide our services to you, to communicate with you, or to make our services better.</p>

            <p>The types of information we may collect include:</p>

            <ul>
            <li>Contact information (such as your name and email address)</li>
            <li>Financial information (such as your bank account or credit card number)</li>
            <li>Usage data (such as how you use our services)</li>
            <li>Device and browser data (such as your IP address and browser type)</li>
            </ul>

            <h3>How we use your information</h3>

            <p>We use your information in a few different ways:</p>

            <ul>
            <li>To provide and maintain our services</li>
            <li>To communicate with you</li>
            <li>To improve our services</li>
            <li>To personalize your experience</li>
            <li>To detect and prevent fraud</li>
            <li>To comply with legal obligations</li>
            </ul>

            <h3>Information sharing and disclosure</h3>

            <p>We may share your information in limited circumstances, including:</p>

            <ul>
            <li>With third-party service providers who help us to provide our services</li>
            <li>With other users with whom you choose to share information</li>
            <li>As required by law or to respond to legal process</li>
            <li>To protect the rights or property of Fresh Budget, our users, or others</li>
            </ul>

            <h3>Security</h3>

            <p>We take reasonable measures to protect your information from unauthorized access or disclosure.</p>

            <h3>Retention</h3>

            <p>We will retain your information only for as long as necessary to provide our services to you and as required by law.</p>

            <h3>Your rights</h3>

            <p>You have certain rights with respect to your information, including:</p>

            <ul>
            <li>The right to access, correct, or delete your information</li>
            <li>The right to object to processing of your information</li>
            <li>The right to restrict processing of your information</li>
            <li>The right to data portability</li>
            <li>The right to withdraw consent</li>
            </ul>

            <h3>Changes to this policy</h3>

            <p>We may update this policy from time to time, and we will notify you of any changes by posting the new policy on our website.</p>

            <h3>Contact us</h3>

            <p>If you have any questions or concerns about our privacy policy, please contact us at <a href="mailto:{{ 'help@' . config('app.url') }}">{{ 'help@' . str(config('app.url'))->ltrim('http://') }}</a>.</p>
            
        </div>

    </section>
    
@endsection