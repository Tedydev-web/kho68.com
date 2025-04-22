<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Order;
use App\Models\SocialAccountProduct;

class SocialOrderDetail extends Component
{
    public $orderId;
    public $socialAccountProduct;

    public function mount($id)
    {
        // Lấy thông tin sản phẩm tài khoản mạng xã hội dựa trên ID đơn hàng
        $this->orderId = $id;
        $this->socialAccountProduct = SocialAccountProduct::where('id', $id)->firstOrFail();
    }

    public function downloadData()
    {
        $fileName = 'social_account_data_' . $this->orderId . '.txt';
        $data = $this->socialAccountProduct->data_account;

        return response()->streamDownload(function() use ($data) {
            echo $data;
        }, $fileName);
    }

    public function render()
    {
        return view('livewire.social-order-detail', [
            'socialAccountProduct' => $this->socialAccountProduct,
        ]);
    }
}
