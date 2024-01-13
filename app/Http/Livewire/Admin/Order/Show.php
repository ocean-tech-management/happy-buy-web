<?php

namespace App\Http\Livewire\Admin\Order;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\PointBalance;
use App\Models\PointExecutiveBalance;
use App\Models\PointManagerBalance;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductQuantity;
use App\Models\ProductSize;
use App\Models\ProductVariant;
use App\Models\ShippingBalance;
use App\Models\State;
use App\Models\TransactionIdLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Mockery\Exception;

class Show extends Component
{
    public $order;
    public $showShippingInput = false;
    public $states;

    public $shippingFee;
    public $shippingName;
    public $shippingPhone;
    public $shippingAddress;
    public $shippingAddress2;
    public $shippingPostcode;
    public $shippingCity;
    public $shippingState;

    public $message;

    public function mount()
    {
        $this->states = State::where('status', 1)->get();
        $this->shippingState = $this->states[0]->name;

    }

    public function render()
    {
        return view('livewire.admin.order.show');
    }

    public function shippingInputToggle(){
        if($this->showShippingInput == false){
            $this->showShippingInput = true;
        }else{
            $this->showShippingInput = false;
        }
    }

    public function submit(){

        if(getUserShippingBalance($this->order->user_id) >= $this->shippingFee){
            if($this->shippingFee == null){
                $this->message = "Please enter shipping fee";
            }else{

                DB::beginTransaction();

                try{
                    Order::whereId($this->order->id)->update([
                        'collect_type' => 2,
                        'receiver_name' => $this->shippingName,
                        'receiver_phone' => $this->shippingPhone,
                        'receiver_address_1' => $this->shippingAddress,
                        'receiver_address_2' => $this->shippingAddress2,
                        'receiver_city' => $this->shippingCity,
                        'receiver_state' => $this->shippingState,
                        'receiver_postcode' => $this->shippingPostcode,
                        'total_shipping' => $this->shippingFee
                    ]);

                    if ($this->shippingFee > 0) {
                        ShippingBalance::create([
                            'amount' => '-' . $this->shippingFee,
                            'user_id' => $this->order->user_id,
                            'status' => 1,
                            'settlement' => 1,
                            'remark' => "redeem order " . $this->order->order_number,
                            'model_type' => '\App\Models\Order',
                            'model' => $this->order->id,
                        ]);
                    }

                    DB::commit();

                    return redirect()->route('admin.orders.show', [$this->order->id]);

                } catch (\Exception $e) {
                    DB::rollBack();
                    return redirect()->route('admin.orders.show', [$this->order->id]);
                }
            }
        }else{
            $this->message = "insufficient shipping balance!";
        }
    }
}
