@extends('backend.layouts.app')

@section('title', __('doc'))

@section('content')
<div class="body d-flex py-lg-4 py-3">
            <div class="container">
                
                <div class="row">

                    <div class="col-12">
                        <div class="mb-5 py-3 card" style="font-size: 16px;">
                            <div class="card-header">
                                <h5 class="fw-bold"><i class="icofont-thumbs-up me-2"></i>Getting Started</h5>
                            </div>
                            <div class="card-body">
                                <p>This guide will help you get started with <strong class="text-secondary">Mytask</strong>! All the important stuff –&nbsp;compiling the source, file structure, build tools, file includes –&nbsp;is documented here, but should you have any questions, always feel free to reach out to <span class="text-muted">pixelwibes@gmail.com</span></p>
                                <p>If you really like our work, design, performance and support then <a href="https://themeforest.net/downloads" class="text-secondary"> please don't forgot to rate us</a> on Themeforest,<br> it really motivate us to provide something better.
                                    <span class="ms-2">
                                        <i class="fa fa-star text-warning"></i>
                                        <i class="fa fa-star text-warning"></i>
                                        <i class="fa fa-star text-warning"></i>
                                        <i class="fa fa-star text-warning"></i>
                                        <i class="fa fa-star text-warning"></i>
                                    </span>
                                </p>
                                <p><strong>Please Note :</strong></p> 
                                <p>- All images are just used for Preview Purpose Only. They are not part of the template and NOT included in the final purchase files.</p>
                                <p>- This is Admin panel design integrated with Laravel, ready to develop template. It does not include any Business logic to produce database records.</p>
                            </div>
                        </div>
                    </div> <!-- Doc: Getting Started -->

                    <div class="col-12">
                        <div class="mb-5 py-3 card">
                            <div class="card-header">
                                <h5 class="fw-bold"><i class="icofont-code me-2"></i>Installation Setup Laravel</h5>
                            </div>
                            <div class="card-body">
                                <p class="mb-0">This template is built in Laravel and requires PHP 7.3+, Node 14.x and NPM 6.9.0 to be installed</p>
                                <p>This template is built on Laravel 8.0, Boilerplate </p>
                                <h4>Credentials: Admin</h4>
                                <p class="mb-0">User: admin@admin.com</p>
                                <p>Password: secret</p>
                                <p>To get started, you need to do the following:</p>
                                <ul style="line-height: 30px;">
                                    <li><strong>Node.js and NPM:</strong>  You can download Node.js from <a href="https://nodejs.org" target="_blank" rel="noopener noreferrer nofollow external">NodeJS</a>. NPM comes bundled with Node.js</li>
                                    <li><strong>Project Setup:</strong>  After Installing Node and NPM, run 'num install' command to install npm related dependencies</li>
                                    <li><strong>Environment Files:</strong> This package ships with a  <code>env.example</code> file in the root of the project.You must rename this file to just <code>.env</code><br><strong>Note:</strong> Make sure you have hidden files shown on your system.</li>
                                    <li><strong>Composer:</strong> Laravel project dependencies are managed through the <code><a href="https://getcomposer.org" style="color:red;text-decoration: underline;">PHP Composer tool</a> </code>. The first step is to install the depencencies by navigating into your project in terminal and typing this command:<br> <span style="background-color: black;padding: 5px;color: white;">composer install</span></li>
                                    <li><strong>Create Database:</strong> You must create your database on your server and on your <code>.env</code> file update the following lines:<br>
                                        <div style="background-color: black;padding: 5px 10px;color: white; display: inline-block;">
                                            DB_CONNECTION=mysql<br>
                                            DB_HOST=127.0.0.1<br>
                                            DB_PORT=3306<br>
                                            DB_DATABASE=homestead<br>
                                            DB_USERNAME=homestead<br>
                                            DB_PASSWORD=secret
                                        </div>
                                    </li>
                                    <li><strong>Artisan Commands:</strong> The first thing we are going to do is set the key that Laravel will use when doing encryption.<br> <span style="background-color: black;padding: 5px;color: white;">php artisan key:generate</span><br>You should see a green message stating your key was successfully generated. As well as you should see the APP_KEY variable in your .env file reflected.<br>It's time to see if your database credentials are correct.<br>We are going to run the built in migrations to create the database tables:<br><span style="background-color: black;padding: 5px;color: white;">php artisan migrate</span><br>
                                        You should see a message for each table migrated, if you don't and see errors, than your credentials are most likely not correct.<br>
                                        We are now going to set the administrator account information. To do this you need to navigate to this file and change the name/email/password of the Administrator account.<br>
                                        You can delete the other dummy users, but do not delete the administrator account or you will not be able to access the backend.<br>
                                        Now seed the database with:<br>
                                        <span style="background-color: black;padding: 5px;color: white;">php artisan db:seed</span><br>
                                        You should get a message for each file seeded, you should see the information in your database tables.
                                    </li>
                                    <li><strong>NPM Run '*'</strong> Now that you have the database tables and default rows, you need to build the styles and scripts.<br>
                                        These files are generated using <a href="https://laravel.com/docs/8.x/mix" style="color:red;text-decoration: underline;">Laravel Mix</a>, which is a wrapper around many tools, and works off the <code>webpack.mix.js</code> in the root of the project.You can build with:<br>
                                        <span style="background-color: black;padding: 5px;color: white;">npm run &#60 command  &gt </span><br>
                                        The available commands are listed at the top of the package.json file under the 'scripts' key.<br>
                                        You will see a lot of information flash on the screen and then be provided with a table at the end explaining what was compiled and where the files live.<br>
                                        At this point you are done, you should be able to hit the project in your local browser and see the project, as well as be able to log in with the administrator and view the backend.

                                    </li>
                                    <li><strong>Storage:link</strong>After your project is installed you must run this command to link your public storage folder for user avatar uploads:<br>
                                        <span style="background-color: black;padding: 5px;color: white;">php artisan storage:link </span>
                                    </li>
                                    <li><strong>Login</strong>After your project is installed and you can access it in a browser, click the login button on the right of the navigation bar.<br>
                                        The administrator credentials are:<br>
                                        <strong>Username: </strong>  admin@admin.com<br>
                                        <strong>Password:: </strong>  secret<br>
                                        You will be automatically redirected to the backend. If you changed these values in the seeder prior, then obviously use the ones you updated to.
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div> <!-- Doc: Dev Setup -->

                    <div class="col-12">
                        <div class="mb-5 py-3 card">
                            <div class="card-header">
                                <h5 class="fw-bold"><i class="icofont-folder me-2"></i>File Structure</h5>
                            </div>
                            <div class="card-body">
                                <ul style="line-height: 28px;">
                                    <li>
                                        <strong><i class="icofont-folder-open text-secondary me-2"></i>app</strong> <span class="text-muted">- The app directory holds the base code for your Laravel application.</span>
                                        <ul class="mb-3">
                                            <li><strong><i class="icofont-folder text-secondary me-2"></i>Console</strong></li>
                                            <li><strong><i class="icofont-folder text-secondary me-2"></i>Domains</strong></li>
                                            <li><strong><i class="icofont-folder text-secondary me-2"></i>Exceptions</strong></li>
                                            <li><strong><i class="icofont-folder text-secondary me-2"></i>Helpers / Global</strong></li>
                                            <li>
                                                <strong><i class="icofont-folder text-secondary me-2"></i>Http</strong>
                                                <ul class="mb-3">
                                                    <li>
                                                        <strong><i class="icofont-folder text-secondary me-2"></i>Controllers</strong>
                                                        <ul class="mb-3">
                                                            <li><strong><i class="icofont-folder text-secondary me-2"></i>Backend</strong></li>
                                                            <li><strong><i class="icofont-folder text-secondary me-2"></i>Frontend</strong></li>
                                                            <li><strong><i class="icofont-file-code text-secondary me-2"></i>Controller.php</strong></li>
                                                            <li><strong><i class="icofont-file-code text-secondary me-2"></i>LocaleController.php</strong></li>
                                                        </ul>
                                                    </li>
                                                    <li><strong><i class="icofont-folder text-secondary me-2"></i>Livewire</strong></li>
                                                    <li><strong><i class="icofont-folder text-secondary me-2"></i>Middleware</strong></li>
                                                    <li><strong><i class="icofont-folder text-secondary me-2"></i>Requests</strong></li>
                                                    <li><strong><i class="icofont-file-code color-light-orange me-2"></i>Kernel</strong></li>
                                                </ul>
                                            </li>
                                            <li><strong><i class="icofont-folder text-secondary me-2"></i>Models</strong></li>
                                            <li><strong><i class="icofont-folder text-secondary me-2"></i>Providers</strong></li>
                                            <li><strong><i class="icofont-folder text-secondary me-2"></i>Rules</strong></li>
                                            <li><strong><i class="icofont-folder text-secondary me-2"></i>Services</strong></li>
                                        </ul>
                                        
                                    </li>
                                    <li><strong><i class="icofont-folder-open text-secondary me-2"></i>bootstrap</strong><span class="text-muted">- The bootstrap directory contains all the bootstrapping scripts used for your application.</span></li>
                                    <li><strong><i class="icofont-folder-open text-secondary me-2"></i>config</strong><span class="text-muted">- The config directory holds all your project configuration files (.config).</span></li>
                                    <li><strong><i class="icofont-folder-open text-secondary me-2"></i>database</strong><span class="text-muted">- The database directory holds your database files.</span></li>
                                    <li><strong><i class="icofont-folder-open text-secondary me-2"></i>public</strong><span class="text-muted">- The public directory helps to start your Laravel project and maintains other necessary files such as JavaScript, CSS, and images of your project.</span></li>
                                    <li>
                                        <strong><i class="icofont-folder-open text-secondary me-2"></i>resources</strong><span class="text-muted">- The resources directory holds all the Sass files, language (localization) files, templates (if any).</span>
                                        <ul class="mb-3">
                                            <li><strong><i class="icofont-folder text-secondary me-2"></i>js</strong></li>
                                            <li><strong><i class="icofont-folder text-secondary me-2"></i>lang</strong></li>
                                            <li><strong><i class="icofont-folder text-secondary me-2"></i>sass</strong></li>
                                            <li><strong><i class="icofont-folder text-secondary me-2"></i>views</strong></li>
                                        </ul>
                                    </li>
                                    <li><strong><i class="icofont-folder-open text-secondary me-2"></i>routes</strong><span class="text-muted">- The routes directory contain all your definition files for routing, such as console.php, api.php, channels.php, etc.</span></li>
                                    <li><strong><i class="icofont-folder-open text-secondary me-2"></i>storage</strong><span class="text-muted">- The storage directory holds your session files, cache, compiled templates as well as miscellaneous files generated by the framework.</span></li>
                                    <li><strong><i class="icofont-folder-open text-secondary me-2"></i>test</strong><span class="text-muted">- The test directory holds all your test cases.</span></li>
                                    <li><strong><i class="icofont-folder text-secondary me-2"></i>node_modules</strong> <span class="text-muted">- NPM dependencies (by default the folder is not included) <code>npm</code> installs dependencies. </span></li>
                                    <li><strong><i class="icofont-file-code color-light-orange  me-2"></i>_ide_helper.php</strong> <span class="text-muted">-package Generation is done based on the files in your project </span></li>
                                    <li><strong><i class="icofont-file-code color-light-orange  me-2"></i>composer.json</strong> <span class="text-muted">- The PHP Composer can be defined as a dependency manager or dependency management tool specifically built for PHP</span></li>
                                    <li><strong><i class="icofont-file-code color-light-orange  me-2"></i>composer.lock</strong> <span class="text-muted">- It basically states that your project is locked to those specific versions </span></li>
                                    <li><strong><i class="icofont-file-code color-light-orange  me-2"></i>package.json</strong> <span class="text-muted">- List of dependencies and npm information</span></li>
                                    <li><strong><i class="icofont-file-code color-light-orange  me-2"></i>phpunit.xml</strong> <span class="text-muted">- Convenient helper methods  allow to expressively test your applications</span></li>
                                    <li><strong><i class="icofont-file-code color-light-orange  me-2"></i>server.php</strong> <span class="text-muted">-  Head to your cli and start the server</span></li>
                                    <li><strong><i class="icofont-file-code color-light-orange  me-2"></i>webpack.mix.js</strong> <span class="text-muted">- Mix makes it a cinch to compile and minify your application's</span></li>
                                </ul>
                            </div>
                        </div>
                    </div> <!-- Doc: File Structure -->

                    <div class="col-12">
                        <div class="mb-5 py-3 card">
                            <div class="card-header">
                                <h5 class="fw-bold"><i class="icofont-layout me-2"></i>Layouts info</h5>
                            </div>
                            <div class="card-body">
                                <div class="row g-4">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="card lift">
                                            <div class="lift">
                                                <img src="{{ url('/').'/images/document/menu-open.png'}}" alt="menu-open" class="img-fluid">
                                            </div>
                                        </div>
                                        <div class="card-body px-0">
                                            <h6 class="pb-2 fw-bold">Bydefult Menu Open Code</h6>
    <pre>
    <code class="language-html" data-lang="html">&lt;div class=&quot;sidebar px-4 py-2 py-md-4 me-0&quot;&gt;
        &lt;div class=&quot;d-flex flex-column h-100&quot;&gt;
            &lt;!-- Main Logo --&gt;
            &lt;a href=&quot;index.html&quot; class=&quot;mb-0 brand-icon&quot;&gt;
            &lt;/a&gt;
            &lt;!-- Menu: main ul --&gt;
            &lt;ul class=&quot;menu-list flex-grow-1 mt-3&quot;&gt;
            &lt;/ul&gt;
            &lt;!-- Theme: Switch Theme --&gt;
            &lt;ul class=&quot;list-unstyled mb-0&quot;&gt;
            &lt;/ul&gt;
            &lt;!-- Menu: menu collepce btn --&gt;
            &lt;button type=&quot;button&quot; class=&quot;btn btn-link sidebar-mini-btn text-light&quot;&gt;
                &lt;span class=&quot;ms-2&quot;&gt;&lt;i class=&quot;icofont-bubble-right&quot;&gt;&lt;/i&gt;&lt;/span&gt;
            &lt;/button&gt;
        &lt;/div&gt;
    &lt;/div&gt;</code>
    </pre>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="card lift">
                                            <div class="lift">
                                                <img src="{{ url('/').'/images/document/menu-close.png'}}" alt="menu-open" class="img-fluid">
                                            </div>
                                        </div>
                                        <div class="card-body px-0">
                                        <h6 class="pb-2 fw-bold">Bydefult Menu Close Code</h6>
    <pre>
    <code class="language-html" data-lang="html">&lt;div class=&quot;sidebar px-4 py-2 sidebar-mini py-md-4 me-0&quot;&gt;
        &lt;div class=&quot;d-flex flex-column h-100&quot;&gt;
            &lt;!-- Main Logo --&gt;
            &lt;a href=&quot;index.html&quot; class=&quot;mb-0 brand-icon&quot;&gt;
            &lt;/a&gt;
            &lt;!-- Menu: main ul --&gt;
            &lt;ul class=&quot;menu-list flex-grow-1 mt-3&quot;&gt;
            &lt;/ul&gt;
            &lt;!-- Theme: Switch Theme --&gt;
            &lt;ul class=&quot;list-unstyled mb-0&quot;&gt;
            &lt;/ul&gt;
            &lt;!-- Menu: menu collepce btn --&gt;
            &lt;button type=&quot;button&quot; class=&quot;btn btn-link sidebar-mini-btn text-light&quot;&gt;
                &lt;span class=&quot;ms-2&quot;&gt;&lt;i class=&quot;icofont-bubble-right&quot;&gt;&lt;/i&gt;&lt;/span&gt;
            &lt;/button&gt;
        &lt;/div&gt;
    &lt;/div&gt;</code>
    </pre>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- Doc: layout view -->

                    <div class="col-12">
                        <div class="mb-5 py-3 card">
                            <div class="card-header">
                                <h5 class="fw-bold"><i class="icofont-paint-brush me-2"></i>Comman Utilities With Custom Class</h5>
                            </div>
                            <div class="card-header">
                                <h5 class="fw-bold">Text Color</h5>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered  doc-table">
                                    <thead>
                                        <tr>
                                            <th>Class</th>
                                            <th>Results</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><code>.text-primary</code></td>
                                            <td class="text-primary">Lorem ipsum dolor sit amet consectecur.</td>
                                        </tr>
                                        <tr>
                                            <td><code>.text-secondary</code></td>
                                            <td class="text-secondary">Lorem ipsum dolor sit amet consectecur.</td>
                                        </tr>
                                        <tr>
                                            <td><code>.text-success</code></td>
                                            <td class="text-success">Lorem ipsum dolor sit amet consectecur.</td>
                                        </tr>
                                        <tr>
                                            <td><code>.text-info</code></td>
                                            <td class="text-info">Lorem ipsum dolor sit amet consectecur.</td>
                                        </tr>
                                        <tr>
                                            <td><code>.text-warning</code></td>
                                            <td class="text-warning">Lorem ipsum dolor sit amet consectecur.</td>
                                        </tr>
                                        <tr>
                                            <td><code>.text-danger</code></td>
                                            <td class="text-danger">Lorem ipsum dolor sit amet consectecur.</td>
                                        </tr>
                                        <tr>
                                            <td><code>.text-dark</code></td>
                                            <td class="text-dark">Lorem ipsum dolor sit amet consectecur.</td>
                                        </tr>
                                        <tr>
                                            <td><code>.color-lightyellow</code></td>
                                            <td class="color-lightyellow">Lorem ipsum dolor sit amet consectecur.</td>
                                        </tr>
                                        <tr>
                                            <td><code>.color-lightblue</code></td>
                                            <td class="color-lightblue">Lorem ipsum dolor sit amet consectecur.</td>
                                        </tr>
                                        <tr>
                                            <td><code>.color-light-success</code></td>
                                            <td class="color-light-success">Lorem ipsum dolor sit amet consectecur.</td>
                                        </tr>
                                        <tr>
                                            <td><code>.color-light-orange</code></td>
                                            <td class="color-light-orange">Lorem ipsum dolor sit amet consectecur.</td>
                                        </tr>
                                        <tr>
                                            <td><code>.color-careys-pink</code></td>
                                            <td class="color-careys-pink">Lorem ipsum dolor sit amet consectecur.</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-header">
                                <h5 class="fw-bold">Background Color</h5>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered doc-table">
                                    <thead>
                                        <tr>
                                            <th>Class</th>
                                            <th>Results</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><code>.bg-primary</code></td>
                                            <td class="bg-primary"></td>
                                        </tr>
                                        <tr>
                                            <td><code>.bg-secondary</code></td>
                                            <td class="bg-secondary"></td>
                                        </tr>
                                        <tr>
                                            <td><code>.bg-success</code></td>
                                            <td class="bg-success"></td>
                                        </tr>
                                        <tr>
                                            <td><code>.bg-info</code></td>
                                            <td class="bg-info"></td>
                                        </tr>
                                        <tr>
                                            <td><code>.bg-warning</code></td>
                                            <td class="bg-warning"></td>
                                        </tr>
                                        <tr>
                                            <td><code>.bg-danger</code></td>
                                            <td class="bg-danger"></td>
                                        </tr>
                                        <tr>
                                            <td><code>.bg-dark</code></td>
                                            <td class="bg-dark"></td>
                                        </tr>
                                        <tr>
                                            <td><code>.bg-white</code></td>
                                            <td class="bg-white"></td>
                                        </tr>
                                        <tr>
                                            <td><code>.bg-lightyellow</code></td>
                                            <td class="bg-lightyellow"></td>
                                        </tr>
                                        <tr>
                                            <td><code>.bg-lightblue</code></td>
                                            <td class="bg-lightblue"></td>
                                        </tr>
                                        <tr>
                                            <td><code>.bg-careys-pink</code></td>
                                            <td class="bg-careys-pink"></td>
                                        </tr>
                                        <tr>
                                            <td><code>.light-success-bg</code></td>
                                            <td class="light-success-bg"></td>
                                        </tr>
                                        <tr>
                                            <td><code>.light-orange-bg </code></td>
                                            <td class="light-orange-bg"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div><!-- Doc: Comman Utilities -->

                    <div class="col-12">
                        <div class="mb-5 py-3 card">
                            <div class="card-header">
                                <h5 class="fw-bold"><i class="icofont-flag-alt-2 me-2"></i>Advantages </h5>
                            </div>
                        
                            <div class="card-body">
                                <ul style="line-height: 30px; font-size: 16px;">
                                    <li>Very easy access to any starters components and core settings from anywhere in the template.</li>
                                    <li>Intuitive clear architecture.</li>
                                    <li>Avoiding the probabilities of conflicts between Front codes and third party plugins (libraries).</li>
                                    <li>Creation of wrapper components simply solves complicated initializations structures for the users.</li>
                                    <li>Everything is structured, each component in its own file and in its component in the main object.</li>
                                    <li>The ability of extending functionality without affecting the behavior of the core object and not changing the existing functionality.</li>
                                </ul>
                            </div>
                        </div>
                    </div> <!-- Doc: mytask Advantages  -->

                    <div class="col-12">
                        <div class="mb-5 py-3 card">
                            <div class="card-header">
                                <h5 class="fw-bold"><i class="icofont-diamond me-2"></i>mytask Template Credit</h5>
                            </div>
                            
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <tbody>
                                            <tr>
                                                <td>Google font</td>
                                                <td><a href="https://fonts.google.com/">https://fonts.google.com/</a></td>
                                            </tr>
                                            <tr>
                                                <td>Bootstrap</td>
                                                <td><a href="https://v5.getbootstrap.com/">https://v5.getbootstrap.com/</a></td>
                                            </tr>
                                            <tr>
                                                <td>Jquery</td>
                                                <td><a href="https://jquery.com/">https://jquery.com/</a></td>
                                            </tr>
                                            <tr>
                                                <td>SASS</td>
                                                <td><a href="https://sass-lang.com/">https://sass-lang.com/</a></td>
                                            </tr>
                                            <tr>
                                                <td>Grunt</td>
                                                <td><a href="https://gruntjs.com/">https://gruntjs.com/</a></td>
                                            </tr>
                                            <tr>
                                                <td>NPM</td>
                                                <td><a href="https://www.npmjs.com/">https://www.npmjs.com/</a></td>
                                            </tr>
                                            <tr>
                                                <td>Fontawesome</td>
                                                <td><a href="https://fontawesome.com/v4.7.0/">https://fontawesome.com/v4.7.0/</a></td>
                                            </tr>
                                            <tr>
                                                <td>Icon Font</td>
                                                <td><a href="https://icofont.com/icons">https://icofont.com/icons</a></td>
                                            </tr>
                                            <tr>
                                                <td>Apex Charts</td>
                                                <td><a href="https://apexcharts.com/">https://apexcharts.com/</a></td>
                                            </tr>
                                            <tr>
                                                <td>Sparkline Charts</td>
                                                <td><a href="https://omnipotent.net/jquery.sparkline/#s-about">https://omnipotent.net/jquery.sparkline/#s-about</a></td>
                                            </tr>
                                            <tr>
                                                <td>Fullcalendar</td>
                                                <td><a href="https://fullcalendar.io/">https://fullcalendar.io/</a></td>
                                            </tr>
                                            <tr>
                                                <td>Owl Carousel</td>
                                                <td><a href="https://owlcarousel2.github.io/OwlCarousel2/">https://owlcarousel2.github.io/OwlCarousel2/</a></td>
                                            </tr>
                                            <tr>
                                                <td>Pexels</td>
                                                <td><a href="https://www.pexels.com/">https://www.pexels.com/</a></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div> <!-- Doc: Template Credit  -->

                    <div class="col-12">
                        <div class="mb-5 py-3 card">
                            <div class="card-header">
                                <h5 class="fw-bold"><i class="icofont-love me-2"></i>THANK YOU!</h5>
                            </div>
                            <div class="card-body">
                                <div class="row mt-2">
                                    <div class="col-xl-8 col-lg-8 col-md-12">
                                        <div class="card overflow-hidden mb-3">
                                            <div class="bg-primary py-5 px-4 text-light">
                                                <h4>pixelwibes.com</h4>
                                                <span class="small">Once again, thank you so much for purchasing this template. As I said at the beginning, I'd be glad to help you if you have any questions relating to this template.
                                                    If you really like our work, design, performance and support then <a class="text-warning" href="https://themeforest.net/downloads"> please don't forgot to rate us</a> on Themeforest, it really motivate us to provide something better.</span>
                                            </div>
                                            <div class="p-4">
                                                <h6>Customize Code and Devlopment</h6>
                                                <span>We Can provide Bunch of Services to Customize Template According To Your Requirements</span>
                                                <div class="mt-4 mb-2">
                                                    <a href="http://www.pixelwibes.com" target="_blank" class="btn btn-primary">Hire Us</a>
                                                </div>
                                                <div class="dividers-block"></div>
                                                <h6>mytask guide</h6>
                                                <span>Get started with mytask Business and learn about features for admins and users.</span>
                                                <div class="mt-4 mb-2">
                                                    <a href="http://pixelwibes.com/" class="btn btn-primary">Check out the guide</a>
                                                </div>
                                                <div class="dividers-block"></div>
                                                <h6>Get answers</h6>
                                                <span>Visit the help centre for answers to common issues.</span>
                                                <div class="mt-4 mb-2">
                                                    <a href="http://pixelwibes.com/" class="btn btn-primary">Go to Help Centre</a>
                                                </div>
                                                <div class="dividers-block"></div>
                                                <span class="text-muted">Thanks for choosing <strong class="text-warning">Pixel Wibes</strong> Admin.</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-4 col-md-12">
                                        <div class="card bg-info-light mb-3">
                                            <div class="card-body d-flex align-items-center justify-content-center flex-column">
                                                <div class="preview-pane text-center">
                                                    <svg width="100" fill="currentColor" class="bi bi-chat-text color-defult " viewBox="0 0 16 16">
                                                        <path d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z"/>
                                                        <path d="M4 5.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zM4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8zm0 2.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5z"/>
                                                    </svg>
                                                    <a href="http://pixelwibes.com/" class="fw-bold fs-6 mt-2 d-flex justify-content-center color-defult ">Chat with us</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card bg-lightyellow">
                                            <div class="card-body d-flex align-items-center justify-content-center flex-column">
                                                <div class="preview-pane text-center">
                                                    <svg width="100" fill="currentColor" class="bi bi-envelope color-defult " viewBox="0 0 16 16">
                                                        <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2zm13 2.383l-4.758 2.855L15 11.114v-5.73zm-.034 6.878L9.271 8.82 8 9.583 6.728 8.82l-5.694 3.44A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.739zM1 11.114l4.758-2.876L1 5.383v5.73z"/>
                                                    </svg>
                                                    <a href="mailto:pixelwibes@gmail.com" class="fw-bold  fs-6 mt-2 d-flex justify-content-center color-defult ">Email us</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- Doc: THANK YOU!  -->
                </div> <!-- .row end -->

            </div>
       </div>
    <script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
    <script src="{{ asset('js/template.js') }}"></script>
    <script src="{{ asset('assets/plugin/prism/prism.js') }}"></script>
@endsection