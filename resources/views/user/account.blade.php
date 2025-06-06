@extends('layouts.app')

@section('content')
<h2>Personal Information</h2>
<p>Manage your personal information, including phone numbers, email and billing address</p>

<form method="POST" action="{{ route('profile.update') }}" class="info-card">
    @csrf
    @method('PUT')
    <table>
        <tr>
            <td>Name:</td>
            <td><input type="text" class="input-field" name="name" value="{{ Auth::user()->name }}" readonly></td>
        </tr>
        <tr>
            <td>Email:</td>
            <td><input type="email" class="input-field" name="email" value="{{ Auth::user()->email }}" readonly></td>
        </tr>
        <tr>
            <td>Phone Number:</td>
            <td><input type="tel" class="input-field" name="phone" value="{{ Auth::user()->phone }}" readonly></td>
        </tr>
        <tr>
            <td>Date of Birth:</td>
            <td><input type="date" class="input-field" name="dob" value="{{ Auth::user()->dob }}" readonly></td>
        </tr>
        <tr>
            <td>Gender:</td>
            <td><input type="text" class="input-field" name="gender" value="{{ Auth::user()->gender }}" readonly></td>
        </tr>
        <tr>
            <td>Billing Address:</td>
            <td><input type="text" class="input-field" name="billing_address" value="{{ Auth::user()->billing_address }}" readonly></td>
        </tr>
        <tr>
            <td>Shipping Address:</td>
            <td><input type="text" class="input-field" name="shipping_address" value="{{ Auth::user()->shipping_address }}" readonly></td>
        </tr>
    </table>

    <div id="edit-buttons">
        <button type="button" class="btn btn-primary" id="edit-button" onclick="enableEdit()">Edit</button>
        <button type="submit" class="btn btn-secondary" id="save-button" style="display: none;">Save</button>
        <button type="button" class="btn btn-danger" id="cancel-button" onclick="cancelEdit()" style="display: none;">Cancel</button>
    </div>
</form>

@endsection