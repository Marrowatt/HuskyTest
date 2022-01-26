<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Delivery;
use App\Http\Requests\DeliveryStoreRequest;
use App\Models\Address;

class DeliveryController extends Controller
{
    public function getDeliveries () {
        
        $deliveries = Delivery::get();

        $delivery = array();

        foreach ($deliveries as $d) {

            $array = [
                'id' => $d->id,
                'client' => $d->client->name,
                'deliver' => $d->deliver ? $d->deliver->name : "Sem Entregador",
                'collect' => $d->collect_point->address(),
                'destination' => $d->destination_point->address(),
                'collect_point' => $d->collect_point,
                'destination_point' => $d->destination_point,
                'status' => $d->status->name,
            ];

            array_push($delivery, $array);
        }

        return $delivery;
    }

    public function storeDelivery (DeliveryStoreRequest $request) {

        $collect_point = Address::create([
            'street' => $request->collect_point['street'],
            'number' => $request->collect_point['number'],
            'complement' => $request->collect_point['complement'],
            'neighborhood' => $request->collect_point['neighborhood'],
            'zipcode' => $request->collect_point['zipcode'],
            'latitude' => "",
            'longitude' => "",
            'city' => $request->collect_point['city'],
            'state' => $request->collect_point['state'],
            'country' => "Brasil"
        ]);
        
        $destination_point = Address::create([
            'street' => $request->destination_point['street'],
            'number' => $request->destination_point['number'],
            'complement' => $request->destination_point['complement'],
            'neighborhood' => $request->destination_point['neighborhood'],
            'zipcode' => $request->destination_point['zipcode'],
            'latitude' => "",
            'longitude' => "",
            'city' => $request->destination_point['city'],
            'state' => $request->collect_point['state'],
            'country' => "Brasil"
        ]);

        $delivery = Delivery::create([
            'user_id' => $request->client_id, 
            'deliver_id' => $request->deliver_id ? $request->deliver_id : null, 
            'collect_point_id' => $collect_point->id, 
            'destination_point_id' => $destination_point->id,
            'status_id' => 1
        ]);

        return true;
    }

    public function updateDelivery (Delivery $delivery, DeliveryStoreRequest $request) {

        $collect_point = Address::where('id', $delivery->collect_point_id)->first();

        $collect_point->update([
            'street' => $request->collect_point['street'],
            'number' => $request->collect_point['number'],
            'complement' => $request->collect_point['complement'],
            'neighborhood' => $request->collect_point['neighborhood'],
            'zipcode' => $request->collect_point['zipcode'],
            'city' => $request->collect_point['city'],
            'state' => $request->collect_point['state'],
        ]);

        $destination_point = Address::where('id', $delivery->destination_point_id)->first();

        $destination_point->update([
            'street' => $request->collect_point['street'],
            'number' => $request->collect_point['number'],
            'complement' => $request->collect_point['complement'],
            'neighborhood' => $request->collect_point['neighborhood'],
            'zipcode' => $request->collect_point['zipcode'],
            'city' => $request->collect_point['city'],
            'state' => $request->collect_point['state'],
        ]);

        $delivery->update([
            'user_id' => $request->client_id, 
            'deliver_id' => $request->deliver_id ? $request->deliver_id : null, 
        ]);

        return true;
    }
    
    public function updateStatusDelivery (Delivery $delivery, Request $request) {

        $this->validate($request, [
            'status_id' => ['required', 'integer', 'exists:statuses,id']
        ]);

        $delivery->update([
            'status_id' => $request->status_id,
        ]);

        return true;
    }
    
    public function updateDeliverDelivery (Delivery $delivery, Request $request) {

        $this->validate($request, [
            'deliver_id' => ['required', 'integer', 'exists:users,id']
        ]);

        $delivery->update([
            'deliver_id' => $request->deliver_id,
        ]);

        return true;
    }
}
