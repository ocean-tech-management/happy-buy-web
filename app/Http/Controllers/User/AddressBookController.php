<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Faker\Provider\Address;
use Illuminate\Http\Request;
use App\Models\Country;

use App\Http\Requests\MassDestroyAddressBookRequest;
use App\Http\Requests\StoreAddressBookRequest;
use App\Http\Requests\UpdateAddressBookRequest;
use App\Models\AddressBook;
use Gate;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use DB;

class AddressBookController extends Controller
{
    public function index(){
        $address_books = AddressBook::where('user_id', Auth::user()->id)->paginate(10);

        return view('user.my-address-book', ['address_books' => $address_books]);

    }
    public function create()
    {
        $countries = Country::whereStatus(1)->get();
        return view('user.add-address', compact('countries'));
    }

    public function store(StoreAddressBookRequest $request)
    {
        $addressBook_default_exist = AddressBook::where('user_id', Auth::user()->id)->where('set_default', 1)->count();

        $addressBook = AddressBook::create($request->all());

        if($addressBook_default_exist == 0){
            $addressBook->update([
                'state_id' => $request->state,
                'status' => 1,
                'set_default' => 1,
            ]);
        }else{
            $addressBook->update([
                'state_id' => $request->state,
                'status' => 1,
                'set_default' => 2,
            ]);
        }
        return redirect()->route('user.my-address-book')->with('message' , 'Add address success');
    }

    public function edit($id)
    {
        $address_book = AddressBook::find($id);

        $countries = Country::whereStatus(1)->get();
        return view('user.edit-address',compact( 'address_book','countries'));
    }

    public function update(UpdateAddressBookRequest $request, AddressBook $addressBook)
    {

        $addressBook->update($request->all());
        $addressBook->update([
            'state_id' => $request->state,
        ]);
        return redirect()->route('user.my-address-book')->with('message' , 'Update address success');
    }

    public function setAsDefault($id){
        AddressBook::where('user_id', Auth::user()->id)->update([
            'set_default' => 2,
        ]);

        AddressBook::where('id',$id)->update([
            'set_default' => 1,
        ]);

        return redirect()->route('user.my-address-book')->with('message' , 'Update address success');

    }

    public function getAddressBook(Request $request){
        $addressBook = AddressBook::where('user_id', $request->user_id)->get();

        foreach ($addressBook as $address){
            $address->country_id = $address->state->country_id;
            $address->state_name = $address->state->name;
        }

        return json_encode(['success' => true ,'address_book' => $addressBook]);
    }
}
