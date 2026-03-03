<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AmarEvent - Landing Page</title>
    <meta name="description" content="AmarEvent - All-in-one Event Management System for organizing, managing, and analyzing events effortlessly.">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.0.0/dist/full.css" rel="stylesheet" />

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <!-- Smooth Scroll -->
    <style>
        html { scroll-behavior: smooth; }
    </style>
</head>
<body class="bg-gray-100 scroll-smooth">

    <!-- Navbar -->
    <nav class="bg-primary p-4 fixed top-0 w-full z-20 shadow-md">
        <div class="max-w-screen-xl mx-auto flex justify-between items-center">
            <a href="#" class="text-white text-2xl font-bold">AmarEvent</a>
            <div class="space-x-4 text-white font-semibold text-lg">
                <a href="#features" class="hover:border-b-2 hover:border-white">Features</a>
                <a href="#about" class="hover:border-b-2 hover:border-white">About</a>
                <a href="#contact" class="hover:border-b-2 hover:border-white">Contact</a>
                <a href="{{ route('login') }}" class="cursor-pointer hover:border-b-2 hover:border-white">Login</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero bg-gradient-to-r from-blue-500 to-teal-500 text-white py-32 md:py-48 text-center min-h-screen flex items-center justify-center">
        <div class="max-w-3xl mx-auto mt-20 md:mt-0">
            <h1 class="text-4xl md:text-5xl font-extrabold mb-4">Welcome to AmarEvent</h1>
            <h2 class="text-2xl md:text-4xl font-semibold mb-6">Simplify Your Event Experience</h2>
            <p class="text-md md:text-lg mb-8">Our Event Management System (EMS) offers powerful tools to create, manage, and track events seamlessly. Designed for attendees, organizers, and admins, EMS provides real-time analytics, smart scheduling, ticketing, and secure communication — all in one place.</p>
            <a href="#features" class="btn btn-accent text-white px-6 py-3">Discover More</a>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-16 bg-white text-center scroll-mt-24" loading="lazy">
        <div class="max-w-screen-xl mx-auto">
            <h2 class="text-3xl md:text-4xl font-bold mb-12">Key Features</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl mx-auto">
                <div class="card bg-base-100 shadow-md p-6">
                    <h3 class="text-xl font-semibold mb-2">Event Creation</h3>
                    <p>Create and customize events with flexible scheduling, themes, and location settings.</p>
                </div>
                <div class="card bg-base-100 shadow-md p-6">
                    <h3 class="text-xl font-semibold mb-2">Ticketing System</h3>
                    <p>Offer multiple ticket types, manage availability, and handle online payments securely.</p>
                </div>
                <div class="card bg-base-100 shadow-md p-6">
                    <h3 class="text-xl font-semibold mb-2">Speaker Management</h3>
                    <p>Add and schedule guest speakers with detailed bios, slots, and session types.</p>
                </div>
                <div class="card bg-base-100 shadow-md p-6">
                    <h3 class="text-xl font-semibold mb-2">User Registration</h3>
                    <p>Enable users to register, update profiles, and get personalized schedules.</p>
                </div>
                <div class="card bg-base-100 shadow-md p-6">
                    <h3 class="text-xl font-semibold mb-2">Notifications & Reminders</h3>
                    <p>Send real-time updates via email, SMS, or push notifications for critical event changes.</p>
                </div>
                <div class="card bg-base-100 shadow-md p-6">
                    <h3 class="text-xl font-semibold mb-2">Analytics Dashboard</h3>
                    <p>Track registrations, engagement, and revenue with visual reports and insights.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-16 bg-gray-50 text-center scroll-mt-24">
        <div class="max-w-screen-xl mx-auto px-4">
            <h2 class="text-3xl md:text-4xl font-bold mb-8">About AmarEvent</h2>
            <p class="text-md md:text-lg max-w-2xl mx-auto">AmarEvent is an all-in-one solution for creating, managing, and promoting events. Whether you're hosting a small meetup or a large conference, AmarEvent provides you with the tools you need to streamline event management, including ticketing, scheduling, and more.</p>
        </div>
    </section>

    <!-- How It Works -->
    <section class="py-16 bg-base-200">
        <div class="max-w-6xl mx-auto px-4">
            <h2 class="text-3xl md:text-4xl font-bold text-center mb-12">How It Works</h2>
            <div class="steps steps-vertical lg:steps-horizontal justify-center">
                <div class="step step-primary">Register</div>
                <div class="step step-primary">Create Event</div>
                <div class="step step-primary">Manage Tickets & Speakers</div>
                <div class="step step-primary">Launch & Analyze</div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-16 bg-white text-center">
        <div class="max-w-screen-xl mx-auto px-4">
            <h2 class="text-3xl md:text-4xl font-bold mb-12">What Our Users Say</h2>
            <div class="space-y-8 md:space-y-0 md:grid md:grid-cols-2 gap-8">
                <div class="testimonial-card card shadow-xl bg-base-100 p-6">
                    <p class="italic mb-4">"AmarEvent made organizing our conference so much easier! The ticketing system was seamless, and the event creation was straightforward."</p>
                    <h5 class="font-semibold">John Doe</h5>
                    <p>Event Organizer</p>
                </div>
                <div class="testimonial-card card shadow-xl bg-base-100 p-6">
                    <p class="italic mb-4">"The ability to manage events, track sales, and integrate payments all in one platform is a game changer for my business."</p>
                    <h5 class="font-semibold">Jane Smith</h5>
                    <p>Business Owner</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-600 text-white pt-16">
        <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 md:grid-cols-4 gap-10 justify-items-center pb-10">
            <!-- Logo and Brief -->
            <div>
                <h2 class="text-2xl font-extrabold mb-2">AmarEvent</h2>
                <p class="text-sm leading-relaxed text-justify">
                    A complete solution for managing, hosting, and scaling professional events globally. Empower your attendees and deliver unforgettable experiences.
                </p>
                <div class="flex gap-4 mt-4">
                    <a href="#" class="text-xl hover:text-gray-300"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="text-xl hover:text-gray-300"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-xl hover:text-gray-300"><i class="fab fa-linkedin"></i></a>
                    <a href="#" class="text-xl hover:text-gray-300"><i class="fab fa-instagram"></i></a>
                </div>
            </div>

            <!-- Company Info -->
            <div>
                <h6 class="font-semibold mb-2">Company</h6>
                <a href="#" class="link link-hover">About Us</a> <br>
                <a href="#" class="link link-hover">Leadership</a> <br>
                <a href="#" class="link link-hover">Careers</a> <br>
                <a href="#" class="link link-hover">Media Kit</a>
            </div>

            <!-- Resources -->
            <div>
                <h6 class="font-semibold mb-2">Resources</h6>
                <a href="#" class="link link-hover">Documentation</a> <br>
                <a href="#" class="link link-hover">API Reference</a> <br>
                <a href="#" class="link link-hover">Community Forum</a> <br>
                <a href="#" class="link link-hover">Help Center</a>
            </div>

            <!-- Newsletter / Contact -->
            <div>
                <h6 class="font-semibold mb-2">Contact Us</h6>
                <p class="text-sm mb-2">Have questions? Reach out to us and we'll be happy to assist you.</p>
                <a href="mailto:contact@amarevent.com" class="btn btn-accent">Email Us</a>
            </div>
        </div>

        <div class="pb-6 text-sm text-center">
            © 2025 AmarEvent Inc. All rights reserved • <a href="#" class="link">Privacy Policy</a> • <a href="#" class="link">Terms</a>
        </div>
    </footer>
</body>
</html>