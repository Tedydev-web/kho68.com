<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Order;

class OrderDetail extends Component
{
    public $orderId;
    public $order;

    public function mount($id)
    {
        $this->orderId = $id;
        $this->order = Order::with(['items.courseProduct', 'items.socialAccountProduct', 'items.wordpressProduct', 'items.otherProduct'])->findOrFail($id);
    }

    public function downloadData()
    {
        $fileName = 'order_' . $this->orderId . '_data.txt';

        // Lấy dữ liệu từ các sản phẩm khác nhau
        $data = $this->order->items->map(function ($item) {
            if ($item->courseProduct) {
                return $item->courseProduct->title;
            } elseif ($item->socialAccountProduct) {
                return $item->socialAccountProduct->data_account;
            } elseif ($item->wordpressProduct) {
                return $item->wordpressProduct->name;
            } elseif ($item->otherProduct) {
                return $item->otherProduct->name;
            }
        })->implode("\n\n");

        return response()->streamDownload(function() use ($data) {
            echo $data;
        }, $fileName);
    }

    public function render()
    {
        return view('livewire.order-detail', [
            'order' => $this->order,
        ]);
    }
}
