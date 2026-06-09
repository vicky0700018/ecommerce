@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Profile Header with Avatar -->
    <div class="bg-gradient-to-r from-purple-600 to-blue-600 text-white rounded-2xl p-8 mb-8 shadow-2xl">
        <div class="flex items-center gap-6">
            @if(auth()->user()->profile_image)
                <img src="{{ asset('storage/' . auth()->user()->profile_image) }}" alt="{{ auth()->user()->name }}" class="w-16 h-16 rounded-full object-cover border-4 border-white shadow-lg">
            @else
                <div class="w-16 h-16 rounded-full bg-white/30 flex items-center justify-center text-2xl border-4 border-white">
                    👤
                </div>
            @endif
            <div>
                <h1 class="text-4xl font-black">{{ auth()->user()->name }}'s Profile</h1>
                <p class="text-white/80 mt-2">{{ auth()->user()->email }}</p>
            </div>
        </div>
    </div>

    <h1 class="text-4xl font-black text-purple-900 mb-8">⚙️ Profile Settings</h1>

    <!-- Quick Links Section -->
    <div class="bg-white rounded-2xl shadow-2xl p-8 mb-8 border-2 border-purple-300">
        <h3 class="text-2xl font-black text-purple-900 mb-6">🔗 Quick Access</h3>
        <div class="grid grid-cols-2 gap-4">
            <a href="{{ route('profile.addresses') }}" class="bg-purple-600 text-white px-6 py-4 rounded-xl hover:bg-purple-700 font-bold text-center transition transform hover:scale-105">
                📍 Manage Addresses
            </a>
            <a href="{{ route('profile.orders') }}" class="bg-purple-600 text-white px-6 py-4 rounded-xl hover:bg-purple-700 font-bold text-center transition transform hover:scale-105">
                📦 View Orders
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-8">
        <!-- Update Profile Information -->
        <div class="bg-white rounded-2xl shadow-2xl p-8 border-2 border-purple-300">
            <h2 class="text-2xl font-black text-purple-900 mb-6">ℹ️ Profile Information</h2>
            @include('profile.partials.update-profile-information-form')
        </div>

        <!-- Update Password -->
        <div class="bg-white rounded-2xl shadow-2xl p-8 border-2 border-purple-300">
            <h2 class="text-2xl font-black text-purple-900 mb-6">🔐 Change Password</h2>
            @include('profile.partials.update-password-form')
        </div>

        <!-- Delete Account -->
        <div class="bg-white rounded-2xl shadow-2xl p-8 border-2 border-red-300">
            <h2 class="text-2xl font-black text-red-600 mb-6">⚠️ Danger Zone</h2>
            @include('profile.partials.delete-user-form')
        </div>
    </div>
</div>
@endsection
