<div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
    {{-- Dashboard body containing order list and invoice details --}}
    <div class="fp_dashboard_body">
        <h3>order list</h3>
        {{-- Order list section --}}
        <div class="fp_dashboard_order">
            <div class="table-responsive">
                <table class="table">
                    <tbody>
                        {{-- Table header with columns for Order, Date, Status, Amount, and Action --}}
                        <tr class="t_header">
                            <th>Order</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Amount</th>
                            <th>Action</th>
                        </tr>
                        {{-- Loop through each order in the $orders variable and display its details --}}
                        @foreach ($orders as $order)
                        <tr>
                            {{-- Display the order's invoice ID --}}
                            <td>
                                <h5>#{{ $order->invoice_id }}</h5>
                            </td>
                            {{-- Display the order's creation date formatted as 'Month Day, Year' --}}
                            <td>
                                <p>{{ date('F d, Y', strtotime($order->created_at)) }}</p>
                            </td>
                            {{-- Display the order's status with corresponding styling for different statuses --}}
                            <td>
                                @if ($order->order_status === 'pending')
                                <span class="active">Pending</span>
                                @elseif ($order->order_status === 'in_process')
                                <span class="active">In Process</span>
                                @elseif ($order->order_status === 'delivered')
                                <span class="complete">Delivered</span>
                                @elseif ($order->order_status === 'declined')
                                <span class="cancel">Declined</span>
                                @endif
                            </td>
                            {{-- Display the total amount of the order using a currency position format --}}
                            <td>
                                <h5>{{ currencyPosition($order->grand_total) }}</h5>
                            </td>
                            {{-- Action button to view the invoice details of the order --}}
                            <td><a class="view_invoice" onclick="viewInvoice('{{ $order->id }}')">View Details</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {{-- Loop through each order again to show its detailed invoice --}}
        @foreach ($orders as $order)
        <div class="fp__invoice invoice_details_{{ $order->id }}">
            {{-- Back button to go back to the order list --}}
            <a class="go_back d-print-none"><i class="fas fa-long-arrow-alt-left"></i> go back</a>

            {{-- Order tracking steps displayed based on the order status --}}
            <div class="fp__track_order d-print-none">
                <ul>
                    @if ($order->order_status === 'declined')

                    <li class="declined_status
                    {{ in_array($order->order_status, ['declined']) ? 'active' : '' }}
                    ">order declined</li>
                    @else
                    <li class="
                    {{ in_array($order->order_status, ['pending', 'in_process', 'delivered', 'declined']) ? 'active' : '' }}
                    ">order pending</li>
                    <li class="
                    {{ in_array($order->order_status, ['in_process', 'delivered', 'declined']) ? 'active' : '' }}
                    ">order in process</li>
                    <li class="
                    {{ in_array($order->order_status, ['delivered']) ? 'active' : '' }}
                    ">order delivered</li>
                    @endif
                </ul>
            </div>

            {{-- Invoice header with user and payment details --}}
            <div class="fp__invoice_header">
                <div class="header_address">
                    <h4>invoice to</h4>
                    <p>{{ @$order->userAddress->first_name }}</p>
                    <p>{{ $order->address }}</p>
                    <p>{{ @$order->userAddress->phone }}</p>
                    <p>{{ @$order->userAddress->email }}</p>
                </div>
                <div class="header_address" style="width: 50%">
                    <p><b style="width: 140px">invoice no: </b><span>{{ @$order->invoice_id }}</span></p>
                    <p><b style="width: 140px">Payment Status: </b><span>{{ @$order->payment_status }}</span></p>
                    <p><b style="width: 140px">Payment Method: </b><span>{{ @$order->payment_method }}</span></p>
                    <p><b style="width: 140px">Transaction Id: </b><span>{{ @$order->transaction_id }}</span></p>
                    <p><b style="width: 140px">date:</b> <span>{{ date('d-m-Y', strtotime($order->created_at)) }}</span></p>
                </div>
            </div>

            {{-- Invoice body showing detailed item information --}}
            <div class="fp__invoice_body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tbody>
                            {{-- Table header with columns for item details (SL, Description, Price, Quantity, Total) --}}
                            <tr class="border_none">
                                <th class="sl_no">SL</th>
                                <th class="package">item description</th>
                                <th class="price">Price</th>
                                <th class="qnty">Quantity</th>
                                <th class="total">Total</th>
                            </tr>

                            {{-- Loop through order items and display their details --}}
                            @foreach ($order->orderItems as $item)
                            @php
                                // Decode the product size and options to calculate the item total
                                $size = json_decode($item->product_size);
                                $options = json_decode($item->product_option);
                                $qty = $item->qty;
                                $untiPrice = $item->unit_price;
                                $sizePrice = $size->price ?? 0;
                                $optionPrice = 0;
                                // Calculate the total price for the item based on its options
                                foreach ($options as $optionItem) {
                                    $optionPrice += $optionItem->price;
                                }

                                $productTotal = ($untiPrice + $sizePrice + $optionPrice) * $qty;
                            @endphp
                            <tr>
                                {{-- Display item details such as SL number, description, size, options, price, quantity, and total --}}
                                <td class="sl_no">{{ ++$loop->index }}</td>
                                <td class="package">
                                    <p>{{ $item->product_name }}</p>
                                    <span class="size">{{ @$size->name }} - {{ @$size->price ? currencyPosition(@$size->price) : ''}}</span>
                                    @foreach ($options as $option)
                                    <span class="coca_cola">{{ @$option->name }} - {{ @$option->price ? currencyPosition(@$option->price) : '' }}</span>
                                    @endforeach
                                </td>
                                <td class="price">
                                    <b>{{ currencyPosition($item->unit_price) }}</b>
                                </td>
                                <td class="qnty">
                                    <b>{{ $item->qty }}</b>
                                </td>
                                <td class="total">
                                    <b>{{ currencyPosition($productTotal) }}</b>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            {{-- Display subtotal, discount, shipping cost, and grand total --}}
                            <tr>
                                <td class="package" colspan="3"><b>sub total</b></td>
                                <td class="qnty"><b>-</b></td>
                                <td class="total"><b>{{ currencyPosition($order->subtotal) }}</b></td>
                            </tr>
                            <tr>
                                <td class="package coupon" colspan="3"><b>(-) Discount coupon</b></td>
                                <td class="qnty"><b></b></td>
                                <td class="total coupon"><b>{{ currencyPosition($order->discount) }}</b></td>
                            </tr>
                            <tr>
                                <td class="package coast" colspan="3"><b>(+) Shipping Cost</b></td>
                                <td class="qnty"><b></b></td>
                                <td class="total coast"><b>{{ currencyPosition($order->delivery_charge) }}</b></td>
                            </tr>
                            <tr>
                                <td class="package" colspan="3"><b>Total Paid</b></td>
                                <td class="qnty"><b></b></td>
                                <td class="total"><b>{{ currencyPosition($order->grand_total) }}</b></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            {{-- Print invoice button to generate PDF --}}
            <a class="print_btn common_btn d-print-none" href="javascript:;" onclick="printInvoice('{{ $order->id }}')"><i class="far fa-print "></i> print PDF</a>
        </div>
        @endforeach
    </div>
</div>

{{-- JavaScript code for handling invoice viewing and printing --}}
@push('scripts')
    <script>
        // Function to show invoice details when clicking "View Details"
        function viewInvoice(id){
            $(".fp_dashboard_order").fadeOut();  // Hide the order list
            $(".invoice_details_"+id).fadeIn();  // Show the selected order details
        }

        // Function to print the invoice
        function printInvoice(id) {
            let printContents = $('.invoice_details_'+id).html();
            let printWindow = window.open('', '', 'width=1600,height=600');
            printWindow.document.open();
            printWindow.document.write('<html>');
            printWindow.document.write('<link rel="stylesheet" href="{{ asset("frontend/css/bootstrap.min.css") }}">');
            printWindow.document.write('<link rel="stylesheet" href="{{ asset("frontend/css/style.css") }}');
            printWindow.document.write('<body>');
            printWindow.document.write(printContents);
            printWindow.document.write('</body></html>');
            printWindow.document.close();

            printWindow.print();
            printWindow.close();
        }
    </script>
@endpush
