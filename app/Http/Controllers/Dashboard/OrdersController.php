<?php


namespace MixCode\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use MixCode\Http\Controllers\Controller;
use MixCode\Order;
use MixCode\DataTables\OrdersDataTable;
use MixCode\Notifications\orderActivated;

class OrdersController extends Controller
{
    protected $viewPath = 'dashboard.orders';

   /**
    * Display the specified resource.
    *
    * @param  \MixCode\Order  $order
    * @return \Illuminate\Http\Response
    */
   public function index(OrdersDataTable $dataTable)
   {



       if (app()->environment('testing') && request()->wantsJson()) {
           return Order::with('cards')->all();
       }

       $sectionName = trans('main.show_all') . ' ' . trans('main.orders');

       return $dataTable->render("{$this->viewPath}.index", compact('sectionName'));
   }

   /**
    * Display the specified resource.
    *
    * @param  \MixCode\Order  $order
    * @return \Illuminate\Http\Response
    */
   public function show(Order $order)
   {
       if (request()->wantsJson()) {
           return $order;
       }

       $order->load(['users','cards']);

       $sectionName = trans('main.show') . ' ' . $order->name;

       return view("{$this->viewPath}.show", compact('sectionName', 'order'));
   }



   /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \MixCode\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request , Order $order)
    {
      
        // $order->update($request->all());
        $order->update(['status' => $request->status]);
        


        $order->users->notify( new orderActivated(Order::findOrFail($request->id)));

        notify('success', trans('main.updated'));

        return redirect()->route('dashboard.orders.show', $order);
    }


   /**
    * Remove the specified resource from storage.
    *
    * @param  \MixCode\Order  $order
    * @return \Illuminate\Http\Response
    */
   public function destroy(Order $order)
   {
       $order->delete();

       notify('success', trans('main.deleted-message'));

       return redirect()->route('dashboard.orders.index');
   }

   public function destroyGroup(Request $request)
   {
       Order::destroy($request->selected_data);

       notify('success', trans('main.deleted-message'));

       return redirect()->route('dashboard.orders.index');
   }
}
