@extends('layouts.app')

@section('content')
{{-- Hero Header --}}
<section class="relative bg-gradient-to-br from-emerald-50 via-white to-teal-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 py-16 lg:py-20 transition-colors">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto" data-aos="fade-up">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-300 text-sm font-semibold rounded-full mb-4">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                {{ $siteSettings['contact_badge'] ?? 'HUBUNGI KAMI' }}
            </div>
            <h1 class="text-4xl lg:text-5xl font-extrabold text-gray-900 dark:text-white mb-4">
                {{ $siteSettings['contact_title'] ?? 'Mari Berbincang' }}
            </h1>
            <p class="text-lg text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                {{ $siteSettings['contact_subtitle'] ?? 'Kami siap membantu Anda menemukan hunian impian. Kirimkan pesan atau hubungi kami langsung.' }}
            </p>
        </div>
    </div>
</section>

{{-- Contact Content --}}
<section class="py-16 lg:py-20 bg-white dark:bg-gray-900 transition-colors">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            {{-- Contact Form --}}
            <div data-aos="fade-right">
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl dark:shadow-gray-900/50 border border-gray-100 dark:border-gray-700 p-8 lg:p-10">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Kirim Pesan</h2>
                    <p class="text-gray-600 dark:text-gray-400 mb-8">Isi form di bawah dan kami akan segera menghubungi Anda.</p>

                    @if(session('status') || request()->query('sent'))
                        <div id="contact-status" class="mb-6 p-4 bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 border-l-4 border-green-500 dark:border-green-400 rounded-lg" data-aos="fade-in" role="status" aria-live="polite">
                            <div class="flex items-center gap-3">
                                <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <span class="text-green-800 dark:text-green-200 font-medium">{{ session('status') ?? 'Pesan berhasil dikirim.' }}</span>
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('landing.contact.send') }}" method="post" class="space-y-6"
                          x-data="{
                              form: {
                                  subject: '{{ old('subject') }}',
                                  name: '{{ old('name') }}',
                                  email: '{{ old('email') }}',
                                  phone: '{{ old('phone') }}',
                                  message: '{{ old('message') }}'
                              },
                              errors: {},
                              validateField(field) {
                                  if (field === 'email') {
                                      const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                                      this.errors.email = !regex.test(this.form.email) ? 'Format email tidak valid' : '';
                                  }
                                  if (field === 'phone') {
                                      const regex = /^[\d\s\-\+\(\)]+$/;
                                      this.errors.phone = !regex.test(this.form.phone) || this.form.phone.length < 10 ? 'Nomor HP minimal 10 digit' : '';
                                  }
                                  if (field === 'name') {
                                      this.errors.name = this.form.name.length < 3 ? 'Nama minimal 3 karakter' : '';
                                  }
                                  if (field === 'subject') {
                                      this.errors.subject = this.form.subject.length < 5 ? 'Subjek minimal 5 karakter' : '';
                                  }
                                  if (field === 'message') {
                                      this.errors.message = this.form.message.length < 10 ? 'Pesan minimal 10 karakter' : '';
                                  }
                              }
                          }">
                        @csrf
                        
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Subjek</label>
                            <input name="subject" type="text" required
                                x-model="form.subject"
                                @blur="validateField('subject')"
                                :class="errors.subject ? 'border-red-500 dark:border-red-400' : 'border-gray-300 dark:border-gray-600'"
                                class="w-full px-4 py-3 border bg-white dark:bg-gray-700 text-gray-900 dark:text-white rounded-xl focus:ring-2 focus:ring-emerald-500 dark:focus:ring-emerald-400 focus:border-transparent transition-all"
                                placeholder="Subjek pesan">
                            @error('subject')<p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
                            <p x-show="errors.subject" x-text="errors.subject" class="mt-1 text-sm text-red-600 dark:text-red-400"></p>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                Nama Lengkap
                            </label>
                <input name="name" type="text" required
                    x-model="form.name"
                    @blur="validateField('name')"
                    :class="errors.name ? 'border-red-500 dark:border-red-400' : 'border-gray-300 dark:border-gray-600'"
                    class="w-full px-4 py-3 border bg-white dark:bg-gray-700 text-gray-900 dark:text-white rounded-xl focus:ring-2 focus:ring-emerald-500 dark:focus:ring-emerald-400 focus:border-transparent transition-all"
                    placeholder="Masukkan nama Anda">
                @error('name')<p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
                            <p x-show="errors.name" x-text="errors.name" class="mt-1 text-sm text-red-600 dark:text-red-400"></p>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                Email
                            </label>
                <input name="email" type="email" required
                    x-model="form.email"
                    @blur="validateField('email')"
                    :class="errors.email ? 'border-red-500 dark:border-red-400' : 'border-gray-300 dark:border-gray-600'"
                    class="w-full px-4 py-3 border bg-white dark:bg-gray-700 text-gray-900 dark:text-white rounded-xl focus:ring-2 focus:ring-emerald-500 dark:focus:ring-emerald-400 focus:border-transparent transition-all"
                    placeholder="nama@email.com">
                @error('email')<p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
                            <p x-show="errors.email" x-text="errors.email" class="mt-1 text-sm text-red-600 dark:text-red-400"></p>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">No. HP</label>
                            <input name="phone" type="text" required
                                x-model="form.phone"
                                @blur="validateField('phone')"
                                :class="errors.phone ? 'border-red-500 dark:border-red-400' : 'border-gray-300 dark:border-gray-600'"
                                class="w-full px-4 py-3 border bg-white dark:bg-gray-700 text-gray-900 dark:text-white rounded-xl focus:ring-2 focus:ring-emerald-500 dark:focus:ring-emerald-400 focus:border-transparent transition-all"
                                placeholder="+62...">
                            @error('phone')<p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
                            <p x-show="errors.phone" x-text="errors.phone" class="mt-1 text-sm text-red-600 dark:text-red-400"></p>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                                Pesan
                            </label>
                            <textarea name="message" rows="5" required
                                      x-model="form.message"
                                      @blur="validateField('message')"
                                      :class="errors.message ? 'border-red-500 dark:border-red-400' : 'border-gray-300 dark:border-gray-600'"
                                      class="w-full px-4 py-3 border bg-white dark:bg-gray-700 text-gray-900 dark:text-white rounded-xl focus:ring-2 focus:ring-emerald-500 dark:focus:ring-emerald-400 focus:border-transparent transition-all resize-none"
                                      placeholder="Sampaikan pesan atau pertanyaan Anda..."></textarea>
                            @error('message')<p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
                            <p x-show="errors.message" x-text="errors.message" class="mt-1 text-sm text-red-600 dark:text-red-400"></p>
                        </div>

                        <button type="submit" 
                                class="w-full inline-flex items-center justify-center gap-2 bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white px-8 py-4 rounded-xl font-bold shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-0.5">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                            Kirim Pesan
                        </button>
                    </form>
                </div>
            </div>

            {{-- Contact Info --}}
            <div class="space-y-6" data-aos="fade-left">
                {{-- Info Cards --}}
                <div class="bg-gradient-to-br from-emerald-600 to-teal-600 rounded-2xl shadow-xl p-8 text-white">
                    <h3 class="text-2xl font-bold mb-6">Informasi Kontak</h3>
                    
                    <div class="space-y-6">
                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0 w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </div>
                            <div>
                                <div class="font-semibold mb-1">Alamat</div>
                                <div class="text-emerald-100">{!! nl2br(e($siteSettings['contact_address'] ?? 'Jl. Parahyangan Raya No. 123, Bandung, Jawa Barat 40123')) !!}</div>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0 w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            </div>
                            <div>
                                <div class="font-semibold mb-1">Telepon</div>
                                <div class="text-emerald-100">{{ $siteSettings['contact_phone'] ?? '+62 22 1234 5678' }}@if(!empty($siteSettings['contact_whatsapp']))<br>{{ $siteSettings['contact_whatsapp'] }}@endif</div>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0 w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </div>
                            <div>
                                <div class="font-semibold mb-1">Email</div>
                                <div class="text-emerald-100">{{ $siteSettings['contact_email'] ?? 'info@bumiasri.com' }}</div>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0 w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <div>
                                <div class="font-semibold mb-1">Jam Operasional</div>
                                <div class="text-emerald-100">Senin - Jumat: {{ $siteSettings['operating_hours_weekday'] ?? '08:00 - 17:00' }}<br>Sabtu: {{ $siteSettings['operating_hours_saturday'] ?? '09:00 - 15:00' }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Social Media --}}
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg dark:shadow-gray-900/50 border border-gray-100 dark:border-gray-700 p-8">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Ikuti Kami</h3>
                    <div class="grid grid-cols-2 gap-3">
                        @if(!empty($siteSettings['social_facebook']))
                        <a href="{{ $siteSettings['social_facebook'] }}" target="_blank" class="flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl transition-colors font-medium">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                            Facebook
                        </a>
                        @endif
                        @if(!empty($siteSettings['social_instagram']))
                        <a href="{{ $siteSettings['social_instagram'] }}" target="_blank" class="flex items-center justify-center gap-2 bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white py-3 rounded-xl transition-colors font-medium">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                            Instagram
                        </a>
                        @endif
                        @if(!empty($siteSettings['social_whatsapp']))
                        <a href="{{ $siteSettings['social_whatsapp'] }}" target="_blank" class="flex items-center justify-center gap-2 bg-green-600 hover:bg-green-700 text-white py-3 rounded-xl transition-colors font-medium">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                            WhatsApp
                        </a>
                        @endif
                        @if(!empty($siteSettings['social_twitter']))
                        <a href="{{ $siteSettings['social_twitter'] }}" target="_blank" class="flex items-center justify-center gap-2 bg-blue-400 hover:bg-blue-500 text-white py-3 rounded-xl transition-colors font-medium">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                            Twitter
                        </a>
                        @endif
                    </div>
                </div>

                {{-- Quick Stats --}}
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-gradient-to-br from-emerald-50 to-emerald-100 dark:from-emerald-900/30 dark:to-emerald-800/30 rounded-xl p-6 text-center border border-emerald-200 dark:border-emerald-700">
                        <div class="text-3xl font-bold text-emerald-600 dark:text-emerald-400 mb-1">24/7</div>
                        <div class="text-sm text-emerald-700 dark:text-emerald-300">Support</div>
                    </div>
                    <div class="bg-gradient-to-br from-teal-50 to-teal-100 dark:from-teal-900/30 dark:to-teal-800/30 rounded-xl p-6 text-center border border-teal-200 dark:border-teal-700">
                        <div class="text-3xl font-bold text-teal-600 dark:text-teal-400 mb-1">&lt; 1h</div>
                        <div class="text-sm text-teal-700 dark:text-teal-300">Response Time</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function(){
    const status = document.getElementById('contact-status');
    if (status) {
        // scroll into view and briefly highlight
        status.scrollIntoView({ behavior: 'smooth', block: 'center' });
        setTimeout(()=>{
            status.style.transition = 'opacity 400ms';
            status.style.opacity = '0';
            setTimeout(()=> status.remove(), 500);
        }, 6000);
    }
});
</script>
@endpush
