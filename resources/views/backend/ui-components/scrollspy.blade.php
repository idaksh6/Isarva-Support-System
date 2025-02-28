@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
    <!-- Body: Body -->
    <div class="body d-flex py-lg-3 py-md-2">
            <div class="container">
                <div class="col-12">
                    <div class="bd-content ps-lg-4">

                        <h2 id="how-it-works">How it works</h2>
                        <p>Scrollspy has a few requirements to function properly:</p>
                        <div class="alert alert-danger" role="alert">
                            <strong>Scrollspy</strong> for more bootstrao components <a href="https://v5.getbootstrap.com/docs/5.0/components/scrollspy/" target="_blank">Bootstrap Scrollspy documentation <i class="fa fa-external-link"></i></a>
                        </div>
                        <ul>
                            <li>It must be used on a Bootstrap <a href="https://v5.getbootstrap.com/docs/5.0/components/navs/">nav component</a> or <a href="https://v5.getbootstrap.com/docs/5.0/components/list-group/">list group</a>.</li>
                            <li>Scrollspy requires <code>position: relative;</code> on the element you’re spying on, usually the <code>&lt;body&gt;</code>.</li>
                            <li>Anchors (<code>&lt;a&gt;</code>) are required and must point to an element with that <code>id</code>.</li>
                        </ul>
                        <p>When successfully implemented, your nav or list group will update accordingly, moving the <code>.active</code> class from one item to the next based on their associated targets.</p>
                        <div class="card card-callout p-3">
                            <h3 id="scrollable-containers-and-keyboard-access">Scrollable containers and keyboard access</h3>
                            <p class="mb-0">If you’re making a scrollable container (other than the <code>&lt;body&gt;</code>), be sure to have a <code>height</code> set and <code>overflow-y: scroll;</code> applied to it—alongside a <code>tabindex="0"</code> to ensure keyboard access.</p>
                        </div>

                        <div class="border-top mt-5 pt-3">
                            <h5 id="example-in-navbar">Example in navbar</h5>
                            <p>Scroll the area below the navbar and watch the active class change. The dropdown items will be highlighted as well.</p>

                            <ul class="nav nav-tabs tab-card px-3 border-bottom-0" role="tablist">
                                <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#nav-Preview1" role="tab">Preview</a></li>
                                <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#nav-HTML1" role="tab">HTML</a></li>
                            </ul>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" id="nav-Preview1" role="tabpanel">
                                            <nav id="navbar-example1" class="navbar navbar-light bg-light px-3">
                                                <a class="navbar-brand" href="#">Navbar</a>
                                                <ul class="nav nav-pills">
                                                    <li class="nav-item"><a class="nav-link" href="#fat">@fat</a></li>
                                                    <li class="nav-item"><a class="nav-link" href="#mdo">@mdo</a></li>
                                                    <li class="nav-item dropdown">
                                                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Dropdown</a>
                                                        <ul class="dropdown-menu dropdown-menu-right border-0 shadow">
                                                            <li><a class="dropdown-item" href="#one">one</a></li>
                                                            <li><a class="dropdown-item" href="#two">two</a></li>
                                                            <li><hr class="dropdown-divider"></li>
                                                            <li><a class="dropdown-item" href="#three">three</a></li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </nav>
                                            <div class="mt-2" data-bs-spy="scroll" data-bs-target="#navbar-example1" data-bs-offset="0" tabindex="0" style="height: 200px; overflow-y: auto; position: relative;">
                                                <h5 id="fat">@fat</h5>
                                                <p>Ad leggings keytar, brunch id art party dolor labore. Pitchfork yr enim lo-fi before they sold out qui. Tumblr farm-to-table bicycle rights whatever. Anim keffiyeh carles cardigan. Velit seitan mcsweeney's photo booth 3 wolf moon irure. Cosby sweater lomo jean shorts, williamsburg hoodie minim qui you probably haven't heard of them et cardigan trust fund culpa biodiesel wes anderson aesthetic. Nihil tattooed accusamus, cred irony biodiesel keffiyeh artisan ullamco consequat.</p>
                                                <h5 id="mdo">@mdo</h5>
                                                <p>Veniam marfa mustache skateboard, adipisicing fugiat velit pitchfork beard. Freegan beard aliqua cupidatat mcsweeney's vero. Cupidatat four loko nisi, ea helvetica nulla carles. Tattooed cosby sweater food truck, mcsweeney's quis non freegan vinyl. Lo-fi wes anderson +1 sartorial. Carles non aesthetic exercitation quis gentrify. Brooklyn adipisicing craft beer vice keytar deserunt.</p>
                                                <h5 id="one">one</h5>
                                                <p>Occaecat commodo aliqua delectus. Fap craft beer deserunt skateboard ea. Lomo bicycle rights adipisicing banh mi, velit ea sunt next level locavore single-origin coffee in magna veniam. High life id vinyl, echo park consequat quis aliquip banh mi pitchfork. Vero VHS est adipisicing. Consectetur nisi DIY minim messenger bag. Cred ex in, sustainable delectus consectetur fanny pack iphone.</p>
                                                <h5 id="two">two</h5>
                                                <p>In incididunt echo park, officia deserunt mcsweeney's proident master cleanse thundercats sapiente veniam. Excepteur VHS elit, proident shoreditch +1 biodiesel laborum craft beer. Single-origin coffee wayfarers irure four loko, cupidatat terry richardson master cleanse. Assumenda you probably haven't heard of them art party fanny pack, tattooed nulla cardigan tempor ad. Proident wolf nesciunt sartorial keffiyeh eu banh mi sustainable. Elit wolf voluptate, lo-fi ea portland before they sold out four loko. Locavore enim nostrud mlkshk brooklyn nesciunt.</p>
                                                <h5 id="three">three</h5>
                                                <p>Ad leggings keytar, brunch id art party dolor labore. Pitchfork yr enim lo-fi before they sold out qui. Tumblr farm-to-table bicycle rights whatever. Anim keffiyeh carles cardigan. Velit seitan mcsweeney's photo booth 3 wolf moon irure. Cosby sweater lomo jean shorts, williamsburg hoodie minim qui you probably haven't heard of them et cardigan trust fund culpa biodiesel wes anderson aesthetic. Nihil tattooed accusamus, cred irony biodiesel keffiyeh artisan ullamco consequat.</p>
                                                <p>Keytar twee blog, culpa messenger bag marfa whatever delectus food truck. Sapiente synth id assumenda. Locavore sed helvetica cliche irony, thundercats you probably haven't heard of them consequat hoodie gluten-free lo-fi fap aliquip. Labore elit placeat before they sold out, terry richardson proident brunch nesciunt quis cosby sweater pariatur keffiyeh ut helvetica artisan. Cardigan craft beer seitan readymade velit. VHS chambray laboris tempor veniam. Anim mollit minim commodo ullamco thundercats.</p>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="nav-HTML1" role="tabpanel">
<pre class="language-html m-0" data-lang="html">
<code>&lt;nav id=&quot;navbar-example1&quot; class=&quot;navbar navbar-light bg-light px-3&quot;&gt;
    &lt;a class=&quot;navbar-brand&quot; href=&quot;#&quot;&gt;Navbar&lt;/a&gt;
    &lt;ul class=&quot;nav nav-pills&quot;&gt;
        &lt;li class=&quot;nav-item&quot;&gt;&lt;a class=&quot;nav-link&quot; href=&quot;#fat&quot;&gt;@fat&lt;/a&gt;&lt;/li&gt;
        &lt;li class=&quot;nav-item&quot;&gt;&lt;a class=&quot;nav-link&quot; href=&quot;#mdo&quot;&gt;@mdo&lt;/a&gt;&lt;/li&gt;
        &lt;li class=&quot;nav-item dropdown&quot;&gt;
            &lt;a class=&quot;nav-link dropdown-toggle&quot; data-bs-toggle=&quot;dropdown&quot; href=&quot;#&quot; role=&quot;button&quot; aria-expanded=&quot;false&quot;&gt;Dropdown&lt;/a&gt;
            &lt;ul class=&quot;dropdown-menu dropdown-menu-right&quot;&gt;
                &lt;li&gt;&lt;a class=&quot;dropdown-item&quot; href=&quot;#one&quot;&gt;one&lt;/a&gt;&lt;/li&gt;
                &lt;li&gt;&lt;a class=&quot;dropdown-item&quot; href=&quot;#two&quot;&gt;two&lt;/a&gt;&lt;/li&gt;
                &lt;li&gt;&lt;hr class=&quot;dropdown-divider&quot;&gt;&lt;/li&gt;
                &lt;li&gt;&lt;a class=&quot;dropdown-item&quot; href=&quot;#three&quot;&gt;three&lt;/a&gt;&lt;/li&gt;
            &lt;/ul&gt;
        &lt;/li&gt;
    &lt;/ul&gt;
&lt;/nav&gt;
&lt;div class=&quot;border p-3&quot; data-bs-spy=&quot;scroll&quot; data-bs-target=&quot;#navbar-example1&quot; data-bs-offset=&quot;0&quot; tabindex=&quot;0&quot;&gt;
    &lt;h5 id=&quot;fat&quot;&gt;@fat&lt;/h5&gt;
    &lt;p&gt;...&lt;/p&gt;
    &lt;h5 id=&quot;mdo&quot;&gt;@mdo&lt;/h5&gt;
    &lt;p&gt;...&lt;/p&gt;
    &lt;h5 id=&quot;one&quot;&gt;one&lt;/h5&gt;
    &lt;p&gt;...&lt;/p&gt;
    &lt;h5 id=&quot;two&quot;&gt;two&lt;/h5&gt;
    &lt;p&gt;...&lt;/p&gt;
    &lt;h5 id=&quot;three&quot;&gt;three&lt;/h5&gt;
    &lt;p&gt;...&lt;/p&gt;
    &lt;p&gt;...&lt;/p&gt;
&lt;/div&gt;</code>
</pre>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="border-top mt-5 pt-3">
                            <h5 id="example-in-navbar">Example in navbar</h5>
                            <p>Scroll the area below the navbar and watch the active class change. The dropdown items will be highlighted as well.</p>

                            <ul class="nav nav-tabs tab-card px-3 border-bottom-0" role="tablist">
                                <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#nav-Preview2" role="tab">Preview</a></li>
                                <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#nav-HTML2" role="tab">HTML</a></li>
                            </ul>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" id="nav-Preview2" role="tabpanel">
                                            <div class="row">
                                                <div class="col-4">
                                                    <nav id="navbar-example2" class="navbar navbar-light bg-light flex-column">
                                                        <a class="navbar-brand" href="#">Navbar</a>
                                                        <nav class="nav nav-pills flex-column">
                                                            <a class="nav-link" href="#item-1">Item 1</a>
                                                            <nav class="nav nav-pills flex-column">
                                                                <a class="nav-link ms-3 my-1" href="#item-1-1">Item 1-1</a>
                                                                <a class="nav-link ms-3 my-1" href="#item-1-2">Item 1-2</a>
                                                            </nav>
                                                            <a class="nav-link" href="#item-2">Item 2</a>
                                                            <a class="nav-link" href="#item-3">Item 3</a>
                                                            <nav class="nav nav-pills flex-column">
                                                                <a class="nav-link ms-3 my-1" href="#item-3-1">Item 3-1</a>
                                                                <a class="nav-link ms-3 my-1" href="#item-3-2">Item 3-2</a>
                                                            </nav>
                                                        </nav>
                                                    </nav>
                                                </div>
                                                <div class="col-8">
                                                    <div data-bs-spy="scroll" data-bs-target="#navbar-example2" data-bs-offset="0" tabindex="0" style="height: 345px; overflow-y: auto; position: relative;">
                                                        <h4 id="item-1">Item 1</h4>
                                                        <p>Ex consequat commodo adipisicing exercitation aute excepteur occaecat ullamco duis aliqua id magna ullamco eu. Do aute ipsum ipsum ullamco cillum consectetur ut et aute consectetur labore. Fugiat laborum incididunt tempor eu consequat enim dolore proident. Qui laborum do non excepteur nulla magna eiusmod consectetur in. Aliqua et aliqua officia quis et incididunt voluptate non anim reprehenderit adipisicing dolore ut consequat deserunt mollit dolore. Aliquip nulla enim veniam non fugiat id cupidatat nulla elit cupidatat commodo velit ut eiusmod cupidatat elit dolore.</p>
                                                        <h5 id="item-1-1">Item 1-1</h5>
                                                        <p>Ex consequat commodo adipisicing exercitation aute excepteur occaecat ullamco duis aliqua id magna ullamco eu. Do aute ipsum ipsum ullamco cillum consectetur ut et aute consectetur labore. Fugiat laborum incididunt tempor eu consequat enim dolore proident. Qui laborum do non excepteur nulla magna eiusmod consectetur in. Aliqua et aliqua officia quis et incididunt voluptate non anim reprehenderit adipisicing dolore ut consequat deserunt mollit dolore. Aliquip nulla enim veniam non fugiat id cupidatat nulla elit cupidatat commodo velit ut eiusmod cupidatat elit dolore.</p>
                                                        <h5 id="item-1-2">Item 1-2</h5>
                                                        <p>Ex consequat commodo adipisicing exercitation aute excepteur occaecat ullamco duis aliqua id magna ullamco eu. Do aute ipsum ipsum ullamco cillum consectetur ut et aute consectetur labore. Fugiat laborum incididunt tempor eu consequat enim dolore proident. Qui laborum do non excepteur nulla magna eiusmod consectetur in. Aliqua et aliqua officia quis et incididunt voluptate non anim reprehenderit adipisicing dolore ut consequat deserunt mollit dolore. Aliquip nulla enim veniam non fugiat id cupidatat nulla elit cupidatat commodo velit ut eiusmod cupidatat elit dolore.</p>
                                                        <h4 id="item-2">Item 2</h4>
                                                        <p>Ex consequat commodo adipisicing exercitation aute excepteur occaecat ullamco duis aliqua id magna ullamco eu. Do aute ipsum ipsum ullamco cillum consectetur ut et aute consectetur labore. Fugiat laborum incididunt tempor eu consequat enim dolore proident. Qui laborum do non excepteur nulla magna eiusmod consectetur in. Aliqua et aliqua officia quis et incididunt voluptate non anim reprehenderit adipisicing dolore ut consequat deserunt mollit dolore. Aliquip nulla enim veniam non fugiat id cupidatat nulla elit cupidatat commodo velit ut eiusmod cupidatat elit dolore.</p>
                                                        <h4 id="item-3">Item 3</h4>
                                                        <p>Ex consequat commodo adipisicing exercitation aute excepteur occaecat ullamco duis aliqua id magna ullamco eu. Do aute ipsum ipsum ullamco cillum consectetur ut et aute consectetur labore. Fugiat laborum incididunt tempor eu consequat enim dolore proident. Qui laborum do non excepteur nulla magna eiusmod consectetur in. Aliqua et aliqua officia quis et incididunt voluptate non anim reprehenderit adipisicing dolore ut consequat deserunt mollit dolore. Aliquip nulla enim veniam non fugiat id cupidatat nulla elit cupidatat commodo velit ut eiusmod cupidatat elit dolore.</p>
                                                        <h5 id="item-3-1">Item 3-1</h5>
                                                        <p>Ex consequat commodo adipisicing exercitation aute excepteur occaecat ullamco duis aliqua id magna ullamco eu. Do aute ipsum ipsum ullamco cillum consectetur ut et aute consectetur labore. Fugiat laborum incididunt tempor eu consequat enim dolore proident. Qui laborum do non excepteur nulla magna eiusmod consectetur in. Aliqua et aliqua officia quis et incididunt voluptate non anim reprehenderit adipisicing dolore ut consequat deserunt mollit dolore. Aliquip nulla enim veniam non fugiat id cupidatat nulla elit cupidatat commodo velit ut eiusmod cupidatat elit dolore.</p>
                                                        <h5 id="item-3-2">Item 3-2</h5>
                                                        <p>Ex consequat commodo adipisicing exercitation aute excepteur occaecat ullamco duis aliqua id magna ullamco eu. Do aute ipsum ipsum ullamco cillum consectetur ut et aute consectetur labore. Fugiat laborum incididunt tempor eu consequat enim dolore proident. Qui laborum do non excepteur nulla magna eiusmod consectetur in. Aliqua et aliqua officia quis et incididunt voluptate non anim reprehenderit adipisicing dolore ut consequat deserunt mollit dolore. Aliquip nulla enim veniam non fugiat id cupidatat nulla elit cupidatat commodo velit ut eiusmod cupidatat elit dolore.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="nav-HTML2" role="tabpanel">
<pre class="language-html m-0" data-lang="html">
<code>&lt;div class=&quot;row&quot;&gt;
    &lt;div class=&quot;col-4&quot;&gt;
        &lt;nav id=&quot;navbar-example2&quot; class=&quot;navbar navbar-light bg-light flex-column&quot;&gt;
            &lt;a class=&quot;navbar-brand&quot; href=&quot;#&quot;&gt;Navbar&lt;/a&gt;
            &lt;nav class=&quot;nav nav-pills flex-column&quot;&gt;
                &lt;a class=&quot;nav-link&quot; href=&quot;#item-1&quot;&gt;Item 1&lt;/a&gt;
                &lt;nav class=&quot;nav nav-pills flex-column&quot;&gt;
                    &lt;a class=&quot;nav-link ms-3 my-1&quot; href=&quot;#item-1-1&quot;&gt;Item 1-1&lt;/a&gt;
                    &lt;a class=&quot;nav-link ms-3 my-1&quot; href=&quot;#item-1-2&quot;&gt;Item 1-2&lt;/a&gt;
                &lt;/nav&gt;
                &lt;a class=&quot;nav-link&quot; href=&quot;#item-2&quot;&gt;Item 2&lt;/a&gt;
                &lt;a class=&quot;nav-link&quot; href=&quot;#item-3&quot;&gt;Item 3&lt;/a&gt;
                &lt;nav class=&quot;nav nav-pills flex-column&quot;&gt;
                    &lt;a class=&quot;nav-link ms-3 my-1&quot; href=&quot;#item-3-1&quot;&gt;Item 3-1&lt;/a&gt;
                    &lt;a class=&quot;nav-link ms-3 my-1&quot; href=&quot;#item-3-2&quot;&gt;Item 3-2&lt;/a&gt;
                &lt;/nav&gt;
            &lt;/nav&gt;
        &lt;/nav&gt;
    &lt;/div&gt;
    &lt;div class=&quot;col-8&quot;&gt;
        &lt;div data-bs-spy=&quot;scroll&quot; data-bs-target=&quot;#navbar-example2&quot; data-bs-offset=&quot;0&quot; tabindex=&quot;0&quot; style=&quot;height: 345px; overflow-y: auto; position: relative;&quot;&gt;
            &lt;h4 id=&quot;item-1&quot;&gt;Item 1&lt;/h4&gt;
            &lt;p&gt;...&lt;/p&gt;
            &lt;h5 id=&quot;item-1-1&quot;&gt;Item 1-1&lt;/h5&gt;
            &lt;p&gt;...&lt;/p&gt;
            &lt;h5 id=&quot;item-1-2&quot;&gt;Item 1-2&lt;/h5&gt;
            &lt;p&gt;...&lt;/p&gt;
            &lt;h4 id=&quot;item-2&quot;&gt;Item 2&lt;/h4&gt;
            &lt;p&gt;...&lt;/p&gt;
            &lt;h4 id=&quot;item-3&quot;&gt;Item 3&lt;/h4&gt;
            &lt;p&gt;...&lt;/p&gt;
            &lt;h5 id=&quot;item-3-1&quot;&gt;Item 3-1&lt;/h5&gt;
            &lt;p&gt;....&lt;/p&gt;
            &lt;h5 id=&quot;item-3-2&quot;&gt;Item 3-2&lt;/h5&gt;
            &lt;p&gt;....&lt;/p&gt;
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
        <script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
    <script src="{{ asset('js/template.js') }}"></script>
@endsection
