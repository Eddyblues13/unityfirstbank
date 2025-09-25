@extends('layouts.guest2')

@section('title', 'Create an Account')
@section('content')

<div class="flex flex-col lg:flex-row min-h-screen">
    <!-- Left Side - Branding & Illustration (Desktop Only) -->
    <div class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-primary-600 to-primary-800 relative overflow-hidden">
        <!-- Animated Shapes -->
        <div class="absolute inset-0 overflow-hidden opacity-10">
            <div class="absolute top-1/4 left-1/4 w-64 h-64 bg-white rounded-full mix-blend-overlay floating-slow">
            </div>
            <div class="absolute bottom-1/3 right-1/4 w-96 h-96 bg-white rounded-full mix-blend-overlay floating"></div>
            <div class="absolute top-2/3 left-1/3 w-40 h-40 bg-white rounded-full mix-blend-overlay floating-slower">
            </div>

            <!-- Grid pattern -->
            <div class="absolute inset-0"
                style="background-image: radial-gradient(rgba(255,255,255,0.1) 1px, transparent 1px); background-size: 20px 20px;">
            </div>
        </div>

        <!-- Content -->
        <div class="relative flex flex-col justify-center items-center w-full h-full text-white p-12 z-10">
            <!-- Logo -->
            <a href="/" class="mb-6">
                <img src="{{ asset('storage/app/public/' . ($settings->logo ?? 'default-logo.png')) }}" alt="Logo"
                    class="h-16 filter brightness-0 invert">
            </a>

            <!-- Title -->
            <h1 class="text-4xl font-extrabold mb-6 text-center">Start Banking with Us</h1>

            <!-- Description -->
            <p class="text-xl mb-8 max-w-md text-center text-white/80">
                Create your {{ $settings->site_name ?? 'Banking' }} account in just a few steps and enjoy our full range
                of banking services.
            </p>

            <!-- Benefits -->
            <div class="w-full max-w-md space-y-4">
                <div class="flex items-start space-x-3">
                    <div class="flex-shrink-0 w-6 h-6 rounded-full bg-white/20 flex items-center justify-center mt-0.5">
                        <i data-lucide="check" class="h-3 w-3"></i>
                    </div>
                    <p class="text-sm text-white/80">
                        <span class="font-medium text-white">Secure Banking Platform</span> - Industry-leading security
                        protocols to keep your funds safe
                    </p>
                </div>

                <div class="flex items-start space-x-3">
                    <div class="flex-shrink-0 w-6 h-6 rounded-full bg-white/20 flex items-center justify-center mt-0.5">
                        <i data-lucide="check" class="h-3 w-3"></i>
                    </div>
                    <p class="text-sm text-white/80">
                        <span class="font-medium text-white">Fast Transfers</span> - Send and receive money quickly to
                        anyone, anywhere
                    </p>
                </div>

                <div class="flex items-start space-x-3">
                    <div class="flex-shrink-0 w-6 h-6 rounded-full bg-white/20 flex items-center justify-center mt-0.5">
                        <i data-lucide="check" class="h-3 w-3"></i>
                    </div>
                    <p class="text-sm text-white/80">
                        <span class="font-medium text-white">24/7 Account Access</span> - Manage your finances anytime,
                        anywhere on any device
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Side - Registration Form -->
    <div class="w-full lg:w-1/2 flex flex-col justify-center items-center p-6 lg:p-12">
        <div class="w-full max-w-2xl">
            <!-- Mobile Logo -->
            <div class="lg:hidden text-center mb-8">
                <a href="/">
                    <img src="{{ asset('storage/app/public/' . ($settings->logo ?? 'default-logo.png')) }}" alt="Logo"
                        class="h-12 mx-auto">
                </a>
            </div>

            <!-- Alerts -->
            @if (Session::has('status'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded" role="alert">
                <p>{{ session('status') }}</p>
            </div>
            @endif

            @if ($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded" role="alert">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Registration Card -->
            <div x-data="{ 
                step: 1,
                totalSteps: 4,
                formData: {
                    name: '{{ old('name') }}',
                    middlename: '{{ old('middlename') }}',
                    lastname: '{{ old('lastname') }}',
                    username: '{{ old('username') }}',
                    email: '{{ old('email') }}',
                    phone: '{{ old('phone') }}',
                    country: '{{ old('country') }}',
                    currency: '{{ old('currency') }}',
                    accounttype: '{{ old('accounttype') }}',
                    pin: '{{ old('pin') }}',
                    password: '',
                    password_confirmation: '',
                    terms: {{ old('terms') ? 'true' : 'false' }}
                },
                nextStep() {
                    if (this.validateCurrentStep()) {
                        if (this.step < this.totalSteps) {
                            this.step++;
                            window.scrollTo(0, 0);
                        }
                    }
                },
                prevStep() {
                    if (this.step > 1) {
                        this.step--;
                        window.scrollTo(0, 0);
                    }
                },
                validateCurrentStep() {
                    // Basic validation logic based on current step
                    if (this.step === 1) {
                        return this.formData.name && this.formData.lastname && this.formData.username;
                    } else if (this.step === 2) {
                        return this.formData.email && this.formData.phone && this.formData.country && this.formData.currency;
                    } else if (this.step === 3) {
                        return this.formData.accounttype && this.formData.pin;
                    } else if (this.step === 4) {
                        return this.formData.password && this.formData.password_confirmation && this.formData.terms;
                    }
                    return true;
                },
                get progress() {
                    return (this.step / this.totalSteps) * 100;
                }
            }" class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <!-- Progress Header -->
                <div class="bg-gray-50 px-8 py-6 border-b border-gray-200">
                    <div class="flex justify-between items-center mb-2">
                        <h2 class="text-2xl font-bold text-gray-900">Create Your Account</h2>
                        <span class="text-sm font-medium text-gray-500">Step <span x-text="step"></span> of <span
                                x-text="totalSteps"></span></span>
                    </div>

                    <!-- Progress Bar -->
                    <div class="h-2 w-full bg-gray-200 rounded-full overflow-hidden">
                        <div class="h-full bg-primary-600 rounded-full transition-all duration-300 ease-in-out"
                            :style="'width: ' + progress + '%'"></div>
                    </div>

                    <!-- Step Titles -->
                    <div class="flex justify-between mt-2 text-xs text-gray-500">
                        <div class="text-center" :class="{ 'text-primary-600 font-medium': step >= 1 }">Personal Info
                        </div>
                        <div class="text-center" :class="{ 'text-primary-600 font-medium': step >= 2 }">Contact Details
                        </div>
                        <div class="text-center" :class="{ 'text-primary-600 font-medium': step >= 3 }">Account Setup
                        </div>
                        <div class="text-center" :class="{ 'text-primary-600 font-medium': step >= 4 }">Security</div>
                    </div>
                </div>

                <!-- Form Container -->
                <div class="px-8 py-6">
                    <form action="{{ route('register') }}" method="post" id="registration-form">
                        @csrf

                        <!-- Step 1: Personal Information -->
                        <div x-show="step === 1" x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
                            <div class="text-center mb-6">
                                <div
                                    class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-primary-100 mb-4">
                                    <i data-lucide="user" class="h-8 w-8 text-primary-600"></i>
                                </div>
                                <h3 class="text-lg font-medium text-gray-900">Personal Information</h3>
                                <p class="mt-1 text-sm text-gray-500">Please provide your legal name as it appears on
                                    official documents</p>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <!-- First Name -->
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Legal First
                                        Name *</label>
                                    <input type="text" id="name" name="name" x-model="formData.name"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                        placeholder="John" required>
                                    @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Middle Name -->
                                <div>
                                    <label for="middlename" class="block text-sm font-medium text-gray-700 mb-2">Middle
                                        Name</label>
                                    <input type="text" id="middlename" name="middlename" x-model="formData.middlename"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                        placeholder="David">
                                </div>

                                <!-- Last Name -->
                                <div>
                                    <label for="lastname" class="block text-sm font-medium text-gray-700 mb-2">Legal
                                        Last Name *</label>
                                    <input type="text" id="lastname" name="lastname" x-model="formData.lastname"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                        placeholder="Smith" required>
                                    @error('lastname')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Username -->
                                <div>
                                    <label for="username" class="block text-sm font-medium text-gray-700 mb-2">Username
                                        *</label>
                                    <input type="text" id="username" name="username" x-model="formData.username"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                        placeholder="johnsmith123" required>
                                    @error('username')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Step 2: Contact Information -->
                        <div x-show="step === 2" x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
                            <div class="text-center mb-6">
                                <div
                                    class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-primary-100 mb-4">
                                    <i data-lucide="mail" class="h-8 w-8 text-primary-600"></i>
                                </div>
                                <h3 class="text-lg font-medium text-gray-900">Contact Information</h3>
                                <p class="mt-1 text-sm text-gray-500">We'll use these details to communicate with you
                                    about your account</p>
                            </div>

                            <div class="space-y-6 mb-6">
                                <!-- Email -->
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email
                                        Address *</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                                            <i data-lucide="mail" class="h-5 w-5 text-gray-400"></i>
                                        </div>
                                        <input type="email" id="email" name="email" x-model="formData.email"
                                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                            placeholder="john.smith@example.com" required>
                                    </div>
                                    @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Phone -->
                                <div>
                                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number
                                        *</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                                            <i data-lucide="phone" class="h-5 w-5 text-gray-400"></i>
                                        </div>
                                        <input type="tel" id="phone" name="phone" x-model="formData.phone"
                                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                            placeholder="+1 (234) 567-8901" required>
                                    </div>
                                    @error('phone')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Country -->
                                <div>
                                    <label for="country" class="block text-sm font-medium text-gray-700 mb-2">Country
                                        *</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                                            <i data-lucide="globe" class="h-5 w-5 text-gray-400"></i>
                                        </div>
                                        <select id="country" name="country" x-model="formData.country"
                                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 appearance-none"
                                            required>
                                            <option value="" disabled selected>Select your country</option>
                                            @include('auth.countries')
                                        </select>
                                        <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                            <i data-lucide="chevron-down" class="h-5 w-5 text-gray-400"></i>
                                        </div>
                                    </div>
                                    @error('country')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Currency -->
                                <div>
                                    <label for="currency" class="block text-sm font-medium text-gray-700 mb-2">Preferred
                                        Currency *</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                                            <i data-lucide="dollar-sign" class="h-5 w-5 text-gray-400"></i>
                                        </div>
                                        <select id="currency" name="currency" x-model="formData.currency"
                                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 appearance-none"
                                            required>
                                            <option value="" disabled selected>Select your currency</option>
                                            <select id="currency" name="currency" x-model="formData.currency"
                                                class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 appearance-none"
                                                required>
                                                <option value="" disabled selected>Select your currency</option>
                                                <option value="AED" {{ old('currency')=='AED' ? 'selected' : '' }}>AED -
                                                    United Arab Emirates Dirham</option>
                                                <option value="AFN" {{ old('currency')=='AFN' ? 'selected' : '' }}>AFN -
                                                    Afghan Afghani</option>
                                                <option value="ALL" {{ old('currency')=='ALL' ? 'selected' : '' }}>ALL -
                                                    Albanian Lek</option>
                                                <option value="AMD" {{ old('currency')=='AMD' ? 'selected' : '' }}>AMD -
                                                    Armenian Dram</option>
                                                <option value="ANG" {{ old('currency')=='ANG' ? 'selected' : '' }}>ANG -
                                                    Netherlands Antillean Guilder</option>
                                                <option value="AOA" {{ old('currency')=='AOA' ? 'selected' : '' }}>AOA -
                                                    Angolan Kwanza</option>
                                                <option value="ARS" {{ old('currency')=='ARS' ? 'selected' : '' }}>ARS -
                                                    Argentine Peso</option>
                                                <option value="AUD" {{ old('currency')=='AUD' ? 'selected' : '' }}>AUD -
                                                    Australian Dollar</option>
                                                <option value="AWG" {{ old('currency')=='AWG' ? 'selected' : '' }}>AWG -
                                                    Aruban Florin</option>
                                                <option value="AZN" {{ old('currency')=='AZN' ? 'selected' : '' }}>AZN -
                                                    Azerbaijani Manat</option>
                                                <option value="BAM" {{ old('currency')=='BAM' ? 'selected' : '' }}>BAM -
                                                    Bosnia-Herzegovina Convertible Mark</option>
                                                <option value="BBD" {{ old('currency')=='BBD' ? 'selected' : '' }}>BBD -
                                                    Barbadian Dollar</option>
                                                <option value="BDT" {{ old('currency')=='BDT' ? 'selected' : '' }}>BDT -
                                                    Bangladeshi Taka</option>
                                                <option value="BGN" {{ old('currency')=='BGN' ? 'selected' : '' }}>BGN -
                                                    Bulgarian Lev</option>
                                                <option value="BHD" {{ old('currency')=='BHD' ? 'selected' : '' }}>BHD -
                                                    Bahraini Dinar</option>
                                                <option value="BIF" {{ old('currency')=='BIF' ? 'selected' : '' }}>BIF -
                                                    Burundian Franc</option>
                                                <option value="BMD" {{ old('currency')=='BMD' ? 'selected' : '' }}>BMD -
                                                    Bermudian Dollar</option>
                                                <option value="BND" {{ old('currency')=='BND' ? 'selected' : '' }}>BND -
                                                    Brunei Dollar</option>
                                                <option value="BOB" {{ old('currency')=='BOB' ? 'selected' : '' }}>BOB -
                                                    Bolivian Boliviano</option>
                                                <option value="BRL" {{ old('currency')=='BRL' ? 'selected' : '' }}>BRL -
                                                    Brazilian Real</option>
                                                <option value="BSD" {{ old('currency')=='BSD' ? 'selected' : '' }}>BSD -
                                                    Bahamian Dollar</option>
                                                <option value="BTN" {{ old('currency')=='BTN' ? 'selected' : '' }}>BTN -
                                                    Bhutanese Ngultrum</option>
                                                <option value="BWP" {{ old('currency')=='BWP' ? 'selected' : '' }}>BWP -
                                                    Botswanan Pula</option>
                                                <option value="BYN" {{ old('currency')=='BYN' ? 'selected' : '' }}>BYN -
                                                    Belarusian Ruble</option>
                                                <option value="BZD" {{ old('currency')=='BZD' ? 'selected' : '' }}>BZD -
                                                    Belize Dollar</option>
                                                <option value="CAD" {{ old('currency')=='CAD' ? 'selected' : '' }}>CAD -
                                                    Canadian Dollar</option>
                                                <option value="CDF" {{ old('currency')=='CDF' ? 'selected' : '' }}>CDF -
                                                    Congolese Franc</option>
                                                <option value="CHF" {{ old('currency')=='CHF' ? 'selected' : '' }}>CHF -
                                                    Swiss Franc</option>
                                                <option value="CLP" {{ old('currency')=='CLP' ? 'selected' : '' }}>CLP -
                                                    Chilean Peso</option>
                                                <option value="CNY" {{ old('currency')=='CNY' ? 'selected' : '' }}>CNY -
                                                    Chinese Yuan</option>
                                                <option value="COP" {{ old('currency')=='COP' ? 'selected' : '' }}>COP -
                                                    Colombian Peso</option>
                                                <option value="CRC" {{ old('currency')=='CRC' ? 'selected' : '' }}>CRC -
                                                    Costa Rican Colón</option>
                                                <option value="CUP" {{ old('currency')=='CUP' ? 'selected' : '' }}>CUP -
                                                    Cuban Peso</option>
                                                <option value="CVE" {{ old('currency')=='CVE' ? 'selected' : '' }}>CVE -
                                                    Cape Verdean Escudo</option>
                                                <option value="CZK" {{ old('currency')=='CZK' ? 'selected' : '' }}>CZK -
                                                    Czech Koruna</option>
                                                <option value="DJF" {{ old('currency')=='DJF' ? 'selected' : '' }}>DJF -
                                                    Djiboutian Franc</option>
                                                <option value="DKK" {{ old('currency')=='DKK' ? 'selected' : '' }}>DKK -
                                                    Danish Krone</option>
                                                <option value="DOP" {{ old('currency')=='DOP' ? 'selected' : '' }}>DOP -
                                                    Dominican Peso</option>
                                                <option value="DZD" {{ old('currency')=='DZD' ? 'selected' : '' }}>DZD -
                                                    Algerian Dinar</option>
                                                <option value="EGP" {{ old('currency')=='EGP' ? 'selected' : '' }}>EGP -
                                                    Egyptian Pound</option>
                                                <option value="ERN" {{ old('currency')=='ERN' ? 'selected' : '' }}>ERN -
                                                    Eritrean Nakfa</option>
                                                <option value="ETB" {{ old('currency')=='ETB' ? 'selected' : '' }}>ETB -
                                                    Ethiopian Birr</option>
                                                <option value="EUR" {{ old('currency')=='EUR' ? 'selected' : '' }}>EUR -
                                                    Euro</option>
                                                <option value="FJD" {{ old('currency')=='FJD' ? 'selected' : '' }}>FJD -
                                                    Fijian Dollar</option>
                                                <option value="GBP" {{ old('currency')=='GBP' ? 'selected' : '' }}>GBP -
                                                    British Pound</option>
                                                <option value="GEL" {{ old('currency')=='GEL' ? 'selected' : '' }}>GEL -
                                                    Georgian Lari</option>
                                                <option value="GHS" {{ old('currency')=='GHS' ? 'selected' : '' }}>GHS -
                                                    Ghanaian Cedi</option>
                                                <option value="GMD" {{ old('currency')=='GMD' ? 'selected' : '' }}>GMD -
                                                    Gambian Dalasi</option>
                                                <option value="GNF" {{ old('currency')=='GNF' ? 'selected' : '' }}>GNF -
                                                    Guinean Franc</option>
                                                <option value="GTQ" {{ old('currency')=='GTQ' ? 'selected' : '' }}>GTQ -
                                                    Guatemalan Quetzal</option>
                                                <option value="GYD" {{ old('currency')=='GYD' ? 'selected' : '' }}>GYD -
                                                    Guyanaese Dollar</option>
                                                <option value="HKD" {{ old('currency')=='HKD' ? 'selected' : '' }}>HKD -
                                                    Hong Kong Dollar</option>
                                                <option value="HNL" {{ old('currency')=='HNL' ? 'selected' : '' }}>HNL -
                                                    Honduran Lempira</option>
                                                <option value="HRK" {{ old('currency')=='HRK' ? 'selected' : '' }}>HRK -
                                                    Croatian Kuna</option>
                                                <option value="HTG" {{ old('currency')=='HTG' ? 'selected' : '' }}>HTG -
                                                    Haitian Gourde</option>
                                                <option value="HUF" {{ old('currency')=='HUF' ? 'selected' : '' }}>HUF -
                                                    Hungarian Forint</option>
                                                <option value="IDR" {{ old('currency')=='IDR' ? 'selected' : '' }}>IDR -
                                                    Indonesian Rupiah</option>
                                                <option value="ILS" {{ old('currency')=='ILS' ? 'selected' : '' }}>ILS -
                                                    Israeli New Shekel</option>
                                                <option value="INR" {{ old('currency')=='INR' ? 'selected' : '' }}>INR -
                                                    Indian Rupee</option>
                                                <option value="IQD" {{ old('currency')=='IQD' ? 'selected' : '' }}>IQD -
                                                    Iraqi Dinar</option>
                                                <option value="IRR" {{ old('currency')=='IRR' ? 'selected' : '' }}>IRR -
                                                    Iranian Rial</option>
                                                <option value="ISK" {{ old('currency')=='ISK' ? 'selected' : '' }}>ISK -
                                                    Icelandic Króna</option>
                                                <option value="JMD" {{ old('currency')=='JMD' ? 'selected' : '' }}>JMD -
                                                    Jamaican Dollar</option>
                                                <option value="JOD" {{ old('currency')=='JOD' ? 'selected' : '' }}>JOD -
                                                    Jordanian Dinar</option>
                                                <option value="JPY" {{ old('currency')=='JPY' ? 'selected' : '' }}>JPY -
                                                    Japanese Yen</option>
                                                <option value="KES" {{ old('currency')=='KES' ? 'selected' : '' }}>KES -
                                                    Kenyan Shilling</option>
                                                <option value="KGS" {{ old('currency')=='KGS' ? 'selected' : '' }}>KGS -
                                                    Kyrgystani Som</option>
                                                <option value="KHR" {{ old('currency')=='KHR' ? 'selected' : '' }}>KHR -
                                                    Cambodian Riel</option>
                                                <option value="KMF" {{ old('currency')=='KMF' ? 'selected' : '' }}>KMF -
                                                    Comorian Franc</option>
                                                <option value="KRW" {{ old('currency')=='KRW' ? 'selected' : '' }}>KRW -
                                                    South Korean Won</option>
                                                <option value="KWD" {{ old('currency')=='KWD' ? 'selected' : '' }}>KWD -
                                                    Kuwaiti Dinar</option>
                                                <option value="KYD" {{ old('currency')=='KYD' ? 'selected' : '' }}>KYD -
                                                    Cayman Islands Dollar</option>
                                                <option value="KZT" {{ old('currency')=='KZT' ? 'selected' : '' }}>KZT -
                                                    Kazakhstani Tenge</option>
                                                <option value="LAK" {{ old('currency')=='LAK' ? 'selected' : '' }}>LAK -
                                                    Laotian Kip</option>
                                                <option value="LBP" {{ old('currency')=='LBP' ? 'selected' : '' }}>LBP -
                                                    Lebanese Pound</option>
                                                <option value="LKR" {{ old('currency')=='LKR' ? 'selected' : '' }}>LKR -
                                                    Sri Lankan Rupee</option>
                                                <option value="LRD" {{ old('currency')=='LRD' ? 'selected' : '' }}>LRD -
                                                    Liberian Dollar</option>
                                                <option value="LSL" {{ old('currency')=='LSL' ? 'selected' : '' }}>LSL -
                                                    Lesotho Loti</option>
                                                <option value="LYD" {{ old('currency')=='LYD' ? 'selected' : '' }}>LYD -
                                                    Libyan Dinar</option>
                                                <option value="MAD" {{ old('currency')=='MAD' ? 'selected' : '' }}>MAD -
                                                    Moroccan Dirham</option>
                                                <option value="MDL" {{ old('currency')=='MDL' ? 'selected' : '' }}>MDL -
                                                    Moldovan Leu</option>
                                                <option value="MGA" {{ old('currency')=='MGA' ? 'selected' : '' }}>MGA -
                                                    Malagasy Ariary</option>
                                                <option value="MKD" {{ old('currency')=='MKD' ? 'selected' : '' }}>MKD -
                                                    Macedonian Denar</option>
                                                <option value="MMK" {{ old('currency')=='MMK' ? 'selected' : '' }}>MMK -
                                                    Myanmar Kyat</option>
                                                <option value="MNT" {{ old('currency')=='MNT' ? 'selected' : '' }}>MNT -
                                                    Mongolian Tugrik</option>
                                                <option value="MOP" {{ old('currency')=='MOP' ? 'selected' : '' }}>MOP -
                                                    Macanese Pataca</option>
                                                <option value="MRU" {{ old('currency')=='MRU' ? 'selected' : '' }}>MRU -
                                                    Mauritanian Ouguiya</option>
                                                <option value="MUR" {{ old('currency')=='MUR' ? 'selected' : '' }}>MUR -
                                                    Mauritian Rupee</option>
                                                <option value="MVR" {{ old('currency')=='MVR' ? 'selected' : '' }}>MVR -
                                                    Maldivian Rufiyaa</option>
                                                <option value="MWK" {{ old('currency')=='MWK' ? 'selected' : '' }}>MWK -
                                                    Malawian Kwacha</option>
                                                <option value="MXN" {{ old('currency')=='MXN' ? 'selected' : '' }}>MXN -
                                                    Mexican Peso</option>
                                                <option value="MYR" {{ old('currency')=='MYR' ? 'selected' : '' }}>MYR -
                                                    Malaysian Ringgit</option>
                                                <option value="MZN" {{ old('currency')=='MZN' ? 'selected' : '' }}>MZN -
                                                    Mozambican Metical</option>
                                                <option value="NAD" {{ old('currency')=='NAD' ? 'selected' : '' }}>NAD -
                                                    Namibian Dollar</option>
                                                <option value="NGN" {{ old('currency')=='NGN' ? 'selected' : '' }}>NGN -
                                                    Nigerian Naira</option>
                                                <option value="NIO" {{ old('currency')=='NIO' ? 'selected' : '' }}>NIO -
                                                    Nicaraguan Córdoba</option>
                                                <option value="NOK" {{ old('currency')=='NOK' ? 'selected' : '' }}>NOK -
                                                    Norwegian Krone</option>
                                                <option value="NPR" {{ old('currency')=='NPR' ? 'selected' : '' }}>NPR -
                                                    Nepalese Rupee</option>
                                                <option value="NZD" {{ old('currency')=='NZD' ? 'selected' : '' }}>NZD -
                                                    New Zealand Dollar</option>
                                                <option value="OMR" {{ old('currency')=='OMR' ? 'selected' : '' }}>OMR -
                                                    Omani Rial</option>
                                                <option value="PAB" {{ old('currency')=='PAB' ? 'selected' : '' }}>PAB -
                                                    Panamanian Balboa</option>
                                                <option value="PEN" {{ old('currency')=='PEN' ? 'selected' : '' }}>PEN -
                                                    Peruvian Sol</option>
                                                <option value="PGK" {{ old('currency')=='PGK' ? 'selected' : '' }}>PGK -
                                                    Papua New Guinean Kina</option>
                                                <option value="PHP" {{ old('currency')=='PHP' ? 'selected' : '' }}>PHP -
                                                    Philippine Peso</option>
                                                <option value="PKR" {{ old('currency')=='PKR' ? 'selected' : '' }}>PKR -
                                                    Pakistani Rupee</option>
                                                <option value="PLN" {{ old('currency')=='PLN' ? 'selected' : '' }}>PLN -
                                                    Polish Zloty</option>
                                                <option value="PYG" {{ old('currency')=='PYG' ? 'selected' : '' }}>PYG -
                                                    Paraguayan Guarani</option>
                                                <option value="QAR" {{ old('currency')=='QAR' ? 'selected' : '' }}>QAR -
                                                    Qatari Rial</option>
                                                <option value="RON" {{ old('currency')=='RON' ? 'selected' : '' }}>RON -
                                                    Romanian Leu</option>
                                                <option value="RSD" {{ old('currency')=='RSD' ? 'selected' : '' }}>RSD -
                                                    Serbian Dinar</option>
                                                <option value="RUB" {{ old('currency')=='RUB' ? 'selected' : '' }}>RUB -
                                                    Russian Ruble</option>
                                                <option value="RWF" {{ old('currency')=='RWF' ? 'selected' : '' }}>RWF -
                                                    Rwandan Franc</option>
                                                <option value="SAR" {{ old('currency')=='SAR' ? 'selected' : '' }}>SAR -
                                                    Saudi Riyal</option>
                                                <option value="SBD" {{ old('currency')=='SBD' ? 'selected' : '' }}>SBD -
                                                    Solomon Islands Dollar</option>
                                                <option value="SCR" {{ old('currency')=='SCR' ? 'selected' : '' }}>SCR -
                                                    Seychellois Rupee</option>
                                                <option value="SDG" {{ old('currency')=='SDG' ? 'selected' : '' }}>SDG -
                                                    Sudanese Pound</option>
                                                <option value="SEK" {{ old('currency')=='SEK' ? 'selected' : '' }}>SEK -
                                                    Swedish Krona</option>
                                                <option value="SGD" {{ old('currency')=='SGD' ? 'selected' : '' }}>SGD -
                                                    Singapore Dollar</option>
                                                <option value="SHP" {{ old('currency')=='SHP' ? 'selected' : '' }}>SHP -
                                                    Saint Helena Pound</option>
                                                <option value="SLL" {{ old('currency')=='SLL' ? 'selected' : '' }}>SLL -
                                                    Sierra Leonean Leone</option>
                                                <option value="SOS" {{ old('currency')=='SOS' ? 'selected' : '' }}>SOS -
                                                    Somali Shilling</option>
                                                <option value="SRD" {{ old('currency')=='SRD' ? 'selected' : '' }}>SRD -
                                                    Surinamese Dollar</option>
                                                <option value="SSP" {{ old('currency')=='SSP' ? 'selected' : '' }}>SSP -
                                                    South Sudanese Pound</option>
                                                <option value="STN" {{ old('currency')=='STN' ? 'selected' : '' }}>STN -
                                                    São Tomé and Príncipe Dobra</option>
                                                <option value="SVC" {{ old('currency')=='SVC' ? 'selected' : '' }}>SVC -
                                                    Salvadoran Colón</option>
                                                <option value="SYP" {{ old('currency')=='SYP' ? 'selected' : '' }}>SYP -
                                                    Syrian Pound</option>
                                                <option value="SZL" {{ old('currency')=='SZL' ? 'selected' : '' }}>SZL -
                                                    Swazi Lilangeni</option>
                                                <option value="THB" {{ old('currency')=='THB' ? 'selected' : '' }}>THB -
                                                    Thai Baht</option>
                                                <option value="TJS" {{ old('currency')=='TJS' ? 'selected' : '' }}>TJS -
                                                    Tajikistani Somoni</option>
                                                <option value="TMT" {{ old('currency')=='TMT' ? 'selected' : '' }}>TMT -
                                                    Turkmenistani Manat</option>
                                                <option value="TND" {{ old('currency')=='TND' ? 'selected' : '' }}>TND -
                                                    Tunisian Dinar</option>
                                                <option value="TOP" {{ old('currency')=='TOP' ? 'selected' : '' }}>TOP -
                                                    Tongan Paʻanga</option>
                                                <option value="TRY" {{ old('currency')=='TRY' ? 'selected' : '' }}>TRY -
                                                    Turkish Lira</option>
                                                <option value="TTD" {{ old('currency')=='TTD' ? 'selected' : '' }}>TTD -
                                                    Trinidad and Tobago Dollar</option>
                                                <option value="TWD" {{ old('currency')=='TWD' ? 'selected' : '' }}>TWD -
                                                    New Taiwan Dollar</option>
                                                <option value="TZS" {{ old('currency')=='TZS' ? 'selected' : '' }}>TZS -
                                                    Tanzanian Shilling</option>
                                                <option value="UAH" {{ old('currency')=='UAH' ? 'selected' : '' }}>UAH -
                                                    Ukrainian Hryvnia</option>
                                                <option value="UGX" {{ old('currency')=='UGX' ? 'selected' : '' }}>UGX -
                                                    Ugandan Shilling</option>
                                                <option value="USD" {{ old('currency')=='USD' ? 'selected' : '' }}>USD -
                                                    US Dollar</option>
                                                <option value="UYU" {{ old('currency')=='UYU' ? 'selected' : '' }}>UYU -
                                                    Uruguayan Peso</option>
                                                <option value="UZS" {{ old('currency')=='UZS' ? 'selected' : '' }}>UZS -
                                                    Uzbekistan Som</option>
                                                <option value="VES" {{ old('currency')=='VES' ? 'selected' : '' }}>VES -
                                                    Venezuelan Bolívar Soberano</option>
                                                <option value="VND" {{ old('currency')=='VND' ? 'selected' : '' }}>VND -
                                                    Vietnamese Dong</option>
                                                <option value="VUV" {{ old('currency')=='VUV' ? 'selected' : '' }}>VUV -
                                                    Vanuatu Vatu</option>
                                                <option value="WST" {{ old('currency')=='WST' ? 'selected' : '' }}>WST -
                                                    Samoan Tala</option>
                                                <option value="XAF" {{ old('currency')=='XAF' ? 'selected' : '' }}>XAF -
                                                    Central African CFA Franc</option>
                                                <option value="XCD" {{ old('currency')=='XCD' ? 'selected' : '' }}>XCD -
                                                    East Caribbean Dollar</option>
                                                <option value="XOF" {{ old('currency')=='XOF' ? 'selected' : '' }}>XOF -
                                                    West African CFA Franc</option>
                                                <option value="XPF" {{ old('currency')=='XPF' ? 'selected' : '' }}>XPF -
                                                    CFP Franc</option>
                                                <option value="YER" {{ old('currency')=='YER' ? 'selected' : '' }}>YER -
                                                    Yemeni Rial</option>
                                                <option value="ZAR" {{ old('currency')=='ZAR' ? 'selected' : '' }}>ZAR -
                                                    South African Rand</option>
                                                <option value="ZMW" {{ old('currency')=='ZMW' ? 'selected' : '' }}>ZMW -
                                                    Zambian Kwacha</option>
                                                <option value="ZWL" {{ old('currency')=='ZWL' ? 'selected' : '' }}>ZWL -
                                                    Zimbabwean Dollar</option>
                                            </select>

                                            <div class=" absolute inset-y-0 right-0 flex items-center pr-3">
                                                <i data-lucide="chevron-down" class="h-5 w-5 text-gray-400"></i>
                                            </div>
                                    </div>
                                    @error('currency')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Step 3: Account Setup -->
                        <div x-show="step === 3" x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
                            <div class="text-center mb-6">
                                <div
                                    class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-primary-100 mb-4">
                                    <i data-lucide="landmark" class="h-8 w-8 text-primary-600"></i>
                                </div>
                                <h3 class="text-lg font-medium text-gray-900">Account Setup</h3>
                                <p class="mt-1 text-sm text-gray-500">Choose your account type and set up your
                                    transaction PIN</p>
                            </div>

                            <div class="space-y-6 mb-6">
                                <!-- Account Type -->
                                <div>
                                    <label for="accounttype"
                                        class="block text-sm font-medium text-gray-700 mb-2">Account Type
                                        *</label>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <label @click="formData.accounttype = 'Checking Account'"
                                            class="relative block cursor-pointer">
                                            <input type="radio" name="accounttype" value="Checking Account"
                                                x-model="formData.accounttype" class="sr-only" {{
                                                old('accounttype')=='Checking Account' ? 'checked' : '' }}>
                                            <div class="border rounded-lg p-4 transition-all"
                                                :class="formData.accounttype === 'Checking Account' ? 'border-primary-500 bg-primary-50 ring-2 ring-primary-500' : 'border-gray-300 hover:border-primary-300'">
                                                <div class="flex items-start">
                                                    <div class="flex-shrink-0">
                                                        <div
                                                            class="w-10 h-10 bg-primary-100 rounded-full flex items-center justify-center">
                                                            <i data-lucide="credit-card"
                                                                class="h-5 w-5 text-primary-600"></i>
                                                        </div>
                                                    </div>
                                                    <div class="ml-3">
                                                        <h4 class="text-sm font-medium text-gray-900">Checking Account
                                                        </h4>
                                                        <p class="text-xs text-gray-500">Perfect for daily transactions
                                                            and bill payments</p>
                                                    </div>
                                                </div>
                                                <div x-show="formData.accounttype === 'Checking Account'"
                                                    class="absolute top-2 right-2 w-5 h-5 bg-primary-500 rounded-full flex items-center justify-center">
                                                    <i data-lucide="check" class="h-3 w-3 text-white"></i>
                                                </div>
                                            </div>
                                        </label>

                                        <label @click="formData.accounttype = 'Savings Account'"
                                            class="relative block cursor-pointer">
                                            <input type="radio" name="accounttype" value="Savings Account"
                                                x-model="formData.accounttype" class="sr-only" {{
                                                old('accounttype')=='Savings Account' ? 'checked' : '' }}>
                                            <div class="border rounded-lg p-4 transition-all"
                                                :class="formData.accounttype === 'Savings Account' ? 'border-primary-500 bg-primary-50 ring-2 ring-primary-500' : 'border-gray-300 hover:border-primary-300'">
                                                <div class="flex items-start">
                                                    <div class="flex-shrink-0">
                                                        <div
                                                            class="w-10 h-10 bg-primary-100 rounded-full flex items-center justify-center">
                                                            <i data-lucide="piggy-bank"
                                                                class="h-5 w-5 text-primary-600"></i>
                                                        </div>
                                                    </div>
                                                    <div class="ml-3">
                                                        <h4 class="text-sm font-medium text-gray-900">Savings Account
                                                        </h4>
                                                        <p class="text-xs text-gray-500">Earn interest on your deposits
                                                        </p>
                                                    </div>
                                                </div>
                                                <div x-show="formData.accounttype === 'Savings Account'"
                                                    class="absolute top-2 right-2 w-5 h-5 bg-primary-500 rounded-full flex items-center justify-center">
                                                    <i data-lucide="check" class="h-3 w-3 text-white"></i>
                                                </div>
                                            </div>
                                        </label>
                                    </div>

                                    <!-- Additional account types dropdown for more options -->
                                    <div class="mt-4" x-data="{ open: false }">
                                        <button type="button" @click="open = !open"
                                            class="w-full text-left flex items-center justify-between text-sm text-primary-600 hover:text-primary-700 focus:outline-none">
                                            <span>Show more account types</span>
                                            <i data-lucide="chevron-down" class="h-4 w-4"
                                                :class="{'transform rotate-180': open}"></i>
                                        </button>

                                        <div x-show="open" x-transition class="mt-2 space-y-2">
                                            <template x-for="(type, index) in [
                                                {value: 'Fixed Deposit Account', label: 'Fixed Deposit Account', desc: 'Highest interest rates for fixed terms', icon: 'calendar'},
                                                {value: 'Current Account', label: 'Current Account', desc: 'For everyday business transactions', icon: 'briefcase'},
                                                {value: 'Crypto Currency Account', label: 'Crypto Currency Account', desc: 'For digital currency management', icon: 'bitcoin'},
                                                {value: 'Business Account', label: 'Business Account', desc: 'For small to medium businesses', icon: 'building'},
                                                {value: 'Non Resident Account', label: 'Non Resident Account', desc: 'For international customers', icon: 'globe'},
                                                {value: 'Cooperate Business Account', label: 'Cooperate Business Account', desc: 'For large corporations', icon: 'landmark'},
                                                {value: 'Investment Account', label: 'Investment Account', desc: 'For stocks and securities', icon: 'trending-up'}
                                            ]" :key="index">
                                                <label @click="formData.accounttype = type.value"
                                                    class="relative block cursor-pointer">
                                                    <input type="radio" name="accounttype" :value="type.value"
                                                        x-model="formData.accounttype" class="sr-only" {{
                                                        old('accounttype')=='type.value' ? 'checked' : '' }}>
                                                    <div class="border rounded-lg p-4 transition-all"
                                                        :class="formData.accounttype === type.value ? 'border-primary-500 bg-primary-50 ring-2 ring-primary-500' : 'border-gray-300 hover:border-primary-300'">
                                                        <div class="flex items-start">
                                                            <div class="flex-shrink-0">
                                                                <div
                                                                    class="w-10 h-10 bg-primary-100 rounded-full flex items-center justify-center">
                                                                    <i :data-lucide="type.icon"
                                                                        class="h-5 w-5 text-primary-600"></i>
                                                                </div>
                                                            </div>
                                                            <div class="ml-3">
                                                                <h4 class="text-sm font-medium text-gray-900"
                                                                    x-text="type.label"></h4>
                                                                <p class="text-xs text-gray-500" x-text="type.desc"></p>
                                                            </div>
                                                        </div>
                                                        <div x-show="formData.accounttype === type.value"
                                                            class="absolute top-2 right-2 w-5 h-5 bg-primary-500 rounded-full flex items-center justify-center">
                                                            <i data-lucide="check" class="h-3 w-3 text-white"></i>
                                                        </div>
                                                    </div>
                                                </label>
                                            </template>
                                        </div>
                                    </div>
                                    @error('accounttype')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Transaction PIN -->
                                <div>
                                    <label for="pin" class="block text-sm font-medium text-gray-700 mb-2">Transaction
                                        PIN (4 digits) *</label>
                                    <div class="relative" x-data="{ showPin: false }">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                                            <i data-lucide="key" class="h-5 w-5 text-gray-400"></i>
                                        </div>
                                        <input :type="showPin ? 'text' : 'password'" id="pin" name="pin"
                                            x-model="formData.pin"
                                            class="w-full pl-10 pr-10 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                            placeholder="••••" maxlength="4" pattern="[0-9]{4}" required>
                                        <button type="button" @click="showPin = !showPin"
                                            class="absolute inset-y-0 right-0 flex items-center pr-3">
                                            <i data-lucide="eye" class="h-5 w-5 text-gray-400" x-show="!showPin"></i>
                                            <i data-lucide="eye-off" class="h-5 w-5 text-gray-400" x-show="showPin"></i>
                                        </button>
                                    </div>
                                    <p class="mt-1 text-xs text-gray-500">Your PIN will be required to authorize
                                        transactions</p>
                                    @error('pin')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Step 4: Security -->
                        <div x-show="step === 4" x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
                            <div class="text-center mb-6">
                                <div
                                    class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-primary-100 mb-4">
                                    <i data-lucide="shield" class="h-8 w-8 text-primary-600"></i>
                                </div>
                                <h3 class="text-lg font-medium text-gray-900">Secure Your Account</h3>
                                <p class="mt-1 text-sm text-gray-500">Create a strong password to protect your account
                                </p>
                            </div>

                            <div class="space-y-6 mb-6">
                                <!-- Password -->
                                <div x-data="{ showPassword: false }">
                                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password
                                        *</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                                            <i data-lucide="lock" class="h-5 w-5 text-gray-400"></i>
                                        </div>
                                        <input :type="showPassword ? 'text' : 'password'" id="password" name="password"
                                            x-model="formData.password"
                                            class="w-full pl-10 pr-10 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                            placeholder="••••••••" required>
                                        <button type="button" @click="showPassword = !showPassword"
                                            class="absolute inset-y-0 right-0 flex items-center pr-3">
                                            <i data-lucide="eye" class="h-5 w-5 text-gray-400"
                                                x-show="!showPassword"></i>
                                            <i data-lucide="eye-off" class="h-5 w-5 text-gray-400"
                                                x-show="showPassword"></i>
                                        </button>
                                    </div>
                                    @error('password')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror

                                    <!-- Password Strength Meter -->
                                    <div class="mt-2" x-data="{ 
                                        get strength() {
                                            let score = 0;
                                            
                                            // Length check
                                            if (formData.password.length > 7) score += 1;
                                            if (formData.password.length > 10) score += 1;
                                            
                                            // Complexity checks
                                            if (/[A-Z]/.test(formData.password)) score += 1;
                                            if (/[0-9]/.test(formData.password)) score += 1;
                                            if (/[^A-Za-z0-9]/.test(formData.password)) score += 1;
                                            
                                            return score;
                                        },
                                        get strengthLabel() {
                                            const labels = ['Very Weak', 'Weak', 'Fair', 'Good', 'Strong', 'Very Strong'];
                                            return labels[this.strength] || 'Very Weak';
                                        },
                                        get strengthColor() {
                                            const colors = [
                                                'bg-red-500', // Very Weak
                                                'bg-red-500', // Weak
                                                'bg-yellow-500', // Fair
                                                'bg-yellow-500', // Good
                                                'bg-green-500', // Strong
                                                'bg-green-500'  // Very Strong
                                            ];
                                            return colors[this.strength] || 'bg-red-500';
                                        }
                                    }" x-show="formData.password.length > 0">
                                        <div class="flex justify-between items-center mb-1">
                                            <p class="text-xs text-gray-500">Password strength: <span
                                                    x-text="strengthLabel" :class="{
                                                'text-red-600': strength < 2,
                                                'text-yellow-600': strength >= 2 && strength < 4,
                                                'text-green-600': strength >= 4
                                            }"></span></p>
                                        </div>
                                        <div class="w-full h-2 bg-gray-200 rounded-full overflow-hidden">
                                            <div class="h-full transition-all duration-300 ease-in-out"
                                                :class="strengthColor" :style="`width: ${(strength / 5) * 100}%`"></div>
                                        </div>
                                        <ul class="mt-2 space-y-1 text-xs text-gray-500">
                                            <li class="flex items-center"
                                                :class="{ 'text-green-600': formData.password.length > 7 }">
                                                <i data-lucide="check-circle" class="h-3 w-3 mr-1"
                                                    x-show="formData.password.length > 7"></i>
                                                <i data-lucide="circle" class="h-3 w-3 mr-1"
                                                    x-show="formData.password.length <= 7"></i>
                                                At least 8 characters
                                            </li>
                                            <li class="flex items-center"
                                                :class="{ 'text-green-600': /[A-Z]/.test(formData.password) }">
                                                <i data-lucide="check-circle" class="h-3 w-3 mr-1"
                                                    x-show="/[A-Z]/.test(formData.password)"></i>
                                                <i data-lucide="circle" class="h-3 w-3 mr-1"
                                                    x-show="!/[A-Z]/.test(formData.password)"></i>
                                                At least one uppercase letter
                                            </li>
                                            <li class="flex items-center"
                                                :class="{ 'text-green-600': /[0-9]/.test(formData.password) }">
                                                <i data-lucide="check-circle" class="h-3 w-3 mr-1"
                                                    x-show="/[0-9]/.test(formData.password)"></i>
                                                <i data-lucide="circle" class="h-3 w-3 mr-1"
                                                    x-show="!/[0-9]/.test(formData.password)"></i>
                                                At least one number
                                            </li>
                                            <li class="flex items-center"
                                                :class="{ 'text-green-600': /[^A-Za-z0-9]/.test(formData.password) }">
                                                <i data-lucide="check-circle" class="h-3 w-3 mr-1"
                                                    x-show="/[^A-Za-z0-9]/.test(formData.password)"></i>
                                                <i data-lucide="circle" class="h-3 w-3 mr-1"
                                                    x-show="!/[^A-Za-z0-9]/.test(formData.password)"></i>
                                                At least one special character
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <!-- Confirm Password -->
                                <div x-data="{ showPassword: false }">
                                    <label for="password_confirmation"
                                        class="block text-sm font-medium text-gray-700 mb-2">Confirm Password *</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                                            <i data-lucide="lock" class="h-5 w-5 text-gray-400"></i>
                                        </div>
                                        <input :type="showPassword ? 'text' : 'password'" id="password_confirmation"
                                            name="password_confirmation" x-model="formData.password_confirmation"
                                            class="w-full pl-10 pr-10 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                            placeholder="••••••••" required>
                                        <button type="button" @click="showPassword = !showPassword"
                                            class="absolute inset-y-0 right-0 flex items-center pr-3">
                                            <i data-lucide="eye" class="h-5 w-5 text-gray-400"
                                                x-show="!showPassword"></i>
                                            <i data-lucide="eye-off" class="h-5 w-5 text-gray-400"
                                                x-show="showPassword"></i>
                                        </button>
                                    </div>
                                    <p class="mt-1 text-sm" x-show="formData.password && formData.password_confirmation"
                                        :class="formData.password === formData.password_confirmation ? 'text-green-600' : 'text-red-600'">
                                        <span x-show="formData.password === formData.password_confirmation">
                                            <i data-lucide="check" class="inline h-3 w-3"></i> Passwords match
                                        </span>
                                        <span x-show="formData.password !== formData.password_confirmation">
                                            <i data-lucide="x" class="inline h-3 w-3"></i> Passwords do not match
                                        </span>
                                    </p>
                                </div>

                                <!-- Terms and Conditions -->
                                <div>
                                    <label class="flex items-start">
                                        <input type="checkbox" id="terms" name="terms" x-model="formData.terms"
                                            class="rounded border-gray-300 text-primary-600 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 mt-1"
                                            {{ old('terms') ? 'checked' : '' }} required>
                                        <span class="ml-2 text-sm text-gray-600">
                                            I agree to the <a href="/terms" target="_blank"
                                                class="text-primary-600 hover:text-primary-500 underline">Terms of
                                                Service</a> and <a href="/privacy" target="_blank"
                                                class="text-primary-600 hover:text-primary-500 underline">Privacy
                                                Policy</a>
                                        </span>
                                    </label>
                                    @error('terms')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Step Navigation -->
                        <div class="flex justify-between pt-4 border-t border-gray-200">
                            <button type="button" x-show="step > 1" @click="prevStep"
                                class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                <i data-lucide="chevron-left" class="h-4 w-4 mr-2"></i>
                                Previous
                            </button>
                            <div x-show="step === 1"></div>

                            <button type="button" x-show="step < totalSteps" @click="nextStep"
                                class="inline-flex items-center px-4 py-2 border border-transparent rounded-md font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                Next
                                <i data-lucide="chevron-right" class="h-4 w-4 ml-2"></i>
                            </button>

                            <button type="submit" x-show="step === totalSteps"
                                class="inline-flex items-center px-4 py-2 border border-transparent rounded-md font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                <i data-lucide="check" class="h-4 w-4 mr-2"></i>
                                Create Account
                            </button>
                        </div>

                        <!-- Hidden form fields to ensure data is submitted even if user doesn't visit every step -->
                        <input type="hidden" name="name" :value="formData.name">
                        <input type="hidden" name="middlename" :value="formData.middlename">
                        <input type="hidden" name="lastname" :value="formData.lastname">
                        <input type="hidden" name="username" :value="formData.username">
                        <input type="hidden" name="email" :value="formData.email">
                        <input type="hidden" name="phone" :value="formData.phone">
                        <input type="hidden" name="country" :value="formData.country">
                        <input type="hidden" name="currency" :value="formData.currency">
                        <input type="hidden" name="accounttype" :value="formData.accounttype">
                        <input type="hidden" name="pin" :value="formData.pin">
                        <input type="hidden" name="password" :value="formData.password">
                        <input type="hidden" name="password_confirmation" :value="formData.password_confirmation">
                    </form>
                </div>

                <!-- Login Link -->
                <div class="text-center mt-4 pb-4">
                    <p class="text-sm text-gray-600">
                        Already have an account?
                        <a href="{{ route('login') }}" class="text-primary-600 hover:text-primary-500 font-medium">
                            Sign in instead
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    function restrictSpaces(event) {
        if (event.keyCode === 32) {
            return false;
        }
    }
    
    // When the DOM is loaded
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Lucide icons
        lucide.createIcons();
        
        // Prevent spaces in username field
        const usernameInput = document.getElementById('username');
        if (usernameInput) {
            usernameInput.addEventListener('keypress', restrictSpaces);
        }
        
        // Restrict PIN to numbers only
        const pinInput = document.getElementById('pin');
        if (pinInput) {
            pinInput.addEventListener('keypress', function(event) {
                const charCode = (event.which) ? event.which : event.keyCode;
                if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                    event.preventDefault();
                    return false;
                }
                return true;
            });
        }
    });
</script>
@endsection