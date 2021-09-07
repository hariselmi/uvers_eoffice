<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class ReceivingItem extends Model
{
    public function item()
    {
        return $this->belongsTo('App\Item');
    }

    public function saveReceivingItem($item, $receiving_id)
    {
        $this->receiving_id = $receiving_id;
        $this->item_id = $item->item_id;
        $this->cost_price = $item->cost_price;
        // $this->selling_price = $item->selling_price;
        $this->quantity = $item->quantity;
        $this->total_cost = $item->total_cost;
        // $this->total_selling = $item->total_selling;
        $this->save();
    }

    public function getAllByReceivingId($receiving_id)
    {
        return $this->where('receiving_id', $receiving_id)->get();
    }
}
