@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
    <!-- Body: Body -->
    <div class="body d-flex py-lg-3 py-md-2">
            <div class="container">
                <div class="col-12">
                    <div class="bd-content">

                        <h2 id="examples">Examples</h2>
                        <p>Alerts are available for any length of text, as well as an optional close button. For proper styling, use one of the eight <strong>required</strong> contextual classes (e.g., <code>.alert-success</code>). For inline dismissal, use the <a href="#dismissing">alerts JavaScript plugin</a>.</p>
                        <div class="bd-example mb-5">
                        
                            <div role="alert" class="alert alert-primary">A simple primary alert—check it out!</div>
                            <div role="alert" class="alert alert-secondary">A simple secondary alert—check it out!</div>
                            <div role="alert" class="alert alert-success">A simple success alert—check it out!</div>
                            <div role="alert" class="alert alert-danger">A simple danger alert—check it out!</div>
                            <div role="alert" class="alert alert-warning">A simple warning alert—check it out!</div>
                            <div role="alert" class="alert alert-info">A simple info alert—check it out!</div>
                            <div role="alert" class="alert alert-light">A simple light alert—check it out!</div>
                            <div role="alert" class="alert alert-dark">A simple dark alert—check it out!</div>
<pre>
<code class="language-html" data-lang="html">&lt;div role=&quot;alert&quot; class=&quot;alert alert-primary&quot;&gt;A simple primary alert&mdash;check it out!&lt;/div&gt;
&lt;div role=&quot;alert&quot; class=&quot;alert alert-secondary&quot;&gt;A simple secondary alert&mdash;check it out!&lt;/div&gt;
&lt;div role=&quot;alert&quot; class=&quot;alert alert-success&quot;&gt;A simple success alert&mdash;check it out!&lt;/div&gt;
&lt;div role=&quot;alert&quot; class=&quot;alert alert-danger&quot;&gt;A simple danger alert&mdash;check it out!&lt;/div&gt;
&lt;div role=&quot;alert&quot; class=&quot;alert alert-warning&quot;&gt;A simple warning alert&mdash;check it out!&lt;/div&gt;
&lt;div role=&quot;alert&quot; class=&quot;alert alert-info&quot;&gt;A simple info alert&mdash;check it out!&lt;/div&gt;
&lt;div role=&quot;alert&quot; class=&quot;alert alert-light&quot;&gt;A simple light alert&mdash;check it out!&lt;/div&gt;
&lt;div role=&quot;alert&quot; class=&quot;alert alert-dark&quot;&gt;A simple dark alert&mdash;check it out!&lt;/div&gt;</code>
</pre>
                        </div> <!-- example end  -->

                        <div class="bd-callout bd-callout-info">
                            <h5 id="conveying-meaning-to-assistive-technologies">Conveying meaning to assistive technologies</h5>
                            <p>Using color to add meaning only provides a visual indication, which will not be conveyed to users of assistive technologies – such as screen readers. Ensure that information denoted by the color is either obvious from the content itself (e.g. the visible text), or is included through alternative means, such as additional text hidden with the <code>.visually-hidden</code> class.</p>
                        </div>                        
                        <h3 id="link-color">Link color</h3>
                        <p>Use the <code>.alert-link</code> utility class to quickly provide matching colored links within any alert.</p>
                        <div class="bd-example mb-5">
                        
                            <div class="alert alert-primary" role="alert">
                                A simple primary alert with <a href="#" class="alert-link">an example link</a>. Give it a click if you like.
                            </div>
                            <div class="alert alert-secondary" role="alert">
                                A simple secondary alert with <a href="#" class="alert-link">an example link</a>. Give it a click if you like.
                            </div>
                            <div class="alert alert-success" role="alert">
                                A simple success alert with <a href="#" class="alert-link">an example link</a>. Give it a click if you like.
                            </div>
                            <div class="alert alert-danger" role="alert">
                                A simple danger alert with <a href="#" class="alert-link">an example link</a>. Give it a click if you like.
                            </div>
                            <div class="alert alert-warning" role="alert">
                                A simple warning alert with <a href="#" class="alert-link">an example link</a>. Give it a click if you like.
                            </div>
                            <div class="alert alert-info" role="alert">
                                A simple info alert with <a href="#" class="alert-link">an example link</a>. Give it a click if you like.
                            </div>
                            <div class="alert alert-light" role="alert">
                                A simple light alert with <a href="#" class="alert-link">an example link</a>. Give it a click if you like.
                            </div>
                            <div class="alert alert-dark" role="alert">
                                A simple dark alert with <a href="#" class="alert-link">an example link</a>. Give it a click if you like.
                            </div>
<pre>
<code class="language-html" data-lang="html">&lt;div class=&quot;alert alert-primary&quot; role=&quot;alert&quot;&gt;
    A simple primary alert with &lt;a href=&quot;#&quot; class=&quot;alert-link&quot;&gt;an example link&lt;/a&gt;. Give it a click if you like.
&lt;/div&gt;
&lt;div class=&quot;alert alert-secondary&quot; role=&quot;alert&quot;&gt;
    A simple secondary alert with &lt;a href=&quot;#&quot; class=&quot;alert-link&quot;&gt;an example link&lt;/a&gt;. Give it a click if you like.
&lt;/div&gt;
&lt;div class=&quot;alert alert-success&quot; role=&quot;alert&quot;&gt;
    A simple success alert with &lt;a href=&quot;#&quot; class=&quot;alert-link&quot;&gt;an example link&lt;/a&gt;. Give it a click if you like.
&lt;/div&gt;
&lt;div class=&quot;alert alert-danger&quot; role=&quot;alert&quot;&gt;
    A simple danger alert with &lt;a href=&quot;#&quot; class=&quot;alert-link&quot;&gt;an example link&lt;/a&gt;. Give it a click if you like.
&lt;/div&gt;
&lt;div class=&quot;alert alert-warning&quot; role=&quot;alert&quot;&gt;
    A simple warning alert with &lt;a href=&quot;#&quot; class=&quot;alert-link&quot;&gt;an example link&lt;/a&gt;. Give it a click if you like.
&lt;/div&gt;
&lt;div class=&quot;alert alert-info&quot; role=&quot;alert&quot;&gt;
    A simple info alert with &lt;a href=&quot;#&quot; class=&quot;alert-link&quot;&gt;an example link&lt;/a&gt;. Give it a click if you like.
&lt;/div&gt;
&lt;div class=&quot;alert alert-light&quot; role=&quot;alert&quot;&gt;
    A simple light alert with &lt;a href=&quot;#&quot; class=&quot;alert-link&quot;&gt;an example link&lt;/a&gt;. Give it a click if you like.
&lt;/div&gt;
&lt;div class=&quot;alert alert-dark&quot; role=&quot;alert&quot;&gt;
    A simple dark alert with &lt;a href=&quot;#&quot; class=&quot;alert-link&quot;&gt;an example link&lt;/a&gt;. Give it a click if you like.
&lt;/div&gt;</code>
</pre>
                        </div> <!-- example end  -->


                        <h3 id="additional-content">Additional content</h3>
                        <p>Alerts can also contain additional HTML elements like headings, paragraphs and dividers.</p>
                        <div class="bd-example mb-5">

                            <div class="alert alert-success" role="alert">
                                <h4 class="alert-heading">Well done!</h4>
                                <p>Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.</p>
                                <hr>
                                <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p>
                            </div>
<pre>
<code class="language-html" data-lang="html">&lt;div class=&quot;alert alert-success&quot; role=&quot;alert&quot;&gt;
    &lt;h4 class=&quot;alert-heading&quot;&gt;Well done!&lt;/h4&gt;
    &lt;p&gt;Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.&lt;/p&gt;
    &lt;hr&gt;
    &lt;p class=&quot;mb-0&quot;&gt;Whenever you need to, be sure to use margin utilities to keep things nice and tidy.&lt;/p&gt;
&lt;/div&gt;</code>
</pre>
                        </div> <!-- example end  -->
                        
                        
                        <h3 id="dismissing">Dismissing</h3>
                        <p>Using the alert JavaScript plugin, it’s possible to dismiss any alert inline. Here’s how:</p>
                        <ul>
                            <li>Be sure you’ve loaded the alert plugin, or the compiled Bootstrap JavaScript.</li>
                            <li>Add a <a href="/docs/5.0/components/close-button/">close button</a> and the <code>.alert-dismissible</code> class, which adds extra padding to the right of the alert and positions the close button.</li>
                            <li>On the close button, add the <code>data-bs-dismiss="alert"</code> attribute, which triggers the JavaScript functionality. Be sure to use the <code>&lt;button&gt;</code> element with it for proper behavior across all devices.</li>
                            <li>To animate alerts when dismissing them, be sure to add the <code>.fade</code> and <code>.show</code> classes.</li>
                        </ul>
                        <p>You can see this in action with a live demo:</p>
                        <div class="bd-example mb-5">
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Holy guacamole!</strong> You should check in on some of those fields below.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
<pre>
<code class="language-html" data-lang="html">&lt;div class=&quot;alert alert-warning alert-dismissible fade show&quot; role=&quot;alert&quot;&gt;
    &lt;strong&gt;Holy guacamole!&lt;/strong&gt; You should check in on some of those fields below.
    &lt;button type=&quot;button&quot; class=&quot;btn-close&quot; data-bs-dismiss=&quot;alert&quot; aria-label=&quot;Close&quot;&gt;&lt;/button&gt;
&lt;/div&gt;</code>
</pre>
                        </div> <!-- example end  -->
                        
                        <div class="card p-3 mb-3">
                            When an alert is dismissed, the element is completely removed from the page structure. If a keyboard user dismisses the alert using the close button, their focus will suddenly be lost and, depending on the browser, reset to the start of the page/document. For this reason, we recommend including additional JavaScript that listens for the <code>closed.bs.alert</code> event and programmatically sets <code>focus()</code> to the most appropriate location in the page. If you’re planning to move focus to a non-interactive element that normally does not receive focus, make sure to add <code>tabindex="-1"</code> to the element.
                        </div>
                        
                        <h2 id="javascript-behavior" class="mb-5 mt-5">JavaScript behavior</h2>
                        <h3 id="triggers">Triggers</h3>
                        <p>Enable dismissal of an alert via JavaScript:</p>
                        <div class="bd-example mb-5">
<pre><code class="language-js" data-lang="js"><span class="kd">var</span> <span class="nx">alertList</span> <span class="o">=</span> <span class="nb">document</span><span class="p">.</span><span class="nx">querySelectorAll</span><span class="p">(</span><span class="s1">'.alert'</span><span class="p">)</span>
<span class="nx">alertList</span><span class="p">.</span><span class="nx">forEach</span><span class="p">(</span><span class="kd">function</span> <span class="p">(</span><span class="nx">alert</span><span class="p">)</span> <span class="p">{</span>
    <span class="k">new</span> <span class="nx">bootstrap</span><span class="p">.</span><span class="nx">Alert</span><span class="p">(</span><span class="nx">alert</span><span class="p">)</span>
<span class="p">})</span>
</code></pre>
                        </div> <!-- example end  -->
                        
                        <p>Or with <code>data</code> attributes on a button <strong>within the alert</strong>, as demonstrated above:</p>
                        <div class="bd-example mb-5">
<pre><code class="language-html" data-lang="html"><span class="p">&lt;</span><span class="nt">button</span> <span class="na">type</span><span class="o">=</span><span class="s">"button"</span> <span class="na">class</span><span class="o">=</span><span class="s">"btn-close"</span> <span class="na">data-bs-dismiss</span><span class="o">=</span><span class="s">"alert"</span> <span class="na">aria-label</span><span class="o">=</span><span class="s">"Close"</span><span class="p">&gt;&lt;/</span><span class="nt">button</span><span class="p">&gt;</span></code></pre>
                        </div> <!-- example end  -->

                        <p>Note that closing an alert will remove it from the DOM.</p>
                        <h3 id="methods">Methods</h3>
                        <p>You can create an alert instance with the alert constructor, for example:</p>                        
                        <div class="bd-example mb-5">
<pre><code class="language-js" data-lang="js"><span class="kd">var</span> <span class="nx">myAlert</span> <span class="o">=</span> <span class="nb">document</span><span class="p">.</span><span class="nx">getElementById</span><span class="p">(</span><span class="s1">'myAlert'</span><span class="p">)</span>
<span class="kd">var</span> <span class="nx">bsAlert</span> <span class="o">=</span> <span class="k">new</span> <span class="nx">bootstrap</span><span class="p">.</span><span class="nx">Alert</span><span class="p">(</span><span class="nx">myAlert</span><span class="p">)</span>
</code></pre>
                        </div> <!-- example end  -->
                        
                        <p>This makes an alert listen for click events on descendant elements which have the <code>data-bs-dismiss="alert"</code> attribute. (Not necessary when using the data-api’s auto-initialization.)</p>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Method</th>
                                    <th>Description</th>
                                </tr>
                                </thead>
                            <tbody>
                                <tr>
                                    <td>
                                    <code>close</code>
                                    </td>
                                    <td>
                                    Closes an alert by removing it from the DOM. If the <code>.fade</code> and <code>.show</code> classes are present on the element, the alert will fade out before it is removed.
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                    <code>dispose</code>
                                    </td>
                                    <td>
                                    Destroys an element's alert.
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                    <code>getInstance</code>
                                    </td>
                                    <td>
                                    Static method which allows you to get the alert instance associated to a DOM element, you can use it like this: <code>bootstrap.Alert.getInstance(alert)</code>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="bd-example mb-5">
<pre><code class="language-js" data-lang="js"><span class="kd">var</span> <span class="nx">alertNode</span> <span class="o">=</span> <span class="nb">document</span><span class="p">.</span><span class="nx">querySelector</span><span class="p">(</span><span class="s1">'.alert'</span><span class="p">)</span>
<span class="kd">var</span> <span class="nx">alert</span> <span class="o">=</span> <span class="nx">bootstrap</span><span class="p">.</span><span class="nx">Alert</span><span class="p">.</span><span class="nx">getInstance</span><span class="p">(</span><span class="nx">alertNode</span><span class="p">)</span>
<span class="nx">alert</span><span class="p">.</span><span class="nx">close</span><span class="p">()</span>
</code></pre>
                        </div> <!-- example end  -->

                        <h3 id="events">Events</h3>
                        <p>Bootstrap’s alert plugin exposes a few events for hooking into alert functionality.</p>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Event</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><code>close.bs.alert</code></td>
                                    <td>
                                    Fires immediately when the <code>close</code> instance method is called.
                                    </td>
                                </tr>
                                <tr>
                                    <td><code>closed.bs.alert</code></td>
                                    <td>
                                    Fired when the alert has been closed and CSS transitions have completed.
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="bd-example mb-5">
<pre><code class="language-js" data-lang="js"><span class="kd">var</span> <span class="nx">myAlert</span> <span class="o">=</span> <span class="nb">document</span><span class="p">.</span><span class="nx">getElementById</span><span class="p">(</span><span class="s1">'myAlert'</span><span class="p">)</span>
<span class="nx">myAlert</span><span class="p">.</span><span class="nx">addEventListener</span><span class="p">(</span><span class="s1">'closed.bs.alert'</span><span class="p">,</span> <span class="kd">function</span> <span class="p">()</span> <span class="p">{</span>
<span class="c1">// do something, for instance, explicitly move focus to the most appropriate element,
</span><span class="c1"></span>  <span class="c1">// so it doesn't get lost/reset to the start of the page
</span><span class="c1"></span>  <span class="c1">// document.getElementById('...').focus()
</span><span class="c1"></span><span class="p">})</span>
</code></pre>
                        </div> <!-- example end  -->
              
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
        <script src="{{ asset('js/template.js') }}"></script>
@endsection
