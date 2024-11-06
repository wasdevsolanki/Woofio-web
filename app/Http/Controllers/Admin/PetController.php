<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Pet;
use App\Models\QR;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Collection;

class PetController extends Controller
{
    public function index() {


//        $firstArray = [
//        "6425f33f-bdd0-43ee-9d1f-04e9bb3860a5",
//        "ce551d76-bfc9-468e-a0e1-e35f9fb21498",
//        "b2834157-b7f8-4d04-a054-ea05ef96d33c",
//        "ca8dd398-f5b6-47ed-a70b-4aeba1553ab3",
//        "ed3fc121-7bb6-444c-98f1-610ecadfa93a",
//        "b25a2b8b-87f8-421c-94d7-41d82f8080e7",
//        "4e4ab613-9619-4270-b281-9cf8a591c7e7",
//        "e6d2b026-3002-458e-a654-d80ef5658c2b",
//        "a1e5e19b-ca37-422a-bb67-4db5b41f0341",
//        "d0a7bca6-f4c3-44aa-a216-e0358891bd35",
//        "R1L1gvhwv1y8NuWjBIPa8dckbD6RNj",
//        "07b15ba0-20a9-45de-b097-ee8a2a8ce2ca",
//        "42a6cc3a-12d0-443a-9840-329409a337b6",
//        "c0e2dc69-49d1-4e9b-b535-86c8e5b9232a",
//        "d74c0994-3aad-4c50-9160-d6cd5f00ded4",
//        "23b83698-f912-4cfb-a25d-d447e847ecac",
//        "b21b92bf-60d5-41d4-ae7f-36e52bbeb39e",
//        "14bf3337-ac4b-4868-8d73-7e12d8bcdbe1",
//        "68c33ece-fa80-4f81-b89b-b608660f912d",
//        "znw1OVL2Q2UXiR9f4wJGYgCuSPaWjj",
//        "9d766437-4a97-4d4c-b690-3244aaa601b3",
//        "29d38476-53ff-4afd-a4c6-7402b174c26d",
//        "37918b8c-a045-4153-bd14-2f1d0d8b6005",
//        "pxs6LAN9LVneHO08EtnOELIz9d8d9D",
//        "0a9a157a-888a-4a76-b95e-29e8891b0067",
//        "84355a3e-4159-463d-b7fd-938c4126505b",
//        "1aafc8c3-e11d-453b-a852-59b5e578c81c",
//        "b2e330ca-e3fe-432d-ae63-babf6b73d04e",
//        "e0ba2996-f4a1-480d-85ab-e1112a1f39af",
//        "adc66d2b-ab68-463f-a8e7-e2612bfe926b",
//        "556d80a1-b905-46c2-a144-0227821fad29",
//        "3e143156-4f74-4dff-91d9-436a3944f995",
//        "be4b4133-c8f6-4562-b74f-ada648ac0f32",
//        "0115ef19-b3f3-49cb-a433-86c13ddbeaf6",
//        "795f588f-41ac-49fc-9aa8-4fe86e80bf02",
//        "cd1516a6-6ab7-4251-b540-e8c5f379c5e6",
//        "70efb4b4-54f5-4575-88c8-949d18a01c29",
//        "69ac7f36-ecf1-4e91-9486-3dea1879cf22",
//        "5cd9e7d3-01a1-4b24-b875-765724f9cfe1",
//        "617dad52-aa0f-4865-a4c6-045f30c865df",
//        "b362208b-f8c6-4a9d-b8be-8ff04ac25df7",
//        "4698e783-ebd8-49ac-8bf2-c5521ff320cc",
//        "e0eba581-fd32-4c23-8cf8-8a053fce5eb9",
//        "e3e2a8bc-3caa-435c-957e-ed058a6281b7",
//        "0ee30de5-ad51-4ffa-95fb-c345be5e93e4",
//        "261072a1-1ba5-4f37-a280-7ee8d328ca32",
//        "f85e658b-765c-4c67-9f95-aae1064ba104",
//        "348c7af3-5508-40bf-bddc-16118ba1bfdf",
//        "f2961ce7-0bc3-419b-88e0-dd4407e3381f",
//        "77df9a6b-43cd-4827-acdd-b16b30c9df71",
//        "23292928-1ff8-45e2-994d-c0e9ed0b003e",
//        "6cb4afe8-2f67-424b-a8ea-2fef2ffa34d4",
//        "a8a7de93-d707-4154-a2b6-e03d694b9389",
//        "3f11c188-315d-438d-ac83-a51e877fdd95",
//        "701aea2d-d1e0-42d0-8ef9-105ddf404057",
//        "f8873180-d3cd-4a66-a9a1-6767c2a93e10",
//        "ba0ddadf-e43c-41e0-8bb1-e722258ab3ae",
//        "d3dc223b-f4cf-433f-9ad5-200f9253fe6e",
//        "abd501fe-655b-4fe1-ab04-9c321bbdc248",
//        "6dfdc007-2b18-49e1-9202-508f3fc5df35",
//        "58bacd11-d7b4-45be-aa31-47cd09bb71e2",
//        "71842556-ca8d-4ccc-bcf0-f9495d7cc4cc",
//        "24f6825d-69f3-479f-90d5-3059a3b57aa9",
//        "65625513-b428-49b2-9449-b9c86f1e8e19",
//        "4e7ed1d6-920f-4f35-a2bf-27897c5311b5",
//        "45e56207-caa7-4f33-95a5-43d75f66e387",
//        "288ea507-1564-4ec0-9ac1-c836ac00c3d7",
//        "a4215cad-da1f-4705-bb4a-f32a52407a4c",
//        "2447458d-600d-4e28-a52c-00a563850a91",
//        "8fc97af4-5a52-497f-9d9b-bb5039d8a114",
//        "93cd492e-628c-4c85-9ae0-13a53b77cc56",
//        "990c154d-c556-462e-ab1d-e63b6c265cb4",
//        "e7d79208-2146-407c-ae54-450e34fac059",
//        "5f3b4c19-cea6-4d61-8c65-5c602da4d967",
//        "d1a00d97-f158-4a7b-9b4c-a8d0d67f4436",
//        "cf6ca4d2-9c12-4d2c-b539-5dc546ca8253",
//        "ea794b1b-02ca-4249-89ed-6ce342e01c2f",
//        "9e0bf2fc-1b24-4447-859a-1aa47b1fce78",
//        "18905c56-deac-488d-93d3-706152779abc",
//        "b8466168-0a86-4aaa-9aa1-51bcc3c21822",
//        "57000ede-25a4-4bfb-9927-91a5d0413318",
//        "a537a7a5-6b2e-4de1-93fe-77b5876bde86",
//        ];

//        foreach ($firstArray as $item) {
//            QR::where('code', $item)->update(['Order_Id' => 18]);
//        }
        

        if(Auth::user() === null){
            return redirect()->route('login');
        }
        $pets = Pet::with(['users', 'qrcodes'])->orderByDesc('id')->get();
        return view('admin.pet.index', compact('pets'));
    }

    public function Edit(Request $request){

        $pet = Pet::where('id', $request->pet_id)->where('user_id', $request->user_id)->first();
        if($pet){
            return view('front.edit_pet', compact('pet'));
        }else{
            return redirect()->back();
        }
    }

    public function update(Request $request)
    {

        $validatedData = $request->validate([
           'pet_name' => 'required|string',
           'pet_age' => 'required',
           'gender' => 'required',
           'profile' => 'nullable|image|mimes:jpeg,png,jpg,gif',
           'special_instruction' => 'nullable|string',
        ]);


        $pet = Pet::findOrFail($request->pet_id);

        if ($request->hasFile('latest_profile') && file_exists(public_path('uploaded_files/pet') . '/' . $pet->profile)) {
            $oldProfilePath = public_path('uploaded_files/pet') . '/' . $pet->profile;

            if (file_exists($oldProfilePath)) {
                unlink($oldProfilePath);
            }
        }

        // Update pet information
        $pet->pet_name = $validatedData['pet_name'];
        $pet->pet_age = $validatedData['pet_age'];
        $pet->gender = $validatedData['gender'];
        $pet->special_instruction = $validatedData['special_instruction'];

        if ($request->hasFile('latest_profile')) {
            $image = $request->file('latest_profile');
            $imagePetName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploaded_files/pet'), $imagePetName);
            $pet->profile = $imagePetName;
        }

        $pet->save();

        return redirect()->route('user.dashboard');
    }

    public function Store(Request $request){

        // Validate the incoming form data
        $validatedData = $request->validate([
            'pet_name' => 'required',
            'pet_age' => 'required',
            'qr_id' => 'required',
            'pet_breed' => 'required',
            'category' => 'required',
            'pet_gender' => 'required',
            'pet_profile' => 'required|image|mimes:jpeg,png',
        ]);

        $user = Auth::user();
        $qr = QR::where('code', $request->qr_id)->first();

        if ($request->hasFile('pet_profile')) {
            $image = $request->file('pet_profile');
            $imagePetName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploaded_files/pet'), $imagePetName);
        } else {
            return redirect()->back()->with('error', 'Pet Profile is required!');
        }

        $pet = new Pet();
        $pet->user_id = $user->id;
        $pet->qr_id = $qr->id;
        $pet->pet_name = $validatedData['pet_name'];
        $pet->gender = $validatedData['pet_gender'];
        $pet->pet_age = $validatedData['pet_age'];
        $pet->profile = $imagePetName;
        $pet->category = $validatedData['category'];
        $pet->breed = $validatedData['pet_breed'];
        $pet->special_instruction = $request->pet_special_instruction ?? '';
        $pet->save();

        QR::where('id', $qr->id)->update(['status' => 'active']);

        return redirect()->back()->with('success', 'User created successfully.');
    }
    
    public function deletePet($id)
    {
        $pet = Pet::Find($id);
        if ($pet && !empty($pet->profile)) {
            $ProfilePath = public_path('uploaded_files/pet') . '/' . $pet->profile;
            if ( $pet->profile != "" && file_exists($ProfilePath)) {
                unlink($ProfilePath);
            }
        }
        if($pet){
            if($pet->vaccines()) {
                $pet->vaccines()->delete();
            }
            $pet->delete();
            return redirect()->back()->with('success', 'Pet Deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'something went wrong!.');
        }
    }
}



















