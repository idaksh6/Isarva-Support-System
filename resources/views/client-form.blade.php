<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customer Support Portal | Isarva</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="{{ asset('assets/plugin/bootstrap.min.css') }}" rel="stylesheet">
    
    <!-- Google Fonts - Modern typography -->
    <link href="{{ asset('assets/plugin/css2.css') }}" rel="stylesheet">
    
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="icon" href="{{ asset('../isarvafavicon.png') }}" type="image/x-icon">


    <style>
        :root {
            --primary-color: #484c7f;
            --primary-light: #5a5f9d;
            --secondary-color: #ff7e5f;
            --accent-color: #8a6dff;
            --dark-color: #2a2d4a;
            --light-color: #f8f9ff;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f5f6ff;
            color: var(--dark-color);
            min-height: 100vh;
            overflow-x: hidden;
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%);
        }
        
        .form-container {
            max-width: 1400px;
            margin: 0 auto;
            border-radius: 30px;
            overflow: hidden;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
            transform: translateY(5%);
        }
        
        .form-content {
            background: white;
            padding: 3rem 4rem;
            height: 100%;
        }
        
        .info-panel {
            background: linear-gradient(135deg, rgba(72, 76, 127, 0.95) 0%, rgba(90, 95, 157, 0.95) 100%);
            color: white;
            padding: 3.7rem;
            position: relative;
            overflow: hidden;
        }
        
        .info-panel::before {
            content: '';
            position: absolute;
            top: -50px;
            right: -50px;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
        }
        
        .info-panel::after {
            content: '';
            position: absolute;
            bottom: -100px;
            left: -50px;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.05);
        }
        
        .logo {
            max-height: 70px;
            margin-bottom: 1.5rem;
        }
        
        .form-control, .form-select {
            border-radius: 12px;
            padding: 0.85rem 1.25rem;
            border: 1px solid #e0e3ff;
            transition: all 0.3s ease;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(72, 76, 127, 0.2);
        }
        
        .form-label {
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 0.5rem;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border: none;
            border-radius: 12px;
            padding: 1rem 2rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            background-color: var(--primary-light);
            transform: translateY(-2px);
            box-shadow: 0 10px 20px -10px rgba(72, 76, 127, 0.4);
        }
        
        .support-image {
            max-width: 100%;
            height: auto;
            margin-bottom: 2rem;
            filter: drop-shadow(0 10px 15px rgba(0, 0, 0, 0.1));
        }
        
        /* .contact-item {
            display: flex;
            align-items: center;
            margin-bottom: 1.25rem;
        } */
        .contact-item{
            display: flex;
            align-items: flex-start;
            margin-bottom: 1rem;
        
           
        }

        .frontendline{

             border-right: 1px solid;
            /* padding-right: 20px; */
            width: 50%;

        }

        .softwareline{
    
            padding-left: 20px;

        }

        .contact-icon {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.15);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            font-size: 1.1rem;
        }
        
      
        

        .section-title {
            font-weight: 700;
            color: var(--primary-color);
            position: relative;
            margin-bottom: 1.5rem;
        }
        
        .section-title::after {
          display: none;
        }
        
        .required-field::after {
            content: ' *';
            color: #ff4d4f;
        }
        
        .address-box {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 1.5rem;
            margin-top: 2rem;
        }
        
        @media (max-width: 992px) {
            .form-container {
                transform: none;
                margin-top: 2rem;
                margin-bottom: 2rem;
            }
            
            .form-content, .info-panel {
                padding: 2rem;
            }

            .section-title::after {
                display:none;
            }
        }
        
        .container-fluid{
            padding-bottom: 15rem;
        }
        
        a.text-white:hover {
            opacity: 0.8;
        }


        .mainphoneconatiner{

            display: flex;
        }

        .inquiryclass{

           color: red;
           font-size: 15px;
        }

    </style>
</head>
<body>
<div class="container-fluid min-vh-100 d-flex align-items-center gradient-bg">
    <div class="container form-container">
        <div class="row g-0">
        
            <div class="col-lg-7">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="form-content">
                    <div class="floating-shapes">
                        <div class="shape shape-1"></div>
                        <div class="shape shape-2"></div>
                        <div class="shape shape-3"></div>
                    </div>
                    
                    <div class="text-center mb-4">
                        <img src="{{ asset('images/logoisarva-1.svg') }}" alt="Isarva Logo" class="logo">
                        <h2 class="section-title">Customer Support Portal</h2>
                        <p class="text-muted">Complete the form below and our team will get back to you within 24 to 48 hours</p>
                        <p class="font-weight-bold inquiryclass">We highly recommend you to create a support ticket before making an inquiry or call.</p>
                    </div>

                    <form method="POST" action="{{ route('support.request.store') }}" enctype="multipart/form-data">
                        @csrf

                        {{-- <div class="row g-3 mb-3">
                            
                            <div class="col-md-6">
                                <label class="form-label ">Domain Name</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i class="fas fa-user text-primary"></i></span>
                                    <input type="text" name="name" class="form-control border-start-0" placeholder="Your Domain Name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label required-field">Email Address</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i class="fas fa-envelope text-primary"></i></span>
                                    <input type="email" name="email" class="form-control border-start-0" required placeholder="Your Email">
                                </div>
                            </div>
                        </div> --}}

                        <div class="mb-3">
                     
                            <div class="col-md-12">
                                <label class="form-label required-field">Your Name</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0"><i class="fa-solid fa-circle-user text-primary"></i></i></span>
                                        <input type="text" name="client_name" class="form-control border-start-0" placeholder="Your Name">
                                    </div>
                                     @if($errors->has('client_name'))
                                        <div class="text-danger">{{ $errors->first('client_name') }}</div>
                                    @endif
                            </div>
                        </div>


                        <div class="mb-3">
                     
                            <div class="col-md-12">
                                <label class="form-label ">Domain Name</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0"><i class="fas fa-user text-primary"></i></span>
                                        <input type="text" name="name" class="form-control border-start-0" placeholder="Your Domain Name">
                                    </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label required-field">Email Address</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="fas fa-envelope text-primary"></i></span>
                                 <input type="email" name="email" class="form-control border-start-0" required placeholder="Your Email">
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-12">
                                <label class="form-label required-field">Phone Number</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i class="fas fa-phone text-primary"></i></span>
                                    <input type="text" name="phone" class="form-control border-start-0" required placeholder="Your Number">
                                </div>
                            </div>
                            <!-- <div class="col-md-6">
                                <label class="form-label">Company Name</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i class="fas fa-building text-primary"></i></span>
                                    <input type="text" name="company" class="form-control border-start-0" placeholder="Your Company">
                                </div>
                            </div> -->
                        </div>

                        <div class="mb-3">
                            <label class="form-label required-field">Subject</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="fas fa-tag text-primary"></i></span>
                                <input type="text" name="subject" class="form-control border-start-0" required placeholder="Briefly describe your issue">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label required-field">Type of Issue/Enquiry</label>
                            <select name="type" class="form-select" required>
                                <option value="" disabled selected>Select issue type</option>
                                <option value="1">Bug Report</option>
                                <option value="2">Question</option>
                                <option value="3">Reminder</option>
                                <option value="4">Incident</option>
                                <option value="5">Problem</option>
                                <option value="6">Feature Request</option>
                                <option value="7">Request</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label required-field">Message / Description</label>
                            <textarea name="message" class="form-control" rows="5" required placeholder="Please describe your issue in detail..."></textarea>
                            <div class="form-text">Be as detailed as possible to help us resolve your issue faster</div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Attach File (Optional)</label>
                            <div class="input-group">
                                <input type="file" name="attachment" class="form-control" id="fileUpload">
                                <label class="input-group-text" for="fileUpload"><i class="fas fa-paperclip"></i></label>
                            </div>
                            <div class="form-text">Max. file size: 5MB (Screenshots, documents, etc.)</div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-paper-plane me-2"></i> Submit Request
                            </button>
                        </div>
                    </form>
                </div>
            </div>
       
            
            <!-- Info Section -->
            <div class="col-lg-5 d-none d-lg-block">
                <div class="info-panel h-100 d-flex flex-column justify-content-center">
                    <div class="text-center mb-5">
                        <img src="{{ asset('images/Ticktet-Management-software-1.svg') }}" class="support-image" alt="Support Illustration">
                        <h3 class="fw-bold mb-3">How Can We Help You?</h3>
                        <p>Our team is available Monday to Friday, 9:30 AM to 6:30 PM to assist with any questions or issues you may encounter.</p>
                    </div>


                    <div class="contact-info">

                        <div class="mainphoneconatiner">
                            <!-- Support Hotline -->
                            <div class="contact-item frontendline">
                                <div class="contact-icon">
                                    <i class="fas fa-phone-alt"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold">Website Support</h6>
                                    <p class="mb-0">
                                        <a href="tel:+917349214818" class="text-white text-decoration-none">+91 7349214818</a>
                                    </p>
                                </div>
                            </div>

                            <!-- Software Support -->
                            <div class="contact-item softwareline">
                                <div class="contact-icon">
                                    <i class="fas fa-headset"></i> <!-- or any other relevant icon -->
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold">Software Support</h6>
                                    <p class="mb-0">
                                        <a href="tel:+917975155797" class="text-white text-decoration-none">+91 7975155797</a>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Visit Website -->
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-globe"></i>
                            </div>
                            <div>
                                <h6 class="mb-0 fw-bold">Visit Website</h6>
                                <p class="mb-0">
                                    <a href="https://www.isarvait.com" target="_blank" class="text-white text-decoration-none">www.isarvait.com</a>
                                </p>
                            </div>
                        </div>
                    </div>


                    
                    <!-- Address Section -->
                    <div class="address-box mt-4">
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div>
                                <h6 class="mb-2 fw-bold">Our Office</h6>
                                <p class="mb-0 small">
                                    Isarva Infotech Private Limited<br>
                                    Near HP Petrol Bunk Bajpe – 574142<br>
                                    Mangalore, Karnataka, India
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-auto pt-4 text-center">
                        <p class="small">Average response time: <span class="fw-bold">24 to 48 hours</span></p>
                        <div class="d-flex justify-content-center gap-3 mt-3">
                            <a href="https://www.instagram.com/isarvainfotech" class="text-white"  target="_blank"><i class="fab fa-instagram"></i></a>
                            <a href="https://www.linkedin.com/company/isarva-infotech-private-limited" class="text-white" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                            <a href="https://www.facebook.com/IsarvaInfotech" class="text-white" target="_blank"><i class="fab fa-facebook-f"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="{{ asset('assets/plugin/bootstrap.bundle.min.js') }}"></script>

<!-- Floating label effect -->
<script>
    document.querySelectorAll('.form-control, .form-select').forEach(element => {
        element.addEventListener('focus', function() {
            this.parentNode.querySelector('.input-group-text').style.borderColor = '#484c7f';
        });
        element.addEventListener('blur', function() {
            this.parentNode.querySelector('.input-group-text').style.borderColor = '';
        });
    });
</script>
</body>
</html>