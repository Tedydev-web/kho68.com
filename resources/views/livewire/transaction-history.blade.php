<div>
    <h3>Lịch sử giao dịch</h3>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Mã giao dịch</th>
                <th>Loại giao dịch</th>
                <th>Số tiền</th>
                <th>Trạng thái</th>
                <th>Mô tả</th>
                <th>Ngày giao dịch</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->transaction_code }}</td>
                    <td>{{ $transaction->type == 'deposit' ? 'Nạp tiền' : 'Rút tiền' }}</td>
                    <td>{{ number_format($transaction->amount, 0, ',', '.') }} VND</td>
                    <td>
                        @if($transaction->status == 'completed')
                            <span class="badge bg-success">Hoàn tất</span>
                        @elseif($transaction->status == 'pending')
                            <span class="badge bg-warning">Đang chờ</span>
                        @else
                            <span class="badge bg-danger">Thất bại</span>
                        @endif
                    </td>
                    <td>{{ $transaction->description }}</td>
                    <td>{{ $transaction->created_at->format('d/m/Y H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
