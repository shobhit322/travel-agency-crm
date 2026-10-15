<x-site.layout title="Request a demo" description="Tell us about your travel agency and we will arrange a VI Studio Travel CRM demo." body-class="page-plain">
    <section class="page-hero">
        <div class="container narrow">
            <p class="eyebrow">Request a demo</p>
            <h1>See VI Studio Travel CRM in action</h1>
            <p class="lead">Tell us a little about your agency. We will get back to you with demo access and answer your questions.</p>
        </div>
    </section>

    <section class="section section--tight">
        <div class="container narrow">
            <div class="card card--form reveal">
                @include('site.partials.demo-form')
            </div>
            <p class="back-link"><a href="{{ route('home') }}">← Back to the website</a> · <a href="{{ url('/admin/login') }}">Sign in</a></p>
        </div>
    </section>
</x-site.layout>
