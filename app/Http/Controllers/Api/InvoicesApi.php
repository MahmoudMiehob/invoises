<?php

namespace App\Http\Controllers\Api;

use App\invoices;
use App\products;
use Illuminate\Http\Request;
use App\Http\Resources\invoiceapi;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class InvoicesApi extends Controller
{
    use apiresponse;
    public function index(){

        $invoices = invoiceapi::collection(invoices::get());
        return $this->apiresponse($invoices,200,'ok');
    }

    public function show($id){

        $invoice = invoices::find($id);
        if($invoice){
            return $this->apiresponse(new invoiceapi($invoice),200,'ok');
        }
        else{
            return $this->apiresponse(null,404,'not found');
        }
    }

    public function store(Request $request){

        $validate = Validator::make($request->all(),[
            'Product_name' => 'required',
            'section_id'   => 'required',
        ]);
        if ($validate->fails()){
            return $this->apiresponse(null,500,$validate->errors());
        }
        $pro = products::create($request->all());
        if($pro){
            return $this->apiresponse(new invoiceapi($pro),201,'the product save');
            }
        else{
            return $this->apiresponse(null,400,'error : not save');
            }
    }

    public function update(Request $request,$id){

        $validate = Validator::make($request->all(),[
            'Product_name' => 'required',
            'section_id'   => 'required',
        ]);
        if ($validate->fails()){
            return $this->apiresponse(null,500,$validate->errors());
        }
        $pro = products::find($id);
        if(!$pro){
            return $this->apiresponse(null,404,'the product not found');
        }
        $pro->update($request->all());
        if($pro){
            return $this->apiresponse(new invoiceapi($pro),201,'the product update');
        }
        else{
            return $this->apiresponse(null,400,'error : not update');
        } 
    }

    public function destroy(Request $request,$id){

        $pro = products::find($id);
        if(!$pro){
            return $this->apiresponse(null,404,'the product not found');
        }
        $pro->delete($id);
        if($pro){
            return $this->apiresponse(null,200,'the product delete');
        }
        //products::destroy($id);
        }
}
