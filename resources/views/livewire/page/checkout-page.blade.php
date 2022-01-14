<div>
    <!--=====================
Breadcrumb Aera Start
=========================-->
    <div class="breadcrumbs_area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <ul>
                            <li>
                                <h1><a href="{{ route('home') }}">Home</a></h1>
                            </li>
                            <li>Checkout</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--=====================
    Breadcrumb Aera End
    =========================-->

    <!--======================
    Checkout area Start
    ==========================-->
    <div class="checkout-area mt-50">
        <div class="container">
            <form wire:submit.prevent="save">
                <div class="row">
                    <div class="col-12">
                        <div class="user-actions">
                            <h5>
                                <i class="fa fa-file-o" aria-hidden="true"></i>
                                Returning customer?
                                <a href="#" data-toggle="collapse" data-target="#checkout_coupon">Click here to enter
                                    your
                                    code</a>
                            </h5>
                            <div id="checkout_coupon" class="collapse">
                                <div class="coupon-code">
                                    <div class="coupon-inner">
                                        <input placeholder="Coupon code" type="text">
                                        <button type="submit">Apply coupon</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="col-lg-12">
                            <h5 class="form-head">Billing Details</h5>
                        </div>
                        <div class="form_group col-12">
                            <label class="form-label">Full Name <span>*</span></label>
                            <input class="form-control" type="text" value="{{ $user->name }}" required>
                        </div>
                        <div class="form_group col-12">
                            <label class="form-label" for="state">Country <span>*</span></label>
                            <input class="form-control" type="text" value="{{ $user->country->name }}" required>
                        </div>
                        <div class="form_group col-12">
                            <label class="form-label" for="location_id">Shipping Location <span>*</span></label>
                            <select id="location_id" wire:model="location_id" class="form-control" required>
                                <option value="location" selected>Select Location</option>
                                @foreach($locations as $location)
                                    <option value="{{ $location->id }}">{{ $location->name }}</option>
                                @endforeach
                            </select>
                            @error('location_id') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        <div class="form_group col-12">
                            <label class="form-label">Street Address <span>*</span></label>
                            <input placeholder="House number and street name" class="form-control" type="text"
                                   wire:model="address_one" required
                                   value="{{ isset($user->user_detail) ?$user->user_detail->address_one : '' }}">
                            @error('address_one') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        <div class="form_group col-12">
                            <input placeholder="Apartment, suite, unit etc. (optional)" class="form-control"
                                   type="text"
                                   wire:model="address_two" required
                                   value="{{ isset($user->user_detail) ?$user->user_detail->address_two : '' }}">
                            @error('address_two') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        <div class="form_group col-12">
                            <label class="form-label">Town / City <span>*</span></label>
                            <input class="form-control" type="text" wire:model="town" required
                                   wire:model="town"
                                   value="{{ isset($user->user_detail) ?$user->user_detail->town : '' }}">
                            @error('town') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        <div class="form_group col-12">
                            <label class="form-label">State / County <span>*</span></label>
                            <input class="form-control" type="text" wire:model="county" required
                                   value="{{ isset($user->user_detail) ?$user->user_detail->county : '' }}">
                            @error('county') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        <div class="form_group col-12">
                            <label class="form-label">Phone <span>*</span></label>
                            <input class="form-control" type="text" value="{{ $user->phone_number }}" required>
                        </div>
                        <div class="form_group col-12">
                            <label class="form-label">Email Address <span>*</span></label>
                            <input class="form-control" type="text" value="{{ $user->email }}" required>
                        </div>
                        <div class="form_group col-12">
                            <label class="form-label" for="order-note">Order Notes <span>*</span></label>
                            <textarea class="form-control" id="order-note" wire:model="notes" required rows="5"
                                      placeholder="Notes about your order, e.g. special notes for delivery.">
                                    {{ isset($user->user_detail) ?$user->user_detail->notes : '' }}
                                </textarea>
                            @error('notes') <span class="error">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        @if(count($cartItems))
                            <div class="col-lg-12">
                                <h5 class="form-head rs-padding">Your Order</h5>
                            </div>
                            <div class="col-lg-12">
                                <div class="order_table table-responsive">
                                    <table>
                                        <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Total</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php($sum = 0)
                                        @foreach($cartItems as $cartItem)
                                            <tr>
                                                <td> {{ $cartItem->name }} <sup><strong> × {{ $cartItem->qty }}</strong></sup>
                                                </td>
                                                <td> {{ \App\Http\Controllers\SystemController::defaultCurrency() }} {{ number_format($cartItem->price,2) }}</td>
                                            </tr>
                                            @php($sum += ($cartItem->price * $cartItem->qty))
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>Cart Subtotal</th>
                                            <td>{{ \App\Http\Controllers\SystemController::defaultCurrency() }} {{ $subtotal }}</td>
                                        </tr>
                                        <tr>
                                            <th>Shipping</th>
                                            <td>
                                                <strong>{{ \App\Http\Controllers\SystemController::defaultCurrency() }} {{ number_format($shipping_cost,2) }}</strong>
                                            </td>
                                        </tr>
                                        <tr class="order_total">
                                            <th>Order Total</th>
                                            <td>
                                                <strong>{{ \App\Http\Controllers\SystemController::defaultCurrency() }} {{ number_format($sum+$shipping_cost,2) }}</strong>
                                            </td>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        @endif
                        @foreach(\App\Http\Controllers\CacheController::cachePaymentOptions() as $payment)
                            <div class="form-row">
                                <div class="form-group col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault"
                                               wire:model="payment_option_id"
                                               value="{{ $payment->id }}"
                                               id="flexRadioDefault1">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            {{ $payment->name }}
                                        </label>
                                    </div>

                                    @error('payment_option_id') <span
                                        class="text-danger error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        @endforeach
                        <div class="form-row">
                            <div class="form-group col-12">
                                <div class="form-check">
                                    <div class="custom-checkbox">
                                        <input class="form-check-input" type="checkbox" id="agree-condition"
                                               wire:model="accept_terms" required>
                                        <span class="checkmark"></span>
                                        <label class="form-check-label" for="agree-condition">I agree to the <a
                                                href="#">terms
                                                of service</a> and will adhere to them unconditionally.</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row justify-content-end mt-20 mb-20">
                            <button type="submit"
                                    class="btn-secondary text-uppercase {{ $accept_terms ? '' : 'disabled' }}">
                                <span wire:loading.class="fa fa-spinner fa-spin"></span>
                                Continue to payment
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!--======================
    Checkout area End
    ==========================-->
</div>
