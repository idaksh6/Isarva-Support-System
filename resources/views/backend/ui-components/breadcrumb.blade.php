@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
    <!-- Body: Body -->
    <div class="body d-flex py-lg-3 py-md-2">
            <div class="container">
                <div class="col-12">
                    <div class="bd-content">
                        <h2>Example</h2>
                        <div class="bd-example mb-5">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb p-2">
                                    <li class="breadcrumb-item active" aria-current="page">Home</li>
                                </ol>
                            </nav>
                            
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb p-2">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Library</li>
                                </ol>
                            </nav>
                            
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb p-2">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item"><a href="#">Library</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Data</li>
                                </ol>
                            </nav>
<pre>
<code class="language-html" data-lang="html">&lt;nav aria-label=&quot;breadcrumb&quot;&gt;
    &lt;ol class=&quot;breadcrumb&quot;&gt;
        &lt;li class=&quot;breadcrumb-item active&quot; aria-current=&quot;page&quot;&gt;Home&lt;/li&gt;
    &lt;/ol&gt;
&lt;/nav&gt;

&lt;nav aria-label=&quot;breadcrumb&quot;&gt;
    &lt;ol class=&quot;breadcrumb&quot;&gt;
        &lt;li class=&quot;breadcrumb-item&quot;&gt;&lt;a href=&quot;#&quot;&gt;Home&lt;/a&gt;&lt;/li&gt;
        &lt;li class=&quot;breadcrumb-item active&quot; aria-current=&quot;page&quot;&gt;Library&lt;/li&gt;
    &lt;/ol&gt;
&lt;/nav&gt;

&lt;nav aria-label=&quot;breadcrumb&quot;&gt;
    &lt;ol class=&quot;breadcrumb&quot;&gt;
        &lt;li class=&quot;breadcrumb-item&quot;&gt;&lt;a href=&quot;#&quot;&gt;Home&lt;/a&gt;&lt;/li&gt;
        &lt;li class=&quot;breadcrumb-item&quot;&gt;&lt;a href=&quot;#&quot;&gt;Library&lt;/a&gt;&lt;/li&gt;
        &lt;li class=&quot;breadcrumb-item active&quot; aria-current=&quot;page&quot;&gt;Data&lt;/li&gt;
    &lt;/ol&gt;
&lt;/nav&gt;</code>
</pre>
                        </div> <!-- example end  -->
              
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
        <script src="{{ asset('js/template.js') }}"></script>
@endsection
