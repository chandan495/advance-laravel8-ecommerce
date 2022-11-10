<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShipDivision;
use Carbon\Carbon;
use App\Models\ShipDistrict;
use App\Models\ShipState;

class ShippingAreaController extends Controller
{
    public function DivisionView(){
        $shipdivision = ShipDivision::orderBy('id','DESC')->get();
        return view('backend.shipping.division.division_view', compact('shipdivision'));
    }

    public function DivisionStore(Request $request){
        $request->validate([
            'division_name' => 'required',
        ],[
            'division_name.required' => 'Enter Division Name',
        ]);
        ShipDivision::insert([
            'division_name' =>$request->division_name,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Division Inserted Successfully',
            'alert_type' => 'success'
        );
        return redirect()->back()->with($notification);

    }
    public function DivisionEdit($id){
        $division = ShipDivision::findOrFail($id);
        return view('backend.shipping.division.edit_division',compact('division'));
    }

    public function DivisionUpdate(Request $request){
        $divisionid = $request->id;
        $request->validate([
            'division_name' => 'required',
        ],[
            'division_name.required' => 'Enter Division Name',
        ]);
        ShipDivision::findOrFail($divisionid)->update([
            'division_name' => $request->division_name,
        ]);
        $notification = array(
            'message' => 'Division Updated Successfully',
            'alert_type' => 'success'
        );
        return redirect()->route('manage-division')->with($notification);
    }
    public function DivisionDelete($id){
        ShipDivision::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Division Deleted Successfully',
            'alert_type' => 'success'
        );
        return redirect()->back()->with($notification);

    }
    ///ship district
    public function DistrictView(){
        $shipdivision = ShipDivision::orderBy('division_name','DESC')->get();
        $shipdistrict = ShipDistrict::with('division')->orderBy('id','DESC')->get();
        return view('backend.shipping.district.district_view', compact('shipdistrict','shipdivision'));
    }

    public function DistrictStore(Request $request){
        $request->validate([
            'district_name' => 'required',
            'division_id' => 'required',
        ],[
            'division_id.required' => 'Enter Division Name',
            'district_name.required' => 'Enter Division Name',
        ]);
        ShipDistrict::insert([
            'division_id' =>$request->division_id,
            'district_name' =>$request->district_name,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Division Inserted Successfully',
            'alert_type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    public function DistrictEdit($id){
        $shipdivision = ShipDivision::orderBy('division_name','DESC')->get();
        //$shipdistrict = ShipDistrict::findOrFail($id)->get();
        $shipdistrict = ShipDistrict::findOrFail($id);
        return view('backend.shipping.district.district_edit', compact('shipdistrict','shipdivision'));
    }

    public function DistrictUpdate(Request $request){

        $district_id = $request->id;
        $request->validate([
            'district_name' => 'required',
            'division_id' => 'required',
        ],[
            'division_id.required' => 'Enter Division Name',
            'district_name.required' => 'Enter Division Name',
        ]);
        ShipDistrict::findOrFail($district_id)->update([
            'division_id' =>$request->division_id,
            'district_name' =>$request->district_name,
        ]);
        $notification = array(
            'message' => 'Division Updated Successfully',
            'alert_type' => 'success'
        );
        return redirect()->route('manage-district')->with($notification);
    }
    public function DistrictDelete($id){
        ShipDistrict::findOrFail($id)->delete();
        $notification = array(
            'message' => 'District Updated Successfully',
            'alert_type' => 'success'
        );
        return redirect()->back()->with($notification);

    }
    //state function
    public function StateView(){
        $shipdivision = ShipDivision::orderBy('division_name','DESC')->get();
        $shipdistrict = ShipDistrict::orderBy('district_name','DESC')->get();
        $shipstates = ShipState::orderBy('id','DESC')->get();
        return view('backend.shipping.state.state_view', compact('shipdistrict','shipdivision','shipstates'));
        
    }
    public function GetDistrict($district_id){
        $subsubcat = ShipDistrict::where('division_id', $district_id)->orderBy('district_name', 'ASC')->get();
        return json_encode($subsubcat);
    }
    public function StateStore(Request $request){
        $request->validate([
            'state_name' => 'required',
            'division_id' => 'required',
            'district_id' => 'required',
        ],[
            'division_id.required' => 'Enter Division Name',
            'state_name.required' => 'Enter Division Name',
            'district_id.required' => 'Enter Division Name',
        ]);
        ShipState::insert([
            'division_id' =>$request->division_id,
            'district_id' =>$request->district_id,
            'state_name' =>$request->state_name,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Stat Data has Inserted Successfully',
            'alert_type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    public function StateEdit($id){
        $shipdivision = ShipDivision::orderBy('division_name','DESC')->get();
        $shipdistrict = ShipDistrict::orderBy('district_name','DESC')->get();
        $shipstates = ShipState::findOrFail($id);
        return view('backend.shipping.state.state_edit', compact('shipdistrict','shipdivision','shipstates'));
        
    }
    public function StateUpdate(Request $request){
        $state_id = $request->id;
        $request->validate([
            'district_id' => 'required',
            'division_id' => 'required',
            'state_name' => 'required',
        ],[
            'division_id.required' => 'Enter Division Name',
            'district_id.required' => 'Enter Division Name',
            'state_name.required' => 'Enter Division Name',
        ]);
        ShipState::findOrFail($state_id)->update([
            'division_id' =>$request->division_id,
            'district_id' =>$request->district_id,
            'state_name' =>$request->state_name,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'State Updated Successfully',
            'alert_type' => 'success'
        );
        return redirect()->route('manage-state')->with($notification);
    }
    public function StateDelete($id){
        ShipState::findOrFail($id)->delete();
        $notification = array(
            'message' => 'State Deleted Successfully',
            'alert_type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
