@extends('front.layouts.app')
@section('content')

<style>
  @import url('https://fonts.googleapis.com/css2?family=Lobster+Two:ital,wght@0,400;0,700;1,400&display=swap');
    
    .inputText{
        background-image : url('/img/input-placeholder-1.png') !important;
    }
    .Pet-Register{
        background-image: url('/img/background.png') !important;
    }
    .form-row{
        width : -webkit-fill-available;
    }

</style>

<!-- Main content -->
<form method="POST" action="{{ route('pet.store') }}" enctype="multipart/form-data">
    @csrf   
    <input type="hidden" name="qr_id" value="{{ $qr_id }}">

    <div class="container">
        <div class="row .Pet-Register border p-2" style="background-image: url('/img/background.png');  font-family: 'Lobster Two', cursive ">

            <div class="row">
                <div class=col-12>
                    <h2 class="mb-4">Owner Information</h2><hr>
                </div>
            </div>

            <div class="row form-row">
                <div class="col-4 pet-lable">
                    <label for="first-name">First Name</label>
                </div>
                <div class="col-8 mb-2">
                    <input type="text" id="first-name" name="owner_first_name"  class="form-control pet-input inputText" aria-label="First name">
                    @error('owner_first_name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="row form-row">
                <div class="col-4 pet-lable">
                    <label for="last-name">Last Name</label>
                </div>
                <div class="col-8 mb-2">
                    <input type="text" id="last-name" name="owner_last_name" class="form-control pet-input inputText" aria-label="Last name">
                    @error('owner_last_name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="row form-row">
                <div class="col-4 pet-lable">
                    <label for="email">Email</label>
                </div>
                <div class="col-8 mb-2">
                    <input type="email" id="email" name="owner_email" class="form-control pet-input inputText" aria-label="Email">
                    @error('owner_email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="row form-row">
                <div class="col-4 pet-lable">
                    <label for="password">Password</label>
                </div>
                <div class="col-8 mb-2">
                    <input type="password" id="password" name="owner_password" class="form-control pet-input inputText" aria-label="Password">
                    @error('owner_password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror  
                </div>
            </div>

            <div class="row form-row">
                <div class="col-4 pet-lable">
                    <label for="contact">Contact #</label>
                </div>
                <div class="col-8 mb-2">
                    <input type="text" id="contact" name="owner_contact" class="form-control pet-input inputText" aria-label="contact">
                    @error('owner_contact')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror  
                </div>
            </div>

            <div class="row form-row">
                <div class="col-4 pet-lable">
                    <label for="gender">Gender</label>
                </div>
                <div class="col-8 mb-2">
                    <select id="gender" name="owner_gender" class="form-select inputText w-100 text-center">
                        <option class="text-dark">Male</option>
                        <option class="text-dark">Female</option>
                    </select>
                    @error('owner_gender')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror   
                </div>
            </div>

            <div class="row form-row">
                <div class="col-4 pet-lable">
                    <label for="addres">Address</label>
                </div>
                <div class="col-8 mb-2">
                    <textarea name="owner_address" class="form-control pet-input inputText text-area" id="address" ></textarea>
                    @error('owner_address')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror  
                </div>
            </div>

            <div class="row form-row">
                <div class="col-4 pet-lable">
                    <label for="profile">Profile</label>
                </div>
                <div class="col-8 ">
                    <input class="form-control" name="owner_profile" type="file" id="profile">
                    @error('owner_profile')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <!-- tAYX91wa3nRGxVlPk0oWcr0aL7nbku -->
            <!------- Pet Information -------------->
            <div class="row">
                <div class=col-12>
                    <h2 class="mb-4 mt-5">Pet Information</h2><hr>
                </div>
            </div>

            <div class="row form-row">
                <div class="col-4 pet-lable">
                    <label for="pet-name">Pet Name</label>
                </div>
                <div class="col-8 mb-2">
                    <input type="text" name="pet_name" id="pet-name" class="form-control pet-input inputText" aria-label="pet-name">
                    @error('pet_name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="row form-row">
                <div class="col-4 pet-lable">
                    <label for="age">Age</label>
                </div>
                <div class="col-8 mb-2">
                    <input type="text" name="pet_age" id="age" class="form-control pet-input inputText" aria-label="age">
                    @error('pet_age')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            
            <div class="row form-row">
                <div class="col-4 pet-lable">
                    <label for="gender">Gender</label>
                </div>
                <div class="col-8 mb-2">
                    <select id="gender" name="pet_gender" class="form-select inputText w-100 text-center">
                        <option class="text-dark">Male</option>
                        <option class="text-dark">Female</option>
                    </select>
                    @error('pet_gender')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="row form-row">
                <div class="col-4 pet-lable">
                    <label for="profile">Profile</label>
                </div>
                <div class="col-8 mb-2">
                    <input class="form-control" name="pet_profile" type="file" id="profile">
                    @error('pet_profile')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            
            <div class="row form-row">
                <div class="col-4 pet-lable">
                    <label for="instruction">Instruction</label>
                </div>
                <div class="col-8 mb-2">
                    <textarea name="pet_special_instruction" class="form-control pet-input inputText text-area" id="instruction" ></textarea>
                    @error('pet_special_instruction')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            
            <div class="row form-row">
                <div class="col-12 mb-2 d-flex justify-content-center">
                    <button type="submit" class="btn btn-light border shadow-sm btn-sm">Submit</button>
                </div>
            </div>

        </div>
    </div>
</form>

@endsection
