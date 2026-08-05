@extends('example_staff.layouts.default.dashboard')

@section('title', 'Profile')

@section('content')

<div class="p-4">

    <h1 class="text-2xl font-bold text-gray-900 mb-6">
        Edit Profil
    </h1>

    @include('profile.partials.update-profile-information-form')

</div>

@endsection