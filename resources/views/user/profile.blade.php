@extends('layouts.dash2')
@section('title', $title)
@section('content')

<div x-data="{ 
    showProfilePictureModal: false,
    showTransactionPinModal: false
}">
    <!-- Alerts -->
    <x-danger-alert />
    <x-success-alert />
    <x-error-alert />

    <!-- Page Header with Breadcrumbs -->
    <div class="flex flex-col mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 mb-1">Account Settings</h1>
            <div class="flex items-center text-sm text-gray-500">
                <a href="{{ route('dashboard') }}" class="hover:text-primary-600">Dashboard</a>
                <i data-lucide="chevron-right" class="h-4 w-4 mx-2"></i>
                <span class="font-medium text-gray-700">Settings</span>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        <!-- Left Column - Profile Card and Navigation -->
        <div class="lg:col-span-4">
            <div class="bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden mb-6">
                <!-- Profile Photo and Name Header -->
                <div class="relative bg-gradient-to-r from-primary-600 to-primary-700 px-6 py-8 flex flex-col items-center">
                    <!-- Profile Photo -->
                    <div class="relative mb-3">
                        <div class="h-24 w-24 rounded-full border-4 border-white/50 overflow-hidden bg-white shadow-md">
                            <img 
                                src="{{$settings->site_address}}/storage/app/public/photos/{{Auth::user()->profile_photo_path}}" 
                                class="h-full w-full object-cover"
                                alt="{{ Auth::user()->name }}"
                                onerror="this.src='https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=random'"
                            />
                        </div>
                        <button 
                            @click="showProfilePictureModal = true"
                            class="absolute -bottom-1 -right-1 h-8 w-8 rounded-full bg-white shadow-md flex items-center justify-center hover:bg-gray-100 transition-colors"
                        >
                            <i data-lucide="camera" class="h-4 w-4 text-primary-600"></i>
                        </button>
                    </div>
                    
                    <!-- User Name -->
                    <h2 class="text-xl font-bold text-white">{{ Auth::user()->name }} {{ Auth::user()->lastname }}</h2>
                    <p class="text-white/80 text-sm">Account #{{ Auth::user()->usernumber }}</p>
                    
                    <!-- Wave decoration at the bottom -->
                    <div class="absolute bottom-0 left-0 right-0">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none" class="h-6 w-full text-white fill-current">
                            <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25"></path>
                            <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5"></path>
                            <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z"></path>
                        </svg>
                    </div>
                </div>
                
                <!-- Navigation Menu -->
                <div class="p-4">
                    <nav class="space-y-1">
                        <a 
                            href="{{ route('profile') }}" 
                            class="flex items-center px-4 py-3 rounded-lg bg-primary-50 text-gray-700 font-medium"
                        >
                            <i data-lucide="user" class="h-5 w-5 mr-3 text-gray-600"></i>
                            <span>Profile Information</span>
                        </a>
                        
                        <a 
                            href="{{ route('editpass') }}" 
                            class="flex items-center px-4 py-3 rounded-lg text-gray-700 hover:bg-gray-50 font-medium"
                        >
                            <i data-lucide="shield" class="h-5 w-5 mr-3 text-gray-500"></i>
                            <span>Security Settings</span>
                        </a>
                        
                        <button 
                            @click="showTransactionPinModal = true"
                            class="w-full flex items-center px-4 py-3 rounded-lg text-gray-700 hover:bg-gray-50 font-medium text-left"
                        >
                            <i data-lucide="key" class="h-5 w-5 mr-3 text-gray-600"></i>
                            <span>Transaction PIN</span>
                        </button>
                    </nav>
                </div>
            </div>
            
            <!-- Contact Support Card -->
            <div class="bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden p-5">
                <div class="flex items-center mb-4">
                    <div class="h-10 w-10 rounded-full bg-primary-100 flex items-center justify-center mr-3">
                        <i data-lucide="help-circle" class="h-5 w-5 text-gray-600"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">Need Help?</h3>
                </div>
                <p class="text-sm text-gray-600 mb-4">
                    Contact our support team if you need assistance with your account settings or have any questions.
                </p>
                <a 
                    href="#" 
                    class="inline-flex items-center text-primary-600 hover:text-primary-700 text-sm font-medium"
                >
                    Contact Support
                    <i data-lucide="arrow-right" class="h-4 w-4 ml-1"></i>
                </a>
            </div>
        </div>
        
        <!-- Right Column - Main Content Area -->
        <div class="lg:col-span-8">
            <div class="bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden">
                <!-- Content Header -->
                <div class="border-b border-gray-200 px-6 py-4">
                    <h2 class="text-xl font-semibold text-gray-900 flex items-center">
                        <i data-lucide="user" class="h-5 w-5 mr-2 text-primary-600"></i>
                        Profile Information
                    </h2>
                    <p class="text-sm text-gray-500 mt-1">
                        Your personal information and account details
                    </p>
                </div>
                
                <!-- Form Content -->
                <div class="p-6">
                    <form action="#" method="post">
                        <!-- Two Column Layout for Name -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-6">
                            <!-- First Name -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                                    First Name
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i data-lucide="user" class="h-5 w-5 text-gray-400"></i>
                                    </div>
                                    <input 
                                        type="text" 
                                        id="name" 
                                        name="name"
                                        class="block w-full pl-10 py-3 border border-gray-200 rounded-lg bg-gray-50 focus:outline-none text-gray-700"
                                        value="{{ Auth::user()->name }}" 
                                        readonly
                                        autocomplete="name"
                                    />
                                </div>
                            </div>
                            
                            <!-- Last Name -->
                            <div>
                                <label for="lastname" class="block text-sm font-medium text-gray-700 mb-1">
                                    Last Name
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i data-lucide="user" class="h-5 w-5 text-gray-400"></i>
                                    </div>
                                    <input 
                                        type="text" 
                                        id="lastname" 
                                        name="lastname"
                                        class="block w-full pl-10 py-3 border border-gray-200 rounded-lg bg-gray-50 focus:outline-none text-gray-700"
                                        value="{{ Auth::user()->lastname }}" 
                                        readonly
                                        autocomplete="family-name"
                                    />
                                </div>
                            </div>
                        </div>
                        
                        <!-- Account Number -->
                        <div class="mb-6">
                            <label for="accountnumber" class="block text-sm font-medium text-gray-700 mb-1">
                                Account Number
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i data-lucide="hash" class="h-5 w-5 text-gray-400"></i>
                                </div>
                                <input 
                                    type="text" 
                                    id="accountnumber" 
                                    class="block w-full pl-10 py-3 border border-gray-200 rounded-lg bg-gray-50 focus:outline-none text-gray-700"
                                    value="{{ Auth::user()->usernumber }}" 
                                    readonly
                                    autocomplete="off"
                                />
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                    <button 
                                        type="button"
                                        class="text-gray-400 hover:text-primary-600 focus:outline-none"
                                        onclick="navigator.clipboard.writeText('{{ Auth::user()->usernumber }}').then(() => alert('Account number copied to clipboard!'))"
                                    >
                                        <i data-lucide="copy" class="h-5 w-5"></i>
                                    </button>
                                </div>
                            </div>
                            <p class="mt-1 text-xs text-gray-500">This is your unique account identifier</p>
                        </div>
                        
                        <!-- Email Address -->
                        <div class="mb-6">
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                                Email Address
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i data-lucide="mail" class="h-5 w-5 text-gray-400"></i>
                                </div>
                                <input 
                                    type="email" 
                                    id="email" 
                                    name="email"
                                    class="block w-full pl-10 py-3 border border-gray-200 rounded-lg bg-gray-50 focus:outline-none text-gray-700"
                                    value="{{ Auth::user()->email }}" 
                                    readonly
                                    autocomplete="email"
                                />
                            </div>
                        </div>
                        
                        <!-- Date of Birth -->
                        <div class="mb-6">
                            <label for="dob" class="block text-sm font-medium text-gray-700 mb-1">
                                Date of Birth
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i data-lucide="calendar" class="h-5 w-5 text-gray-400"></i>
                                </div>
                                <input 
                                    type="date" 
                                    id="dob" 
                                    name="dob"
                                    class="block w-full pl-10 py-3 border border-gray-200 rounded-lg bg-gray-50 focus:outline-none text-gray-700"
                                    value="{{ Auth::user()->dob }}" 
                                    readonly
                                    autocomplete="bday"
                                />
                            </div>
                        </div>
                        
                        <!-- Phone Number -->
                        <div class="mb-6">
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">
                                Phone Number
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i data-lucide="phone" class="h-5 w-5 text-gray-400"></i>
                                </div>
                                <input 
                                    type="tel" 
                                    id="phone" 
                                    name="phone"
                                    class="block w-full pl-10 py-3 border border-gray-200 rounded-lg bg-gray-50 focus:outline-none text-gray-700"
                                    value="{{ Auth::user()->phone }}" 
                                    readonly
                                    autocomplete="tel"
                                />
                            </div>
                        </div>
                        
                        <!-- Address -->
                        <div class="mb-6">
                            <label for="address" class="block text-sm font-medium text-gray-700 mb-1">
                                Address
                            </label>
                            <div class="relative">
                                <div class="absolute top-3 left-3 flex items-start pointer-events-none">
                                    <i data-lucide="map-pin" class="h-5 w-5 text-gray-400"></i>
                                </div>
                                <textarea 
                                    id="address" 
                                    name="address"
                                    rows="3"
                                    class="block w-full pl-10 py-3 border border-gray-200 rounded-lg bg-gray-50 focus:outline-none text-gray-700"
                                    readonly
                                    autocomplete="street-address"
                                >{{ Auth::user()->address }}</textarea>
                            </div>
                        </div>
                        
                        <!-- Information Card -->
                        <div class="bg-blue-50 rounded-lg p-4 mb-6 border border-blue-100">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <i data-lucide="info" class="h-5 w-5 text-blue-500"></i>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-blue-800">Account Information</h3>
                                    <div class="mt-2 text-sm text-blue-700">
                                        <p>
                                            To update your personal information, please contact our customer support team with your request.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Profile Picture Upload Modal -->
    <div 
        x-show="showProfilePictureModal" 
        x-cloak
        class="fixed inset-0 overflow-y-auto z-50 flex items-center justify-center"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
    >
        <div 
            class="fixed inset-0 bg-black bg-opacity-50 transition-opacity" 
            @click="showProfilePictureModal = false"
        ></div>
        
        <div 
            class="relative bg-white rounded-lg w-full max-w-md mx-4 shadow-xl transform transition-all"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
        >
            <div class="p-6">
                <div class="flex justify-between items-center mb-5">
                    <h3 class="text-xl font-bold text-gray-900">Upload Profile Picture</h3>
                    <button @click="showProfilePictureModal = false" class="text-gray-400 hover:text-gray-500">
                        <i data-lucide="x" class="h-5 w-5"></i>
                    </button>
                </div>
                
                <form action="{{ route('updateprofilephoto') }}" method="post" enctype="multipart/form-data" class="space-y-5">
                    @csrf
                    
                    <div>
                        <label for="photo" class="block text-sm font-medium text-gray-700 mb-1">
                            Select New Profile Picture
                        </label>
                        <div class="mt-2">
                            <div class="flex items-center justify-center w-full">
                                <label for="photo-upload" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <i data-lucide="upload-cloud" class="h-10 w-10 text-gray-400 mb-2"></i>
                                        <p class="mb-2 text-sm text-gray-500">
                                            <span class="font-semibold">Click to upload</span> or drag and drop
                                        </p>
                                        <p class="text-xs text-gray-500">PNG, JPG or JPEG (MAX. 2MB)</p>
                                    </div>
                                    <input id="photo-upload" type="file" name="photo" class="hidden" required />
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="pt-3">
                        <button 
                            type="submit"
                            class="w-full px-4 py-3 border border-transparent rounded-lg shadow-sm text-base font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-colors"
                        >
                            <i data-lucide="upload" class="h-5 w-5 inline mr-2"></i>
                            Upload Profile Picture
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Transaction PIN Modal -->
    <div 
        x-show="showTransactionPinModal" 
        x-cloak
        class="fixed inset-0 overflow-y-auto z-50 flex items-center justify-center"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
    >
        <div 
            class="fixed inset-0 bg-black bg-opacity-50 transition-opacity" 
            @click="showTransactionPinModal = false"
        ></div>
        
        <div 
            class="relative bg-white rounded-lg w-full max-w-md mx-4 shadow-xl transform transition-all"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
        >
            <div class="p-6">
                <div class="flex justify-between items-center mb-5">
                    <h3 class="text-xl font-bold text-gray-900">Change Transaction PIN</h3>
                    <button @click="showTransactionPinModal = false" class="text-gray-400 hover:text-gray-500">
                        <i data-lucide="x" class="h-5 w-5"></i>
                    </button>
                </div>
                
                <form action="{{ route('changepin') }}" method="post" class="space-y-5">
                    @csrf
                    @method('PUT')
                    
                    <!-- New Transaction PIN -->
                    <div>
                        <label for="pin" class="block text-sm font-medium text-gray-700 mb-1">
                            New Transaction PIN
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i data-lucide="key" class="h-5 w-5 text-gray-400"></i>
                            </div>
                            <input 
                                type="password" 
                                id="pin" 
                                name="pin"
                                class="block w-full pl-10 py-3 border border-gray-200 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all"
                                placeholder="Enter new transaction PIN"
                                required
                                autocomplete="new-password"
                            />
                        </div>
                        <p class="mt-1 text-xs text-gray-500">Create a secure PIN that you can remember</p>
                    </div>
                    
                    <!-- Account Password for Verification -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                            Current Password
                        </label>
                        <div class="relative" x-data="{ showPassword: false }">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i data-lucide="lock" class="h-5 w-5 text-gray-400"></i>
                            </div>
                            <input 
                                :type="showPassword ? 'text' : 'password'" 
                                id="password" 
                                name="current_password"
                                class="block w-full pl-10 pr-10 py-3 border border-gray-200 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all"
                                placeholder="Enter your current password"
                                required
                                autocomplete="current-password"
                            />
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <button 
                                    type="button"
                                    @click="showPassword = !showPassword"
                                    class="text-gray-400 hover:text-primary-600 focus:outline-none"
                                >
                                    <i x-show="!showPassword" data-lucide="eye" class="h-5 w-5"></i>
                                    <i x-show="showPassword" data-lucide="eye-off" class="h-5 w-5"></i>
                                </button>
                            </div>
                        </div>
                        <p class="mt-1 text-xs text-gray-500">For security verification</p>
                    </div>
                    
                    <!-- Security Notice -->
                    <div class="bg-yellow-50 rounded-lg p-4 border border-yellow-100">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i data-lucide="alert-triangle" class="h-5 w-5 text-yellow-500"></i>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-yellow-800">Security Alert</h3>
                                <div class="mt-2 text-sm text-yellow-700">
                                    <p>
                                        Keep your transaction PIN confidential. Never share your PIN with anyone, including bank representatives.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="pt-3">
                        <button 
                            type="submit"
                            class="w-full px-4 py-3 border border-transparent rounded-lg shadow-sm text-base font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-colors"
                        >
                            <i data-lucide="rotate-cw" class="h-5 w-5 inline mr-2"></i>
                            Update Transaction PIN
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    [x-cloak] { display: none !important; }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Lucide icons
        lucide.createIcons();
        
        // Preview selected profile image
        const photoUpload = document.getElementById('photo-upload');
        if (photoUpload) {
            photoUpload.addEventListener('change', function(e) {
                if (e.target.files.length > 0) {
                    const parent = e.target.parentElement;
                    const children = parent.querySelectorAll(':not(input)');
                    
                    // Hide the default content
                    children.forEach(child => child.style.display = 'none');
                    
                    // Create image preview
                    const img = document.createElement('img');
                    img.src = URL.createObjectURL(e.target.files[0]);
                    img.classList.add('h-full', 'w-full', 'object-cover', 'rounded-lg');
                    parent.appendChild(img);
                }
            });
        }
    });
</script>

@endsection