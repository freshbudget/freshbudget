@extends('layouts.marketing')

@section('page')

    <main class="max-w-3xl px-4 mx-auto">

        <h2 class="text-4xl font-black tracking-tight text-gray-800 sm:text-6xl ">
            {{ config('app.name') }} Terms of Service
        </h2>

        <p class="my-10 text-lg text-gray-700">
            Last updated on {{ (new Illuminate\Support\Carbon)->createFromTimestamp(filemtime(resource_path('views/marketing/terms.blade.php')))->format('F j, Y') }}.
        </p>

    </main>

    <section class="max-w-3xl px-4 mx-auto mt-20">
        
        <div class="prose prose-lg prose-green">

            <p>Thank you for using Fresh Budget (the "Service"). By using the Service, you agree to be bound by these terms of service ("Terms").</p>

            <h2>1. Your Responsibilities</h2>
            <p>You are responsible for maintaining the confidentiality of your account information and password, and for all activities that occur under your account.</p>

            <h2>2. Payment and Fees</h2>
            <p>You agree to pay all fees and charges associated with your use of the Service in a timely manner.</p>

            <h2>3. Prohibited Use</h2>
            <p>You agree not to use the Service for any unlawful purpose or in any way that could damage, disable, overburden, or impair the Service or interfere with any other user's use and enjoyment of the Service.</p>

            <h2>4. Intellectual Property</h2>
            <p>The Service and its entire contents, features, and functionality (including but not limited to all information, software, text, displays, images, video, and audio, and the design, selection, and arrangement thereof), are owned by Fresh Budget, its licensors, or other providers of such material and are protected by United States and international copyright, trademark, patent, trade secret, and other intellectual property or proprietary rights laws.</p>

            <h2>5. Disclaimer of Warranties</h2>
            <p>The Service is provided on an "as is" and "as available" basis, without any warranties of any kind, either express or implied, including but not limited to warranties of merchantability, fitness for a particular purpose, non-infringement, or course of performance.</p>

            <h2>6. Limitation of Liability</h2>
            <p>Fresh Budget and its affiliates, licensors, service providers, employees, agents, officers, or directors shall not be liable for any direct, indirect, incidental, consequential, or punitive damages arising out of or related to your use of the Service.</p>

            <h2>7. Indemnification</h2>
            <p>You agree to indemnify, defend, and hold harmless Fresh Budget and its affiliates, licensors, service providers, employees, agents, officers, or directors from any and all claims, liabilities, damages, costs, and expenses, including reasonable attorneys' fees, arising from your use of the Service or your breach of these Terms.</p>

            <h2>8. Termination</h2>
            <p>Fresh Budget may terminate or suspend your access to the Service at any time, without prior notice or liability, for any reason whatsoever, including without limitation if you breach these Terms.</p>

            <h2>9. Governing Law</h2>
            <p>These Terms shall be governed by and construed in accordance with the laws of the State of California, without giving effect to any principles of conflicts of law.</p>

            <h2>10. Changes to Terms</h2>
            <p>Fresh Budget reserves the right, in its sole discretion, to change, modify, add, or remove portions of these Terms at any time without notice to you. Please check these Terms periodically for changes. Your continued use of the Service after the posting of any changes to these Terms constitutes acceptance of those changes.</p>

            <h2>11. Contact Information</h2>
            <p>If you have any questions or concerns about these Terms, please contact us at <a href="mailto:{{ 'help@' . config('app.url') }}">{{ 'help@' . str(config('app.url'))->ltrim('http://') }}</a>.</p>

        </div>

    </section>
    
@endsection