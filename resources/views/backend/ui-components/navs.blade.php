@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
    <!-- Body: Body -->
    <div class="body d-flex py-lg-3 py-md-2">
            <div class="container">
                <div class="col-12">
                    <div class="bd-content">
                        
                        <h2 id="base-nav">Base nav</h2>
                        <p>Navigation available in Bootstrap share general markup and styles, from the base <code>.nav</code> class to the active and disabled states. Swap modifier classes to switch between each style.</p>
                        <p>The base <code>.nav</code> component is built with flexbox and provide a strong foundation for building all types of navigation components. It includes some style overrides (for working with lists), some link padding for larger hit areas, and basic disabled styling.</p>
                        <div class="alert alert-danger" role="alert">
                            <strong>Navs</strong> for more bootstrao components <a href="https://v5.getbootstrap.com/docs/5.0/components/navs/#javascript-behavior" target="_blank">Bootstrap Navs documentation <i class="fa fa-external-link"></i></a>
                        </div>
                        <div class="card card-callout p-3">
                            <p class="mb-0">The base <code>.nav</code> component does not include any <code>.active</code> state. The following examples include the class, mainly to demonstrate that this particular class does not trigger any special styling.</p>
                            <p class="mb-0">To convey the active state to assistive technologies, use the <code>aria-current</code> attribute — using the <code>page</code> value for current page, or <code>true</code> for the current item in a set.</p>
                        </div>

                        <div class="border-top mt-5 pt-3">
                            <ul class="nav nav-tabs tab-card px-3 border-bottom-0" role="tablist">
                                <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#nav-Preview1" role="tab">Preview</a></li>
                                <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#nav-HTML1" role="tab">HTML</a></li>
                            </ul>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" id="nav-Preview1" role="tabpanel">
                                            <!-- Nav: left alignment -->
                                            <ul class="nav">
                                                <li class="nav-item"><a class="nav-link active" aria-current="page" href="#">Active</a></li>
                                                <li class="nav-item"><a class="nav-link" href="#">Link</a></li>
                                                <li class="nav-item"><a class="nav-link" href="#">Link</a></li>
                                                <li class="nav-item"><a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a></li>
                                            </ul>

                                            <!-- Nav: center alignment -->
                                            <ul class="nav justify-content-center">
                                                <li class="nav-item"><a class="nav-link active" aria-current="page" href="#">Active</a></li>
                                                <li class="nav-item"><a class="nav-link" href="#">Link</a></li>
                                                <li class="nav-item"><a class="nav-link" href="#">Link</a></li>
                                                <li class="nav-item"><a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a></li>
                                            </ul>

                                            <!-- Nav: right alignment -->
                                            <ul class="nav justify-content-end">
                                                <li class="nav-item"><a class="nav-link active" aria-current="page" href="#">Active</a></li>
                                                <li class="nav-item"><a class="nav-link" href="#">Link</a></li>
                                                <li class="nav-item"><a class="nav-link" href="#">Link</a></li>
                                                <li class="nav-item"><a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a></li>
                                            </ul>
                                        </div>
                                        <div class="tab-pane fade" id="nav-HTML1" role="tabpanel">
<pre class="language-html m-0" data-lang="html">
<code>&lt;!-- Nav: left alignment --&gt;
&lt;ul class=&quot;nav&quot;&gt;
    &lt;li class=&quot;nav-item&quot;&gt;&lt;a class=&quot;nav-link active&quot; aria-current=&quot;page&quot; href=&quot;#&quot;&gt;Active&lt;/a&gt;&lt;/li&gt;
    &lt;li class=&quot;nav-item&quot;&gt;&lt;a class=&quot;nav-link&quot; href=&quot;#&quot;&gt;Link&lt;/a&gt;&lt;/li&gt;
    &lt;li class=&quot;nav-item&quot;&gt;&lt;a class=&quot;nav-link&quot; href=&quot;#&quot;&gt;Link&lt;/a&gt;&lt;/li&gt;
    &lt;li class=&quot;nav-item&quot;&gt;&lt;a class=&quot;nav-link disabled&quot; href=&quot;#&quot; tabindex=&quot;-1&quot; aria-disabled=&quot;true&quot;&gt;Disabled&lt;/a&gt;&lt;/li&gt;
&lt;/ul&gt;

&lt;!-- Nav: center alignment --&gt;
&lt;ul class=&quot;nav justify-content-center&quot;&gt;
    &lt;li class=&quot;nav-item&quot;&gt;&lt;a class=&quot;nav-link active&quot; aria-current=&quot;page&quot; href=&quot;#&quot;&gt;Active&lt;/a&gt;&lt;/li&gt;
    &lt;li class=&quot;nav-item&quot;&gt;&lt;a class=&quot;nav-link&quot; href=&quot;#&quot;&gt;Link&lt;/a&gt;&lt;/li&gt;
    &lt;li class=&quot;nav-item&quot;&gt;&lt;a class=&quot;nav-link&quot; href=&quot;#&quot;&gt;Link&lt;/a&gt;&lt;/li&gt;
    &lt;li class=&quot;nav-item&quot;&gt;&lt;a class=&quot;nav-link disabled&quot; href=&quot;#&quot; tabindex=&quot;-1&quot; aria-disabled=&quot;true&quot;&gt;Disabled&lt;/a&gt;&lt;/li&gt;
&lt;/ul&gt;

&lt;!-- Nav: right alignment --&gt;
&lt;ul class=&quot;nav justify-content-end&quot;&gt;
    &lt;li class=&quot;nav-item&quot;&gt;&lt;a class=&quot;nav-link active&quot; aria-current=&quot;page&quot; href=&quot;#&quot;&gt;Active&lt;/a&gt;&lt;/li&gt;
    &lt;li class=&quot;nav-item&quot;&gt;&lt;a class=&quot;nav-link&quot; href=&quot;#&quot;&gt;Link&lt;/a&gt;&lt;/li&gt;
    &lt;li class=&quot;nav-item&quot;&gt;&lt;a class=&quot;nav-link&quot; href=&quot;#&quot;&gt;Link&lt;/a&gt;&lt;/li&gt;
    &lt;li class=&quot;nav-item&quot;&gt;&lt;a class=&quot;nav-link disabled&quot; href=&quot;#&quot; tabindex=&quot;-1&quot; aria-disabled=&quot;true&quot;&gt;Disabled&lt;/a&gt;&lt;/li&gt;
&lt;/ul&gt;</code>
</pre>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <p>Classes are used throughout, so your markup can be super flexible. Use <code>&lt;ul&gt;</code>s like above, <code>&lt;ol&gt;</code> if the order of your items is important, or roll your own with a <code>&lt;nav&gt;</code> element. Because the <code>.nav</code> uses <code>display: flex</code>, the nav links behave the same as nav items would, but without the extra markup.</p>
                            <ul class="nav nav-tabs tab-card px-3 border-bottom-0" role="tablist">
                                <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#nav-Preview2" role="tab">Preview</a></li>
                                <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#nav-HTML2" role="tab">HTML</a></li>
                            </ul>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" id="nav-Preview2" role="tabpanel">
                                            <nav class="nav">
                                                <a class="nav-link active" aria-current="page" href="#">Active</a>
                                                <a class="nav-link" href="#">Link</a>
                                                <a class="nav-link" href="#">Link</a>
                                                <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                                            </nav>
                                        </div>
                                        <div class="tab-pane fade" id="nav-HTML2" role="tabpanel">
<pre class="language-html m-0" data-lang="html">
<code>&lt;nav class=&quot;nav&quot;&gt;
    &lt;a class=&quot;nav-link active&quot; aria-current=&quot;page&quot; href=&quot;#&quot;&gt;Active&lt;/a&gt;
    &lt;a class=&quot;nav-link&quot; href=&quot;#&quot;&gt;Link&lt;/a&gt;
    &lt;a class=&quot;nav-link&quot; href=&quot;#&quot;&gt;Link&lt;/a&gt;
    &lt;a class=&quot;nav-link disabled&quot; href=&quot;#&quot; tabindex=&quot;-1&quot; aria-disabled=&quot;true&quot;&gt;Disabled&lt;/a&gt;
&lt;/nav&gt;</code>
</pre>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <ul class="nav nav-tabs tab-card px-3 border-bottom-0" role="tablist">
                                <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#nav-Preview3" role="tab">Preview</a></li>
                                <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#nav-HTML3" role="tab">HTML</a></li>
                            </ul>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" id="nav-Preview3" role="tabpanel">
                                            <div class="row">
                                                <div class="col-md-6 col-12">
                                                    <ul class="nav flex-column">
                                                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="#">Active</a></li>
                                                        <li class="nav-item"><a class="nav-link" href="#">Link</a></li>
                                                        <li class="nav-item"><a class="nav-link" href="#">Link</a></li>
                                                        <li class="nav-item"><a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a></li>
                                                    </ul>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <nav class="nav flex-column">
                                                        <a class="nav-link active" aria-current="page" href="#">Active</a>
                                                        <a class="nav-link" href="#">Link</a>
                                                        <a class="nav-link" href="#">Link</a>
                                                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                                                    </nav>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="nav-HTML3" role="tabpanel">
<pre class="language-html m-0" data-lang="html">
<code>&lt;ul class=&quot;nav flex-column&quot;&gt;
    &lt;li class=&quot;nav-item&quot;&gt;&lt;a class=&quot;nav-link active&quot; aria-current=&quot;page&quot; href=&quot;#&quot;&gt;Active&lt;/a&gt;&lt;/li&gt;
    &lt;li class=&quot;nav-item&quot;&gt;&lt;a class=&quot;nav-link&quot; href=&quot;#&quot;&gt;Link&lt;/a&gt;&lt;/li&gt;
    &lt;li class=&quot;nav-item&quot;&gt;&lt;a class=&quot;nav-link&quot; href=&quot;#&quot;&gt;Link&lt;/a&gt;&lt;/li&gt;
    &lt;li class=&quot;nav-item&quot;&gt;&lt;a class=&quot;nav-link disabled&quot; href=&quot;#&quot; tabindex=&quot;-1&quot; aria-disabled=&quot;true&quot;&gt;Disabled&lt;/a&gt;&lt;/li&gt;
&lt;/ul&gt;

&lt;nav class=&quot;nav flex-column&quot;&gt;
    &lt;a class=&quot;nav-link active&quot; aria-current=&quot;page&quot; href=&quot;#&quot;&gt;Active&lt;/a&gt;
    &lt;a class=&quot;nav-link&quot; href=&quot;#&quot;&gt;Link&lt;/a&gt;
    &lt;a class=&quot;nav-link&quot; href=&quot;#&quot;&gt;Link&lt;/a&gt;
    &lt;a class=&quot;nav-link disabled&quot; href=&quot;#&quot; tabindex=&quot;-1&quot; aria-disabled=&quot;true&quot;&gt;Disabled&lt;/a&gt;
&lt;/nav&gt;</code>
</pre>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="border-top mt-5 pt-3">
                            <h3 id="tabs">Tabs</h3>
                            <p>Takes the basic nav from above and adds the <code>.nav-tabs</code> class to generate a tabbed interface.</p>
                            <ul class="nav nav-tabs px-3 border-bottom-0" role="tablist">
                                <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#nav-Preview4" role="tab">Preview</a></li>
                                <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#nav-HTML4" role="tab">HTML</a></li>
                                <li class="nav-item"><a class="nav-link" href="#">Link</a></li>
                                <li class="nav-item"><a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a></li>
                            </ul>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" id="nav-Preview4" role="tabpanel">
                                            Takes the basic nav from above and adds the <code>.nav .nav-tabs .px-3 .border-bottom-0</code> class to generate a tabbed interface.
                                        </div>
                                        <div class="tab-pane fade" id="nav-HTML4" role="tabpanel">
<pre class="language-html m-0" data-lang="html">
<code>&lt;ul class=&quot;nav nav-tabs px-3 border-bottom-0&quot; role=&quot;tablist&quot;&gt;
    &lt;li class=&quot;nav-item&quot;&gt;&lt;a class=&quot;nav-link active&quot; data-bs-toggle=&quot;tab&quot; href=&quot;#nav-Preview4&quot; role=&quot;tab&quot;&gt;Preview&lt;/a&gt;&lt;/li&gt;
    &lt;li class=&quot;nav-item&quot;&gt;&lt;a class=&quot;nav-link&quot; data-bs-toggle=&quot;tab&quot; href=&quot;#nav-HTML4&quot; role=&quot;tab&quot;&gt;HTML&lt;/a&gt;&lt;/li&gt;
&lt;/ul&gt;
&lt;div class=&quot;card mb-3&quot;&gt;
    &lt;div class=&quot;card-body&quot;&gt;
        &lt;div class=&quot;tab-content&quot;&gt;
            &lt;div class=&quot;tab-pane fade show active&quot; id=&quot;nav-Preview4&quot; role=&quot;tabpanel&quot;&gt;
                ...
            &lt;/div&gt;
            &lt;div class=&quot;tab-pane fade&quot; id=&quot;nav-HTML4&quot; role=&quot;tabpanel&quot;&gt;
                ...
            &lt;/div&gt;
        &lt;/div&gt;
    &lt;/div&gt;
&lt;/div&gt;</code>
</pre>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="card mb-3">
                                <div class="card-body">
                                    <ul class="nav nav-tabs tab-body-header rounded d-inline-flex" role="tablist">
                                        <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#nav-Preview5" role="tab">Preview</a></li>
                                        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#nav-HTML5" role="tab">HTML</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#">Link</a></li>
                                        <li class="nav-item"><a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a></li>
                                    </ul>

                                    <div class="tab-content mt-2">
                                        <div class="tab-pane fade show active" id="nav-Preview5" role="tabpanel">
                                            Takes the basic nav from above and adds the <code>.nav .nav-tabs .tab-body-header .rounded .d-inline-flex</code> class to generate a tabbed interface.
                                        </div>
                                        <div class="tab-pane fade" id="nav-HTML5" role="tabpanel">
<pre class="language-html m-0" data-lang="html">
<code>&lt;ul class=&quot;nav nav-tabs tab-body-header rounded d-inline-flex&quot; role=&quot;tablist&quot;&gt;
    &lt;li class=&quot;nav-item&quot;&gt;&lt;a class=&quot;nav-link active&quot; data-bs-toggle=&quot;tab&quot; href=&quot;#nav-Preview5&quot; role=&quot;tab&quot;&gt;Preview&lt;/a&gt;&lt;/li&gt;
    &lt;li class=&quot;nav-item&quot;&gt;&lt;a class=&quot;nav-link&quot; data-bs-toggle=&quot;tab&quot; href=&quot;#nav-HTML5&quot; role=&quot;tab&quot;&gt;HTML&lt;/a&gt;&lt;/li&gt;
&lt;/ul&gt;

&lt;div class=&quot;tab-content mt-2&quot;&gt;
    &lt;div class=&quot;tab-pane fade show active&quot; id=&quot;nav-Preview5&quot; role=&quot;tabpanel&quot;&gt;
        ....
    &lt;/div&gt;
    &lt;div class=&quot;tab-pane fade&quot; id=&quot;nav-HTML5&quot; role=&quot;tabpanel&quot;&gt;
        ....
    &lt;/div&gt;
&lt;/div&gt;</code>
</pre>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card mb-3">
                                <div class="card-body">
                                    <ul class="nav nav-tabs tab-card" role="tablist">
                                        <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#nav-Preview6" role="tab">Preview</a></li>
                                        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#nav-HTML6" role="tab">HTML</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#">Link</a></li>
                                        <li class="nav-item"><a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a></li>
                                    </ul>

                                    <div class="tab-content mt-2">
                                        <div class="tab-pane fade show active" id="nav-Preview6" role="tabpanel">
                                            Takes the basic nav from above and adds the <code>.nav nav-tabs .tab-card</code> class to generate a tabbed interface.
                                        </div>
                                        <div class="tab-pane fade" id="nav-HTML6" role="tabpanel">
<pre class="language-html m-0" data-lang="html">
<code>&lt;ul class=&quot;nav nav-tabs tab-card&quot; role=&quot;tablist&quot;&gt;
    &lt;li class=&quot;nav-item&quot;&gt;&lt;a class=&quot;nav-link active&quot; data-bs-toggle=&quot;tab&quot; href=&quot;#nav-Preview6&quot; role=&quot;tab&quot;&gt;Preview&lt;/a&gt;&lt;/li&gt;
    &lt;li class=&quot;nav-item&quot;&gt;&lt;a class=&quot;nav-link&quot; data-bs-toggle=&quot;tab&quot; href=&quot;#nav-HTML6&quot; role=&quot;tab&quot;&gt;HTML&lt;/a&gt;&lt;/li&gt;
&lt;/ul&gt;

&lt;div class=&quot;tab-content mt-2&quot;&gt;
    &lt;div class=&quot;tab-pane fade show active&quot; id=&quot;nav-Preview6&quot; role=&quot;tabpanel&quot;&gt;
        ....
    &lt;/div&gt;
    &lt;div class=&quot;tab-pane fade&quot; id=&quot;nav-HTML6&quot; role=&quot;tabpanel&quot;&gt;
        ....
    &lt;/div&gt;
&lt;/div&gt;</code>
</pre>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card mb-3">
                                <div class="card-body">
                                    <ul class="nav nav-tabs tab-card" role="tablist">
                                        <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#nav-Preview7" role="tab">Preview</a></li>
                                        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#nav-HTML7" role="tab">HTML</a></li>
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Dropdown</a>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#">Action</a></li>
                                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li><a class="dropdown-item" href="#">Separated link</a></li>
                                            </ul>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Link</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                                        </li>
                                    </ul>

                                    <div class="tab-content mt-2">
                                        <div class="tab-pane fade show active" id="nav-Preview7" role="tabpanel">
                                            Takes the basic nav from above and adds the <code>.nav nav-tabs .tab-card</code> class to generate a tabbed interface.
                                        </div>
                                        <div class="tab-pane fade" id="nav-HTML7" role="tabpanel">
<pre class="language-html m-0" data-lang="html">
<code>&lt;ul class=&quot;nav nav-tabs tab-card&quot; role=&quot;tablist&quot;&gt;
    &lt;li class=&quot;nav-item&quot;&gt;&lt;a class=&quot;nav-link active&quot; data-bs-toggle=&quot;tab&quot; href=&quot;#nav-Preview7&quot; role=&quot;tab&quot;&gt;Preview&lt;/a&gt;&lt;/li&gt;
    &lt;li class=&quot;nav-item&quot;&gt;&lt;a class=&quot;nav-link&quot; data-bs-toggle=&quot;tab&quot; href=&quot;#nav-HTML7&quot; role=&quot;tab&quot;&gt;HTML&lt;/a&gt;&lt;/li&gt;
    &lt;li class=&quot;nav-item dropdown&quot;&gt;
        &lt;a class=&quot;nav-link dropdown-toggle&quot; data-bs-toggle=&quot;dropdown&quot; href=&quot;#&quot; role=&quot;button&quot; aria-expanded=&quot;false&quot;&gt;Dropdown&lt;/a&gt;
        &lt;ul class=&quot;dropdown-menu&quot;&gt;
            &lt;li&gt;&lt;a class=&quot;dropdown-item&quot; href=&quot;#&quot;&gt;Action&lt;/a&gt;&lt;/li&gt;
            &lt;li&gt;&lt;a class=&quot;dropdown-item&quot; href=&quot;#&quot;&gt;Another action&lt;/a&gt;&lt;/li&gt;
            &lt;li&gt;&lt;a class=&quot;dropdown-item&quot; href=&quot;#&quot;&gt;Something else here&lt;/a&gt;&lt;/li&gt;
            &lt;li&gt;&lt;hr class=&quot;dropdown-divider&quot;&gt;&lt;/li&gt;
            &lt;li&gt;&lt;a class=&quot;dropdown-item&quot; href=&quot;#&quot;&gt;Separated link&lt;/a&gt;&lt;/li&gt;
        &lt;/ul&gt;
    &lt;/li&gt;
    &lt;li class=&quot;nav-item&quot;&gt;
        &lt;a class=&quot;nav-link&quot; href=&quot;#&quot;&gt;Link&lt;/a&gt;
    &lt;/li&gt;
    &lt;li class=&quot;nav-item&quot;&gt;
        &lt;a class=&quot;nav-link disabled&quot; href=&quot;#&quot; tabindex=&quot;-1&quot; aria-disabled=&quot;true&quot;&gt;Disabled&lt;/a&gt;
    &lt;/li&gt;
&lt;/ul&gt;

&lt;div class=&quot;tab-content mt-2&quot;&gt;
    &lt;div class=&quot;tab-pane fade show active&quot; id=&quot;nav-Preview7&quot; role=&quot;tabpanel&quot;&gt;
       ....
    &lt;/div&gt;
    &lt;div class=&quot;tab-pane fade&quot; id=&quot;nav-HTML7&quot; role=&quot;tabpanel&quot;&gt;
        ....
    &lt;/div&gt;
&lt;/div&gt;</code>
</pre>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="border-top mt-5 pt-3">
                            <h3 id="Pills">Pills</h3>
                            <p>Take that same HTML, but use <code>.nav-pills</code> instead:</p>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <ul class="nav nav-pills mb-3" role="tablist">
                                        <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#nav-Preview8" role="tab">Preview</a></li>
                                        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#nav-HTML8" role="tab">HTML</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#">Link</a></li>
                                        <li class="nav-item"><a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a></li>
                                    </ul>

                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" id="nav-Preview8" role="tabpanel">
                                            Eiusmod consequat eu adipisicing minim anim aliquip cupidatat culpa excepteur quis. Occaecat sit eu exercitation irure Lorem incididunt nostrud.
                                        </div>
                                        <div class="tab-pane fade" id="nav-HTML8" role="tabpanel">
<pre class="language-html m-0" data-lang="html">
<code>&lt;ul class=&quot;nav nav-pills mb-3&quot; role=&quot;tablist&quot;&gt;
    &lt;li class=&quot;nav-item&quot;&gt;&lt;a class=&quot;nav-link active&quot; data-bs-toggle=&quot;tab&quot; href=&quot;#nav-Preview8&quot; role=&quot;tab&quot;&gt;Preview&lt;/a&gt;&lt;/li&gt;
    &lt;li class=&quot;nav-item&quot;&gt;&lt;a class=&quot;nav-link&quot; data-bs-toggle=&quot;tab&quot; href=&quot;#nav-HTML8&quot; role=&quot;tab&quot;&gt;HTML&lt;/a&gt;&lt;/li&gt;
    &lt;li class=&quot;nav-item&quot;&gt;&lt;a class=&quot;nav-link&quot; href=&quot;#&quot;&gt;Link&lt;/a&gt;&lt;/li&gt;
    &lt;li class=&quot;nav-item&quot;&gt;&lt;a class=&quot;nav-link disabled&quot; href=&quot;#&quot; tabindex=&quot;-1&quot; aria-disabled=&quot;true&quot;&gt;Disabled&lt;/a&gt;&lt;/li&gt;
&lt;/ul&gt;

&lt;div class=&quot;tab-content&quot;&gt;
    &lt;div class=&quot;tab-pane fade show active&quot; id=&quot;nav-Preview8&quot; role=&quot;tabpanel&quot;&gt;
        ....
    &lt;/div&gt;
    &lt;div class=&quot;tab-pane fade&quot; id=&quot;nav-HTML8&quot; role=&quot;tabpanel&quot;&gt;
        ....
    &lt;/div&gt;
&lt;/div&gt;</code>
</pre>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="d-flex align-items-start">
                                        <ul class="nav flex-column nav-pills me-3" role="tablist">
                                            <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#nav-Preview9" role="tab">Preview</a></li>
                                            <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#nav-HTML9" role="tab">HTML</a></li>
                                            <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#nav-Messages9" role="tab">Messages</a></li>
                                            <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#nav-Settings9" role="tab">Settings</a></li>
                                        </ul>

                                        <div class="tab-content">
                                            <div class="tab-pane fade show active" id="nav-Preview9" role="tabpanel">
                                                Eiusmod consequat eu adipisicing minim anim aliquip cupidatat culpa excepteur quis. Occaecat sit eu exercitation irure Lorem incididunt nostrud.
                                            </div>
                                            <div class="tab-pane fade" id="nav-HTML9" role="tabpanel">
<pre class="language-html m-0" data-lang="html">
<code>&lt;div class=&quot;d-flex align-items-start&quot;&gt;
    &lt;ul class=&quot;nav flex-column nav-pills me-3&quot; role=&quot;tablist&quot;&gt;
        &lt;li class=&quot;nav-item&quot;&gt;&lt;a class=&quot;nav-link active&quot; data-bs-toggle=&quot;tab&quot; href=&quot;#nav-Preview9&quot; role=&quot;tab&quot;&gt;Preview&lt;/a&gt;&lt;/li&gt;
        &lt;li class=&quot;nav-item&quot;&gt;&lt;a class=&quot;nav-link&quot; data-bs-toggle=&quot;tab&quot; href=&quot;#nav-HTML9&quot; role=&quot;tab&quot;&gt;HTML&lt;/a&gt;&lt;/li&gt;
        &lt;li class=&quot;nav-item&quot;&gt;&lt;a class=&quot;nav-link&quot; data-bs-toggle=&quot;tab&quot; href=&quot;#nav-Messages9&quot; role=&quot;tab&quot;&gt;Messages&lt;/a&gt;&lt;/li&gt;
        &lt;li class=&quot;nav-item&quot;&gt;&lt;a class=&quot;nav-link&quot; data-bs-toggle=&quot;tab&quot; href=&quot;#nav-Settings9&quot; role=&quot;tab&quot;&gt;Settings&lt;/a&gt;&lt;/li&gt;
    &lt;/ul&gt;

    &lt;div class=&quot;tab-content&quot;&gt;
        &lt;div class=&quot;tab-pane fade show active&quot; id=&quot;nav-Preview9&quot; role=&quot;tabpanel&quot;&gt;
            ....
        &lt;/div&gt;
        &lt;div class=&quot;tab-pane fade&quot; id=&quot;nav-HTML9&quot; role=&quot;tabpanel&quot;&gt;
            ....
        &lt;/div&gt;
        &lt;div class=&quot;tab-pane fade&quot; id=&quot;nav-Messages9&quot; role=&quot;tabpanel&quot;&gt;
            ....
        &lt;/div&gt;
        &lt;div class=&quot;tab-pane fade&quot; id=&quot;nav-Settings9&quot; role=&quot;tabpanel&quot;&gt;
            ....
        &lt;/div&gt;
    &lt;/div&gt;
&lt;/div&gt;</code>
</pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
    <script src="{{ asset('js/template.js') }}"></script>
@endsection
