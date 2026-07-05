@extends('layouts.master')

@section('title', 'Contact Us | Diya Collection')

@section('content')
<section class="py-16 md:py-24">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-16">
      <span class="text-daraz-600 text-sm font-bold uppercase tracking-widest">Get in Touch</span>
      <h1 class="text-4xl md:text-5xl font-bold text-midnight-900 mt-3 mb-4">We'd Love to Hear From You</h1>
      <p class="text-gray-500 max-w-xl mx-auto">Whether you have a question about our collection, your order, or just want to say hello, our team is here to help.</p>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
      {{-- Contact Info --}}
      <div class="space-y-8">
        <div class="card-daraz-hover p-6 flex items-start gap-5">
          <div class="w-14 h-14 bg-daraz-100 rounded-2xl flex items-center justify-center shrink-0">
            <i class="fas fa-map-marker-alt text-2xl text-daraz-600"></i>
          </div>
          <div>
            <h3 class="font-semibold text-midnight-900 mb-1">Visit Our Boutique</h3>
            <p class="text-gray-500 text-sm">123 Luxury Lane, Fashion District<br>New York, NY 10001</p>
          </div>
        </div>
        <div class="card-daraz-hover p-6 flex items-start gap-5">
          <div class="w-14 h-14 bg-daraz-100 rounded-2xl flex items-center justify-center shrink-0">
            <i class="fas fa-envelope text-2xl text-daraz-600"></i>
          </div>
          <div>
            <h3 class="font-semibold text-midnight-900 mb-1">Email Us</h3>
            <p class="text-gray-500 text-sm">concierge@diyacollection.com<br>support@diyacollection.com</p>
          </div>
        </div>
        <div class="card-daraz-hover p-6 flex items-start gap-5">
          <div class="w-14 h-14 bg-daraz-100 rounded-2xl flex items-center justify-center shrink-0">
            <i class="fas fa-phone text-2xl text-daraz-600"></i>
          </div>
          <div>
            <h3 class="font-semibold text-midnight-900 mb-1">Call Us</h3>
            <p class="text-gray-500 text-sm">+1 (212) 555-0123<br>Mon – Sat: 10:00 – 19:00</p>
          </div>
        </div>
        <div class="card-daraz-hover p-6 flex items-start gap-5">
          <div class="w-14 h-14 bg-daraz-100 rounded-2xl flex items-center justify-center shrink-0">
            <i class="fas fa-clock text-2xl text-daraz-600"></i>
          </div>
          <div>
            <h3 class="font-semibold text-midnight-900 mb-1">Opening Hours</h3>
            <p class="text-gray-500 text-sm">Monday — Saturday: 10:00 - 19:00<br>Sunday: 12:00 - 17:00</p>
          </div>
        </div>
      </div>

      {{-- Contact Form --}}
      <div class="card-daraz p-8">
        <h3 class="text-xl font-bold text-midnight-900 mb-6">Send Us a Message</h3>
        <form class="space-y-5">
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <input type="text" placeholder="Full Name" class="input-daraz">
            <input type="email" placeholder="Email Address" class="input-daraz">
          </div>
          <input type="text" placeholder="Subject" class="input-daraz">
          <textarea placeholder="Your Message..." rows="5" class="input-daraz resize-none"></textarea>
          <button type="submit" class="btn-daraz w-full py-4">
            <i class="fas fa-paper-plane mr-2"></i> Send Message
          </button>
        </form>
      </div>
    </div>
  </div>
</section>
@endsection
