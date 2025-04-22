<div>
    @for ($i = 1; $i <= 5; $i++)
        @if ($i <= $rating)
            <span role="img" aria-label="star">⭐</span> <!-- Sử dụng emoji sao -->
        @else
            <span role="img" aria-label="star">☆</span> <!-- Sử dụng sao rỗng -->
        @endif
    @endfor
</div>
