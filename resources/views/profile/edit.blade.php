@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-4xl font-black text-purple-900 mb-8">👤 Profile Settings</h1>

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
