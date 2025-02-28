@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
    <!-- Body: Body -->
    <div class="body d-flex py-lg-3 py-md-2">
            <div class="container">
                <div class="col-12">
                    <div class="bd-content">

                        <h1>List group</h1>
                        <p>List groups are a flexible and powerful component for displaying a series of content. Modify and extend them to support just about any content within.</p>
                        <div class="alert alert-danger" role="alert">
                            <strong>List group</strong> for more bootstrao components <a href="https://v5.getbootstrap.com/docs/5.0/components/list-group/" target="_blank">Bootstrap List group documentation <i class="fa fa-external-link"></i></a>
                        </div>

                        <div class="border-top mt-5 pt-3">
                            <h4 id="basic-example">Basic example</h4>
                            <p>The most basic list group is an unordered list with list items and the proper classes. Build upon it with the options that follow, or with your own CSS as needed.</p>
                            <ul class="nav nav-tabs tab-card px-3 border-bottom-0" role="tablist">
                                <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#nav-Preview1" role="tab">Preview</a></li>
                                <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#nav-HTML1" role="tab">HTML</a></li>
                            </ul>
                            <div class="card mb-3 bg-transparent">
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" id="nav-Preview1" role="tabpanel">
                                            <div class="row">
                                                <div class="col-lg-3 col-md-6">
                                                    <!-- List Group: normal  -->
                                                    <ul class="list-group list-group-custom">
                                                        <li class="list-group-item">Cras justo odio</li>
                                                        <li class="list-group-item">Dapibus ac facilisis in</li>
                                                        <li class="list-group-item">Morbi leo risus</li>
                                                        <li class="list-group-item">Porta ac consectetur ac</li>
                                                        <li class="list-group-item">Vestibulum at eros</li>
                                                    </ul>
                                                </div>
                                                <div class="col-lg-3 col-md-6">
                                                    <!-- List Group: with badge left side -->
                                                    <ul class="list-group list-group-custom">
                                                        <li class="list-group-item">
                                                            <span class="badge bg-primary me-2">14</span>
                                                            Cras justo odio
                                                        </li>
                                                        <li class="list-group-item">
                                                            <span class="badge bg-danger me-2">2</span>
                                                            Dapibus ac facilisis in
                                                        </li>
                                                        <li class="list-group-item">
                                                            <span class="badge bg-info me-2">1</span>
                                                            Morbi leo risus
                                                        </li>
                                                        <li class="list-group-item">
                                                            <span class="badge bg-warning me-2">2</span>
                                                            Dapibus ac facilisis in
                                                        </li>
                                                        <li class="list-group-item">
                                                            <span class="badge bg-secondary me-2">1</span>
                                                            Morbi leo risus
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-lg-3 col-md-6">
                                                    <!-- List Group: with badge pill right side -->
                                                    <ul class="list-group list-group-custom">
                                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                                            Cras justo odio
                                                            <span class="badge bg-primary rounded-pill">14</span>
                                                        </li>
                                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                                            Dapibus ac facilisis in
                                                            <span class="badge bg-danger rounded-pill">2</span>
                                                        </li>
                                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                                            Morbi leo risus
                                                            <span class="badge bg-info rounded-pill">1</span>
                                                        </li>
                                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                                            Dapibus ac facilisis in
                                                            <span class="badge bg-warning rounded-pill">2</span>
                                                        </li>
                                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                                            Morbi leo risus
                                                            <span class="badge bg-secondary rounded-pill">1</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-lg-3 col-md-6">
                                                    <!-- List Group: with checkbox -->
                                                    <ul class="list-group">
                                                        <li class="list-group-item">
                                                            <input class="form-check-input me-1" type="checkbox" value="" aria-label="...">
                                                            Cras justo odio
                                                        </li>
                                                        <li class="list-group-item">
                                                            <input class="form-check-input me-1" type="checkbox" value="" aria-label="...">
                                                            Dapibus ac facilisis in
                                                        </li>
                                                        <li class="list-group-item">
                                                            <input class="form-check-input me-1" type="checkbox" value="" aria-label="...">
                                                            Morbi leo risus
                                                        </li>
                                                        <li class="list-group-item">
                                                            <input class="form-check-input me-1" type="checkbox" value="" aria-label="...">
                                                            Porta ac consectetur ac
                                                        </li>
                                                        <li class="list-group-item">
                                                            <input class="form-check-input me-1" type="checkbox" value="" aria-label="...">
                                                            Vestibulum at eros
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="nav-HTML1" role="tabpanel">
<pre class="language-html" data-lang="html">
<code>&lt;!-- List Group: normal  --&gt;
&lt;ul class=&quot;list-group list-group-custom&quot;&gt;
    &lt;li class=&quot;list-group-item&quot;&gt;Cras justo odio&lt;/li&gt;
    &lt;li class=&quot;list-group-item&quot;&gt;Dapibus ac facilisis in&lt;/li&gt;
    &lt;li class=&quot;list-group-item&quot;&gt;Morbi leo risus&lt;/li&gt;
    &lt;li class=&quot;list-group-item&quot;&gt;Porta ac consectetur ac&lt;/li&gt;
    &lt;li class=&quot;list-group-item&quot;&gt;Vestibulum at eros&lt;/li&gt;
&lt;/ul&gt;

&lt;!-- List Group: with badge left side --&gt;
&lt;ul class=&quot;list-group list-group-custom&quot;&gt;
    &lt;li class=&quot;list-group-item&quot;&gt;
        &lt;span class=&quot;badge bg-primary me-2&quot;&gt;14&lt;/span&gt;
        Cras justo odio
    &lt;/li&gt;
    &lt;li class=&quot;list-group-item&quot;&gt;
        &lt;span class=&quot;badge bg-danger me-2&quot;&gt;2&lt;/span&gt;
        Dapibus ac facilisis in
    &lt;/li&gt;
    &lt;li class=&quot;list-group-item&quot;&gt;
        &lt;span class=&quot;badge bg-info me-2&quot;&gt;1&lt;/span&gt;
        Morbi leo risus
    &lt;/li&gt;
    &lt;li class=&quot;list-group-item&quot;&gt;
        &lt;span class=&quot;badge bg-warning me-2&quot;&gt;2&lt;/span&gt;
        Dapibus ac facilisis in
    &lt;/li&gt;
    &lt;li class=&quot;list-group-item&quot;&gt;
        &lt;span class=&quot;badge bg-secondary me-2&quot;&gt;1&lt;/span&gt;
        Morbi leo risus
    &lt;/li&gt;
&lt;/ul&gt;

&lt;!-- List Group: with badge pill right side --&gt;
&lt;ul class=&quot;list-group list-group-custom&quot;&gt;
    &lt;li class=&quot;list-group-item d-flex justify-content-between align-items-center&quot;&gt;
        Cras justo odio
        &lt;span class=&quot;badge bg-primary rounded-pill&quot;&gt;14&lt;/span&gt;
    &lt;/li&gt;
    &lt;li class=&quot;list-group-item d-flex justify-content-between align-items-center&quot;&gt;
        Dapibus ac facilisis in
        &lt;span class=&quot;badge bg-danger rounded-pill&quot;&gt;2&lt;/span&gt;
    &lt;/li&gt;
    &lt;li class=&quot;list-group-item d-flex justify-content-between align-items-center&quot;&gt;
        Morbi leo risus
        &lt;span class=&quot;badge bg-info rounded-pill&quot;&gt;1&lt;/span&gt;
    &lt;/li&gt;
    &lt;li class=&quot;list-group-item d-flex justify-content-between align-items-center&quot;&gt;
        Dapibus ac facilisis in
        &lt;span class=&quot;badge bg-warning rounded-pill&quot;&gt;2&lt;/span&gt;
    &lt;/li&gt;
    &lt;li class=&quot;list-group-item d-flex justify-content-between align-items-center&quot;&gt;
        Morbi leo risus
        &lt;span class=&quot;badge bg-secondary rounded-pill&quot;&gt;1&lt;/span&gt;
    &lt;/li&gt;
&lt;/ul&gt;

&lt;!-- List Group: with checkbox --&gt;
&lt;ul class=&quot;list-group&quot;&gt;
    &lt;li class=&quot;list-group-item&quot;&gt;
        &lt;input class=&quot;form-check-input me-1&quot; type=&quot;checkbox&quot; value=&quot;&quot; aria-label=&quot;...&quot;&gt;
        Cras justo odio
    &lt;/li&gt;
    &lt;li class=&quot;list-group-item&quot;&gt;
        &lt;input class=&quot;form-check-input me-1&quot; type=&quot;checkbox&quot; value=&quot;&quot; aria-label=&quot;...&quot;&gt;
        Dapibus ac facilisis in
    &lt;/li&gt;
    &lt;li class=&quot;list-group-item&quot;&gt;
        &lt;input class=&quot;form-check-input me-1&quot; type=&quot;checkbox&quot; value=&quot;&quot; aria-label=&quot;...&quot;&gt;
        Morbi leo risus
    &lt;/li&gt;
    &lt;li class=&quot;list-group-item&quot;&gt;
        &lt;input class=&quot;form-check-input me-1&quot; type=&quot;checkbox&quot; value=&quot;&quot; aria-label=&quot;...&quot;&gt;
        Porta ac consectetur ac
    &lt;/li&gt;
    &lt;li class=&quot;list-group-item&quot;&gt;
        &lt;input class=&quot;form-check-input me-1&quot; type=&quot;checkbox&quot; value=&quot;&quot; aria-label=&quot;...&quot;&gt;
        Vestibulum at eros
    &lt;/li&gt;
&lt;/ul&gt;</code>
</pre>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <ul class="nav nav-tabs tab-card px-3 border-bottom-0" role="tablist">
                                <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#nav-Preview1b" role="tab">Preview</a></li>
                                <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#nav-HTML1b" role="tab">HTML</a></li>
                            </ul>
                            <div class="card mb-3 bg-transparent">
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" id="nav-Preview1b" role="tabpanel">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-12">
                                                    <!-- List Group: User list  -->
                                                    <ul class="list-unstyled list-group list-group-custom list-group-flush mb-0">
                                                        <li class="list-group-item px-md-4 py-3">
                                                            <a href="javascript:void(0);" class="d-flex">
                                                                <img class="avatar rounded-circle" src="../assets/images/xs/avatar1.jpg" alt="">
                                                                <div class="flex-fill ms-3 text-truncate">
                                                                    <h6 class="d-flex justify-content-between mb-0"><span>Chris Fox</span></h6>
                                                                    <span class="text-muted">ChrisFox@alui.com</span>
                                                                </div>
                                                            </a>
                                                        </li>
                                                        <li class="list-group-item px-md-4 py-3">
                                                            <a href="javascript:void(0);" class="d-flex">
                                                                <div class="avatar rounded-circle no-thumbnail">RH</div>
                                                                <div class="flex-fill ms-3 text-truncate">
                                                                    <h6 class="d-flex justify-content-between mb-0"><span>Robert Hammer</span></h6>
                                                                    <span class="text-muted">RobertHammer@alui.com</span>
                                                                </div>
                                                            </a>
                                                        </li>
                                                        <li class="list-group-item px-md-4 py-3">
                                                            <a href="javascript:void(0);" class="d-flex">
                                                                <img class="avatar rounded-circle" src="../assets/images/xs/avatar3.jpg" alt="">
                                                                <div class="flex-fill ms-3 text-truncate">
                                                                    <h6 class="d-flex justify-content-between mb-0"><span>Orlando Lentz</span></h6>
                                                                    <span class="text-muted">RobertHammer@alui.com</span>
                                                                </div>
                                                            </a>
                                                        </li>
                                                        <li class="list-group-item px-md-4 py-3">
                                                            <a href="javascript:void(0);" class="d-flex">
                                                                <img class="avatar rounded-circle" src="../assets/images/xs/avatar4.jpg" alt="">
                                                                <div class="flex-fill ms-3 text-truncate">
                                                                    <h6 class="d-flex justify-content-between mb-0"><span>Barbara Kelly</span></h6>
                                                                    <span class="text-muted">RobertHammer@alui.com</span>
                                                                </div>
                                                            </a>
                                                        </li>
                                                        <li class="list-group-item px-md-4 py-3">
                                                            <a href="javascript:void(0);" class="d-flex">
                                                                <img class="avatar rounded-circle" src="../assets/images/xs/avatar5.jpg" alt="">
                                                                <div class="flex-fill ms-3 text-truncate">
                                                                    <h6 class="d-flex justify-content-between mb-0"><span>Robert Hammer</span></h6>
                                                                    <span class="text-muted">RobertHammer@alui.com</span>
                                                                </div>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-lg-4 col-md-12">
                                                    <!-- List Group: Notification -->
                                                    <ul class="list-unstyled list-group list-group-custom list-group-flush mb-0">
                                                        <li class="list-group-item d-flex py-3">
                                                            <div class="avatar"><i class="fa fa-thumbs-o-up fa-lg"></i></div>
                                                            <div class="flex-grow-1">
                                                                <h6 class="mb-0">7 New Feedback <small class="float-right text-muted">Today</small></h6>
                                                                <small>It will give a smart finishing to your site</small>
                                                            </div>
                                                        </li>
                                                        <li class="list-group-item d-flex py-3">
                                                            <div class="avatar"><i class="fa fa-user fa-lg"></i></div>
                                                            <div class="flex-grow-1">
                                                                <h6 class="mb-0">New User <small class="float-right text-muted">10:45</small></h6>
                                                                <small>I feel great! Thanks team</small>
                                                            </div>
                                                        </li>
                                                        <li class="list-group-item d-flex py-3">
                                                            <div class="avatar"><i class="fa fa-question-circle fa-lg"></i></div>
                                                            <div class="flex-grow-1">
                                                                <h6 class="mb-0 text-warning">Server Warning <small class="float-right text-muted">10:50</small></h6>
                                                                <small>Your connection is not private</small>
                                                            </div>
                                                        </li>
                                                        <li class="list-group-item d-flex py-3">
                                                            <div class="avatar"><i class="fa fa-check fa-lg"></i></div>
                                                            <div class="flex-grow-1">
                                                                <h6 class="mb-0 text-danger">Issue Fixed <small class="float-right text-muted">11:05</small></h6>
                                                                <small>WE have fix all Design bug with Responsive</small>
                                                            </div>
                                                        </li>
                                                        <li class="list-group-item d-flex py-3">
                                                            <div class="avatar"><i class="fa fa-shopping-basket fa-lg"></i></div>
                                                            <div class="flex-grow-1">
                                                                <h6 class="mb-0">7 New Orders <small class="float-right text-muted">11:35</small></h6>
                                                                <small>You received a new oder from Tina.</small>
                                                            </div>
                                                        </li>                                   
                                                    </ul>
                                                </div>
                                                <div class="col-lg-4 col-md-12">
                                                    <!-- List Group: iOT list with switch -->
                                                    <ul class="list-unstyled list-group list-group-custom list-group-flush mb-0">
                                                        <li class="list-group-item d-flex align-items-center py-3">
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" id="list-group1">
                                                                <label class="form-check-label" for="list-group1">Front Door</label>
                                                            </div>
                                                        </li>
                                                        <li class="list-group-item d-flex align-items-center py-3">
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" id="list-group2" checked="">
                                                                <label class="form-check-label" for="list-group2">Air Conditioner</label>
                                                            </div>
                                                        </li>
                                                        <li class="list-group-item d-flex align-items-center py-3">
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" id="list-group3">
                                                                <label class="form-check-label" for="list-group3">Enable RTL Mode!</label>
                                                            </div>
                                                        </li>
                                                        <li class="list-group-item d-flex align-items-center py-3">
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" id="list-group4">
                                                                <label class="form-check-label" for="list-group4">Front Door</label>
                                                            </div>
                                                        </li>
                                                        <li class="list-group-item d-flex align-items-center py-3">
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" id="list-group5">
                                                                <label class="form-check-label" for="list-group5">Air Conditioner</label>
                                                            </div>
                                                        </li>
                                                        <li class="list-group-item d-flex align-items-center py-3">
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" id="list-group6" checked="">
                                                                <label class="form-check-label" for="list-group6">Washing Machine</label>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="nav-HTML1b" role="tabpanel">
<pre class="language-html" data-lang="html">
<code>&lt;!-- List Group: User list  --&gt;
&lt;ul class=&quot;list-unstyled list-group list-group-custom list-group-flush mb-0&quot;&gt;
    &lt;li class=&quot;list-group-item px-md-4 py-3&quot;&gt;
        &lt;a href=&quot;javascript:void(0);&quot; class=&quot;d-flex&quot;&gt;
            &lt;img class=&quot;avatar rounded-circle&quot; src=&quot;../assets/images/xs/avatar1.jpg&quot; alt=&quot;&quot;&gt;
            &lt;div class=&quot;flex-fill ms-3 text-truncate&quot;&gt;
                &lt;h6 class=&quot;d-flex justify-content-between mb-0&quot;&gt;&lt;span&gt;Chris Fox&lt;/span&gt;&lt;/h6&gt;
                &lt;span class=&quot;text-muted&quot;&gt;ChrisFox@alui.com&lt;/span&gt;
            &lt;/div&gt;
        &lt;/a&gt;
    &lt;/li&gt;
    &lt;li class=&quot;list-group-item px-md-4 py-3&quot;&gt;
        &lt;a href=&quot;javascript:void(0);&quot; class=&quot;d-flex&quot;&gt;
            &lt;div class=&quot;avatar rounded-circle no-thumbnail&quot;&gt;RH&lt;/div&gt;
            &lt;div class=&quot;flex-fill ms-3 text-truncate&quot;&gt;
                &lt;h6 class=&quot;d-flex justify-content-between mb-0&quot;&gt;&lt;span&gt;Robert Hammer&lt;/span&gt;&lt;/h6&gt;
                &lt;span class=&quot;text-muted&quot;&gt;RobertHammer@alui.com&lt;/span&gt;
            &lt;/div&gt;
        &lt;/a&gt;
    &lt;/li&gt;
    &lt;li class=&quot;list-group-item px-md-4 py-3&quot;&gt;
        &lt;a href=&quot;javascript:void(0);&quot; class=&quot;d-flex&quot;&gt;
            &lt;img class=&quot;avatar rounded-circle&quot; src=&quot;../assets/images/xs/avatar3.jpg&quot; alt=&quot;&quot;&gt;
            &lt;div class=&quot;flex-fill ms-3 text-truncate&quot;&gt;
                &lt;h6 class=&quot;d-flex justify-content-between mb-0&quot;&gt;&lt;span&gt;Orlando Lentz&lt;/span&gt;&lt;/h6&gt;
                &lt;span class=&quot;text-muted&quot;&gt;RobertHammer@alui.com&lt;/span&gt;
            &lt;/div&gt;
        &lt;/a&gt;
    &lt;/li&gt;
    &lt;li class=&quot;list-group-item px-md-4 py-3&quot;&gt;
        &lt;a href=&quot;javascript:void(0);&quot; class=&quot;d-flex&quot;&gt;
            &lt;img class=&quot;avatar rounded-circle&quot; src=&quot;../assets/images/xs/avatar4.jpg&quot; alt=&quot;&quot;&gt;
            &lt;div class=&quot;flex-fill ms-3 text-truncate&quot;&gt;
                &lt;h6 class=&quot;d-flex justify-content-between mb-0&quot;&gt;&lt;span&gt;Barbara Kelly&lt;/span&gt;&lt;/h6&gt;
                &lt;span class=&quot;text-muted&quot;&gt;RobertHammer@alui.com&lt;/span&gt;
            &lt;/div&gt;
        &lt;/a&gt;
    &lt;/li&gt;
    &lt;li class=&quot;list-group-item px-md-4 py-3&quot;&gt;
        &lt;a href=&quot;javascript:void(0);&quot; class=&quot;d-flex&quot;&gt;
            &lt;img class=&quot;avatar rounded-circle&quot; src=&quot;../assets/images/xs/avatar5.jpg&quot; alt=&quot;&quot;&gt;
            &lt;div class=&quot;flex-fill ms-3 text-truncate&quot;&gt;
                &lt;h6 class=&quot;d-flex justify-content-between mb-0&quot;&gt;&lt;span&gt;Robert Hammer&lt;/span&gt;&lt;/h6&gt;
                &lt;span class=&quot;text-muted&quot;&gt;RobertHammer@alui.com&lt;/span&gt;
            &lt;/div&gt;
        &lt;/a&gt;
    &lt;/li&gt;
&lt;/ul&gt;

&lt;!-- List Group: Notification --&gt;
&lt;ul class=&quot;list-unstyled list-group list-group-custom list-group-flush mb-0&quot;&gt;
    &lt;li class=&quot;list-group-item d-flex py-3&quot;&gt;
        &lt;div class=&quot;avatar&quot;&gt;&lt;i class=&quot;fa fa-thumbs-o-up fa-lg&quot;&gt;&lt;/i&gt;&lt;/div&gt;
        &lt;div class=&quot;flex-grow-1&quot;&gt;
            &lt;h6 class=&quot;mb-0&quot;&gt;7 New Feedback &lt;small class=&quot;float-right text-muted&quot;&gt;Today&lt;/small&gt;&lt;/h6&gt;
            &lt;small&gt;It will give a smart finishing to your site&lt;/small&gt;
        &lt;/div&gt;
    &lt;/li&gt;
    &lt;li class=&quot;list-group-item d-flex py-3&quot;&gt;
        &lt;div class=&quot;avatar&quot;&gt;&lt;i class=&quot;fa fa-user fa-lg&quot;&gt;&lt;/i&gt;&lt;/div&gt;
        &lt;div class=&quot;flex-grow-1&quot;&gt;
            &lt;h6 class=&quot;mb-0&quot;&gt;New User &lt;small class=&quot;float-right text-muted&quot;&gt;10:45&lt;/small&gt;&lt;/h6&gt;
            &lt;small&gt;I feel great! Thanks team&lt;/small&gt;
        &lt;/div&gt;
    &lt;/li&gt;
    &lt;li class=&quot;list-group-item d-flex py-3&quot;&gt;
        &lt;div class=&quot;avatar&quot;&gt;&lt;i class=&quot;fa fa-question-circle fa-lg&quot;&gt;&lt;/i&gt;&lt;/div&gt;
        &lt;div class=&quot;flex-grow-1&quot;&gt;
            &lt;h6 class=&quot;mb-0 text-warning&quot;&gt;Server Warning &lt;small class=&quot;float-right text-muted&quot;&gt;10:50&lt;/small&gt;&lt;/h6&gt;
            &lt;small&gt;Your connection is not private&lt;/small&gt;
        &lt;/div&gt;
    &lt;/li&gt;
    &lt;li class=&quot;list-group-item d-flex py-3&quot;&gt;
        &lt;div class=&quot;avatar&quot;&gt;&lt;i class=&quot;fa fa-check fa-lg&quot;&gt;&lt;/i&gt;&lt;/div&gt;
        &lt;div class=&quot;flex-grow-1&quot;&gt;
            &lt;h6 class=&quot;mb-0 text-danger&quot;&gt;Issue Fixed &lt;small class=&quot;float-right text-muted&quot;&gt;11:05&lt;/small&gt;&lt;/h6&gt;
            &lt;small&gt;WE have fix all Design bug with Responsive&lt;/small&gt;
        &lt;/div&gt;
    &lt;/li&gt;
    &lt;li class=&quot;list-group-item d-flex py-3&quot;&gt;
        &lt;div class=&quot;avatar&quot;&gt;&lt;i class=&quot;fa fa-shopping-basket fa-lg&quot;&gt;&lt;/i&gt;&lt;/div&gt;
        &lt;div class=&quot;flex-grow-1&quot;&gt;
            &lt;h6 class=&quot;mb-0&quot;&gt;7 New Orders &lt;small class=&quot;float-right text-muted&quot;&gt;11:35&lt;/small&gt;&lt;/h6&gt;
            &lt;small&gt;You received a new oder from Tina.&lt;/small&gt;
        &lt;/div&gt;
    &lt;/li&gt;                                   
&lt;/ul&gt;

&lt;!-- List Group: iOT list with switch --&gt;
&lt;ul class=&quot;list-unstyled list-group list-group-custom list-group-flush mb-0&quot;&gt;
    &lt;li class=&quot;list-group-item d-flex align-items-center py-3&quot;&gt;
        &lt;div class=&quot;form-check form-switch&quot;&gt;
            &lt;input class=&quot;form-check-input&quot; type=&quot;checkbox&quot; id=&quot;list-group1&quot;&gt;
            &lt;label class=&quot;form-check-label&quot; for=&quot;list-group1&quot;&gt;Front Door&lt;/label&gt;
        &lt;/div&gt;
    &lt;/li&gt;
    &lt;li class=&quot;list-group-item d-flex align-items-center py-3&quot;&gt;
        &lt;div class=&quot;form-check form-switch&quot;&gt;
            &lt;input class=&quot;form-check-input&quot; type=&quot;checkbox&quot; id=&quot;list-group2&quot; checked=&quot;&quot;&gt;
            &lt;label class=&quot;form-check-label&quot; for=&quot;list-group2&quot;&gt;Air Conditioner&lt;/label&gt;
        &lt;/div&gt;
    &lt;/li&gt;
    &lt;li class=&quot;list-group-item d-flex align-items-center py-3&quot;&gt;
        &lt;div class=&quot;form-check form-switch&quot;&gt;
            &lt;input class=&quot;form-check-input&quot; type=&quot;checkbox&quot; id=&quot;list-group3&quot;&gt;
            &lt;label class=&quot;form-check-label&quot; for=&quot;list-group3&quot;&gt;Enable RTL Mode!&lt;/label&gt;
        &lt;/div&gt;
    &lt;/li&gt;
    &lt;li class=&quot;list-group-item d-flex align-items-center py-3&quot;&gt;
        &lt;div class=&quot;form-check form-switch&quot;&gt;
            &lt;input class=&quot;form-check-input&quot; type=&quot;checkbox&quot; id=&quot;list-group4&quot;&gt;
            &lt;label class=&quot;form-check-label&quot; for=&quot;list-group4&quot;&gt;Front Door&lt;/label&gt;
        &lt;/div&gt;
    &lt;/li&gt;
    &lt;li class=&quot;list-group-item d-flex align-items-center py-3&quot;&gt;
        &lt;div class=&quot;form-check form-switch&quot;&gt;
            &lt;input class=&quot;form-check-input&quot; type=&quot;checkbox&quot; id=&quot;list-group5&quot;&gt;
            &lt;label class=&quot;form-check-label&quot; for=&quot;list-group5&quot;&gt;Air Conditioner&lt;/label&gt;
        &lt;/div&gt;
    &lt;/li&gt;
    &lt;li class=&quot;list-group-item d-flex align-items-center py-3&quot;&gt;
        &lt;div class=&quot;form-check form-switch&quot;&gt;
            &lt;input class=&quot;form-check-input&quot; type=&quot;checkbox&quot; id=&quot;list-group6&quot; checked=&quot;&quot;&gt;
            &lt;label class=&quot;form-check-label&quot; for=&quot;list-group6&quot;&gt;Washing Machine&lt;/label&gt;
        &lt;/div&gt;
    &lt;/li&gt;
&lt;/ul&gt;</code>
</pre>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <h5 id="active-items">Active & Disabled items</h5>
                            <p class="mb-0">Add <code>.active</code> to a <code>.list-group-item</code> to indicate the current active selection.</p>
                            <p>Add <code>.disabled</code> to a <code>.list-group-item</code> to make it <em>appear</em> disabled. Note that some elements with <code>.disabled</code> will also require custom JavaScript to fully disable their click events (e.g., links).</p>
                            <ul class="nav nav-tabs tab-card px-3 border-bottom-0" role="tablist">
                                <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#nav-Preview2" role="tab">Preview</a></li>
                                <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#nav-HTML2" role="tab">HTML</a></li>
                            </ul>
                            <div class="card mb-3 bg-transparent">
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" id="nav-Preview2" role="tabpanel">
                                            <ul class="list-group list-group-custom" style="max-width: 400px;">
                                                <li class="list-group-item active" aria-current="true">Cras justo odio</li>
                                                <li class="list-group-item">Dapibus ac facilisis in</li>
                                                <li class="list-group-item">Morbi leo risus</li>
                                                <li class="list-group-item disabled">Porta ac consectetur ac</li>
                                                <li class="list-group-item">Vestibulum at eros</li>
                                            </ul>
                                        </div>
                                        <div class="tab-pane fade" id="nav-HTML2" role="tabpanel">
<pre class="language-html" data-lang="html">
<code>&lt;ul class=&quot;list-group list-group-custom&quot;&gt;
    &lt;li class=&quot;list-group-item active&quot; aria-current=&quot;true&quot;&gt;Cras justo odio&lt;/li&gt;
    &lt;li class=&quot;list-group-item&quot;&gt;Dapibus ac facilisis in&lt;/li&gt;
    &lt;li class=&quot;list-group-item&quot;&gt;Morbi leo risus&lt;/li&gt;
    &lt;li class=&quot;list-group-item disabled&quot;&gt;Porta ac consectetur ac&lt;/li&gt;
    &lt;li class=&quot;list-group-item&quot;&gt;Vestibulum at eros&lt;/li&gt;
&lt;/ul&gt;</code>
</pre>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="border-top mt-5 pt-3">
                            <h2 id="flush">Flush</h2>
                            <p>Add <code>.list-group-flush</code> to remove some borders and rounded corners to render list group items edge-to-edge in a parent container (e.g., cards).</p>
                            <ul class="nav nav-tabs tab-card px-3 border-bottom-0" role="tablist">
                                <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#nav-Preview3" role="tab">Preview</a></li>
                                <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#nav-HTML3" role="tab">HTML</a></li>
                            </ul>
                            <div class="card mb-3 bg-transparent">
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" id="nav-Preview3" role="tabpanel">
                                            <ul class="list-group list-group-flush list-group-custom" style="max-width: 400px;">
                                                <li class="list-group-item">Cras justo odio</li>
                                                <li class="list-group-item">Dapibus ac facilisis in</li>
                                                <li class="list-group-item">Morbi leo risus</li>
                                                <li class="list-group-item">Porta ac consectetur ac</li>
                                                <li class="list-group-item">Vestibulum at eros</li>
                                            </ul>
                                        </div>
                                        <div class="tab-pane fade" id="nav-HTML3" role="tabpanel">
<pre class="language-html" data-lang="html">
<code>&lt;ul class=&quot;list-group list-group-flush&quot;&gt;
    &lt;li class=&quot;list-group-item&quot;&gt;Cras justo odio&lt;/li&gt;
    &lt;li class=&quot;list-group-item&quot;&gt;Dapibus ac facilisis in&lt;/li&gt;
    &lt;li class=&quot;list-group-item&quot;&gt;Morbi leo risus&lt;/li&gt;
    &lt;li class=&quot;list-group-item&quot;&gt;Porta ac consectetur ac&lt;/li&gt;
    &lt;li class=&quot;list-group-item&quot;&gt;Vestibulum at eros&lt;/li&gt;
&lt;/ul&gt;</code>
</pre>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="border-top mt-5 pt-3">
                            <h2 id="contextual-classes">Contextual classes</h2>
                            <p>Use contextual classes to style list items with a stateful background and color.</p>
                            <p>Contextual classes also work with <code>.list-group-item-action</code>. Note the addition of the hover styles here not present in the previous example. Also supported is the <code>.active</code> state; apply it to indicate an active selection on a contextual list group item.</p>
                            <ul class="nav nav-tabs tab-card px-3 border-bottom-0" role="tablist">
                                <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#nav-Preview4" role="tab">Preview</a></li>
                                <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#nav-HTML4" role="tab">HTML</a></li>
                            </ul>
                            <div class="card mb-3 bg-transparent">
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" id="nav-Preview4" role="tabpanel">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-12">
                                                    <p>Simple list group</p>
                                                    <ul class="list-group">
                                                        <li class="list-group-item">Dapibus ac facilisis in</li>
                                                    
                                                        <li class="list-group-item list-group-item-primary">A simple primary list group item</li>
                                                        <li class="list-group-item list-group-item-secondary">A simple secondary list group item</li>
                                                        <li class="list-group-item list-group-item-success">A simple success list group item</li>
                                                        <li class="list-group-item list-group-item-danger">A simple danger list group item</li>
                                                        <li class="list-group-item list-group-item-warning">A simple warning list group item</li>
                                                        <li class="list-group-item list-group-item-info">A simple info list group item</li>
                                                        <li class="list-group-item list-group-item-light">A simple light list group item</li>
                                                        <li class="list-group-item list-group-item-dark">A simple dark list group item</li>
                                                    </ul>
                                                </div>
                                                <div class="col-lg-6 col-md-12">
                                                    <p>list gorup with Anchor Link tag</p>
                                                    <div class="list-group">
                                                        <a href="#" class="list-group-item list-group-item-action">Dapibus ac facilisis in</a>
                                                    
                                                        <a href="#" class="list-group-item list-group-item-action list-group-item-primary">A simple primary list group item</a>
                                                        <a href="#" class="list-group-item list-group-item-action list-group-item-secondary">A simple secondary list group item</a>
                                                        <a href="#" class="list-group-item list-group-item-action list-group-item-success">A simple success list group item</a>
                                                        <a href="#" class="list-group-item list-group-item-action list-group-item-danger">A simple danger list group item</a>
                                                        <a href="#" class="list-group-item list-group-item-action list-group-item-warning">A simple warning list group item</a>
                                                        <a href="#" class="list-group-item list-group-item-action list-group-item-info">A simple info list group item</a>
                                                        <a href="#" class="list-group-item list-group-item-action list-group-item-light">A simple light list group item</a>
                                                        <a href="#" class="list-group-item list-group-item-action list-group-item-dark">A simple dark list group item</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="nav-HTML4" role="tabpanel">
<pre class="language-html" data-lang="html">
<code>&lt;ul class=&quot;list-group&quot;&gt;
    &lt;li class=&quot;list-group-item&quot;&gt;Dapibus ac facilisis in&lt;/li&gt;
    
    &lt;li class=&quot;list-group-item list-group-item-primary&quot;&gt;A simple primary list group item&lt;/li&gt;
    &lt;li class=&quot;list-group-item list-group-item-secondary&quot;&gt;A simple secondary list group item&lt;/li&gt;
    &lt;li class=&quot;list-group-item list-group-item-success&quot;&gt;A simple success list group item&lt;/li&gt;
    &lt;li class=&quot;list-group-item list-group-item-danger&quot;&gt;A simple danger list group item&lt;/li&gt;
    &lt;li class=&quot;list-group-item list-group-item-warning&quot;&gt;A simple warning list group item&lt;/li&gt;
    &lt;li class=&quot;list-group-item list-group-item-info&quot;&gt;A simple info list group item&lt;/li&gt;
    &lt;li class=&quot;list-group-item list-group-item-light&quot;&gt;A simple light list group item&lt;/li&gt;
    &lt;li class=&quot;list-group-item list-group-item-dark&quot;&gt;A simple dark list group item&lt;/li&gt;
&lt;/ul&gt;

&lt;div class=&quot;list-group&quot;&gt;
    &lt;a href=&quot;#&quot; class=&quot;list-group-item list-group-item-action&quot;&gt;Dapibus ac facilisis in&lt;/a&gt;
    
    &lt;a href=&quot;#&quot; class=&quot;list-group-item list-group-item-action list-group-item-primary&quot;&gt;A simple primary list group item&lt;/a&gt;
    &lt;a href=&quot;#&quot; class=&quot;list-group-item list-group-item-action list-group-item-secondary&quot;&gt;A simple secondary list group item&lt;/a&gt;
    &lt;a href=&quot;#&quot; class=&quot;list-group-item list-group-item-action list-group-item-success&quot;&gt;A simple success list group item&lt;/a&gt;
    &lt;a href=&quot;#&quot; class=&quot;list-group-item list-group-item-action list-group-item-danger&quot;&gt;A simple danger list group item&lt;/a&gt;
    &lt;a href=&quot;#&quot; class=&quot;list-group-item list-group-item-action list-group-item-warning&quot;&gt;A simple warning list group item&lt;/a&gt;
    &lt;a href=&quot;#&quot; class=&quot;list-group-item list-group-item-action list-group-item-info&quot;&gt;A simple info list group item&lt;/a&gt;
    &lt;a href=&quot;#&quot; class=&quot;list-group-item list-group-item-action list-group-item-light&quot;&gt;A simple light list group item&lt;/a&gt;
    &lt;a href=&quot;#&quot; class=&quot;list-group-item list-group-item-action list-group-item-dark&quot;&gt;A simple dark list group item&lt;/a&gt;
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
