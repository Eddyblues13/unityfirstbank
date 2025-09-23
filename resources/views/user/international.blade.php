@extends('layouts.dash2')
@section('title', $title)
@section('content')

<div x-data="{ 
    withdrawMethod: '',
    amount: '',
    accountName: '',
    accountNumber: '',
    bankName: '',
    bankAddress: '',
    accountType: 'Online Banking',
    country: '',
    swiftCode: '',
    iban: '',
    pin: '',
    description: '',
    cryptoCurrency: 'BTC',
    cryptoNetwork: 'Native',
    walletAddress: '',
    paypalEmail: '',
    wiseFullName: '',
    wiseEmail: '',
    wiseCountry: '',
    skrillEmail: '',
    skrillFullName: '',
    venmoUsername: '',
    venmoPhone: '',
    zelleEmail: '',
    zellePhone: '',
    zelleName: '',
    cashAppTag: '',
    cashAppFullName: '',
    revolutFullName: '',
    revolutEmail: '',
    revolutPhone: '',
    alipayId: '',
    alipayFullName: '',
    wechatId: '',
    wechatName: '',
    formTitle: 'International Wire Transfer',
    formDescription: 'Funds will reflect in the Beneficiary Account within 72hours.',
    isSubmitting: false,
    showPreview: false,
    showMoreMethods: false,
    
    changeMethod() {
        // Hide all method-specific fields first by not setting a method
        this.resetRequiredFields();
        
        // Set the appropriate title and description based on selected method
        switch(this.withdrawMethod) {
            case 'Wire Transfer':
                this.formTitle = 'Bank Transfer';
                this.formDescription = 'Funds will reflect in the Beneficiary Account within 72hours.';
                break;
            case 'Cryptocurrency':
                this.formTitle = 'Cryptocurrency Withdrawal';
                this.formDescription = 'Withdrawals are typically processed within 1-3 hours.';
                break;
            case 'PayPal':
                this.formTitle = 'PayPal Withdrawal';
                this.formDescription = 'Funds will be sent to your PayPal account within 24 hours.';
                break;
            case 'Wise Transfer':
                this.formTitle = 'Wise Transfer Withdrawal';
                this.formDescription = 'Your funds will be processed within 1-2 business days.';
                break;
            case 'Skrill':
                this.formTitle = 'Skrill Withdrawal';
                this.formDescription = 'Withdrawals to Skrill are processed within 24 hours.';
                break;
            case 'Venmo':
                this.formTitle = 'Venmo Withdrawal';
                this.formDescription = 'Funds will be transferred to your Venmo account within 24 hours.';
                break;
            case 'Zelle':
                this.formTitle = 'Zelle Withdrawal';
                this.formDescription = 'Funds will be sent to your Zelle account typically within a few hours.';
                break;
            case 'Cash App':
                this.formTitle = 'Cash App Withdrawal';
                this.formDescription = 'Withdrawals to Cash App are typically processed within 24 hours.';
                break;
            case 'Revolut':
                this.formTitle = 'Revolut Withdrawal';
                this.formDescription = 'Funds will be transferred to your Revolut account within 1-2 business days.';
                break;
            case 'Alipay':
                this.formTitle = 'Alipay Withdrawal';
                this.formDescription = 'Withdrawals to Alipay are typically processed within 24-48 hours.';
                break;
            case 'WeChat Pay':
                this.formTitle = 'WeChat Pay Withdrawal';
                this.formDescription = 'Funds will be sent to your WeChat Pay account within 24-48 hours.';
                break;
            default:
                this.formTitle = 'Select a Withdrawal Method';
                this.formDescription = 'Please select a withdrawal method to proceed.';
        }
    },
    
    resetRequiredFields() {
        // This method is used to handle the required attributes in the Alpine.js context
        // In practice, HTML5 validation will handle required fields based on visible elements
    },
    
    validateAmount() {
        const maxBalance = {{ Auth::user()->account_bal }};
        if (this.amount > maxBalance) {
            this.amount = maxBalance;
        }
    },
    
    previewTransfer() {
        if (this.amount > 0 && this.withdrawMethod !== '') {
            this.showPreview = true;
        }
    },
    
    submitForm() {
        this.isSubmitting = true;
        document.getElementById('internationalTransferForm').submit();
    }
}">
    <!-- Alerts -->
    <x-danger-alert />
    <x-success-alert />

    <!-- Page Header with Breadcrumbs -->
    <div class="flex flex-col mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 mb-1">International Transfer</h1>
            <div class="flex items-center text-sm text-gray-500">
                <a href="{{ route('dashboard') }}" class="hover:text-primary-600">Dashboard</a>
                <i data-lucide="chevron-right" class="h-4 w-4 mx-2"></i>
                <span class="font-medium text-gray-700">International Transfer</span>
            </div>
        </div>
    </div>

    <!-- Interactive Card Container -->
    <div class="max-w-4xl mx-auto">
        <!-- Method Selection Cards -->
        <div class="mb-8" x-show="!withdrawMethod">
            <h2 class="text-xl font-bold text-gray-900 mb-4">Select Transfer Method</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <!-- Wire Transfer -->
                <div @click="withdrawMethod = 'Wire Transfer'; changeMethod()"
                    class="cursor-pointer bg-white rounded-xl border border-gray-200 p-4 hover:border-primary-500 hover:shadow-md transition-all">
                    <div class="flex items-center mb-3">
                        <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                            <img src="https://www.svgrepo.com/download/1155/wire-transfer-logo.svg" alt="Wire Transfer"
                                class="h-5 w-5 text-blue-600">
                        </div>
                        <h3 class="ml-3 font-medium text-gray-900">Bank Transfer</h3>
                    </div>
                    <p class="text-sm text-gray-500">Transfer funds directly to international bank accounts.</p>
                </div>

                <!-- Cryptocurrency -->
                <div @click="withdrawMethod = 'Cryptocurrency'; changeMethod()"
                    class="cursor-pointer bg-white rounded-xl border border-gray-200 p-4 hover:border-primary-500 hover:shadow-md transition-all">
                    <div class="flex items-center mb-3">
                        <div class="h-10 w-10 rounded-full bg-purple-100 flex items-center justify-center">
                            <img src="https://cdn.jsdelivr.net/npm/cryptocurrency-icons@0.18.1/svg/color/btc.svg"
                                alt="Cryptocurrency" class="h-10 w-10">
                        </div>
                        <h3 class="ml-3 font-medium text-gray-900">Cryptocurrency</h3>
                    </div>
                    <p class="text-sm text-gray-500">Send funds to your cryptocurrency wallet.</p>
                </div>

                <!-- PayPal -->
                <div @click="withdrawMethod = 'PayPal'; changeMethod()"
                    class="cursor-pointer bg-white rounded-xl border border-gray-200 p-4 hover:border-primary-500 hover:shadow-md transition-all">
                    <div class="flex items-center mb-3">
                        <div class="h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center">
                            <img src="https://cdn.jsdelivr.net/npm/simple-icons@v7/icons/paypal.svg" alt="PayPal"
                                class="h-6 w-6">
                        </div>
                        <h3 class="ml-3 font-medium text-gray-900">PayPal</h3>
                    </div>
                    <p class="text-sm text-gray-500">Transfer funds to your PayPal account.</p>
                </div>

                <!-- Additional Methods (Row 2) -->
                <div @click="withdrawMethod = 'Wise Transfer'; changeMethod()"
                    class="cursor-pointer bg-white rounded-xl border border-gray-200 p-4 hover:border-primary-500 hover:shadow-md transition-all">
                    <div class="flex items-center mb-3">
                        <div class="h-10 w-10 rounded-full bg-green-100 flex items-center justify-center">
                            <img src="https://cdn.jsdelivr.net/npm/simple-icons@v7/icons/wise.svg" alt="Wise Transfer"
                                class="h-5 w-5 text-green-600">
                        </div>
                        <h3 class="ml-3 font-medium text-gray-900">Wise Transfer</h3>
                    </div>
                    <p class="text-sm text-gray-500">Transfer with lower fees using Wise.</p>
                </div>

                <!-- Mobile Payment Options -->
                <div @click="withdrawMethod = 'Cash App'; changeMethod()"
                    class="cursor-pointer bg-white rounded-xl border border-gray-200 p-4 hover:border-primary-500 hover:shadow-md transition-all">
                    <div class="flex items-center mb-3">
                        <div class="h-10 w-10 rounded-full bg-pink-100 flex items-center justify-center">
                            <img src="https://cdn.jsdelivr.net/npm/simple-icons@v7/icons/cashapp.svg" alt="Cash App"
                                class="h-5 w-5 text-pink-600">
                        </div>
                        <h3 class="ml-3 font-medium text-gray-900">Cash App</h3>
                    </div>
                    <p class="text-sm text-gray-500">Quick transfers to your Cash App account.</p>
                </div>

                <!-- More Methods Button -->
                <div @click="showMoreMethods = true; withdrawMethod = ''"
                    class="cursor-pointer bg-white rounded-xl border border-gray-200 p-4 hover:border-primary-500 hover:shadow-md transition-all">
                    <div class="flex items-center mb-3">
                        <div class="h-10 w-10 rounded-full bg-amber-100 flex items-center justify-center">
                            <i data-lucide="more-horizontal" class="h-5 w-5 text-amber-600"></i>
                        </div>
                        <h3 class="ml-3 font-medium text-gray-900">More Options</h3>
                    </div>
                    <p class="text-sm text-gray-500">Zelle, Venmo, Revolut, and more.</p>
                </div>
            </div>
        </div>

        <!-- More Methods Page -->
        <div x-show="showMoreMethods" class="mb-8" x-transition>
            <div class="flex items-center mb-6">
                <button @click="showMoreMethods = false"
                    class="mr-3 bg-white rounded-full p-2 text-gray-500 border border-gray-200 hover:bg-gray-50 transition-colors">
                    <i data-lucide="arrow-left" class="h-5 w-5"></i>
                </button>
                <h2 class="text-xl font-bold text-gray-900">Additional Transfer Methods</h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <!-- Skrill -->
                <div @click="withdrawMethod = 'Skrill'; changeMethod(); showMoreMethods = false"
                    class="cursor-pointer bg-white rounded-xl border border-gray-200 p-4 hover:border-primary-500 hover:shadow-md transition-all">
                    <div class="flex items-center mb-3">
                        <div class="h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center">
                            <img src="https://www.svgrepo.com/download/508724/skrill.svg" alt="Skrill"
                                class="h-5 w-5 text-indigo-600">
                        </div>
                        <h3 class="ml-3 font-medium text-gray-900">Skrill</h3>
                    </div>
                    <p class="text-sm text-gray-500">Transfer funds to your Skrill account.</p>
                </div>

                <!-- Venmo -->
                <div @click="withdrawMethod = 'Venmo'; changeMethod(); showMoreMethods = false"
                    class="cursor-pointer bg-white rounded-xl border border-gray-200 p-4 hover:border-primary-500 hover:shadow-md transition-all">
                    <div class="flex items-center mb-3">
                        <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                            <img src="https://cdn.jsdelivr.net/npm/simple-icons@v7/icons/venmo.svg" alt="Venmo"
                                class="h-5 w-5 text-blue-600">
                        </div>
                        <h3 class="ml-3 font-medium text-gray-900">Venmo</h3>
                    </div>
                    <p class="text-sm text-gray-500">Send funds to your Venmo account.</p>
                </div>

                <!-- Zelle -->
                <div @click="withdrawMethod = 'Zelle'; changeMethod(); showMoreMethods = false"
                    class="cursor-pointer bg-white rounded-xl border border-gray-200 p-4 hover:border-primary-500 hover:shadow-md transition-all">
                    <div class="flex items-center mb-3">
                        <div class="h-10 w-10 rounded-full bg-purple-100 flex items-center justify-center">
                            <img src="https://cdn.jsdelivr.net/npm/simple-icons@v7/icons/zelle.svg" alt="Zelle"
                                class="h-5 w-5 text-purple-600">
                        </div>
                        <h3 class="ml-3 font-medium text-gray-900">Zelle</h3>
                    </div>
                    <p class="text-sm text-gray-500">Quick transfers to your Zelle account.</p>
                </div>

                <!-- Revolut -->
                <div @click="withdrawMethod = 'Revolut'; changeMethod(); showMoreMethods = false"
                    class="cursor-pointer bg-white rounded-xl border border-gray-200 p-4 hover:border-primary-500 hover:shadow-md transition-all">
                    <div class="flex items-center mb-3">
                        <div class="h-10 w-10 rounded-full bg-cyan-100 flex items-center justify-center">
                            <img src="https://cdn.jsdelivr.net/npm/simple-icons@v7/icons/revolut.svg" alt="Revolut"
                                class="h-5 w-5 text-cyan-600">
                        </div>
                        <h3 class="ml-3 font-medium text-gray-900">Revolut</h3>
                    </div>
                    <p class="text-sm text-gray-500">Transfer to your Revolut account with low fees.</p>
                </div>

                <!-- Alipay -->
                <div @click="withdrawMethod = 'Alipay'; changeMethod(); showMoreMethods = false"
                    class="cursor-pointer bg-white rounded-xl border border-gray-200 p-4 hover:border-primary-500 hover:shadow-md transition-all">
                    <div class="flex items-center mb-3">
                        <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                            <img src="https://cdn.jsdelivr.net/npm/simple-icons@v7/icons/alipay.svg" alt="Alipay"
                                class="h-5 w-5 text-blue-600">
                        </div>
                        <h3 class="ml-3 font-medium text-gray-900">Alipay</h3>
                    </div>
                    <p class="text-sm text-gray-500">Send funds to your Alipay account.</p>
                </div>

                <!-- WeChat Pay -->
                <div @click="withdrawMethod = 'WeChat Pay'; changeMethod(); showMoreMethods = false"
                    class="cursor-pointer bg-white rounded-xl border border-gray-200 p-4 hover:border-primary-500 hover:shadow-md transition-all">
                    <div class="flex items-center mb-3">
                        <div class="h-10 w-10 rounded-full bg-green-100 flex items-center justify-center">
                            <img src="https://cdn.jsdelivr.net/npm/simple-icons@v7/icons/wechat.svg" alt="WeChat Pay"
                                class="h-5 w-5 text-green-600">
                        </div>
                        <h3 class="ml-3 font-medium text-gray-900">WeChat Pay</h3>
                    </div>
                    <p class="text-sm text-gray-500">Transfer to your WeChat Pay wallet.</p>
                </div>
            </div>
        </div>

        <!-- Transfer Form Card -->
        <div class="bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden"
            x-show="withdrawMethod && !showMoreMethods">
            <!-- Card Header with Method Icon -->
            <div class="relative bg-gradient-to-r from-primary-600 to-primary-700 px-6 py-8">
                <!-- Back Button -->
                <button @click="withdrawMethod = ''"
                    class="absolute top-4 left-4 bg-white/20 rounded-full p-2 text-white hover:bg-white/30 transition-colors">
                    <i data-lucide="arrow-left" class="h-5 w-5"></i>
                </button>

                <div class="flex flex-col items-center">
                    <div class="bg-white/20 backdrop-blur-sm p-4 rounded-full mb-4">
                        <template x-if="withdrawMethod === 'Wire Transfer'">
                            <img src="https://www.svgrepo.com/download/1155/wire-transfer-logo.svg" alt="Wire Transfer"
                                class="h-10 w-10 text-white" style="filter: invert(1);">
                        </template>
                        <template x-if="withdrawMethod === 'Cryptocurrency'">
                            <img :src="'https://cdn.jsdelivr.net/npm/cryptocurrency-icons@0.18.1/svg/color/' + cryptoCurrency.toLowerCase() + '.svg'"
                                :alt="cryptoCurrency" class="h-10 w-10">
                        </template>
                        <template x-if="withdrawMethod === 'PayPal'">
                            <img src="https://cdn.jsdelivr.net/npm/simple-icons@v7/icons/paypal.svg" alt="PayPal"
                                class="h-10 w-10 text-white" style="filter: invert(1);">
                        </template>
                        <template x-if="withdrawMethod === 'Wise Transfer'">
                            <img src="https://cdn.jsdelivr.net/npm/simple-icons@v7/icons/wise.svg" alt="Wise Transfer"
                                class="h-10 w-10 text-white" style="filter: invert(1);">
                        </template>
                        <template x-if="withdrawMethod === 'Skrill'">
                            <img src="https://www.svgrepo.com/download/508724/skrill.svg" alt="Skrill"
                                class="h-10 w-10 text-white" style="filter: invert(1);">
                        </template>
                        <template x-if="withdrawMethod === 'Venmo'">
                            <img src="https://cdn.jsdelivr.net/npm/simple-icons@v7/icons/venmo.svg" alt="Venmo"
                                class="h-10 w-10 text-white" style="filter: invert(1);">
                        </template>
                        <template x-if="withdrawMethod === 'Zelle'">
                            <img src="https://cdn.jsdelivr.net/npm/simple-icons@v7/icons/zelle.svg" alt="Zelle"
                                class="h-10 w-10 text-white" style="filter: invert(1);">
                        </template>
                        <template x-if="withdrawMethod === 'Cash App'">
                            <img src="https://cdn.jsdelivr.net/npm/simple-icons@v7/icons/cashapp.svg" alt="Cash App"
                                class="h-10 w-10 text-white" style="filter: invert(1);">
                        </template>
                        <template x-if="withdrawMethod === 'Revolut'">
                            <img src="https://cdn.jsdelivr.net/npm/simple-icons@v7/icons/revolut.svg" alt="Revolut"
                                class="h-10 w-10 text-white" style="filter: invert(1);">
                        </template>
                        <template x-if="withdrawMethod === 'Alipay'">
                            <img src="https://cdn.jsdelivr.net/npm/simple-icons@v7/icons/alipay.svg" alt="Alipay"
                                class="h-10 w-10 text-white" style="filter: invert(1);">
                        </template>
                        <template x-if="withdrawMethod === 'WeChat Pay'">
                            <img src="https://cdn.jsdelivr.net/npm/simple-icons@v7/icons/wechat.svg" alt="WeChat Pay"
                                class="h-10 w-10 text-white" style="filter: invert(1);">
                        </template>
                    </div>
                    <h2 class="text-2xl font-bold text-white" x-text="formTitle">Bank Transfer</h2>
                    <p class="text-white/80 mt-1 text-center" x-text="formDescription">Funds will reflect in the
                        Beneficiary Account within 72hours.</p>
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
                <form action="{{ route('internationaltransfer') }}" method="post" id="internationalTransferForm"
                    @submit.prevent="previewTransfer()">
                    @csrf
                    <input type="hidden" name="withdrawMethod" :value="withdrawMethod">

                    <!-- Amount Input with Currency (Enhanced) -->
                    <div
                        class="mb-8 bg-gradient-to-br from-gray-50 to-white p-5 rounded-xl border border-gray-100 shadow-sm">
                        <label for="amount" class="block text-sm font-medium text-gray-700 mb-2">Amount to
                            Transfer</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <span class="text-gray-500 text-lg font-bold">{{
                                    config('currencies.'.Auth::user()->currency, '$') }}</span>
                            </div>
                            <input type="number" name="amount" id="amount" x-model="amount" @input="validateAmount()"
                                min="1" max="{{ Auth::user()->account_bal }}" step="any"
                                class="block w-full pl-12 pr-20 py-4 border-2 border-primary-100 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all text-2xl font-bold"
                                placeholder="0.00" required />
                            <div
                                class="absolute right-3 top-1/2 transform -translate-y-1/2 text-lg font-bold text-gray-400 pointer-events-none">
                                .00
                            </div>
                        </div>
                        <div class="mt-3 flex items-center justify-between">
                            <p class="text-sm text-gray-500">Available balance: <span class="font-medium">{{
                                    config('currencies.'.Auth::user()->currency, '$') }}{{
                                    number_format(Auth::user()->account_bal, 2, '.', ',') }}</span></p>

                            <!-- Quick Amount Buttons -->
                            <div class="flex space-x-2">
                                <button type="button" @click="amount = '100'"
                                    class="px-3 py-1 bg-gray-100 hover:bg-gray-200 rounded-md text-xs font-medium text-gray-700 transition-colors">$100</button>
                                <button type="button" @click="amount = '500'"
                                    class="px-3 py-1 bg-gray-100 hover:bg-gray-200 rounded-md text-xs font-medium text-gray-700 transition-colors">$500</button>
                                <button type="button" @click="amount = '1000'"
                                    class="px-3 py-1 bg-gray-100 hover:bg-gray-200 rounded-md text-xs font-medium text-gray-700 transition-colors">$1000</button>
                                <button type="button" @click="amount = {{ Auth::user()->account_bal }}"
                                    class="px-3 py-1 bg-gray-100 hover:bg-gray-200 rounded-md text-xs font-medium text-gray-700 transition-colors">Max</button>
                            </div>
                        </div>
                    </div>

                    <!-- WIRE TRANSFER FIELDS -->
                    <div x-show="withdrawMethod === 'Wire Transfer'" x-transition class="space-y-6 mt-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="accountname"
                                    class="block text-sm font-medium text-gray-700 mb-1">Beneficiary Account
                                    Name</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i data-lucide="user" class="h-5 w-5 text-gray-400"></i>
                                    </div>
                                    <input type="text" name="accountname" id="accountname" x-model="accountName"
                                        class="block w-full pl-10 pr-3 py-3 border border-gray-200 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all"
                                        placeholder="Enter beneficiary's full name"
                                        x-bind:required="withdrawMethod === 'Wire Transfer'" />
                                </div>
                            </div>

                            <div>
                                <label for="accountnumber"
                                    class="block text-sm font-medium text-gray-700 mb-1">Beneficiary Account
                                    Number</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i data-lucide="hash" class="h-5 w-5 text-gray-400"></i>
                                    </div>
                                    <input type="text" name="accountnumber" id="accountnumber" x-model="accountNumber"
                                        class="block w-full pl-10 pr-3 py-3 border border-gray-200 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all"
                                        placeholder="Enter account number"
                                        x-bind:required="withdrawMethod === 'Wire Transfer'" />
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="bankname" class="block text-sm font-medium text-gray-700 mb-1">Bank
                                    Name</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i data-lucide="building" class="h-5 w-5 text-gray-400"></i>
                                    </div>
                                    <input type="text" name="bankname" id="bankname" x-model="bankName"
                                        class="block w-full pl-10 pr-3 py-3 border border-gray-200 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all"
                                        placeholder="Enter bank name"
                                        x-bind:required="withdrawMethod === 'Wire Transfer'" />
                                </div>
                            </div>

                            <div>
                                <label for="bankaddress" class="block text-sm font-medium text-gray-700 mb-1">Bank
                                    Address</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i data-lucide="map-pin" class="h-5 w-5 text-gray-400"></i>
                                    </div>
                                    <input type="text" name="bankaddress" id="bankaddress" x-model="bankAddress"
                                        class="block w-full pl-10 pr-3 py-3 border border-gray-200 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all"
                                        placeholder="Enter bank address"
                                        x-bind:required="withdrawMethod === 'Wire Transfer'" />
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label for="Accounttype" class="block text-sm font-medium text-gray-700 mb-1">Account
                                    Type</label>
                                <div class="relative rounded-lg shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i data-lucide="layout-list" class="h-5 w-5 text-gray-400"></i>
                                    </div>
                                    <select name="Accounttype" id="Accounttype" x-model="accountType"
                                        class="block w-full pl-10 pr-8 py-3 border border-gray-200 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all appearance-none"
                                        x-bind:required="withdrawMethod === 'Wire Transfer'">
                                        <option value="Online Banking">Online Banking</option>
                                        <option value="Joint Account">Joint Account</option>
                                        <option value="Checking">Checking</option>
                                        <option value="Savings Account">Savings Account</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <i data-lucide="chevron-down" class="h-5 w-5 text-gray-400"></i>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label for="country"
                                    class="block text-sm font-medium text-gray-700 mb-1">Country</label>
                                <div class="relative rounded-lg shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i data-lucide="globe" class="h-5 w-5 text-gray-400"></i>
                                    </div>
                                    <div class="pl-10">
                                        @include('partials.country-select', ['fieldName' => 'country', 'required' =>
                                        false])
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label for="swiftcode" class="block text-sm font-medium text-gray-700 mb-1">Swift
                                    Code/Routing Number</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i data-lucide="code" class="h-5 w-5 text-gray-400"></i>
                                    </div>
                                    <input type="text" name="swiftcode" id="swiftcode" x-model="swiftCode"
                                        class="block w-full pl-10 pr-3 py-3 border border-gray-200 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all"
                                        placeholder="Enter SWIFT/BIC/Routing number"
                                        x-bind:required="withdrawMethod === 'Wire Transfer'" />
                                </div>
                            </div>
                        </div>

                        <div>
                            <label for="iban" class="block text-sm font-medium text-gray-700 mb-1">Account Number</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i data-lucide="credit-card" class="h-5 w-5 text-gray-400"></i>
                                </div>
                                <input type="text" name="iban" id="iban" x-model="iban"
                                    class="block w-full pl-10 pr-3 py-3 border border-gray-200 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all"
                                    placeholder="Enter Account number"
                                    x-bind:required="withdrawMethod === 'Wire Transfer'" />
                            </div>

                            <!-- Help text for IBAN -->
                            <!--<p class="mt-1 text-xs text-gray-500">International Bank Account Number - Format varies by-->
                            <!--    country</p>-->
                        </div>
                    </div>

                    <!-- CRYPTOCURRENCY FIELDS -->
                    <div x-show="withdrawMethod === 'Cryptocurrency'" x-transition class="space-y-6 mt-6">
                        <!-- Crypto Icon and Info -->
                        <div class="flex items-center justify-center mb-6">
                            <div class="flex items-center h-20 px-6 bg-gray-50 border border-gray-100 rounded-lg">
                                <template x-if="cryptoCurrency === 'BTC'">
                                    <div
                                        class="w-10 h-10 mr-4 rounded-full bg-amber-100 flex items-center justify-center">
                                        <img src="https://cdn.jsdelivr.net/npm/cryptocurrency-icons@0.18.1/svg/color/btc.svg"
                                            alt="Bitcoin" class="h-6 w-6">
                                    </div>
                                </template>
                                <template x-if="cryptoCurrency === 'ETH'">
                                    <div
                                        class="w-10 h-10 mr-4 rounded-full bg-indigo-100 flex items-center justify-center">
                                        <img src="https://cdn.jsdelivr.net/npm/cryptocurrency-icons@0.18.1/svg/color/eth.svg"
                                            alt="Ethereum" class="h-6 w-6">
                                    </div>
                                </template>
                                <template x-if="cryptoCurrency === 'USDT'">
                                    <div
                                        class="w-10 h-10 mr-4 rounded-full bg-green-100 flex items-center justify-center">
                                        <img src="https://cdn.jsdelivr.net/npm/cryptocurrency-icons@0.18.1/svg/color/usdt.svg"
                                            alt="Tether" class="h-6 w-6">
                                    </div>
                                </template>
                                <template x-if="cryptoCurrency === 'BNB'">
                                    <div
                                        class="w-10 h-10 mr-4 rounded-full bg-yellow-100 flex items-center justify-center">
                                        <img src="https://cdn.jsdelivr.net/npm/cryptocurrency-icons@0.18.1/svg/color/bnb.svg"
                                            alt="Binance Coin" class="h-6 w-6">
                                    </div>
                                </template>
                                <template x-if="cryptoCurrency === 'XRP'">
                                    <div
                                        class="w-10 h-10 mr-4 rounded-full bg-blue-100 flex items-center justify-center">
                                        <img src="https://cdn.jsdelivr.net/npm/cryptocurrency-icons@0.18.1/svg/color/xrp.svg"
                                            alt="Ripple" class="h-6 w-6">
                                    </div>
                                </template>
                                <template x-if="cryptoCurrency === 'SOL'">
                                    <div
                                        class="w-10 h-10 mr-4 rounded-full bg-purple-100 flex items-center justify-center">
                                        <img src="https://cdn.jsdelivr.net/npm/cryptocurrency-icons@0.18.1/svg/color/sol.svg"
                                            alt="Solana" class="h-6 w-6">
                                    </div>
                                </template>
                                <template x-if="cryptoCurrency === 'ADA'">
                                    <div
                                        class="w-10 h-10 mr-4 rounded-full bg-blue-100 flex items-center justify-center">
                                        <img src="https://cdn.jsdelivr.net/npm/cryptocurrency-icons@0.18.1/svg/color/ada.svg"
                                            alt="Cardano" class="h-6 w-6">
                                    </div>
                                </template>
                                <template x-if="cryptoCurrency === 'DOGE'">
                                    <div
                                        class="w-10 h-10 mr-4 rounded-full bg-yellow-100 flex items-center justify-center">
                                        <img src="https://cdn.jsdelivr.net/npm/cryptocurrency-icons@0.18.1/svg/color/doge.svg"
                                            alt="Dogecoin" class="h-6 w-6">
                                    </div>
                                </template>

                                <div>
                                    <div class="flex items-center">
                                        <span class="text-lg font-bold mr-2" x-text="cryptoCurrency"></span>
                                        <span class="text-sm text-gray-500" x-text="cryptoNetwork"></span>
                                    </div>
                                    <p class="text-sm text-gray-500">Select your preferred cryptocurrency and network
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="cryptoCurrency"
                                    class="block text-sm font-medium text-gray-700 mb-1">Cryptocurrency</label>
                                <div class="relative rounded-lg shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i data-lucide="landmark" class="h-5 w-5 text-gray-400"></i>
                                    </div>
                                    <select name="cryptoCurrency" id="cryptoCurrency" x-model="cryptoCurrency"
                                        class="block w-full pl-10 pr-10 py-3 border border-gray-200 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all appearance-none"
                                        x-bind:required="withdrawMethod === 'Cryptocurrency'">
                                        <option value="BTC">Bitcoin (BTC)</option>
                                        <option value="ETH">Ethereum (ETH)</option>
                                        <option value="USDT">Tether (USDT)</option>
                                        <option value="BNB">Binance Coin (BNB)</option>
                                        <option value="XRP">Ripple (XRP)</option>
                                        <option value="SOL">Solana (SOL)</option>
                                        <option value="ADA">Cardano (ADA)</option>
                                        <option value="DOGE">Dogecoin (DOGE)</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <i data-lucide="chevron-down" class="h-5 w-5 text-gray-400"></i>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label for="cryptoNetwork"
                                    class="block text-sm font-medium text-gray-700 mb-1">Network</label>
                                <div class="relative rounded-lg shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i data-lucide="network" class="h-5 w-5 text-gray-400"></i>
                                    </div>
                                    <select name="cryptoNetwork" id="cryptoNetwork" x-model="cryptoNetwork"
                                        class="block w-full pl-10 pr-10 py-3 border border-gray-200 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all appearance-none"
                                        x-bind:required="withdrawMethod === 'Cryptocurrency'">
                                        <option value="Native">Native</option>
                                        <option value="ERC20">ERC-20 (Ethereum)</option>
                                        <option value="BEP20">BEP-20 (BSC)</option>
                                        <option value="TRC20">TRC-20 (TRON)</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <i data-lucide="chevron-down" class="h-5 w-5 text-gray-400"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Crypto Cards Display -->
                        <div class="grid grid-cols-4 gap-2 mb-4">
                            <div @click="cryptoCurrency = 'BTC'" class="cursor-pointer p-2 rounded-lg border"
                                :class="{'border-primary-500 bg-primary-50': cryptoCurrency === 'BTC', 'border-gray-200': cryptoCurrency !== 'BTC'}">
                                <div class="flex flex-col items-center">
                                    <img src="https://cdn.jsdelivr.net/npm/cryptocurrency-icons@0.18.1/svg/color/btc.svg"
                                        alt="Bitcoin" class="h-8 w-8 mb-1">
                                    <span class="text-xs font-medium">BTC</span>
                                </div>
                            </div>
                            <div @click="cryptoCurrency = 'ETH'" class="cursor-pointer p-2 rounded-lg border"
                                :class="{'border-primary-500 bg-primary-50': cryptoCurrency === 'ETH', 'border-gray-200': cryptoCurrency !== 'ETH'}">
                                <div class="flex flex-col items-center">
                                    <img src="https://cdn.jsdelivr.net/npm/cryptocurrency-icons@0.18.1/svg/color/eth.svg"
                                        alt="Ethereum" class="h-8 w-8 mb-1">
                                    <span class="text-xs font-medium">ETH</span>
                                </div>
                            </div>
                            <div @click="cryptoCurrency = 'USDT'" class="cursor-pointer p-2 rounded-lg border"
                                :class="{'border-primary-500 bg-primary-50': cryptoCurrency === 'USDT', 'border-gray-200': cryptoCurrency !== 'USDT'}">
                                <div class="flex flex-col items-center">
                                    <img src="https://cdn.jsdelivr.net/npm/cryptocurrency-icons@0.18.1/svg/color/usdt.svg"
                                        alt="Tether" class="h-8 w-8 mb-1">
                                    <span class="text-xs font-medium">USDT</span>
                                </div>
                            </div>
                            <div @click="cryptoCurrency = 'BNB'" class="cursor-pointer p-2 rounded-lg border"
                                :class="{'border-primary-500 bg-primary-50': cryptoCurrency === 'BNB', 'border-gray-200': cryptoCurrency !== 'BNB'}">
                                <div class="flex flex-col items-center">
                                    <img src="https://cdn.jsdelivr.net/npm/cryptocurrency-icons@0.18.1/svg/color/bnb.svg"
                                        alt="Binance Coin" class="h-8 w-8 mb-1">
                                    <span class="text-xs font-medium">BNB</span>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label for="walletAddress" class="block text-sm font-medium text-gray-700 mb-1">Wallet
                                Address</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i data-lucide="wallet" class="h-5 w-5 text-gray-400"></i>
                                </div>
                                <input type="text" name="walletAddress" id="walletAddress" x-model="walletAddress"
                                    class="block w-full pl-10 pr-10 py-3 border border-gray-200 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all font-mono"
                                    placeholder="Enter wallet address"
                                    x-bind:required="withdrawMethod === 'Cryptocurrency'" />
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                    <button type="button" class="text-gray-400 hover:text-gray-500 focus:outline-none"
                                        @click="navigator.clipboard.readText().then(text => walletAddress = text)">
                                        <i data-lucide="clipboard" class="h-5 w-5"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Wallet Address Warning -->
                            <div class="mt-2 p-3 bg-yellow-50 border-l-4 border-yellow-400 rounded-r-md">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <i data-lucide="alert-triangle" class="h-5 w-5 text-yellow-400"></i>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm text-yellow-700">
                                            Double-check your wallet address. Transactions to incorrect addresses cannot
                                            be reversed.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- PAYPAL FIELDS -->
                    <div x-show="withdrawMethod === 'PayPal'" x-transition class="space-y-6 mt-6">
                        <div class="flex items-center justify-center mb-6">
                            <div class="flex items-center h-20 px-6 bg-gray-50 border border-gray-100 rounded-lg">
                                <div class="w-10 h-10 mr-4 rounded-full bg-blue-100 flex items-center justify-center">
                                    <i data-lucide="credit-card" class="h-6 w-6 text-blue-600"></i>
                                </div>
                                <div>
                                    <div class="text-lg font-bold">PayPal</div>
                                    <p class="text-sm text-gray-500">Transfer funds to your PayPal account</p>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label for="paypalEmail" class="block text-sm font-medium text-gray-700 mb-1">PayPal
                                Email</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i data-lucide="mail" class="h-5 w-5 text-gray-400"></i>
                                </div>
                                <input type="email" name="paypalEmail" id="paypalEmail" x-model="paypalEmail"
                                    class="block w-full pl-10 pr-3 py-3 border border-gray-200 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all"
                                    placeholder="Enter PayPal email address"
                                    x-bind:required="withdrawMethod === 'PayPal'" />
                            </div>

                            <!-- PayPal Email Note -->
                            <p class="mt-1 text-xs text-gray-500">Please ensure this is the email address associated
                                with your PayPal account</p>
                        </div>
                    </div>

                    <!-- WISE TRANSFER FIELDS -->
                    <div x-show="withdrawMethod === 'Wise Transfer'" x-transition class="space-y-6 mt-6">
                        <div class="flex items-center justify-center mb-6">
                            <div class="flex items-center h-20 px-6 bg-gray-50 border border-gray-100 rounded-lg">
                                <div class="w-10 h-10 mr-4 rounded-full bg-green-100 flex items-center justify-center">
                                    <i data-lucide="wallet" class="h-6 w-6 text-green-600"></i>
                                </div>
                                <div>
                                    <div class="text-lg font-bold">Wise Transfer</div>
                                    <p class="text-sm text-gray-500">Formerly TransferWise - Low fee international
                                        transfers</p>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="wiseFullName" class="block text-sm font-medium text-gray-700 mb-1">Full
                                    Name</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i data-lucide="user" class="h-5 w-5 text-gray-400"></i>
                                    </div>
                                    <input type="text" name="wiseFullName" id="wiseFullName" x-model="wiseFullName"
                                        class="block w-full pl-10 pr-3 py-3 border border-gray-200 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all"
                                        placeholder="Enter your full name"
                                        x-bind:required="withdrawMethod === 'Wise Transfer'" />
                                </div>
                            </div>

                            <div>
                                <label for="wiseEmail" class="block text-sm font-medium text-gray-700 mb-1">Email
                                    Address</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i data-lucide="mail" class="h-5 w-5 text-gray-400"></i>
                                    </div>
                                    <input type="email" name="wiseEmail" id="wiseEmail" x-model="wiseEmail"
                                        class="block w-full pl-10 pr-3 py-3 border border-gray-200 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all"
                                        placeholder="Enter your email address"
                                        x-bind:required="withdrawMethod === 'Wise Transfer'" />
                                </div>
                            </div>
                        </div>

                        <div>
                            <label for="wiseCountry"
                                class="block text-sm font-medium text-gray-700 mb-1">Country</label>
                            <div class="relative rounded-lg shadow-sm">
                                @include('partials.country-select', ['fieldName' => 'wiseCountry', 'required' => false])
                            </div>
                        </div>
                    </div>

                    <!-- SKRILL FIELDS -->
                    <div x-show="withdrawMethod === 'Skrill'" x-transition>
                        <div class="mb-6">
                            <label for="skrillEmail" class="block text-sm font-medium text-gray-700 mb-1">Skrill
                                Email</label>
                            <input type="email" name="skrillEmail" id="skrillEmail" x-model="skrillEmail"
                                class="block w-full px-4 py-3 border border-gray-200 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all"
                                placeholder="Enter Skrill email address"
                                x-bind:required="withdrawMethod === 'Skrill'" />
                        </div>

                        <div class="mb-6">
                            <label for="skrillFullName" class="block text-sm font-medium text-gray-700 mb-1">Full
                                Name</label>
                            <input type="text" name="skrillFullName" id="skrillFullName" x-model="skrillFullName"
                                class="block w-full px-4 py-3 border border-gray-200 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all"
                                placeholder="Enter your full name" x-bind:required="withdrawMethod === 'Skrill'" />
                        </div>
                    </div>

                    <!-- VENMO FIELDS -->
                    <div x-show="withdrawMethod === 'Venmo'" x-transition>
                        <div class="mb-6">
                            <label for="venmoUsername" class="block text-sm font-medium text-gray-700 mb-1">Venmo
                                Username</label>
                            <input type="text" name="venmoUsername" id="venmoUsername" x-model="venmoUsername"
                                class="block w-full px-4 py-3 border border-gray-200 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all"
                                placeholder="Enter Venmo username" x-bind:required="withdrawMethod === 'Venmo'" />
                        </div>

                        <div class="mb-6">
                            <label for="venmoPhone" class="block text-sm font-medium text-gray-700 mb-1">Phone
                                Number</label>
                            <input type="tel" name="venmoPhone" id="venmoPhone" x-model="venmoPhone"
                                class="block w-full px-4 py-3 border border-gray-200 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all"
                                placeholder="Enter phone number associated with Venmo"
                                x-bind:required="withdrawMethod === 'Venmo'" />
                        </div>
                    </div>

                    <!-- ZELLE FIELDS -->
                    <div x-show="withdrawMethod === 'Zelle'" x-transition>
                        <div class="mb-6">
                            <label for="zelleEmail" class="block text-sm font-medium text-gray-700 mb-1">Zelle
                                Email</label>
                            <input type="email" name="zelleEmail" id="zelleEmail" x-model="zelleEmail"
                                class="block w-full px-4 py-3 border border-gray-200 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all"
                                placeholder="Enter Zelle email address" x-bind:required="withdrawMethod === 'Zelle'" />
                        </div>

                        <div class="mb-6">
                            <label for="zellePhone" class="block text-sm font-medium text-gray-700 mb-1">Phone
                                Number</label>
                            <input type="tel" name="zellePhone" id="zellePhone" x-model="zellePhone"
                                class="block w-full px-4 py-3 border border-gray-200 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all"
                                placeholder="Enter phone number associated with Zelle"
                                x-bind:required="withdrawMethod === 'Zelle'" />
                        </div>

                        <div class="mb-6">
                            <label for="zelleName" class="block text-sm font-medium text-gray-700 mb-1">Full
                                Name</label>
                            <input type="text" name="zelleName" id="zelleName" x-model="zelleName"
                                class="block w-full px-4 py-3 border border-gray-200 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all"
                                placeholder="Enter your full name" x-bind:required="withdrawMethod === 'Zelle'" />
                        </div>
                    </div>

                    <!-- CASH APP FIELDS -->
                    <div x-show="withdrawMethod === 'Cash App'" x-transition>
                        <div class="mb-6">
                            <label for="cashAppTag"
                                class="block text-sm font-medium text-gray-700 mb-1">$Cashtag</label>
                            <input type="text" name="cashAppTag" id="cashAppTag" x-model="cashAppTag"
                                class="block w-full px-4 py-3 border border-gray-200 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all"
                                placeholder="Enter your $Cashtag" x-bind:required="withdrawMethod === 'Cash App'" />
                        </div>

                        <div class="mb-6">
                            <label for="cashAppFullName" class="block text-sm font-medium text-gray-700 mb-1">Full
                                Name</label>
                            <input type="text" name="cashAppFullName" id="cashAppFullName" x-model="cashAppFullName"
                                class="block w-full px-4 py-3 border border-gray-200 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all"
                                placeholder="Enter your full name" x-bind:required="withdrawMethod === 'Cash App'" />
                        </div>
                    </div>

                    <!-- REVOLUT FIELDS -->
                    <div x-show="withdrawMethod === 'Revolut'" x-transition>
                        <div class="mb-6">
                            <label for="revolutFullName" class="block text-sm font-medium text-gray-700 mb-1">Full
                                Name</label>
                            <input type="text" name="revolutFullName" id="revolutFullName" x-model="revolutFullName"
                                class="block w-full px-4 py-3 border border-gray-200 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all"
                                placeholder="Enter your full name" x-bind:required="withdrawMethod === 'Revolut'" />
                        </div>

                        <div class="mb-6">
                            <label for="revolutEmail" class="block text-sm font-medium text-gray-700 mb-1">Email
                                Address</label>
                            <input type="email" name="revolutEmail" id="revolutEmail" x-model="revolutEmail"
                                class="block w-full px-4 py-3 border border-gray-200 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all"
                                placeholder="Enter your email address" x-bind:required="withdrawMethod === 'Revolut'" />
                        </div>

                        <div class="mb-6">
                            <label for="revolutPhone" class="block text-sm font-medium text-gray-700 mb-1">Phone
                                Number</label>
                            <input type="tel" name="revolutPhone" id="revolutPhone" x-model="revolutPhone"
                                class="block w-full px-4 py-3 border border-gray-200 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all"
                                placeholder="Enter phone number associated with Revolut"
                                x-bind:required="withdrawMethod === 'Revolut'" />
                        </div>
                    </div>

                    <!-- ALIPAY FIELDS -->
                    <div x-show="withdrawMethod === 'Alipay'" x-transition>
                        <div class="mb-6">
                            <label for="alipayId" class="block text-sm font-medium text-gray-700 mb-1">Alipay ID</label>
                            <input type="text" name="alipayId" id="alipayId" x-model="alipayId"
                                class="block w-full px-4 py-3 border border-gray-200 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all"
                                placeholder="Enter your Alipay ID" x-bind:required="withdrawMethod === 'Alipay'" />
                        </div>

                        <div class="mb-6">
                            <label for="alipayFullName" class="block text-sm font-medium text-gray-700 mb-1">Full
                                Name</label>
                            <input type="text" name="alipayFullName" id="alipayFullName" x-model="alipayFullName"
                                class="block w-full px-4 py-3 border border-gray-200 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all"
                                placeholder="Enter your full name" x-bind:required="withdrawMethod === 'Alipay'" />
                        </div>
                    </div>

                    <!-- WECHAT PAY FIELDS -->
                    <div x-show="withdrawMethod === 'WeChat Pay'" x-transition>
                        <div class="mb-6">
                            <label for="wechatId" class="block text-sm font-medium text-gray-700 mb-1">WeChat ID</label>
                            <input type="text" name="wechatId" id="wechatId" x-model="wechatId"
                                class="block w-full px-4 py-3 border border-gray-200 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all"
                                placeholder="Enter your WeChat ID" x-bind:required="withdrawMethod === 'WeChat Pay'" />
                        </div>

                        <div class="mb-6">
                            <label for="wechatName" class="block text-sm font-medium text-gray-700 mb-1">Full
                                Name</label>
                            <input type="text" name="wechatName" id="wechatName" x-model="wechatName"
                                class="block w-full px-4 py-3 border border-gray-200 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all"
                                placeholder="Enter your full name" x-bind:required="withdrawMethod === 'WeChat Pay'" />
                        </div>
                    </div>

                    <!-- PIN INPUT - required for all methods -->
                    <div class="mb-6 mt-8">
                        <label for="pin_input" class="block text-sm font-medium text-gray-700 mb-1">Transaction
                            PIN</label>
                        <div class="relative rounded-lg">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i data-lucide="key" class="h-5 w-5 text-gray-400"></i>
                            </div>
                            <input type="password" name="pin" id="pin_input" x-model="pin" pattern="[0-9]+"
                                minlength="4" maxlength="10"
                                class="block w-full pl-10 pr-10 py-3 border border-gray-200 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all"
                                placeholder="Enter your 4-10 digit PIN" required />
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <button type="button" class="text-gray-400 hover:text-gray-500 focus:outline-none"
                                    @click="document.getElementById('pin_input').type = document.getElementById('pin_input').type === 'password' ? 'text' : 'password'">
                                    <i data-lucide="eye" class="h-5 w-5"
                                        x-show="document.getElementById('pin_input').type === 'password'"></i>
                                    <i data-lucide="eye-off" class="h-5 w-5"
                                        x-show="document.getElementById('pin_input').type === 'text'"></i>
                                </button>
                            </div>
                        </div>
                        <p class="mt-1 text-xs text-gray-500">This is your transaction PIN, not your login password</p>
                    </div>

                    <!-- Description/Note (Optional) -->
                    <div class="mb-8">
                        <label for="Description" class="block text-sm font-medium text-gray-700 mb-1">Note
                            (Optional)</label>
                        <div class="relative rounded-lg">
                            <div class="absolute top-3 left-3 flex items-start pointer-events-none">
                                <i data-lucide="message-square" class="h-5 w-5 text-gray-400"></i>
                            </div>
                            <textarea name="Description" id="Description" x-model="description" rows="3"
                                class="block w-full pl-10 pr-3 py-3 border border-gray-200 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all resize-none"
                                placeholder="Optional payment description or note"></textarea>
                        </div>
                    </div>

                    <!-- Transaction Details Summary -->
                    <div x-show="amount > 0 && withdrawMethod !== ''"
                        class="bg-gradient-to-br from-gray-50 to-white rounded-lg p-5 mb-6 border border-gray-100 shadow-sm">
                        <div class="flex items-center mb-4">
                            <i data-lucide="clipboard-list" class="h-5 w-5 text-primary-500 mr-2"></i>
                            <h3 class="text-sm font-medium text-gray-700">Transaction Summary</h3>
                        </div>
                        <div class="space-y-3">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-500">Amount</span>
                                <span class="font-medium text-gray-700"
                                    x-text="amount ? '{{ config('currencies.'.Auth::user()->currency, '$') }}' + parseFloat(amount).toFixed(2) : '{{ config('currencies.'.Auth::user()->currency, '$') }}0.00'"></span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-500">Fee</span>
                                <span class="font-medium text-gray-700">{{ config('currencies.'.Auth::user()->currency,
                                    '$') }}0.00</span>
                            </div>
                            <div class="border-t border-gray-200 pt-3 mt-3">
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-700 font-medium">Total</span>
                                    <span class="font-bold text-xl text-gray-900"
                                        x-text="amount ? '{{ config('currencies.'.Auth::user()->currency, '$') }}' + parseFloat(amount).toFixed(2) : '{{ config('currencies.'.Auth::user()->currency, '$') }}0.00'"></span>
                                </div>
                            </div>
                            <div class="flex justify-between items-center pt-1">
                                <span class="font-medium text-gray-500">New Balance After Transfer</span>
                                <span class="text-gray-900"
                                    x-text="'{{ config('currencies.'.Auth::user()->currency, '$') }}' + ({{ Auth::user()->account_bal }} - parseFloat(amount)).toFixed(2)"></span>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row sm:space-x-4">
                        <button type="submit"
                            class="w-full mb-3 sm:mb-0 inline-flex items-center justify-center px-6 py-3.5 border border-transparent rounded-lg shadow-sm text-base font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-colors relative overflow-hidden"
                            :disabled="isSubmitting || !withdrawMethod || !amount"
                            :class="{ 'opacity-60 cursor-not-allowed': !withdrawMethod || !amount }">
                            <span class="relative z-10 flex items-center">
                                <i data-lucide="send" class="h-5 w-5 mr-2"
                                    :class="{ 'animate-pulse': isSubmitting }"></i>
                                <span x-text="isSubmitting ? 'Processing...' : 'Continue to Transfer'"></span>
                            </span>
                            <span
                                class="absolute inset-0 bg-gradient-to-r from-primary-600 to-primary-500 transform transition-transform duration-300 ease-out"
                                :class="{ 'translate-x-full': !amount || !withdrawMethod }"></span>
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
                    <h3 class="text-sm font-medium text-gray-900">Secure Transaction</h3>
                    <p class="text-xs text-gray-500 mt-1">All transfers are encrypted and processed securely. Never
                        share your PIN with anyone.</p>
                </div>
            </div>
        </div>

        <!-- Transfer Preview Modal -->
        <div x-show="showPreview" class="fixed inset-0 z-50 overflow-y-auto" x-cloak>
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div x-show="showPreview" x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                    x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0" class="fixed inset-0 transition-opacity"
                    @click="showPreview = false">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <div x-show="showPreview" x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                    @click.away="showPreview = false">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div
                                class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-primary-100 sm:mx-0 sm:h-10 sm:w-10">
                                <i data-lucide="check-circle" class="h-6 w-6 text-primary-600"></i>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">
                                    Confirm Your Transfer
                                </h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">
                                        Please review your transfer details before confirming. Once submitted, this
                                        transaction cannot be reversed.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-5 border-t border-gray-200 pt-4">
                            <div class="space-y-3">
                                <div class="flex justify-between text-sm">
                                    <span class="font-medium text-gray-500">Transfer Method</span>
                                    <span class="text-gray-900" x-text="withdrawMethod"></span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="font-medium text-gray-500">Amount</span>
                                    <span class="text-gray-900 font-bold"
                                        x-text="'{{ config('currencies.'.Auth::user()->currency, '$') }}' + parseFloat(amount).toFixed(2)"></span>
                                </div>

                                <!-- Wire Transfer Details -->
                                <template x-if="withdrawMethod === 'Wire Transfer'">
                                    <div class="space-y-3">
                                        <div class="flex justify-between text-sm">
                                            <span class="font-medium text-gray-500">Recipient</span>
                                            <span class="text-gray-900" x-text="accountName"></span>
                                        </div>
                                        <div class="flex justify-between text-sm">
                                            <span class="font-medium text-gray-500">Account Number</span>
                                            <span class="text-gray-900" x-text="accountNumber"></span>
                                        </div>
                                        <div class="flex justify-between text-sm">
                                            <span class="font-medium text-gray-500">Bank</span>
                                            <span class="text-gray-900" x-text="bankName"></span>
                                        </div>
                                    </div>
                                </template>

                                <!-- Cryptocurrency Details -->
                                <template x-if="withdrawMethod === 'Cryptocurrency'">
                                    <div class="space-y-3">
                                        <div class="flex justify-between text-sm">
                                            <span class="font-medium text-gray-500">Cryptocurrency</span>
                                            <span class="text-gray-900"
                                                x-text="cryptoCurrency + ' (' + cryptoNetwork + ')'"></span>
                                        </div>
                                        <div class="flex justify-between text-sm">
                                            <span class="font-medium text-gray-500">Wallet Address</span>
                                            <span class="text-gray-900 truncate max-w-[220px]"
                                                x-text="walletAddress"></span>
                                        </div>
                                    </div>
                                </template>

                                <!-- Common fields -->
                                <div class="pt-3 border-t border-gray-200">
                                    <div class="flex justify-between text-sm">
                                        <span class="font-medium text-gray-500">Total Amount</span>
                                        <span class="text-gray-900 font-bold"
                                            x-text="'{{ config('currencies.'.Auth::user()->currency, '$') }}' + parseFloat(amount).toFixed(2)"></span>
                                    </div>
                                    <div class="flex justify-between text-sm mt-1">
                                        <span class="font-medium text-gray-500">New Balance</span>
                                        <span class="text-gray-900"
                                            x-text="'{{ config('currencies.'.Auth::user()->currency, '$') }}' + ({{ Auth::user()->account_bal }} - parseFloat(amount)).toFixed(2)"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="button"
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-primary-600 text-base font-medium text-white hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 sm:ml-3 sm:w-auto sm:text-sm"
                            @click="submitForm()" :disabled="isSubmitting">
                            <span x-show="!isSubmitting">Confirm Transfer</span>
                            <span x-show="isSubmitting" class="flex items-center">
                                <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                        stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>
                                Processing...
                            </span>
                        </button>
                        <button type="button"
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                            @click="showPreview = false" :disabled="isSubmitting">
                            Cancel
                        </button>
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