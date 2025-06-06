@extends('layouts.app')

@section('content')
    <h2>My Orders</h2>
    <div class="order-history-card">
        <div class="order-tabs">
            <button class="order-tab active" data-tab="all">All</button>
            <button class="order-tab" data-tab="to-pay">To Pay</button>
            <button class="order-tab" data-tab="to-ship">To Ship</button>
            <button class="order-tab" data-tab="to-receive">To Receive</button>
            <button class="order-tab" data-tab="completed">Completed</button>
            <button class="order-tab" data-tab="cancelled">Cancelled</button>
            <button class="order-tab" data-tab="return-refund">Return/Refund</button>
        </div>
        <div class="order-search">
            <input type="text" placeholder="Search orders..." />
            <button class="search-btn"><i class="fa fa-search"></i></button>
        </div>
        <div class="order-content" id="order-content">
            <div data-content="all">
                <p>No orders to display (All).</p>
            </div>
            <div data-content="to-pay" style="display:none;">
                <p>No orders to pay.</p>
            </div>
            <div data-content="to-ship" style="display:none;">
                <p>No orders to ship.</p>
            </div>
            <div data-content="to-receive" style="display:none;">
                <p>No orders to receive.</p>
            </div>
            <div data-content="completed" style="display:none;">
                <p>No completed orders.</p>
            </div>
            <div data-content="cancelled" style="display:none;">
                <p>No cancelled orders.</p>
            </div>
            <div data-content="return-refund" style="display:none;">
                <p>No return/refund orders.</p>
            </div>
        </div>
    </div>
    <script>
        // Tab switching logic
        document.querySelectorAll('.order-tab').forEach(tab => {
            tab.addEventListener('click', function() {
                document.querySelectorAll('.order-tab').forEach(t => t.classList.remove('active'));
                this.classList.add('active');
                const tabName = this.getAttribute('data-tab');
                document.querySelectorAll('.order-content > div').forEach(content => {
                    content.style.display = (content.getAttribute('data-content') === tabName) ? 'block' : 'none';
                });
            });
        });
    </script>
@endsection