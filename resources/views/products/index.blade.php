@extends('layouts.app')

@section('content')
    <div class="flex justify-center py-5">
        <div class="w-8/12 bg-gray-200 p-6 rounded-lg">


            @if ($products->count())
            @foreach ($products as $product)
                <div class="mb-4">
                    <a href="{{ route('users.show', $product->user->username) }}">
                        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">{{ $product->user->name }}</span>
                    </a>
                        <span class="text-gray-600 text-sm">{{ $product->created_at->diffForHumans() }}</span>
                        <a href="{{ route('products.show', $product) }}" class="block hover:bg-gray-50 p-4 rounded"><h2>{{ $product->title }}</h2></a>
                        <p class="mb-2">{{ $product->body }}</p>

                        <!-- Display image -->
                        @if ($product->image)
                            <div class="mb-4">
                                <img src="{{ asset('storage/images/' . $product->image) }}" alt="Product Image">
                            </div>
                        @endif

                        @auth
                            @php
                                $userRating = $product->ratings()->where('user_id', auth()->id())->value('rating');
                                $averageRating = $product->ratings()->average('rating');
                            @endphp

                            <form method="POST" action="{{ route('product-ratings.store', $product) }}">
                                @csrf
                                <select name="rating">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                                <button type="submit">Submit Rating</button>
                            </form>
                            <p>User rating: {{ round($userRating) }}</p>
                            <p>Average rating: {{ round($averageRating) }}</p>
                        @endauth


                    <!-- Display categories -->
                    <div class="mb-2">
                        @if ($product->category)
                        <a href="{{ route('categories.show', $product->category->id) }}">
                            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">{{ $product->category->name }}</span>
                        </a>
                    @endif
                    </div>

                        <!-- Display tags -->
                        <div class="mb-2">
                            @foreach ($product->tags as $tag)
                            <a href="{{ route('tags.show', $tag->id) }}">
                                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">{{ $tag->name }}</span>
                            </a>
                        @endforeach
                        </div>



                        <div class="flex items center">
                            <form action="" method="post" class="mr-1">
                                @csrf
                                <button type="submit" class="text-blue-500">Like</button>
                            </form>

                            <form action="" method="post" class="mr-1">
                                @csrf
                                <button type="submit" class="text-blue-500">Unlike</button>
                            </form>
                        </div>
                </div>

                            <!-- Button trigger modal -->
                            <form method="POST" action="{{ route('cart.add') }}">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="number" name="quantity" value="1" min="1">
                                <button type="submit">Add to Cart</button>
                            </form>
            @endforeach


  <!-- Modal -->
  <div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="cartModalLabel">Cart</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">Product</th>
                <th scope="col">Quantity</th>
                <th scope="col">Price</th>
              </tr>
            </thead>
            <tbody>
              @foreach($cartItems as $item)
              <tr>
                <td>{{ $item->product->name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ $item->product->price * $item->quantity }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
          {{ $cartItems->links() }}
        </div>
        <div class="modal-footer">
          <h5>Total Price: {{ $totalPrice }}</h5>
        </div>
      </div>
    </div>
  </div>

                {{ $products->links() }}
            @else
                <p>There are no products</p>
            @endif
        </div>
    </div>


@endsection

@section('scripts')
<script>
    document.getElementById('add-to-cart-form').addEventListener('submit', function(event) {
        event.preventDefault();

        fetch(this.action, {
            method: 'POST',
            body: new FormData(this),
            headers: {
                'X-CSRF-TOKEN': this.querySelector('input[name="_token"]').value
            }
        })
        .then(response => response.text())
        .then(data => {
            // Update the modal content with the new cart data
            document.getElementById('cartModal').innerHTML = data;

            // Show the modal
            var myModal = new bootstrap.Modal(document.getElementById('cartModal'), {});
            myModal.show();
        });
    });
</script>
@endsection
