<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .contact-section {
            padding: 60px 0;
        }
        .info-section {
            padding: 40px 0;
        }
        .footer {
            background-color: #343a40;
            color: white;
            padding: 20px 0;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">MyWebsite</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#">Contact</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Contact Section -->
    <div class="contact-section text-center">
        <div class="container">
            <h1>Contact Us</h1>
            <p class="lead">We would love to hear from you!</p>
            <form>
                <div class="form-row">
                    <x-forms.input name="name" label="Name" placeholder="Your Name" :required="true" />
                    <x-forms.input name="email" label="Email" placeholder="Your Email" :required="true" />
                </div>
                <x-forms.textarea name="message" label="Message" placeholder="Your Message" :required="true" :isVisible="false"></x-forms.textarea>
                <button type="submit" class="btn btn-primary">Send Message</button>
            </form>
        </div>
    </div>

    <!-- About Us Section -->
    <div class="info-section text-center bg-light">
        <div class="container">
            <h2>About Us</h2>
            <p>We are a leading company in our industry, committed to providing the best services to our clients. Our mission is to deliver high-quality products and exceptional customer service.</p>
        </div>
    </div>

    <!-- Location Section -->
    <div class="info-section text-center">
        <div class="container">
            <h2>Our Location</h2>
            <p>Visit us at:</p>
            <p>123 Business Rd,<br>
               Cityville, ST 12345<br>
               Country</p>
        </div>
    </div>

    <!-- FAQ Section -->
    <div class="info-section text-center bg-light">
        <div class="container">
            <h2>Frequently Asked Questions</h2>
            <p><strong>Q: What services do you offer?</strong><br>
               A: We offer a variety of services including consulting, product sales, and customer support.</p>
            <p><strong>Q: How can I get in touch?</strong><br>
               A: You can contact us using the form above or reach us directly at info@mywebsite.com.</p>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer text-center">
        <div class="container">
            <span>&copy; 2024 MyWebsite. All rights reserved.</span>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
