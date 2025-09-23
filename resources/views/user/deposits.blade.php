@extends('layouts.dash2')
@section('title', $title)
@section('content')

<div x-data="{ 
    amount: '',
    paymentMethod: '',
    isSubmitting: false,
    
    validateAmount() {
        if (this.amount < 0) {
            this.amount = 0;
        }
    },
    
    submitForm() {
        this.isSubmitting = true;
        document.getElementById('depositForm').submit();
    }
}">
    <!-- Alerts -->
    <x-danger-alert />
    <x-success-alert />

    <!-- Page Header with Breadcrumbs -->
    <div class="flex flex-col mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 mb-1">Deposit Funds</h1>
            <div class="flex items-center text-sm text-gray-500">
                <a href="{{ route('dashboard') }}" class="hover:text-primary-600">Dashboard</a>
                <i data-lucide="chevron-right" class="h-4 w-4 mx-2"></i>
                <span class="font-medium text-gray-700">Deposit</span>
            </div>
        </div>
    </div>

    <!-- Interactive Card Container -->
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden">
            <!-- Card Header -->
            <div class="relative bg-gradient-to-r from-primary-600 to-primary-700 px-6 py-8">
                <div class="flex flex-col items-center">
                    <div class="bg-white/20 backdrop-blur-sm p-4 rounded-full mb-4">
                        <i data-lucide="piggy-bank" class="h-10 w-10 text-white"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-white">Fund Your Account</h2>
                    <p class="text-white/80 mt-1 text-center">Choose your preferred deposit method and amount</p>
                </div>

                <!-- Wave decoration at the bottom -->
                <div class="absolute left-0 right-0">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none"
                        class="h-12 w-full text-white fill-current">
                        <path
                            d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z"
                            opacity=".25"></path>
                        <path
                            d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z"
                            opacity=".5"></path>
                        <path
                            d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z">
                        </path>
                    </svg>
                </div>
            </div>

            <!-- Form Content -->
            <div class="p-6 md:p-8 pb-14">
                <form action="{{ route('newdeposit') }}" method="post" id="depositForm" @submit.prevent="submitForm()">
                    @csrf

                    <!-- Payment Method Selection -->
                    <div class="mb-8">
                        <label class="block text-sm font-medium text-gray-700 mb-3">Select Deposit Method</label>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                            @forelse ($dmethods as $method)
                            <div @click="paymentMethod = '{{ $method->name }}'"
                                class="cursor-pointer border rounded-lg p-4 transition-all"
                                :class="paymentMethod === '{{ $method->name }}' ? 'bg-primary-50 border-primary-500 ring-2 ring-primary-500 ring-opacity-50' : 'bg-white border-gray-200 hover:border-primary-300'">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 mr-3">
                                        @if(Str::contains(strtolower($method->name), 'bank'))
                                        <div
                                            class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center">
                                            <i data-lucide="building-2" class="h-5 w-5 text-blue-600"></i>
                                        </div>
                                        @elseif(Str::contains(strtolower($method->name), 'crypto') ||
                                        Str::contains(strtolower($method->name), 'bitcoin'))
                                        <div
                                            class="w-10 h-10 rounded-full bg-amber-100 flex items-center justify-center">
                                            <i data-lucide="bitcoin" class="h-5 w-5 text-amber-600"></i>
                                        </div>
                                        @elseif(Str::contains(strtolower($method->name), 'card') ||
                                        Str::contains(strtolower($method->name), 'credit'))
                                        <div
                                            class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center">
                                            <i data-lucide="credit-card" class="h-5 w-5 text-indigo-600"></i>
                                        </div>
                                        @elseif(Str::contains(strtolower($method->name), 'paypal'))
                                        <div
                                            class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center">
                                            <i data-lucide="paypal" class="h-5 w-5 text-blue-600"></i>
                                        </div>
                                        @else
                                        <div
                                            class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center">
                                            <i data-lucide="wallet" class="h-5 w-5 text-green-600"></i>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="flex-grow">
                                        <h3 class="font-medium text-gray-900">{{ $method->name }}</h3>
                                    </div>
                                    <div class="flex-shrink-0 ml-2">
                                        <div class="w-5 h-5 border border-gray-300 rounded-full flex items-center justify-center"
                                            :class="paymentMethod === '{{ $method->name }}' ? 'bg-primary-500 border-primary-500' : 'bg-white'">
                                            <i data-lucide="check" class="h-3 w-3 text-white"
                                                x-show="paymentMethod === '{{ $method->name }}'"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="col-span-full bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-md">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <i data-lucide="alert-triangle" class="h-5 w-5 text-yellow-400"></i>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm text-yellow-700">
                                            No payment methods are enabled at the moment. Please check back later.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            @endforelse
                        </div>

                        <!-- Hidden input to store the selected payment method -->
                        <input type="hidden" name="payment_method" :value="paymentMethod">
                    </div>

                    <!-- Amount Input with Currency -->
                    <div
                        class="mb-8 bg-gradient-to-br from-gray-50 to-white p-5 rounded-xl border border-gray-100 shadow-sm">
                        <label for="amount" class="block text-sm font-medium text-gray-700 mb-2">Deposit Amount</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <span class="text-gray-500 text-lg font-bold">{{
                                    config('currencies.'.Auth::user()->currency, '$') }}</span>
                            </div>
                            <input type="number" name="amount" id="amount" x-model="amount" @input="validateAmount()"
                                min="1" step="any"
                                class="block w-full pl-12 pr-20 py-4 border-2 border-primary-100 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all text-2xl font-bold"
                                placeholder="0.00" required />
                            <div
                                class="absolute right-3 top-1/2 transform -translate-y-1/2 text-lg font-bold text-gray-400 pointer-events-none">
                                .00
                            </div>
                        </div>

                        <!-- Quick Amount Buttons -->
                        <div class="mt-4 flex flex-wrap gap-2">
                            <button type="button" @click="amount = '100'"
                                class="px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-md text-sm font-medium text-gray-700 transition-colors">$100</button>
                            <button type="button" @click="amount = '500'"
                                class="px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-md text-sm font-medium text-gray-700 transition-colors">$500</button>
                            <button type="button" @click="amount = '1000'"
                                class="px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-md text-sm font-medium text-gray-700 transition-colors">$1000</button>
                            <button type="button" @click="amount = '5000'"
                                class="px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-md text-sm font-medium text-gray-700 transition-colors">$5000</button>
                            <button type="button" @click="amount = '10000'"
                                class="px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-md text-sm font-medium text-gray-700 transition-colors">$10000</button>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row sm:space-x-4">
                        <button type="submit"
                            class="w-full mb-3 sm:mb-0 inline-flex items-center justify-center px-6 py-3.5 border border-transparent rounded-lg shadow-sm text-base font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-colors relative overflow-hidden"
                            :disabled="isSubmitting || !paymentMethod || !amount"
                            :class="{ 'opacity-60 cursor-not-allowed': !paymentMethod || !amount }">
                            <span class="relative z-10 flex items-center">
                                <i data-lucide="credit-card" class="h-5 w-5 mr-2"
                                    :class="{ 'animate-pulse': isSubmitting }"></i>
                                <span x-text="isSubmitting ? 'Processing...' : 'Continue to Deposit'"></span>
                            </span>
                            <span
                                class="absolute inset-0 bg-gradient-to-r from-primary-600 to-primary-500 transform transition-transform duration-300 ease-out"
                                :class="{ 'translate-x-full': !amount || !paymentMethod }"></span>
                        </button>
                        <a href="{{ route('dashboard') }}"
                            class="w-full inline-flex items-center justify-center px-6 py-3.5 border border-gray-300 rounded-lg shadow-sm text-base font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-colors">
                            <i data-lucide="arrow-left" class="h-5 w-5 mr-2"></i>
                            Back to Dashboard
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Security Notice -->
        <div class="mt-6 mb-6 p-5 border border-gray-200 rounded-lg bg-white shadow-sm">
            <div class="flex items-start">
                <div class="flex-shrink-0 mt-0.5">
                    <i data-lucide="shield" class="h-5 w-5 text-primary-500"></i>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-gray-900">Secure Deposit</h3>
                    <p class="text-xs text-gray-500 mt-1">All deposits are processed through secure payment channels.
                        Your financial information is never stored on our servers.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    [x-cloak] {
        display: none !important;
    }
</style>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Lucide icons
        lucide.createIcons();
    });
</script>
@endpush

@endsection